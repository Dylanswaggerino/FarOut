import Vue from "vue";
import VueRouter from "vue-router";
import Home from "../views/Home.vue";
import LoginView from "../views/LoginView.vue";
import RegisterView from "../views/RegisterView.vue";
import Customers from "../views/Customers.vue";
import Countries from "../views/Countries.vue";

Vue.use(VueRouter);

const routes = [
    {
        path: "/",
        name: "Home",
        component: Home,
    },
    {
        path: "/login",
        name: "Login",
        component: LoginView,
    },
    {
        path: "/register",
        name: "Register",
        component: RegisterView,
    },
    {
        path: "/customers",
        name: "Customers",
        component: Customers,
    },
    {
        path: "/countries",
        name: "Countries",
        component: Countries,
    },
];

const router = new VueRouter({
    mode: "history",
    base: process.env.BASE_URL,
    routes,
});

export default router;
