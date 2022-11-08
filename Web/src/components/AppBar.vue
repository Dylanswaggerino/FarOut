<template>
    <v-app-bar color="#1976D2" app clipped-left dark>
        <img
            class="mr-3"
            @click="$router.push('/').catch(() => {})"
            style="cursor: pointer"
            :src="require('@/assets/plane.png')"
            height="40"
        />
        <v-toolbar-title class="mr-3">FarOut | Reisbureau</v-toolbar-title>
        <v-spacer></v-spacer>
        <v-btn color="#03045e" class="ma-1" to="/countries">
            <v-icon class="pr-3">mdi-flag</v-icon> Landen
        </v-btn>
        <v-btn
            v-if="$store.state.token"
            color="#03045e"
            class="ma-1"
            to="/customers"
        >
            <v-icon class="pr-3">mdi-account-group</v-icon> Klanten
        </v-btn>

        <v-dialog v-model="loginDialog" width="500">
            <template v-slot:activator="{ on, attrs }">
                <v-btn
                    v-if="!$store.state.token"
                    color="#03045e"
                    class="ma-1"
                    v-bind="attrs"
                    v-on="on"
                >
                    <v-icon class="pr-3">mdi-account</v-icon> Inloggen
                </v-btn>
                <v-btn @click="logout" v-else color="#03045e" class="ma-1">
                    <v-icon class="pr-2 pl-n1">mdi-account-key</v-icon> Uitloggen
                </v-btn>
            </template>

            <v-card>
                <login-card @visibility="toggleLDialog()" />
                <v-divider></v-divider>
            </v-card>
        </v-dialog>

        <v-dialog v-model="registerDialog" width="500">
            <template v-slot:activator="{ on, attrs }">
                <v-btn
                    v-if="!$store.state.token"
                    color="#03045e"
                    class="ma-1"
                    v-bind="attrs"
                    v-on="on"
                >
                    <v-icon class="pr-3">mdi-account-plus</v-icon> Registeren
                </v-btn>
            </template>

            <v-card>
                <register-card @visibility_register="toggleRDialog()" />
                <v-divider></v-divider>
            </v-card>
        </v-dialog>
    </v-app-bar>
</template>

<script>
import LoginCard from "./LoginCard";
import RegisterCard from "./RegisterCard";
import axios from "axios";

export default {
    name: "AppBar",
    components: {
        LoginCard,
        RegisterCard,
    },
    data() {
        return {
            loginDialog: false,
            registerDialog: false,
        };
    },
    methods: {
        logout() {
            axios
                .post("http://127.0.0.1:8000/auth/logout", {
                    token: this.$store.state.token,
                })
                .then((res) => {
                    if (res) {
                        this.$store.commit("clearToken");
                        this.$router.push("/").catch(() => {});
                    }
                });
        },
        toggleLDialog() {
            this.loginDialog = !this.loginDialog;
        },
        toggleRDialog() {
            this.registerDialog = !this.registerDialog;
        },
    },
};
</script>
