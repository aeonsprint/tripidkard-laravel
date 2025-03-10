<template>
    <Header />
    <Sidebar />
    <div class="w-full lg:ps-64 bg-[#f7f9fa]">
        <div class="p-6 space-y-6">

            <div >
                <h1 class="text-2xl font-bold text-blue-500">Scan QR Code</h1>
                <p class="text-gray-500">Scan customer cards to retrieve information.</p>
            </div>

            <!-- Scanner Box -->
            <div class="max-w-[80%] mx-auto bg-white p-6 rounded-lg shadow-lg">
                <h3 class="text-xl font-semibold text-center text-gray-800">SCAN QR CODE CARD NUMBER</h3>

                <!-- Error Message -->
                <div v-if="errorMessage" class="alert alert-danger mt-3 text-center text-red-500">
                    {{ errorMessage }}
                </div>

                <!-- Card Number Input -->
                <div class="mt-4 text-center">
                    <input type="text" v-model="cardNumber" placeholder="CARD NUMBER"
                        class="w-full px-4 py-2 border rounded-lg text-center"
                        @input="handleInput" @keyup.enter="handleInput" />
                </div>

                <!-- Scanner UI -->
                <div class="mt-4 border rounded-lg p-4 text-center relative bg-gray-100">
                    <div id="my-qr-reader" class="scanner-overlay"></div>
                </div>


            </div>

        </div>
    </div>
</template>

<script>
import Header from '@/Layout/Dashboard/header.vue';
import Sidebar from '@/Layout/Sidebar/adminSidebar.vue';
import axios from 'axios';
import { ref, onMounted } from 'vue';
import { Html5QrcodeScanner } from 'html5-qrcode';
import { useRouter } from 'vue-router';

export default {
    components: {
        Header,
        Sidebar,
    },
    setup() {
        const cardNumber = ref('');
        const errorMessage = ref(null);
        const router = useRouter();

        onMounted(() => {
            startQrScanner();
        });

        const startQrScanner = () => {
            const html5QrCodeScanner = new Html5QrcodeScanner(
                "my-qr-reader",
                { fps: 10, qrbox: 550 }
            );

            html5QrCodeScanner.render(onScanSuccess);

            function onScanSuccess(decodedText) {
                console.log(`QR Code detected: ${decodedText}`);
                cardNumber.value = decodedText;
                handleInput();
                html5QrCodeScanner.clear();
            }
        };

        const handleInput = async () => {
            errorMessage.value = null;

            try {
                const response = await axios.post('/api/home/qrcode', {
                    card_number: cardNumber.value
                });

                if (response.data.card_exists) {
                    router.push({
                        name: 'customer.information',
                        params: { card_number: response.data.card_number },
                    });
                } else {
                    throw new Error(response.data.error || 'Customer Card not found');
                }
            } catch (error) {
                console.error('Error:', error);
                errorMessage.value = error.response?.data?.error || 'An unexpected error occurred';
            }
        };

        return {
            cardNumber,
            errorMessage,
            handleInput,
        };
    }
};
</script>

<style>
span#html5-qrcode-anchor-scan-type-change {
    display: none !important;
}

.html5-qrcode-element {
    border: 1px solid blue;
    padding: 10px;
}
</style>
