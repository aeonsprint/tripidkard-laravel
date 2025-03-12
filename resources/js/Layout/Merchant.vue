<template>
    <div class="container sm:max-w-[100rem] lg:max-w-[80rem] mx-auto p-4">
        <div class="border rounded p-3 mb-3">
            <div class="flex justify-between items-center">
                <h1 class="text-lg font-bold text-gray-900 dark:text-neutral-100">
                    {{ title }}
                </h1>
                <div v-if="showSeeMore && !isMerchantListPage" class="text-sm text-gray-900 dark:text-neutral-100">
                    <router-link to="/merchant/list">See More</router-link>
                </div>
            </div>
        </div>

        <!-- Responsive Grid Layout -->
        <div class="grid grid-cols-1 xs:grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3">
            <div v-if="filteredMerchants.length === 0" class="col-span-full text-center">
                <div class="max-w-sm mx-auto shadow-lg">
                    <img src="/storage/img/not-found.png" class="w-full h-48 object-cover" alt="No Results" />
                    <div class="p-4">
                        <h5 class="font-bold">Hmmm, we didn’t find any merchants in your search.</h5>
                    </div>
                </div>
            </div>

            <div v-for="merchant in paginatedMerchants" :key="merchant.merchant_id" class="flex flex-col h-full">
                <div class="relative bg-white border rounded-xl shadow-sm overflow-hidden flex flex-col h-full">
                    <div class="relative">
                        <a :href="`/merchant/page/${merchant.merchant_id}`">
                            <img :src="merchant.avatar ? `/storage/${merchant.avatar}` : '/storage/img/logo.jpg'"
                                class="w-full h-40 sm:h-48 md:h-56 object-cover" alt="Merchant Avatar" />
                            <span v-if="merchant.discount"
                                class="absolute top-2 left-2 bg-blue-600 text-white text-xs font-bold px-2 py-1 rounded">
                                -{{ merchant.discount }}%
                            </span>
                        </a>

                        <!-- 🛠️ Move the bookmark button outside the <a> tag and add @click.stop -->
                        <button @click.stop="toggleBookmark(merchant)"
                            class="absolute top-2 right-2 bg-white p-2 rounded-full shadow-md">
                            <i class="fa fa-bookmark text-xl"
                                :class="{ 'text-yellow-500': merchant.isBookmarked, 'text-gray-500': !merchant.isBookmarked }">
                            </i>
                        </button>
                    </div>

                    <div class="p-4 flex flex-col flex-grow">
                        <a :href="`/merchant/page/${merchant.merchant_id}`" class="text-black">
                            <h5 class="font-bold text-gray-900 text-sm sm:text-base">{{ merchant.business_name ||
                                'Unknown Merchant' }}</h5>
                        </a>

                        <p class="text-xs sm:text-sm text-gray-600 flex items-center mt-1 min-h-[40px]">
                            <i class="fa fa-map-marker text-gray-400 mr-1"></i>
                            {{ merchant.city || 'Unknown City' }}, {{ merchant.province || 'Unknown Province' }}
                        </p>

                        <div class="flex justify-between items-center border-t pt-2 text-dark mt-2 flex-grow">
                            <span class="text-xs sm:text-sm text-gray-500">
                                {{ merchant.business_category || 'No Category' }} > {{ merchant.business_sub_category ||
                                'No Subcategory' }}
                            </span>
                            <div class="flex items-center space-x-2">
                                <i class="fa fa-heart cursor-pointer" @click="toggleHeart(merchant)"
                                    :class="{ 'text-red-500': merchant.isHearted, 'text-gray-500': !merchant.isHearted }">
                                </i>
                                <span class="text-xs sm:text-sm text-gray-600">{{ formatViews(merchant.views) }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pagination -->
        <div v-if="showPagination && isMerchantListPage"
            class="flex justify-center sm:justify-end items-center mt-4 bg-white p-2 rounded-lg">
            <button :disabled="currentPage === 1" @click="currentPage--"
                class="bg-white text-gray-800 px-4 py-2 rounded-lg hover:bg-blue-500 hover:text-white disabled:bg-gray-300 disabled:text-gray-500">
                Previous
            </button>
            <div class="flex justify-center items-center mx-2 sm:mx-4">
                <span v-for="page in totalPages" :key="page"
                    :class="{ 'bg-blue-500 text-white': currentPage === page, 'bg-white text-blue-500': currentPage !== page }"
                    @click="currentPage = page" class="cursor-pointer px-2 sm:px-4 py-1 sm:py-2 mx-1 rounded-lg">
                    {{ page }}
                </span>
            </div>
            <button :disabled="currentPage === totalPages" @click="currentPage++"
                class="bg-white text-gray-800 px-4 py-2 rounded-lg hover:bg-blue-500 hover:text-white disabled:bg-gray-300 disabled:text-gray-500">
                Next
            </button>
        </div>
    </div>
</template>

<script setup>
import axios from "axios";
import { ref, computed, onMounted, watch, defineEmits, defineProps } from "vue";
import { useRoute } from "vue-router";
import { useAuthStore } from "@/stores/auth";

const props = defineProps({
    itemsPerPage: { type: Number, default: 20 },
    title: { type: String, default: "Merchants Deals and Discounts" },
    showSeeMore: { type: Boolean, default: true },
    showPagination: { type: Boolean, default: true }
});

const emit = defineEmits(["updateMerchantCount"]); // <-- Emit event
const route = useRoute();
const isMerchantListPage = computed(() => route.path === "/merchant/list");
const merchants = ref([]);
const searchQuery = ref(route.query.discount || "");
const currentPage = ref(1);
const user = ref(null);
const bookmarkedMerchants = ref(new Set());
const likedMerchants = ref(new Set());
const authStore = useAuthStore();


const getUserLikes = async () => {
    if (!user.value) return;

    try {
        const response = await axios.get("/api/likes");
        likedMerchants.value = new Set(response.data.map(like => like.merchant_id));

        // Update each merchant's isHearted status
        merchants.value.forEach(merchant => {
            merchant.isHearted = likedMerchants.value.has(merchant.merchant_id);
        });
    } catch (error) {
        console.error("Error fetching likes:", error);
    }
};



const getUserBookmarks = async () => {
    if (!user.value) return;

    try {
        const response = await axios.get("/api/bookmarks");
        bookmarkedMerchants.value = new Set(response.data.map(bookmark => bookmark.merchant_id));

        merchants.value.forEach(merchant => {
            merchant.isBookmarked = bookmarkedMerchants.value.has(merchant.merchant_id);
        });
    } catch (error) {
        console.error("Error fetching bookmarks:", error);
    }
};

const getMerchants = async () => {
    try {
        const response = await axios.get("/api/merchants", {
            params: {
                category: route.query.category,
                province: route.query.province,
                city: route.query.city,
                discount: searchQuery.value
            }
        });
        merchants.value = Array.isArray(response.data) ? response.data : [];

        merchants.value.forEach(merchant => {
            merchant.isBookmarked = bookmarkedMerchants.value.has(merchant.merchant_id);
        });

        emit("updateMerchantCount", merchants.value.length); // <-- Emit merchant count
    } catch (error) {
        console.error("Error fetching merchants:", error);
    }
};

const toggleHeart = async (merchant) => {
    if (!user.value) {
        return (window.location.href = "/login");
    }

    try {
        if (merchant.isHearted) {
            await axios.delete(`/api/likes/${merchant.merchant_id}`);
            likedMerchants.value.delete(merchant.merchant_id);
        } else {
            await axios.post("/api/likes", { merchant_id: merchant.merchant_id });
            likedMerchants.value.add(merchant.merchant_id);
        }

        merchant.isHearted = !merchant.isHearted;
    } catch (error) {
        console.error("Error toggling heart:", error);
    }
};


const toggleBookmark = async (merchant) => {
    if (!user.value) {
        return (window.location.href = "/login");
    }

    try {
        if (merchant.isBookmarked) {
            await axios.delete(`/api/bookmarks/${merchant.merchant_id}`);
            bookmarkedMerchants.value.delete(merchant.merchant_id);
        } else {
            await axios.post("/api/bookmarks", { merchant_id: merchant.merchant_id });
            bookmarkedMerchants.value.add(merchant.merchant_id);
        }

        merchant.isBookmarked = !merchant.isBookmarked;
    } catch (error) {
        console.error("Error toggling bookmark:", error);
    }
};

onMounted(() => {
    authStore.getUser();
    user.value = authStore.user;
    getMerchants();
});

const filteredMerchants = computed(() => merchants.value);
const totalPages = computed(() => Math.ceil(filteredMerchants.value.length / props.itemsPerPage));
const paginatedMerchants = computed(() => {
    const start = (currentPage.value - 1) * props.itemsPerPage;
    return filteredMerchants.value.slice(start, start + props.itemsPerPage);
});

const formatViews = (num) => {
    if (num >= 1000000) {
        return (num / 1000000).toFixed(1).replace(/\.0$/, '') + 'M';
    } else if (num >= 1000) {
        return (num / 1000).toFixed(1).replace(/\.0$/, '') + 'K';
    }
    return num;
};

</script>
