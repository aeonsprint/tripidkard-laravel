<template>
    <TopBar />
    <div class="flex w-full lg:ps-20 max-w-[80rem] bg-[#f7f9fa]">
        <Sidebar />
        <main class="flex-1 p-6">
            <h1 class="text-xl font-bold">Bookmark List</h1>
            <p class="text-gray-500">Your bookmarked merchants</p>

            <!-- Search Bar -->
            <div class="flex justify-between items-center my-4">
                <input
                    v-model="searchQuery"
                    type="text"
                    placeholder="Search..."
                    class="w-1/4 p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400"
                />
            </div>

            <div v-if="filteredBookmarks.length === 0" class="mt-4 text-gray-500">
                No bookmarks found.
            </div>

            <div v-for="bookmark in paginatedBookmarks" :key="bookmark.merchant_id" class="bg-white p-4 shadow rounded-lg mt-4">
                <div class="flex items-center">
                    <img v-if="bookmark.logo" :src="bookmark.logo" alt="Merchant Logo" class="w-16 h-16 rounded-full mr-4">
                    <Logo v-else alt="Default Logo" class="w-16 h-16 rounded-full mr-4" />

                    <div>
                        <!-- Merchant Name now links to the merchant page -->
                        <router-link
                            :to="`/merchant/page/${bookmark.merchant_id}`"
                            class="font-semibold text-lg text-blue-600 hover:underline"
                        >
                            {{ bookmark.business_name }}
                        </router-link>
                        <p class="text-sm text-gray-500">{{ bookmark.business_category }} - {{ bookmark.business_sub_category }}</p>
                    </div>
                </div>

                <div class="text-sm text-gray-600 mt-2">
                    <p>📍 {{ bookmark.street }}, {{ bookmark.city }}, {{ bookmark.province }}</p>
                    <p>⭐ Discount: <strong>{{ bookmark.discount || 'None' }}</strong></p>
                </div>

                <div class="mt-2 flex items-center space-x-4">
                    <a v-if="bookmark.website" :href="bookmark.website" target="_blank" class="text-blue-500 hover:underline">
                        🌐 Visit Website
                    </a>
                    <a v-if="bookmark.facebook" :href="bookmark.facebook" target="_blank" class="text-blue-500 hover:underline">
                        🔵 Facebook Page
                    </a>
                    <!-- View Merchant Button -->
                    <router-link
                        :to="`/merchant/page/${bookmark.merchant_id}`"
                        class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600"
                    >
                        View Merchant
                    </router-link>
                </div>
            </div>

            <!-- Pagination -->
            <div class="flex justify-end items-center mt-4 space-x-2">
                <button
                    @click="prevPage"
                    :disabled="currentPage === 1"
                    class="px-3 py-2 bg-gray-200 rounded-md hover:bg-gray-300 disabled:opacity-50"
                >
                    Prev
                </button>
                <button
                    v-for="page in totalPages"
                    :key="page"
                    @click="currentPage = page"
                    class="px-3 py-2 rounded-md"
                    :class="currentPage === page ? 'bg-blue-500 text-white' : 'bg-gray-200 hover:bg-gray-300'"
                >
                    {{ page }}
                </button>
                <button
                    @click="nextPage"
                    :disabled="currentPage === totalPages"
                    class="px-3 py-2 bg-gray-200 rounded-md hover:bg-gray-300 disabled:opacity-50"
                >
                    Next
                </button>
            </div>
        </main>
    </div>
    <Footer />
</template>

<script>
import Logo from '@/Components/Atoms/Logo.vue';
import Sidebar from '@/Components/Organisms/Customer/Sidebar.vue';
import TopBar from '@/Components/Organisms/TopBar.vue';
import Footer from '@/Components/Organisms/Footer.vue';
import axios from 'axios';

export default {
    components: {
        TopBar,
        Sidebar,
        Footer,
        Logo
    },
    data() {
        return {
            bookmarks: [],
            searchQuery: "",
            currentPage: 1,
            bookmarksPerPage: 5
        };
    },
    computed: {
        filteredBookmarks() {
            return this.bookmarks.filter(bookmark =>
                bookmark.business_name.toLowerCase().includes(this.searchQuery.toLowerCase())
            );
        },
        paginatedBookmarks() {
            const start = (this.currentPage - 1) * this.bookmarksPerPage;
            return this.filteredBookmarks.slice(start, start + this.bookmarksPerPage);
        },
        totalPages() {
            return Math.ceil(this.filteredBookmarks.length / this.bookmarksPerPage);
        }
    },
    async mounted() {
        await this.fetchBookmarks();
    },
    methods: {
        async fetchBookmarks() {
            try {
                const response = await axios.get('/api/merchant/bookmarks');
                console.log('API Response:', response.data);
                this.bookmarks = response.data;
            } catch (error) {
                console.error('Error fetching bookmarks:', error);
            }
        },
        prevPage() {
            if (this.currentPage > 1) this.currentPage--;
        },
        nextPage() {
            if (this.currentPage < this.totalPages) this.currentPage++;
        }
    }
};
</script>
