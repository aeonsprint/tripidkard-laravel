// Import components
import AdminDashboard from "./Pages/Dashboard/Admin/OverviewList.vue";
import MerchantList from "./Pages/Dashboard/Admin/Merchant/MerchantList.vue";
import MerchantPending from "./Pages/Dashboard/Admin/Merchant/MerchantPending.vue";
import MerchantArchive from "./Pages/Dashboard/Admin/Merchant/MerchantArchive.vue";
import CustomerList from "./Pages/Dashboard/Admin/Customer/CustomerList.vue";
import CustomerPending from "./Pages/Dashboard/Admin/Customer/pending.vue";
import CustomerArchive from "./Pages/Dashboard/Admin/Customer/CustomerArchive.vue";
import MerchantRegister from "./Pages/Dashboard/Admin/Merchant/Register.vue";
import CustomerRegister from "./Pages/Dashboard/Admin/Customer/Register.vue";

import AdminProfile from "./Pages/Dashboard/Admin/ProfileList.vue";
import AdminDiscount from "./Pages/Dashboard/Admin/DiscountList.vue";
import AdminAnalytics from "./Pages/Dashboard/Admin/Analytics.vue";
import AdminRaffle from "./Pages/Dashboard/Admin/Raffle/RaffleList.vue";
import AdminRaffleRegister from "./Pages/Dashboard/Admin/Raffle/RaffleRegister.vue";

import AdminDeals from "./Pages/Dashboard/Admin/FlashDeals/FlashDealsMain.vue";
import AdminLogs from "./Pages/Dashboard/Admin/ActivityLog.vue";
import AdminBilling from "./Pages/Dashboard/Admin/Billing.vue";
import AdminPlan from "./Pages/Dashboard/Admin/Plan.vue";
import AdminNotification from "./Pages/Dashboard/Admin/notification.vue";
import AdminScanner from "./Pages/Dashboard/Admin/Scanner.vue";

// Import Merchant
import MerchantDashboard from "./Pages/Dashboard/Merchant/OverviewList.vue";
import MerchantProfile from "./Pages/Dashboard/Merchant/ProfileList.vue";
import MerchantDiscount from "./Pages/Dashboard/Merchant/Discount/DiscountList.vue";
import MerchantDiscountRegister from "./Pages/Dashboard/Merchant/Discount/DiscountRegister.vue";
import MerchantAnalytics from "./Pages/Dashboard/Merchant/Analytics.vue";
import MerchantRaffle from "./Pages/Dashboard/Merchant/Raffle/RaffleList.vue";
import MerchantRaffleCreate from "./Pages/Dashboard/Merchant/Raffle/AddRaffle.vue";
import MerchantRaffleRegister from "./Pages/Dashboard/Merchant/Raffle/RaffleRegister.vue";
import MerchantDeals from "./Pages/Dashboard/Merchant/FlashDeals/FlashDealsMain.vue";
import MerchantLogs from "./Pages/Dashboard/Merchant/ActivityLog.vue";
import MerchantBilling from "./Pages/Dashboard/Merchant/Billing.vue";
import MerchantPlan from "./Pages/Dashboard/Merchant/Plan.vue";
import MerchantNotification from "./Pages/Dashboard/Merchant/notification.vue";
import MerchantScanner from "./Pages/Dashboard/Merchant/Scanner.vue";


import CustomerProfile from "./Pages/Dashboard/Customer/ProfileList.vue";
import CustomerDiscount from "./Pages/Dashboard/Customer/DiscountList.vue";
import CustomerRaffle from "./Pages/Dashboard/Customer/RaffleList.vue";
import CustomerCollection from "./Pages/Dashboard/Customer/CollectionList.vue";
import CustomerLog from "./Pages/Dashboard/Customer/ActivityLogList.vue";
import QrCode from "./Pages/Dashboard/Customer/QrCode.vue";

// import OrdeLists from './Pages/Merchant/Orders/list.vue';


import NotFound from "./Pages/Error/404.vue";
import Index from "./Pages/Home/HomeList.vue";
import About from "./Pages/About/AboutUsList.vue";
import Tripidkard from "./Pages/Tripidkard/TripidkardList.vue";
import MerchantPage from "./Pages/Merchant/Pages.vue";
import MerchantPageList from "./Pages/Merchant/List.vue";
import MerchantPageResult from "./Pages/Merchant/MerchantResult.vue";
import JoinRaffle from "./Pages/Merchant/Raffle.vue";
import RaffleDetails from "./Pages/Merchant/RaffleDetails.vue";
import MerchantCenter from "./Pages/Merchant/Center.vue";
import MerchantSignup from "./Pages/Merchant/SignUp.vue";
import MerchantSignupTest from "./Pages/Merchant/register.vue";
import CustomerSignup from "./Pages/Customer/Signup.vue";
import DCIA from "./Pages/Dcia/DciaList.vue";
import MerchantLogin from "./Pages/Login/Login.vue";
import AdminLogin from "./Pages/Login/AdminLogin.vue";

