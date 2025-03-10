<template>
    <Header />
    <Sidebar />
    <div class="w-full lg:ps-64 bg-[#f7f9fa]">
        <div class="p-4 sm:p-6 space-y-4 sm:space-y-6">
            <div>
                <h1 class="text-2xl font-bold text-blue-500">Customer Archive</h1>
                <p class="text-gray-500">View and manage all Archive Customers</p>

                <!-- Total Customer -->
                <div class="bg-blue-100 text-blue-600 text-3xl font-bold p-4 rounded-lg mt-4">
                    {{ customerCount }} Archived Cuatomers
                </div>

                <!-- Add Customer Button -->
                <div class="mt-4">
                    <router-link to="/customers/add"
                        class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                        + Add Customer
                    </router-link>
                </div>
            </div>

            <!-- Table -->
            <Table :tableData="tableData" :columns="columns">
                <template v-slot:actions="{ row }">
                    <div class="flex items-center">
                        <!-- Approve Button -->
                        <button @click="confirmApproval(row.user_id)"
                            class="flex items-center text-green-600 hover:text-green-800 border-2 border-green-600 px-4 py-2 rounded-lg ms-2">
                            <i class="fas fa-check mr-2"></i> Approve
                        </button>
                    </div>
                </template>
            </Table>
        </div>
    </div>
</template>

<script>
import Header from '@/Layout/Dashboard/header.vue';
import Sidebar from '@/Layout/Sidebar/adminSidebar.vue';

import Table from '@/Layout/table.vue';
import axios from 'axios';
import Swal from 'sweetalert2';

export default {
    components: {
        Header,
        Sidebar,
        Table,
    },
    data() {
        return {
            CuatomerCount: 0,
            columns: [
            { label: 'Card Number', key: 'customer_card_num' },
                { label: 'Customer Name', key: 'customer_name' },
                { label: 'Contact No.', key: 'contact' },
                { label: 'Email Address', key: 'email' },
                { label: 'Address', key: 'address' },
                { label: 'Actions', key: 'actions' } // Added Actions Column
            ],
            tableData: [],
        };
    },
    methods: {
        async fetchCustomers() {
            try {
                const response = await axios.get('/api/customers/archive'); // 🌟 Updated API endpoint
                console.log("API Response:", response.data); // 🔍 Log API response


                if (Array.isArray(response.data)) {
                    this.tableData = response.data;
                    this.customerCount = response.data.length;
                } else {
                    console.error('Invalid data format:', response.data);
                }
            } catch (error) {
                console.error('Error fetching Customers:', error);
            }
        },

        confirmApproval(userId) {
            Swal.fire({
                title: 'Approve Customer?',
                text: 'Are you sure you want to approve this Customer?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Approve',
                cancelButtonText: 'Cancel'
            }).then(async (result) => {
                if (result.isConfirmed) {
                    this.approveCustomer(userId);
                }
            });
        },

        async approveCustomer(userId) {
            try {
                await axios.patch(`/api/customer/${userId}/status/approve`, { status: 1 });

                Swal.fire({
                    title: 'Approved!',
                    text: 'Customer has been approved successfully.',
                    icon: 'success',
                    confirmButtonText: 'OK'
                });

                this.fetchCustomers(); // Refresh table
            } catch (error) {
                console.error('Error approving Customer:', error);

                Swal.fire({
                    title: 'Error!',
                    text: 'Failed to approve Customer.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            }
        }
    },
    mounted() {
        this.fetchCustomers();
    }
}
</script>

<style scoped>
/* Ensure buttons are aligned next to each other */
button {
    display: inline-flex;
    align-items: center;
    justify-content: center;
}

button i {
    margin-right: 0.5rem;
}
</style>
