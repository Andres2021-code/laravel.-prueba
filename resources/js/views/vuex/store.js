import Vue from 'vue'
import Vuex from 'vuex'
import auth from "./modulos/auth";
import cliente from "./modulos/cliente";
import cuenta  from "./modulos/cuenta";
import consignacion from "./modulos/consignacion";
import retiros from "./modulos/retiros"
Vue.use(Vuex)

const store = new Vuex.Store({
  modules: {
    auth,
    cliente,
    cuenta,
    consignacion,
    retiros
}
})

export default store