<template>
    <div class="fixed inset-0 flex items-center justify-center bg-gray-500 bg-opacity-75">
        <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md">
            <h3 class="text-lg font-semibold mb-4">Update Project</h3>
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
                        v-model="form.channel"
                        id="description"
                        rows="3"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50"
                    ></textarea>
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
    channel: Object
});
const { projectID } = usePage().props;
const emit = defineEmits(['close', 'channel-update']);

const form = useForm({
    name: props.channel.name,
    channel: props.channel.channel,
});

// watch(
//     () => props.channel,
//     (newProject) => {
//         form.name = newProject.name;
//         form.description = newProject.channel;
//     }
// );

const updateProject = () => {
    var obj = new Object();
    obj['telegramProject']=projectID
    obj['telegramChannel']=props.channel.id

    form.put(route('account.channel.update', obj), {
        onSuccess: () => {
            emit('channel-update');
            emit('close');
        },
        onError: () => {
            // Handle error
        },
    });
};
</script>
