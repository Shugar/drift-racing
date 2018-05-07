<template>
  <div class="left__header">
      <ul class="main-nav__left">
      <logo />
      <div class="main-nav__left-wrapper">
        <router-link to='/bio' class="nav__item">
          <span class="nav__link" :style="{color: this.count === 1 ? '#FFF' : '#E0E0E0'}">Bio</span>
        </router-link>
        <router-link to='/' class="nav__item">
          <span class="nav__link" :style="{color: this.count === 2 ? '#FFF' : '#E0E0E0'}">PHOTO</span>
        </router-link>
        <router-link to='/' class="nav__item">
          <span class="nav__link" :style="{color: this.count === 3 ? '#FFF' : '#E0E0E0'}">Video</span>
        </router-link>
        <router-link to='/' class="nav__item">
          <span class="nav__link" :style="{color: this.count === 4 ? '#FFF' : '#E0E0E0'}">CALENDAR</span>
        </router-link>
      </div>
    </ul>
  </div>
</template>

<script>
  export default {
    props: ['count'],
    components: {
      logo: () => import('@/components/legacy/Logo.vue')
    }
  }
</script>

<style scoped>
  .left__header {
    min-height: 140px;
  }

  .main-nav__left {
    position: relative;

    display: flex;
    flex-flow: row nowrap;
    padding-left: 37.3%;
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

  .nav__link {
    text-transform: uppercase;
    font-size: 20px;
    line-height: 23px;
    color: #E0E0E0;
    transition: color .2s ease;
    will-change: color;
  }


  @media (max-width: 1024px) {
    .left__header {
      display: none;
    }
  }
</style>
