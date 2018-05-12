<template>
  <section class="index">
    <Header type="main" />
    <div class="container">
      <div class="left">
        <div class="page-title">
          <div>contact</div>
          <div class="city">
            <div class="city-item" :class="{active : currentCity === 'moscow'}" @click="setCurrentCity('moscow')">moscow</div>
            <div class="city-item" :class="{active : currentCity === 'riga'}" @click="setCurrentCity('riga')">riga</div>
            <div class="city-item" :class="{active : currentCity === 'milano'}" @click="setCurrentCity('milano')">milano</div>
          </div>
        </div>
        <div class="contact-info">
          <div class="contact-title">connect with us</div>
          <div class="contact">alexd@alexdracing.com <br/>8 909 672-52-50</div>
        </div>
        <div class="contact-info">
          <div class="contact-title">location</div>
          <div class="contact">NAB. LIKHOBORSKAYA, <br/>D. 3/1, MOSCOW, 125438.</div>
        </div>
      </div>
      <div class="right">
        <div class="right-background" :style="{background: `url(/contact/map.png) no-repeat center / cover`}"/>
      </div>
    </div>
    <div class="footer-wrapper">
      <Footer />
    </div>
  </section>
</template>

<script>
  export default {
    data () {
      return {
        currentCity: 'moscow',
        count: 0,
        dummyLeftSlider: [
          {
            title: ['Drift', 'Is my', 'Therapy'],
            subtitle: 'Alexander Dmitrenko, pilot of<br> the Russian Drift Series',
            button: 'Learn more',
            category: 'photos'
          },
          {
            title: ['Latest', 'Photos'],
            subtitle: 'Photos from our<br> recent events',
            button: 'Discover',
            category: 'videos'
          },
          {
            title: ['New', 'videos'],
            subtitle: 'Newest videos right<br> from the race track',
            button: 'Discover',
            category: 'calendar'
          },
          {
            title: ['upcoming', 'events'],
            subtitle: 'Upcoming events<br> with Alex D',
            button: 'Discover',
            category: 'bio'
          }
        ],
        dummyRightSlider: [
          {
            type: 'show',
            title: 'Motorshow',
            place: 'BOLOGNA. Italy',
            date: '2-10 December 2017',
            publishing_date: 'DEC 9 — 2017',
            image: '/slider/left-slider0.png'
          },
          {
            type: 'store',
            title: 'DRIFT IS MY THERAPY',
            category: 'MEN T-SHIRT',
            style: 'white',
            price: '$ 15',
            image: '/slider/left-slider1.png'
          },
          {
            type: 'news',
            title: 'SOCHI. Closing<br> of the season <br> 2017 RDS',
            publishing_date: 'OCT 12 — 2017',
            image: '/slider/left-slider2.png'
          },
          {
            type: 'store',
            title: 'FUCKING HERO STYLE',
            category: 'MEN T-SHIRT',
            style: 'BLACK',
            price: '$ 15',
            image: '/slider/left-slider3.png'
          }
        ]
      }
    },

    components: {
      Header: () => import('@/components/Header.vue'),
      Logo: () => import('@/components/legacy/Logo.vue'),
      MainSlider: () => import('@/components/legacy/MainSlider.vue'),
      MainNews: () => import('@/components/legacy/MainNews.vue'),
      Footer: () => import('@/components/Footer.vue'),
    },

    methods: {
      nextSlide () {
        return this.count === 3 ? this.count = 0 : this.count++
      },
      setCurrentCity (city) {
        return this.currentCity = city
      }
    },

    mounted () {
      setInterval(() => this.nextSlide(), 4000)
    }
  }
</script>

<style lang="scss" scoped>
  .index {
    height: 100vh;
  }

  .container {
    height: 100%;
    display: flex;
    flex-flow: row nowrap;
  }

  .left {
    flex: 0 0 55%;
    position: relative;
    padding-left: 100px;
    padding-bottom: 230px;
    background: #683FFF;
    display: flex;
    flex-flow: column nowrap;
    justify-content: flex-end;
    font-family: 'DIN Condensed';
    text-transform: uppercase;
    color: #fff;

  }
  .page-title {
    font-size: 48px;
    margin-left: 240px;
    margin-bottom: 144px;
  }

  .city {
    display: flex;
    justify-content: space-between;
    font-size: 20px;
    color: #fff;
    width: 180px;
    margin-top: 40px;
  }

  .city-item {
    &.active {
      position: relative;
      color: #683FFF;
      z-index: 1;

      &::before {
        content: '';
        display: block;
        position: absolute;
        top: -3px;
        left: -2px;
        width: calc(100% + 5px);
        height: 100%;
        background: #fff;
        z-index: -1;
      }
    }
  }

  .contact-info {
    display: flex;
    width: 560px;
    margin-bottom: 40px;
  }

  .contact {
    font-size: 36px;
    margin-left: 80px;
  }

  .contact-title {
    font-size: 24px;
    width: 160px;
  }

  .right {
    position: relative;
    height: 100%;
    flex: 0 0 45%;
    display: flex;
    flex-flow: column nowrap;
    justify-content: flex-end;
    padding-bottom: 120px;

     .right-background {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      z-index: 0;
    }
  }

  .footer-wrapper {
    width: 100%;
    position: absolute;
    bottom: 60px;
  }

  .category-animation-enter-active, .category-animation-leave-active {
    transition: transform .3s;
  }

  .category-animation-leave-to {
    transform: translateY(-110%);
  }

  .category-animation-enter {
    transform: translateY(110%);
  }
</style>
