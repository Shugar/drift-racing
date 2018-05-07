<template>
  <div class="header">
    <div v-if="isMenuOpened" class="mobile-nav">
      <div class="mobile-space" @click="closeMenu()"></div>
      <div class="mobile-menu">
        <div class="mobile-menu__title">MENU</div>
        <div class="list">
          <div class="list-item">BIO</div>
          <div class="list-item">PHOTO</div>
          <div class="list-item">CALENDAR</div>
          <div class="list-item">VIDEO</div>
          <div class="list-item">NEWS</div>
          <div class="list-item">STORE</div>
          <div class="list-item">PARTNERS</div>
          <div class="list-item">CONTACT</div>
        </div>
        <div class="language">
          RU — EN
        </div>
        <div class="made">MADE BY APUS</div>
      </div>
    </div>

    <div class="left">
      <nuxt-link to="/">
        <div class="logo" />
      </nuxt-link>

      <div class="menu-button" @click="openMenu()" />

      <div class="nav nav-left">
        <nuxt-link class="nav-item" to="/bio/">BIO</nuxt-link>
        <nuxt-link class="nav-item" to="/photo/">PHOTO</nuxt-link>
        <nuxt-link class="nav-item" to="/video/">VIDEO</nuxt-link>
        <nuxt-link class="nav-item" to="/calendar/">CALENDAR</nuxt-link>
      </div>
    </div>

    <div class="right">
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
    data () {
      return {
        isMenuOpened: false
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
  .header {
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
  }

  .left {
    flex: 0 0 60%;
    display: flex;
    flex-flow: row nowrap;
    justify-content: flex-start;
    align-items: center;
  }

  .right {
    flex: 0 0 40%;
    display: flex;
    flex-flow: column nowrap;
    align-items: flex-end;
  }

  .logo {
    margin-right: 120px;
    width: 100px;
    flex: 0 0 100px;
    height: 140px;
    background: url('~/assets/images/logo.svg') no-repeat center / contain;
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

    .mobile-nav {
      display: block;
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
    }

    .menu-button {
      width: 28px;
      height: 28px;
      cursor: pointer;
      background: url("../assets/images/menu-button.svg") no-repeat center / contain;
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
      padding: 56px 76px;
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

    .menu-button {
      top: 56px;
    }

    .mobile-menu {
      display: flex;
      flex-flow: column nowrap;
      justify-content: center;
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
    }
  }

  @media (max-width: 425px) {
    .header {
      padding: 0 50px;
    }

    .logo {
      margin-top: -20px;
    }

    .nav {
      display: none;
    }
  }
</style>
