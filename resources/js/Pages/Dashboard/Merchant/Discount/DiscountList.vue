<template>
    <Header />
    <Sidebar />
    <!-- Content -->
    <div class="w-full lg:ps-64 bg-[#f7f9fa]">
        <div class="p-4 sm:p-6 space-y-4 sm:space-y-6">
            <div>
                <h1 class="text-2xl font-bold text-blue-500">Flash Management</h1>
                <p class="text-gray-500">Manage your store-wide discount and promotions</p>

                <!-- Discount Percentage -->
                <div class="bg-blue-100 text-blue-600 text-3xl font-bold p-4 rounded-lg mt-4">
                    {{ discountPercentage }}%
                </div>
            </div>

            <!-- Discount Table -->
            <Table :tableData="tableData" :columns="columns" />
        </div>
    </div>
    <!-- End Content -->
</template>

<script>
import Header from '@/Layout/Dashboard/header.vue';
import Sidebar from '@/Layout/Sidebar/merchantSidebar.vue';
import Table from '@/Layout/table.vue';
import axios from 'axios';
import { useAuthStore } from "@/Stores/auth";

export default {
    components: {
        Header,
        Sidebar,
        Table,
    },

    data() {
        return {
            discountPercentage: 0, // Store discount percentage
            columns: [
                { label: 'Card Number', key: 'card_number' }, // Tama ang key name
                { label: 'Customer Name', key: 'customer_name' }, // Gamitin ang tamang key
                { label: 'Product Price', key: 'product_price' },
                { label: 'Discount', key: 'total_discount' } // Idagdag ang discount field
            ],
            tableData: [], // Initially empty, will be filled with API data
        };
    },
    methods: {
        async fetchDiscounts() {
            try {
                const response = await axios.get('/api/merchant/discounts');

                // Update data from API
                this.discountPercentage = response.data.percentage; // Update percentage
                this.tableData = response.data.discounts; // Update table data
            } catch (error) {
                console.error('Error fetching discounts:', error);
            }
        }
    },
    mounted() {
        this.fetchDiscounts(); // Fetch data when component is mounted
    }
}
</script>
