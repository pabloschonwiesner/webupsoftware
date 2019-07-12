<template lang="pug">
  main
    ps-header
    h1 {{msg}}
    img(src="@/assets/logo.png")
    router-view
    ps-footer
</template>

<script>
import psFooter from '@/components/Layout/Footer.vue'
import psHeader from '@/components/Layout/Header.vue'

export default {
  name: 'app',
  components: {
    psFooter,
    psHeader
  },
  data () {
    return {
      msg: 'Welcome to Your Vue.js App'
    }
  }
}
</script>

<style >
  html {
    background-color: #ccc;
  }
</style>
