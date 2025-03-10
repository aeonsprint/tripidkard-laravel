<template>
    <div class="max-w-4xl mx-auto p-6">
        <!-- Show Loading State -->
        <div v-if="!raffle" class="text-center text-gray-500">Loading raffle details...</div>

        <template v-else>
            <!-- Title -->
            <h1 class="text-3xl font-bold">{{ raffle.title }}</h1>

            <!-- Raffle Info -->
            <div class="grid grid-cols-2 md:grid-cols-5 gap-4 text-center mt-4">
                <div class="flex flex-col items-center">
                    <span class="text-blue-500 text-xl">🏆</span>
                    <p class="font-semibold">No. of Winners</p>
                    <p>{{ raffle.total_winner || "N/A" }}</p>
                </div>
                <div class="flex flex-col items-center">
                    <span class="text-blue-500 text-xl">🎁</span>
                    <p class="font-semibold">Prize</p>
                    <p>{{ raffle.prize || "N/A" }}</p>
                </div>
                <div class="flex flex-col items-center">
                    <span class="text-blue-500 text-xl">📅</span>
                    <p class="font-semibold">Draw Date</p>
                    <p>{{ raffle.draw_date || "N/A" }}</p>
                </div>
                <div class="flex flex-col items-center">
                    <span class="text-blue-500 text-xl">⏳</span>
                    <p class="font-semibold">Deadline</p>
                    <p>{{ raffle.entries_deadline || "N/A" }}</p>
                </div>
            </div>

            <!-- Banner Image -->
            <div class="mt-6">
                <img
                    :src="raffle.image ? `/storage/${raffle.image}` : 'https://via.placeholder.com/150'"
                    alt="Raffle Banner"
                    class="w-full rounded-lg shadow-md"
                />
            </div>

            <!-- Mechanics -->
            <div class="mt-6">
                <h2 class="text-2xl font-bold">Mechanics</h2>
                <p class="text-gray-700" v-if="raffle.mechanics" v-html="raffle.mechanics"></p>
                <p v-else class="text-gray-500">No mechanics available.</p>
            </div>

            <!-- Join Raffle Button -->
            <div class="mt-8 text-center">
                <button
                    class="px-6 py-3 bg-blue-600 text-white rounded-lg shadow-md hover:bg-blue-700 transition"
                    @click="joinRaffle"
                    :disabled="isJoining"
                >
                    {{ isJoining ? 'Joining...' : 'JOIN RAFFLE' }}
                </button>
            </div>
        </template>
    </div>
</template>

<script setup>
import Swal from 'sweetalert2';
import { ref, onMounted } from 'vue';
import { useRoute } from 'vue-router';
import axios from 'axios';

const route = useRoute();
const raffle = ref(null); // Initialize as null to handle loading state
const isJoining = ref(false);

// Fetch Raffle Details
const fetchRaffleDetails = async () => {
    try {
        const response = await axios.get(`/api/raffles/${route.params.id}/show`);

        // ✅ Fix: Extract the first item from the array
        if (response.data.length > 0) {
            raffle.value = response.data[0];
        } else {
            raffle.value = null;
        }
    } catch (error) {
        console.error("Error fetching raffle details:", error);
    }
};

// Function to Join the Raffle
const joinRaffle = async () => {
    isJoining.value = true;

    try {
        const response = await axios.post('/api/raffles/join', {
            raffle_id: route.params.id
        });

        Swal.fire({
            title: "Success!",
            text: response.data.message,
            icon: "success",
        });
    } catch (error) {
        Swal.fire({
            title: "Error",
            text: error.response?.data?.message || "Something went wrong!",
            icon: "error",
        });
    } finally {
        isJoining.value = false;
    }
};

// Fetch Data on Mount
onMounted(() => {
    fetchRaffleDetails();
});
</script>
