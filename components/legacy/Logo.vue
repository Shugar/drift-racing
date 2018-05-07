<template>
  <div class="logo">
    <img src="@/assets/images/logo.svg" class="img">
  </div>
</template>

<script>
  export default {

  }
</script>

<style scoped>
  .logo {
    position: absolute;
    top: 0;
    left: 0;

    width: 100px;
    padding-top: 73px;
    padding-bottom: 33px;
    background: #000000;
  }

  .img {
    display: block;
    width: 53px;
    height: 34px;
    margin: 0 auto;
  }

  @media (max-width: 420px) {
    .logo {
      padding-top: 53px;
    }
  }
</style>
