<template>
  <div>
      <table class="table">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Name</th>
              <th scope="col">Description</th>
              <th scope="col">Price</th>
              <th scope="col">Actions</th>
            </tr>
          </thead>
          <tbody>
              <tr v-for="merchandise in merchandises" :key="merchandise.id">
                  <td>{{ merchandise.id }}</td>
                  <td>{{ merchandise.name }}</td>
                  <td>{{ merchandise.description }}</td>
                  <td>{{ merchandise.price }}</td>
                  <td>
                    <div class="row gap-3">
                      <router-link :to="`/merchandises/${merchandise.id}`" class="p-2 col border btn btn-primary">View</router-link>
                      <router-link :to="`/merchandises/${merchandise.id}/edit`" class="p-2 col border btn btn-success">Edit</router-link>
                      <button @click="deleteMerchandise(merchandise.id)" type="button" class="p-2 col border btn btn-danger">Delete</button>
                    </div>
                  </td>
              </tr>
          </tbody>
      </table>
  </div>
</template>

<script>
import axios from 'axios';
export default {
data() {
  return {
    merchandises: []
  }
},
async created() {
  try {
    const response = await axios.get('/api/merchandises');
    this.merchandises = response.data;
  } catch (error) {
    console.error(error);
  }
},
methods: {
  async deleteMerchandise(id) {
    try {
      await axios.delete(`/api/merchandises/${id}`);
      this.merchandises = this.merchandises.filter(merchandise => merchandise.id !== id);
    } catch (error) {
      console.error(error);
    }
  }
}
}
</script>