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
      storeFold: state => state.nav.folded,
    }),
  },
  methods: {
    ...mapActions([
      'defoldStoreNav',
      'foldStoreNav',
    ]),
    logout: function () {
      $('form#logoutForm').submit()
    },
  },
})
