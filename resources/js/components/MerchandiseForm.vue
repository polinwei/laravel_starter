<template>
  <div>
    <h2 v-if="isNewProduct">Add Merchandise</h2>
    <h2 v-else>Edit Merchandise</h2>
      <form @submit.prevent="submitForm">
        <div class="mb-3">
          <label for="name" class="form-label">Name:</label>
          <input class="form-control" type="text" id="name" v-model="merchandise.name" required />
        </div>
        <div class="mb-3">
          <label for="description" class="form-label">Description:</label>
          <textarea class="form-control" id="description" v-model="merchandise.description" required></textarea>
        </div>
        <div class="mb-3">
          <label for="price" class="form-label">Price:</label>
          <input class="form-control" type="number" id="price" v-model="merchandise.price" required />
        </div>
        <button type="submit" v-if="isNewProduct" class="btn btn-primary">Add Merchandise</button>
        <button type="submit" v-else class="btn btn-primary">Update Merchandise</button>
      </form>
  </div>
</template>

<script>
import axios from 'axios';
export default {
  data() {
    return {
      merchandise: {
        name: '',
        description: '',
        price: 0
      }
    }
  },
  computed: {
    isNewProduct() {
      return !this.$route.path.includes('edit');
    }
  },
  async created() {
    if (!this.isNewProduct) {
      const response = await axios.get(`/api/merchandises/${this.$route.params.id}`);
      this.merchandise = response.data;
    }
  },
  methods: {
    async submitForm() {
      try {
        if (this.isNewProduct) {
          await axios.post('/api/merchandises', this.merchandise);
        } else {
          await axios.put(`/api/merchandises/${this.$route.params.id}`, this.merchandise);
        }
        this.$router.push('/vueWelcome');
      } catch (error) {
        console.error(error);
      }
    }
  }
}
</script>