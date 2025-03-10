<template>
    <Header />
    <Sidebar />
    <div class="w-full lg:ps-64 bg-[#f7f9fa]">
        <div class="p-4 sm:p-6 space-y-4 sm:space-y-6">
            <div>
                <h1 class="text-2xl font-bold text-blue-500">Merchant List</h1>
                <p class="text-gray-500">View and manage all pending merchants</p>

                <Stepper :steps="steps" @finish="finish">
                    <template v-slot="{ currentStep }">
                        <!-- Step 1: Merchant Information -->
                        <div v-if="currentStep === 1">
                            <h3 class="text-lg font-semibold text-center mb-6">Merchant Information</h3>
                            <div class="w-full max-w-lg mx-auto space-y-4">
                                <div v-for="field in personalInfoFields" :key="field.name"
                                    class="flex items-center justify-between">
                                    <label class="text-gray-700 dark:text-white text-sm font-medium w-1/4">
                                        {{ field.label }} <span class="text-red-400" v-if="field.required">*</span>
                                    </label>
                                    <input v-model="merchantData[field.name]" :type="field.type"
                                        :placeholder="field.placeholder || ''"
                                        class="w-3/4 px-4 py-2 border rounded-lg text-gray-900 dark:text-white dark:bg-neutral-800 border-gray-300 focus:ring-2 focus:ring-blue-600" />
                                </div>
                            </div>
                        </div>

                        <!-- Step 2: Merchant Location -->
                        <div v-if="currentStep === 2">
                            <h3 class="text-lg font-semibold text-center mb-6">Merchant Location</h3>
                            <div class="w-full max-w-lg mx-auto space-y-4">
                                <div v-for="field in locationFields" :key="field.name"
                                    class="flex items-center justify-between">
                                    <label class="text-gray-700 dark:text-white text-sm font-medium w-1/4">
                                        {{ field.label }} <span class="text-red-400" v-if="field.required">*</span>
                                    </label>
                                    <input v-model="merchantData[field.name]" :type="field.type"
                                        class="w-3/4 px-4 py-2 border rounded-lg text-gray-900 dark:text-white dark:bg-neutral-800 border-gray-300 focus:ring-2 focus:ring-blue-600" />
                                </div>
                            </div>
                        </div>

                        <!-- Step 3: Business Information -->
                        <div v-if="currentStep === 3">
                            <h3 class="text-lg font-semibold text-center mb-6">Business Information</h3>
                            <div class="w-full max-w-lg mx-auto space-y-4">
                                <div v-for="field in businessFields" :key="field.name"
                                    class="flex items-center justify-between">
                                    <label class="text-gray-700 dark:text-white text-sm font-medium w-1/4">
                                        {{ field.label }} <span class="text-red-400" v-if="field.required">*</span>
                                    </label>

                                    <!-- Select for Category -->
                                    <select v-if="field.name === 'business_category'"
                                        v-model="merchantData.business_category" @change="handleCategoryChange"
                                        class="w-3/4 px-4 py-2 border rounded-lg text-gray-900 dark:text-white dark:bg-neutral-800 border-gray-300 focus:ring-2 focus:ring-blue-600">
                                        <option value="" disabled>Select Business Category</option>
                                        <option v-for="(subCategories, category) in categories" :key="category"
                                            :value="category">
                                            {{ category }}
                                        </option>
                                    </select>

                                    <!-- Select or Input for Sub-Category -->
                                    <template v-else-if="field.name === 'business_sub_category'">
                                        <select
                                            v-if="merchantData.business_category && merchantData.business_category !== 'Others'"
                                            v-model="merchantData.business_sub_category"
                                            class="w-3/4 px-4 py-2 border rounded-lg text-gray-900 dark:text-white dark:bg-neutral-800 border-gray-300 focus:ring-2 focus:ring-blue-600">
                                            <option value="" disabled>Select Business Sub-Category</option>
                                            <option v-for="sub in subCategories" :key="sub" :value="sub">
                                                {{ sub }}
                                            </option>
                                        </select>
                                        <input v-else v-model="merchantData.business_sub_category"
                                            placeholder="Enter custom Sub category" type="text"
                                            class="w-3/4 px-4 py-2 border rounded-lg text-gray-900 dark:text-white dark:bg-neutral-800 border-gray-300 focus:ring-2 focus:ring-blue-600" />
                                    </template>

                                    <!-- Default Input for Other Fields -->
                                    <input v-else v-model="merchantData[field.name]" type="text"
                                        class="w-3/4 px-4 py-2 border rounded-lg text-gray-900 dark:text-white dark:bg-neutral-800 border-gray-300 focus:ring-2 focus:ring-blue-600"
                                        :placeholder="field.placeholder || ''" />
                                </div>
                            </div>
                        </div>

                        <!-- Step 4: Discount Offer -->
                        <div v-if="currentStep === 4">
                            <h3 class="text-lg font-semibold text-center mb-6">Discount Offer</h3>
                            <div class="max-w-md mx-auto p-6 bg-white">
                                <h2 class="text-lg font-semibold mb-3">Select discount offer:</h2>
                                <div class="flex space-x-3">
                                    <button v-for="discount in discounts" :key="discount"
                                        @click="selectDiscount(discount)"
                                        :class="['px-4 py-2 border rounded-md text-blue-600 border-blue-400 transition',
                                            selectedDiscount === discount ? 'bg-blue-500 text-white' : 'hover:bg-blue-100']">
                                        {{ discount }}%
                                    </button>
                                </div>
                                <div class="mt-4 relative">
                                    <input type="number" v-model="customDiscount"
                                        class="w-full px-3 py-2 border rounded-md outline-none pr-10"
                                        placeholder="Input custom discount" @input="selectCustomDiscount" />
                                    <span
                                        class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500">%</span>
                                </div>
                            </div>
                        </div>
                    </template>
                </Stepper>
            </div>
        </div>
    </div>
