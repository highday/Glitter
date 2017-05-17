import Vue from 'vue'
import * as types from '../../mutation-types'

const state = {
  fold: false,
}

const getters = {
}

const actions = {
  foldStoreNav ({ commit }) {
    commit(types.NAV_FOLD)
  },
  unfoldStoreNav ({ commit }) {
    commit(types.NAV_UNFOLD)
  },
}

const mutations = {
  [types.NAV_FOLD] (state) {
    state.fold = true
  },
  [types.NAV_UNFOLD] (state) {
    state.fold = false
  },
}

export default {
  state,
  getters,
  actions,
  mutations
}
