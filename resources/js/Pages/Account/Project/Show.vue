<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, usePage, Link, router } from '@inertiajs/vue3';
import AddChannelModal from "@/Components/Account/Channel/AddChannelModal.vue";
import AddBotModal from "@/Components/Account/Bots/AddBotModal.vue";
import UpdateBotModal from "@/Components/Account/Bots/UpdateBotModal.vue";
import ConfirmDeleteBotModal from "@/Components/Account/Bots/ConfirmDeleteBotModal.vue";
import ConfirmDeleteModal from "@/Components/Account/Channel/ConfirmDeleteModal.vue";
import UpdateChannelModal from "@/Components/Account/Channel/UpdateChannelModal.vue";


const { channels: initialChannels, bots: initialBots, projectID: initialProjectID } = usePage().props;
const channels = ref(initialChannels);
const bots = ref(initialBots);
const projectID = ref(initialProjectID);

const showAddBotModal = ref(false);
const showDeleteBotModal = ref(false);
const showUpdateBotModal = ref(false);
const projectToDeleteBot = ref(null);
const projectToUpdateBot = ref(null);

const showAddModal = ref(false);
const showDeleteModal = ref(false);
const showUpdateModal = ref(false);
const projectToDelete = ref(null);
const projectToUpdate = ref(null);

const handleAddChannelClick = () => {
    showAddModal.value = true;
};

const handleAddBotClick = () => {
    showAddBotModal.value = true;
};

const closeAddModal = () => {
    showAddModal.value = false;
};
const closeAddBotModal = () => {
    showAddBotModal.value = false;
};

const openDeleteModal = (channel) => {
    projectToDelete.value = channel;
    showDeleteModal.value = true;
};
const openDeleteBotModal = (bot) => {
    projectToDeleteBot.value = bot;
    showDeleteBotModal.value = true;
};

const closeDeleteModal = () => {
    showDeleteModal.value = false;
    projectToDelete.value = null;
};

const closeDeleteBotModal = () => {
    showDeleteBotModal.value = false;
    projectToDeleteBot.value = null;
};

const openUpdateModal = (channel) => {
    projectToUpdate.value = channel;
    showUpdateModal.value = true;
};

const openUpdateBotModal = (channel) => {
    projectToUpdateBot.value = channel;
    showUpdateBotModal.value = true;
};

const closeUpdateModal = () => {
    showUpdateModal.value = false;
    projectToUpdate.value = null;
};
const closeUpdateBotModal = () => {
    showUpdateBotModal.value = false;
    projectToUpdateBot.value = null;
};

const fetchChannels = () => {
    router.visit(route('account.project.show', { id: projectID.value }), {
        preserveState: true,
        only: ['channels', 'bots'],
        onSuccess: (page) => {
            channels.value = [...page.props.channels];
            bots.value = [...page.props.bots];
        }
    });
};

const addClientId = (bot) => {
    if (bot.newDestinationId.trim() && bot.newDestinationName.trim()) {
        saveDestination(bot, bot.newDestinationId, bot.newDestinationName);
    }
};

const removeClientId = (bot, dest) => {
    destroyDestination(bot, dest);
};

const destroyDestination = (bot, dest) => {
    const obj = {
        telegramProject: projectID.value,
        telegramBot: bot.id,
        telegramBotDestination: dest.id,
    };

    router.delete(route('account.bot.destination.destroy', obj), {
        preserveState: true,
        only: ['channels', 'bots'],
        onSuccess: (page) => {
            channels.value = [...page.props.channels];
            bots.value = [...page.props.bots];
        }
    });
};

const saveDestination = (bot, destination, name) => {
    const obj = {
        telegramProject: projectID.value,
        telegramBot: bot.id,
        name: name,
        destination: destination,
    };
    router.post(route('account.bot.destination.store', obj), {
        only: ['channels', 'bots'],
    });
    fetchChannels()
};

// Додаємо нові властивості до кожного бота
bots.value.forEach(bot => {
    bot.newDestinationId = '';
    bot.newDestinationName = '';
});
</script>

