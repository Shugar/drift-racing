<template>
    <div class="main-slider">
      <div class="main-slider__container">
        <main-text-left :count="count" />
      </div>
    </div>
</template>

<script>
  export default {
    components: {
      MainTextLeft: () => import('@/components/legacy/main-texts-left/MainTextLeft.vue'),
    },

    props: ['count']
  }
</script>
<style scoped>
  .main-slider {
    max-width: 780px;
    width: 100%;

    padding-left: 12.82%;
    padding-bottom: 80px;
    padding-right: 12.82%;
    padding-top: 140px;

    height: 100vh;
    min-height: 654px;
    display: flex;
    flex-flow: column nowrap;
    justify-content: space-between;
  }

  .main-slider__container {
    position: relative;
    display: flex;
    flex-flow: row nowrap;

    max-width: 679px;
    width: 100%;
    margin-top: 30px;

    z-index: 1;
  }

  @media (max-width: 1024px) {
    .main-slider {
      display: flex;
      flex-flow: column nowrap;
      justify-content: space-between;

      padding-left: 10%;
      padding-right: 10%;
      padding-bottom: 60px;
      max-width: initial;
      height: 100vh;
    }

    .main-slider__container {
      max-width: initial;
    }
  }

  @media (max-width: 420px) {
    .main-slider {
      padding-bottom: 50px;
      height: initial;
      min-height: auto;
    }

    .main-slider__container {
      margin-top: 169px;
      
    }
  }
</style>
