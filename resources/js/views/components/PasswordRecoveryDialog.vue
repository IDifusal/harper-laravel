<template>
  <v-dialog v-model="dialogVisible" max-width="400">
    <v-card>
      <v-card-title>Recover Password</v-card-title>
      <v-card-text>
        <v-text-field
          v-model="recoveryEmail"
          label="Email"
        ></v-text-field>
      </v-card-text>
      <v-card-actions>
        <v-btn @click="sendRecoveryEmail" color="primary">Send</v-btn>
        <v-btn @click="closeDialog">Cancel</v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>

<script>
export default {
  data() {
    return {
      dialogVisible: false,
      recoveryEmail: '',
    };
  },
  methods: {
    openDialog() {
      this.dialogVisible = true;
    },
    closeDialog() {
      this.dialogVisible = false;
    },
    sendRecoveryEmail() {
      // Implement email recovery logic here
      // You can send a verification code to the recoveryEmail
      // and proceed accordingly
      // After that, close the dialog
      this.closeDialog();
    },
  },
};
</script>
