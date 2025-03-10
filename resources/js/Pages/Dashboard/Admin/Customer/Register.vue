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
                                    <input v-model="customerData[field.name]" :type="field.type"
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
                                    <input v-model="customerData[field.name]" :type="field.type"
                                        class="w-3/4 px-4 py-2 border rounded-lg text-gray-900 dark:text-white dark:bg-neutral-800 border-gray-300 focus:ring-2 focus:ring-blue-600" />
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
                { index: 1, label: 'Customer Information' },
                { index: 2, label: 'Customer Location' },
            ],
            personalInfoFields: [
                { name: 'fname', label: 'First Name', type: 'text', required: true },
                { name: 'mname', label: 'Middle Name', type: 'text', placeholder: 'Optional' },
                { name: 'lname', label: 'Last Name', type: 'text', required: true },
                { name: 'email', label: 'Email Address', type: 'email', required: true },
                { name: 'contact', label: 'Contact No.', type: 'tel', required: true },
                { name: 'bdate', label: 'Birth date.', type: 'date' }
            ],
            locationFields: [
                { name: 'street', label: 'Street', type: 'text', placeholder: 'Optional' },
                { name: 'city', label: 'City', type: 'text', placeholder: 'Optional' },
                { name: 'province', label: 'Province', type: 'text', placeholder: 'Optional' },
                { name: 'zip', label: 'Zip Code', type: 'text', placeholder: 'Optional' }
            ],


            customerData: {
                // User Information
                fname: '',
                mname: '',
                lname: '',
                email: '',
                contact: '',
                bdate: '',

                // Customer Location
                street: '',
                city: '',
                province: '',
                zip: '',
            },
        };
    },
    methods: {

        async finish() {

            try {
                const response = await axios.post('/api/customers/register', this.customerData);
                if (response.data.message === 'success') {
                    Swal.fire("Success", "Registration Completed!", "success");
                    this.$router.push('/administrator/customer/list');
                } else {
                    Swal.fire("Error", "Something went wrong!", "error");
                }
            } catch (error) {
                console.error("Error response:", error.response?.data);
                Swal.fire("Error", error.response?.data?.error || "Something went wrong!", "error");

                console.log("Merchant Data at error:", this.customerData);
            }
        }

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
