<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, usePage, Link, router } from '@inertiajs/vue3';
import AddChannelModal from "@/Components/Account/Channel/AddChannelModal.vue";
import ConfirmDeleteModal from "@/Components/Account/Channel/ConfirmDeleteModal.vue";
import UpdateChannelModal from "@/Components/Account/Channel/UpdateChannelModal.vue";

const { channels: initialChannels, projectID: initialProjectID } = usePage().props;
const channels = ref(initialChannels);
const projectID = ref(initialProjectID);

const showAddModal = ref(false);



const handleAddBotClick = () => {
    showAddModal.value = true;
};


// const fetchChannels = () => {
//     router.visit(route('account.project.show', { id: projectID.value }), {
//         preserveState: true,
//         only: ['channels'],
//         onSuccess: (page) => {
//             console.log('Fetching channels:', page.props.channels);
//             channels.value = [...page.props.channels]; // створює новий масив
//         }
//     });
// };
</script>

<template>
    <div>
        <Head title="Projects Index" />
        <AuthenticatedLayout>
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="flex justify-between mb-4">
                        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Channels</h2>
                        <button @click="handleAddBotClick" class="btn btn-add text-black font-semibold px-4 py-2 rounded-lg shadow-md transition duration-200">
                            + Add Bot
                        </button>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
<!--                        <div v-for="channel in channels" :key="channel.id" class="bg-white shadow-lg rounded-lg p-4 height-min-300">-->
<!--                            <h3 class="text-lg font-semibold">-->
<!--                                <Link :href="route('account.project.show', channel.id)" class="btn btn-primary">-->
<!--                                    {{ channel.name }}-->
<!--                                </Link>-->
<!--                            </h3>-->

<!--                            <p class="text-gray-600">{{ channel.channel }}</p>-->
<!--                            <div class="flex justify-between items-center">-->

<!--                            </div>-->

<!--                        </div>-->
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    </div>
</template>
