<template>
    <Header />
    <Sidebar />
    <div class="w-full lg:ps-64 bg-[#f7f9fa]">
        <div class="p-4 sm:p-6 space-y-4 sm:space-y-6">
            <div>
                <h1 class="text-2xl font-bold text-blue-500">Raffle Register</h1>
                <p class="text-gray-500">View and manage all Raffle</p>

                <Stepper :steps="steps" @finish="finish">
                    <template v-slot="{ currentStep }">
                        <!-- Step 1: Raffle Title -->
                        <div v-if="currentStep === 1">
                            <h3 class="text-lg font-semibold text-center mb-6">Raffle Title</h3>
                            <div class="w-full max-w-lg mx-auto space-y-4">
                                <div v-for="field in titleFields" :key="field.name" class="flex flex-col">
                                    <label class="text-gray-700 text-sm font-medium">
                                        {{ field.label }} <span class="text-red-400" v-if="field.required">*</span>
                                    </label>

                                    <input
                                        v-if="field.name !== 'mechanics'"
                                        v-model="raffleData[field.name]"
                                        :type="field.type"
                                        :placeholder="field.placeholder || ''"
                                        class="w-full px-4 py-2 border rounded-lg text-gray-900 border-gray-300 focus:ring-2 focus:ring-blue-600"
                                    />

                                    <!-- TinyMCE Editor -->
                                    <editor
                                        v-if="field.name === 'mechanics'"
                                        api-key="q9ewhjrrgwohcerrj0rfwrtymdxrm87537ddmojq66nyefpv"
                                        v-model="raffleData.mechanics"
                                        :init="{
                                            height: 300,
                                            menubar: false,
                                            plugins: 'lists link image',
                                            toolbar: 'undo redo | bold italic | bullist numlist outdent indent'
                                        }"
                                        @input="updateMechanics"
                                    />
                                </div>
                            </div>
                        </div>

                        <!-- Step 2: Raffle Entries -->
                        <div v-if="currentStep === 2">
                            <h3 class="text-lg font-semibold text-center mb-6">Raffle Entries</h3>
                            <div class="w-full max-w-lg mx-auto space-y-4">
                                <div v-for="field in entriesFields" :key="field.name" class="flex flex-col">
                                    <label class="text-gray-700 text-sm font-medium">
                                        {{ field.label }} <span class="text-red-400" v-if="field.required">*</span>
                                    </label>
                                    <input
                                        v-model="raffleData[field.name]"
                                        :type="field.type"
                                        class="w-full px-4 py-2 border rounded-lg text-gray-900 border-gray-300 focus:ring-2 focus:ring-blue-600"
                                    />
                                </div>
                            </div>
                        </div>

                        <!-- Step 3: Images Poster -->
                        <div v-if="currentStep === 3">
                            <h3 class="text-lg font-semibold text-center mb-6">Images Poster</h3>
                            <div class="w-full max-w-lg mx-auto space-y-4">
                                <div class="flex flex-col">
                                    <label class="text-gray-700 text-sm font-medium">
                                        Upload Image <span class="text-red-400">*</span>
                                    </label>
                                    <input
                                        type="file"
                                        accept="image/png, image/jpeg"
                                        @change="handleFileUpload"
                                        class="w-full px-4 py-2 border rounded-lg text-gray-900 border-gray-300 focus:ring-2 focus:ring-blue-600"
                                    />
                                </div>

                                <!-- Image Preview -->
                                <div v-if="imagePreview" class="mt-4 text-center">
                                    <p class="text-gray-500 text-sm">Preview:</p>
                                    <img
                                        :src="imagePreview"
                                        alt="Image Preview"
                                        class="w-40 h-40 object-cover rounded-lg mx-auto border"
                                    />
                                </div>
                            </div>
                        </div>
                    </template>
                </Stepper>
            </div>
        </div>
    </div>
</template>

<script>
import Header from '@/Layout/Dashboard/header.vue';
import Sidebar from '@/Layout/Sidebar/merchantSidebar.vue';
import Stepper from '@/Layout/Merchant/Stepper.vue';
import Swal from 'sweetalert2';
import axios from 'axios';
import Editor from '@tinymce/tinymce-vue';

export default {
    components: {
        Header,
        Sidebar,
        Stepper,
        Editor
    },
    data() {
        return {
            steps: [
                { index: 1, label: 'Raffle Title' },
                { index: 2, label: 'Entry' },
                { index: 3, label: 'Images' },
            ],
            titleFields: [
                { name: 'title', label: 'Raffle Title', type: 'text', required: true },
                { name: 'prize', label: 'Raffle Prize', type: 'text', required: true },
                { name: 'mechanics', label: 'Raffle Mechanics', type: 'text', required: true },
            ],
            entriesFields: [
                { name: 'total_winner', label: 'No. of Winners', type: 'number', required: true },
                { name: 'entries_deadline', label: 'Entries Deadline', type: 'date', required: true },
                { name: 'draw_date', label: 'Draw Date', type: 'date', required: true },
            ],
            raffleData: {
                title: '',
                prize: '',
                mechanics: '',
                total_winner: '',
                entries_deadline: '',
                draw_date: '',
            },
            imageFile: null,
            imagePreview: null,
        };
    },
    methods: {
        updateMechanics(value) {
            this.raffleData.mechanics = value;
        },
        handleFileUpload(event) {
            const file = event.target.files[0];
            if (file && ['image/png', 'image/jpeg'].includes(file.type)) {
                this.imageFile = file;
                this.imagePreview = URL.createObjectURL(file);
            } else {
                Swal.fire("Invalid File", "Please upload a PNG or JPG image.", "warning");
            }
        },
        async finish() {
            console.log("Submitting raffleData:", this.raffleData);

            if (!this.raffleData.title || !this.raffleData.prize || !this.raffleData.mechanics) {
                Swal.fire("Error", "Please fill in all required fields.", "error");
                return;
            }

            const formData = new FormData();
            Object.keys(this.raffleData).forEach(key => formData.append(key, this.raffleData[key]));
            if (this.imageFile) {
                formData.append('image', this.imageFile);
            }

            try {
                const response = await axios.post('/api/raffles/create', formData, {
                    headers: { 'Content-Type': 'multipart/form-data' }
                });
                Swal.fire("Success", "Raffle Created Successfully!", "success");
                this.$router.push('/merchant/raffle-draw');
            } catch (error) {
                Swal.fire("Error", error.response?.data?.error || "Something went wrong!", "error");
            }
        }
    }
}
</script>
