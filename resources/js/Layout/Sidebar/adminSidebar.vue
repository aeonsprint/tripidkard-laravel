<template>

    <body class="hs-overlay-body-open hs-overlay-body-open:overflow-hidden">

        <!-- Sidebar -->
        <div id="hs-sidebar-content-push" class="hs-overlay [--auto-close:lg] lg:block lg:translate-x-0 lg:end-auto lg:bottom-0 w-64
hs-overlay-open:translate-x-0
-translate-x-full transition-all duration-300 transform
h-full
hidden
fixed top-0 start-0 bottom-0 z-[60]
bg-white border-e border-gray-200 dark:bg-neutral-800 dark:border-neutral-700" role="dialog" tabindex="-1"
            aria-label="Sidebar">
            <div class="relative flex flex-col h-full max-h-full ">
                <!-- Header -->
                <header class="p-4 flex  justify-center  items-center gap-x-2">
                    <a class="text-xl font-semibold text-black focus:outline-none focus:opacity-80 dark:text-white"
                        href="#" aria-label="Brand">
                        <img src="/storage/img/logo.jpg" alt="Logo" class="w-[100px] h-[65px]">
                    </a>



                    <div class="lg:hidden -me-2">
                        <!-- Close Button -->
                        <button type="button"
                            class="flex justify-center items-center gap-x-3 size-6 bg-white border border-gray-200 text-sm text-gray-600 hover:bg-gray-100 rounded-full disabled:opacity-50 disabled:pointer-events-none focus:outline-none focus:bg-gray-100 dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700 dark:hover:text-neutral-200 dark:focus:text-neutral-200"
                            data-hs-overlay="#hs-sidebar-content-push">
                            <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path d="M18 6 6 18" />
                                <path d="m6 6 12 12" />
                            </svg>
                            <span class="sr-only">Close</span>
                        </button>
                        <!-- End Close Button -->
                    </div>
                </header>
                <!-- End Header -->

                <!-- Body -->
                <nav
                    class="h-full overflow-y-auto [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar-thumb]:bg-gray-300 dark:[&::-webkit-scrollbar-track]:bg-neutral-700 dark:[&::-webkit-scrollbar-thumb]:bg-neutral-500">
                    <div class="hs-accordion-group pb-0 px-2  w-full flex flex-col flex-wrap"
                        data-hs-accordion-always-open>
                        <ul class="space-y-1">

                            <!-- Dashboard -->
                            <li class="hs-accordion" id="dashboard-accordion">
                                <button type="button"
                                    class="hs-accordion-toggle w-full text-start flex items-center gap-x-3 py-2 px-2.5 text-sm text-gray-700 rounded-lg hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300"
                                    :class="{ 'hs-accordion-active': isDashboardActive }" aria-expanded="true"
                                    aria-controls="dashboard-accordion-collapse">
                                    <span class="material-icons">home</span>
                                    Dashboard
                                    <span class="material-icons ms-auto">keyboard_arrow_right</span>
                                </button>

                                <div id="dashboard-accordion-collapse"
                                    class="hs-accordion-content w-full overflow-hidden transition-[height] duration-300"
                                    :class="{ 'block': isDashboardActive, 'hidden': !isDashboardActive }" role="region">
                                    <ul class="pt-1 ps-7 space-y-1">
                                        <li>
                                            <a href="/administrator/dashboard"
                                                class="flex items-center gap-x-3 py-2 px-2.5 text-sm rounded-lg"
                                                :class="{ 'bg-blue-500 text-white ': $route.path.startsWith('/administrator/dashboard') }">
                                                Overview
                                            </a>
                                        </li>
                                        <li>
                                            <a href="/merchant/analytics"
                                                class="flex items-center gap-x-3 py-2 px-2.5 text-sm rounded-lg"
                                                :class="{ 'bg-blue-500 text-white ': $route.path.startsWith('/administrator/analytics') }">
                                                Analytics
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <!-- End Dashboard -->

                            <!-- Engagements -->
                            <li class="hs-accordion" id="engagement-accordion">
                                <button type="button"
                                    class="hs-accordion-toggle w-full text-start flex items-center gap-x-3 py-2 px-2.5 text-sm text-gray-700 rounded-lg hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300"
                                    :class="{ 'hs-accordion-active': isEngagementActive }" aria-expanded="true"
                                    aria-controls="engagement-accordion-collapse">
                                    <span class="material-icons">bento</span>
                                    Engagements
                                    <span class="material-icons ms-auto">keyboard_arrow_right</span>
                                </button>

                                <div id="engagement-accordion-collapse"
                                    class="hs-accordion-content w-full overflow-hidden transition-[height] duration-300"
                                    :class="{ 'block': isEngagementActive, 'hidden': !isEngagementActive }"
                                    role="region">
                                    <ul class="pt-1 ps-7 space-y-1">
                                        <li>
                                            <a href="/administrator/discount-list"
                                                class="flex items-center gap-x-3 py-2 px-2.5 text-sm rounded-lg"
                                                :class="{ 'bg-blue-500 text-white hover:text-black': $route.path.startsWith('/administrator/discount-list') }">
                                                Discounts
                                            </a>
                                        </li>

                                        <li class="hs-accordion" id="users-accordion-sub-1">
                                            <button type="button"
                                                class="hs-accordion-toggle w-full text-start flex items-center gap-x-3 py-2 px-2.5 text-sm text-gray-700 rounded-lg hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300"
                                                :class="{ 'hs-accordion-active': isRaffleActive }" aria-expanded="true"
                                                aria-controls="raffle-accordion-collapse">
                                                Raffles
                                                <span
                                                    class="material-icons material-symbols-outlined ms-auto  text-gray-600 group-hover:text-gray-500 dark:text-neutral-400">keyboard_arrow_right</span>
                                            </button>


                                            <div id="raffle-accordion-collapse"
                                                class="hs-accordion-content w-full overflow-hidden transition-[height] duration-300"
                                                :class="{ 'block': isRaffleActive, 'hidden': !isRaffleActive }"
                                                role="region">
                                                <ul class="pt-1 ps-2 space-y-1">
                                                    <li>
                                                        <a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm rounded-lg hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:bg-neutral-800 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700 dark:text-neutral-200"
                                                            :class="{ 'bg-blue-500 text-white hover:text-black': $route.path === '/administrator/raffle/pending' }"
                                                            href="/administrator/raffle/pending">
                                                            Raffles Pending
                                                        </a>
                                                    </li>

                                                    <li>
                                                        <a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm rounded-lg hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:bg-neutral-800 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700 dark:text-neutral-200"
                                                            :class="{ 'bg-blue-500 text-white hover:text-black': $route.path === '/administrator/raffle' }"
                                                            href="/administrator/raffle">
                                                            Raffles List
                                                        </a>
                                                    </li>

                                                    <li>
                                                        <a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm rounded-lg hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:bg-neutral-800 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700 dark:text-neutral-200"
                                                            :class="{ 'bg-blue-500 text-white hover:text-black': $route.path === '/administrator/raffle/archived' }"
                                                            href="/administrator/raffle/archived">
                                                            Raffles Archive
                                                        </a>
                                                    </li>

                                                </ul>
                                            </div>
                                        </li>

                                        <li>
                                            <a class="flex items-center gap-x-3 py-2 px-2.5 text-sm rounded-lg hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:bg-neutral-800 dark:text-neutral-400 dark:hover:text-neutral-300 dark:focus:text-neutral-300"
                                                :class="{ 'bg-blue-500 text-white hover:text-black': $route.path === '/administrator/flash-deals' }"
                                                href="/administrator/flash-deals">
                                                Flash Deals <span
                                                    class="ms-auto py-0.5 px-2 inline-flex items-center gap-x-1.5 text-xs bg-blue-400 text-white rounded-full dark:bg-neutral-600 dark:text-blue-400">Pro</span>
                                            </a>
                                        </li>

                                    </ul>
                                </div>
                            </li>
                            <!-- End Engagements -->

                            <!-- Merchant -->

                            <li class="hs-accordion" id="merchant-accordion">
                                <button type="button"
                                    class="hs-accordion-toggle w-full text-start flex items-center gap-x-3 py-2 px-2.5 text-sm text-gray-700 rounded-lg hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:bg-neutral-800 dark:text-neutral-400 dark:hs-accordion-active:text-white dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700 dark:focus:text-neutral-300"
                                    :class="{ 'hs-accordion-active': isMerchantActive }"
                                    aria-expanded="true"
                                    aria-controls="merchant-accordion-collapse">
                                    <span class="material-icons  material-symbols-outlined ">group</span>

                                    Merchants
                                    <span
                                        class="material-icons material-symbols-outlined ms-auto  text-gray-600 group-hover:text-gray-500 dark:text-neutral-400">keyboard_arrow_right</span>

                                </button>

                                <div id="merchant-accordion-collapse"
                                    class="hs-accordion-content w-full overflow-hidden transition-[height] duration-300 hidden"
                                    :class="{ 'block': isMerchantActive, 'hidden': !isMerchantActive }" role="region"
                                    aria-labelledby="merchant-accordion">
                                    <ul class="pt-1 ps-7 space-y-1">

                                        <li>
                                            <a class="flex items-center gap-x-3 py-2 px-2.5 text-sm text-gray-700 rounded-lg hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:bg-neutral-800 dark:text-neutral-400 dark:hover:text-neutral-300 dark:focus:text-neutral-300"
                                                :class="{ 'bg-blue-500 text-white hover:text-black': $route.path === '/administrator/merchant/pending' }"
                                                href="/administrator/merchant/pending">

                                                Merchant Pending <span
                                                    class="ms-auto py-0.5 px-2 inline-flex items-center gap-x-1.5 text-xs bg-blue-400 text-white rounded-full dark:bg-neutral-600 dark:text-blue-400">Pro</span>
                                            </a>
                                        </li>

                                        <li>
                                            <a class="flex items-center gap-x-3 py-2 px-2.5 text-sm text-gray-700 rounded-lg hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:bg-neutral-800 dark:text-neutral-400 dark:hover:text-neutral-300 dark:focus:text-neutral-300"
                                                :class="{ 'bg-blue-500 text-white hover:text-black': $route.path === '/administrator/merchant/list' }"
                                                href="/administrator/merchant/list">

                                                Merchant List
                                            </a>
                                        </li>

                                        <li>
                                            <a class="flex items-center gap-x-3 py-2 px-2.5 text-sm text-gray-700 rounded-lg hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:bg-neutral-800 dark:text-neutral-400 dark:hover:text-neutral-300 dark:focus:text-neutral-300"
                                                :class="{ 'bg-blue-500 text-white hover:text-black': $route.path === '/administrator/merchant/archived' }"
                                                href="/administrator/merchant/archived">
                                                Merchant Archive
                                            </a>
                                        </li>


                                    </ul>
                                </div>
                            </li>
                            <!-- End Merchant -->

                            <!-- Merchant -->

                            <li class="hs-accordion" id="account-accordion">
                                <button type="button" :class="{ 'hs-accordion-active': isCustomerActive }"
                                    aria-expanded="true"
                                    class="hs-accordion-toggle w-full text-start flex items-center gap-x-3 py-2 px-2.5 text-sm text-gray-700 rounded-lg hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:bg-neutral-800 dark:text-neutral-400 dark:hs-accordion-active:text-white dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700 dark:focus:text-neutral-300"
                                    aria-controls="account-accordion-sub-1-collapse-1">
                                    <span class="material-icons  material-symbols-outlined ">group</span>

                                    Customers
                                    <span
                                        class="material-icons material-symbols-outlined ms-auto  text-gray-600 group-hover:text-gray-500 dark:text-neutral-400">keyboard_arrow_right</span>
                                </button>

                                <div id="account-accordion-sub-1-collapse-1"
                                    class="hs-accordion-content w-full overflow-hidden transition-[height] duration-300 hidden"
                                    :class="{ 'block': isCustomerActive, 'hidden': !isCustomerActive }" role="region"
                                    aria-labelledby="account-accordion">
                                    <ul class="pt-1 ps-7 space-y-1">


                                        <li>
                                            <a class="flex items-center gap-x-3 py-2 px-2.5 text-sm text-gray-700 rounded-lg hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:bg-neutral-800 dark:text-neutral-400 dark:hover:text-neutral-300 dark:focus:text-neutral-300"
                                                :class="{ 'bg-blue-500 text-white hover:text-black': $route.path === '/administrator/customer/pending' }"
                                                href="/administrator/customer/pending">

                                                Customer Pending
                                            </a>
                                        </li>

                                        <li>
                                            <a class="flex items-center gap-x-3 py-2 px-2.5 text-sm text-gray-700 rounded-lg hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:bg-neutral-800 dark:text-neutral-400 dark:hover:text-neutral-300 dark:focus:text-neutral-300"
                                                :class="{ 'bg-blue-500 text-white hover:text-black': $route.path === '/administrator/customer/list' }"
                                                href="/administrator/customer/list">

                                                Customer List
                                            </a>
                                        </li>

                                        <li>
                                            <a class="flex items-center gap-x-3 py-2 px-2.5 text-sm text-gray-700 rounded-lg hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:bg-neutral-800 dark:text-neutral-400 dark:hover:text-neutral-300 dark:focus:text-neutral-300"
                                                :class="{ 'bg-blue-500 text-white hover:text-black': $route.path === '/administrator/customer/archived' }"
                                                href="/administrator/customer/archived">
                                                Customer Archive
                                            </a>
                                        </li>


                                    </ul>
                                </div>
                            </li>
                            <!-- End Merchant -->


                            <li>
                                <a class="flex items-center gap-x-3 py-2 px-2.5 text-sm text-gray-700 rounded-lg hover:bg-gray-100 dark:hover:bg-neutral-700 dark:text-neutral-400 dark:hover:text-neutral-300"
                                    :class="{ 'bg-blue-500 text-white hover:text-black': $route.path === '/administrator/scanner' }"
                                    href="/administrator/scanner">
                                    <span class="material-icons  material-symbols-outlined ">qr_code_scanner</span>

                                    Scanner </a>
                            </li>


                            <li>
                                <a class="flex items-center gap-x-3 py-2 px-2.5 text-sm text-gray-700 rounded-lg hover:bg-gray-100 dark:hover:bg-neutral-700 dark:text-neutral-400 dark:hover:text-neutral-300"
                                    :class="{ 'bg-blue-500 text-white hover:text-black': $route.path === '/administrator/activity-log' }"
                                    href="/administrator/activity-log">
                                    <span class="material-icons material-symbols-outlined">
                                        rowing
                                    </span>

                                    Activity Log </a>
                            </li>
                            <li>
                                <a class="flex items-center gap-x-3 py-2 px-2.5 text-sm text-gray-700 rounded-lg hover:bg-gray-100 dark:hover:bg-neutral-700 dark:text-neutral-400 dark:hover:text-neutral-300"
                                    :class="{ 'bg-blue-500 text-white hover:text-black': $route.path === '/administrator/billing' }"
                                    href="/administrator/billing">
                                    <span class="material-icons  material-symbols-outlined ">
                                        receipt_long
                                    </span>

                                    Billing
                                </a>
                            </li>
                        </ul>
                    </div>
                </nav>
                <!-- End Body -->

                <!-- Footer -->
                <div class="flex justify-center items-center  bg-gray-100">
                    <div class="bg-white p-6 rounded-xl  text-center w-80">
                        <div class="flex justify-center items-center text-blue-600 mb-2">
                            <span class="material-icons">auto_awesome</span>
                            <h2 class="text-lg font-bold ml-1">Unlock to Pro</h2>
                        </div>
                        <p class="text-gray-600 text-sm">
                            Get access to premium features and unlock your full potential
                        </p>
                        <div class="mt-6">
                            <router-link to="/administrator/plan"
                                class="bg-blue-600 text-white mt-4 px-6 py-3 rounded-lg w-full font-semibold hover:bg-blue-700 transition">
                                Upgrade Plan
                            </router-link>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- End Sidebar -->

        <!-- Content -->

        <!-- End Content -->
    </body>
</template>

<script>
export default {
    computed: {
        isDashboardActive() {
            return this.$route.path.startsWith('/administrator/dashboard') || this.$route.path.startsWith('/merchant/analytics');
        },
        isEngagementActive() {
            return this.$route.path.startsWith('/administrator/discount-list')
                || this.$route.path.startsWith('/administrator/raffle-draw')
                || this.$route.path.startsWith('/administrator/flash-deals')
                || this.$route.path.startsWith('/administrator/raffle/create')
                || this.$route.path.startsWith('/administrator/raffle')
                ;
        },
        isMerchantActive() {
            return this.$route.path.startsWith('/administrator/merchant/list')
                || this.$route.path.startsWith('/administrator/merchant/archived')
                || this.$route.path.startsWith('/administrator/merchant/pending');
        },
        isCustomerActive() {
            return this.$route.path.startsWith('/administrator/customer/pending')
                || this.$route.path.startsWith('/administrator/customer/list')
                || this.$route.path.startsWith('/administrator/customer/archived');
        },
        isRaffleActive() {
            return this.$route.path.startsWith('/administrator/raffle-draw')
                || this.$route.path.startsWith('/administrator/raffle/create');
        }
    }
}
</script>
