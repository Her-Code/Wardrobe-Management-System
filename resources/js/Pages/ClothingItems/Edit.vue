<script>
export default {
  props: {
    clothingItem: Object, // This is passed from the server
    categories: Array, // This is passed from the server
  },
  methods: {
    submitForm() {
      // Use Inertia.js to submit the form data for updating the clothing item
      this.$inertia.put(`/clothing-items/${this.clothingItem.id}`, this.clothingItem);
    },
  },
};
</script>

<template>
  <div class="container">
    <h1 class="text-3xl font-bold text-center my-6">Edit Clothing Item</h1>

    <!-- Edit Form -->
    <div class="clothing-item-form p-6 border rounded-lg shadow-sm">
      <form @submit.prevent="submitForm">
        <!-- Item Name -->
        <div class="mb-4">
          <label for="name" class="block text-sm font-semibold">Item Name</label>
          <input
            v-model="clothingItem.name"
            type="text"
            id="name"
            class="p-2 border border-gray-300 rounded-lg w-full"
            placeholder="Enter item name"
          />
        </div>

        <!-- Category -->
        <div class="mb-4">
          <label for="category_id" class="block text-sm font-semibold">Category</label>
          <select
            v-model="clothingItem.category_id"
            id="category_id"
            class="p-2 border border-gray-300 rounded-lg w-full"
          >
            <option v-for="category in categories" :key="category.id" :value="category.id">
              {{ category.name }}
            </option>
          </select>
        </div>

        <!-- Size -->
        <div class="mb-4">
          <label for="size" class="block text-sm font-semibold">Size</label>
          <input
            v-model="clothingItem.size"
            type="text"
            id="size"
            class="p-2 border border-gray-300 rounded-lg w-full"
            placeholder="Enter size"
          />
        </div>

        <!-- Color -->
        <div class="mb-4">
          <label for="color" class="block text-sm font-semibold">Color</label>
          <input
            v-model="clothingItem.color"
            type="text"
            id="color"
            class="p-2 border border-gray-300 rounded-lg w-full"
            placeholder="Enter color"
          />
        </div>

        <!-- Image -->
        <div class="mb-4">
          <label for="image" class="block text-sm font-semibold">Image</label>
          <input
            v-model="clothingItem.image"
            type="text"
            id="image"
            class="p-2 border border-gray-300 rounded-lg w-full"
            placeholder="Enter image path (e.g., 'images/image.jpg')"
          />
        </div>

        <!-- Submit Button -->
        <div class="flex justify-center mt-4">
          <button
            type="submit"
            class="text-white bg-blue-500 hover:bg-blue-700 py-2 px-4 rounded-lg transition-colors duration-300"
          >
            Save Changes
          </button>
        </div>
      </form>
    </div>
  </div>
</template>

<style scoped>
.container {
  padding: 20px;
  max-width: 800px;
  margin: 0 auto;
}

.clothing-item-form {
  background-color: white;
  padding: 16px;
  border-radius: 8px;
  border: 1px solid #ddd;
}

button {
  padding: 10px 20px;
  border-radius: 5px;
  transition: background-color 0.3s ease;
}

button:hover {
  background-color: #1d4ed8; /* Blue */
}
</style>
