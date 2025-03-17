<template>
    <aside class="w-64 bg-gray-100 p-4 min-h-screen">
        <div class="flex items-center space-x-2 mb-6">
            <Logo class="w-10 h-10 rounded-full" />
            <div>
                <p class="font-semibold">Username</p>
                <a href="/customer/profile/" class="text-blue-500 text-sm">Edit profile</a>
            </div>
        </div>

        <nav>
            <ul class="space-y-2">
                <li v-for="item in menuItems" :key="item.label" :class="{ 'bg-gray-300': item.active }"
                    class="p-2 rounded hover:bg-gray-200 flex items-center space-x-2 cursor-pointer">
                    <a v-if="item.link" :href="item.link" class="flex items-center space-x-2 w-full text-gray-600">
                        <span class="material-icons">{{ item.icon }}</span>
                        <span>{{ item.label }}</span>
                    </a>
                    <a v-else href="#" @click.prevent="item.action" class="flex items-center space-x-2 w-full text-gray-600">
                        <span class="material-icons">{{ item.icon }}</span>
                        <span>{{ item.label }}</span>
                    </a>
                </li>
            </ul>
        </nav>
    </aside>
</template>

<script>
import { onMounted } from 'vue';
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
                    await authStore.logout();
                    router.push("/login");
                    setTimeout(() => {
                        window.location.reload();
                    }, 100);
                }
            });
        };

        onMounted(() => {
            authStore.getUser();
        });

        return {
            handleLogout
        };
    },
    data() {
        return {
            menuItems: [
                { label: 'Discount Transaction', icon: 'receipt_long', link: '/customer/discount/' },
                { label: 'Joined Raffle', icon: 'confirmation_number', link: '/customer/raffle/', active: true },
                { label: 'Collections', icon: 'inventory', link: '/customer/collection/' },
                { label: 'Activity log', icon: 'history', link: '/customer/activity-log' },
                { label: 'QR Code', icon: 'qr_code', link: '/customer/qrcode/' },
                { label: 'Logout', icon: 'logout', action: this.handleLogout }
            ]
        };
    }
};
</script>


