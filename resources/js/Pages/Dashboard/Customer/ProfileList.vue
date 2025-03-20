<template>
   <TopBar />
    <div class="flex w-full lg:ps-20 max-w-[80rem] bg-[#f7f9fa]">
      <!-- Sidebar -->
      <Sidebar />
        <!-- Main Content -->
        <div class="w-full  bg-[#f7f9fa]">

            <div class="p-4 sm:p-6 space-y-4 sm:space-y-6">
                <div class="flex space-x-4 border-b pb-2">
                    <a href="#" class="px-4 py-2 border-b-2 rounded-md transition" :class="activeTab === 'profile'
                        ? 'bg-blue-500 text-white border-blue-500'
                        : 'text-gray-700 border-transparent hover:bg-gray-200'" @click.prevent="activeTab = 'profile'">
                        Customer Information
                    </a>


                    <a href="#" class="px-4 py-2 border-b-2 rounded-md transition" :class="activeTab === 'address'
                        ? 'bg-blue-500 text-white border-blue-500'
                        : 'text-gray-700 border-transparent hover:bg-gray-200'" @click.prevent="activeTab = 'address'">
                        Customer Address
                    </a>

                    <a href="#" class="px-4 py-2 border-b-2 rounded-md transition" :class="activeTab === 'password'
                        ? 'bg-blue-500 text-white border-blue-500'
                        : 'text-gray-700 border-transparent hover:bg-gray-200'" @click.prevent="activeTab = 'password'">
                        Security
                    </a>

                    <a href="#" class="px-4 py-2 border-b-2 rounded-md transition" :class="activeTab === 'logo'
                        ? 'bg-blue-500 text-white border-blue-500'
                        : 'text-gray-700 border-transparent hover:bg-gray-200'" @click.prevent="activeTab = 'logo'">
                        Profile Picture
                    </a>


                </div>

                <div class="container mx-auto grid lg:grid-cols-1 gap-1 sm:gap-6 bg-white p-6 rounded-lg shadow-md">
                    <!-- Profile Form -->
                    <div v-if="activeTab === 'profile'">
                        <h2 class="text-2xl font-bold text-gray-800">Customer Profile</h2>
                        <p class="text-gray-500 text-sm mb-6">Setup your Customer Profile</p>
                        <div class="max-w-2xl mx-auto">

                            <!-- Display Name -->
                            <div class="flex justify-between items-center bg-blue-100 p-4 rounded-lg mt-4">
                                <span class="text-3xl font-bold text-blue-600">{{ userData.fname }} {{ userData.mname }}
                                    {{
                                        userData.lname }}</span>
                            </div>

                            <form @submit.prevent="updateProfile">
                                <input type="text" v-model="userData.fname"
                                    class="w-full border-gray-300 rounded-lg p-3 mt-5 focus:border-blue-500 focus:ring-blue-500"
                                    placeholder="First Name" />

                                <input type="text" v-model="userData.mname"
                                    class="w-full border-gray-300 rounded-lg p-3 mt-5 focus:border-blue-500 focus:ring-blue-500"
                                    placeholder="Middle Name" />

                                <input type="text" v-model="userData.lname"
                                    class="w-full border-gray-300 rounded-lg p-3 mt-5 focus:border-blue-500 focus:ring-blue-500"
                                    placeholder="Last Name" />

                                <input type="text" v-model="userData.email"
                                    class="w-full border-gray-300 rounded-lg p-3 mt-5 focus:border-blue-500 focus:ring-blue-500"
                                    placeholder="Email Address" />

                                <input type="text" v-model="userData.contact"
                                    class="w-full border-gray-300 rounded-lg p-3 mt-5 focus:border-blue-500 focus:ring-blue-500"
                                    placeholder="Contact Number" />

                                <button
                                    class="w-full bg-blue-600 text-white py-3 rounded-lg mt-6 font-medium hover:bg-blue-700 transition">
                                    Update
                                </button>
                            </form>
                        </div>
                    </div>
                    <!-- End Profile Form -->


                    <!-- Address Form -->
                    <div v-if="activeTab === 'address'">
                        <h2 class="text-2xl font-bold text-gray-800 ">Customer Address</h2>
                        <p class="text-gray-500 text-sm mb-6"> your address efficiently </p>

                        <div class="max-w-2xl mx-auto ">

                            <!-- Discount Percentage -->
                            <div class="flex justify-between items-center bg-blue-100 p-4 rounded-lg mt-4">
                                <span class="text-3xl font-bold text-blue-600 mx-auto">{{ userData.customer_card_num }} </span>
                                <span class="flex items-center text-green-600 font-medium">
                                </span>
                            </div>
                            <form @submit.prevent="updateAddress">

                                <!--  Input -->
                                <input type="text" v-model="userData.street"
                                    class="w-full  border-gray-300 rounded-lg p-3 mt-5 focus:border-blue-500 focus:ring-blue-500"
                                    placeholder="Sreet" />


                                <!--  Input -->
                                <input type="text"
                                    class="w-full  border-gray-300 rounded-lg p-3 mt-5 focus:border-blue-500 focus:ring-blue-500"
                                    placeholder="City" v-model="userData.city" />



                                <!--  Input -->
                                <input type="text"
                                    class="w-full  border-gray-300 rounded-lg p-3 mt-5 focus:border-blue-500 focus:ring-blue-500"
                                    placeholder="Province" v-model="userData.province" />


                                <!--  Input -->
                                <input type="text"
                                    class="w-full  border-gray-300 rounded-lg p-3 mt-5 focus:border-blue-500 focus:ring-blue-500"
                                    placeholder="Zip Code" v-model="userData.zip" />


                                <!-- Edit Button -->
                                <button
                                    class="w-full bg-blue-600 text-white py-3 rounded-lg mt-6 font-medium hover:bg-blue-700 transition">
                                    Update
                                </button>
                            </form>


                        </div>
                    </div>
                    <!-- End Address Form -->


                    <!-- Address Form -->
                    <div v-if="activeTab === 'password'">
                        <h2 class="text-2xl font-bold text-gray-800 ">Password Management</h2>
                        <p class="text-gray-500 text-sm mb-6">Manage your Password</p>

                        <div class="max-w-2xl mx-auto ">

                            <!-- Discount Percentage -->

                            <form @submit.prevent="updatePassword">

                                <!-- Title Input -->
                                <label class="block mt-4 text-gray-700 font-medium">Old Password</label>
                                <input type="password"
                                    class="w-full border-gray-300 rounded-lg p-3 mt-1 focus:border-blue-500 focus:ring-blue-500"
                                    placeholder="Password" v-model="userData.currentPassword" />

                                <!-- Title Input -->
                                <label class="block mt-4 text-gray-700 font-medium">Confirm Password</label>
                                <input type="password"
                                    class="w-full border-gray-300 rounded-lg p-3 mt-1 focus:border-blue-500 focus:ring-blue-500"
                                    placeholder="Password" v-model="userData.password_confirmation" />

                                <!-- Title Input -->
                                <label class="block mt-4 text-gray-700 font-medium">New Password</label>
                                <input type="password"
                                    class="w-full border-gray-300 rounded-lg p-3 mt-1 focus:border-blue-500 focus:ring-blue-500"
                                    placeholder="Password" v-model="userData.password" />




                                <!-- Edit Button -->
                                <button
                                    class="w-full bg-blue-600 text-white py-3 rounded-lg mt-6 font-medium hover:bg-blue-700 transition">
                                    Update
                                </button>
                            </form>

                        </div>
                    </div>
                    <!-- End Address Form -->


                    <!-- Logo Form -->
                    <div v-if="activeTab === 'logo'">
                        <h2 class="text-2xl font-bold text-gray-800">Profile Picture Management</h2>
                        <p class="text-gray-500 text-sm mb-6">Upload and manage your Profile Picture</p>

                        <div class="max-w-2xl mx-auto">
                            <form @submit.prevent="uploadLogo">
                                <FileUpload :maxFiles="1" :maxSize="2 * 1024 * 1024" accept="image/png, image/jpeg"
                                    @files-selected="handleFiles" v-model="userData.logo" />

                                <!-- Logo Preview -->
                                <div v-if="imagePreview" class="mt-4">
                                    <p class="text-gray-600 text-sm">Preview:</p>
                                    <img :src="imagePreview" alt="Logo Preview"
                                        class="w-32 h-32 object-cover rounded-md">
                                </div>

                                <button
                                    class="w-full bg-blue-600 text-white py-3 rounded-lg mt-6 font-medium hover:bg-blue-700 transition">
                                    Upload
                                </button>
                            </form>
                        </div>
                    </div>
                    <!-- End Logo Form -->



                    <!-- End Images Form -->
                </div>
            </div>
        </div>
    </div>
    <Footer />

