<template>
    <Header />
    <Sidebar />
    <!-- Content -->
    <div class="lg:ps-64 bg-[#f7f9fa] min-h-screen flex items-center justify-center">
        <div class="max-w-3xl w-full bg-white p-8 rounded-xl shadow-lg">

            <!-- Header -->
            <div class="mb-6 text-center">
                <h1 class="text-3xl font-bold text-blue-500">Flash Discount Management</h1>
                <p class="text-gray-500">Manage store-wide discount and promotions with ease.</p>
            </div>

            <!-- Discount Percentage (Dynamic from authUser) -->
            <div class="bg-blue-100 text-blue-600 text-4xl font-bold p-6 rounded-lg shadow-md text-center">
                {{ discount }}%
            </div>

            <!-- Customer Card Number Input -->
            <div class="mt-6">
                <label class="block text-gray-700 font-medium text-lg">Customer Card Number</label>
                <input type="text"
                    class="w-full p-3 border rounded-lg shadow-sm text-lg bg-gray-100 cursor-not-allowed"
                    v-model="cardNumber" disabled />
            </div>

            <!-- Price Input -->
            <div class="mt-4">
                <label class="block text-gray-700 font-medium text-lg">Price</label>
                <input type="number"
                    class="w-full p-3 border rounded-lg shadow-sm text-lg focus:outline-none focus:ring-2 focus:ring-orange-400"
                    v-model="price" placeholder="Enter price" min="1" />
            </div>

            <!-- Submit Button -->
            <button @click="submitDiscount"
                class="w-full bg-blue-600 text-white py-4 rounded-lg mt-6 font-medium text-lg hover:bg-blue-700 transition transform hover:scale-105 shadow-md">
                Apply Discount
            </button>

        </div>
    </div>
</template>
<script>
import { ref, computed, onMounted } from "vue";
import { useRouter } from "vue-router"; // Import useRouter
import Header from '@/Layout/Dashboard/header.vue';
import Sidebar from '@/Layout/Sidebar/merchantSidebar.vue';
import { useAuthStore } from "@/Stores/auth";
import Swal from "sweetalert2";
import { useRoute } from "vue-router";
import axios from "axios";

export default {
    components: {
        Header,
        Sidebar,
    },
    setup() {
        const authStore = useAuthStore();
        const authUser = computed(() => authStore.authUser || {});
        const route = useRoute();
        const router = useRouter(); // Initialize router

        const cardNumber = ref(route.params.card_number || "");
        const price = ref("");

        // Computed property para sa dynamic discount value
        const discount = computed(() => authUser.value.discount || 0);

        onMounted(async () => {
            await authStore.getUser();
        });

        const submitDiscount = async () => {
            if (!price.value || price.value <= 0) {
                Swal.fire("Error", "Please enter a valid price", "error");
                return;
            }

            try {
                const response = await axios.post("/api/discount/store", {
                    card_number: cardNumber.value,
                    discount: discount.value,
                    price: price.value,
                });

                if (response.data.success) {
                    Swal.fire({
                        title: "Success",
                        text: "Discount applied successfully!",
                        icon: "success",
                        timer: 2000,
                        showConfirmButton: false
                    }).then(() => {
                        router.push("/merchant/discount-list"); // Redirect to discount list
                        setTimeout(() => {
                            window.location.reload(); // Reload page after redirect
                        }, 50);
                    });

                    price.value = ""; // Clear form after success
                } else {
                    throw new Error(response.data.message || "Something went wrong");
                }
            } catch (error) {
                Swal.fire("Error", error.response?.data?.message || "An error occurred", "error");
            }
        };

        return {
            authUser,
            cardNumber,
            discount,
            price,
            submitDiscount,
        };
    },
};
</script>

<style>
body {
    background-color: #f9fafb;
}
</style>
