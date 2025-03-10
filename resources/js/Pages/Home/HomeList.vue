<template>
    <TopBar />
    <Category />
    <Banner />

    <!-- Example: Show 8 merchants on the homepage -->
    <Merchant :itemsPerPage="8" title="Featured Merchants" :showSeeMore="true" :showPagination="true" />

    <!-- <Merchant :itemsPerPage="12" title="New Arrivals" :showSeeMore="false" /> -->

    <Footer />
</template>

<script>
import TopBar from '@/Components/Organisms/TopBar.vue';
import Category from '@/Layout/Category.vue';
import Banner from '@/Layout/Banner.vue';
import Merchant from '@/Layout/Merchant.vue';
import Footer from '@/Components/Organisms/Footer.vue';

export default {
    components: {
        TopBar,
        Banner,
        Merchant,
        Category,
        Footer,
    },
};
</script>
