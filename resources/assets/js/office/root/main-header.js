import Vue from 'vue'
import { mapGetters, mapState, mapActions } from 'vuex'
import moment from 'moment'
import store from '../store'

Vue.filter('fromNow', at => moment(at).fromNow())

Vue.component('notification-list', require('../components/main-header/notification-list.vue'))
Vue.component('notification-item', require('../components/main-header/notification-item.vue'))

export default new Vue({
  el: '.main-header',
  store,
  data: {
    drawerOpen: false,
    notificationId: Math.floor( Math.random() * 10001 ),
  },
  methods: {
    ...mapActions([
      'notify',
    ]),
    openNotification () {
      this.drawerOpen = true
    },
    closeNotification () {
      this.drawerOpen = false
    },
    testNotification () {
      this.notify({
        id: this.notificationId++,
        title: 'タイトル',
        message: 'メッセージ',
      })
    },
  },
})
