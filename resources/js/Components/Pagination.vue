<template>
  <div v-if="meta && meta.last_page > 1" class="max-w-7xl mx-auto py-6">
    <div class="max-w-none mx-auto">
      <div class="bg-white overflow-hidden shadow sm:rounded-lg">
        <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
          
          <!-- Showing results info -->
          <div>
            <p class="text-sm text-gray-700">
              Showing
              <span class="font-medium">{{ meta.from }}</span>
              to
              <span class="font-medium">{{ meta.to }}</span>
              of
              <span class="font-medium">{{ meta.total }}</span>
              results
            </p>
          </div>

          <!-- Pagination buttons -->
          <div>
            <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
              <!-- Previous Button -->
              <button 
                @click="goToPage(meta.current_page - 1)" 
                :disabled="meta.current_page === 1"
                class="relative inline-flex items-center px-4 py-2 border text-sm font-medium bg-white border-gray-300 text-gray-500 hover:bg-gray-50"
              >
                <span>Previous</span>
              </button>

              <!-- Page Numbers -->
              <button 
                v-for="(link, index) in meta.links" 
                :key="index"
                @click.prevent="goToPage(link)"
                :disabled="link.active || !link.url"
                class="relative inline-flex items-center px-4 py-2 border text-sm font-medium"
                :class="{
                  'z-10 bg-indigo-50 border-indigo-500 text-indigo-600': link.active,
                  'bg-white border-gray-300 text-gray-500 hover:bg-gray-50': !link.active,
                }"
              >
                <span v-html="link.label"></span>
              </button>

              <!-- Next Button -->
              <button 
                @click="goToPage(meta.current_page + 1)" 
                :disabled="meta.current_page === meta.last_page"
                class="relative inline-flex items-center px-4 py-2 border text-sm font-medium bg-white border-gray-300 text-gray-500 hover:bg-gray-50"
              >
                <span>Next</span>
              </button>
            </nav>
          </div>

        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    meta: Object, // Pagination metadata (current_page, last_page, etc.)
  },
  methods: {
    // Navigate to the specified page
    goToPage(page) {
      if (page >= 1 && page <= this.meta.last_page) {
        this.$emit('page-changed', page); // Emit the page-changed event to notify the parent
      }
    },
  },
};
</script>

<style scoped>
.pagination {
  display: flex;
  justify-content: center;
  margin-top: 20px;
}

.pagination button {
  padding: 10px;
  background-color: #007bff;
  color: white;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

.pagination button:disabled {
  background-color: #ccc;
  cursor: not-allowed;
}

.relative {
  position: relative;
}

.inline-flex {
  display: inline-flex;
}

.items-center {
  align-items: center;
}

.px-4 {
  padding-left: 1rem;
  padding-right: 1rem;
}

.py-2 {
  padding-top: 0.5rem;
  padding-bottom: 0.5rem;
}

.border {
  border-width: 1px;
}

.text-sm {
  font-size: 0.875rem;
}

.font-medium {
  font-weight: 500;
}

.bg-white {
  background-color: white;
}

.text-gray-700 {
  color: #4a4a4a;
}

.text-gray-500 {
  color: #6b7280;
}

.bg-indigo-50 {
  background-color: #e5e7eb;
}

.border-indigo-500 {
  border-color: #6366f1;
}

.text-indigo-600 {
  color: #4f46e5;
}

.hover\:bg-gray-50:hover {
  background-color: #f9fafb;
}

.bg-white {
  background-color: #ffffff;
}

.border-gray-300 {
  border-color: #d1d5db;
}
</style>
