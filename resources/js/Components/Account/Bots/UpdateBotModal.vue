<template>
    <div class="fixed inset-0 flex items-center justify-center bg-gray-500 bg-opacity-75">
        <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md">
            <h3 class="text-lg font-semibold mb-4">Update Bot</h3>
            <form @submit.prevent="updateProject">
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                    <input
                        v-model="form.name"
                        id="name"
                        type="text"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50"
                        required
                    />
                </div>
                <div class="mb-4">
                    <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                    <textarea
                        v-model="form.description"
                        id="description"
                        rows="3"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50"
                    ></textarea>
                </div>
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Bot Token</label>
                    <input
                        v-model="form.bot_token"
                        id="name"
                        type="text"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50"
                        required
                    />
                </div>
                <div class="flex justify-end">
                    <button
                        type="button"
                        @click="$emit('close')"
                        class="btn btn-cancel mr-2"
                    >
                        Cancel
                    </button>
                    <button
                        type="submit"
                        class="btn btn-primary"
                    >
                        Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>

<script setup>
import { ref, watch } from 'vue';
import {useForm, usePage} from '@inertiajs/vue3';

const props = defineProps({
    bot: Object
});
const { projectID } = usePage().props;
const emit = defineEmits(['close', 'bot-update']);

const form = useForm({
    name: props.bot.name,
    description: props.bot.description,
    bot_token: props.bot.bot_token
});

const updateProject = () => {
    var obj = new Object();
    obj['telegramProject']=projectID
    obj['telegramBot']=props.bot.id

    form.put(route('account.bot.update', obj), {
        onSuccess: () => {
            emit('bot-update');
            emit('close');
        },
        onError: () => {
            // Handle error
        },
    });
};
</script>
