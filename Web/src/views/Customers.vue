<template>
    <div id="app" class="container">
        <h1 class="display-1 font-weight-bold my-3">Klantengegevens</h1>
        <p>Deze tabel geeft gegevens weer van alle klanten in het systeem.</p>
        <br />
        <v-card>
            <v-card-title>
                <v-text-field
                    v-model="search"
                    append-icon="mdi-magnify"
                    label="Vul de gegevens van de klant hier in."
                    hide-details
                ></v-text-field>
            </v-card-title>
            <v-data-table
                :headers="headers"
                :items="info"
                :search="search"
                :loading="loadingCustomers"
                loading-text="Klantengegevens aan het ophalen..."
                no-data-text="Gegevens konden niet opgehaald worden."
            >
                <template v-slot:[`item.actions`]="{ item }">
                    <v-icon small class="mr-2" @click="custDialog(item.id)">
                        mdi-eye
                    </v-icon>
                </template>
            </v-data-table>
        </v-card>
        <customer-dialog
            :reservations="this.reservations"
            :visible="this.customerDialog"
            @getReservations="custDialog"
            @close="hideCustomerDialog"
        />
    </div>
</template>

<script>
import axios from "axios";
import CustomerDialog from "@/components/CustomerDialog.vue";
export default {
    name: "App",
    components: { CustomerDialog },
    data() {
        return {
            search: "",
            headers: [
                { text: "ID", value: "id" },
                { text: "Voornaam", value: "first_name" },
                { text: "Achternaam", value: "last_name" },
                { text: "Email", value: "email" },
                { text: "Telefoon Nummer", value: "phone" },
                { value: "actions" },
            ],
            info: [],
            reservations: [],
            customerDialog: false,
            loadingCustomers: true,
        };
    },
    mounted() {
        if (this.$store.state.token !== "") {
            axios
                .post("http://127.0.0.1:8000/auth/checkToken", {
                    token: this.$store.state.token,
                })
                .catch((err) => {
                    if (err) {
                        this.$router.push("/login").catch(() => {});
                    }
                });
        } else {
            this.$router.push("/login").catch(() => {});
        }
        axios
            .get("http://127.0.0.1:8000/customers/", {
                headers: { Authorization: "Bearer " + this.$store.state.token },
            })
            .then((response) => {
                this.loadingCustomers = false;
                this.info = response.data;
            })
            .catch(() => {
                this.loadingCustomers = false;
            });
    },
    methods: {
        custDialog(id) {
            axios
                .get("http://127.0.0.1:8000/reservations/" + id, {
                    headers: {
                        Authorization: "Bearer " + this.$store.state.token,
                    },
                })
                .then((res) => {
                    this.reservations = res.data;
                    this.customerDialog = true;
                });
        },
        hideCustomerDialog() {
            this.customerDialog = false;
        },
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
