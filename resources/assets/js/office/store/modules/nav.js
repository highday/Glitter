import Vue from 'vue'
import * as types from '../../mutation-types'

const state = {
  folded: true,
}

const getters = {
}

const actions = {
  defoldStoreNav ({ commit }) {
    commit(types.NAV_DEFOLD)
  },
  foldStoreNav ({ commit }) {
    commit(types.NAV_FOLD)
  },
}

const mutations = {
  [types.NAV_FOLD] (state) {
    state.folded = true
  },
  [types.NAV_DEFOLD] (state) {
    state.folded = false
  },
}

export default {
  state,
  getters,
  actions,
  mutations
}
