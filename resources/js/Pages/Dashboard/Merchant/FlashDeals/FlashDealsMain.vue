<template>
    <Header />
    <Sidebar />
    <!-- Content -->
    <div class="w-full lg:ps-64 bg-[#f7f9fa]">
        <div class="p-4 sm:p-6 space-y-4 sm:space-y-6">


            <div class="mx-auto bg-white p-6 rounded-lg shadow-lg">
    <!-- Header -->
    <h1 class="text-2xl font-bold text-blue-500">Flash Management</h1>
    <p class="text-gray-500">Manage your store-wide discount and promotions</p>

    <!-- Discount Percentage -->
    <div class="bg-blue-100 text-blue-600 text-3xl font-bold p-4 rounded-lg mt-4">80%</div>

    <!-- Title Input -->
    <div class="mt-4">
      <label class="block text-gray-700 font-medium">Title</label>
      <input
        type="text"
        class="w-full p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-orange-400"
        value="Super Limited Flash Deals Discount"
      />
    </div>

    <!-- Description Input -->
    <div class="mt-4">
      <label class="block text-gray-700 font-medium">Description</label>
      <textarea
        class="w-full p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-orange-400"
        rows="3"
      >Enjoy 25% off on all our services! Valid for both walk-in and appointments.</textarea>
    </div>

    <!-- Image Upload -->
    <div class="mt-4">
      <label class="block text-gray-700 font-medium">Promotion Images</label>
      <div class="border-dashed border-2 border-gray-300 rounded-lg p-6 flex flex-col items-center justify-center mt-2 cursor-pointer">
        <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
          <path stroke-linecap="round" stroke-linejoin="round" d="M7 16V7a4 4 0 118 0v9m4 0a4 4 0 01-8 0"></path>
        </svg>
        <p class="text-gray-500 text-sm mt-2">Drag and drop images or click to upload</p>
        <p class="text-gray-400 text-xs">Maximum 5 images, PNG or JPG (Max 2MB each)</p>
      </div>
    </div>

    <!-- Buttons -->
    <div class="mt-6 flex justify-between">
      <button class="bg-gray-200 px-6 py-2 rounded-lg text-gray-600 hover:bg-gray-300">Delete</button>
      <button class="bg-orange-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600">Edit</button>
    </div>
  </div>


        </div>
    </div>
    <!-- End Content -->
</template>

<script>
import Header from '@/Layout/Dashboard/header.vue';
import Sidebar from '@/Layout/Sidebar/merchantSidebar.vue';
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
