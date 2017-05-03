<script>
module.exports = {
  template: '#list-table',
  props: {pageKeys: Array},
  data: function () {
    return {
      mode: 'pick',
      select: [],
    }
  },
  computed: {
    count: function () {
      return this.select.length
    },
    pageSelected: function () {
      if (this.mode == 'all') {
        return true
      }
      return this.select.length == this.pageKeys.length
    },
  },
  methods: {
    selectClear: function () {
      this.mode = 'pick'
      this.select.splice(0, this.select.length)
    },
    selectAllItem: function () {
      this.mode = 'all'
      this.select.length = 0
      this.pageKeys.forEach((function (key) {
        this.select.push(key)
      }).bind(this))
    },
    selectPageItem: function () {
      this.mode = 'pick'
      this.select.length = 0
      this.pageKeys.forEach((function (key) {
        this.select.push(key)
      }).bind(this))
    },
    selectRowItem: function (key, e) {
      if (e.target.tagName == 'A') return
      this.mode = 'pick'
      var index = this.select.indexOf(key)
      if (index > -1) {
        this.select.splice(index, 1)
      } else {
        this.select.push(key)
      }
    },
    isSelected: function (key) {
      if (this.mode == 'all') {
        return true
      }
      return this.select.indexOf(key) > -1
    },
  },
}
</script>
