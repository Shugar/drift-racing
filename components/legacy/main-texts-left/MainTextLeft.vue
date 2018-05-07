<template>
  <div class="main-text">
      <div class="main-text__big">
        <div class="main-text__big-item">
          <transition name="fade">
            <img src="@/assets/images/drift.svg" key="1" v-if="count === 1" class="main-text__big-item-img main-text__big-item-drift">
            <div key="2" v-if="count === 2" />
            <div key="3" v-if="count === 3" />
            <div key="4" v-if="count === 4" />
          </transition>
        </div>
        <div class="main-text__big-item">
          <transition name="fade">
            <img src="@/assets/images/is-my.svg" key="1" v-if="count === 1" class="main-text__big-item-img main-text__big-item-my">
            <img src="@/assets/images/latest.svg" key="2" v-if="count === 2" class="main-text__big-item-img main-text__big-item-latest">
            <img src="@/assets/images/new.svg" key="3" v-if="count === 3" class="main-text__big-item-img main-text__big-item-new">
            <img src="@/assets/images/upcoming.svg" key="4" v-if="count === 4" class="main-text__big-item-img main-text__big-item-upcoming">
          </transition>
        </div>
        <div class="main-text__big-item">
          <transition name="fade">
            <img src="@/assets/images/therapy.svg" key="1" v-if="count === 1" class="main-text__big-item-img main-text__big-item-therapy">
            <img src="@/assets/images/photos.svg" key="2" v-if="count === 2" class="main-text__big-item-img main-text__big-item-photos">
            <img src="@/assets/images/videos.svg" key="3" v-if="count === 3" class="main-text__big-item-img main-text__big-item-videos">
            <img src="@/assets/images/events.svg" key="4" v-if="count === 4" class="main-text__big-item-img main-text__big-item-events">
          </transition>
        </div>
      </div>
    <div class="desc-wrapper">
      <div class="toggle">
        <div class="toggle__min-text">
          <div ref="next" @click="$root.$emit('nextSlide')" class="toggle__min-text-text">
            next up
          </div>
          <div class="toggle__min-text-background"></div>
        </div>
        <div class="toggle__big-text-wrapper">
          <transition name="fade-more">
            <div key="1" v-if="count === 1" class="toggle__big-text">
              Photos
            </div>
            <div key="2" v-if="count === 2" class="toggle__big-text">
              VIDEOS
            </div>
            <div key="3" v-if="count === 3" class="toggle__big-text">
              calendar
            </div>
            <div key="4" v-if="count === 4" class="toggle__big-text">
              bio
            </div>
          </transition>
        </div>
      </div>
      <div class="main-text__desc-wrapper">
        <transition name="left">
          <div class="main-text__desc" key="1" v-if="count === 1">
            <div class="main-text__desc-item">
              Alexander Dmitrenko, pilot
            </div>
            <div class="main-text__desc-item">
              of the Russian Drift Series
            </div>
          </div>
          <div class="main-text__desc" key="2" v-if="count === 2">
            <div class="main-text__desc-item">
              Photos from our
            </div>
            <div class="main-text__desc-item">
              recent events
            </div>
          </div>
          <div class="main-text__desc" key="3" v-if="count === 3">
            <div class="main-text__desc-item">
              Newest videos right
            </div>
            <div class="main-text__desc-item">
              from the race track
            </div>
          </div>
          <div class="main-text__desc" key="4" v-if="count === 4">
            <div class="main-text__desc-item">
              Upcoming events
            </div>
            <div class="main-text__desc-item">
              with Alex D
            </div>
          </div>
        </transition>
      </div>
    </div>
    <div class="more-wrapper">
      Learn more
      <transition name="fade-more">
        <a href="#" key="1" v-if="count === 1" class="main-text__more">
          Learn more
        </a>
        <a href="#" key="2" v-if="count === 2" class="main-text__more">
          Discover
        </a>
        <a href="#" key="3" v-if="count === 3" class="main-text__more">
          Discover
        </a>
        <a href="#" key="4" v-if="count === 4" class="main-text__more">
          Discover
        </a>
      </transition>
    </div>
  </div>
</template>

<script>
  export default {
    props: ['count'],

    mounted () {
      setInterval(() => {
        this.$root.$emit('nextSlide')
      }, 4000)
    }
  }
</script>

