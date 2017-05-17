import Vue from 'vue'
import store from '../store'

Vue.component('modal', require('../components/common/modal.vue'))
Vue.component('form-card-nav', require('../components/common/form-card-nav.vue'))
Vue.component('input-money', require('../components/common/input-money.vue'))
Vue.component('input-option', require('../components/products/input-option.vue'))
Vue.component('price', require('../components/common/price.vue'))
Vue.component('timestamp', require('../components/common/timestamp.vue'))
Vue.component('list-table', require('../components/common/list-table.vue'))

export default new Vue({
  el: '.main-content',
  data: window.contentData,
})
