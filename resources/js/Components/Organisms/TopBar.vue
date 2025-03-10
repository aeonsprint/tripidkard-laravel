<template>
    <header class="flex justify-center items-center p-4 border-b border-gray-200 bg-white w-full">
        <div class="flex items-center space-x-6 w-full max-w-3xl">
            <!-- Logo -->
            <router-link to="/">
                <Logo class="hidden md:flex w-20 h-13" />
            </router-link>

            <!-- Mobile Menu Button (Hidden on Desktop) -->
            <button @click="toggleMenu" class="md:hidden p-2">
                <span class="material-icons material-symbols-outlined w-6 h-6">lists</span>
            </button>

            <!-- Desktop Navigation (Visible on Desktop) -->
            <div class="hidden md:flex items-center space-x-6 flex-1">
                <BaseButton @click="openModal" name="location">
                    <span>Places</span>
                    <svg class="w-4 h-4 ml-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </BaseButton>

                <input v-model="searchQuery" @keyup.enter="searchDiscount" type="text"
                    placeholder="Search for deals and discounts"
                    class="px-4 py-2 rounded-full bg-gray-100 text-gray-600 flex-1 max-w-lg">

                <!-- Conditional Rendering -->
                <BaseButton v-if="!isAuthenticated" name="blue" to="/login">Login</BaseButton>
                <BaseButton v-else name="blue" to="/login">Dashboard</BaseButton>
            </div>
        </div>

        <!-- Mobile Menu (Hidden by default) -->
        <div v-if="isMenuOpen"
            class="absolute top-16 left-0 w-full bg-white p-4 shadow-md flex flex-col space-y-4 md:hidden z-[60]">
            <BaseButton @click="openModal" name="location">
                <span>Places</span>
                <svg class="w-4 h-4 ml-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </BaseButton>

            <input v-model="searchQuery" @keyup.enter="searchDiscount" type="text"
                placeholder="Search for deals and discounts" class="px-4 py-2 rounded bg-gray-100 text-gray-600 w-full">

            <!-- Conditional Rendering -->
            <BaseButton v-if="!isAuthenticated" name="blue" to="/login">Login</BaseButton>
            <BaseButton v-else name="blue" to="/login">Dashboard</BaseButton>
        </div>
    </header>

    <!-- Reusable Modal -->
    <LocationModal :isOpen="isModalOpen" size="md" modalClasses="bg-white border border-gray-300" @close="closeModal" />
</template>

<script>
import { ref, computed, watch } from "vue";
import { useRouter, useRoute } from "vue-router";
import { useAuthStore } from "@/stores/auth"; // Make sure you have a Vuex or Pinia auth store
import Logo from '@/Components/Atoms/Logo.vue';
import BaseButton from '@/Components/Atoms/Button.vue';
import LocationModal from '@/Components/Molecules/LocationModal.vue';

export default {
    components: {
        Logo,
        BaseButton,
        LocationModal,
    },
    setup() {
        const searchQuery = ref('');
        const router = useRouter();
        const route = useRoute();
        const isModalOpen = ref(false);
        const isMenuOpen = ref(false);

        const openModal = () => { isModalOpen.value = true; };
        const closeModal = () => { isModalOpen.value = false; };
        const toggleMenu = () => { isMenuOpen.value = !isMenuOpen.value; };

        const searchDiscount = () => {
            if (searchQuery.value.trim() !== '') {
                router.push({ path: "/merchant/list", query: { discount: searchQuery.value } }).then(() => {
                    window.location.reload();
                });
            }
        };

        watch(() => route.query.discount, (newDiscount) => {
            searchQuery.value = newDiscount || '';
        }, { immediate: true });

        // Auth Check (Replace with Vuex, Pinia, or Local Storage)
        const authStore = useAuthStore();
        const isAuthenticated = computed(() => authStore.isAuthenticated); // Check if user is logged in

        return {
            isModalOpen,
            openModal,
            closeModal,
            searchQuery,
            searchDiscount,
            isMenuOpen,
            toggleMenu,
            isAuthenticated
        };
    }
};
</script>
