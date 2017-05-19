<template>
  <div>
    <div class="notification" :class="{ active: open }">
      <div class="notification-container">
        <div class="notification-header">
          お知らせ
          <a class="ml-3 text-muted small" href="#" v-show="listingNotifications.length > 0" @click.prevent="trancateNotification">
            すべて既読にする
          </a>
          <a class="ml-auto text-muted" href="#" @click.prevent="$emit('close')">
            <i class="fa fa-window-close fa-fw" aria-hidden="true"></i>
          </a>
        </div>
        <transition-group name="fade" tag="div" class="notification-list" v-cloak>
          <div class="notification-item fade-item card small mb-3 p-3 d-flex flex-row align-items-center" v-for="notification in listingNotifications" :key="notification.hash">
            <i class="fa fa-bell fa-fw fa-lg mr-2" aria-hidden="true"></i>
            {{ notification.message }}
            <span class="date ml-auto text-muted">{{ notification.at | fromNow }}</span>
            <a class="archive ml-auto text-muted" href="#" @click.prevent="removeNotification(notification)">
              <i class="fa fa-times-circle fa-fw" aria-hidden="true"></i>
            </a>
          </div>
        </transition-group>
      </div>
      <transition-group name="landing" tag="div" class="notification-runway" v-cloak>
        <div class="card small landing-item p-3 d-flex flex-row align-items-center" v-for="notification in landingNotifications" :key="notification.hash" @click="takeoffNotification(notification)">
          <i class="fa fa-bell fa-fw fa-lg mr-2" aria-hidden="true"></i>
          {{ notification.message }}
        </div>
      </transition-group>
      <slot></slot>
    </div>
    <transition name="backdrop">
      <div class="notification-backdrop" v-cloak v-show="open" @click="$emit('close')"></div>
    </transition>
  </div>
</template>

<script>
import { mapGetters, mapState, mapActions } from 'vuex'

export default {
  name: 'notification-list',
  props: {
    open: false,
  },
  data () {
    return {}
  },
  computed: {
    ...mapGetters([
      'landingNotifications',
      'listingNotifications',
    ]),
  },
  methods: {
    ...mapActions([
      'takeoffNotification',
      'removeNotification',
      'trancateNotification',
    ]),
  },
}
</script>

<style lang="sass">
@import '~bootstrap/scss/_variables.scss';
@import '../../../../sass/office/_variables.scss';

.notification {
    position: fixed;
    top: 0;
    right: -400px;
    bottom: 0;
    width: 400px;
    z-index: 2001;
    transition: right 0.3s ease-in-out, box-shadow 0.3s ease-in-out;

    &.active {
        right: 0;
        box-shadow: 0 0 1rem rgba(0, 0, 0, 0.1);
    }
}

.notification-container {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    position: relative;
    width: 100%;
    height: 100%;
    background: $body-bg;
    overflow-y: scroll;
    z-index: 2002;
}
    .notification-header {
        flex-grow: 0;
        flex-shrink: 0;
        flex-basis: auto;
        display: flex;
        align-items: center;
        position: sticky;
        top: 0;
        padding: 0.5em 1em;
        background: $body-bg;
        border-bottom: 1px solid $gray-lighter;
        z-index: 1;
    }
    .notification-list {
        flex-grow: 1;
        flex-shrink: 0;
        flex-basis: auto;
        position: relative;
        margin: 1rem;
    }
    .notification-empty {
        flex-grow: 1;
        flex-shrink: 0;
        flex-basis: auto;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .notification-item {
        .archive {
            display: none;
        }
        &:hover {
            .date {
                display: none;
            }
            .archive {
                display: inline;
            }
        }
    }

.notification-runway {
    position: absolute;
    top: calc(40px + 0.5rem);
    right: calc(400px + 1.5rem);
    width: 400px;
    z-index: 2001;
}

.notification-backdrop {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: rgba(0,0,0, 0.1);
    backdrop-filter: blur(10px);
    z-index: 2000;
    transition: opacity .5s;
}

.backdrop-enter, .backdrop-leave-to {
    opacity: 0;
}

.fade-item {
    display: block;
    transition: opacity .5s, transform .5s;
}
// .fade-enter-active, .fade-leave-active {
//     transition: opacity .5s, transform .5s;
// }
.fade-enter, .fade-leave-to {
    opacity: 0;
}
.fade-leave-active {
    position: absolute;
    left: 0;
    right: 0;
}

.landing-item {
    display: block;
    transition: opacity .5s, transform .5s;
}
.landing-item + .landing-item {
    margin-top: 1rem;
}
.landing-enter, .landing-leave-to {
    opacity: 0;
    transform: translateX(100px);
}
.landing-leave-active {
    position: absolute;
    left: 0;
    right: 0;
}
</style>
