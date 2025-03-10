<template>
    <Header />
    <Sidebar />
    <!-- Content -->
    <div class="w-full lg:ps-64 bg-[#f7f9fa]">
        <div class="p-4 sm:p-6 space-y-4 sm:space-y-6">
            <div class=" mx-auto p-6 bg-white rounded-lg shadow-md">
                <h2 class="text-2xl font-bold text-orange-600">Flash Deals Discount</h2>
                <p class="text-gray-600 mb-4">Setup your flash deals discount</p>

                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Discount details</label>
                        <div class="flex space-x-2">
                            <input type="text" v-model="discount" placeholder="80%"
                                class="w-1/3 p-2 border border-gray-300 rounded-md focus:ring-orange-500 focus:border-orange-500">
                            <input type="text" v-model="description"
                                placeholder="Don't miss out the limited super flash deal discount today."
                                class="w-2/3 p-2 border border-gray-300 rounded-md focus:ring-orange-500 focus:border-orange-500">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Promotion Images</label>
                        <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center text-gray-500">
                            <p>Drag and drop images or click to upload</p>
                            <p class="text-sm">Maximum 5 images, PNG or JPG (Max 2MB each)</p>
                        </div>
                    </div>

                    <div class="flex justify-end space-x-2">
                        <button @click="resetForm"
                            class="px-4 py-2 border border-gray-300 text-gray-700 rounded-md">Reset</button>
                        <button @click="saveForm" class="px-4 py-2 bg-orange-500 text-white rounded-md">Save</button>
                    </div>
                </div>
            </div>




        </div>
    </div>
    <!-- End Content -->
</template>

<script>
import Header from '@/Layout/Dashboard/header.vue';
import Sidebar from '@/Layout/Sidebar/adminSidebar.vue';
import Table from '@/Layout/Dashboard/Merchant/Discount/table.vue';

export default {
    components: {
        Header,
        Sidebar,
        Table,

    },
    data() {
        return {
            discount: "",
            description: ""
        };
    },
    methods: {
        resetForm() {
            this.discount = "";
            this.description = "";
        },
        saveForm() {
            alert("Discount saved successfully!");
        }
    }
}

</script>

<style>
body {
    background-color: #f9fafb;
}
</style>
