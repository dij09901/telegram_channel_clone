<script setup>
import { ref, defineEmits } from 'vue';
import { useForm } from '@inertiajs/vue3';

const emit = defineEmits(['close', 'project-added']);
const form = useForm({
    name: '',
    description: '',
});

const submit = () => {
    form.post(route('account.project.store'), {
        onSuccess: () => {
            form.reset();
            emit('close');
            emit('project-added'); // Emit the project-added event
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
            <h3 class="text-lg font-semibold mb-4">Add New Project</h3>
            <form @submit.prevent="submit">
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                    <input
                        id="name"
                        v-model="form.name"
                        type="text"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50"
                        required
                    />
                </div>
                <div class="mb-4">
                    <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                    <textarea
                        id="description"
                        v-model="form.description"
                        rows="4"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50"
                    ></textarea>
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
