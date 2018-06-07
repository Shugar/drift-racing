<template>
  <section class="partners">
    <Header />
    <div class="container" :class="{'isAnimating': isChanging}">
      <u-animate
        name="fadeInUpTitle"
        delay="0s"
        duration="0.8s"
        :iteration="1"
        :offset="0"
        animateClass="animated"
        :begin="true"
      >
        <div class="title">{{locale === 'en' ? 'Partners' : 'Партнеры'}}</div>
      </u-animate>
      <u-animate-container class="partners-list">
        <u-animate
          name="fadeInUpPlayer"
          delay="0.5s"
          duration="0.8s"
          :iteration="1"
          :offset="0"
          animateClass="animated"
          :begin="true"
        >
          <div class="partners-list">
            <div class="partner" v-for="(partner, index) in partners" :key="index">
              <div class="partner-name">{{ partner.name }}</div>
              <div class="partner-description">{{ partner.description }}</div>
            </div>
          </div>
        </u-animate>
      </u-animate-container>
    </div>
    <u-animate
      name="fadeInUpOther"
      delay="1s"
      duration="0.4s"
      :iteration="1"
      :offset="0"
      animateClass="animated"
      :begin="true"
    >
      <Footer />
    </u-animate>
  </section>
</template>

<script>
  export default {
    components: {
      Header: () => import('@/components/Header'),
      Footer: () => import('@/components/Footer')
    },

    data () {
      return {
        isChanging: false,
      }
    },

    head () {
      return {
        title: this.meta.title,
        meta: [
          { name: 'description', content: this.meta.description },
          { name: 'keywords', content: this.meta.keywords },
          { hid: 'og:type', property: 'og:type', content: 'article'},
          { hid: 'og:url', property: 'og:url', content: this.meta.facebook_url },
          { hid: 'og:image', property: 'og:image', content: this.meta.facebook_image },
          { hid: 'og:title', property: 'og:title', content: this.meta.facebook_title },
          { hid: 'og:description', property: 'og:description', content: this.meta.facebook_description },
        ]
      }
    },

    mounted () {
      this.isChanging = false
    },

    beforeRouteLeave(to, from, next) {
      this.isChanging = true
      setTimeout(() => next(), 500)
    },

    computed: {
      partners () {
        return this.$store.state.entities.partner
      },

      meta () {
        return this.$store.state.meta[this.$store.state.locale][this.$route.name]
      },

      locale () {
        return this.$store.state.locale
      }
    }
  }
</script>

<style lang="scss" scoped>
  .partners {
    min-height: 100vh;
    background: #683FFF;
    padding: 200px 0 60px;

    display: flex;
    flex-flow: column nowrap;
    justify-content: space-between;
  }

  .container {
    flex: 1;
    position: relative;
    padding: 0 100px;

    padding-left: 320px;

    display: flex;
    flex-flow: column nowrap;
    transition: transform .5s ease, opacity .5s ease;
    will-change: transform, opacity;
  }

  .title {
    font-family: 'DIN Condensed', sans-serif;
    font-style: normal;
    font-weight: bold;
    line-height: 60px;
    font-size: 48px;
    text-transform: uppercase;
    color: #FFFFFF;
  }

  .partners-list {
    margin-bottom: 40px;
    flex: 1;
    display: flex;
    flex-flow: row wrap;
    justify-content: space-between;
    align-items: center;
  }

  .partner {
    padding-right: 60px;
    flex: 0 0 33%;
  }

  .partner-name {
    font-family: 'DIN Condensed', sans-serif;
    font-style: normal;
    font-weight: bold;
    line-height: 52px;
    font-size: 36px;
    text-transform: uppercase;
    color: #FFFFFF;
  }

  .partner-description {
    font-style: normal;
    font-weight: 500;
    line-height: 28px;
    font-size: 18px;
    color: rgba(255, 255, 255, 0.8);
  }

  @media (max-width: 768px) {
    .container {
      padding-left: 100px;
      justify-content: space-between;
    }

    .partners-list {
      margin-bottom: 80px;
      flex: 0;
      flex-flow: row wrap;
    }

    .partner {
      margin-right: 0;
      flex: 0 0 50%;
      padding-right: 16px;
      margin-top: 60px;
    }
  }

  @media (max-width: 425px) {
    .container {
      padding: 0 30px;
    }

    .partners,
    .partners-list,
    .container {
      display: block;
    }

    .partner,
    .partner:last-child {
      margin-top: 40px;
      padding-right: 0;
    }

    .partner:first-child {
      margin-top: 30px;
    }
  }
</style>
