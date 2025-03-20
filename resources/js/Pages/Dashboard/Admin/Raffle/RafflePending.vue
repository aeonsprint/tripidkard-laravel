<template>
    <Header />
    <Sidebar />
    <div class="w-full lg:ps-64 bg-[#f7f9fa]">
        <div class="p-4 sm:p-6 space-y-4 sm:space-y-6">

            <!-- Raffle List Table -->
            <div class="mt-8">
                <h3 class="text-lg font-semibold mb-4">Active Raffles</h3>
                <Table :tableData="activeRaffles" :columns="columns">
                    <template v-slot:actions="{ row }">
                        <div class="flex items-center">
                            <!-- Approve Button -->
                            <button @click="confirmAction(row.id, 'approve')"
                                class="flex items-center text-green-600 hover:text-green-800 bg-transparent border-2 border-green-600 px-4 py-2 rounded-lg ms-2">
                                <i class="fas fa-check mr-2"></i> Approve
                            </button>
                            <!-- Archive Button -->
                            <button @click="confirmAction(row.id, 'archive')"
                                class="flex items-center text-red-600 hover:text-red-800 bg-transparent border-2 border-red-600 px-4 py-2 rounded-lg ms-2">
                                <i class="fas fa-archive mr-2"></i> Archive
                            </button>
                        </div>
                    </template>
                </Table>
            </div>

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
            raffles: [],
            columns: [
                { label: 'Raffle Title', key: 'title' },
                { label: 'Prize', key: 'prize' },
                { label: 'No. of Winners', key: 'total_winner' },
                { label: 'Entries Deadline', key: 'entries_deadline' },
                { label: 'Draw Date', key: 'draw_date' },
                { label: 'Actions', key: 'actions' }
            ],
        };
    },
    computed: {
        // Filter raffles with status = 0
        activeRaffles() {
            return this.raffles.filter(raffle => raffle.status === 0);
        }
    },
    methods: {
        async fetchRaffles() {
            try {
                const response = await axios.get('/api/raffles');
                this.raffles = response.data;
            } catch (error) {
                console.error("Error fetching raffles:", error);
            }
        },

        confirmAction(raffleId, action) {
            let status = action === "approve" ? 1 : 5;
            let actionText = action === "approve" ? "approve this raffle" : "archive this raffle";

            Swal.fire({
                title: "Are you sure?",
                text: `Do you really want to ${actionText}?`,
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: action === "approve" ? "#28a745" : "#d33",
                cancelButtonColor: "#6c757d",
                confirmButtonText: action === "approve" ? "Yes, Approve" : "Yes, Archive",
                cancelButtonText: "Cancel"
            }).then((result) => {
                if (result.isConfirmed) {
                    this.updateRaffleStatus(raffleId, status);
                }
            });
        },

        async updateRaffleStatus(raffleId, status) {
            try {
                await axios.put(`/api/raffles/${raffleId}/update-status`, { status });

                // Show success alert
                Swal.fire({
                    title: "Success!",
                    text: status === 1 ? "Raffle has been approved." : "Raffle has been archived.",
                    icon: "success",
                    timer: 2000,
                    showConfirmButton: false
                });

                this.fetchRaffles(); // Refresh list
            } catch (error) {
                console.error("Error updating raffle:", error);
                Swal.fire({
                    title: "Error!",
                    text: "Something went wrong. Please try again.",
                    icon: "error"
                });
            }
        },
    },
    mounted() {
        this.fetchRaffles();
    }
};
</script>
