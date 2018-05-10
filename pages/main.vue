<template>
  <div class="container">
    <Header type='main' />
    <div class="left-side">
      <transition name="fade">
        <div v-for="(item, index) in subTitle"
          class="main-background"
          :style="{background: `url(/home/car${index+1}.png) no-repeat center / cover`}"
          v-if="count === index"
          :key="index" />
      </transition>
    </div>
    <div class="right-side"></div>

    <div class="content">
      <div class="content-left">
        <div class="content-left__wrapper">
          <div class="button__wrapper">
            <div class="next-slide-button" @click="nextSlide"> next up </div>
            <div class="slide-name">{{ category[count] }}</div>
          </div>
          <div>
            <div class="big-text">
            <div v-for="(item, index) in bigText[count]" :key="index" > {{ item }} </div>
            </div>
            <div class="slide-descr">{{ subTitle[count] }}</div>
            <div class="discover">{{ buttonText[count]}} </div>
          </div>
        </div>
      </div>

      <div class="content-right">
          <div class="slider-image__wrapper">
            <transition name="slide">
              <img v-for="(item, index) in subTitle"
                class="slider-photo"
                v-if="count === index"
                :src="`/home/left-slider${index}.png`"
                :key="index">
            </transition>
          <div class="product">
            <div class="product__name">DRIFT IS MY THERAPY men t-shirt</div>
            <div class="product__descr">
              <span class="product__color">WHITE</span> <span class="product__price">15$</span>
            </div>
          </div>
          <img src="@/assets/images/arrow_right.svg" class="slider-arrow" />
        </div>
      </div>
    </div>
    <div class="footer__wrapper">
      <Footer />
    </div>
  </div>
</template>

<script>
  export default {
    components: {
      Header: () => import('@/components/Header.vue'),
      Logo: () => import('@/components/legacy/Logo.vue'),
      MainSlider: () => import('@/components/legacy/MainSlider.vue'),
      MainNews: () => import('@/components/legacy/MainNews.vue'),
      Footer: () => import('@/components/Footer.vue'),
    },

    data() {
      return {
        count: 0,
        bigText: [
          ['Drift', 'Is my', 'Therapy'],
          ['Latest', 'Photos'],
          ['New', 'videos'],
          ['upcoming', 'events']
        ],
        subTitle: [
          'Alexander Dmitrenko, pilot of the Russian Drift Series',
          'Photos from our recent events',
          'Newest videos right from the race track',
          'Upcoming events with Alex D'
        ],
        buttonText: [
          'Learn more',
          'Discover',
          'Discover',
          'Discover'
        ],
        category: [
          'photos',
          'videos',
          'calendar',
          'bio'
        ]
      }
    },

    methods: {
      nextSlide () {
        if (this.count < 3) {
          this.count++;
        } else {
          this.count = 0;
        }
      }
    },

    mounted () {
    }
  }
</script>

<style lang="scss" scoped>
  .only-mobile {
    display: none;
  }

  .main__wrapper {
    position: relative;
    display: flex;

  }

  .content {
    position: relative;
    height: 100%;
    display: flex;
    justify-content: space-between;
    color: #fff;
    text-transform: uppercase;

    &-left {
      flex: 0 0 60%;
      display: flex;
      align-items: flex-end;
      padding-left: 100px;
      font-family: 'DIN Condensed';

      &__wrapper {
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
        margin-bottom: 145px;
      }

      .big-text {
        font-family: 'Ailerons';
        font-size: 116px;
        line-height: 116px;
        width: 300px;
        margin-bottom: 40px;
      }

      .slide-descr {
        font-size: 24px;
        max-width: 260px;
        margin-bottom: 40px;
      }

      .button__wrapper {
        margin-right: 120px;
        width: 100px;
      }

      .next-slide-button {
        font-size: 20px;
      }

      .slide-name {
        font-size: 36px;
        margin-bottom: 50px;
      }
    }

    &-right {
      display: flex;
      align-items: flex-end;
      justify-content: center;
      flex: 0 0 40%;
    }
  }

  .footer__wrapper {
    width: 100%;
    position: absolute;
    bottom: 7%;
  }

  .container {
    position: relative;
    height: 100vh;
  }

  .left-side {
    position: absolute;
    top: 0;
    left: 0;
    width: 60%;
    height: 100%;
    overflow: hidden;
    z-index: 0;
  }

  .right-side {
    position: absolute;
    width: 40%;
    right: 0;
    top: 0;
    height: 100%;
    background: #683FFF;
    z-index: 0;
  }

  .main-slider-container {
    position: relative;

    display: flex;
    flex-flow: row nowrap;
    justify-content: flex-end;

    width: 55.2%;
  }

  .left-side::after {
    content: '';
    display: block;
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;

    background: rgba(51, 51, 51, 0.6);

    z-index: 0;
  }


  .main-background {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
  }

  .fade-enter-active, .fade-more-leave-active {
    transition: opacity 1s;
  }

  .fade-enter, .fade-leave-to {
    opacity: 0;
  }

  .slider {
    display: flex;
  }

  .slider-arrow {
    position: relative;
    cursor: pointer;
    height: 100%;
    width: auto;
    z-index: 3;
  }

  .slider-image__wrapper {
    position: relative;
    overflow: hidden;
    width: inherit;
    height: 200px;

    display: flex;
    flex-flow: row nowrap;
    justify-content: flex-end;
  }

  .slider-photo {
    position: absolute;
    top: 0;
    left: 0;

    max-width: 320px;
    width: 100%;
    min-height: 200px;

    background-size: cover;
  }

  .product {
    font-family: 'DIN Condensed';
    font-size: 36px;
    margin-top: 40px;
    color: #fff;
    text-transform: uppercase;
    margin-bottom: 200px;
    width: 250px;
    &__name {
      width: 100%;
    }

    &__descr {
      display: flex;
      justify-content: space-between;
      width: 100%;
    }

    &__color {
      color: #E0E0E0;
    }
  }

  .slide-enter-active, .slide-leave-active {
    transition: transform .3s;
  }

  .slide-leave-to {
    transform: translateX(-100%);
  }

  .slide-enter {
    transform: translateX(100%);
  }

  //////////// MEDIA QUERRIES ////////////////
  @media (max-width: 1024px) {
    .main-slider-container {
      width: 100%;
      min-height: auto;
    }

    .right-side {
      display: none;
    }

    .content-right {
      position: relative;
      display: none;
      overflow: hidden;
    }
    .content-left {
      // justify-content: center;

    }
    .left-side {
      width: 100%;
    }
  }

  @media (max-width: 768px) {
    .content-left {

      &__wrapper {
        margin-bottom: 250px;
      }
      .button__wrapper {
        margin-right: 19px;
      }
    }
  }

  @media (max-width: 425px) {
    .content-left {
      padding-left: 50px;
      &__wrapper {
        margin-bottom: 100px;
      }
      
      .big-text {
        width: 230px;
      }
      .button__wrapper {
        display: none;
      }
    }
  }
</style>

