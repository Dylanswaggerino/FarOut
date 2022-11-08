<template>
    <v-card class="mx-auto">
        <v-card-title class="text-h5 pb-5 grey lighten-2">
            <h2>Inloggen</h2>
        </v-card-title>
        <v-card-text class="mt-5">
            <v-alert
                dense
                outlined
                type="error"
                v-model="loginError"
                close-text="Close Alert"
                dismissible
                >Gegevens komen niet overeen in systeem.</v-alert
            >
            <v-form @submit.prevent="handleLogin">
                <v-text-field
                    label="E-mailadres *"
                    hint="Vul uw e-mailadres in."
                    prepend-icon="mdi-account-circle"
                    v-model="credentials.email"
                />
                <v-text-field
                    :type="showPassword ? 'text' : 'password'"
                    label="Wachtwoord *"
                    hint="Vul uw wachtwoord in."
                    v-model="credentials.password"
                    prepend-icon="mdi-lock"
                    :append-icon="showPassword ? 'mdi-eye' : 'mdi-eye-off'"
                    @click:append="showPassword = !showPassword"
                />
                <small class="red--text"><i>* = verplicht</i></small>
                <v-divider></v-divider>
                <v-card-actions class="mb-n3">
                    <v-btn color="info" type="submit">Inloggen</v-btn>
                </v-card-actions>
            </v-form>
        </v-card-text>
    </v-card>
</template>

<script>
import axios from "axios";

export default {
    name: "LoginCard",
    data() {
        return {
            showPassword: false,
            credentials: {
                email: "",
                password: "",
            },
            loading: false,
            loginError: false,
        };
    },
    mounted() {
        if (this.$store.state.token !== "") {
            axios
                .post("http://127.0.0.1:8000/auth/checkToken", {
                    token: this.$store.state.token,
                })
                .then((res) => {
                    if (res) {
                        this.$router.push("/countries").catch(() => {});
                    }
                });
        } else {
            this.loading = false;
        }
    },
    methods: {
        handleLogin() {
            axios
                .post("http://127.0.0.1:8000/auth/login", this.credentials)
                .then((res) => {
                    this.$store.commit("setToken", res.data.access_token);
                    this.$router.push({ path: "/countries" }).catch(() => {});

                    this.$emit("visibility");

                    this.loginError = false;
                    this.credentials.email = "";
                    this.credentials.password = "";
                })
                .catch((err) => {
                    if (!err.response.data.status) {
                        this.loginError = true;
                    }
                });
        },
    },
};
</script>
