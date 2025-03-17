<template>
    <TopBar />
    <div class="flex w-full lg:ps-20 max-w-[80rem] bg-[#f7f9fa]">
        <!-- Sidebar -->
        <Sidebar />

        <!-- Main Content -->
        <main class="flex-1 p-6">
            <h1 class="text-xl font-bold">Joined Raffle</h1>
            <p class="text-gray-500">Raffle participation history</p>

            <!-- Search Bar -->
            <div class="flex justify-between items-center my-4">
                <input
                    v-model="searchQuery"
                    type="text"
                    placeholder="Search..."
                    class="w-1/4 p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400"
                />
            </div>

            <!-- Raffle Table -->
            <div class="bg-white shadow rounded-lg">
                <div class="p-4 border-b font-semibold text-gray-700">Yesterday</div>
                <div v-for="raffle in paginatedRaffles" :key="raffle.id" class="p-4 border-b last:border-b-0">
                    <div class="flex justify-between items-center">
                        <div>
                            <!-- Clickable Raffle Title -->
                            <router-link
                                :to="`/raffle/page/${raffle.id}`"
                                class="font-semibold text-lg text-blue-600 hover:underline"
                            >
                                {{ raffle.title }}
                            </router-link>
                            <p class="text-sm text-gray-500">Shop Name</p>
                        </div>
                        <p class="text-sm text-gray-500">{{ raffle.time }}</p>
                    </div>
                    <div class="flex items-center text-sm text-gray-600 mt-2">
                        <span class="mr-2">⏳ Draws in: {{ raffle.drawTime }}</span>
                        <span class="mr-2">🎁 Prize: {{ raffle.prize }}</span>
                        <span>👥 Participants: {{ raffle.participants }}</span>
                    </div>
                    <div class="mt-2 flex items-center space-x-4">
                        <button class="bg-blue-500 text-white px-4 py-1 rounded-lg">Ticket: {{ raffle.ticket }}</button>
                        <button class="text-blue-500">Share</button>
                        <!-- View Raffle Button -->
                        <router-link
                            :to="`/raffle/page/${raffle.id}`"
                            class="bg-green-500 text-white px-4 py-1 rounded-lg hover:bg-green-600"
                        >
                            View Raffle
                        </router-link>
                    </div>
                </div>
            </div>

            <!-- Pagination -->
            <div class="flex justify-end items-center mt-4 space-x-2">
                <button
                    @click="prevPage"
                    :disabled="currentPage === 1"
                    class="px-3 py-2 bg-gray-200 rounded-md hover:bg-gray-300 disabled:opacity-50"
                >
                    Prev
                </button>
                <button
                    v-for="page in totalPages"
                    :key="page"
                    @click="currentPage = page"
                    class="px-3 py-2 rounded-md"
                    :class="currentPage === page ? 'bg-blue-500 text-white' : 'bg-gray-200 hover:bg-gray-300'"
                >
                    {{ page }}
                </button>
                <button
                    @click="nextPage"
                    :disabled="currentPage === totalPages"
                    class="px-3 py-2 bg-gray-200 rounded-md hover:bg-gray-300 disabled:opacity-50"
                >
                    Next
                </button>
            </div>
        </main>
    </div>
    <Footer />
</template>

<script>
import Sidebar from "@/Components/Organisms/Customer/Sidebar.vue";
import TopBar from "@/Components/Organisms/TopBar.vue";
import Footer from "@/Components/Organisms/Footer.vue";
import axios from "axios";
import { ref, computed, onMounted } from "vue";

export default {
    components: {
        TopBar,
        Sidebar,
        Footer,
    },
    setup() {
        const searchQuery = ref("");
        const currentPage = ref(1);
        const rafflesPerPage = 5;
        const raffles = ref([]);

        // Fetch raffles from API
        const fetchRaffles = async () => {
            try {
                const response = await axios.get("/api/raffles");
                console.log("API Response:", response.data);
                raffles.value = response.data;
            } catch (error) {
                console.error("Error fetching raffles:", error);
            }
        };

        // Filter raffles based on search
        const filteredRaffles = computed(() =>
            raffles.value.filter((raffle) =>
                raffle.title.toLowerCase().includes(searchQuery.value.toLowerCase())
            )
        );

        // Pagination logic
        const totalPages = computed(() => Math.ceil(filteredRaffles.value.length / rafflesPerPage));
        const paginatedRaffles = computed(() => {
            const start = (currentPage.value - 1) * rafflesPerPage;
            return filteredRaffles.value.slice(start, start + rafflesPerPage);
        });

        const prevPage = () => {
            if (currentPage.value > 1) currentPage.value--;
        };

        const nextPage = () => {
            if (currentPage.value < totalPages.value) currentPage.value++;
        };

        onMounted(() => {
            fetchRaffles();
        });

        return {
            searchQuery,
            currentPage,
            totalPages,
            paginatedRaffles,
            prevPage,
            nextPage,
        };
    },
};
</script>
