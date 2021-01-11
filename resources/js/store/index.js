import adminStore from "../components/Admin/adminStore";
import frontStore from "../components/Front/frontStore";
import authStore from "../components/Front/Auth/authStore"
import Vue from 'vue';
import Vuex from "vuex";

require('../bootstrap');

Vue.use(Vuex);
Vue.config.debug = true;

export default new Vuex.Store({
    modules: {
        adminStore,
        frontStore,
        authStore,
    }
});
