<template>
    <v-container>
        <v-row class="text-center">
            <v-col cols="12">
                <v-img
                    :src="require('@/assets/plane.png')"
                    class="my-3"
                    contain
                    height="200"
                />
            </v-col>
            <v-col class="mb-4">
                <h1 class="display-2 font-weight-bold mb-3">
                    Welkom bij FarOut | Reisbureau!
                </h1>
                <p class="subheading font-weight-regular">
                    Gebruik de zoekfunctie om specifieke vluchten te vinden.
                </p>
            </v-col>
        </v-row>
        <v-card light>
            <v-card-title>
                <v-text-field
                    v-model="search"
                    append-icon="mdi-magnify"
                    label="Waar wil je naartoe gaan?"
                    hide-details
                ></v-text-field>
            </v-card-title>
            <v-data-table
                light
                :headers="headers"
                :items="info"
                :search="search"
                :sort-by="['departure_date', 'price']"
                :sort-desc="[false, false]"
                :loading="loadingCountries"
                loading-text="Reizen aan het ophalen..."
                no-data-text="Gegevens konden niet opgehaald worden."
                multi-sort
            ></v-data-table>
        </v-card>
    </v-container>
</template>

<script>
import axios from "axios";

export default {
    name: "App",
    data() {
        return {
            search: "",
            headers: [
                { text: "Stad", value: "city" },
                { text: "Land", value: "description" },
                { text: "Prijs (€)", value: "price" },
                { text: "Vertrekdatum", value: "departure_date" },
            ],
            info: [],
            loadingCountries: true,
        };
    },
    mounted() {
        axios
            .get("http://127.0.0.1:8000/trips")
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
