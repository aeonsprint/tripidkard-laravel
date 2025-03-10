<template>
    <Header />
    <Sidebar />
    <div class="w-full lg:ps-64 bg-[#f7f9fa]">
        <div class="p-4 sm:p-6 space-y-4 sm:space-y-6">
            <div>
                <h1 class="text-2xl font-bold text-blue-500">Merchant List</h1>
                <p class="text-gray-500">View and manage all registered merchants</p>

                <!-- Total Merchants -->
                <div class="bg-blue-100 text-blue-600 text-3xl font-bold p-4 rounded-lg mt-4">
                    {{ merchantCount }} Merchants
                </div>

                <!-- Add Merchant Button -->
                <div class="mt-4">
                    <router-link to="/administrator/merchant/register"
                        class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                        + Add Merchant
                    </router-link>
                </div>
            </div>

            <!-- Table -->
            <Table :tableData="tableData" :columns="columns">
                <template v-slot:actions="{ row }">
                    <div class="flex items-center">
                        <!-- Approve Button -->
                        <button @click="showApprovalModal(row.user_id)"
                            class="flex items-center text-green-600 hover:text-green-800 bg-transparent border-2 border-green-600 px-4 py-2 rounded-lg ms-2">
                            <i class="fas fa-check mr-2"></i> Approve
                        </button>
                        <!-- Archive Button -->
                        <button @click="showArchiveModal(row.user_id)"
                            class="flex items-center text-red-600 hover:text-red-800 bg-transparent border-2 border-red-600 px-4 py-2 rounded-lg ms-2">
                            <i class="fas fa-archive mr-2"></i> Archive
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
                { label: 'Actions', key: 'actions' }
            ],
            tableData: [],
        };
    },
    methods: {
        async fetchMerchants() {
            try {
                const response = await axios.get('/api/merchants-pending');
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

        async showApprovalModal(userId) {
            Swal.fire({
                title: 'Approve Merchant',
                text: 'Are you sure you want to approve this merchant?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Approve',
                cancelButtonText: 'Cancel'
            }).then(async (result) => {
                if (result.isConfirmed) {
                    await this.updateMerchantStatus(userId, 'approve');
                }
            });
        },

        async showArchiveModal(userId) {
            Swal.fire({
                title: 'Archive Merchant',
                text: 'Are you sure you want to archive this merchant?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Archive',
                cancelButtonText: 'Cancel'
            }).then(async (result) => {
                if (result.isConfirmed) {
                    await this.updateMerchantStatus(userId, 'archive');
                }
            });
        },

        async updateMerchantStatus(userId, action) {
            const endpoint = action === 'approve'
                ? `/api/merchant/${userId}/status/approve`
                : `/api/merchant/${userId}/status/archive`; // Dati mali ang merchantId, dapat userId

            const status = action === 'approve' ? 1 : 5;

            try {
                await axios.patch(endpoint, { status });

                // Gumamit ng SweetAlert para sa success message
                Swal.fire({
                    title: action === 'approve' ? 'Approved!' : 'Archived!',
                    text: `Merchant has been ${action === 'approve' ? 'approved' : 'archived'} successfully.`,
                    icon: 'success',
                    confirmButtonText: 'OK'
                });

                this.fetchMerchants(); // Tama na ito para mag-refresh ng table
            } catch (error) {
                console.error(`Error updating merchant status:`, error);

                Swal.fire({
                    title: 'Error!',
                    text: `Failed to ${action} merchant.`,
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
