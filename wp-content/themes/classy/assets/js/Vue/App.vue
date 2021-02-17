<template>
  <div class="vue-home">
    <h1>VUE HOME</h1>
  </div>
</template>

<script>

export default {
  name: 'App',
  props: {},

  components: {},

  data() {
    return {}
  },

  mounted() {
    let data = new FormData()
    data.append('action', 'test_api')

    axios.post('/wp-admin/admin-ajax.php', data).then((response) => {
      console.log(response.data)
    })
  },

  created() {},

  updated() {},

  methods: {},

  watch: {},
}
</script>

<style lang="scss" scoped>

</style>
