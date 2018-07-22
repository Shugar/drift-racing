<template>
  <div class="header" :class="{ main: type === 'main' }">
    <div :class="{'mobile-nav--opened': isMenuOpened}"  class="mobile-nav">
      <div :class="{'mobile-space--opened': isMenuOpened}" class="mobile-space" @click="closeMenu()"></div>
      <div :class="{'mobile-menu--opened': isMenuOpened}" class="mobile-menu">
        <div class="mobile-menu-content-wrapper">
          <div class="mobile-menu__title">MENU</div>
          <div class="list">
            <nuxt-link to="/bio/" class="list-item">{{ locale === 'en' ? 'BIO' : 'БИОГРАФИЯ' }}</nuxt-link>
            <nuxt-link to="/team/" class="list-item">{{locale === 'en' ? 'TEAM' : "КОМАНДА"}}</nuxt-link>
            <nuxt-link to="/photo/" class="list-item">{{ locale === 'en' ? 'PHOTO' : 'ФОТО'}}</nuxt-link>
            <nuxt-link to="/video/" class="list-item">{{locale === 'en' ? 'VIDEO' : 'ВИДЕО'}}</nuxt-link>
            <nuxt-link to="/sponsors/" class="list-item">{{ locale === 'en' ? 'SPONSORS' : 'СПОНСОРЫ'}}</nuxt-link>
            <nuxt-link to="/news/" class="list-item">{{ locale === 'en' ? 'NEWS' : 'НОВОСТИ' }}</nuxt-link>
            <nuxt-link to="/store/" class="list-item">{{ locale === 'en' ? 'STORE' : 'МАГАЗИН' }}</nuxt-link>
            <nuxt-link to="/contact/" class="list-item">{{ locale === 'en' ? 'CONTACT' : 'КОНТАКТЫ'}}</nuxt-link>
          </div>
          <div class="language">
            <span :class="{'lang-active': locale === 'ru'}" @click="setRU()">RU</span> — <span :class="{'lang-active': locale === 'en'}" @click="setEN()">EN</span>
          </div>
          <div class="made">
            <a class="made" target="_blank" href="https://apus.agency/">
              MADE BY APUS <span>AGENCY</span>
            </a>
          </div>
        </div>
      </div>
    </div>

    <div class="left" :class="{ mainLeft: type === 'main' }">
      <nuxt-link to="/" class="logo-link">
        <div class="logo">
          <img src="../assets/images/logo.svg"/>
          <img v-if="isHeaderAnimated" class="logo-loader" src="../assets/images/drift-logo-animated.gif" />
          <!-- <video ref="video-1" class="logo-loader" v-if="isHeaderAnimated" autoplay loop muted >
            <source src="~/assets/video/logo-3.mp4" type="video/mp4">
          </video>
          <video ref="video-2" class="logo-loader pointer-events-none" v-else autoplay muted >
            <source src="~/assets/video/logo-3.mp4" type="video/mp4">
          </video> -->
        </div>
      </nuxt-link>
      <div class="back-to news" v-if="this.$route.path === `/news/${this.$route.params.id}`">
        <nuxt-link to='/news/'>{{locale === 'en' ? 'BACK TO NEWS' : 'НАЗАД К НОВОСТЯМ'}}</nuxt-link>
      </div>
      <div class="back-to calendar" v-if="this.$route.path === `/calendar/${this.$route.params.id}`">
        <nuxt-link to='/calendar/'>{{locale === 'en' ? 'BACK TO NEWS' : 'НАЗАД К НОВОСТЯМ' }}</nuxt-link>
      </div>
      <div class="back-to" v-if="this.$route.path === `/video/${this.$route.params.id}`">
        <nuxt-link to='/video/'>BACK TO VIDEO</nuxt-link>
      </div>

      <div class="menu-button" @click="openMenu()" />

      <div class="nav nav-left">
        <nuxt-link class="nav-item" to="/bio/" :class="{'nuxt-link-active': count === 0}">{{ locale === 'en' ? 'BIO' : 'БИОГРАФИЯ' }}</nuxt-link>
        <nuxt-link class="nav-item" to="/team/" :class="{'nuxt-link-active': count === 4}">{{locale === 'en' ? 'TEAM' : "КОМАНДА"}}</nuxt-link>
        <nuxt-link class="nav-item" to="/photo/" :class="{'nuxt-link-active': count === 1}">{{ locale === 'en' ? 'PHOTO' : 'ФОТО'}}</nuxt-link>
        <nuxt-link class="nav-item" to="/video/" :class="{'nuxt-link-active': count === 2}"> {{locale === 'en' ? 'VIDEO' : 'ВИДЕО'}} </nuxt-link>
        <nuxt-link class="nav-item" to="/sponsors/">{{ locale === 'en' ? 'SPONSORS' : 'СПОНСОРЫ'}}</nuxt-link>
      </div>
    </div>

    <div class="right" :class="{ mainRight: type === 'main' }">
      <div class="nav nav-right">
        <nuxt-link class="nav-item" to="/news/">{{ locale === 'en' ? 'NEWS' : 'НОВОСТИ' }}</nuxt-link>
        <nuxt-link class="nav-item" to="/store/">{{ locale === 'en' ? 'STORE' : 'МАГАЗИН' }}</nuxt-link>
        <div class="nav-item--bigger">
          <nuxt-link class="nav-item" to="/contact/">{{ locale === 'en' ? 'CONTACT' : 'КОНТАКТЫ'}}</nuxt-link>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    props: ['type', 'count', 'productSum', 'productCount'],

    data () {
      return {
        isMenuOpened: false
      }
    },

    computed: {
      isHeaderAnimated () {
        return this.$store.state.isHeaderAnimated
      },

      locale () {
        return this.$store.state.locale
      }
    },

    watch: {
      'isHeaderAnimated': function (prev, current) {
        setTimeout(() => {
          if (this.$refs['video-1']) {
            this.$refs['video-1'].currentTime = 0
          }

          if (this.$refs['video-2']) {
            this.$refs['video-2'].currentTime = 0
          }
        }, 1040)
      }
    },

    mounted () {
      if (this.$refs['video-2']) {
        this.$refs['video-2'].pause()
      }
    },

    methods: {
      closeMenu () {
        this.isMenuOpened = false
      },

      openMenu () {
        this.isMenuOpened = true
      },

      setRU () {
        this.$store.commit('setLocale', 'ru')
        this.$router.push('/')
      },

      setEN () {
        this.$store.commit('setLocale', 'en')
        this.$router.push('/')
      }
    }
  }