<style lang="scss" scoped>
  .main-text {
    width: 100%;
  }

  .main-text__big {
    margin-left: 37.3%;
    margin-bottom: 40px;
  }

  .desc-wrapper {
    position: relative;
    display: flex;
    flex-flow: row nowrap;
  }

  .toggle {
    position: absolute;
    top: 0;
    left: 0;

    max-width: 130px;
    width: 100%;
  }

  .toggle__big-text-wrapper {
    position: relative;
    display: inline-block;

    overflow: hidden;
    min-height: 35px;
    max-width: 130px;
    width: 100%;
  }

  .toggle__big-text {
    position: absolute;
    top: 0;
    left: 0;

    font-size: 36px;
    color: #fff;
    text-transform: uppercase;
  }

  .toggle__min-text {
    position: relative;
    display: inline-block;

    font-size: 20px;
    line-height: 20px;

    color: #fff;
    text-transform: uppercase;
  }

  .toggle__min-text-text {
    position: relative;
    z-index: 2;

    cursor: pointer;
  }


  .toggle__min-text-background {
    display: block;
    position: absolute;
    left: 0;
    top: 0;
    height: 100%;
    width: 0%;
    background: #683FFF;
    animation: background 4s ;

    .background-active {
      width: 100%;
    }
  }

  .main-text__desc-item:first-child {
    margin-bottom: 6px;
  }

  .main-text__big {
    display: flex;
    flex-flow: column nowrap;
    justify-content: flex-end;

    min-height: 330px;
  }

  .main-text__desc-wrapper {
    position: relative;

    max-width: 255px;
    width: 100%;
    min-height: 56px;
    margin-left: 37.3%;
    margin-bottom: 38px;
    font-size: 24px;
    color: #fff;
    text-transform: uppercase;

    overflow: hidden;
  }

  .main-text__desc {
    position: absolute;
    top: 0;
    left: 0;
  }

  .main-text__big-item {
    position: relative;

    display: block;
    min-height: 80px;
    margin-bottom: 40px;
    overflow: hidden;
  }

  .main-text__big-item-img {
    position: absolute;
    top: 0;
    left: 0;
  }

  .main-text__big-item:last-child {
    margin-bottom: 0;
  }

  .main-text__big-item-drift {
    max-width: 200px;
    width: 100%;
  }

  .main-text__big-item-my {
    max-width: 190px;
    width: 100%;
  }

  .main-text__big-item-therapy {
    max-width: 294px;
    width: 100%;
  }

  .main-text__big-item-latest {
    max-width: 233px;
    width: 100%;
  }

  .main-text__big-item-photos {
    max-width: 240px;
    width: 100%;
  }

  .main-text__big-item-new {
    max-width: 128px;
    width: 100%;
  }

  .main-text__big-item-videos {
    max-width: 240px;
    width: 100%;
  }

  .main-text__big-item-upcoming {
    max-width: 328px;
    width: 100%;
  }

  .main-text__big-item-events {
    max-width: 238px;
    width: 100%;
  }

  .more-wrapper {
    position: relative;

    display: inline-block;
    padding: 0 2px;
    margin-left: 37.3%;

    font-size: 20px;
    line-height: 20px;
    text-transform: uppercase;
    color: transparent;

    overflow: hidden;
  }

  .more-wrapper a {
    display: inline-block;
    padding: 0 2px;

    background: #683FFF;
  }

  .main-text__more {
    position: absolute;
    top: 0;
    left: 0;
    color: #ffffff;
  }

  .fade-enter-active, .fade-leave-active {
    transition: transform .3s;
  }

  .fade-leave-to {
    transform: translateY(-90px);
  }

  .fade-enter {
    transform: translateY(90px);
  }

  .left-enter-active, .left-leave-active {
    transition: transform .3s;
  }

  .left-leave-to {
    transform: translateX(-255px);
  }

  .left-enter {
    transform: translateX(255px);
  }

  .fade-more-enter-active, .fade-more-leave-active {
    transition: transform .3s;
  }

  .fade-more-leave-to {
    transform: translateY(-110%);
  }

  .fade-more-enter {
    transform: translateY(110%);
  }

  @media (max-width: 1024px) {
    .main-text__big {
      margin-left: 28.3%;
      margin-bottom: 30px;
    }

    .main-text__desc-wrapper {
      margin-left: 28.3%;
    }

    .more-wrapper {
      margin-left: 28.3%;
    }

    .main-text__big-item {
      margin-bottom: 30px;
      min-height: 70px;
    }

    .main-text__big-item-drift {
      max-width: 174px;
    }

    .main-text__big-item-my {
      max-width: 165px;
    }

    .main-text__big-item-therapy {
      max-width: 255px;
    }

    .main-text__big-item-latest {
      max-width: 202px;
    }

    .main-text__big-item-photos {
      max-width: 208px;
    }

    .main-text__big-item-new {
      max-width: 111px;
    }

    .main-text__big-item-videos {
      max-width: 208px;
    }

    .main-text__big-item-upcoming {
      max-width: 285px;
    }

    .main-text__big-item-events {
      max-width: 206px;
    }
  }

  @media (max-width: 420px) {
    .main-text__big {
      margin-left: 0;
      min-height: initial;
    }

    .toggle {
      display: none;
    }

    .main-text__desc-wrapper {
      margin-left: 0;
    }

    .main-text__big-item {
      min-height: 60px;
    }

    .more-wrapper {
      margin-left: 0;
    }

    .main-text__big-item-drift {
      max-width: 149px;
    }

    .main-text__big-item-my {
      max-width: 141px;
    }

    .main-text__big-item-therapy {
      max-width: 218px;
    }

    .main-text__big-item-latest {
      max-width: 173px;
    }

    .main-text__big-item-photos {
      max-width: 178px;
    }

    .main-text__big-item-new {
      max-width: 95px;
    }

    .main-text__big-item-videos {
      max-width: 178px;
    }

    .main-text__big-item-upcoming {
      max-width: 244px;
    }

    .main-text__big-item-events {
      max-width: 176px;
    }
  }
</style>
