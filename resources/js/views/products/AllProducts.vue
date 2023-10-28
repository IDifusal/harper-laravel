<template>
    <div class="products-grid">
        <div v-for="product in products" :key="product.id" class="product-card" @click="goProduct(product.id)">
            <img :src="'/images/' + product.img" alt="" />
            <h3>{{ product.name }}</h3>
            <p v-if="product.id != 1">Actual Stock: {{ product.initial_stock }}</p>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            products: []
        };
    },
    methods:{
        goProduct(id){
        this.$router.push({name: 'details', params: {id: id}});
    },
    },
    async created() {
        try {
            const response = await axios.get('/api/products');
            this.products = response.data;
        } catch (error) {
            console.error(error);
        }
    }
}
</script>

<style scoped>
@media(min-width: 768px){
    .products-grid{
        grid-template-columns: repeat(4,1fr) !important;
    }
}
.product-card:hover{
    transform: scale(1.05);
    transition: all .2s;
    cursor: pointer;
    box-shadow: 0 2px 4px rgba(0,0,0,0.2);

}
.products-grid {
    display: grid;
    flex-wrap: wrap;
    gap: 16px;
    justify-content: center;
    grid-template-columns: repeat(2,1fr)
}

.product-card {
    background: #fff;
    border: 1px solid #ccc;
    border-radius: 8px;
    padding: 16px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.product-card img {
    max-width: 100%;
    border-bottom: 1px solid #ccc;
    margin-bottom: 8px;
    border-radius: 8px 8px 0 0;
}
</style>
