import "./assets/main.css";

import { createApp } from "vue";
import VueGoogleMaps from "@fawmi/vue-google-maps";

import { createPinia } from "pinia";

import App from "./App.vue";
import router from "./router";


const app = createApp(App);

app.use(createPinia());
app.use(router);

// app.use(VueGoogleMaps, {
//   load: {
//     key: "AIzaSyCAqdwRPpTtDGc6lWZKLSO0EPgkAKRo-8o",
//     libraries: "places",
//   },
// });

app.mount("#app");
