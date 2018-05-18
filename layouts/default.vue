<template>
  <div>
    <Lightbox />
    <Preloader v-if="this.$store.state.entities === null" />
    <nuxt v-else />
  </div>
</template>

<script>
  import { createClient } from '~/plugins/contentful'

  export default {
    components: {
      Lightbox: () => import('@/components/Lightbox'),
      Preloader: () => import('@/components/Preloader'),
    },

    mounted () {
      const client = createClient()

      client.getEntries()
        .then(response => {
          const entities = response.items.map((item, index) => {
            return {
              type: item.sys.contentType.sys.id,
              ...item.fields
            }
          })

          const normalized = {}
          const normalizedEntities = entities.map((item, index) => {
            normalized[item.type] = normalized[item.type] || []
            normalized[item.type].push(item)
          })

          this.$store.commit('fetchData', normalized)
        })
        .catch(console.error)
    }
  }
</script>

<style>
  @import '@/assets/fonts/fonts.css';

  .fade-enter-active, .fade-more-leave-active {
    transition: opacity 0.5s ease;
  }

  .fade-enter, .fade-leave-to {
    opacity: 0.001;
  }

  html {
    font-family: "DIN Pro Medium", sans-serif;
    -ms-text-size-adjust: 100%;
    -webkit-text-size-adjust: 100%;
    -moz-osx-font-smoothing: grayscale;
    -webkit-font-smoothing: antialiased;
    box-sizing: border-box;
  }

  *, *:before, *:after {
    box-sizing: border-box;
    margin: 0;
  }
</style>
