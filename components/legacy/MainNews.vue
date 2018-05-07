<template>
  <div class="news">
    <div class="news-container">
      <main-text-right />
    </div>
  </div>
</template>

<script>
  export default {
    components: {
      MainTextRight: () => import('@/components/legacy/main-texts-right/MainTextRight.vue'),
    }
  }
</script>

<style scoped>
  .news {
    width: 45.8%;
    background: #683FFF;
  }

  .news-container {
    max-width: 660px;
    width: 100%;
    padding-left: 15.1%;
    padding-bottom: 83px;
    padding-top: 140px;

    height: 100vh;
    min-height: 654px;
    display: flex;
    flex-flow: column nowrap;
    justify-content: space-between;
  }

  @media (max-width: 1024px) {
    .news-container {
      min-height: auto;
    }
    .news {
      display: none;
    }
  }
</style>
