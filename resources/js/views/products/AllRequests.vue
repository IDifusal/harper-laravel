<template>
    <v-data-table
        :headers="headers"
        :items="products"
        item-value="name"
        class="elevation-1"
    >
        <template v-slot:top>
            <v-toolbar>
                <v-btn href="/products/request" class="btn-request"
                    >Request Product</v-btn
                >
            </v-toolbar>
        </template>
        <template v-slot:item="props">
            <tr>
                <td>{{ props.item.id }}</td>
                <td>{{ props.item.quantity_requested }}</td>
                <td>{{ props.item.delivery_method_name }}</td>
                <td>
                    {{
                        props.item.approved == 1
                            ? "Acepted"
                            : "Pending Aprovation"
                    }}
                </td>
                <td>{{ props.item.created_at }}</td>
            </tr>
        </template>
    </v-data-table>
</template>

<script setup>
import axios from "axios";
import { VDataTable } from "vuetify/labs/VDataTable";
import { ref, onMounted } from "vue";

let headers = ref([
    { title: "ID", key: "id" },
    { title: "Quantity Requested", key: "quantity_requested" },
    { title: "Delivery Method", key: "delivery_method_name" },
    { title: "Status", key: "approved" },
    { title: "Date Requested", key: "created_at" },
]);

let products = ref([]);

const fetchProducts = () => {
    const userEmail = localStorage.getItem("email");
    axios
        .get("/api/requests/all-requests", {
            params: {
                email: userEmail,
            },
        })
        .then((response) => {
            products.value = response.data.requests;
        })
        .catch((error) => {
            console.error("Error fetching products:", error);
        });
};

onMounted(() => {
    fetchProducts();
});
</script>

<style scoped>
.btn-request {
    background-color: #a31e4c;
    color: white;
}
</style>
