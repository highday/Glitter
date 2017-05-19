<script>
import { mapActions } from 'vuex'

export default {
  name: 'notification-item',
  render: () => '',
  props: {
    message: String,
  },
  methods: {
    ...mapActions(['notify']),
  },
  created () {
    this.notify({
      message: this.message,
    })
  }
}
</script>