</script>

<style lang="scss" scoped>
  a {
    text-decoration: none;
  }

  .header {
    overflow: hidden;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    padding: 0px 100px;
    display: flex;
    flex-flow: row nowrap;
    justify-content: space-between;
    align-items: center;
    z-index: 9999;
    background: linear-gradient(180deg, #333333 0%, rgba(51, 51, 51, 0.8) 58.56%, rgba(51, 51, 51, 0) 100%);

    &.main {
      background: transparent;
    }
  }

  .back-to {
    display: none;
  }

  .left {
    flex: 0 0 60%;
    display: flex;
    flex-flow: row nowrap;
    justify-content: flex-start;
    align-items: center;
  }

  .mainLeft {
    flex: 0 0 55%;
  }

  .right {
    flex: 0 0 40%;
    display: flex;
    flex-flow: column nowrap;
    align-items: flex-end;
  }

  .mainRight {
    flex: 0 0 45%;
    padding-left: 60px;
  }

  .logo-link {
    margin-right: 120px;
  }

  .logo {
    width: 100px;
    flex: 0 0 100px;
    height: 140px;
    position: relative;
    overflow: hidden;
    background: #000;

    // &.isHeaderAnimated i:last-child {
    //   animation: logo 1.5s linear infinite;
    // }
  }

  .pointer-events-none {
    pointer-events: none;
  }

  .logo-loader {
    position: absolute;
    left: 23px;
    bottom: 23px;
    width: 54px;
    height: auto;
    // transform: translate3d(0, 0, 0) skewX(15deg);
  }

  .logo i {
    position: absolute;
    left: 24px;
    bottom: 33px;
    width: 53px;
    height: 34px;
    background: url('~/assets/images/logo-icon.svg') no-repeat center / contain;
    transform: translate3d(0, 0, 0) skewX(15deg);
    overflow: hidden;
  }

  .logo i:last-child {
    opacity: 0;
    bottom: 32.8px;
    left: 22px;
    height: 38px;
    width: 55px;
    transform: translate3d(0, 0, 0) skewX(15deg);
    background: url('~/assets/images/logo-icon.svg') no-repeat center / contain;
    background-position-x: 54px;
    will-change: transform, background-position-x;
  }

  .logo i:last-child:after {
    content: '';
    position: absolute;
    left: 0;
    right: 0;
    bottom: -2px;
    height: 3.8px;
    background: #000
  }

  @keyframes logo {
    0% {
      opacity: 1;
      transform: translate3d(-90px, 0, 0) skewX(15deg);
      background-position-x: 90px;
    }

    100% {
      opacity: 1;
      transform: translate3d(90px, 0, 0) skewX(15deg);
      background-position-x: -90px;
    }
  }

  .checkout {
    display: none;
  }

  .nav {
    margin-top: 42px;
    width: 100%;
    display: flex;
    flex-flow: row nowrap;
    align-items: center;
  }

  .nav-right {
    justify-content: flex-end;
    padding-left: 50px;
  }

  .main .nav-right {
    padding-left: 52px;
  }

  .nav-item {
    font-family: 'DIN Condensed', sans-serif;
    line-height: normal;
    font-size: 20px;
    text-transform: uppercase;
    color: #E0E0E0;
    text-decoration: none;
    margin-right: 40px;

    transition: color .2s ease;
    will-change: color;

    position: relative;
    overflow: hidden;

    &:before {
      content: '';
      position: absolute;
      left: 0;
      bottom: 0;
      height: 3px;
      width: 100%;
      background: #FFF;
      transform: translateX(-110%);
      transition: transform .2s ease;
      will-change: transform;
    }

    &:hover {
      color: #FFF;

      &:before {
        transform: translateX(0);
      }
    }

    &:last-child {
      margin-right: 0;
    }
  }

  .nuxt-link-active {
    color: #FFF;
  }

  .nav-item--bigger {
    flex: 1;
    display: flex;
    flex-flow: column nowrap;
    align-items: flex-end;
  }

  .mobile-nav {
    display: none;
  }

  @media (max-width: 1024px) {
    .nav,
    .right {
      display: none;
    }

    .left {
      flex: 1;
      justify-content: space-between;
    }

    .back-to {
      display: block;
      width: 100%;
      margin-top: 47px;
      font-family: 'DIN Condensed', sans-serif;
      font-style: normal;
      font-weight: bold;
      line-height: 35px;
      font-size: 24px;
      text-transform: uppercase;
      color: rgba(255, 255, 255, 0.8);
    }

    .news {
      display: none;
    }

    .logo-link {
      margin-right: 40px;
    }

    .mobile-nav {
      display: block;
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      z-index: 10;
      opacity: 0;
      pointer-events: none;
    }

    .mobile-nav--opened {
      opacity: 1;
      pointer-events: initial;
    }

    .menu-button {
      width: 28px;
      height: 28px;
      cursor: pointer;
      background: url("../assets/images/menu-button.svg") no-repeat center / contain;
      margin-top: 35px;
    }

    .checkout {
      margin-top: 50px;
      display: flex;
      flex-flow: column nowrap;
      align-items: flex-start;

      flex: 1;
      font-family: 'DIN Condensed', sans-serif;
      font-style: normal;
      font-weight: bold;
      line-height: normal;
      font-size: 20px;
      text-align: right;
      text-transform: uppercase;
      color: #FFFFFF;
    }

    .mobile-space {
      position: fixed;
      width: 100%;
      left: 0;
      height: 100%;
      background: rgba(51, 51, 51, 0.6);
      z-index: 9999;
      opacity: 0;
      transition: opacity .3s ease-in-out;
    }

    .mobile-space--opened {
      opacity: 1;
    }

    .mobile-menu {
      position: fixed;
      width: 80%;
      height: 100%;
      z-index: 9999;
      right: 0;
      background: linear-gradient(216.25deg, #565656 0%, #000000 100%), #683FFF;
      transform: translateX(100%);
      transition: transform .3s ease-in-out;

      &-content-wrapper {
        padding: 56px 76px;
        width: 100%;
        overflow-y: scroll;
      }
    }

    .mobile-menu--opened {
      transform: translateX(0);
    }

    .mobile-menu__title,
    .made {
      font-family: 'DIN Condensed', sans-serif;
      font-style: normal;
      font-weight: bold;
      line-height: 19px;
      font-size: 24px;
      text-transform: uppercase;
      color: #683FFF;
      margin-bottom: 20px;
    }

    .made {
      margin-top: 20px;
      margin-bottom: 0;
      white-space: nowrap;
    }

    .language {
      font-family: 'DIN Condensed', sans-serif;
      margin-top: 62px;
      font-style: normal;
      font-weight: bold;
      line-height: 24px;
      font-size: 24px;
      text-transform: uppercase;
      color: #E0E0E0;
    }

    .lang-active {
      color: #FFF !important;
    }

    .mobile-menu {
      display: flex;
      flex-flow: column nowrap;
      justify-content: center;
      // overflow-y: scroll;
      // min-height: 666px;
    }

    .list-item {
      font-family: 'DIN Condensed', sans-serif;
      font-style: normal;
      font-weight: bold;
      text-transform: uppercase;
      color: #FFFFFF;
      line-height: 22px;
      font-size: 30px;
      margin-bottom: 24px;
      text-decoration: none;
      display: block;
    }
  }

  @media (max-width: 768px) {
    .back-to {
      display: block;
    }
  }

  @media (max-width: 425px) {
    .back-to {
      display: none;
    }

    .header {
      position: absolute;
      padding: 0 30px;
      overflow: initial;
    }

    .checkout {
      display: none;
    }

    .logo-link {
      margin-right: 32px;
    }

    .logo {
      margin-top: -20px;
      width: 100px;
    }

    .back-to {
      margin-top: 16px;
    }

    .calendar {
      display: none;
    }

    .nav {
      display: none;
    }

    .menu-button {
      margin-top: 8px;
    }

    .made span {
      display: none;
    }
  }


</style>
