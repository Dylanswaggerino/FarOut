<template>
    <v-navigation-drawer app clipped permanent color="#f2f2f2" width="200px">
        <v-divider></v-divider>
        <b> <h4 id="sideHead">Populairste landen</h4> </b>
        <ul>
            <v-list-item-content
                v-for="(country, key) in topten"
                :key="country.country"
            >
                {{ key + 1 + "." }}
                {{ country.country }}
            </v-list-item-content>
        </ul>
    </v-navigation-drawer>
</template>

<script>
import axios from "axios";

export default {
    name: "SideBar",
    data() {
        return {
            topten: [],
        };
    },
    mounted() {
        axios
            .get("http://127.0.0.1:8000/trips/topten")
            .then((response) => (this.topten = response.data));
    },
};
</script>

<style scoped>
#sideHead {
    padding-left: 10%;
    padding-right: 10%;
    margin-top: 20px;
    margin-bottom: 5px;
    color: black;
    top: 0;
}
</style>
