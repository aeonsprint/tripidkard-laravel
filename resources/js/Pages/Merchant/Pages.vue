<template>



    <TopBar />
    <Breadcrumb />
    <Banner />
    <Description />
    <Merchant :itemsPerPage="4" title="Featured Merchants" :showSeeMore="true" :showPagination="true" />


    <Footer />

</template>

<script>
import TopBar from '@/Components/Organisms/TopBar.vue';
import Breadcrumb from '@/Components/Molecules/Breadcrumb.vue';
import Description from '@/Layout/Merchant/Description.vue';
import Banner from '@/Layout/Merchant/RaffleBanner.vue';
import Merchant from '@/Layout/Merchant.vue';
import Footer from '@/Components/Organisms/Footer.vue';
import { onMounted } from 'vue';
import axios from 'axios';
import { useRoute } from 'vue-router';
export default {
    components: {
        TopBar,
        Banner,
        Merchant,
        Description,
        Breadcrumb,
        Footer,
    },
    setup() {
        const route = useRoute();
        const incrementMerchantViews = async () => {
            try {
                await axios.post(`/api/merchant/${route.params.merchant_id}/increment-views`);
            } catch (error) {
                console.error('Failed to update view count:', error);
            }
        };

        onMounted(() => {
            incrementMerchantViews(); // Tawagin kapag nag-load ang page
        });
    },
};
</script>
