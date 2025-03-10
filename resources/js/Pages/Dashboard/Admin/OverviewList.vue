<template>
<Header />
<Sidebar />
     <!-- Content -->
     <div class="w-full lg:ps-64 bg-[#f7f9fa]">
    <div class="p-4 sm:p-6 space-y-4 sm:space-y-6">
<Content/>
<SecondContent/>


</div>
  </div>
  <!-- End Content -->
</template>

<script>
import Header from '@/Layout/Dashboard/header.vue';
import Sidebar from '@/Layout/Sidebar/adminSidebar.vue';
import Content from '@/Layout/Dashboard/Merchant/Overview/content.vue';
import SecondContent from '@/Layout/Dashboard/Merchant/Overview/content2.vue';

export default {
    components: {
        Header,
        Sidebar,
        Content,
        SecondContent,

    }
}

</script>
