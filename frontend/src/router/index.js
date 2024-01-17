import { createRouter, createWebHistory } from "vue-router";
import LoginViewVue from "@/views/LoginView.vue";
import LandingView from "@/views/LandingView.vue";
import LocationView from "@/views/LocationView.vue";
import MapView from "@/views/MapView.vue";
import TripViewVue from "@/views/TripView.vue";

import axios from "axios";
import StandbyViewVue from "@/views/StandbyView.vue";
import DriverViewVue from "@/views/DriverView.vue";

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: "/",
      name: "login",
      component: LoginViewVue,
    },
    {
      path: "/landing",
      name: "landing",
      component: LandingView,
    },

    {
      path: "/location",
      name: "location",
      component: LocationView,
    },
    {
      path: "/map",
      name: "map",
      component: MapView,
    },
    {
      path: "/trip",
      name: "trip",
      component: TripViewVue,
    },
    {
      path: "/standby",
      name: "standby",
      component: StandbyViewVue,
    },
    {
      path: "/driver",
      name: "driver",
      component: DriverViewVue,
    },
  ],
});

router.beforeEach((to, from) => {
  if (to.name === "login") return true;

  if (!localStorage.getItem("token")) {
    return { name: "login" };
  }

  checkTokenAuthenticity();
});

const checkTokenAuthenticity = () => {
  axios
    .get("http://localhost:8000/api/v1/user", {
      headers: {
        Authorization: `Bearer ${localStorage.getItem("token")}`,
      },
    })
    .then((response) => {
      // router.push({ name: "landing" });
    })
    .catch((error) => {
      localStorage.remove("token");
      router.push({ name: "login" });
    });
};

export default router;
