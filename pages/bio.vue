<template>
  <section class="bio">
    <Header />

    <div class="container" :class="{'isAnimating': isChanging}">
      <u-animate
          name="fadeIn"
          delay="0s"
          duration="0.8s"
          :iteration="1"
          :offset="0"
          animateClass="animated"
          :begin="true"
        >
        <div class="tag">bio</div>
      </u-animate>
      <div class="left">
        <u-animate
          name="fadeInUp"
          delay="0s"
          duration="0.8s"
          :iteration="1"
          :offset="0"
          animateClass="animated"
          :begin="true"
        >
          <div class="title">{{ bio.leftColumnTitle }}</div>
        </u-animate>
        <u-animate
          name="fadeInUp"
          delay="0.8s"
          duration="0.8s"
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
            delay="1.6s"
            duration="0.8s"
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
          duration="1.1s"
          :iteration="1"
          :offset="0"
          animateClass="animated"
          :begin="true"
        >
          <div class="title">{{ bio.rightColumnTitle }}</div>
        </u-animate>
        <u-animate
          name="fadeInUp"
          delay="0.8s"
          duration="0.8s"
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
            delay="1.6s"
            duration="0.8s"
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
          name="fadeIn"
          delay="0s"
          duration="0.8s"
          :iteration="1"
          :offset="0"
          animateClass="animated"
          :begin="true"
        >
        <div class="tag">cars</div>
      </u-animate>
      <div class="left" v-for="(car, index) in bioCars" :key="index">
        <u-animate
          name="fadeInUp"
          delay="1.8s"
          duration="0.8s"
          :iteration="1"
          :offset="0"
          animateClass="animated"
          :begin="true"
        >
          <div class="title">{{ car.title }}<br> {{ car.car }}</div>
          <img :src="'http://' + car.image.fields.file.url.slice(2)" />
          <div class="text">
            The car was built at the end of the past especially for the current season in the Russian Drift Series and the European Drift Allstars Championship.
          </div>
          <div class="numbers">
            <div class="numbers-item">
              <div class="numbers-item__digits">{{ car.hp }}</div>
              <div class="numbers-item__units">HP</div>
            </div>
            <div class="numbers-item">
              <div class="numbers-item__digits">{{ car.drivetrain }}</div>
              <div class="numbers-item__units">DRIVETRAIN</div>
            </div>
            <div class="numbers-item">
              <div class="numbers-item__digits">{{ car.engine }}</div>
              <div class="numbers-item__units">ENGINE</div>
            </div>
          </div>
        </u-animate>
      </div>
    </div>

    <Footer />
  </section>
</template>

<script>
export default {
  data () {
    return {
      isChanging: false
    }
  },

  components: {
    Header: () => import('@/components/Header'),
    Footer: () => import('@/components/Footer')
  },

  computed: {
    bio () {
      return this.$store.state.entities.bio[0]
    },

    bioCars () {
      return this.$store.state.entities.bioCars
    },
  },

  mounted () {
    this.isChanging = false
  },

  beforeRouteLeave(to, from, next) {
    this.isChanging = true
    setTimeout(() => next(), 500)
  }
}
</script>

<style lang="scss" scoped>
  .bio {
    background: #683FFF;
    padding: 200px 0 80px;
  }

  .container {
    position: relative;
    padding: 0 100px;

    display: flex;
    flex-flow: row nowrap;
    align-content: center;

    transition: transform .5s ease, opacity .5s ease;
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
    padding-left: 220px;
    // flex: 0 0 60%;


    display: flex;
    flex-flow: column nowrap;
  }

  .right {
    // flex: 0 0 40%;
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
    padding-right: 110px;
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
    align-content: center;
  }

  .container-car .left {
    margin-bottom: 100px;
    padding-left: 130px;

    &:nth-child(even) {
      padding-left: 220px;

      .title,
      .text {
        padding-left: 0;
      }
    }
  }

  .container-car img {
    width: 100%;
    max-width: 440px;
    height: auto;
    margin-bottom: 40px;
  }

  .container-car .left,
  .container-car .right {
    display: flex;
    flex-flow: column nowrap;
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
