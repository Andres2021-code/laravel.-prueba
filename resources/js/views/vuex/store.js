import Vue from 'vue'
import Vuex from 'vuex'
import auth from "./modulos/auth";
import cliente from "./modulos/cliente";
Vue.use(Vuex)

const store = new Vuex.Store({
  modules: {
    auth,
    cliente
}
})

export default store