const routesAdmin = [
    {
        path: "/administrator/dashboard/",
        name: "administrator.dashboard",
        component: AdminDashboard,
        meta: {
            title: "Admin Dashboard",
            breadcrumb: "administrator/dashboard",
            requiresAdminAuth: true,
        },
    },

    {
        path: "/administrator/merchant/list",
        name: "administrator.merchant.list",
        component: MerchantList,
        meta: {
            title: "Merchant List",
            breadcrumb: "administrator/merchant/list",
            requiresAdminAuth: true,
        },
    },
    {
        path: "/administrator/merchant/pending",
        name: "administrator.merchant.pending",
        component: MerchantPending,
        meta: {
            title: "Merchant Pending",
            breadcrumb: "administrator/merchant/pending",
            requiresAdminAuth: true,
        },
    },

    {
        path: "/administrator/merchant/archived",
        name: "administrator.merchant.archived",
        component: MerchantArchive,
        meta: {
            title: "Merchant Archived",
            breadcrumb: "administrator/merchant/archived",
            requiresAdminAuth: true,
        },
    },


    {
        path: "/administrator/customer/pending",
        name: "administrator.customer.pending",
        component: CustomerPending,
        meta: {
            title: "Customer Pending",
            breadcrumb: "administrator/customer/pending",
            requiresAdminAuth: true,
        },
    },


    {
        path: "/administrator/customer/list",
        name: "administrator.customer.list",
        component: CustomerList,
        meta: {
            title: "Customer List",
            breadcrumb: "administrator/customer/list",
            requiresAdminAuth: true,
        },
    },

    {
        path: "/administrator/customer/archived",
        name: "administrator.customer.archived",
        component: CustomerArchive,
        meta: {
            title: "Customer Archived",
            breadcrumb: "administrator/customer/archived",
            requiresAdminAuth: true,
        },
    },

    {
        path: "/administrator/merchant/register",
        name: "administrator.merchant.register",
        component: MerchantRegister,
        meta: {
            title: "Merchant Register",
            breadcrumb: "administrator/merchant/register",
            requiresAdminAuth: true,
        },
    },

    {
        path: "/administrator/customer/register",
        name: "administrator.customer.register",
        component: CustomerRegister,
        meta: {
            title: "Customer Register",
            breadcrumb: "administrator/customer/register",
            requiresAdminAuth: true,
        },
    },

    {
        path: "/administrator/profile/",
        name: "administrator.profile",
        component: AdminProfile,
        meta: {
            title: "Admin Profile",
            breadcrumb: "administrator/profile",
            requiresAdminAuth: true,
        },
    },
    {
        path: "/administrator/discount-list/",
        name: "administrator.discount-list",
        component: AdminDiscount,
        meta: {
            title: "Admin Discount List",
            breadcrumb: "administrator/discount-list",
            requiresAdminAuth: true,
        },
    },
    {
        path: "/administrator/activity-log/",
        name: "administrator.activity-log",
        component: AdminLogs,
        meta: {
            title: "Activity Logs List",
            breadcrumb: "administrator/activity-log",
            requiresAdminAuth: true,
        },
    },
    {
        path: "/administrator/analytics/",
        name: "administrator.analytics",
        component: AdminAnalytics,
        meta: {
            title: "Data Analytics",
            breadcrumb: "administrator/analytics",
            requiresAdminAuth: true,
        },
    },
    {
        path: "/administrator/raffle-draw/",
        name: "administrator.raffle-draw",
        component: AdminRaffle,
        meta: {
            title: "Raffle Draw",
            breadcrumb: "administrator/raffle-draw",
            requiresAdminAuth: true,
        },
    },

    {
        path: "/administrator/raffle/register",
        name: "administrator.raffle-register",
        component: AdminRaffleRegister,
        meta: {
            title: "Raffle Register",
            breadcrumb: "administrator/raffle-register",
            requiresAdminAuth: true,
        },
    },

    {
        path: "/administrator/billing/",
        name: "administrator.billing",
        component: AdminBilling,
        meta: {
            title: "Billing",
            breadcrumb: "administrator/billing",
            requiresAdminAuth: true,
        },
    },
    {
        path: "/administrator/flash-deals/",
        name: "administrator.flash-deals",
        component: AdminDeals,
        meta: {
            title: "Flash Deals",
            breadcrumb: "administrator/flash-deals",
            requiresAdminAuth: true,
        },
    },

    {
        path: "/administrator/notification/",
        name: "administrator.notification",
        component: AdminNotification,
        meta: {
            title: "Admin Notification",
            breadcrumb: "admin/notification",
            requiresAdminAuth: true,
        },
    },
    {
        path: "/administrator/plan/",
        name: "administrator.plan",
        component: AdminPlan,
        meta: {
            title: "admin Plan",
            breadcrumb: "administrator/plan",
            requiresAdminAuth: true,
        },
    },
    {
        path: "/administrator/scanner/",
        name: "administrator.scanner",
        component: AdminScanner,
        meta: {
            title: "Admin Scanner",
            breadcrumb: "administrator/scanner",
            requiresAdminAuth: true,
        },
    },
];

