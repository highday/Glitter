<template>
  <label class="form-control form-control-money" :class="{ focus: active, 'form-control-sm': sm }">
    <input type="hidden" :name="name" :value="fixedValue">
    <span class="unit" :style="{ opacity: isEmpty ? 0.5 : 1 }">{{ unit }}</span>
    <input class="input" type="text" :value="formatedValue" @change="updateValue" @focus="focusInput" @blur="blurInput">
  </label>
</template>

<script>
module.exports = {
  props: {
    name: { default: '' },
    value: { default: '' },
    unit: { default: '¥' },
    point: { default: 0 },
    sm: { type: Boolean, default: false },
    nullable: { type: Boolean, default: false },
  },
  data: function () {
    return {
      active: false,
      rawValue: this.value,
    }
  },
  computed: {
    isEmpty: function () {
      if (this.active) {
        return this.nullable && this.rawValue == ''
      } else {
        return this.nullable && this.formatedValue == ''
      }
    },
    fixedValue: function () {
      if (this.nullable && this.rawValue == '') return ''
      var value = parseFloat(this.rawValue.replace(/[０-９]/g, function (c) {
        return String.fromCharCode(c.charCodeAt(0) - 0xFEE0);
      }).replace(/[^0-9^\.]/g, ''))
      return Number(isNaN(value) ? 0 : value).toFixed(this.point)
    },
    formatedValue: function () {
      if (this.nullable && this.fixedValue == 0) return ''
      return Number(this.fixedValue).toLocaleString(undefined, {
        minimumFractionDigits: this.point,
        maximumFractionDigits: this.point,
      })
    },
  },
  methods: {
    focusInput: function (e) {
      this.active = true
    },
    blurInput: function (e) {
      this.active = false
    },
    updateValue: function (e) {
      this.rawValue = e.target.value
      this.$emit('input', this.fixedValue)
    },
  }
}
</script>
