<template>
    <Header />
    <Sidebar />
    <!-- Content -->
    <div class="w-full lg:ps-64 bg-[#f7f9fa]">
        <div class="p-4 sm:p-6 space-y-4 sm:space-y-6">
            <div>
                <h1 class="text-2xl font-bold text-blue-500">Create Raffle</h1>
                <p class="text-gray-500">View and manage all Raffle Draw</p>


            </div>

            <div class="flex flex-col items-center justify-center h-screen bg-gray-50 p-6">
                <!-- Icon -->
                <div class="mb-6">
                    <img src="/storage/img/create.png" alt="Empty Box" class="w-32">
                </div>

                <!-- Title & Description -->
                <h2 class="text-2xl font-semibold text-gray-900">No Active Raffles</h2>
                <p class="text-gray-500 text-center max-w-md mt-2">
                    You haven’t set up any discounts yet. Create your first store-wide discount to start attracting more
                    customers.
                </p>

                <!-- Create Raffle Button -->
                <router-link to="/merchant/raffle/register"
                    class="mt-6 bg-blue-600 text-white px-6 py-3 rounded-lg flex items-center gap-2 hover:bg-blue-700 transition">
                    <span class="text-xl">➕</span> Create Raffles
                </router-link>

                <!-- Quick Guide -->
                <div class="mt-8 w-full max-w-md">
                    <h3 class="text-lg font-semibold text-gray-800 mb-3">Quick Guide</h3>

                    <div class="bg-white shadow-sm rounded-lg p-4 flex items-center gap-4 mb-3">
                        <span class="text-blue-600 text-2xl">%</span>
                        <div>
                            <p class="font-medium text-gray-900">Set Discount Value</p>
                            <p class="text-sm text-gray-500">Choose a percentage discount that applies store-wide.</p>
                        </div>
                    </div>

                    <div class="bg-white shadow-sm rounded-lg p-4 flex items-center gap-4 mb-3">
                        <span class="text-blue-600 text-2xl">🕒</span>
                        <div>
                            <p class="font-medium text-gray-900">Define Validity</p>
                            <p class="text-sm text-gray-500">Set operating hours and promotion period.</p>
                        </div>
                    </div>

                    <div class="bg-white shadow-sm rounded-lg p-4 flex items-center gap-4">
                        <span class="text-blue-600 text-2xl">ℹ️</span>
                        <div>
                            <p class="font-medium text-gray-900">Add Details</p>
                            <p class="text-sm text-gray-500">Include description and terms & conditions.</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- End Content -->
</template>

<script>
import Header from '@/Layout/Dashboard/header.vue';
import Sidebar from '@/Layout/Sidebar/merchantSidebar.vue';
import Table from '@/Layout/Dashboard/Merchant/Discount/table.vue';

export default {
    components: {
        Header,
        Sidebar,
        Table,

    }
}

</script>
