import jQuery from 'jquery'
import Vue from 'vue'
import Vuex from 'vuex'
import createPersistedState from 'vuex-persistedstate'
import moment from 'moment'
import { Howl } from 'howler'
// import Tone from 'tone'

import fa from 'font-awesome/scss/font-awesome.scss'
import style from '../../sass/office/glitter-office.scss'

moment.locale('ja')

Vue.config.keyCodes.comma = 188
Vue.use(Vuex)

Vue.component('modal', require('./components/common/modal.vue'))
Vue.component('form-card-nav', require('./components/common/form-card-nav.vue'))
Vue.component('input-money', require('./components/common/input-money.vue'))
Vue.component('input-option', require('./components/products/input-option.vue'))
Vue.component('price', require('./components/common/price.vue'))
Vue.component('list-table', require('./components/common/list-table.vue'))

const se = new Howl({
  src: [require('../../se/test.mp3')]
})

class Notification {
  constructor(props) {
    this.id = props.id
    this.at = props.at
    this.title = props.title
    this.message = props.message
    this.landing = props.landing
    this.auto_grage = props.auto_grage
  }
  landing() {
      this.landing = true
  }
  takeoff() {
      this.landing = false
  }
}

var store = new Vuex.Store({
  state: {
    notifications: [],
  },
  plugins: [createPersistedState()],
  mutations: {
    addNotification: function (state, item) {
        state.notifications.push(item)
    },
    updateNotification: function (state, item) {
        state.notifications.map(function (notification) {
            if (notification.id == item.id) return item
        })
    },
    destoryNotification: function (state, item) {
        state.notifications = state.notifications.filter(function (notification) {
            return notification.id != item.id
        })
    },
    trancateNotifications: function (state) {
        state.notifications = []
    },
  },
  actions: {
    notify: function (context, props) {
        var notification = new Notification(props)
        context.commit('addNotification', notification)
        se.play()
        if (notification.auto_grage) {
            setTimeout(function () {
                notification.takeoff()
                context.commit('updateNotification', notification)
            }, 5000)
        }
    },
    takeoffNotify: function (context, notification) {
        notification.takeoff()
        context.commit('updateNotification', notification)
    },
    removeNotify: function (context, notification) {
        context.commit('destoryNotification', notification)
    },
    removeAllNotify: function (context) {
        context.commit('trancateNotifications')
    },
  }
})

window.nav = new Vue({
    el: 'header.nav-section',
    data: {
        drawerOpen: false,
        storeFold: true,
        foldDelayId: null,
    },
    methods: {
        unfoldStoreNav: function () {
            this.storeFold = false
        },
        foldStoreNav: function () {
            this.storeFold = true
        },
        logout: function () {
            $('form#logoutForm').submit()
        },
    },
})

window.mainHeader = new Vue({
    el: '.main-header',
    data: {
        drawerOpen: false,
    },
    computed: {
        landingNotifications: function () {
            var landing = store.state.notifications.filter(function (notification) {
                return notification.landing == true
            })
            return landing.reverse()
        },
        listingNotifications: function () {
            var listing = store.state.notifications.map(function (notification) {
                notification.date = moment(notification.at).fromNow()
                return notification
            })
            return listing.reverse()
        }
    },
    methods: {
        openNotification: function () {
            this.drawerOpen = true
        },
        closeNotification: function () {
            this.drawerOpen = false
        },
        addNotification: function (title, message) {
            store.dispatch('notify', {
                id: Math.floor( Math.random() * 10001 ),
                at: moment(),
                title: title,
                message: message,
                landing: true,
                auto_grage: true,
            })
        },
        hideNotification: function (notification) {
            store.dispatch('takeoffNotify', notification)
        },
        archiveNotification: function (notification) {
            store.dispatch('removeNotify', notification)
        },
        allArchiveNotifications: function () {
            store.dispatch('removeAllNotify')
        },
    },
})

window.mainContent = new Vue({
    el: '.main-content',
    data: window.contentData,
})

window.$ = window.jQuery = require('jquery');
window.Tether = require('tether');
require('bootstrap');
window.Chart = require('chart.js');
