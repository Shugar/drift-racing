<template>
  <section class="index">
    <Header type="main" :count="count" />
    <div class="container">
      <div class="left">
        <transition name="fade" mode="out-in" appear>
          <div v-for="(slide, index) in dummyLeftSlider"
            :class="'left-background-'+`${index + 1}`"
            class="left-background"
            v-if="count === index"
            :key="index" />
        </transition>

        <div class="slide">
          <div class="next">
            <transition name="next-fade" appear>
              <div class="next-button" @click="nextSlide()">
                <div v-if="nextUpAnimation" class="next-button-background" />
                NEXT UP
              </div>
            </transition>
            <div class="next-category">

              <transition :name="'category-' + direction + '-animation'" appear>

                <div class="next-category-inner"
                  v-if="count === index"
                  v-for="(slide, index) in dummyLeftSlider"
                  :key="index">
                    {{ dummyLeftSlider[count].category }}
                </div>

              </transition>

            </div>
          </div>

          <div class="text">
            <div class="title" v-for="(slide, index) in dummyLeftSlider"
              :style="{display: count === index ? 'block' : 'none'}"
              :key="index">
                <div class="title-inner"
                  v-for="(title, i) in slide.title"
                  :key="i">
                  <transition :name="'category-' + direction + '-animation'" mode="out-in" appear>
                    <div v-if="count === index" class="title-absolute">
                        {{ title }}
                    </div>
                  </transition>
                </div>
            </div>
            <div class="subtitle-wrapper">
              <transition :name="'subtitle-' + direction + '-animation'"
                mode="out-in"
                appear
                appear-class="subtitle-top-appear-animation-enter"
                appear-active-class="subtitle-top-appear-animation-enter-active">
                <div class="subtitle"
                  v-if="count === index"
                  v-for="(slide, index) in dummyLeftSlider"
                  :key="index"
                  v-html="slide.subtitle" />
              </transition>
            </div>
            <div class="button-wrapper">
              <transition name="button-top-animation" appear>
                <nuxt-link class="button" :to="dummyLeftSlider[count].link">
                  {{ dummyLeftSlider[count].button }}
                </nuxt-link>
              </transition>
            </div>
          </div>

        </div>
      </div>

      <div class="right-background" :class="{'isPurpleAnimating': isChanging}" />
      <div class="right">
        <div class="image-slider" :class="{'isSliderHiding': isChanging}">
          <transition :name="'small-slider-' + direction + '-animation'">
            <img class="image-slider-item" v-for="(item, index) in rightSlider"
              :src="`${'http://' + (item.image || item.preview || item.media ).fields.file.url.slice(2)}`"
              v-if="index === rightCount"
              :key="index" />
            </transition>
          <nuxt-link v-for="(item, index) in rightSlider"
              class="arrow"
              v-if="index === rightCount"
              :key="index"
              :to="`${item.link}`">
            <div class="arrow"/>
          </nuxt-link>
        </div>
        <div class="small-slider" :class="{'isSliderHiding': isChanging}">
            <div>
              <transition :name="'small-slider-' + direction + '-animation'">
                <div class="small-slider-left"
                  v-for="(item, index) in rightSlider"
                  v-if="index === rightCount"
                  :key="index">
                  <div class="small-slider-text" v-html="item.title"/>
                  <!-- <div class="small-slider-place" v-if="item.type === 'calendar'" v-html="item.place"/> -->
                  <div class="small-slider-category" v-if="item.type === 'store'" v-html="item.category"/>
                  <div class="small-slider-style" v-if="item.type === 'store'" v-html="item.style"/>
                  <div class="small-slider-event-date" v-if="item.type === 'calendar' || item.type === 'news'" v-html="item.date"/>
                </div>
              </transition>
              <transition :name="'small-slider-' + direction + '-animation'">
                <div class="small-slider-right"
                  v-for="(item, index) in rightSlider"
                  v-if="index === rightCount"
                  :key="index">
                  <div class="small-slider-date" v-if="item.type === 'calendar' || item.type === 'news'" v-html="item.date"/>
                  <div class="small-slider-price" v-if="item.type === 'store'">$ {{ item.price }}</div>
                </div>
              </transition>
            </div>
        </div>
      </div>
    </div>
    <div class="footer-wrapper" :class="{'isFooterHiding': isChanging}">
      <Footer type="main" />
    </div>
  </section>
