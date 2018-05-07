<template>
  <div class="main_wrapper">
    <Header type='main' />
    <logo class="only-mobile"/>
    <div class="left-side">
      <transition name="fade">
        <div class="left-side main-slider-container-img-1" v-if="count===1" key="1" />
        <div class="left-side main-slider-container-img-2"  v-if="count===2" key="2" />
        <div class="left-side main-slider-container-img-3"  v-if="count===3" key="3" />
        <div class="left-side main-slider-container-img-4"  v-if="count===4" key="4" />
      </transition>
    </div>
    <div class="right-side"></div>
    <!-- <div class="main-slider-container">
      <MainSlider :count="count" />
  
    </div>
    <MainNews />  -->
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
  }

  .footer__wrapper {
    width: 100%;
    position: absolute;
    bottom: 7%;
  }

  .main_wrapper {
    position: relative;
    display: flex;
    flex-flow: row nowrap;
    height: 100vh;
    /* padding-top: 140px; */
  }

  .left-side {
    position: relative;
    width: 58%;
    height: 100%;
    overflow: hidden;
  }

  .right-side {
    width: 42%;
    height: 100%;
    background: #683FFF;

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

  @media (max-width: 1024px) {
    .main-slider-container {
      width: 100%;
      min-height: auto;
    }
  }
</style>
