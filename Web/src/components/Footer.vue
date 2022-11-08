<template>
    <v-footer color="grey" class="high-priority">
        <v-row no-gutters>
            <v-col class="grey text-center white--text">
                {{ new Date().getFullYear() }} — <strong>FarOut</strong>
            </v-col>
        </v-row>
    </v-footer>
</template>

<script>
export default {
    name: "Footer",
};
</script>

<style scoped>
.high-priority {
    z-index: 4;
}
</style>
