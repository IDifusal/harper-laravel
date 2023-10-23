<template>
    <div>
        <h1>Request Product</h1>
        <form @submit.prevent="submitRequest">
            <div class="form-group">
                <label for="product">Select a Product:</label>
                <v-select
                    :items="products"
                    item-text="title"
                    item-value="id"
                    v-model="selectedProduct"
                ></v-select>
            </div>
            <div class="form-group">
                <label for="deliveryMethod">Select a Delivery Method:</label>
                <v-select
                    :items="listDeliveryMethods"
                    item-text="title"
                    item-value="id"
                    v-model="selectedDeliveryMethod"
                ></v-select>
            </div>

            <div v-if="selectedDeliveryMethod === 3" class="form-group">
                <h3>Custom Delivery Details</h3>
                <v-text-field
                    v-model="deliveryCustom.address"
                    label="Address"
                    type="text"
                    :rules="[rules.required]"
                ></v-text-field>
                <v-text-field
                    v-model="deliveryCustom.state"
                    label="State"
                    type="text"                    
                    :rules="[rules.required]"                    
                ></v-text-field>
                <v-text-field
                    v-model="deliveryCustom.zip_code"
                    label="Zip Code"
                    type="text"                    
                    :rules="[rules.required]"                    
                ></v-text-field>
            </div>

            <div class="form-group">
                <label for="quantity">Quantity:</label>
                <v-text-field
                    v-model="quantity"
                    hide-details
                    single-line
                    type="number"
                />
            </div>
            <v-alert
                    v-if="errorForm"
                    :text="errorFormMessage"
                    type="error"
                    variant="tonal"
                ></v-alert>
            <v-btn type="submit" color="harper" class="mt-2"
                >Send Request</v-btn
            >
        </form>
    </div>
</template>

<script setup>
import { ref, onMounted, watch } from "vue";
import axios from "axios";
const products = ref([]);
const selectedProduct = ref(null);
const listDeliveryMethods = ref([]);
const selectedDeliveryMethod = ref(null);
const errorForm = ref(false);
const errorFormMessage = ref("");
const deliveryCustom = ref({
    address: null,
    state: null,
    zip_code: null,
});
const quantity = ref(1);
const rules = {
    required: value => !!value || 'Required.'
  }
const userEmail = () => {
    return localStorage.getItem("email");
};
const validateAdditionalFields = () => {
    if (selectedDeliveryMethod.value === 3) {
        if (
            deliveryCustom.value.address &&
            deliveryCustom.value.state &&
            deliveryCustom.value.zip_code
        ) {
            return true;
        } else {
            return false;
        }
    } else {
        return true;
    }
};

const fetchProductsAndDeliveryMethods = async () => {
    try {
        const response = await axios.get("/api/products-with-delivery-methods");
        products.value = response.data.products;
        if (products.value.length > 0) {
            // Set the default selected product and delivery method
            selectedProduct.value = products.value[0].id;
            // selectedDeliveryMethod.value =
            // products.value[0].delivery_methods[0].title;
        }
    } catch (error) {
        console.error("Error fetching products and delivery methods:", error);
    }
};

const submitRequest = async () => {
    try {
        const requestData = {
            product_id: selectedProduct.value,
            delivery_method: selectedDeliveryMethod.value,
            quantity_requested: quantity.value,
            requester_email: userEmail(),
        };
        if (selectedDeliveryMethod.value === 3) {
            if (validateAdditionalFields()) {
            } else {
                errorForm.value = true;
                errorFormMessage.value =
                    "Error submitting product request: Custom Delivery Fields are required";
                return;
            }
        }
        await axios.post("/api/request-product", requestData);
        // Reset form fields after successful submission if needed
        selectedProduct.value = null;
        selectedDeliveryMethod.value = null;
        quantity.value = 1;
        // You can add a success message or redirect the user as needed
        console.log("Product request submitted successfully");
    } catch (error) {
        console.error("Error submitting product request:", error);
    }
};
watch(selectedProduct, (newSelectedProduct) => {
    if (newSelectedProduct) {
        listDeliveryMethods.value = [];
        let productTemp = products.value.find(
            (p) => p.id === newSelectedProduct
        );
        if (productTemp) {
            listDeliveryMethods.value = productTemp.delivery_methods;
            if (listDeliveryMethods.value.length > 0) {
                selectedDeliveryMethod.value = listDeliveryMethods.value[0].id;
            }
            return listDeliveryMethods.value;
        } else {
            listDeliveryMethods.value = [];
        }
    }
});

// Fetch products and delivery methods when the component is mounted
onMounted(fetchProductsAndDeliveryMethods);
</script>
<style scoped>
/* Add any necessary styles here */
</style>
