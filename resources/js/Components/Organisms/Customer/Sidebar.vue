<template>
    <aside class="w-64 bg-gray-100 p-4 min-h-screen">
        <div class="flex items-center space-x-2 mb-6">
            <Logo class="w-10 h-10 rounded-full" />

            <div>
                <p class="font-semibold">Username</p>
                <a href="#" class="text-blue-500 text-sm">Edit profile</a>
            </div>
        </div>

        <nav>
            <ul class="space-y-2">
                <li v-for="item in menuItems" :key="item.label" :class="{ 'bg-gray-300': item.active }"
                    class="p-2 rounded hover:bg-gray-200 flex items-center space-x-2"
                    @click="item.action ? item.action() : navigate(item.link)">
                    <span class="text-gray-600">{{ item.icon }}</span>
                    <span>{{ item.label }}</span>
                </li>
            </ul>
        </nav>
    </aside>
</template>

<script>
import {  onMounted } from 'vue';

import Logo from '@/Components/Atoms/Logo.vue';
import { useAuthStore } from '@/Stores/auth';
import Swal from 'sweetalert2';
import { useRouter } from 'vue-router';

export default {
    components: {
        Logo,
    },
    setup() {
        const authStore = useAuthStore();
        const router = useRouter();

        const handleLogout = async () => {
            Swal.fire({
                title: 'Are you sure?',
                text: "You will be logged out!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, logout!'
            }).then(async (result) => {
                if (result.isConfirmed) {
                    await authStore.logout(); // Ensure logout completes
                    router.push("/login"); // Redirect to login page
                    setTimeout(() => {
                        window.location.reload(); // Reload after redirect
                    }, 100);
                }
            });
        };

        const navigate = (link) => {
            router.push(link);
        };

        onMounted(() => {
            authStore.getUser();
        });

        return {
            handleLogout,
            navigate,
        };
    },
    data() {
        return {
            menuItems: [
                { label: 'Profile', link: '/customer/profile/', icon: '🏠' },
                { label: 'Discount Transaction', icon: '📜', link: '/customer/discount/' },
                { label: 'Joined Raffle', link: '/customer/raffle/', icon: '🎟', active: true },
                { label: 'Collections', link: '/customer/collection/', icon: '📦' },
                { label: 'Activity log', link: '/customer/activity-log', icon: '📋' },
                { label: 'Logout', icon: '🚪', action: this.handleLogout } // Call handleLogout on click
            ]
        };
    }
};
</script>
