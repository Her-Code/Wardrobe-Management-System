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
      searchQuery: this.filters?.search || '', // Ensure safe access to filters
      selectedCategory: this.filters?.category_id || '', // Ensure safe access to filters
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

    // Created a Category filter functionality
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
    async deleteItem(id) {
      if (confirm('Are you sure you want to delete this item?')) {
        try {
          // Use Inertia.js to delete the item and wait for the response
          await this.$inertia.delete(`/clothing-items/${id}`);
          // Reload the page after deletion to reflect changes
          this.$inertia.reload();
        } catch (error) {
          // Handle error during deletion
          console.error("Error deleting item:", error);
        }
      }
    },

    // Handle page changes
    goToPage(page) {
      // Use Inertia.js for server-side updates with pagination support
      this.$inertia.get('/clothing-items', { page });
    },

    // Navigate to the Create Item page
    goToAddItemPage() {
      this.$inertia.visit(`/clothing-items/create`);
    }
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

    <!-- Add Item Button -->
    <div class="flex justify-end mb-6">
      <button 
        @click="goToAddItemPage"
        class="bg-blue-500 text-white p-2 rounded-lg hover:bg-blue-600"
      >
        Add New Item
      </button>
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
/* Container Styling */
.container {
  padding: 20px;
  max-width: 1200px;
  margin: 0 auto;
  background-color: #f9fafb;
  border-radius: 8px;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

/* Search and Filter Section */
.flex {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 20px;
}

.flex .p-2 {
  padding: 8px 16px;
}

input[type="text"],
select {
  border: 1px solid #ddd;
  border-radius: 8px;
  padding: 8px;
  font-size: 16px;
  width: 45%;
}

input[type="text"]:focus,
select:focus {
  outline: none;
  border-color: #1D4ED8;
}

button {
  padding: 10px 20px;
  border-radius: 5px;
  transition: background-color 0.3s ease;
  font-size: 16px;
}

/* Add Item Button */
.bg-blue-500 {
  background-color: #1D4ED8;
}

.bg-blue-500:hover {
  background-color: #3B82F6;
}

.bg-blue-600 {
  background-color: #1E40AF;
}

.bg-blue-600:hover {
  background-color: #2563EB;
}

/* Clothing Items List */
.clothing-items-list {
  display: grid;
  grid-template-columns: repeat(1, 1fr);
  gap: 20px;
}

@media (min-width: 640px) {
  .clothing-items-list {
    grid-template-columns: repeat(2, 1fr);
  }
}

@media (min-width: 1024px) {
  .clothing-items-list {
    grid-template-columns: repeat(3, 1fr);
  }
}

/* Clothing Item Styling */
.clothing-item {
  background-color: white;
  padding: 16px;
  border-radius: 8px;
  border: 1px solid #ddd;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  transition: box-shadow 0.3s ease;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
}

.clothing-item:hover {
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
}

.clothing-item img {
  object-fit: cover;
  height: 200px;
  width: 100%;
  border-radius: 8px;
  margin-bottom: 16px;
}

/* Clothing Item Text */
.clothing-item h3 {
  font-size: 18px;
  font-weight: 600;
  color: #333;
  margin-bottom: 8px;
}

.clothing-item p {
  font-size: 14px;
  color: #4B5563;
  margin-bottom: 4px;
}

/* Buttons Styling */
.buttons {
  margin-top: 16px;
  display: flex;
  gap: 10px;
  justify-content: flex-start;
}

button {
  padding: 10px 20px;
  border-radius: 5px;
  font-size: 14px;
  transition: background-color 0.3s ease;
}

button:hover {
  background-color: #FF7043; /* Orange */
}

/* Specific Button Styles */
.btn-view {
  background-color: #1D4ED8; /* Blue */
  color: white;
}

.btn-edit {
  background-color: #1D4ED8; /* Blue */
  color: white;
}

.btn-delete {
  background-color: #D32F2F; /* Red */
  color: white;
}

.btn-view:hover {
  background-color: #3B82F6;
}

.btn-edit:hover {
  background-color: #3B82F6;
}

.btn-delete:hover {
  background-color: #FF7043; /* Orange */
}

/* Pagination Styling */
.pagination {
  margin-top: 20px;
  text-align: center;
}

.pagination button {
  padding: 10px 20px;
  margin: 0 5px;
  border-radius: 5px;
  border: 1px solid #ddd;
  background-color: #f0f0f0;
  transition: background-color 0.3s ease;
}

.pagination button:hover {
  background-color: #1D4ED8;
  color: white;
}

.pagination button.disabled {
  background-color: #e0e0e0;
  color: #9e9e9e;
  cursor: not-allowed;
}

</style>
