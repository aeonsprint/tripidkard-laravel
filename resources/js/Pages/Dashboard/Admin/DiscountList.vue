<template>
    <Header />
    <Sidebar />
    <!-- Content -->
    <div class="w-full lg:ps-64 bg-[#f7f9fa]">
        <div class="p-4 sm:p-6 space-y-4 sm:space-y-6">
            <!-- Header -->
            <h1 class="text-2xl font-bold text-orange-500">Flash Management</h1>
            <p class="text-gray-500">Manage your store-wide discount and promotions</p>

            <Table />


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

    }
}

</script>
