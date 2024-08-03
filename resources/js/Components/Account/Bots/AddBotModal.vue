<script setup>
import { ref, defineEmits } from 'vue';
import {useForm, usePage} from '@inertiajs/vue3';

const { projectID } = usePage().props;

const emit = defineEmits(['close', 'bot-added']);
const form = useForm({
    name: '',
    description: '',
    bot_token: '',
    destination: [],
});

const newClientId = ref('');

const submit = () => {
    form.post(route('account.bot.store', projectID), {
        onSuccess: () => {
            form.reset();
            emit('close');
            emit('bot-added');
        },
    });
};

const closeModal = () => {
    emit('close');
};

const addClientId = () => {
    if (newClientId.value.trim()) {
        form.destination.push(newClientId.value);
        newClientId.value = '';
    }
};

const removeClientId = (index) => {
    form.destination.splice(index, 1);
};
</script>

<template>
    <div class="fixed inset-0 flex items-center justify-center z-50">
        <div class="fixed inset-0 bg-black opacity-50" @click="closeModal"></div>
        <div class="bg-white rounded-lg shadow-lg p-6 z-10 max-w-sm w-full">
            <h3 class="text-lg font-semibold mb-4">Add New Bot</h3>
            <form @submit.prevent="submit">
                <div class="mb-4">
                    <label :for="'name'+form.name" class="block text-sm font-medium text-gray-700">Name</label>
                    <input
                        :id="'name'+form.name"
                        v-model="form.name"
                        type="text"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50"
                        required
                    />
                </div>

                <div class="mb-4">
                    <label :for="'description'+form.description" class="block text-sm font-medium text-gray-700">Description</label>
                    <input
                        :id="'description'+form.description"
                        v-model="form.description"
                        type="text"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50"
                        required
                    />
                </div>

                <div class="mb-4">
                    <label :for="'bot_token'+form.bot_token" class="block text-sm font-medium text-gray-700">Name Bot
                        token</label>
                    <input
                        :id="'bot_token'+form.bot_token"
                        v-model="form.bot_token"
                        type="text"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50"
                        required
                    />
                </div>

                <div class="mb-4">
                    <label :for="'new_client_id'" class="block text-sm font-medium text-gray-700">Add Client ID</label>
                    <input
                        id="new_destination"
                        v-model="newClientId"
                        type="text"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50"
                    />
                    <button
                        type="button"
                        @click="addClientId"
                        class="mt-2 bg-blue-500 text-white px-4 py-2 rounded-md shadow-sm"
                    >
                        Add
                    </button>
                </div>

                <div v-for="(dest, index) in form.destination" :key="index"
                     class="bg-white shadow-lg rounded-lg p-4 mt-2 flex justify-between items-center">
                    <span>{{ dest }}</span>
                    <button
                        type="button"
                        @click="removeClientId(index)"
                        class="bg-red-500 text-white px-2 py-1 rounded-md shadow-sm"
                    >
                        Remove
                    </button>
                </div>

                <div class="flex justify-end mt-4">
                    <button
                        type="submit"
                        class="btn btn-success text-white px-4 py-2 rounded-md shadow-sm"
                    >
                        Save
                    </button>
                    <button
                        type="button"
                        @click="closeModal"
                        class="ml-2 bg-gray-500 text-white px-4 py-2 rounded-md shadow-sm"
                    >
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>

<style scoped>
/* Add your styles here */
</style>
