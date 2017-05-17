import Vue from 'vue'
import Vuex from 'vuex'
import createPersistedState from 'vuex-persistedstate'
// import createLogger from 'vuex/src/plugins/logger'
// import * as actions from './actions'
// import * as getters from './getters'
import nav from './modules/nav'
import notification from './modules/notification'

Vue.use(Vuex)

const debug = process.env.NODE_ENV !== 'production'

const persistedState = createPersistedState({
  paths: ['nav', 'notification']
})

export default new Vuex.Store({
  actions: {},
  getters: {},
  modules: {
    nav,
    notification,
  },
  strict: debug,
  plugins: [persistedState]
  // plugins: debug ? [createLogger()] : []
})
