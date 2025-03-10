<template>
    <Header />
    <Sidebar />
    <div class="w-full lg:ps-64 bg-[#f7f9fa]">
        <div class="p-4 sm:p-6 space-y-4 sm:space-y-6">
            <div>
                <h1 class="text-2xl font-bold text-blue-500">Merchant List</h1>
                <p class="text-gray-500">View and manage all pending merchants</p>

                <!-- Total Merchants -->
                <div class="bg-blue-100 text-blue-600 text-3xl font-bold p-4 rounded-lg mt-4">
                    {{ merchantCount }} Pending Merchants
                </div>

                <!-- Add Merchant Button -->
                <div class="mt-4">
                    <router-link to="/administrator/merchant/register" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                        + Add Merchant
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
            merchantCount: 0,
            columns: [
                { label: 'Merchant Name', key: 'merchant_name' },
                { label: 'Business Name', key: 'business_name' },
                { label: 'Business Category', key: 'business_category' },
                { label: 'Business Sub Category', key: 'business_sub_category' },
                { label: 'Email', key: 'email' },
                { label: 'Contact Number', key: 'contact' },
                { label: 'Address', key: 'address' },
                { label: 'Actions', key: 'actions' } // Approve button lang ang nasa actions
            ],
            tableData: [],
        };
    },
    methods: {
        async fetchMerchants() {
            try {
                const response = await axios.get('/api/merchants-archive');
                if (Array.isArray(response.data)) {
                    this.tableData = response.data;
                    this.merchantCount = response.data.length;
                } else {
                    console.error('Invalid data format:', response.data);
                }
            } catch (error) {
                console.error('Error fetching merchants:', error);
            }
        },

        confirmApproval(userId) {
            Swal.fire({
                title: 'Approve Merchant?',
                text: 'Are you sure you want to approve this merchant?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Approve',
                cancelButtonText: 'Cancel'
            }).then(async (result) => {
                if (result.isConfirmed) {
                    this.approveMerchant(userId);
                }
            });
        },

        async approveMerchant(userId) {
            try {
                await axios.patch(`/api/merchant/${userId}/status/approve`, { status: 1 });

                Swal.fire({
                    title: 'Approved!',
                    text: 'Merchant has been approved successfully.',
                    icon: 'success',
                    confirmButtonText: 'OK'
                });

                this.fetchMerchants(); // Refresh table
            } catch (error) {
                console.error('Error approving merchant:', error);

                Swal.fire({
                    title: 'Error!',
                    text: 'Failed to approve merchant.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            }
        }
    },
    mounted() {
        this.fetchMerchants();
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
