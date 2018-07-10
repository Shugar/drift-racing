<template>
  <section class="bio">
    <Header />

    <div class="container" :class="{'isAnimating': isChanging}">
      <u-animate
        class="tag"
        name="fadeIn"
        delay="0s"
        duration="0.4s"
        :iteration="1"
        :offset="0"
        animateClass="animated"
        :begin="true"
      >
        {{locale === 'en' ? 'bio' : 'био'}}
      </u-animate>
      <div class="left">
        <u-animate
          name="fadeInUp"
          delay="0s"
          duration="0.4s"
          :iteration="1"
          :offset="0"
          animateClass="animated"
          :begin="true"
        >
          <div class="title">{{ bio.leftColumnTitle }}</div>
        </u-animate>
        <u-animate
          name="fadeInUp"
          delay="0.2s"
          duration="0.4s"
          :iteration="1"
          :offset="0"
          animateClass="animated"
          :begin="true"
        >
          <div class="text">
            {{ bio.leftText }}
          </div>
        </u-animate>

        <u-animate-container class="img-fullwidth">
          <u-animate
            name="fadeInUp"
            delay="0.4s"
            duration="0.4s"
            :iteration="1"
            :offset="0"
            animateClass="animated"
            :begin="true"
          >
            <img :src="'http://' + bio.leftImage.fields.file.url.slice(2)" />
          </u-animate>
        </u-animate-container>
      </div>
      <div class="right">
        <u-animate
          name="fadeInUp"
          delay="0s"
          duration="0.4s"
          :iteration="1"
          :offset="0"
          animateClass="animated"
          :begin="true"
        >
          <div class="title">{{ bio.rightColumnTitle }}</div>
        </u-animate>
        <u-animate
          name="fadeInUp"
          delay="0.2s"
          duration="0.4s"
          :iteration="1"
          :offset="0"
          animateClass="animated"
          :begin="true"
        >
          <div class="text">
            {{ bio.rightText }}
          </div>
        </u-animate>
        <u-animate-container class="img-fullwidth">
          <u-animate
            name="fadeInUp"
            delay="0.4s"
            duration="0.4s"
            :iteration="1"
            :offset="0"
            animateClass="animated"
            :begin="true"
          >
            <img :src="'http://' + bio.rightImage.fields.file.url.slice(2)" />
          </u-animate>
        </u-animate-container>
      </div>
    </div>
    <div class="container container-car">
      <u-animate
        class="tag"
        name="fadeIn"
        delay="0s"
        duration="0.8s"
        :iteration="1"
        :offset="0"
        animateClass="animated"
        :begin="true"
      >
        {{locale === 'en' ? 'cars' : 'машины'}}
      </u-animate>
      <div class="left" v-for="(car, index) in bioCars" :key="index">
        <div class="car-wrapper">
          <u-animate
            name="fadeInUp"
            delay="0.6s"
            duration="0.4s"
            :iteration="1"
            :offset="0"
            animateClass="animated"
            :begin="true"
          >
            <div class="title">{{ car.title }}<br> {{ car.car }}</div>
          </u-animate>
          <u-animate
            name="fadeInUp"
            delay="0.8s"
            duration="0.4s"
            :iteration="1"
            :offset="0"
            animateClass="animated"
            :begin="true"
          >
            <img :src="'http://' + car.image.fields.file.url.slice(2)" />
          </u-animate>
          <u-animate
            class="text-wrapper"
            name="fadeInUp"
            delay="1s"
            duration="0.4s"
            :iteration="1"
            :offset="0"
            animateClass="animated"
            :begin="true"
          >
            <div class="text">
              {{ car.text }}
            </div>
          </u-animate>
          <u-animate
            name="fadeInUp"
            delay="1.2s"
            duration="0.4s"
            :iteration="1"
            :offset="0"
            animateClass="animated"
            :begin="true"
          >
            <div class="numbers">
              <div class="numbers-item">
                <div class="numbers-item__digits">{{ car.hp }}</div>
                <div class="numbers-item__units">{{locale === 'en' ? 'HP' : 'ЛС'}}</div>
              </div>
              <div class="numbers-item">
                <div class="numbers-item__digits">{{ car.drivetrain }}</div>
                <div class="numbers-item__units">{{locale === 'en' ? 'DRIVETRAIN' : 'ТРАНСМИССИЯ'}}</div>
              </div>
              <div class="numbers-item">
                <div class="numbers-item__digits">{{ car.engine }}</div>
                <div class="numbers-item__units">{{locale === 'en' ?  'ENGINE' : 'ДВИГАТЕЛЬ'}}</div>
              </div>
            </div>
          </u-animate>
        </div>
      </div>
    </div>

    <u-animate
      name="fadeInUp"
      delay="1.4s"
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
  data () {
    return {
      isChanging: false
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

  components: {
    Header: () => import('@/components/Header'),
    Footer: () => import('@/components/Footer')
  },

  computed: {
    meta () {
      return this.$store.state.meta[this.$store.state.locale][this.$route.name]
    },

    bio () {
      return this.$store.state.entities.bio[0]
    },

    bioCars () {
      return this.$store.state.entities.bioCars
    },

    locale () {
      return this.$store.state.locale
    }
  },

  mounted () {
    this.isChanging = false
  },

  beforeRouteLeave(to, from, next) {
    this.isChanging = true
    setTimeout(() => next(), 300)
  }
}
</script>

<style lang="scss" scoped>
  .bio {
    background: linear-gradient(216.25deg, #565656 0%, #000000 100%), #683FFF;
    padding: 200px 0 80px;
  }

  .container {
    position: relative;
    padding: 0 100px;
    padding-left: 320px;

    display: flex;
    flex-flow: row nowrap;
    align-content: center;

    transition: transform .4s ease, opacity .4s ease;
    will-change: transform, opacity;
  }

  .tag {
    position: absolute;
    left: 100px;
    top: 0px;
    font-family: 'DIN Condensed', sans-serif;
    font-style: normal;
    font-weight: bold;
    line-height: normal;
    font-size: 20px;
    text-transform: uppercase;
    color: #FFFFFF;
  }

  .left {
    // padding-left: 220px;
    // flex: 0 0 60%;

    max-width: 509px;
    display: flex;
    flex-flow: column nowrap;
    width: 50%;
  }

  .right {
    // flex: 0 0 40%;
    width: 50%;
    display: flex;
    flex-flow: column nowrap;
  }

  .title {
    font-family: 'DIN Condensed', sans-serif;
    line-height: normal;
    font-size: 64px;
    text-transform: uppercase;
    color: #FFFFFF;
    margin-bottom: 20px;
  }

  .right .img-fullwidth {
    margin-top: 75px;
  }

  .text {
    line-height: 25px;
    font-size: 18px;
    letter-spacing: -0.03em;
    color: rgba(255, 255, 255, 0.8);
    max-width: 470px;
    padding-right: 40px;
    flex: 1;
  }

  .text-wrapper {
    flex: 1;
  }

  .right .title,
  .right .text {
    padding-right: 0;
    padding-left: 62px;
  }

  .img-fullwidth {
    margin: 100px 0;
  }

  .img-fullwidth img {
    height: auto;
    width: 100%;
    max-width: 100%;
  }

  .container-car {
    flex-flow: row wrap;
    justify-content: space-between;
    // padding: 0px 196px;
    // padding-left: 320px;
    align-content: center;
    padding: 0 161px;
    padding-left: 320px;
  }

  .container-car .left {
    margin-bottom: 100px;

    // &:not(:last-child) {
    //   margin-right: 126px;
    // }

    &:nth-child(even) {
      .title,
      .text {
        padding-left: 0;
      }
    }
  }

  .container-car img {
    width: 100%;
    height: auto;
    margin-bottom: 40px;
  }

  .container-car .left,
  .container-car .right {
    
    width: calc(50% - 31px);
    display: flex;
    flex-flow: column nowrap;
  }

  .car-wrapper {
    max-width: 448px;
  }

  .container-car .right .numbers,
  .container-car .right img {
    margin-left: 50px;
  }

  .container-car .text {
    padding-right: initial;
    max-width: 360px;
    flex: 1;
  }

  .numbers {
    margin-top: 40px;
    display: flex;
    flex-flow: row nowrap;
    align-items: center;
  }

  .numbers-item {
    margin-right: 40px;
    white-space: nowrap;
    &:last-child {
      margin-right: 0;
    }
  }

  .numbers-item__digits {
    font-family:  'DIN Condensed', sans-serif;
    font-style: normal;
    font-weight: bold;
    line-height: normal;
    font-size: 48px;
    text-transform: uppercase;
    color: #FFFFFF;
  }

  .numbers-item__units {
    font-family: 'DIN Condensed', sans-serif;
    font-style: normal;
    font-weight: bold;
    line-height: normal;
    font-size: 20px;
    text-transform: uppercase;
    color: rgba(255, 255, 255, 0.8);
  }

  @media (max-width: 1024px) {
    .tag {
      display: none;
    }

    .container {
      padding-left: 100px;
    }

    .numbers-item__digits {
      font-size: 38px;
    }

    .left {
      padding-left: 0;
    }


    .container-car .left:nth-child(even),
    .container-car .left {
      padding-left: 0;
    }

    .container-car .left {
      margin-right: 77px;
    }

    .container-car .left:nth-child(odd) {
      margin-right: 0;
    }

    .container-car img {
      max-width: 360px;
    }
  }

  @media (max-width: 976px) {
    .left {
      padding-left: 0;
    }

    .container-car .left:nth-child(even),
    .container-car .left {
      padding-left: 0;
      margin-right: 0;
    }

    .container {
      display: block;
    }

    .tag {
      display: none;
    }

    .left {
      margin-left: 0 !important;
      width: inherit;
    }

    .left,
    .right {
      margin-bottom: 60px;
    }

    .text {
      max-width: initial;
      padding: 0;
    }

    .title {
      padding: 0;
    }

    .title br {
      display: none;
    }

    .container-car img {
      max-width: 100%;
    }

    .container-car .text {
      max-width: initial;
    }

    .right .title,
    .right .text {
      padding-left: 0;
    }

    .container-car .right img,
    .container-car .right .numbers {
      margin-left: 0;
    }
  }

  @media (max-width: 425px) {
    .container {
      padding: 0 30px;
    }

    .title {
      font-size: 36px;
      margin-bottom: 10px;
    }

    .container-car img {
      margin-bottom: 30px;
    }

    .img-fullwidth {
      margin: 50px 0 0;
    }

    .left,
    .right {
      margin-bottom: 50px;
    }
  }
</style>
