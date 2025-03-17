<template>
    <!-- Hero -->
    <div
        class="relative bg-gradient-to-bl bg-[#FAFBFC] from-[#FAFBFC] via-transparent dark:from-blue-950 dark:via-transparent">
        <div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
            <!-- Grid -->
            <div class="grid items-center md:grid-cols-2 gap-8 lg:gap-12">
                <!-- Image Centered with Title Above -->
                <div class="flex flex-col items-center text-center mb-10">
                    <h1 class="text-4xl text-center font-bold text-gray-800 dark:text-white mb-6">
                        Broaden Your Influence and Captivate More Customers
                    </h1>
                    <img src="/storage/img/signup.png" alt="SignUp Image" class="max-w-full h-auto">
                </div>

                <!-- Form Section -->
                <div>
                    <form @submit.prevent="handleSubmit">

                        <div class="lg:max-w-lg lg:mx-auto lg:me-0 ms-auto">
                            <!-- Card -->
                            <div class="p-6 sm:p-7 bg-white rounded-2xl shadow-lg dark:bg-neutral-900">
                                <div class="text-center mb-5">
                                    <h2 class="text-2xl font-bold text-gray-800 dark:text-white">Create And Sign Up</h2>
                                </div>


                                <!-- Email Input -->
                                <div class="mb-4">
                                    <label for="email"
                                        class="block text-sm font-medium text-gray-700 dark:text-white">Email
                                        address</label>
                                    <input type="email" id="email" name="email" required
                                        class="w-full mt-2 px-4 py-3 border border-gray-300 rounded-lg dark:bg-neutral-900 dark:border-neutral-700 dark:text-white focus:ring-blue-500 focus:border-blue-500">
                                </div>

                                <!-- Password Input -->
                                <div class="mb-6" >
                                    <label for="password"
                                        class="block text-sm font-medium text-gray-700 dark:text-white">Password</label>
                                    <input type="password" id="password" name="password" required
                                        class="w-full mt-2 px-4 py-3 border border-gray-300 rounded-lg dark:bg-neutral-900 dark:border-neutral-700 dark:text-white focus:ring-blue-500 focus:border-blue-500">
                                </div>

                                <!-- Login Button -->
                                <div class="mb-4">
                                    <button type="submit"
                                        class="w-full py-3 px-4 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700">
                                        Log In
                                    </button>
                                </div>

                                <!-- Sign-in Options -->
                                <div class="flex gap-4">
                                    <button type="button" @click.prevent="handleGoogleAuth" :disabled="loadingGoogle"
                                        class="w-full  text-gray-800 text-sm font-medium  border border-red-600 py-3 rounded-lg flex items-center justify-center gap-2 bg-white hover:text-red-600">

                                        <GoogleIcon class="w-5 h-5" />
                                        {{ loadingGoogle ? 'Loading...' : 'Sign Up with Google' }}
                                    </button>
                                    <button type="button" @click.prevent="handleFacebookAuth"
                                        :disabled="loadingFacebook"
                                        class="w-full  text-gray-800 text-sm font-medium  border border-blue-600 py-3 rounded-lg flex items-center justify-center gap-2 bg-white hover:text-blue-600">
                                        <FacebookIcon class="w-5 h-5" />
                                        {{ loadingFacebook ? 'Loading...' : 'Sign Up with Facebook' }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- End Grid -->
        </div>
    </div>
    <!-- End Hero -->
</template>


<script setup>
import { reactive, ref, onMounted } from 'vue';
import { useRouter } from 'vue-router';
import { useAuthStore } from '@/Stores/auth';
import GoogleIcon from '@/Components/Atoms/svg/google.vue';
import FacebookIcon from '@/Components/Atoms/svg/facebook.vue';

const authStore = useAuthStore();
const router = useRouter();

const form = reactive({
    email: '',
    password: ''
});

const errors = reactive({
    email: '',
    password: '',
    general: ''
});

const loading = ref(false);
const loadingGoogle = ref(false);
const loadingFacebook = ref(false);
const handleSubmit = async () => {
    loading.value = true;
    errors.email = '';
    errors.password = '';
    errors.general = '';
    const loadingGoogle = ref(false);
    const loadingFacebook = ref(false);


    try {
        const responseErrors = await authStore.customerLoginForm(form);

        if (responseErrors) {
            errors.email = responseErrors.email ? responseErrors.email[0] : '';
            errors.password = responseErrors.password ? responseErrors.password[0] : '';
            errors.general = responseErrors.general ? responseErrors.general : '';
        } else {
            // Handle successful login and redirect based on role
            const userRole = authStore.user.role;
            if (userRole === 'Customer') {
                router.push('/customer/profile');
            } else {
                router.push('/');
            }
            window.location.reload(); // Reload after redirect

        }
    } catch (error) {
        errors.general = 'An unexpected error occurred. Please try again.';
    } finally {
        loading.value = false;
    }
};

const handleGoogleAuth = async () => {
    loadingGoogle.value = true;
    try {
        window.location.href = '/auth/google';
    } catch (error) {
        console.error(error);
    } finally {
        loadingGoogle.value = false;
    }
};



const handleFacebookAuth = async () => {
    loadingFacebook.value = true;
    try {
        window.location.href = '/auth/facebook';
    } catch (error) {
        console.error(error);
    } finally {
        loadingFacebook.value = false;
    }
};

onMounted(() => {
    authStore.getUser();
});
</script>
