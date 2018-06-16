<template>
  <Preloader :loaded="loaded"/>
</template>

<script>
export default {
  data () {
    return {
      loaded: 100
    }
  },

  components: {
    Preloader: () => import('@/components/Preloader'),
  },

  created () {
    setInterval(() => {
      this.loaded = this.loaded - Math.floor(Math.random() * 10)
    }, 500)
  }
}
</script>