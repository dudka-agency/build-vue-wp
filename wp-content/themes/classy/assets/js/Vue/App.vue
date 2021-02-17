<template>
  <div class="vue-home">
    <h1>VUE HOME</h1>
  </div>
</template>

<script>
import { mapState } from 'vuex';

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

  computed: {
    ...mapState({

    })
  }
}
</script>

<style lang="scss" scoped>

</style>
