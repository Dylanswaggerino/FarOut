<template>
    <v-row class="align-center">
        <v-col cols="4"></v-col>
        <v-col cols="4" class="mt-16">
            <register-card />
        </v-col>
    </v-row>
</template>

<script>
import RegisterCard from "../components/RegisterCard";

export default {
    name: "Registerview",

    components: {
        RegisterCard,
    },
};
</script>
