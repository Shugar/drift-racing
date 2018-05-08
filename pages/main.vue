<template>
  <div class="container">
    <Header type='main' />
    <div class="left-side">
      <transition name="fade">
        <div class="main-background main-slider-container-img-1" v-if="count===1" key="1" />
        <div class="main-background main-slider-container-img-2"  v-if="count===2" key="2" />
        <div class="main-background main-slider-container-img-3"  v-if="count===3" key="3" />
        <div class="main-background main-slider-container-img-4"  v-if="count===4" key="4" />
      </transition>
    </div>
    <div class="right-side"></div>

    <div class="content">
      <div class="content__left"></div>
      <div class="content__right">
        <div>
          <div class="slider">
            <img src="@/assets/images/motorshow-img.png" key="1" v-if="count === 1" class="slider-photo">
            <img src="@/assets/images/arrow_right.svg" class="slider-arrow" />
          </div>
          <div class="product">
            <div class="product__name">DRIFT IS MY THERAPY men t-shirt</div>
            <div class="product__descr">
              <span class="product__color">WHITE</span> <span class="product__price">15$</span>
            </div>
          </div>
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
        count: 1
      }
    },

    mounted () {
      this.$root.$on('nextSlide', () => {
        if (this.count < 4) {
          this.count++;
        } else {
          this.count = 1;
        }
      })
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

    &_left {
      width: 60%;
    }

    &__right {
      display: flex;
      align-items: flex-end;
      justify-content: center;
      width: 40%;
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
    padding-left: 100px;
    z-index: 0;
  }

  .right-side {
    position: absolute;
    width: 40%;
    right: 0;
    top: 0;
    height: 100%;
    background: #683FFF;
    padding-right: 100px;
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
  .main-slider-container-img {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
  }

  .main-slider-container-img-1 {
    width: 100%;
    background: url('../assets/images/car2.png') no-repeat;
    background-size: cover;
    background-position: 7% 0;
  }

  .main-slider-container-img-2 {
    width: 100%;
    background: url('../assets/images/car1.png') no-repeat;
    background-size: cover;
    background-position: 7% 0;
  }

  .main-slider-container-img-3 {
    width: 100%;
    background: url('../assets/images/car3.png') no-repeat;
    background-size: cover;
    background-position: 7% 0;
  }

  .main-slider-container-img-4 {
    width: 100%;
    background: url('../assets/images/car4.png') no-repeat;
    background-size: cover;
    background-position: 7% 0;
  }

  .fade-enter-active, .fade-more-leave-active {
    transition: opacity .3s;
  }

  .fade-enter, .fade-leave-to {
    opacity: 0;
  }


  .slider {
    display: flex;

      &-arrow {
      cursor: pointer;
      height: 100%;
      width: auto;
    }
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

  //////////// 
  @media (max-width: 1024px) {
    .right-side {
      display: none;
    }

    .content__right {
      display: none;
    }

    .left-side {
      width: 100%;
    }
  }

  @media (max-width: 1024px) {
    .main-slider-container {
      width: 100%;
      min-height: auto;
    }
  }
</style>