const routesCustomer = [
    {
        path: "/customer/profile/",
        name: "customer.profile",
        component: CustomerProfile,
        meta: {
            title: "Customer Profile",
            breadcrumb: "/customer/profile/",
            requiresCustomerAuth: true,
        },
    },
    {
        path: "/customer/discount/",
        name: "customer.discount",
        component: CustomerDiscount,
        meta: {
            title: "Customer Discount Transaction",
            breadcrumb: "/customer/discount/",
            requiresCustomerAuth: true,
        },
    },

    {
        path: "/customer/raffle/",
        name: "customer.raffle",
        component: CustomerRaffle,
        meta: {
            title: "Customer Raffle Draw",
            breadcrumb: "/customer/raffle/",
            requiresCustomerAuth: true,
        },
    },

    {
        path: "/customer/collection/",
        name: "customer.collection",
        component: CustomerCollection,
        meta: {
            title: "Customer Collection",
            breadcrumb: "/customer/collection/",
            requiresCustomerAuth: true,
        },
    },
    {
        path: "/customer/qr-code/",
        name: "customer.qr-code",
        component: QrCode,
        meta: {
            title: "Customer QR Code",
            breadcrumb: "/customer/qr-code/",
            requiresCustomerAuth: true,
        },
    },
    {
        path: "/customer/activity-log/",
        name: "customer.activity-log",
        component: CustomerLog,
        meta: {
            title: "Customer Activity Log",
            breadcrumb: "/customer/activity-log/",
            requiresCustomerAuth: true,
        },
    },
];

const routesMerchant = [
    {
        path: "/merchant/dashboard/",
        name: "merchant.dashboard",
        component: MerchantDashboard,
        meta: {
            title: "Merchant Dashboard",
            breadcrumb: "merchant/dasboard",
            requiresMerchantAuth: true,
        },
    },
    {
        path: "/merchant/profile/",
        name: "merchant.profile",
        component: MerchantProfile,
        meta: { title: "Merchant Profile", breadcrumb: "merchant/profile",
        requiresMerchantAuth: true,
         },
    },
    {
        path: "/merchant/discount-list/",
        name: "merchant.discount-list",
        component: MerchantDiscount,
        meta: {
            title: "Merchant Discount List",
            breadcrumb: "merchant/discount-list",
            requiresMerchantAuth: true,
        },
    },

    {
        path: "/merchant/discount/:card_number/register",
        name: "merchant.discount.register",
        component: MerchantDiscountRegister,
        meta: {
            title: "Merchant Discount Register",
            breadcrumb: "merchant/discount/register",
            requiresMerchantAuth: true,
        },
    },
    {
        path: "/merchant/activity-log/",
        name: "merchant.activity-log",
        component: MerchantLogs,
        meta: {
            title: "Activity Logs List",
            breadcrumb: "merchant/activity-log",
            requiresMerchantAuth: true,
        },
    },
    {
        path: "/merchant/analytics/",
        name: "merchant.analytics",
        component: MerchantAnalytics,
        meta: { title: "Data Analytics", breadcrumb: "merchant/analytics" },
        requiresMerchantAuth: true,
    },

    {
        path: "/merchant/raffle-draw/",
        name: "merchant.raffle-draw",
        component: MerchantRaffle,
        meta: { title: "Raffle Draw", breadcrumb: "merchant/raffle-draw" },
        requiresMerchantAuth: true,
    },
    {
        path: "/merchant/raffle/create",
        name: "merchant.raffle.create",
        component: MerchantRaffleCreate,
        meta: { title: "Raffle Create", breadcrumb: "merchant/raffle/create" },
        requiresMerchantAuth: true,
    },

    {
        path: "/merchant/raffle/register",
        name: "merchant.raffle.register",
        component: MerchantRaffleRegister,
        meta: { title: "Raffle Register", breadcrumb: "merchant/raffle/register" },
        requiresMerchantAuth: true,
    },
    {
        path: "/merchant/billing/",
        name: "merchant.billing",
        component: MerchantBilling,
        requiresMerchantAuth: true,
        meta: { title: "Billing", breadcrumb: "merchant/billing" },
    },
    {
        path: "/merchant/flash-deals/",
        name: "merchant.flash-deals",
        component: MerchantDeals,
        meta: { title: "Flash Deals", breadcrumb: "merchant/flash-deals" },
        requiresMerchantAuth: true,
    },

    {
        path: "/merchant/notification/",
        name: "merchant.notification",
        component: MerchantNotification,
        meta: {
            title: "Merchant Notification",
            breadcrumb: "merchant/notification",
            requiresMerchantAuth: true,
        },
    },
    {
        path: "/merchant/plan/",
        name: "merchant.plan",
        component: MerchantPlan,
        meta: { title: "Merchant Plan", breadcrumb: "merchant/plan" },
        requiresMerchantAuth: true,
    },
    {
        path: "/merchant/scanner/",
        name: "merchant.scanner",
        component: MerchantScanner,
        meta: { title: "Merchant Scanner", breadcrumb: "merchant/scanner" },
        requiresMerchantAuth: true,
    },
];

