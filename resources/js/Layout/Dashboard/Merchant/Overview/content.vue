<template>


      <!-- Grid -->
      <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">

        <!-- Card -->
        <div class="flex flex-col bg-white border shadow-sm rounded-xl dark:bg-neutral-800 dark:border-neutral-700">
          <div class="p-4 md:p-5">
            <div class="flex items-center gap-x-2">
              <p class="text-xs uppercase tracking-wide text-gray-500 dark:text-neutral-500">
                Discount Offered
              </p>
              <div class="hs-tooltip">
                <div class="hs-tooltip-toggle text-1xl text-blue-400">
                  %
                </div>
              </div>
            </div>

            <div class="mt-1 flex items-center gap-x-2">
              <h3 class="text-xl sm:text-3xl font-medium text-gray-800 dark:text-neutral-200">
               {{ authStore.user.discount }}% OFF
              </h3>
            </div>
          </div>
        </div>
        <!-- End Card -->


          <!-- Card -->
          <div class="flex flex-col bg-white border shadow-sm rounded-xl dark:bg-neutral-800 dark:border-neutral-700">
          <div class="p-4 md:p-5">
            <div class="flex items-center gap-x-2">
              <p class="text-xs uppercase tracking-wide text-gray-500 dark:text-neutral-500">
              Total Views
              </p>
              <div class="hs-tooltip1">
                <div class="hs-tooltip-toggle text-1xl text-blue-400">
                  %
                </div>
              </div>
            </div>

            <div class="mt-1 flex items-center gap-x-2">
              <h3 class="text-xl sm:text-3xl font-medium text-gray-800 dark:text-neutral-200">
                {{ authStore.user.views }}
              </h3>
            </div>
          </div>
        </div>
        <!-- End Card -->



          <!-- Card -->
          <div class="flex flex-col bg-white border shadow-sm rounded-xl dark:bg-neutral-800 dark:border-neutral-700">
          <div class="p-4 md:p-5">
            <div class="flex items-center gap-x-2">
              <p class="text-xs uppercase tracking-wide text-gray-500 dark:text-neutral-500">
                Likes / Hearts
              </p>
              <div class="hs-tooltip1">
                <div class="hs-tooltip-toggle text-1xl text-blue-400">
                  %
                </div>
              </div>
            </div>

            <div class="mt-1 flex items-center gap-x-2">
              <h3 class="text-xl sm:text-3xl font-medium text-gray-800 dark:text-neutral-200">
              {{ totalLikes }}

              </h3>
            </div>
          </div>
        </div>
        <!-- End Card -->



          <!-- Card -->
          <div class="flex flex-col bg-white border shadow-sm rounded-xl dark:bg-neutral-800 dark:border-neutral-700">
          <div class="p-4 md:p-5">
            <div class="flex items-center gap-x-2">
              <p class="text-xs uppercase tracking-wide text-gray-500 dark:text-neutral-500">
                Bookmarks / Saves
              </p>
              <div class="hs-tooltip1">
                <div class="hs-tooltip-toggle text-1xl text-blue-400">
                  %
                </div>
              </div>
            </div>

            <div class="mt-1 flex items-center gap-x-2">
              <h3 class="text-xl sm:text-3xl font-medium text-gray-800 dark:text-neutral-200">
              <!-- total bookmark -->
              {{ totalBookmarks }}
              </h3>
            </div>
          </div>
        </div>
        <!-- End Card -->

      </div>
      <!-- End Grid -->

</template>
<script>
import { useAuthStore } from "@/Stores/auth";
import { ref, onMounted } from "vue";
import axios from "axios";

export default {
    setup() {
        const authStore = useAuthStore();
        const totalBookmarks = ref(0);
        const totalLikes = ref(0);

        const countBookmarks = async () => {
            try {
                const response = await axios.get("/api/bookmarks/count");
                totalBookmarks.value = response.data.totalBookmarks;
            } catch (error) {
                console.error("Error Count bookmarks:", error);
            }
        };

        const countlikes = async () => {
            try {
                const response = await axios.get("/api/likes/count");
                totalLikes.value = response.data.totalLikes;
            } catch (error) {
                console.error("Error Count Likes:", error);
            }
        };

        onMounted(() => {
            countBookmarks();
            countlikes();
        });

        return {
            authStore,
            totalBookmarks,
            totalLikes

        };
    },
};
</script>
