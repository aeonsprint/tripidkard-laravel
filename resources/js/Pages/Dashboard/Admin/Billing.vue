<template>
    <Header />
    <Sidebar />
    <!-- Content -->
    <div class="w-full lg:ps-64 bg-[#f7f9fa]">
        <div class="p-4 sm:p-6 space-y-4 sm:space-y-6">

<Content/>
<Table :tableData="tableData" :columns="columns" />

        </div>
    </div>
    <!-- End Content -->
</template>

<script>
import Header from '@/Layout/Dashboard/header.vue';
import Sidebar from '@/Layout/Sidebar/adminSidebar.vue';
import Content from '@/Layout/Dashboard/Merchant/Billing/Content.vue';
import Table from '@/Layout/table.vue';

export default {
    components: {
        Header,
        Sidebar,
        Table,
        Content,

    },
    data() {
      return {
        columns: [
          { label: 'Name', key: 'name' },
          { label: 'Age', key: 'age' },
          { label: 'Address', key: 'address' }
        ],
        tableData: [
          { name: 'John Doe', age: 28, address: '123 Main St, New York' },
          { name: 'Jane Smith', age: 34, address: '456 Elm St, California' },
          { name: 'Michael Johnson', age: 40, address: '789 Pine St, Texas' },
          { name: 'Sarah Brown', age: 25, address: '101 Maple St, Florida' },
          { name: 'Chris Evans', age: 30, address: '222 Oak St, Chicago' }
        ]
      };
    }
}

</script>
