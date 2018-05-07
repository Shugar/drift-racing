<template>
  <div class="header">
    <div class="left">
      <nuxt-link to="/">
        <div class="logo" />
      </nuxt-link>
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
