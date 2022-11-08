<template>
    <v-row class="align-center">
        <v-col cols="4"></v-col>
        <v-col cols="4" class="mt-16">
            <login-card />
        </v-col>
    </v-row>
</template>

<script>
import LoginCard from "../components/LoginCard";

export default {
    name: "Loginview",

    components: {
        LoginCard,
    },
};
</script>
