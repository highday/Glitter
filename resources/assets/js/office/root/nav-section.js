import Vue from 'vue'
import { mapGetters, mapState, mapActions } from 'vuex'
import store from '../store'

export default new Vue({
  el: 'header.nav-section',
  store,
  data: {
    drawerOpen: false,
    foldDelayId: null,
  },
  computed: {
    ...mapState({
      storeFold: state => state.nav.fold,
    }),
  },
  methods: {
    ...mapActions([
      'foldStoreNav',
      'unfoldStoreNav',
    ]),
    logout: function () {
      $('form#logoutForm').submit()
    },
  },
})
