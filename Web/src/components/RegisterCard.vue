<template>
    <v-card class="mx-auto">
        <v-card-title class="text-h5 pb-5 grey lighten-2">
            <h2>Registreren</h2>
        </v-card-title>
        <v-card-text class="mt-6">
            <v-alert
                dense
                outlined
                type="error"
                v-model="registerError"
                close-text="Close Alert"
                dismissible
            >
                Sommige velden zijn niet juist ingevuld.
            </v-alert>
            <v-form @submit.prevent="handleRegister">
                <v-row>
                    <v-col cols="12" sm="6">
                        <v-text-field
                            label="Voornaam *"
                            prepend-icon="mdi-account-circle"
                            hint="Hiermee zullen wij u het meest aanspreken op ons platform."
                            v-model="credentials.first_name"
                            persistent-hint
                            required
                    /></v-col>
                    <v-col cols="12" sm="6">
                        <v-text-field
                            label="Achternaam *"
                            prepend-icon="mdi-account-circle"
                            v-model="credentials.last_name"
                            hint="Vul uw voornaam aan met behulp van uw achternaam."
                            persistent-hint
                            required
                    /></v-col>
                    <v-col cols="12">
                        <v-text-field
                            label="E-mailadres *"
                            prepend-icon="mdi-email"
                            hint="Met behulp van uw e-mailadres houden wij contact met u."
                            v-model="credentials.email"
                            persistent-hint
                            required
                    /></v-col>
                    <v-col cols="12" sm="6">
                        <v-text-field
                            label="Straatnaam + huisnr. *"
                            prepend-icon="mdi-map-marker"
                            v-model="credentials.address"
                            required
                    /></v-col>
                    <v-col cols="12" sm="6">
                        <v-text-field
                            label="Postcode *"
                            prepend-icon="mdi-map-marker"
                            v-model="credentials.postal_code"
                            required
                    /></v-col>
                    <v-col cols="12" sm="6">
                        <v-text-field
                            label="Woonplaats *"
                            prepend-icon="mdi-map-marker"
                            v-model="credentials.city"
                            required
                    /></v-col>
                    <v-col cols="12" sm="6">
                        <v-select
                            :items="items"
                            v-model="credentials.country_code"
                            item-text="label"
                            item-value="value"
                            prepend-icon="mdi-map-marker"
                            label="Land *"
                        ></v-select>
                    </v-col>
                    <v-col cols="12">
                        <v-text-field
                            label="Telefoonnummer *"
                            prepend-icon="mdi-phone"
                            v-model="credentials.phone"
                            hint="Als tweede communicatiemethode gebruiken wij uw telefoonnummer."
                            persistent-hint
                            required
                    /></v-col>
                    <v-col cols="12" class="mb-2">
                        <v-text-field
                            :type="showPassword ? 'text' : 'password'"
                            label="Wachtwoord *"
                            v-model="credentials.password"
                            prepend-icon="mdi-lock"
                            :append-icon="
                                showPassword ? 'mdi-eye' : 'mdi-eye-off'
                            "
                            @click:append="showPassword = !showPassword"
                            hint="Om uw gegevens te beschermen, heeft uw account een wachtwoord nodig."
                            persistent-hint
                            required
                        />
                    </v-col>
                </v-row>
                <v-row>
                    <v-col>
                        <small class="red--text"><i>* = verplicht</i></small>
                        <v-divider></v-divider>
                    </v-col>
                </v-row>
                <v-row>
                    <v-col>
                        <v-card-actions class="mt-n3">
                            <v-btn color="info" type="submit">Registreer</v-btn>
                        </v-card-actions>
                    </v-col>
                </v-row>
            </v-form>
        </v-card-text>
    </v-card>
</template>

<script>
import axios from "axios";

export default {
    name: "RegisterCard",
    data() {
        return {
            showPassword: false,
            credentials: {
                first_name: "",
                last_name: "",
                email: "",
                password: "",
                address: "",
                postal_code: "",
                city: "",
                country_code: "",
                phone: "",
            },
            registerError: false,
            items: [
                { label: "Nederland", value: "nl_NL" },
                { label: "Belgie", value: "be_BE" },
                { label: "Duitsland", value: "de_DE" },
                { label: "Denemarken", value: "dk_DK" },
            ],
        };
    },
    methods: {
        handleRegister: function () {
            let url = "http://127.0.0.1:8000/auth/register";
            axios
                .post(url, this.credentials, {
                    dataType: "json",
                    headers: {
                        Accept: "application/json",
                        "Content-Type": "application/json",
                    },
                })
                .then(() => {
                    this.$emit("visibility_register");

                    this.credentials.first_name = "";
                    this.credentials.last_name = "";
                    this.credentials.address = "";
                    this.credentials.city = "";
                    this.credentials.email = "";
                    this.credentials.postal_code = "";
                    this.credentials.phone = "";
                    this.credentials.country_code = "";
                    this.credentials.password = "";
                })
                .catch((err) => {
                    if (!err.response.data.status) {
                        this.registerError = true;
                    }
                });
        },
    },
};
</script>
