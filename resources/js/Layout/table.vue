    <template>
        <div class="max-w-7xl mx-auto p-6 bg-white shadow-md ">
            <div class="flex flex-col">
                <div class="flex justify-between items-center pb-3">
                    <!-- Search Box -->
                    <div class="relative max-w-xs">
                        <label for="hs-table-input-search" class="sr-only">Search</label>
                        <input type="text" v-model="searchQuery" id="hs-table-input-search"
                            class="py-2 px-3 ps-9 block w-full border-gray-300 shadow-sm  text-sm focus:border-blue-500 focus:ring-blue-500"
                            placeholder="Search for items" />
                        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                            <svg class="size-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="11" cy="11" r="8"></circle>
                                <path d="m21 21-4.3-4.3"></path>
                            </svg>
                        </div>
                    </div>

                    <!-- Export Dropdown -->
                    <div class="relative">
                        <button @click="toggleDropdown"
                            class="px-5 rounded-sm py-2 border text-sm bg-blue-500 text-white hover:bg-blue-600">
                            Export ▼
                        </button>
                        <div v-if="dropdownOpen"
                            class="absolute right-0 mt-2 w-40 bg-white border  shadow-md">
                            <button @click="exportToCSV"
                                class="block w-full text-left px-4 py-2 text-sm hover:bg-gray-200">Download CSV</button>
                            <button @click="exportToExcel"
                                class="block w-full text-left px-4 py-2 text-sm hover:bg-gray-200">Download
                                Excel</button>
                            <button @click="copyTable"
                                class="block w-full text-left px-4 py-2 text-sm hover:bg-gray-200">Copy Table</button>
                        </div>
                    </div>
                </div>

                <!-- Table -->
                <div
                    :class="['overflow-hidden', paginatedData.length ? 'border border-gray-300 shadow-sm rounded-lg' : '']">
                    <table class="min-w-full">
                        <thead class="bg-gray-100 border-b border-gray-300">
                            <tr>
                                <th v-for="(col, index) in columns" :key="index"
                                    class="py-3 px-4 text-left text-sm font-semibold text-gray-700">
                                    {{ col.label }}
                                </th>
                            </tr>
                        </thead>
                        <tbody v-if="paginatedData.length" class="divide-y divide-gray-300">
                            <tr v-for="(item, index) in paginatedData" :key="index">
                                <td v-for="(col, colIndex) in columns" :key="colIndex"
                                    class="py-3 px-4 text-sm text-gray-800">
                                    <slot v-if="col.key === 'actions'" name="actions" :row="item"></slot>
                                    <span v-else>{{ item[col.key] }}</span>
                                </td>
                            </tr>
                        </tbody>
                        <tbody v-else>
                            <tr>
                                <td :colspan="columns.length" class="py-3 px-4 text-sm text-gray-500 text-center">No
                                    data found</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div v-if="totalPages > 1" class="flex justify-left items-left mt-4 space-x-2">
                    <button @click="prevPage" :disabled="currentPage === 1"
                        class="px-3 py-1 border text-sm transition " :class="{
                            'bg-gray-200 cursor-not-allowed': currentPage === 1,
                            'bg-blue-500 text-white hover:bg-blue-600': currentPage !== 1
                        }">
                        Previous
                    </button>

                    <button v-for="page in pageNumbers" :key="page" @click="goToPage(page)"
                        class="px-3 py-1 border text-sm transition " :class="{
                            'bg-blue-500 text-white': currentPage === page,
                            'hover:bg-gray-200': currentPage !== page
                        }">
                        {{ page }}
                    </button>

                    <button @click="nextPage" :disabled="currentPage === totalPages"
                        class="px-3 py-1 border text-sm transition " :class="{
                            'bg-gray-200 cursor-not-allowed': currentPage === totalPages,
                            'bg-blue-500 text-white hover:bg-blue-600': currentPage !== totalPages
                        }">
                        Next
                    </button>
                </div>
            </div>
        </div>
    </template>

<script>
import * as XLSX from "xlsx";
import Swal from "sweetalert2";
export default {
    props: {
        tableData: {
            type: Array,
            default: () => []
        },
        columns: {
            type: Array,
            default: () => []
        }
    },
    data() {
        return {
            searchQuery: '',
            currentPage: 1,
            perPage: 10,
            dropdownOpen: false
        };
    },
    computed: {
        filteredData() {
            return this.tableData
                ? this.tableData.filter(item =>
                    Object.values(item).some(value =>
                        String(value).toLowerCase().includes(this.searchQuery.toLowerCase())
                    )
                )
                : [];
        },
        paginatedData() {
            const start = (this.currentPage - 1) * this.perPage;
            return this.filteredData.slice(start, start + this.perPage);
        },
        totalPages() {
            return this.filteredData.length > 0 ? Math.ceil(this.filteredData.length / this.perPage) : 1;
        },
        pageNumbers() {
            return this.totalPages ? Array.from({ length: this.totalPages }, (_, i) => i + 1) : [];
        }
    },
    watch: {
        searchQuery() {
            this.currentPage = 1;
        }
    },
    methods: {
        nextPage() {
            if (this.currentPage < this.totalPages) this.currentPage++;
        },
        prevPage() {
            if (this.currentPage > 1) this.currentPage--;
        },
        goToPage(page) {
            this.currentPage = page;
        },
        toggleDropdown() {
            this.dropdownOpen = !this.dropdownOpen;
        },
        exportToCSV() {
            const csvContent = [
                this.columns.map(col => col.label).join(","), // Header row
                ...this.tableData.map(row => this.columns.map(col => row[col.key]).join(","))
            ].join("\n");

            const blob = new Blob([csvContent], { type: "text/csv" });
            const link = document.createElement("a");
            link.href = URL.createObjectURL(blob);
            link.download = "merchant_data.csv";
            link.click();
        },
        exportToExcel() {
            const worksheet = XLSX.utils.json_to_sheet(this.tableData);
            const workbook = XLSX.utils.book_new();
            XLSX.utils.book_append_sheet(workbook, worksheet, "Sheet1");
            XLSX.writeFile(workbook, "merchant_data.xlsx");
        },
        copyTable() {
            const text = this.tableData.map(row =>
                this.columns.map(col => row[col.key]).join("\t")
            ).join("\n");

            navigator.clipboard.writeText(text).then(() => {
                Swal.fire({
                    icon: "success",
                    title: "Copied!",
                    text: "Table data has been copied to clipboard.",
                    timer: 2000,
                    showConfirmButton: false
                });
            }).catch(() => {
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Failed to copy table data.",
                });
            });
        }
    }
};
</script>
