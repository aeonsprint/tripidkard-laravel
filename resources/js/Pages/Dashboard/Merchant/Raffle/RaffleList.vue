<template>
    <Header />
    <Sidebar />
    <div class="w-full lg:ps-64 bg-[#f7f9fa]">
      <div class="p-4 sm:p-6 space-y-4 sm:space-y-6">
        <div class="flex justify-end mb-4">
          <button class="px-4 py-2 border rounded-md text-red-700 hover:bg-red-100 mr-2">Delete</button>
          <button class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Edit</button>
        </div>

        <!-- Raffle Details -->
        <div v-if="activeRaffles.length > 0">
          <div v-for="raffle in activeRaffles" :key="raffle.id" class="max-w-5xl mx-auto p-6 bg-white shadow-md rounded-lg">
            <h2 class="text-2xl font-semibold mb-4">{{ raffle.title }}</h2>

            <!-- Info Grid -->
            <div class="grid grid-cols-5 gap-4 text-center mb-6">
                <div class="flex flex-col items-center">
                    <i class="fa-solid fa-trophy text-blue-500 text-2xl"></i>
                    <p class="text-sm text-gray-500">No. of Winners</p>
                    <p class="font-medium">{{ raffle.total_winner }}</p>
                </div>
                <div class="flex flex-col items-center">
                    <i class="fa-solid fa-gift text-blue-500 text-2xl"></i>
                    <p class="text-sm text-gray-500">Prize</p>
                    <p class="font-medium">{{ raffle.prize }}</p>
                </div>
                <div class="flex flex-col items-center">
                    <i class="fa-solid fa-calendar-day text-blue-500 text-2xl"></i>
                    <p class="text-sm text-gray-500">Draw Date</p>
                    <p class="font-medium">{{ raffle.draw_date }}</p>
                </div>
                <div class="flex flex-col items-center">
                    <i class="fa-solid fa-hourglass-end text-blue-500 text-2xl"></i>
                    <p class="text-sm text-gray-500">Entries Deadline</p>
                    <p class="font-medium">{{ raffle.entries_deadline }}</p>
                </div>
                <div class="flex flex-col items-center">
                    <i class="fa-solid fa-hourglass-end text-blue-500 text-2xl"></i>
                    <p class="text-sm text-gray-500">Draw Date</p>
                    <p class="font-medium">{{ raffle.draw_date }}</p>
                </div>
            </div>

            <!-- Raffle Image -->
            <div class="mb-6">
                <img :src="getImageUrl(raffle.image)" alt="Raffle Image" class="w-full rounded-lg shadow">
            </div>

            <!-- Mechanics -->
            <div class="border rounded-lg p-4 bg-gray-100 text-sm">
                <h3 class="font-semibold mb-2">Mechanics</h3>
                <p class="text-gray-600"  v-html="raffle.mechanics"></p>
            </div>

            <!-- Participants Table -->
            <div class="mt-8">
                <h3 class="text-lg font-semibold mb-4">Participants</h3>
                <Table :tableData="participants" :columns="participantColumns" />
            </div>

          </div>
        </div>
        <div v-else class="text-center text-gray-500">No active raffles available.</div>
      </div>
    </div>
</template>

<script>
import Header from '@/Layout/Dashboard/header.vue';
import Sidebar from '@/Layout/Sidebar/merchantSidebar.vue';
import Table from '@/Layout/table.vue';
import axios from 'axios';

export default {
  components: {
    Header,
    Sidebar,
    Table,
  },
  data() {
    return {
      raffles: [],
      participants: [], // Participants list
      columns: [
        { label: 'Name', key: 'name' },
        { label: 'Age', key: 'age' },
        { label: 'Address', key: 'address' }
      ],
      participantColumns: [
        { label: 'Customer Name', key: 'customer_name' },
        { label: 'Joined Date', key: 'joined_at' }
      ]
    };
  },
  computed: {
    activeRaffles() {
      return this.raffles.filter(raffle => raffle.status === 0);
    }
  },
  methods: {
    async fetchRaffles() {
      try {
        const response = await axios.get('/api/raffles');
        this.raffles = response.data;

        // Fetch participants kapag nakuha na ang raffles
        if (this.raffles.length > 0) {
          this.fetchParticipants(this.raffles[0].id);
        }
      } catch (error) {
        console.error("Error fetching raffles:", error);
      }
    },
    async fetchParticipants(raffleId) {
      try {
        const response = await axios.get(`/api/raffles/${raffleId}/participants`);
        this.participants = response.data;
      } catch (error) {
        console.error("Error fetching participants:", error);
      }
    },
    getImageUrl(imagePath) {
      return imagePath ? `/storage/${imagePath}` : 'https://via.placeholder.com/750x400';
    }
  },
  mounted() {
    this.fetchRaffles();
  }
};
</script>
