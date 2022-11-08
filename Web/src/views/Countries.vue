<template>
    <div id="app" class="container">
        <h1 class="display-1 font-weight-bold my-3">Landen</h1>
        <p>Dit zijn de landen waar onze maatschappij naar toe vliegt.</p>
        <br />
        <v-card>
            <v-card-title>
                <v-text-field
                    v-model="search"
                    append-icon="mdi-magnify"
                    label="Naar welk land zoek je?"
                    hide-details
                ></v-text-field>
            </v-card-title>
            <v-data-table
                :headers="headers"
                :items="info"
                :search="search"
                :loading="loadingCountries"
                loading-text="Landen aan het ophalen..."
                no-data-text="Gegevens konden niet opgehaald worden."
            >
                <template v-slot:items="props">
                    <td>{{ props.item.code }}</td>
                    <td>{{ props.item.description }}</td>
                </template>
            </v-data-table>
        </v-card>
    </div>
</template>

<script>
import axios from "axios";
export default {
    name: "App",
    data() {
        return {
            search: "",
            headers: [
                { text: "Land Code", value: "code" },
                { text: "Land", value: "description" },
            ],
            info: [],
            loadingCountries: true,
        };
    },
    methods: {
        refreshReservations() {
            this.$emit("rfrReservations");
        },
    },
    mounted() {
        axios
            .get("http://127.0.0.1:8000/countries", {
                headers: { Authorization: "Bearer " + this.$store.state.token },
            })
            .then((response) => {
                this.loadingCountries = false;
                this.info = response.data;
            })
            .catch(() => {
                this.loadingCountries = false;
            });
    },
};
</script>

<style scoped>
#app {
    text-align: center;
    margin-top: 0.5rem;
}
.heading {
    margin-bottom: 30px;
}
</style>