</template>

<script>
  function debounce(func, wait, immediate) {
    var timeout;
    return function() {
      var context = this, args = arguments;
      clearTimeout(timeout);
      timeout = setTimeout(function() {
        timeout = null;
        if (!immediate) func.apply(context, args);
      }, wait);
      if (immediate && !timeout) func.apply(context, args);
    };
  }

  export default {
    data () {
      return {
        count: 0,
        rightCount: 0,
        direction: 'top',
        isChanging: false,
        timeInterval: 0,
        nextUpAnimation: true,
        dummyLeftSlider: [
          {
            title: ['Drift', 'Is my', 'Therapy'],
            subtitle: 'Alexander Dmitrenko, pilot of<br> the Russian Drift Series',
            button: 'Learn more',
            link: '/photo/',
            category: 'photos'
          },
          {
            title: ['Latest', 'Photos'],
            subtitle: 'Photos from our<br> recent events',
            button: 'Discover',
            link: '/video/',
            category: 'videos'
          },
          {
            title: ['New', 'videos'],
            subtitle: 'Newest videos right<br> from the race track',
            button: 'Discover',
            link: '/calendar/',
            category: 'calendar'
          },
          {
            title: ['upcoming', 'events'],
            subtitle: 'Upcoming events<br> with Alex D',
            button: 'Discover',
            link: '/bio/',
            category: 'bio'
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
      sliderInterval () {
        this.nextSlideInterval = setInterval(this.nextSlide, 4000)
      },

      prevSlide () {
        this.direction = 'bottom'
        this.count === 0 ? this.count = 3 : this.count--

        clearInterval(this.nextSlideInterval)
        this.sliderInterval()

        this.nextUpAnimation = false
        this.prevSlideRight()
        setTimeout(() => this.nextUpAnimation = true, 0)
      },

      nextSlide () {
        this.direction = 'top'
        this.count === 3 ? this.count = 0 : this.count++

        clearInterval(this.nextSlideInterval)
        this.sliderInterval()

        this.nextUpAnimation = false
        this.nextSlideRight()
        setTimeout(() => this.nextUpAnimation = true, 0)
      },

      nextSlideRight () {
        return this.rightCount === 3 ? this.rightCount = 0 : this.rightCount++
      },

      prevSlideRight () {
        return this.rightCount === 0 ? this.rightCount = 3 : this.rightCount--
      },

      handleScroll (e) {
        if (e.deltaY < 0) {
          this.prevSlideRight()
          this.prevSlide()
        }

        if (e.deltaY > 0) {
          this.nextSlideRight()
          this.nextSlide()
        }
      },

      handleKeypress (e) {
        if (e.keyCode === 37) {
          this.prevSlideRight()
          this.prevSlide()
        }

        if (e.keyCode === 39) {
          this.nextSlideRight()
          this.nextSlide()
        }
      }
    },

    computed: {
      rightSlider () {
        return this.$store.state.entities.rightSlider
      }
    },

    beforeRouteLeave(to, from, next) {
      this.isChanging = true
      setTimeout(() => next(), 1000)
    },

    mounted () {
      this.isChanging = false
      this.sliderInterval()
      setInterval(() => this.nextSlideRight(), 4000)
    },

    created () {
      if (process.browser) {
        var fired = false
        const self = this

        window.addEventListener('wheel', function (e) {
          if (!fired) {
            fired = true
            self.handleScroll(e)
            setTimeout(() => {
              fired = false
            }, 1000)
          }
        }, true)
        window.addEventListener('keyup', this.handleKeypress);
      }
    },

    destroyed () {
      if (process.browser) {
        window.removeEventListener('keyup', this.handleKeypress);
      }
    }
  }
</script>

<style lang="scss" scoped>
  .fade-enter-active, .fade-more-leave-active {
    transition: opacity .5s ease;
  }

  .fade-enter, .fade-leave-to {
    opacity: 0.8;
  }

  .next-fade-enter-active, .next-fade-leave-active {
    transition: opacity .3s ease;
  }

  .next-fade-enter, .next-fade-leave-to
  /* .component-fade-leave-active до версии 2.1.8 */ {
    opacity: 0;
  }

  .index {
    position: relative;
    height: 100vh;
    min-height: 700px;
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

    display: flex;
    flex-flow: column nowrap;
    justify-content: flex-end;
  }

  .left-background {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 0;

    &:after {
      content: '';
      background: #333333;
      opacity: 0.6;
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      z-index: 0;
    }
  }

  .left-background-1 {
    background: url('/static/home/left-slider/main-1.jpg') no-repeat center / cover;
  }
  .left-background-2 {
    background: url('/static/home/left-slider/main-2.jpg') no-repeat center / cover;
  }
  .left-background-3 {
      background: url('/static/home/left-slider/main-3.jpg') no-repeat center / cover;
  }
  .left-background-4 {
      background: url('/static/home/left-slider/main-4.jpg') no-repeat center / cover;
  }


@media only screen and (max-width: 1024px) {
  .left-background-1 {
    background: url('/static/home/left-slider/main-mob-1.jpg') no-repeat center / cover;
  }
  .left-background-2 {
    background: url('/static/home/left-slider/main-mob-2.jpg') no-repeat center / cover;
  }
  .left-background-3 {
      background: url('/static/home/left-slider/main-mob-3.jpg') no-repeat center / cover;
  }
  .left-background-4 {
      background: url('/static/home/left-slider/main-mob-4.jpg') no-repeat center / cover;
  }
}


@media	only screen and (-webkit-min-device-pixel-ratio: 1.3),
        only screen and (-o-min-device-pixel-ratio: 13/10),
        only screen and (min-resolution: 120dpi) {

        .left-background-1 {
          background: url('/static/home/left-slider/main-1@2x.jpg') no-repeat center / cover;
        }
        .left-background-2 {
          background: url('/static/home/left-slider/main-2@2x.jpg') no-repeat center / cover;
        }
        .left-background-3 {
            background: url('/static/home/left-slider/main-3@2x.jpg') no-repeat center / cover;
        }
        .left-background-4 {
            background: url('/static/home/left-slider/main-4@2x.jpg') no-repeat center / cover;
        }
    }


@media only screen and (-webkit-min-device-pixel-ratio: 2),
       only screen and (min-resolution: 192dpi),
       only screen and (max-width: 1024px) {
      .left-background-1 {
        background: url('/static/home/left-slider/main-mob-1@2x.jpg') no-repeat center / cover;
      }
      .left-background-2 {
        background: url('/static/home/left-slider/main-mob-2@2x.jpg') no-repeat center / cover;
      }
      .left-background-3 {
          background: url('/static/home/left-slider/main-mob-3@2x.jpg') no-repeat center / cover;
      }
      .left-background-4 {
          background: url('/static/home/left-slider/main-mob-4@2x.jpg') no-repeat center / cover;
      }
    }

  .slide {
    padding-bottom: 130px;
    position: relative;
    z-index: 1;

    display: flex;
    flex-flow: row nowrap;
    align-items: flex-end;
  }

  .next {
    position: relative;
    width: 120px;
    margin-bottom: 50px;
    font-family: 'DIN Condensed', sans-serif;
    font-style: normal;
    font-weight: bold;
    line-height: normal;
    text-transform: uppercase;
    color: #FFFFFF;
  }

  @keyframes background {
    from {
      width: 0;
    }
    to {
      width: calc(100% + 2px);
    }
  }

  .next-button {
    margin-bottom: 5px;
    font-size: 20px;
    position: relative;
    display: inline-block;
    cursor: pointer;
    user-select: none;

    &-background {
      content: '';
      background: #683FFF;
      position: absolute;
      top: 0px;
      left: -1px;
      width: calc(100% + 2px);
      height: 18px;
      z-index: -1;
      animation: background 4s;
    }
  }


  .next-category {
    font-size: 36px;
    position: relative;
    display: inline-block;

    overflow: hidden;
    min-height: 35px;
    max-width: 130px;
    width: 100%;
  }

  .next-category-inner {
    position: absolute;
    top: -1px;
    left: 0;

    font-size: 36px;
    color: #fff;
  }

  .button-wrapper {
    overflow-y: hidden;
    padding-left: 2px;
  }

  .button-top-animation-enter-active, .button-top-animation-leave-active {
    transition: transform .5s;
    transition-delay: .3s;
  }

  .button-top-animation-leave-to {
    transform: translateY(-120%);
    transition-delay: .3s;
  }

  .button-top-animation-enter {
    transform: translateY(120%);
    transition-delay: .3s;
  }


  .category-top-animation-enter-active, .category-top-animation-leave-active {
    transition: transform .5s;
  }

  .category-top-animation-leave-to {
    transform: translateY(-110%);
  }

  .category-top-animation-enter {
    transform: translateY(110%);
  }

  .category-bottom-animation-enter-active, .category-bottom-animation-leave-active {
    transition: transform .5s;
  }

  .category-bottom-animation-leave-to {
    transform: translateY(110%);
  }

  .category-bottom-animation-enter {
    transform: translateY(-110%);
  }

  .text {
    flex: 1;
    margin-left: 100px;
  }

  .title {
    margin-bottom: 30px;
    width: 100%;
  }

  .title-inner {
    position: relative;
    width: 100%;
    display: block;
    min-height: 74px;
    overflow: hidden;
    margin-bottom: 40px;

    font-family: 'Ailerons', sans-serif;
    color: #FFF;
    font-size: 90px;
    line-height: 115px;
    letter-spacing: 0px;
  }

  .title-absolute {
    position: absolute;
    overflow: hidden;
    top: -37px;
    left: 0;
  }

  .subtitle-wrapper {
    position: relative;
    width: 100%;
    display: block;
    min-height: 95px;
    overflow: hidden;
  }

  .subtitle {
    position: absolute;
    top: 3px;
    left: 0;
    margin-bottom: 22px;
    font-family: 'DIN Condensed', sans-serif;
    font-style: normal;
    font-weight: bold;
    line-height: 35px;
    font-size: 24px;
    text-transform: uppercase;
    color: #F2F2F2;
  }

  .subtitle-top-appear-animation-enter-active, .subtitle-top-appear-animation-leave-active {
    transition: transform .5s, opacity .3s ease;
    transition-delay: .3s;
  }

  .subtitle-top-appear-animation-leave-to {
    transform: translateX(100%);
    opacity: 0;
  }

  .subtitle-top-appear-animation-enter {
    transform: translateX(-100%);
  }

  .subtitle-top-animation-enter-active, .subtitle-top-animation-leave-active {
    transition: transform .5s, opacity .3s ease;
  }

  .subtitle-top-animation-leave-to {
    transform: translateX(100%);
    opacity: 0;
  }

  .subtitle-top-animation-enter {
    transform: translateX(-100%);
  }

  .subtitle-bottom-animation-enter-active, .subtitle-bottom-animation-leave-active {
    transition: transform .5s, opacity .3s ease;
  }

  .subtitle-bottom-animation-leave-to {
    transform: translateX(-100%);
    opacity: 0;
  }

  .subtitle-bottom-animation-enter {
    transform: translateX(100%);
  }

  .button {
    font-family: 'DIN Condensed', sans-serif;
    font-style: normal;
    font-weight: bold;
    line-height: 20px;
    font-size: 20px;
    text-transform: uppercase;
    color: #FFFFFF;
    position: relative;
    display: inline-block;
    text-decoration: none;

    &:before {
      content: '';
      background: #683FFF;
      position: absolute;
      top: -3px;
      left: -2px;
      width: calc(100% + 4px);
      height: 20px;
      z-index: -1;
    }
  }


  .right {
    height: 100%;
    background: #683FFF;
    flex: 0 0 45%;
    display: flex;
    flex-flow: column nowrap;
    justify-content: flex-end;
    padding-bottom: 190px;
    padding-left: 100px;
  }

  .right-background {
    width: 100%;
    transform: translateX(55%);
    background: #683FFF;
    height: 100%;
    position: absolute;
    right: 0;
    top: 0;
    transition: transform 1s ease 0.3s;
    will-change: transform;
    z-index: 5;
  }

  .isSliderHiding,
  .isFooterHiding {
    opacity: 0;
  }

  .isPurpleAnimating {
    transform: translateX(0);
  }

  .small-slider-top-animation-enter-active, .small-slider-top-animation-leave-active {
    transition: transform .5s ease, opacity .3s ease;
  }

  .small-slider-top-animation-leave-to {
    transform: translateX(110%);
    opacity: 0;
  }

  .small-slider-top-animation-enter {
    transform: translateX(-110%);
  }

  .small-slider-bottom-animation-enter-active, .small-slider-bottom-animation-leave-active {
    transition: transform .5s ease, opacity .3s ease;
  }

  .small-slider-bottom-animation-leave-to {
    transform: translateX(110%);
    opacity: 0;
  }

  .small-slider-bottom-animation-enter {
    transform: translateX(-110%);
  }

  .small-slider {
    width: 380px;
    min-height: 120px;
    font-family: 'DIN Condensed', sans-serif;
    text-transform: uppercase;
    font-size: 36px;
    color: #fff;
    display: flex;
    flex-flow: row nowrap;

    overflow: hidden;
    position: relative;
    z-index: 6;

    transition: opacity .4s ease;
    will-change: opacity;

    &-text {
      width: 65%;
    }
  }


  .small-slider-style,
  .small-slider-right {
    color: #e5e5e5;
  }
  .small-slider-left {
    position: absolute;
    left: 0;
    overflow: hidden;
  }

  .small-slider-right {
    position: absolute;
    right: 0;
    display: flex;
    height: 100%;
    overflow: hidden;

    .small-slider-data {
      align-self: flex-start;
    }
    .small-slider-price {
      align-self: flex-end;
      margin-bottom: -9px;
    }
  }

  .small-slider-date {
    font-size: 24px;
    margin-left: 20px;
  }

  .footer-wrapper {
    z-index: 6;
    width: 100%;
    position: absolute;
    bottom: 60px;
    transition: opacity .4s ease .2s;
    will-change: opacity;
  }

  .image-slider {
    position: relative;
    overflow: hidden;
    height: 200px;
    width: 380px;
    margin-bottom: 40px;
    z-index: 6;
    transition: opacity .4s ease;
    will-change: opacity;
  }

  .arrow {
    position: absolute;
    right: 0;
    top: 0;
    height: 100%;
    width: 60px;
    background: url('/home/arrow-right.svg') no-repeat center / cover;
  }

  .image-slider-item {
    position: absolute;
    height: 100%;
    width: calc(100% - 60px);
    left: 0;
    top: 0;
  }

  @media (max-width: 1024px) {
    .right {
      display: none;
    }

    .left {
      flex: 0 0 100%;
    }
  }

  @media (max-width: 768px) {
    .slide {
      padding-bottom: 258px;

      .text {
        margin-left: 70px;
      }
    }
  }

  @media (max-width: 425px) {
    .left {
      padding-left: 30px;
    }

    .slide {
      padding-bottom: 110px;

      .text {
        margin: 0px;
      }
    }
    .title-inner {
      font-size: 100px;
      margin-bottom: 30px;
    }

    .next {
      display: none;
    }
  }
</style>
