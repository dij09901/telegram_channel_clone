<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, usePage, router } from '@inertiajs/vue3';
import AddProjectModal from '@/Components/Account/Project/AddProjectModal.vue';
import ConfirmDeleteModal from '@/Components/Account/Project/ConfirmDeleteModal.vue';
import UpdateProjectModal from '@/Components/Account/Project/UpdateProjectModal.vue';

const { projects: initialProjects } = usePage().props;
const projects = ref(initialProjects);
const showAddModal = ref(false);
const showDeleteModal = ref(false);
const showUpdateModal = ref(false);
const projectToDelete = ref(null);
const projectToUpdate = ref(null);

const handleAddProjectClick = () => {
    showAddModal.value = true;
};

const closeAddModal = () => {
    showAddModal.value = false;
};

const openDeleteModal = (project) => {
    projectToDelete.value = project;
    showDeleteModal.value = true;
};

const closeDeleteModal = () => {
    showDeleteModal.value = false;
    projectToDelete.value = null;
};

const openUpdateModal = (project) => {
    projectToUpdate.value = project;
    showUpdateModal.value = true;
};

const closeUpdateModal = () => {
    showUpdateModal.value = false;
    projectToUpdate.value = null;
};

const fetchProjects = () => {
    router.visit(route('account.dashboard'), {
        preserveState: true,
        only: ['projects'],
        onSuccess: (page) => {
            projects.value = page.props.projects;
        }
    });
};
</script>

<template>
    <div>
        <Head title="Projects Index" />
        <AuthenticatedLayout>
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="flex justify-between mb-4">
                        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Projects</h2>
                        <button @click="handleAddProjectClick" class="btn btn-add text-black font-semibold px-4 py-2 rounded-lg shadow-md transition duration-200">
                            + Add Project
                        </button>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                        <div v-for="project in projects" :key="project.id" class="bg-white shadow-lg rounded-lg p-4">
                            <h3 class="text-lg font-semibold">{{ project.name }}</h3>
                            <p class="text-gray-600">{{ project.description }}</p>
                            <div class="flex justify-between items-center">
                                <button
                                    @click="openUpdateModal(project)"
                                    class="mt-2 text-blue-600 hover:text-blue-800"
                                >
                                    Edit
                                </button>
                                <button
                                    @click="openDeleteModal(project)"
                                    class="mt-2 text-red-600 hover:text-red-800"
                                >
                                    Delete
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <AddProjectModal v-if="showAddModal" @close="closeAddModal" @project-added="fetchProjects" />
            <ConfirmDeleteModal
                v-if="showDeleteModal"
                :project="projectToDelete"
                @close="closeDeleteModal"
                @project-deleted="fetchProjects"
            />
            <UpdateProjectModal
                v-if="showUpdateModal"
                :project="projectToUpdate"
                @close="closeUpdateModal"
                @project-updated="fetchProjects"
            />
        </AuthenticatedLayout>
    </div>
</template>
