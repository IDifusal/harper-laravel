<template>
    <v-data-table
    :headers="headers"
    :items="products"
    item-value="name"
    class="elevation-1"
     >
     <template v-slot:top>
      <v-toolbar >
        <v-btn href="products/request" class="btn-request">Request Product</v-btn>
      </v-toolbar>
    </template>
    </v-data-table>
  </template>
  
  <script setup>
  import axios from 'axios';
  import { VDataTable } from 'vuetify/labs/VDataTable';
  import {ref,onMounted} from 'vue';
  
  let headers =ref([
    { title: 'ID', key: 'id' },
    { title: 'Name', key: 'name' },
    { title: 'Actual Stock', key: 'initial_stock' },
  ]);
  
  let products = ref([]);
  
  const openCreateDialog = () => {
    // Show a dialog to create a new product
  };
  
  const editProduct = (product) => {
    // Show a dialog to edit the selected product
  };
  
  const deleteProduct = (product) => {
    // Implement logic to delete the product
  };
  
  const fetchProducts = () => {
    axios.get('/api/products') 
      .then((response) => {
        products.value = response.data;
      })
      .catch((error) => {
        console.error('Error fetching products:', error);
      });
  };
  
  onMounted(() => {
    // Fetch the list of products from the API when the component is created
    fetchProducts();
  });
  </script>
  
  <style scoped>
.btn-request{
  background-color: #A31E4C;
  color: white;
}</style>