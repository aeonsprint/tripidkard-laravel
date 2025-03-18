import 'preline/dist/preline.js';
import "preline/preline";
import 'material-design-icons-iconfont/dist/material-design-icons.css';
import '@fortawesome/fontawesome-free/css/all.css';  // Import Font Awesome

import { createApp } from 'vue/dist/vue.esm-bundler.js';
import { createRouter, createWebHistory } from 'vue-router';
import { routesAdmin, routesMerchant, routesCustomer, routesDefault } from './routes.js';
import { createPinia } from 'pinia';
import { useAuthStore } from './Stores/auth';

// Import NProgress for loading indicator
import NProgress from 'nprogress';
import 'nprogress/nprogress.css';

// Create Vue Router
const router = createRouter({
    routes: [...routesAdmin, ...routesMerchant, ...routesCustomer, ...routesDefault],
    history: createWebHistory(),
});

// Global Navigation Guards
router.beforeEach(async (to, from, next) => {
    NProgress.start();  // Start the progress bar

    const authStore = useAuthStore();

    // Load authUser from localStorage if not already set
    if (!authStore.authUser) {
        const storedUser = localStorage.getItem('authUser');
        if (storedUser) {
            try {
                authStore.authUser = JSON.parse(storedUser);
            } catch (error) {
                console.error('Error parsing stored user data:', error);
                localStorage.removeItem('authUser');
            }
        }
    }

    const user = authStore.authUser;

    // Prevent logged-in users from accessing the login page
    if (
        user &&
        authStore.isAuthenticated &&
        (to.path === '/login' || to.path === '/customer/signup/' || to.path === '/customer/signup' || to.path === '/admin/login' || to.path === '/merchant/signup/')
    ) {
        if (user.role === 'Admin') {
            return next({ path: '/administrator/dashboard' });
        } else if (user.role === 'Merchant') {
            return next({ path: '/merchant/dashboard' });
        } else if (user.role === 'Customer') {
            return next({ path: '/customer/profile' });
        } else {
            return next({ path: '/' });
        }
    }

    if (to.matched.some(record => record.meta.requiresAdminAuth)) {
        if (!user || !authStore.isAuthenticated || user.role !== 'Admin') {
            return next({ path: '/admin/login' });
        }
    } else if (to.matched.some(record => record.meta.requiresCustomerAuth)) {
        if (!user || !authStore.isAuthenticated || user.role !== 'Customer') {
            return next({ path: '/customer/signup' });
        }
    } else if (to.matched.some(record => record.meta.requiresMerchantAuth)) {
        if (!user || !authStore.isAuthenticated || user.role !== 'Merchant') {
            return next({ path: '/login' });
        }
    }

    next();
});

// Stop NProgress after navigation
router.afterEach(() => {
    NProgress.done();  // Stop the progress bar
});

// Create Vue App
const app = createApp({});
const pinia = createPinia();

app.use(pinia);
app.use(router);
app.mount('#app');
