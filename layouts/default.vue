<template>
  <div>
    <div class="font_preload">
      <span style="font-family: 'DIN Pro Medium', Arial, sans-serif;"></span>
      <span style="font-family: 'Ailerons', Arial, sans-serif;"></span>
    </div>
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
        this.$store.commit('animateHeader', true)
        setTimeout(() => {
          this.$store.commit('animateHeader', false)
        }, 880)
      },

      '$store.state.locale': function () {
        this.fetchData()
      }
    },

    computed: {
      locale () {
        return this.$store.state.locale
      }
    },

    components: {
      Lightbox: () => import('@/components/Lightbox'),
      Preloader: () => import('@/components/Preloader'),
    },

    methods: {
      fetchData () {
        const client = createClient()

        client.getEntries()
          .then(response => {
            const entities = response.items.map((item, index) => {
              if (item.fields.locale === undefined) {
                return {
                  type: item.sys.contentType.sys.id,
                  locale: 'en',
                  ...item.fields
                }
              }

              if (item.fields.locale === 'ru') {
                return {
                  type: item.sys.contentType.sys.id,
                  locale: item.fields.locale,
                  ...item.fields
                }
              }
            })

            const normalized = { rightSlider: [] }
            const meta = {}
            const normalizedEntities = entities.map((item, index) => {
              normalized[item.type] = normalized[item.type] || []
              if (item.locale === this.locale) {
                normalized[item.type].push(item)
              }

              if (item.type === 'meta') {
                meta[item.locale] = item
              }

              if (item.inRightSlider) {
                normalized.rightSlider.push(item)
              }
            })

            this.$store.commit('fetchMeta', meta)
            this.$store.commit('fetchData', normalized)
            this.loaded = 0
            setTimeout(() => { this.isReady = true }, 300)
          })
          .catch(console.error)
      }
    },
    created () {
      setInterval(() => {
        this.loaded = this.loaded - Math.floor(Math.random() * 10)
      }, 500)
      this.fetchData()
    }
  }
</script>
<style>
  @import '@/assets/fonts/fonts.css';

  .fonts-preload {
    opacity: 0;
    position: absolute;
    left: 0;
    top: 0;
    width: 0;
    top: 0;
  }

  .fade-enter-active, .fade-more-leave-active {
    transition: opacity 0.4s ease;
  }

  .fade-enter, .fade-leave-to {
    opacity: 0.001;
  }

  .isAnimating {
    transform: translateY(50px);
    opacity: 0;
  }

  .isPurpleAnimating {
    transform: translateX(0);
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

  *,
  *:before,
  *:after {
    box-sizing: border-box;
    margin: 0;
  }

  .animated {
    animation-duration: 1s;
    animation-fill-mode: both;
  }

  @keyframes fadeIn {
    from {
      opacity: 0;
    }

    to {
      opacity: 1;
    }
  }

  .fadeIn {
    animation-name: fadeIn;
  }

  @keyframes fadeInUp {
    from {
      opacity: 0;
      transform: translate3d(0, 50px, 0);
    }

    to {
      opacity: 1;
      transform: translate3d(0, 0, 0);
    }
  }

  .fadeInUp {
    animation-name: fadeInUp;
    animation-timing-function: ease;
  }

  @keyframes fadeInUpTitle {
    from {
      opacity: 0;
      transform: translate3d(0, 50px, 0);
    }

    to {
      opacity: 1;
      transform: translate3d(0, 0, 0);
    }
  }

  .fadeInUpTitle {
    animation-name: fadeInUpTitle;
    animation-timing-function: ease-in;
  }

  @keyframes fadeInUpPlayer {
    from {
      opacity: 0;
      transform: translate3d(0, 50px, 0);
    }

    to {
      opacity: 1;
      transform: translate3d(0, 0, 0);
    }
  }

  .fadeInUpPlayer {
    animation-name: fadeInUpPlayer;
    animation-timing-function: ease-out;
  }

  @keyframes fadeInUpOther {
    from {
      opacity: 0;
      transform: translate3d(0, 50px, 0);
    }

    to {
      opacity: 1;
      transform: translate3d(0, 0, 0);
    }
  }

  .fadeInUpOther {
    animation-name: fadeInUpOther;
    animation-timing-function: ease-in-out;
  }

</style>
