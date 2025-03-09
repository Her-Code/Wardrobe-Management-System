<template>
  <div>
    <form @submit.prevent="submitForm">
      <div class="form-group">
        <label for="name">Name</label>
        <input type="text" v-model="name" id="name" class="form-control" required />
      </div>

      <div class="form-group">
        <label for="category_id">Category</label>
        <select v-model="category_id" id="category_id" class="form-control" required>
          <option value="">Select Category</option>
          <option v-for="category in categories" :key="category.id" :value="category.id">
            {{ category.name }}
          </option>
        </select>
      </div>

      <div class="form-group">
        <label for="size">Size</label>
        <input type="text" v-model="size" id="size" class="form-control" required />
      </div>

      <div class="form-group">
        <label for="color">Color</label>
        <input type="text" v-model="color" id="color" class="form-control" required />
      </div>

      <div class="form-group">
        <label for="image">Image</label>
        <input type="file" @change="handleImageChange" id="image" class="form-control" required />
        <div v-if="imagePreview" class="mt-2">
          <img :src="imagePreview" alt="Image preview" class="img-thumbnail" style="max-width: 200px;" />
        </div>
      </div>

      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </div>
</template>

<script>
export default {
  data() {
    return {
      name: '',
      category_id: '',
      size: '',
      color: '',
      image: null,
      imagePreview: null,
      categories: [
        { id: 1, name: 'T-shirts' },
        { id: 2, name: 'Jeans' },
        { id: 3, name: 'Jackets' },
        { id: 4, name: 'Accessories' },
        // Add more categories here dynamically if needed
      ],
    };
  },
  methods: {
  // Handle the image file input change
  handleImageChange(event) {
    const file = event.target.files[0];
    if (file) {
      this.image = file;
      this.imagePreview = URL.createObjectURL(file); // Create preview URL for the image
    }
  },

  // Submit the form with FormData
  async submitForm() {
    const formData = new FormData();
    formData.append('name', this.name);
    formData.append('category_id', this.category_id);
    formData.append('size', this.size);
    formData.append('color', this.color);
    formData.append('image', this.image); // Add the image file to the formData

    try {
      // Send the request to the server using Inertia.js
      await this.$inertia.post('/clothing-items', formData);
      
      // Optional: Redirect after submission
      this.$inertia.visit('/clothing-items'); // Redirect to the list page after adding the item
    } catch (error) {
      console.error("Error in form submission:", error); // Log any errors
    }
  },
  },
};
</script>

<style scoped>
/* Add custom styling here */
</style>

<style scoped>
/* Add your custom styling here */
.container {
  max-width: 600px;
  margin: 0 auto;
  padding: 20px;
}

input, select {
  width: 100%;
  padding: 8px;
  margin-top: 6px;
  margin-bottom: 12px;
  border: 1px solid #ccc;
  border-radius: 5px;
}

button {
  background-color: #4CAF50;
  padding: 12px 20px;
  color: white;
  border: none;
  border-radius: 5px;
}

button:hover {
  background-color: #45a049;
}
</style>
