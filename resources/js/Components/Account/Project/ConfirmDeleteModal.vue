<script setup>
import { defineEmits } from 'vue';
import { useForm } from '@inertiajs/vue3';

const emit = defineEmits(['close', 'project-deleted']);
const props = defineProps({
    project: Object
});

const form = useForm({
    _method: 'DELETE'
});

const submit = () => {
    form.delete(route('account.project.destroy', props.project.id), {
        onSuccess: () => {
            emit('close');
            emit('project-deleted'); // Emit the project-deleted event
        }
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
            <h3 class="text-lg font-semibold mb-4">Confirm Deletion</h3>
            <p>Are you sure you want to delete the project "{{ props.project.name }}"?</p>
            <div class="flex justify-end mt-4">
                <button
                    @click="submit"
                    class="btn btn-destroy text-white px-4 py-2 rounded-md shadow-sm"
                >
                    Delete
                </button>
                <button
                    @click="closeModal"
                    class="ml-2 bg-gray-500 text-white px-4 py-2 rounded-md shadow-sm"
                >
                    Cancel
                </button>
            </div>
        </div>
    </div>
</template>

<style scoped>
/* Add your styles here */
</style>
