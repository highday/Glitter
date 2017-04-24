<template>
  <div class="form-card-nav">
    <button type="button" class="form-card-nav-toggle" @click="active = !active"><i class="fa fa-bars fa-fw"></i></button>
    <nav class="nav" :class="{ active: active }">
      <slot>
    </nav>
  </div>
</template>

<script>
module.exports = {
  data: function () {
    return {
      active: false,
    }
  },
  created: function () {
    $('body').on('click', (function (e) {
      if ($.contains($('.form-card-nav-toggle', this.$el).get(0), e.target) != true) {
        this.active = false
      }
    }).bind(this));
  },
}
</script>
