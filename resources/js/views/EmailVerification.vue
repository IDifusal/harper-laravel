<template>
    <div>
      <h1>Email Verification</h1>
      <div v-if="verified">
        <p>Email has been successfully verified!</p>
      </div>
    </div>
  </template>
  
  <script>
  import axios from 'axios'
  export default {
    data() {
      return {
        verified: false,
      };
    },
    created() {
      // Extract the "id" and "hash" parameters from the URL
      const id = this.$route.params.id;
      const hash = this.$route.query.signature;
  
      // Make an API request to verify the email
      setTimeout(() => {
        this.verifyEmail(id, hash);
      }, 300);
    },
    methods: {
      async verifyEmail(id, hash) {
        try {
            console.log("parametersgaaaa",id, hash);
          const response = await axios.get(`/api/custom/verify/${id}/${hash}`);
          if (response.status === 200) {
            this.verified = true;
          }
        } catch (error) {
          // Handle errors here
        }
      },
    },
  };
  </script>
  