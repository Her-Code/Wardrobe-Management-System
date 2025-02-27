<script>

export default {
  props: {
    clothingItem: Object, // Passed from the controller
  },
  methods: {
    // Method to dynamically generate the correct image URL
    getImageUrl(image) {
      // Check if the image path already contains 'images/' part
      if (image.startsWith('images/')) {
        return '/' + image; // Just return the image with a leading slash
      }
      return '/images/' + image; // Otherwise, prepend 'images/' to the image path
    },

    goBack() {
      // Navigate back to the Clothing Items index page
      this.$inertia.visit('/clothing-items');
    }
  }
};
</script>

<template>
  <div class="container">
    <h1 class="text-3xl font-bold text-center my-6">{{ clothingItem.name }}</h1>

    <!-- Item Details -->
    <div class="clothing-item-detail p-6 border rounded-lg shadow-sm">
      <!-- Corrected Image Source Handling -->
      <img :src="getImageUrl(clothingItem.image)" alt="Clothing Item Image" class="w-full h-64 object-cover mb-4 rounded-lg">
      
      <p class="text-lg text-gray-800">Category: {{ clothingItem.category.name }}</p>
      <p class="text-lg text-gray-800">Size: {{ clothingItem.size }}</p>
      <p class="text-lg text-gray-800">Color: {{ clothingItem.color }}</p>

      <!-- Back Button -->
      <div class="mt-4">
        <button @click="goBack" class="text-white bg-blue-500 hover:bg-blue-700 py-2 px-4 rounded-lg transition-colors duration-300">
          Back to Clothing Items
        </button>
      </div>
    </div>
  </div>
</template>

<style scoped>
/* Styling for the container */
.container {
  padding: 20px;
  max-width: 800px;
  margin: 0 auto;
}

.clothing-item-detail {
  background-color: white;
  padding: 16px;
  border-radius: 8px;
  border: 1px solid #ddd;
}

.clothing-item-detail img {
  object-fit: cover;
  width: 100%;
  height: 300px;
  border-radius: 8px;
}

/* Button Styling */
button {
  padding: 10px 20px;
  border-radius: 5px;
  transition: background-color 0.3s ease;
}

button:hover {
  background-color: #1D4ED8; /* Blue */
}
</style>
