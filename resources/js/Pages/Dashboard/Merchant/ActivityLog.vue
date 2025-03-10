<template>
    <Header />
    <Sidebar />
    <!-- Content -->
    <div class="w-full lg:ps-64 bg-[#f7f9fa]">
        <div class="p-4 sm:p-6 space-y-4 sm:space-y-6">
            <div>
                <h1 class="text-2xl font-semibold text-blue-600">Activity Log</h1>
                <p class="text-gray-600">Keep track of your store's work history and activities.</p>
            </div>

            <!-- Table Component -->
            <Table :tableData="tableData" :columns="columns" />
        </div>
    </div>
</template>

<script>
import Header from '@/Layout/Dashboard/header.vue';
import Sidebar from '@/Layout/Sidebar/merchantSidebar.vue';

import Table from '@/Layout/table.vue';
import axios from 'axios';
import dayjs from 'dayjs';
import relativeTime from 'dayjs/plugin/relativeTime';
import customParseFormat from 'dayjs/plugin/customParseFormat';

dayjs.extend(relativeTime); // Enable relative time formatting
dayjs.extend(customParseFormat); // Support for custom formats

export default {
    components: {
        Header,
        Sidebar,
        Table,
    },
    data() {
        return {
            columns: [
                { label: 'Date', key: 'formatted_date' },
                { label: 'Time Ago', key: 'time_ago' },
                { label: 'User', key: 'causer_name' },
                { label: 'Role', key: 'role' },
                { label: 'Activity', key: 'description' }
            ],
            tableData: [],
        };
    },
    methods: {
        async fetchActivityLogs() {
            try {
                const response = await axios.get('/api/activity-logs');

                // Format data for table display
                this.tableData = response.data.map(log => ({
                    formatted_date: dayjs(log.created_at).format('YYYY-MM-DD h:mm A'), // 12-hour format with AM/PM
                    time_ago: dayjs(log.created_at).fromNow(), // Relative time (e.g., "5 minutes ago")
                    causer_name: log.causer ? `${log.causer.fname} ${log.causer.lname}` : 'System',
                    role: log.properties?.role || 'N/A',
                    description: log.description
                }));
            } catch (error) {
                console.error('Error fetching activity logs:', error);
            }
        }
    },
    mounted() {
        this.fetchActivityLogs(); // Fetch logs on component mount
    }
};
</script>
