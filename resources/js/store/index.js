import Vue from "vue";
import Vuex from 'vuex';
import user from './modules/user';
import bots from './modules/bots';
import sidebar from './modules/sidebar';

Vue.use(Vuex);

export default new Vuex.Store({
    modules: {user, bots, sidebar}
});
