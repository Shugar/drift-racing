<template>
  <div class="main-left">
    <div class="slider">
      <div class="slider-foto-wrapper">
        <transition name="fade">
          <!-- <img src="@/assets/images/motorshow-img.png" key="1" v-if="count === 1" class="slider-foto">
          <img src="@/assets/images/t-shirt-white.png" key="2" v-if="count === 2" class="slider-foto">
          <img src="@/assets/images/pink-car.png" key="3" v-if="count === 3" class="slider-foto">
          <img src="@/assets/images/t-shirt-black.png" key="4" v-if="count === 4" class="slider-foto"> -->
        </transition>
      </div>
      <div class="slider-arrow__wrapper" @click="nextSlide">
        <div class="slider-arrow">
        </div>
      </div>
    </div>
    <div class="text-block">
      <div class="text-block__desc-wrapper">
        <transition name="fade-text">

          <div class="text-block__desc" key="1" v-if="count === 1">
            <div class="text-block__item">
              MotorShow
            </div>
            <div class="text-block__item">
              Bologna. Italy
            </div>
            <div class="text-block__item">
              2-10 December 2017
            </div>
          </div>

          <div class="text-block__desc" key="2" v-if="count === 2">
            <div class="text-block__item">
              DRIFT IS MY THERApY
            </div>
            <div class="text-block__item">
              men t-shirt
            </div>
            <div class="text-block__item">
              white
            </div>
          </div>

          <div class="text-block__desc" key="3" v-if="count === 3">
            <div class="text-block__item">
              Sochi, closing
            </div>
            <div class="text-block__item">
              of the season
            </div>
            <div class="text-block__item">
              2017 RDS
            </div>
          </div>

          <div class="text-block__desc" key="4" v-if="count === 4">
            <div class="text-block__item">
              FUCKING HERO STYLE
            </div>
            <div class="text-block__item">
              men t-shirt
            </div>
            <div class="text-block__item">
              BLACK
            </div>
          </div>

        </transition>
      </div>
      <div class="text-block__date-wrapper">
        <transition name="fade-text">
          <div class="text-block__date" key="1" v-if="count === 1">
            DEC 9 — 2017
          </div>
          <div class="text-block__date" key="3" v-if="count === 3">
            OCT 12 — 2017
          </div>
        </transition>
        <div class="text-block__price-wrapper">
          <transition name="fade-text">
            <div class="text-block__price" key="2" v-if="count === 2">
              $ 15
            </div>
            <div class="text-block__price" key="4" v-if="count === 4">
              $ 15
            </div>
          </transition>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    data() {
      return {
        count: 1
      }
    },

    methods: {
      nextSlide() {
        if (this.count < 4) {
          this.count++;
        } else {
          this.count = 1;
        }
      }
    },

    mounted () {
      setInterval(() => {
        this.nextSlide()
      }, 4000)
    }
  }
</script>

<style scoped>
  .main-left {
    flex: 1;
    display: flex;
    flex-flow: column nowrap;
    justify-content: center;
  }

  .slider {
    position: relative;

    display: flex;
    flex-flow: row nowrap;
    justify-content: flex-end;

    max-width: 380px;
    width: 100%;

    margin-top: 24px;
  }

  .slider-foto-wrapper {
    position: relative;
    width: 100%;
    overflow: hidden;
  }

  .slider-foto {
    position: absolute;
    top: 0;
    left: 0;

    max-width: 320px;
    width: 100%;
    min-height: 200px;

    background-size: cover;
  }

  .slider-arrow__wrapper {
    display: flex;
    justify-content: center;
    align-items: center;

    max-width: 60px;
    width: 100%;
    min-height: 200px;

    background: #ffffff;

    cursor: pointer;
  }

  .slider-arrow {
    width: 10px;
    height: 17px;

    background: url('../../../assets/images/right-arrow.svg') no-repeat center;
  }

  .text-block {
    display: flex;
    flex-flow: row nowrap;
    justify-content: space-between;

    max-width: 380px;
    width: 100%;

    margin-top: 40px;
  }

  .text-block__desc-wrapper {
    position: relative;
    overflow: hidden;

    max-width: 260px;
    width: 100%;
    min-height: 146px;
  }

  .text-block__desc {
    position: absolute;
    top: 0;
    left: 0;

    font-size: 36px;
    line-height: 27px;
    text-transform: uppercase;
    color: #ffffff;
  }

  .text-block__item {
    margin-bottom: 30px;
    white-space: nowrap;
  }

  .text-block__item:last-child {
    margin-bottom: 0;
    color: #E0E0E0;
  }

  .text-block__date-wrapper {
    position: relative;
    display: flex;

    max-width: 120px;
    width: 100%;

    overflow: hidden;
  }

  .text-block__price-wrapper {
    position: relative;
    overflow: hidden;

    margin-top: auto;
    margin-left: auto;
    width: 53px;
    height: 40px;
  }

  .text-block__date {
    position: absolute;
    text-align: right;
    width: 100%;
    left: 0;
    top: 0;

    font-size: 24px;
    color: #E0E0E0;
  }

  .text-block__price {
    position: absolute;
    right: 0;
    bottom: 0;
    margin-top: auto;

    font-size: 36px;
    color: #ffffff;
  }

  .fade-enter-active, .fade-leave-active {
    transition: transform .3s;
  }

  .fade-leave-to {
    transform: translateX(-100%);
  }

  .fade-enter {
    transform: translateX(100%);
  }

  .fade-text-enter-active, .fade-text-leave-active {
    transition: all .3s;
  }

  .fade-text-leave-to {
    transform: translateX(-100%);
    opacity: 0;
  }

  .fade-text-enter {
    transform: translateX(100%);
    opacity: 0;
  }
</style>
