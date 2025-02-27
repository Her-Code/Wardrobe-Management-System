<script>
import Pagination from '@/Components/Pagination.vue'; // Import the Pagination component

export default {
  props: {
    clothingItems: Object, // Clothing items with pagination data
    categories: Array, // List of categories for filter dropdown
    filters: Object, // Current filters for search and category
  },
  components: {
    Pagination, // Register the Pagination component
  },
  data() {
    return {
      searchQuery: this.filters.search || '',
      selectedCategory: this.filters.category_id || '',
    };
  },
  methods: {
    // Added Search functionality
    onSearch() {
      // Use Inertia.js for server-side updates
      this.$inertia.get('/clothing-items', {
        search: this.searchQuery,
        category_id: this.selectedCategory,
        page: 1,
      });
    },

    // created a Category filter functionality
    onCategoryChange() {
      // Use Inertia.js for server-side updates
      this.$inertia.get('/clothing-items', {
        search: this.searchQuery,
        category_id: this.selectedCategory,
        page: 1,
      });
    },

    // Navigate to the item detail page
    viewItem(id) {
      this.$inertia.visit(`/clothing-items/${id}`);
    },

    // Navigate to the item edit page
    editItem(id) {
      this.$inertia.visit(`/clothing-items/${id}/edit`);
    },

    // Delete the clothing item
    deleteItem(id) {
      if (confirm('Are you sure you want to delete this item?')) {
        this.$inertia.delete(`/clothing-items/${id}`).then(() => {
          this.$inertia.reload(); // Reload after deletion
        });
      }
    },

    // Handle page changes
    goToPage(page) {
      // Use Inertia.js for server-side updates with pagination support
      this.$inertia.get('/clothing-items', { page });
    },
  },
};
</script>

<template>
  <div class="container">
    <h1 class="text-2xl font-bold text-center my-6">Clothing Items</h1>

    <!-- Search and Filter Section -->
    <div class="flex justify-between items-center mb-6">
      <!-- Search Bar -->
      <input
        v-model="searchQuery"
        @input="onSearch"
        type="text"
        placeholder="Search by item name"
        class="p-2 border border-gray-300 rounded-lg"
      />

      <!-- Category Filter -->
      <select v-model="selectedCategory" @change="onCategoryChange" class="p-2 border border-gray-300 rounded-lg">
        <option value="">All Categories</option>
        <option v-for="category in categories" :key="category.id" :value="category.id">
          {{ category.name }}
        </option>
      </select>
    </div>

    <!-- Clothing Items List -->
    <div class="clothing-items-list grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 gap-6">
      <div v-for="item in clothingItems.data" :key="item.id" class="clothing-item p-4 border rounded-lg shadow-sm hover:shadow-lg transition duration-300">
        <img :src="item.image" alt="Clothing Item Image" class="clothing-item-image w-full h-48 object-cover mb-4 rounded-lg">
        <h3 class="text-xl font-semibold mb-2">{{ item.name }}</h3>
        <p class="text-sm text-gray-600">Category: {{ item.category.name }}</p>
        <p class="text-sm text-gray-600">Size: {{ item.size }}</p>
        <p class="text-sm text-gray-600">Color: {{ item.color }}</p>

        <!-- Buttons Section -->
        <div class="buttons mt-4 flex space-x-4">
          <button @click="viewItem(item.id)" class="btn-view text-white bg-blue-500 hover:bg-orange-500 py-2 px-4 rounded-lg transition-colors duration-300">
            View Details
          </button>
          <button @click="editItem(item.id)" class="btn-edit text-white bg-blue-500 hover:bg-orange-500 py-2 px-4 rounded-lg transition-colors duration-300">
            Edit
          </button>
          <button @click="deleteItem(item.id)" class="btn-delete text-white bg-blue-500 hover:bg-orange-500 py-2 px-4 rounded-lg transition-colors duration-300">
            Delete
          </button>
        </div>
      </div>
    </div>

    <!-- Pagination Component -->
    <Pagination :meta="clothingItems.meta" @page-changed="goToPage" />
  </div>
</template>

<style scoped>
/* Styling for the container */
.container {
  padding: 20px;
  max-width: 1200px;
  margin: 0 auto;
}

.clothing-items-list {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 20px;
}

/* Clothing Item Styling */
.clothing-item {
  background-color: white;
  padding: 16px;
  border-radius: 8px;
  border: 1px solid #ddd;
  transition: box-shadow 0.3s ease;
}

.clothing-item:hover {
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.clothing-item img {
  object-fit: cover;
  height: 200px;
  width: 100%;
  border-radius: 8px;
}

/* Button Styling */
.buttons button {
  font-size: 14px;
}

button {
  padding: 10px 20px;
  border-radius: 5px;
  transition: background-color 0.3s ease;
}

button:hover {
  background-color: #FF7043; /* Orange */
}

/* Specific Button Styles */
.btn-view {
  background-color: #1D4ED8; /* Blue */
}

.btn-edit {
  background-color: #1D4ED8; /* Blue */
}

.btn-delete {
  background-color: #D32F2F; /* Red */
}
</style>
