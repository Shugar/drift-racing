<template>
  <div class="header" :class="{ main: type === 'main' }">
    <div v-if="isMenuOpened"  class="mobile-nav">
      <div class="mobile-space" @click="closeMenu()"></div>
      <div class="mobile-menu">
        <div class="mobile-menu-content-wrapper">
          <div class="mobile-menu__title">MENU</div>
          <div class="list">
            <nuxt-link to="/bio/" class="list-item">BIO</nuxt-link>
            <nuxt-link to="/photo/" class="list-item">PHOTO</nuxt-link>
            <nuxt-link to="/calendar/" class="list-item">CALENDAR</nuxt-link>
            <nuxt-link to="/video/" class="list-item">VIDEO</nuxt-link>
            <nuxt-link to="/news/" class="list-item">NEWS</nuxt-link>
            <nuxt-link to="/store/" class="list-item">STORE</nuxt-link>
            <nuxt-link to="/partners/" class="list-item">PARTNERS</nuxt-link>
            <nuxt-link to="/contact/" class="list-item">CONTACT</nuxt-link>
          </div>
          <div class="language">
            RU — EN
          </div>
          <div class="made"><span>MADE BY</span> APUS AGENCY</div>
        </div>
      </div>
    </div>

    <div class="left" :class="{ mainLeft: type === 'main' }">
      <nuxt-link to="/" class="logo-link">
        <div class="logo" :class="{'isHeaderAnimated': isHeaderAnimated}">
          <i></i><i></i>
        </div>
      </nuxt-link>
      <div class="back-to news" v-if="this.$route.path === `/news/${this.$route.params.id}`">
        <nuxt-link to='/news/'>BACK TO NEWS</nuxt-link>
      </div>
      <div class="back-to" v-if="this.$route.path === `/calendar/${this.$route.params.id}`">
        <nuxt-link to='/calendar/'>BACK TO CALENDAR</nuxt-link>
      </div>
      <div class="back-to" v-if="this.$route.path === `/video/${this.$route.params.id}`">
        <nuxt-link to='/video/'>BACK TO VIDEO</nuxt-link>
      </div>

      <span @click="$store.commit('toggleCheckout')" v-if="this.$route.name === 'store'" class="checkout">{{ productCount }} items — $ {{ productSum }}</span>
      <div class="menu-button" @click="openMenu()" />

      <div class="nav nav-left">
        <nuxt-link class="nav-item" to="/bio/" :class="{'nuxt-link-active': count === 0}">BIO</nuxt-link>
        <nuxt-link class="nav-item" to="/photo/" :class="{'nuxt-link-active': count === 1}">PHOTO</nuxt-link>
        <nuxt-link class="nav-item" to="/video/" :class="{'nuxt-link-active': count === 2}">VIDEO</nuxt-link>
        <nuxt-link class="nav-item" to="/calendar/" :class="{'nuxt-link-active': count === 3}">CALENDAR</nuxt-link>
      </div>
    </div>

    <div class="right" :class="{ mainRight: type === 'main' }">
      <div class="nav nav-right">
        <nuxt-link class="nav-item" to="/news/">NEWS</nuxt-link>
        <nuxt-link class="nav-item" to="/store/">STORE</nuxt-link>
        <nuxt-link class="nav-item" to="/partners/">PARTNERS</nuxt-link>
        <div class="nav-item--bigger">
          <nuxt-link class="nav-item" to="/contact/">CONTACT</nuxt-link>
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
      }
    },

    methods: {
      closeMenu () {
        this.isMenuOpened = false
      },

      openMenu () {
        this.isMenuOpened = true
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
    background: linear-gradient(180deg, #683FFF 0%, rgba(104, 63, 255, 0.8) 58.56%, rgba(104, 63, 255, 0) 100%);
    z-index: 10;

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

    &.isHeaderAnimated i:last-child {
      animation: logo 1.5s linear infinite;
    }
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
    bottom: 32.8px;
    height: 37.7px;
    transform: translate3d(-1.44px, 0, 0) skewX(15deg);
    background-position-x: 53px;
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
      transform: translate3d(-53px, 0, 0) skewX(15deg);
      background-position-x: 53px;
    }

    100% {
      transform: translate3d(53px, 0, 0) skewX(15deg);
      background-position-x: -53px;
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
      width: 20%;
      left: 0;
      height: 100%;
      background: rgba(51, 51, 51, 0.6);
      z-index: 9999;
    }

    .mobile-menu {
      position: fixed;
      width: 80%;
      height: 100%;
      z-index: 9999;
      right: 0;
      background: #000;

      &-content-wrapper {
        padding: 56px 76px;
        width: 100%;
        overflow-y: scroll;
      }
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
      color: #FFFFFF;
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
    .header {
      position: absolute;
      padding: 0 30px;
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
