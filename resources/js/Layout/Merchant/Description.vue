<template>
    <div class="max-w-[70rem] px-4 py-10 sm:px-6 lg:px-1 lg:py-14 mx-auto">
        <div class="lg:grid lg:grid-cols-12 lg:gap-16 lg:items-center">
            <!-- Merchant Info -->
            <div class="lg:col-span-7">
                <div class="space-y-6 sm:space-y-8">
                    <div class="space-y-2 md:space-y-4">
                        <h2 class="font-bold text-3xl lg:text-4xl text-gray-800 dark:text-neutral-200">
                            {{ merchant.business_name || "No Business Name Provided" }}
                        </h2>
                        <p class="text-gray-500 dark:text-neutral-500">
                            {{ merchant.description || "No description available for this merchant." }}
                        </p>
                    </div>
                </div>
            </div>
            <!-- End Merchant Info -->

            <!-- Raffle Card (Show only if raffles exist) -->
            <div v-if="raffles.length" class="mt-5 sm:mt-10 lg:mt-0 lg:col-span-5">
                <div v-for="raffle in raffles" :key="raffle.id"
                    class="relative flex flex-row bg-white shadow-md rounded-lg w-full overflow-hidden items-center mb-4">

                    <!-- Image (Occupies full height) -->
                    <div class="w-1/3 h-full">
                        <img :src="raffle.image ? `/storage/${raffle.image}` : defaultRaffleImage"
                            alt="raffle-image"
                            class="w-full h-full object-cover">
                    </div>

                    <!-- Raffle Details -->
                    <div class="p-4 flex flex-col justify-between w-2/3">
                        <h6 class="text-gray-900 text-md font-bold">
                            {{ raffle.title || "No Title Available" }}
                        </h6>
                        <p class="text-gray-500 text-sm">
                            Entries Deadline {{ raffle.entries_deadline || "N/A" }}
                        </p>

                        <!-- Join Now Button -->
                        <a  :href="`/raffle/details/${raffle.id}`"
                            class="mt-3 w-fit rounded-md bg-blue-600 py-2 px-4 text-center text-sm text-white transition-all shadow-md hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-800">
                            Join Now
                    </a>
                    </div>
                </div>
            </div>
            <!-- End Raffle Card -->
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import { useRoute } from 'vue-router';
import axios from 'axios';

const route = useRoute();
const merchant = ref({});
const raffles = ref([]);
const defaultRaffleImage = "/storage/img/logo.jpg"; // Placeholder image

// Fetch merchant data
const fetchMerchant = async () => {
    try {
        const response = await axios.get(`/api/merchants/${route.params.merchant_id}/edit`);
        merchant.value = response.data;
    } catch (error) {
        console.error("Error fetching merchant data:", error);
    }
};

// Fetch raffles data
const fetchRaffles = async () => {
    try {
        const response = await axios.get(`/api/raffles/${route.params.merchant_id}/edit`); // Change endpoint kung may filter per merchant
        merchant.value = response.data;
        raffles.value = response.data.raffles || []; // ✅ Kunin ang raffles mula sa merchant response
    } catch (error) {
        console.error("Error fetching raffles:", error);
    }
};

onMounted(() => {
    fetchMerchant();
    fetchRaffles();
});
</script>
