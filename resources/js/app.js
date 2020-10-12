/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./bootstrap");

window.Vue = require("vue");

import Vue from "vue";
import VueContentPlaceholders from "vue-content-placeholders";
Vue.use(VueContentPlaceholders);

import VueProgressBar from "vue-progressbar";

Vue.use(VueProgressBar, {
    color: "red",
    failedColor: "red",
    height: "4px"
});

Vue.component(
    "loding-component",
    require("./components/PlaceholderLoad.vue").default
);
Vue.component(
    "progressbar-component",
    require("./components/Progressbar.vue").default
);

const app = new Vue({
    el: "#app"
});
