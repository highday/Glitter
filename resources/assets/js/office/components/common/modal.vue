<template>
  <div>
    <transition name="modal">
      <div v-if="show" class="modal d-block" @click.self="close" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <slot name="header"></slot>
              <button type="button" class="close" @click="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <slot name="body"></slot>
            </div>
            <div class="modal-footer">
              <slot name="footer"></slot>
            </div>
          </div>
        </div>
      </div>
    </transition>
    <transition name="modal-backdrop">
      <div v-if="show" class="modal-backdrop"></div>
    </transition>
  </div>
</template>

<script>
module.exports = {
  props: ['name', 'visible'],
  data: function () {
    return {
      show: this.visible == true,
    }
  },
  created: function () {
    this.$root.$on('modal', (function (name) {
      this.show = this.name == name
    }).bind(this))
    this.$root.$on('modal-close', (function (name) {
      this.show = false
    }).bind(this))
  },
  methods: {
    close: function () {
      this.show = false
    }
  }
}
</script>
