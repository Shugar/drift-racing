<template>
  <div>
    <Lightbox />
    <div class="preloader" v-if="!this.isReady">
      <Preloader :loaded="loaded"/>
    </div>
    <nuxt v-else />
  </div>
</template>

<script>
  import { createClient } from '~/plugins/contentful'

  export default {
    data () {
      return {
        loaded: 100,
        isReady: false
      }
    },

    watch: {
      '$route': function (val) {
        this.$store.commit('animateHeader')
      },
    },

    components: {
      Lightbox: () => import('@/components/Lightbox'),
      Preloader: () => import('@/components/Preloader'),
    },

    created () {
      setInterval(() => {
        this.loaded = this.loaded - Math.floor(Math.random() * 10)
      }, 500)

      const client = createClient()

      client.getEntries()
        .then(response => {
          const entities = response.items.map((item, index) => {
            return {
              type: item.sys.contentType.sys.id,
              ...item.fields
            }
          })

          const normalized = { rightSlider: [] }
          const normalizedEntities = entities.map((item, index) => {
            normalized[item.type] = normalized[item.type] || []
            normalized[item.type].push(item)

            if (item.inRightSlider) {
              normalized.rightSlider.push(item)
            }
          })

          this.$store.commit('fetchData', normalized)
          this.loaded = 0
          setTimeout(() => { this.isReady = true }, 300)
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

  a {
    text-decoration: none;
  }

  *, *:before, *:after {
    box-sizing: border-box;
    margin: 0;
  }
</style>
