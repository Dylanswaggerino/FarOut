<template>
    <v-dialog
        v-model="visible"
        @click:outside="closeDialog"
        width="600px"
        scrollable
    >
        <v-card>
            <v-card-title class="text-h5 grey lighten-2">
                Gegevens over klant
            </v-card-title>
            <v-card-text>
                <v-alert
                    v-model="cancelConfirmation"
                    class="mt-4"
                    dense
                    text
                    type="success"
                >
                    Boeking is succesvol geannuleerd.
                </v-alert>
                <v-expansion-panels class="mt-5">
                    <v-expansion-panel>
                        <v-expansion-panel-header>
                            Geboekte reizen
                        </v-expansion-panel-header>
                        <v-expansion-panel-content>
                            <v-card
                                v-for="reservation in reservations"
                                :key="reservation.trip_id"
                                class="pa-3 mb-5"
                                color="grey lighten-4 elevation-1"
                            >
                                <v-row>
                                    <v-col class="mb-n1">
                                        <b>
                                            Boeking
                                            {{ reservation.id }} &mdash;
                                            {{ reservation.city }} </b
                                        ><br />
                                        Gereserveerd door
                                        {{ reservation.first_name }}
                                        {{ reservation.last_name }}
                                    </v-col>
                                </v-row>
                                <v-row>
                                    <v-col class="mb-n4">
                                        Duurt
                                        {{ reservation.number_of_days }} dagen
                                    </v-col>
                                    <v-col class="mb-n4">
                                        Vetrekt op
                                        {{ reservation.departure_date }}
                                    </v-col>
                                </v-row>
                                <v-row>
                                    <v-col>
                                        <hr />
                                    </v-col>
                                </v-row>
                                <v-row>
                                    <v-col class="mb-n2 mt-n5">
                                        <v-btn
                                            color="error"
                                            text
                                            @click="
                                                cancelReservation(
                                                    reservation.id,
                                                    reservation.customer_id
                                                )
                                            "
                                        >
                                            Annuleer
                                        </v-btn>
                                    </v-col>
                                </v-row>
                            </v-card>
                        </v-expansion-panel-content>
                    </v-expansion-panel>
                    <v-expansion-panel>
                        <v-expansion-panel-header>
                            Overig
                        </v-expansion-panel-header>
                        <v-expansion-panel-content>
                            Dit onderdeel is nog niet ingesteld. Kom later nog
                            eens terug.
                        </v-expansion-panel-content>
                    </v-expansion-panel>
                </v-expansion-panels>
            </v-card-text>
            <v-divider></v-divider>
            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="error" text @click="closeDialog"> Sluiten </v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>

<script>
import axios from "axios";

export default {
    name: "BookingExpension",
    data() {
        return {
            cancelConfirmation: false,
        };
    },
    methods: {
        closeDialog() {
            this.$emit("close");
            this.cancelConfirmation = false;
        },
        cancelReservation(id, customer_id) {
            this.cancelConfirmation = true;

            axios
                .delete(
                    "http://127.0.0.1:8000/reservations/" + id + "/delete",
                    {
                        headers: {
                            Authorization: "Bearer " + this.$store.state.token,
                        },
                    }
                )
                .then(() => {
                    this.$emit("getReservations", customer_id);
                    this.cancelConfirmation = true;
                })
                .catch(() => {});
        },
    },
    props: {
        visible: {
            type: Boolean,
            required: true,
        },
        reservations: {
            type: Array,
            required: true,
        },
    },
};
</script>
