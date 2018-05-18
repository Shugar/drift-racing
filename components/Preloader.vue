<template>
  <div class="preload nprogress-custom-parent">
    <div class="preload__sign">
      <i></i>
      <i></i>
    </div>
    <div class="preload__progress"><i></i></div>
    <div id="nprogress">
      <div class="bar" role="bar"
        :style="{
          transform: 'translate3d(-' + loaded + '%, 0px, 0px)',
          transition: 'all 200ms ease'
        }">
        <div class="peg">
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    props: ['loaded']
  }
</script>

<style lang="scss" scoped>
  .preload {
    position: fixed;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    background: #000;
    z-index: 1000
  }

  .preload__sign {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate3d(-50%, -50%, 0);
    width: 160px;
    height: 200px
  }

  .preload__sign i {
    position: absolute;
    left: 0;
    top: 0;
    width: 160px;
    height: 200px;
    background: url('~/assets/images/logo.svg') no-repeat center / cover;
    transform: translate3d(0, 0, 0) skewX(15deg);
    overflow: hidden
  }

  .preload__sign i:last-child {
    top: -1px;
    left: 0;
    transform: translate3d(-1.44px, 0, 0) skewX(15deg);
    animation: preload-sign 1.5s linear infinite;
  }

  .preload__sign i:last-child:after {
    content: '';
    position: absolute;
    left: 0;
    right: 0;
    bottom: 0;
    height: 5.8px;
    background: #000
  }

  @keyframes preload-sign {
    0% {
      transform: translate3d(-160px, 0, 0) skewX(15deg);
      background-position-x: 160px
    }

    100% {
      transform: translate3d(160px, 0, 0) skewX(15deg);
      background-position-x: -160px
    }
  }

  #nprogress {
    bottom: 0;
    left: 0;
    right: 0;
    position: absolute;
    height: .833333333333333rem;
  }

  #nprogress .bar {
    background: #683fff;
    height: 100%;
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    transform: translate3d(-100%, 0, 0);
    transition: transform .3s ease;
    will-change: transform;
  }

  #nprogress .peg {
    -webkit-box-shadow: none;
    box-shadow: none;
  }

  #nprogress .spinner-icon {
    border-top-color: #000;
    border-left-color: #000;
  }
</style>
