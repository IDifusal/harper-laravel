<template>
    <div>
    Welcome  {{ userEmail  }}
    </div>
</template>

<script setup lang="ts">
import { onMounted, ref } from 'vue';
const userEmail = ref('');
onMounted(() => {
    userEmail.value = localStorage.getItem('email')?? '';
});
</script>

<style scoped>

</style>