<template>
    <div>
        <Head title="Projects Index"/>
        <AuthenticatedLayout>
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="flex justify-between mb-4">
                        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Channels</h2>
                        <button @click="handleAddChannelClick"
                                class="btn btn-add text-black font-semibold px-4 py-2 rounded-lg shadow-md transition duration-200">
                            + Add Channel
                        </button>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                        <div v-for="channel in channels" :key="channel.id" class="bg-white shadow-lg rounded-lg p-4">
                            <h3 class="text-lg font-semibold">{{ channel.name }}</h3>
                            <p class="text-gray-600">{{ channel.channel }}</p>
                            <div class="flex justify-between items-center"></div>
                            <div class="flex justify-between items-center">
                                <button @click="openUpdateModal(channel)"
                                        class="mt-2 text-blue-600 hover:text-blue-800">Edit
                                </button>
                                <button @click="openDeleteModal(channel)" class="mt-2 text-red-600 hover:text-red-800">
                                    Delete
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <br/>
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="flex justify-between mb-4">
                        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Bots</h2>
                        <button @click="handleAddBotClick"
                                class="btn btn-add text-black font-semibold px-4 py-2 rounded-lg shadow-md transition duration-200">
                            + Add Bot
                        </button>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6">
                        <div v-for="bot in bots" :key="bot.id" class="bg-white shadow-lg rounded-lg p-4">
                            <h3 class="text-lg font-semibold"><b>name:</b> {{ bot.name }}</h3>
                            <div><b>description:</b>: {{ bot.description }}</div>
                            <div><b>bot token:</b> {{ bot.bot_token }}</div>

                            <div v-for="(dest, index) in bot.destination" :key="index" class="destination-row">
                                <div class="destination-cell">{{ dest.name }}</div>
                                <div class="destination-cell">{{ dest.destination }}</div>
                                <button @click="removeClientId(bot, dest)" class="remove-button">Remove</button>
                            </div>
                            <div class="flex justify-between items-center">
                                <input
                                    v-model="bot.newDestinationName"
                                    type="text"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50"
                                    placeholder="New Client Name"
                                />
                                <input
                                    v-model="bot.newDestinationId"
                                    type="text"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50"
                                    placeholder="New Client ID"
                                />
                            </div>
                            <button @click="addClientId(bot)"
                                    class="btn btn-add text-black font-semibold px-2 py-1 mt-2 rounded-lg shadow-md transition duration-200">
                                + Add Client ID
                            </button>
                            <div class="flex justify-between items-center">
                                <button @click="openUpdateBotModal(bot)" class="mt-2 text-blue-600 hover:text-blue-800">
                                    Edit
                                </button>
                                <button @click="openDeleteBotModal(bot)" class="mt-2 text-red-600 hover:text-red-800">
                                    Delete
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <AddBotModal v-if="showAddBotModal" @close="closeAddBotModal" :projectID="projectID.value"
                         @bot-added="fetchChannels"/>
            <ConfirmDeleteBotModal v-if="showDeleteBotModal" :projectID="projectID.value" :bot="projectToDeleteBot"
                                   @close="closeDeleteBotModal" @bot-deleted="fetchChannels"/>
            <UpdateBotModal v-if="showUpdateBotModal" :projectID="projectID.value" :bot="projectToUpdateBot"
                                @close="closeUpdateBotModal" @bot-update="fetchChannels"/>
            <AddChannelModal v-if="showAddModal" @close="closeAddModal" :projectID="projectID.value"
                             @channel-added="fetchChannels"/>
            <ConfirmDeleteModal v-if="showDeleteModal" :projectID="projectID.value" :channel="projectToDelete"
                                @close="closeDeleteModal" @channel-deleted="fetchChannels"/>
            <UpdateChannelModal v-if="showUpdateModal" :projectID="projectID.value" :channel="projectToUpdate"
                                @close="closeUpdateModal" @channel-update="fetchChannels"/>
        </AuthenticatedLayout>
    </div>
</template>
