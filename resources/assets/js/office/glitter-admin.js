
/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.config.keyCodes.comma = 188

Vue.component('modal', require('./components/common/modal.vue'));
Vue.component('form-card-nav', require('./components/common/form-card-nav.vue'));
Vue.component('input-money', require('./components/common/input-money.vue'));
Vue.component('input-option', require('./components/products/input-option.vue'));
Vue.component('price', require('./components/common/price.vue'));

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
            $('form#logoutForm').submit();
        },
    },
});

window.mainHeader = new Vue({
    el: '.main-header',
    data: {
        drawerOpen: false,
        notifications: [],
    },
    computed: {
        landingNotifications: function () {
            var landing = this.notifications.filter(function (notification) {
                return notification.landing == true
            })
            return landing.reverse()
        },
        listingNotifications: function () {
            var listing = this.notifications.map(function (notification) {
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
            var notification = {
                id: Math.floor( Math.random() * 10001 ),
                at: moment(),
                title: title,
                message: message,
                landing: true,
            }
            this.notifications.push(notification)
            setTimeout(function () {
                notification.landing = false
            }, 5000)
        },
    },
});
