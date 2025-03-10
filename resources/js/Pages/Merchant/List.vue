<template>



    <TopBar />
    <Category />

    <Breadcrumb />
    <div class="p-4 max-w-[75rem] mx-auto">
        <h2 class="text-2xl font-bold">Merchants Deals and Discounts</h2>
        <p class="text-gray-500">Total Merchants: {{ merchantCount }}</p> <!-- ✅ Display count -->

        <Filter />
    </div>
    <Merchant :itemsPerPage="12" title="All Merchants" :showSeeMore="false" :showPagination="true"
    @updateMerchantCount="merchantCount = $event" />


    <Footer />

</template>

<script>
import TopBar from '@/Components/Organisms/TopBar.vue';
import Category from '@/Layout/Category.vue';
import Filter from '@/Layout/Merchant/Fillter.vue';
import Breadcrumb from '@/Components/Molecules/Breadcrumb.vue';
import Merchant from '@/Layout/Merchant.vue';
import Footer from '@/Components/Organisms/Footer.vue';
import { ref } from 'vue';
export default {
    components: {
        TopBar,
        Category,
        Filter,
        Merchant,
        Breadcrumb,
        Footer,
    },
    setup() {

        const merchantCount = ref(0);

        return {
            merchantCount
        }
    },
};
</script>
