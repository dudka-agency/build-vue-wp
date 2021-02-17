import Vue from 'vue'
import Vuex from 'vuex'
import createPersistedState from 'vuex-persistedstate'

Vue.use(Vuex)

import defaultState from './defaultState'
import getters from './getters'
import actions from './actions'
import mutations from './mutations'

export default new Vuex.Store({
  state: defaultState,
  getters,
  actions,
  mutations,
  modules: {},
  plugins: [createPersistedState()],
})
