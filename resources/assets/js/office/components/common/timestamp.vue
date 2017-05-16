<template>
  <span :title="value">{{ formatedValue }}</span>
</template>

<script>
import moment from 'moment'

export default {
  props: {
    value: { default: '' },
  },
  computed: {
    formatedValue: function () {
      return moment(this.value).format('LLL')
    },
  },
}
</script>
