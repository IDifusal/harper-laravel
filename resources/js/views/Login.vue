<template>
    <div class="d-flex align-center justify-center" style="height: 100vh">
        <v-sheet width="400" class="mx-auto">
            <v-form @submit.prevent="submitForm">
                <div class="w-100 d-flex justify-center">
                    <img
                        src="https://spanclick.com/wp-content/uploads/2023/08/companie-1.png"
                        alt="Harper Logo"
                        class="text-center w-50"
                    />
                </div>
                <h2 class="text-center">
                    {{ formType === "login" ? "Sign In" : "Create Account" }}
                </h2>
                <v-text-field
                    variant="outlined"
                    v-model="email"
                    label="Email"
                ></v-text-field>

                <v-text-field
                    variant="outlined"
                    v-model="password"
                    label="Password"
                    :type="showPassword ? 'text' : 'password'"
                ></v-text-field>

                <a
                    @click="openRecoveryDialog"
                    class="text-body-2 font-weight-regular"
                    >Forgot Password?</a
                >
                <v-alert
                    v-if="success"
                    :text="formResponse"
                    type="success"
                    variant="tonal"
                ></v-alert>
                <v-alert
                    v-if="formError"
                    :text="formError"
                    type="error"
                    variant="tonal"
                ></v-alert>
                <v-btn
                    v-if="emailVerificationRequired"
                    @click="resendVerificationCode"
                    >Resend Code</v-btn
                >
                <v-btn type="submit" color="harper" block class="mt-2">{{
                    formType === "login" ? "Sign In" : "Sign Up"
                }}</v-btn>
            </v-form>

            <div class="mt-2">
                <p class="text-body-2">
                    {{
                        formType === "login"
                            ? "Don't have an account? "
                            : "Already have an account? "
                    }}
                    <a href="#" @click="toggleForm">{{
                        formType === "login" ? "Sign Up" : "Sign In"
                    }}</a>
                </p>
            </div>

            <password-recovery-dialog
                ref="passwordRecoveryDialog"
            ></password-recovery-dialog>
        </v-sheet>
    </div>
</template>

<script>
import PasswordRecoveryDialog from "./components/PasswordRecoveryDialog.vue";
import axios from "axios"; // Import axios

export default {
    data() {
        return {
            email: "",
            password: "",
            formType: "login",
            showPassword: false,
            formError: null, // Error message for the entire form
            success: false, // Success status
            emailVerificationRequired: false,
            errorMessage: null,
            formResponse: null,
        };
    },
    components: {
        PasswordRecoveryDialog,
    },
    methods: {
        async submitForm() {
            try {
                this.formError = null;

                let apiEndpoint = "";

                if (this.formType === "login") {
                    console.log("LOGIN");
                    apiEndpoint = "/api/login";
                } else {
                    console.log("register");
                    apiEndpoint = "/api/register";
                }

                const response = await axios.post(apiEndpoint, {
                    email: this.email,
                    password: this.password,
                });
                this.formError = response.data.message;
                if (response.data.email_verification_required) {
                    this.emailVerificationRequired = true;
                } else if (response.data.access_token) {
                    this.emailVerificationRequired = false;
                    if (this.formType === "login") {
                        localStorage.setItem(
                            "authToken",
                            response.data.access_token
                        );
                        this.success = true;
                        setTimeout(() => {
                            this.$router.push({ name: "home" });
                        }, 500);
                    }
                }
            } catch (error) {
                if (error.response) {
                    if (error.response.status === 422) {
                        const responseError = error.response.data;
                        if (responseError.message) {
                            this.formError = responseError.message;
                        }
                    } else if (
                        error.response.status === 403 &&
                        error.response.data.email_verification_required
                    ) {
                        this.emailVerificationRequired = true;
                        this.formError =
                            "Email verification is required. Please check your email for a verification link.";
                    } else {
                        this.formError = error.response.data.message
                            ? error.response.data.message
                            : "An error occurred. Please try again.";
                    }
                } else {
                    this.formError = "An error occurred. Please try again.";
                }
                console.error(error);
            }
        },
        openRecoveryDialog() {
            this.$refs.passwordRecoveryDialog.openDialog();
        },
        toggleForm() {
            this.formError = null;
            this.formType = this.formType === "login" ? "signup" : "login";
        },
        async resendVerificationCode() {
            try {
                const response = await axios.post(
                    "/api/resend-verification-code",
                    {
                        email: this.email,
                    }
                );

                if (response.data.message === "Verification code resent") {
                    // You can show a success message or perform any other necessary actions
                    console.log("Verification code resent");
                }
            } catch (error) {
                // Handle errors, e.g., show an error message
                console.error("Failed to resend verification code", error);
            }
        },
    },
};
</script>