</template>

<script setup>
import Logo from '@/Components/Atoms/Logo.vue';
import Sidebar from '@/Components/Organisms/Customer/Sidebar.vue';
import TopBar from '@/Components/Organisms/TopBar.vue';
import Footer from '@/Components/Organisms/Footer.vue';
import { ref, onMounted } from "vue";
import axios from "axios";
import { useAuthStore } from "@/Stores/auth";
import Swal from "sweetalert2";
import FileUpload from "@/Components/Molecules/FileUpload.vue";

const authStore = useAuthStore();
const activeTab = ref("profile");
const imageFile = ref(null);
const imagePreview = ref(null);
// Reactive copy of user data

const userData = ref({
    fname: "",
    mname: "",
    lname: "",
    email: "",
    contact: "",
    street: "",
    customer_card_num: "",
    bdate: "",
    validity: "",
    city: "",
    province: "",
    zip: "",
    currentPassword: "",
    password_confirmation: "",
    password: "",
    logo: "",

});


// Load user data on mount
onMounted(() => {
    if (authStore.authUser) {
        userData.value = { ...authStore.authUser };
    } else if (authStore.authUser?.avatar) {
        imagePreview.value = authStore.authUser.avatar; // Load existing logo
    }
});



// Function to update profile
const updateProfile = async () => {
    try {
        const response = await axios.put("/api/user/update-profile", {
            fname: userData.value.fname,
            mname: userData.value.mname,
            lname: userData.value.lname,
            email: userData.value.email,
            contact: userData.value.contact,
        });

        // Update the authStore after successful update
        authStore.authUser = { ...authStore.authUser, ...response.data.user };

        Swal.fire("Success!", response.data.message || "Profile updated successfully.", "success");
    } catch (error) {
        Swal.fire("Error!", error.response?.data?.message || "Something went wrong.", "error");
    }
};


