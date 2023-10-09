<template>
  <div>
      <h5 id="associating-form-text-with-form-controls">Name:</h5>
      <h6>{{ merchandises.name }}</h6>
      <h5 id="associating-form-text-with-form-controls">Description:</h5>
      <p>{{ merchandises.description }}</p>
      <h5 id="associating-form-text-with-form-controls">Price:</h5>
      <p>Price: {{ merchandises.price }}</p>
      <router-link :to="`/merchandises/${merchandises.id}/edit`" class="btn btn-primary">Edit</router-link>
  </div>
</template>

<script>
import { apiClient } from '@/axios';

export default {
data() {
  return {
    merchandises: {}
  }
},
async created() {
  try {
  const response = await apiClient.get(`/merchandises/${this.$route.params.id}`);
  this.merchandises = response.data.result;
  } catch (error) {
  console.error(error);
  }
}
}
</script>
