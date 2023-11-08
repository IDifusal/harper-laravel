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
                            ? "Accepted"
                            : "Pending Approval"
                    }}
                </td>
                <td>{{ props.item.created_at }}</td>
                <td>
                    <v-btn
                        color="harper"
                        text
                        @click="showConfirmDialog(props.item.id)"
                    >
                        Approve
                    </v-btn>
                </td>
            </tr>
        </template>
    </v-data-table>
    <v-dialog
        v-model="dialog"
        persistent
        max-width="290"
    >
        <v-card>
            <v-card-title class="headline">Confirmation</v-card-title>
            <v-card-text>Are you sure you want to approve this request?</v-card-text>
            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn
                    color="blue darken-1"
                    text
                    @click="dialog = false"
                >
                    Cancel
                </v-btn>
                <v-btn
                    color="blue darken-1"
                    text
                    @click="approveRequest(currentRequestId)"
                >
                    Confirm
                </v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
  </template>

<script setup>
import axios from "axios";
import { VDataTable } from "vuetify/labs/VDataTable";
import { ref, onMounted } from "vue";
let dialog = ref(false);
let currentRequestId = ref(null);
let headers = ref([
    { title: "ID", key: "id" },
    { title: "Quantity Requested", key: "quantity_requested" },
    { title: "Delivery Method", key: "delivery_method_name" },
    { title: "Status", key: "approved" },
    { title: "Date Requested", key: "created_at" },
]);

let products = ref([]);

const fetchProducts = () => {
    axios
        .get("/api/requests/pending-requests")
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
const showConfirmDialog = (id) => {
    currentRequestId.value = id;
    dialog.value = true;
};
const approveRequest = (id) => {
    dialog.value = false;
    axios
        .post(`/api/products/approve/${id}`)
        .then((response) => {
            fetchProducts();
        })
        .catch((error) => {
            console.error("Error fetching products:", error);
        });
};
</script>

<style scoped>
.btn-request {
    background-color: #a31e4c;
    color: white;
}
</style>
