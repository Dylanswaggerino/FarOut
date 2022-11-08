<template>
    <v-app>
        <app-bar />
        <v-main>
            <side-bar />
            <router-view />
        </v-main>
        <Footer />
    </v-app>
</template>

<script>
import Footer from "./components/Footer";
import SideBar from "./components/SideBar";
import AppBar from "./components/AppBar";

export default {
    name: "App",
    components: {
        Footer,
        SideBar,
        AppBar,
    },
};
</script>

<style scoped></style>