// Function to update profile
const updateAddress = async () => {
    try {
        const response = await axios.put("/api/user/update-address", {
            business_name: userData.value.business_name,
            street: userData.value.street,
            city: userData.value.city,
            province: userData.value.province,
            zip: userData.value.zip,
        });

        // Update the authStore after successful update
        authStore.authUser = { ...authStore.authUser, ...response.data.user };

        Swal.fire("Success!", response.data.message || "Address updated successfully.", "success");
    } catch (error) {
        Swal.fire("Error!", error.response?.data?.message || "Something went wrong.", "error");
    }
};

const updatePassword = async () => {
    try {
        const response = await axios.put("/api/user/update-password", {
            currentPassword: userData.value.currentPassword,
            password: userData.value.password,
            password_confirmation: userData.value.password_confirmation,
        });

        // Update the authStore after successful update
        authStore.authUser = { ...authStore.authUser, ...response.data.user };

        Swal.fire("Success!", response.data.message || "Password updated successfully.", "success");

        // Clear password fields after successful update
        userData.value.currentPassword = "";
        userData.value.password = "";
        userData.value.password_confirmation = "";
    } catch (error) {
        Swal.fire("Error!", error.response?.data?.message || "Something went wrong.", "error");
    }
};


const uploadLogo = async () => {
    if (!userData.value.logo) {
        Swal.fire("Error!", "Please select a logo to upload.", "error");
        return;
    }

    try {
        let formData = new FormData();
        formData.append("logo", userData.value.logo);

        const response = await axios.post("/api/user/upload-logo", formData, {
            headers: { "Content-Type": "multipart/form-data" }
        });

        // Update user logo in auth store
        authStore.authUser.avatar = response.data.avatar;
        imagePreview.value = response.data.avatar; // Update preview

        Swal.fire("Success!", response.data.message || "Logo uploaded successfully.", "success");
    } catch (error) {
        Swal.fire("Error!", error.response?.data?.message || "Something went wrong.", "error");
    }
};

</script>
