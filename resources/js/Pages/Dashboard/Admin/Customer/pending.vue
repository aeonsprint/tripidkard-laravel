<template>
    <Header />
    <Sidebar />
    <div class="w-full lg:ps-64 bg-[#f7f9fa]">
        <div class="p-4 sm:p-6 space-y-4 sm:space-y-6">
            <div>
                <h1 class="text-2xl font-bold text-blue-500">Customer Pending</h1>
                <p class="text-gray-500">View and manage all registered Customers</p>

                <!-- Total Customer -->
                <div class="bg-blue-100 text-blue-600 text-3xl font-bold p-4 rounded-lg mt-4">
                    {{ CustomerCount }} Customers
                </div>

                <!-- Add Customer Button -->
                <div class="mt-4">
                    <router-link to="/administrator/customer/register"
                        class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                        + Add Customer
                    </router-link>
                </div>
            </div>

            <!-- Table -->
            <Table :tableData="tableData" :columns="columns">
                <template v-slot:actions="{ row }">
                    <div class="flex items-center">
                        <!-- Edit Button with Icon -->
                        <button @click="goToEdit(row.user_id)"
                            class="flex items-center text-blue-600 hover:text-blue-800 bg-transparent border-2 border-blue-600 px-4 py-2 rounded-lg">
                            <i class="fas fa-edit mr-2"></i> Edit
                        </button>

                        <!-- Archive Button with Icon -->
                        <button @click="confirmArchive(row.user_id)"
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
            CustomerCount: 0,
            columns: [
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
                const response = await axios.get('/api/customer/pending');
                console.log("API Response:", response.data); // 🔍 Log API response

                if (Array.isArray(response.data)) {
                    this.tableData = response.data;
                    this.merchantCount = response.data.length;
                } else {
                    console.error('Invalid data format:', response.data);
                }
            } catch (error) {
                console.error('Error fetching Customer:', error);
            }
        },

        goToEdit(userId) {
            this.$router.push(`/customers/edit/${userId}`);
        },

        // Confirm archive action with SweetAlert2
        async confirmArchive(userId) {
            const result = await Swal.fire({
                title: 'Are you sure?',
                text: 'You are about to archive this Customer!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, archive it!',
                cancelButtonText: 'Cancel'
            });

            if (result.isConfirmed) {
                // Call the function to archive the Customer
                await this.archiveCustomer(userId, 5);
            }
        },

        async archiveCustomer(userId, status) {
            try {
                // Make your API call to archive the Customer
                await axios.patch(`/api/customer/${userId}/status/archive`, { status });

                // Show success SweetAlert after archiving
                Swal.fire({
                    title: 'Archived!',
                    text: 'The Customer has been archived successfully.',
                    icon: 'success',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'OK'
                });

                // Refresh the Customer list after archiving
                this.fetchCustomers();
            } catch (error) {
                console.error('Error archiving Customer:', error);
                Swal.fire({
                    title: 'Error!',
                    text: 'Failed to archive the Customer.',
                    icon: 'error',
                    confirmButtonColor: '#d33',
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
