<template>

    <div class="grid lg:grid-cols-2 gap-1 sm:gap-6">
        <!-- Card -->
        <div
            class="p-4 md:p-5 min-h-[210px] flex flex-col bg-white border shadow-sm rounded-xl dark:bg-neutral-800 dark:border-neutral-700">
            <!-- Header -->
            <div class="flex justify-between items-center">
                <div>
                    <h2 class="text-1xl sm:text-1xl font-medium text-gray-800 dark:text-neutral-200">
                        Current Discount
                    </h2>
                </div>

                <div>
                    <div class="py-[5px] px-1.5 inline-flex items-center gap-x-1 text-xs font-medium rounded-md ">
                        <button type="button"
                            class="py-2 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                            Update
                        </button>

                    </div>
                </div>
            </div>
            <!-- End Header -->
            <div class="mt-1 py-5 px-6  flex flex-col  items-start gap-x-2 bg-[#f0f6ff]  rounded-lg">
                <h3 class="text-xl sm:text-4xl font-medium text-blue-800 dark:text-neutral-200">
                    {{ authStore.user.discount }}% OFF
                </h3>
                <p class="mt-1 text-gray-500 dark:text-neutral-400">
                    on all product and services
                </p>

            </div>

            <!-- End  -->

            <!-- start  -->
            <!-- <div class="p-4 md:p-2 flex flex-col">
                <h3 class="text-2lg font-bold text-gray-800 dark:text-white">
                    Valid Until
                </h3>

                <p class="mt-1 text-gray-500 dark:text-neutral-400">
                    January, 29, 2026
                </p>

            </div> -->


            <!-- end -->
        </div>
        <!-- End Card -->


        <!-- Card -->
        <div
            class="p-4 md:p-5 min-h-[210px] flex flex-col bg-white border shadow-sm rounded-xl dark:bg-neutral-800 dark:border-neutral-700">
            <!-- Header -->
            <div class="flex justify-between items-center">
                <div>
                    <h2 class="text-1xl sm:text-1xl font-medium text-gray-800 dark:text-neutral-200">
                        Active Engagements
                    </h2>
                </div>


            </div>
            <!-- End Header -->
            <div class="mt-3 py-5 px-6 border flex flex-col  items-start gap-x-2 rounded-lg">

                <div class="mb-2 flex flex-col " >

                    <div v-for="raffle in activeRaffles" :key="raffle.id" >

                    <h3 class="text-1sm font-semibold text-gray-800 dark:text-white">{{ raffle.title }}</h3>
                    <span class="text-sm text-gray-500 dark:text-white"> {{ raffle.draw_date  }} Ends 3 days</span>
                </div>
            </div>

                <div class="flex w-full h-2 bg-gray-200 rounded-full overflow-hidden dark:bg-neutral-700"
                    role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                    <div class="flex flex-col justify-center rounded-full overflow-hidden bg-blue-600 text-xs text-white text-center whitespace-nowrap transition duration-500 dark:bg-blue-500"
                        style="width: 25%"></div>
                </div>


                <div class="mb-2 flex flex-col ">
                    <span class="text-sm text-gray-500 dark:text-white">750 Participants</span>
                </div>
                <!-- End Progress -->

            </div>

            <!-- End  -->

            <!-- End Header -->
            <!-- <div class="mt-3 py-5 px-6 border flex flex-col  items-start gap-x-2 rounded-lg">

                <div class="mb-2 flex flex-col ">
                    <h3 class="text-1sm font-semibold text-gray-800 dark:text-white">Weekend Flash Sale</h3>
                    <span class="text-sm text-gray-500 dark:text-white">Start in 2 days</span>
                    <span class=" mt-2 text-sm text-gray-500 dark:text-white">30% OFF on all Servicxes</span>

                </div>

            </div> -->
        </div>
        <!-- End Card -->
    </div>


</template>

<script>
import { useAuthStore } from "@/Stores/auth";
import { ref, computed, onMounted } from "vue";
import axios from "axios";

export default {
    setup() {
        const authStore = useAuthStore();
        const raffles = ref([]);
        const participants = ref([]);

        // Computed property para sa active raffles
        const activeRaffles = computed(() => {
            return raffles.value.filter(raffle => raffle.status === 0);
        });

        // Fetch raffles function
        const fetchRaffles = async () => {
            try {
                const response = await axios.get('/api/raffles');
                raffles.value = response.data;

                // Fetch participants kung may raffle na
                if (raffles.value.length > 0) {
                    fetchParticipants(raffles.value[0].id);
                }
            } catch (error) {
                console.error("Error fetching raffles:", error);
            }
        };

        // Fetch participants function
        const fetchParticipants = async (raffleId) => {
            try {
                const response = await axios.get(`/api/raffles/${raffleId}/participants`);
                participants.value = response.data;
            } catch (error) {
                console.error("Error fetching participants:", error);
            }
        };

        onMounted(fetchRaffles);

        return {
            authStore,
            raffles,
            participants,
            activeRaffles,
        };
    }
};
</script>
