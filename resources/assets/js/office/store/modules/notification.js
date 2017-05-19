import Vue from 'vue'
import * as types from '../../mutation-types'
import moment from 'moment'
import hash from 'object-hash'
import { Howl } from 'howler'

const se = new Howl({
  src: [require('../../../../se/test.mp3')]
})

const state = {
  items: [],
}

const getters = {
  findNotification: (state) => (hash) => {
    if (typeof hash == 'object' && 'hash' in hash) hash = hash.hash
    return state.items.find(item => item.hash === hash)
  },
  landingNotifications (state, { listingNotifications }) {
    return listingNotifications.filter(item => item.landing === true)
  },
  listingNotifications (state) {
    return Array.from(state.items).reverse().filter(item => item.archived === false)
  }
}

const actions = {
  notify ({ dispatch, commit }, props) {
    let notification = Object.assign({
        at: moment(),
        message: '',
        landing: true,
        auto_grage: true,
        archived: false,
    }, props)
    notification.hash = hash(notification)
    commit(types.NOTIFICATION_PUSH, notification)
    if (notification.auto_grage) {
      setTimeout(() => dispatch('takeoffNotification', notification), 5000)
    }
  },
  takeoffNotification ({ commit, getters }, arg) {
    let item = getters.findNotification(arg)
    if (item && item.landing === true) {
      commit(types.NOTIFICATION_TAKEOFF, item)
    }
  },
  removeNotification ({ commit, getters }, arg) {
    let item = getters.findNotification(arg)
    if (item && item.archived === false) {
      commit(types.NOTIFICATION_DESTORY, item)
    }
  },
  trancateNotification ({ commit, state }) {
    if (state.items.length > 0) {
      commit(types.NOTIFICATION_TRANCATE)
    }
  },
}

const mutations = {
  [types.NOTIFICATION_PUSH] (state, notification) {
    state.items.push(notification)
    if (notification.landing) se.play()
  },
  [types.NOTIFICATION_TAKEOFF] (state, notification) {
    let index = state.items.findIndex(item => item.hash === notification.hash)
    notification.landing = false
    if (index !== -1) Vue.set(state.items, index, notification)
  },
  [types.NOTIFICATION_DESTORY] (state, notification) {
    let index = state.items.findIndex(item => item.hash === notification.hash)
    notification.landing = false
    notification.archived = true
    if (index !== -1) Vue.set(state.items, index, notification)
  },
  [types.NOTIFICATION_TRANCATE] (state) {
    state.items = []
  },
}

export default {
  state,
  getters,
  actions,
  mutations
}
