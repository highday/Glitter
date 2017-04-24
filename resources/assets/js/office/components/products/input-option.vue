<template>
  <label class="form-control form-control-option" :class="{ focus: active }">
    <input type="hidden" :name="name" :value="value">
    <span class="option" v-for="(option, index) in options">
      {{ option }}
      <span aria-hidden="true" @click="options.splice(index, 1)">&times;</span>
    </span>
    <input class="input" type="text" v-if="options.length == 0" style="width: 100%;" placeholder="Separate options with comma" @keyup="adjustInput" @keyup.comma="addOption" @keyup.delete="deleteOption" @focus="focusInput" @blur="blurInput">
    <input class="input" type="text" v-else :style="{ width: rulerWidth }" @keyup="adjustInput" @keyup.comma="addOption" @keydown.delete="deleteOption" @focus="focusInput" @blur="blurInput">
    <span class="ruler"></span>
  </label>
</template>

<script>
module.exports = {
  props: ['name', 'value'],
  data: function () {
    return {
      rulerWidth: 0,
      active: false,
      options: [],
    }
  },
  methods: {
    adjustInput: function (e) {
      this.rulerWidth = $(this.$el).find('.ruler').text(e.target.value).outerWidth() + 'px'
    },
    addOption: function (e) {
      var option = e.target.value.replace(/[,、]$/, '')
      if (option.length == 0) {
        e.target.value = ''
        return false
      }
      if (this.options.indexOf(option) != -1) {
        var index = this.options.indexOf(option)
        var $option = $(this.$el).find('.option:eq('+index+')')
        $option.animate({ top: '-1rem' }, 100, 'swing').animate({ top: 0 }, 200, 'swing')
        e.target.value = option
        return false
      }
      e.target.value = ''
      this.options.push(option)
      this.rulerWidth = $(this.$el).find('.ruler').text('').outerWidth() + 'px'
      this.updateValue()
    },
    deleteOption: function (e) {
      if (this.options.length > 0 && e.target.value == '') {
        this.options.splice(this.options.length - 1)
        this.updateValue()
      }
    },
    focusInput: function (e) {
      this.active = true
    },
    blurInput: function (e) {
      this.active = false
      this.addOption(e)
    },
    updateValue: function () {
      this.$emit('input', this.options.join(','))
    },
  }
}
</script>
