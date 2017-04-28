<template>
  <span :title="value">{{ price }}</span>
</template>

<script>
module.exports = {
  props: {
    value: { default: '' },
    unit: { default: '¥' },
    point: { default: 0 },
  },
  data: function () {
    return {
    }
  },
  computed: {
    price: function () {
      return this.unit + ' ' + this.formatedValue
    },
    formatedValue: function () {
      return Number(this.value).toLocaleString(undefined, {
        minimumFractionDigits: this.point,
        maximumFractionDigits: this.point,
      })
    },
  },
}
</script>