</template>

<script>
import Header from '@/Layout/Dashboard/header.vue';
import Sidebar from '@/Layout/Sidebar/adminSidebar.vue';
import Stepper from '@/Layout/Merchant/Stepper.vue';
import Swal from 'sweetalert2';
import axios from 'axios';
import { useRouter } from 'vue-router';

export default {
    components: {
        Header,
        Sidebar,
        Stepper,
    },
    data() {
        return {
            steps: [
                { index: 1, label: 'Merchant Information' },
                { index: 2, label: 'Merchant Location' },
                { index: 3, label: 'Business Information' },
                { index: 4, label: 'Discount Offer' }
            ],
            personalInfoFields: [
                { name: 'fname', label: 'First Name', type: 'text', required: true },
                { name: 'mname', label: 'Middle Name', type: 'text', placeholder: 'Optional' },
                { name: 'lname', label: 'Last Name', type: 'text', required: true },
                { name: 'email', label: 'Email Address', type: 'email', required: true },
                { name: 'contact', label: 'Contact No.', type: 'tel', required: true }
            ],
            locationFields: [
                { name: 'street', label: 'Street', type: 'text', required: true },
                { name: 'city', label: 'City', type: 'text', required: true },
                { name: 'province', label: 'Province', type: 'text', required: true },
                { name: 'zip', label: 'Zip Code', type: 'text', required: true }
            ],
            businessFields: [
                { name: 'business_name', label: 'Business Name', required: true },
                { name: 'business_category', label: 'Business Category', required: true },
                { name: 'business_sub_category', label: 'Business Sub-Category', required: true },
                { name: 'website', label: 'Website URL', placeholder: 'Optional' },
                { name: 'facebook', label: 'Facebook URL', placeholder: 'Optional' }
            ],
            categories: {
                'Retail': ['Clothing', 'Electronics', 'Groceries', 'Furniture', 'Books'],
                'Food': ['Restaurants', 'Cafes', 'Fast Food', 'Bakeries'],
                'Others': []
            },
            subCategories: [],

            merchantData: {
                // User Information
                fname: '',
                mname: '',
                lname: '',
                email: '',
                contact: '',

                // Merchant Information
                business_name: '',
                business_category: '',
                business_sub_category: '',
                street: '',
                city: '',
                province: '',
                zip: '',
                website: '',
                facebook: '',
                discount: '',
            },
            discounts: [5, 15, 25, 50],
            selectedDiscount: null,
            customDiscount: ''
        };
    },
    methods: {

        async finish() {
            this.merchantData.discount = this.selectedDiscount || this.customDiscount || 0;

            console.log("Submitting merchantData:", this.merchantData); // Debugging

            try {
                const response = await axios.post('/api/merchants/create', this.merchantData);
                if (response.data.message === 'success') {
                    Swal.fire("Success", "Registration Completed!", "success");
                    this.$router.push('/administrator/merchants/pending');
                } else {
                    Swal.fire("Error", "Something went wrong!", "error");
                }
            } catch (error) {
                console.error("Error response:", error.response?.data);
                Swal.fire("Error", error.response?.data?.error || "Something went wrong!", "error");

                console.log("Merchant Data at error:", this.merchantData);
            }
        }
        ,
        handleCategoryChange() {
            this.subCategories = this.categories[this.merchantData.business_category] || [];
        },
        selectDiscount(discount) { this.selectedDiscount = discount; this.customDiscount = ''; },
        selectCustomDiscount() { this.selectedDiscount = null; }
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