const routesInfluencer = [];

const routesDefault = [
    {
        path: "/",
        name: "home",
        component: Index,
        meta: { title: "Home", requiresGuest: true },
    },



    {
        path: "/about-us",
        name: "about-us",
        component: About,
        meta: { title: "About Us", requiresGuest: true },
    },
    {
        path: "/tripidkard",
        name: "tripidkard",
        component: Tripidkard,
        meta: { title: "Tripidkard", requiresGuest: true },
    },
    {
        path: "/merchant/page/:merchant_id",
        name: "merchant.page",
        component: MerchantPage,
        meta: {
            title: "Merchant Page",
            breadcrumb: "Home/Merchant/Page",
            requiresGuest: true,
        },
    },



    {
        path: "/merchant/list",
        name: "merchant.list",
        component: MerchantPageList,
        meta: { title: "Home", requiresGuest: true },
    },

    {
        path: "/merchant/result",
        name: "merchant.result",
        component: MerchantPageResult,
        meta: { title: "Home", requiresGuest: true },
    },
    {
        path: "/join/raffle",
        name: "join.raffle",
        component: JoinRaffle,
        meta: {
            title: "Merchant Page",
            breadcrumb: "Home/Merchant/Page",
            requiresGuest: true,
        },
    },


    {
        path: "/raffle/details/:id",
        name: "raffle.details",
        component: RaffleDetails,
        meta: {
            title: "Merchant Page",
            breadcrumb: "Home/raffle/details",
            requiresGuest: true,
        },
    },

    {
        path: "/merchant-signup",
        name: "merchant-signup",
        component: MerchantSignupTest,
        meta: {
            title: "Merchant Signup",
            breadcrumb: "Home/Merchant/Signup",
            requiresGuest: true,
        },
    },
    {
        path: "/merchant/signup",
        name: "merchant.signup",
        component: MerchantSignup,
        meta: {
            title: "Merchant Signup",
            breadcrumb: "Home/Merchant/Signup",
            requiresGuest: true,
        },
    },

    {
        path: "/dcia",
        name: "dcia",
        component: DCIA,
        meta: {
            title: "DCIA Signup",
            breadcrumb: "Home/DCIA",
            requiresGuest: true,
        },
    },
    {
        path: "/login",
        name: "login",
        component: MerchantLogin,
        meta: {
            title: "Merchant Login",
            breadcrumb: "Home/Merchant/Login",
            requiresGuest: true,
        },


    },

    {
        path: "/customer/signup",
        name: "customer.signup",
        component: CustomerSignup,
        meta: {
            title: "Customer Signup",
            breadcrumb: "Home/Customer/Signup",
            requiresGuest: true,
        },
    },


    {
        path: "/admin/login",
        name: "admin.login",
        component: AdminLogin,
        meta: {
            title: "Admin Login",
            breadcrumb: "admin/Login",
            requiresGuest: true,
        },


    },
    {
        path: "/help/center",
        name: "help.center",
        component: MerchantCenter,
        meta: {
            title: "Merchant Help center",
            breadcrumb: "Home/Merchant/Page",
            requiresGuest: true,
        },
    },

    {
        path: "/:pathMatch(.*)*",
        name: "not-found",
        component: NotFound,
        meta: { title: "Not Found" },
        requiresGuest: true,
    },
];

export {
    routesAdmin,
    routesMerchant,
    routesCustomer,
    routesDefault,
};
