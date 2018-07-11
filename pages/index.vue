<template>
  <section class="index" v-touch:swipe.top="nextSlide" v-touch:swipe.bottom="prevSlide">
    <Header type="main" :count="count" />
    <div class="container">
      <div class="left">

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
                <nuxt-link :to="dummyLeftSlider[count].link"
                  v-if="count === index"
                  v-for="(slide, index) in dummyLeftSlider"
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
                </nuxt-link>
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
              <transition :name="'button-' + direction + '-animation'" appear>
                <nuxt-link class="button" :to="dummyLeftSlider[count].link"
                  v-if="count === index"
                  v-for="(slide, index) in dummyLeftSlider"
                  :key="index">
                  {{ dummyLeftSlider[count].button }}
                </nuxt-link>
              </transition>
            </div>
          </div>

        </div>
        <transition :name="'left-background-' + direction">
          <div v-for="(slide, index) in dummyLeftSlider"
            :class="'left-background-'+`${index + 1}`"
            class="left-background"
            v-if="count === index"
            :key="index" />
        </transition>
      </div>

      <div class="right-background" :class="{'isPurpleAnimating': isChanging}" />
      <div class="right">
        <div class="image-slider" :class="{'isSliderHiding': isChanging}">
          <transition :name="'small-slider-' + direction + '-animation'">
            <nuxt-link v-for="(item, index) in rightSlider"
                v-if="index === rightCount"
                class="image-slider-item link"
                :key="index"
                :to="rightSliderLink(item)">
              <img v-if="item.type === 'video'" class="image-slider-item"
                :src="`${'http://' + item.gif.fields.file.url.slice(2)}`"
                />
              <img v-else class="image-slider-item"
                :src="`${'http://' + (item.image || item.preview || item.media ).fields.file.url.slice(2)}`"
                />
            </nuxt-link>
          </transition>
          <nuxt-link v-for="(item, index) in rightSlider"
              class="arrow"
              v-if="index === rightCount"
              :key="index"
              :to="rightSliderLink(item)">
            <div class="arrow"/>
          </nuxt-link>
        </div>
        <div class="small-slider" :class="{'isSliderHiding': isChanging}">
            <div>
              <transition :name="'small-slider-' + direction + '-animation'">
                <nuxt-link class="small-slider-left"
                  v-for="(item, index) in rightSlider"
                  v-if="index === rightCount"
                  :to="rightSliderLink(item)"
                  :key="index">

                  <div class="text-wrapper" :class="{'product-name': item.type === 'store'}">
                    <div class="small-slider-text" v-html="item.title"/>
                  </div>
                  <!-- <div class="small-slider-place" v-if="item.type === 'calendar'" v-html="item.place"/> -->
                  <div class="small-slider-category" v-if="item.type === 'store'" v-html="item.category"/>
                  <div class="text-wrapper">
                    <div class="small-slider-style" v-if="item.type === 'store'" v-html="item.style"/>
                  </div>
                  <div class="small-slider-event-date" v-if="item.type === 'calendar' || item.type === 'news' || item.type === 'video'"  v-html="item.date"/>
                </nuxt-link>
              </transition>
              <transition :name="'small-slider-' + direction + '-animation'">
                <div class="small-slider-right"
                  v-for="(item, index) in rightSlider"
                  v-if="index === rightCount"
                  :key="index">
                  <div class="small-slider-date" v-if="item.type === 'calendar' || item.type === 'news' || item.type === 'video'" v-html="item.date"/>
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
            link: '/bio/',
            category: 'photos'
          },
          {
            title: ['Latest', 'Photos'],
            subtitle: 'Photos from our<br> recent events',
            button: 'Discover',
            link: '/photo/',
            category: 'videos'
          },
          {
            title: ['New', 'videos'],
            subtitle: 'Newest videos right<br> from the race track',
            button: 'Discover',
            link: '/video/',
            category: 'calendar'
          },
          {
            title: ['upcoming', 'events'],
            subtitle: 'Upcoming events<br> with Alex D',
            button: 'Discover',
            link: '/calendar/',
            category: 'bio'
          }
        ]
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
      Header: () => import('@/components/Header.vue'),
      Logo: () => import('@/components/legacy/Logo.vue'),
      MainSlider: () => import('@/components/legacy/MainSlider.vue'),
      MainNews: () => import('@/components/legacy/MainNews.vue'),
      Footer: () => import('@/components/Footer.vue'),
    },

    methods: {
      sliderInterval () {
        this.nextSlideInterval = setInterval(this.nextSlide, 8000)
      },

      prevSlide () {
        this.direction = 'bottom'
        this.count === 0 ? this.count = 3 : this.count--
        this.rightCount === 0 ? this.rightCount = 3 : this.rightCount--
        clearInterval(this.nextSlideInterval)
        this.sliderInterval()

        this.nextUpAnimation = false
        setTimeout(() => this.nextUpAnimation = true, 0)
      },

      nextSlide () {
        this.direction = 'top'
        this.count === 3 ? this.count = 0 : this.count++
        this.rightCount === this.rightSlider.length - 1 ? this.rightCount = 0 : this.rightCount++
        clearInterval(this.nextSlideInterval)
        this.sliderInterval()

        this.nextUpAnimation = false
        setTimeout(() => this.nextUpAnimation = true, 0)
      },

      handleScroll (e) {
        if (e.deltaY < 0) {
          this.prevSlide()
        }

        if (e.deltaY > 0) {
          this.nextSlide()
        }
      },

      handleKeypress (e) {
        if (e.keyCode === 37) {
          this.prevSlide()
        }

        if (e.keyCode === 39) {
          this.nextSlide()
        }
      },

      rightSliderLink (sliderItem) {
        let link
        this.$store.state.entities[sliderItem.type].map((item, index) => {
          if (sliderItem.title === item.title ) {
            return link = '/' + sliderItem.type + '/' + index
          }
        })
        return link
      }
    },

    computed: {
      rightSlider () {
        return this.$store.state.entities.rightSlider.filter(el => el.locale === this.$store.state.locale )
      },

      meta () {
        return this.$store.state.meta[this.$store.state.locale][this.$route.name]
      }
    },

    beforeRouteLeave(to, from, next) {
      this.isChanging = true
      setTimeout(() => next(), 800)
    },

    mounted () {
      this.isChanging = false
      this.sliderInterval()
      if (!localStorage.getItem('locale')) {
        this.$store.commit('setLocale', 'en')
      } else {
        this.$store.commit('setLocale', localStorage.getItem('locale'))
      }
      // setInterval(() => this.nextSlideRight(), 8000)
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
    overflow: hidden;
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
    justify-content: center;

    // &:hover .left-background {
    //   transform: scale(1.04);
    // }
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

    transition: transform .3s ease;
    will-change: transform;
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
    min-height: 518px;
    padding-top: 70px;
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
      animation: background 8s;
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
    position: relative;
    min-height: 23px;

    .button {
      position: absolute;
      left: 2px;
      top: 3px;

      &:before {
        transition: background .2s ease;
        will-change: background;
      }

      &:hover:before {
        background: transparent !important;
      }
    }
  }

  .left-background-active {
    transform-origin: 50% 0% 0px;
    opacity: 1;
    transform: translateY(0%) scale(1);
  }

  .left-background-top-enter-active, .left-background-top-leave-active {
    pointer-events: none;
    transition: transform 0.8s ease;
    will-change: transform;
  }

  .left-background-top-leave-to {
    transform: translateY(-100%) scale(1);
  }

  .left-background-top-enter {
    transform: translateY(100%) scale(1.4);
  }

  .left-background-bottom-enter-active, .left-background-bottom-leave-active {
    pointer-events: none;
    transition: transform 0.8s ease;
    will-change: transform;
  }

  .left-background-bottom-leave-to {
    transform: translateY(100%) scale(1);
  }

  .left-background-bottom-enter {
    transform: translateY(-100%) scale(1.4);
  }


  .button-top-animation-enter-active, .button-top-animation-leave-active {
    transition: transform .5s;
    transition-delay: .1s;
  }

  .button-top-animation-leave-to {
    transform: translateY(-120%);
    transition-delay: .1s;
  }

  .button-top-animation-enter {
    transform: translateY(120%);
    transition-delay: .1s;
  }

  .button-bottom-animation-enter-active, .button-bottom-animation-leave-active {
    transition: transform .5s;
    transition-delay: .1s;
  }

  .button-bottom-animation-leave-to {
    transform: translateY(120%);
    transition-delay: .1s;
  }

  .button-bottom-animation-enter {
    transform: translateY(-120%);
    transition-delay: .1s;
  }


  .category-top-animation-enter-active, .category-top-animation-leave-active {
    transition: transform .5s ease-in;
  }

  .category-top-animation-leave-to {
    transform: translateY(-110%);
  }

  .category-top-animation-enter {
    transform: translateY(110%);
  }

  .category-bottom-animation-enter-active, .category-bottom-animation-leave-active {
    transition: transform .5s ease-in;
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

    &:nth-child(1) {
      margin-left: -10px;
    }

    &:nth-child(1) &-inner:nth-child(3) {
      margin-left: 10px;
    }

    &:nth-child(2) {
      margin-left: -12px;
    }

    &:nth-child(3) &-inner:nth-child(1) {
      margin-left: -10px;
    }

    &:nth-child(3) &-inner:nth-child(2) {
      margin-left: -4px;
    }

    &:nth-child(4) &-inner:nth-child(1) {
      margin-left: -10px;
    }
  }

  .title-inner {
    position: relative;
    width: 100%;
    display: block;
    min-height: 90px;
    overflow: hidden;
    margin-bottom: 20px;

    font-family: 'Ailerons', sans-serif;
    color: #FFF;
    font-size: 110px;
    line-height: 115px;
    letter-spacing: 0px;
  }

  .title-absolute {
    position: absolute;
    // overflow: hidden;
    top: -33px;
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
    background: linear-gradient(216.25deg, #565656 0%, #000000 100%), #683FFF;
    flex: 0 0 45%;
    display: flex;
    flex-flow: column nowrap;
    justify-content: center;
    padding-left: 100px;
  }

  .right-background {
    width: 100%;
    transform: translateX(55%);
    background: linear-gradient(216.25deg, #565656 0%, #000000 100%), #683FFF;
    height: 100%;
    position: absolute;
    right: 0;
    top: 0;
    transition: transform 0.6s ease-out 0.3s;
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
    width: 400px;
    min-height: 128px;
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

    .text-wrapper {
      width: 65%;
    }

    .product-name {
      width: 100%;
    }
  }

  .small-slider-style,
  .small-slider-right {
    color: #e5e5e5;
  }
  .small-slider-left {
    color: #fff;
    position: absolute;
    left: 0;
    overflow: hidden;


    &:hover {
      .small-slider-text,
      .small-slider-category,
      .small-slider-style,
      .small-slider-event-date,
      .small-slider-price {
        box-shadow: 0 -4px 0 0 #E0E0E0 inset;
      }
    }

    .small-slider-text,
    .small-slider-category,
    .small-slider-style,
    .small-slider-event-date,
    .small-slider-price  {
      display: inline;
      box-shadow: 0 0px 0 0 transparent inset;
      transition: box-shadow .1s ease-in;
      will-change: box-shadow;
    }
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
    width: 400px;
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

  .link {
    width: 100%;
  }

  @media (max-width: 1024px) {
    .right,
    .right-background {
      display: none;
    }

    .left {
      flex: 0 0 100%;
    }
  }

  @media (max-width: 768px) {
    .slide {
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
      .text {
        margin: 0px;
      }
    }
    .title-inner {
      font-size: 100px;
      margin-bottom: 5px;
    }

    .next {
      display: none;
    }
  }
</style>
