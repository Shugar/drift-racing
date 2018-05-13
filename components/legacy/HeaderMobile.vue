<template>
  <div class="left__header">
    <ul class="main-nav__left">
      <logo />
      <div class="menu-button" @click="openMenu()" />
    </ul>

    <div v-if="isMenuOpened" class="mobile-space" @click="closeMenu()"></div>
    <div v-if="isMenuOpened" class="mobile-menu">
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
</template>

<script>
  export default {
    data () {
      return {
        isMenuOpened: false
      }
    },

    components: {
      logo: () => import('@/components/legacy/Logo.vue')
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

<style scoped>
  .main-nav__left {
    position: relative;

    display: none;
    flex-flow: row nowrap;
    padding: 0 37.3%;
    width: 100%;

    z-index: 1;
  }

  .main-nav__left-wrapper {
    display: flex;
    flex-flow: row nowrap;
    justify-content: space-between;
    max-width: 262px;
    width: 100%;
    padding-top: 83px;
  }

  .menu-button {
    position: absolute;
    right: 0;
    top: 76px;
    width: 28px;
    height: 28px;
    cursor: pointer;
    background: url("../../assets/images/menu-button.svg") no-repeat center / contain;
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
    overflow-y: scroll;
    min-height: 666px;
  }

  .mobile-menu__title,
  .made {
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

  .list {
  }

  .list-item {
    margin-bottom: 30px;
    font-style: normal;
    font-weight: bold;
    line-height: 27px;
    font-size: 36px;
    text-transform: uppercase;
    color: #FFFFFF;
  }

  .language {
    margin-top: 62px;
    font-style: normal;
    font-weight: bold;
    line-height: 24px;
    font-size: 24px;
    text-transform: uppercase;
    color: #FFFFFF;
  }

  @media (max-width: 1024px) {
    .main-nav__left {
      display: flex;
    }
  }

  @media (max-width: 420px) {
    .menu-button {
      top: 56px;
    }

    .mobile-menu {
      display: flex;
      flex-flow: column nowrap;
      justify-content: center;
    }

    .list-item {
      line-height: 22px;
      font-size: 30px;
      margin-bottom: 24px;
    }
  }
</style>
