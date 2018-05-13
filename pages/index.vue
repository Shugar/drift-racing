<template>
  <section class="index">
    <Header type="main" />
    <div class="container">
      <div class="left">
        <transition name="fade" mode="out-in">
          <div v-for="(slide, index) in dummyLeftSlider"
            class="left-background"
            v-if="count === index"
            :style="{background: `url(/home/car${index + 1}.png) no-repeat center / cover`}"
            :key="index" />
        </transition>

        <div class="slide">
          <div class="next">
            <div class="next-button" @click="nextSlide()">
              <div v-if="nextUpAnimation" class="next-button-background" />
              NEXT UP
            </div>
            <div class="next-category">

              <transition name="category-animation">

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
                  <transition name="category-animation" mode="out-in">
                    <div v-if="count === index" class="title-absolute">
                        {{ title }}
                    </div>
                  </transition>
                </div>
            </div>
            <div class="subtitle-wrapper">
              <transition name="subtitle-animation" mode="out-in">
                <div class="subtitle"
                  v-if="count === index"
                  v-for="(slide, index) in dummyLeftSlider"
                  :key="index"
                  v-html="slide.subtitle" />
              </transition>
            </div>
            <div class="button">
              {{ dummyLeftSlider[count].button }}
            </div>
          </div>

        </div>
      </div>

      <div class="right">
        <div class="image-slider">
          <transition name='small-slider-animation'>
            <img class="image-slider-item" v-for="(item, index) in dummyRightSlider" 
              :src="`${item.image}`" 
              v-if="index === rightCount"
              :key="index" />
            </transition>
          <div class="arrow" />
        </div>
        <div class="small-slider">
            <div>
              <transition name='small-slider-animation'>
                <div class="small-slider-left"
                  v-for="(item, index) in dummyRightSlider"
                  v-if="index === rightCount"
                  :key="index">
                  <div class="small-slider-text" v-html="item.title"/>
                  <div class="small-slider-place" v-if="item.type === 'show'" v-html="item.place"/>
                  <div class="small-slider-category" v-if="item.type === 'store'" v-html="item.category"/>
                  <div class="small-slider-style" v-if="item.type === 'store'" v-html="item.style"/>
                  <div class="small-slider-event-date" v-if="item.type === 'show' || item.type === 'news'" v-html="item.date"/>
                </div>
              </transition>
              <transition name='small-slider-animation'>
                <div class="small-slider-right"
                  v-for="(item, index) in dummyRightSlider"
                  v-if="index === rightCount"
                  :key="index">
                  <div class="small-slider-date" v-if="item.type === 'show' || item.type === 'news'" v-html="item.publishing_date"/>
                  <div class="small-slider-price" v-if="item.type === 'store'" v-html="item.price"/>
                </div>
              </transition>
            </div>
        </div>
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
        count: 0,
        rightCount: 0,
        timeInterval: 0,
        nextUpAnimation: false,
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
            image: '/home/left-slider0.png'
          },
          {
            type: 'store',
            title: 'DRIFT IS MY THERAPY',
            category: 'MEN T-SHIRT',
            style: 'white',
            price: '$ 15',
            image: '/home/left-slider1.png'
          },
          {
            type: 'news',
            title: 'SOCHI. Closing<br> of the season <br> 2017 RDS',
            publishing_date: 'OCT 12 — 2017',
            image: '/home/left-slider2.png'
          },
          {
            type: 'store',
            title: 'FUCKING HERO STYLE',
            category: 'MEN T-SHIRT',
            style: 'BLACK',
            price: '$ 15',
            image: '/home/left-slider3.png'
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
        this.timeInterval = setInterval(() => this.nextSlide(), 4000) 
      },
      nextSlide () {
          this.nextUpAnimation = false,
          this.nextUpAnimation = true,
          this.count === 3 ? this.count = 0 : this.count++
      },
      nextSlideRight () {
        return this.rightCount === 3 ? this.rightCount = 0 : this.rightCount++
      }
    },

    mounted () {
      this.nextUpAnimation = true,
      this.sliderInterval(),
      setTimeout(() => {
        setInterval(() => this.nextSlideRight(), 4000)
      }, 2000)
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
    top: 0;
    left: 0;

    font-size: 36px;
    color: #fff;
  }

  .category-animation-enter-active, .category-animation-leave-active {
    transition: transform .5s;
  }

  .category-animation-leave-to {
    transform: translateY(-110%);
  }

  .category-animation-enter {
    transform: translateY(110%);
  }

  .text {
    flex: 1;
    margin-left: 100px;
  }

  .title {
    margin-bottom: 30px;
    width: 100%;
  }

  .title-animation-enter-active, .title-animation-leave-active {
    transition: transform .4s, opacity .2s ease;;
  }

  .title-animation-leave-to {
    transform: translateY(100%);
    opacity: 0;
  }

  .title-animation-enter {
    transform: translateY(-100%);
  }

  .title-inner {
    position: relative;
    width: 100%;
    display: block;
    height: 70px;
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
    top: 0;
    left: 0;
    margin-bottom: 25px;
    font-family: 'DIN Condensed', sans-serif;
    font-style: normal;
    font-weight: bold;
    line-height: 35px;
    font-size: 24px;
    text-transform: uppercase;
    color: #F2F2F2;
  }

  .subtitle-animation-enter-active, .subtitle-animation-leave-active {
    transition: transform .5s, opacity .3s ease;;
  }

  .subtitle-animation-leave-to {
    transform: translateX(100%);
    opacity: 0;
  }

  .subtitle-animation-enter {
    transform: translateX(-100%);
  }

  .button {
    font-family: 'DIN Condensed', sans-serif;
    font-style: normal;
    font-weight: bold;
    line-height: 29px;
    font-size: 20px;
    text-transform: uppercase;
    color: #FFFFFF;
    position: relative;
    display: inline-block;

    &:before {
      content: '';
      background: #683FFF;
      position: absolute;
      top: 2px;
      left: -1px;
      width: calc(100% + 2px);
      height: 18px;
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
    padding-bottom: 191px;
    padding-left: 100px;
  }

  .small-slider-animation-enter-active, .small-slider-animation-leave-active {
    transition: transform .5s ease, opacity .3s ease;
  }

  .small-slider-animation-leave-to {
    transform: translateX(110%);
    opacity: 0;
  }

  .small-slider-animation-enter {
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
    z-index: 2;
    width: 100%;
    position: absolute;
    bottom: 60px;
  }

  .image-slider {
    position: relative;
    overflow: hidden;
    height: 200px;
    width: 380px;
    margin-bottom: 40px;
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
      padding-left: 50px;
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
