<script setup>
import { ref, defineEmits } from 'vue';
import {useForm, usePage} from '@inertiajs/vue3';

const { projectID } = usePage().props;

const emit = defineEmits(['close', 'channel-added']);
const form = useForm({
    name: '',
    channel: '',
});

const submit = () => {
    form.post(route('account.channel.store', projectID), {
        onSuccess: () => {
            form.reset();
            emit('close');
            emit('channel-added');
        },
    });
};

const closeModal = () => {
    emit('close');
};


</script>

<template>
    <div class="fixed inset-0 flex items-center justify-center z-50">
        <div class="fixed inset-0 bg-black opacity-50" @click="closeModal"></div>
        <div class="bg-white rounded-lg shadow-lg p-6 z-10 max-w-sm w-full">
            <h3 class="text-lg font-semibold mb-4">Add New Channel</h3>
            <form @submit.prevent="submit">
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Name Channel</label>
                    <input
                        id="name"
                        v-model="form.name"
                        type="text"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50"
                        required
                    />
                </div>
                <div class="mb-4">
                    <label for="channel" class="block text-sm font-medium text-gray-700">ID Channel</label>
                    <input
                        id="channel"
                        v-model="form.channel"
                        type="text"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50"
                    ></input>
                </div>
                <div class="flex justify-end">
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
