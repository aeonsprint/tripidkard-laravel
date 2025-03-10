<template>
    <Header />
    <Sidebar />
    <!-- Content -->
    <div class="w-full lg:ps-64 bg-[#f7f9fa]">
        <div class="p-4 sm:p-6 space-y-4 sm:space-y-6">



            <!-- Notifications Title -->
            <h2 class="text-2xl font-semibold mb-4">Notifications</h2>

            <!-- Highlighted Notification -->
            <div class="bg-blue-600 text-white p-4 rounded-lg flex items-center justify-between cursor-pointer">
                <div>
                    <p class="font-semibold">We released some new features</p>
                    <p class="text-sm opacity-80">Check them out!</p>
                </div>
                <i class="fa-solid fa-chevron-right"></i>
            </div>

            <!-- Notification List -->
            <div class="mt-4 space-y-4">
                <div v-for="(notif, index) in notifications" :key="index"
                    class="flex items-start space-x-4 border-b pb-4">
                    <!-- Avatar -->
                    <img :src="notif.avatar" alt="Avatar" class="w-10 h-10 rounded-full">
                    <!-- Content -->
                    <div class="flex-1">
                        <p class="text-gray-800">
                            <span class="font-semibold">{{ notif.name }}</span> {{ notif.message }}
                        </p>
                        <p class="text-sm text-gray-500">{{ notif.time }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Content -->
</template>
<script>
import Header from '@/Layout/Dashboard/header.vue';
import Sidebar from '@/Layout/Sidebar/adminSidebar.vue';
import { ref } from 'vue';

export default {
    components: {
        Header,
        Sidebar
    },
    setup() {
        const notifications = ref([
            {
                name: 'Brian Griffin',
                message: 'wants to collaborate',
                time: '5 days ago',
                avatar: 'https://via.placeholder.com/40',
            },
            {
                name: 'Adam from The Mayor’s Office',
                message: 'is looking for people like you.',
                time: '1 month ago',
                avatar: 'https://via.placeholder.com/40',
            },
            {
                name: 'Neil',
                message: 'is looking for people like you.',
                time: '1 month ago',
                avatar: 'https://via.placeholder.com/40',
            },
            {
                name: 'Quagmire from Giggity Co.',
                message: 'is looking for people like you.',
                time: '1 month ago',
                avatar: 'https://via.placeholder.com/40',
            },
            {
                name: 'Herbert from Children’s Program',
                message: 'is looking for people like you.',
                time: '1 month ago',
                avatar: 'https://via.placeholder.com/40',
            },
            {
                name: 'Cleveland from The Post Office',
                message: 'is looking for people like you.',
                time: '2 months ago',
                avatar: 'https://via.placeholder.com/40',
            },
            {
                name: 'Joe',
                message: 'is looking for people like you.',
                time: '2 months ago',
                avatar: 'https://via.placeholder.com/40',
            },
        ]);

        return {
            notifications
        };
    }
}
</script>
