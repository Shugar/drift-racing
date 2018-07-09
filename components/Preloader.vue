<template>
  <div class="preload nprogress-custom-parent">
    <video class="logo-loader" loop muted autoplay playsinline>
      <source src="~/assets/video/logo-3.mp4" type="video/mp4">
    </video>
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
    <div class="left-background left-background-1" />
    <div class="left-background left-background-2" />
    <div class="left-background left-background-3" />
    <div class="left-background left-background-4" />
  </div>
</template>

<script>
  export default {
    props: ['loaded'],
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
    height: 121.22px;
  }

  .logo-loader {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate3d(-50%, -50%, 0);
    width: 20%;
    height: auto;
  }
  .preload__sign i {
    position: absolute;
    left: 0;
    top: 0;
    width: 189px;
    height: 121.22px;
    background: url('~/assets/images/logo-big.svg') no-repeat center / contain;
    transform: translate3d(0, 0, 0) skewX(15deg);
    will-change: translate3d, background-position-x;
    overflow: hidden;
  }

  .preload__sign i:last-child {
    top: -6.8px;
    left: -3px;
    width: 192px;
    animation: preload-sign 1.5s linear infinite;
    height: 127.02px;
    transform: translate3d(0, 0, 0) skewX(15deg);
    will-change: translate3d, background-position-x;
  }

  .preload__sign i:last-child:after {
    content: '';
    position: absolute;
    left: 0;
    right: 0;
    bottom: -2px;
    height: 5.8px;
    background: #000
  }

  @keyframes preload-sign {
    0% {
      transform: translate3d(-192px, 0, 0) skewX(15deg);
      background-position-x: 192px;
    }

    100% {
      transform: translate3d(192px, 0, 0) skewX(15deg);
      background-position-x: -192px
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

  .left-background {
    opacity: 0;
  }

  .left-background-1 {
    background: url('/static/home/left-slider/main-1.jpg') no-repeat center / cover;
  }

  .left-background-2 {
    background: url('/static/home/left-slider/main-2.jpg') no-repeat center / cover;
  }

  .left-background-3 {
      background: url('/static/home/left-slider/main-3.jpg') no-repeat center / cover;
  }

  .left-background-4 {
      background: url('/static/home/left-slider/main-4.jpg') no-repeat center / cover;
  }

  @media only screen and (max-width: 1024px) {
    .left-background-1 {
      background: url('/static/home/left-slider/main-mob-1.jpg') no-repeat center / cover;
    }

    .left-background-2 {
      background: url('/static/home/left-slider/main-mob-2.jpg') no-repeat center / cover;
    }

    .left-background-3 {
        background: url('/static/home/left-slider/main-mob-3.jpg') no-repeat center / cover;
    }

    .left-background-4 {
        background: url('/static/home/left-slider/main-mob-4.jpg') no-repeat center / cover;
    }
  }


  @media	only screen and (-webkit-min-device-pixel-ratio: 1.3),
    only screen and (-o-min-device-pixel-ratio: 13/10),
    only screen and (min-resolution: 120dpi) {

    .left-background-1 {
      background: url('/static/home/left-slider/main-1@2x.jpg') no-repeat center / cover;
    }

    .left-background-2 {
      background: url('/static/home/left-slider/main-2@2x.jpg') no-repeat center / cover;
    }

    .left-background-3 {
        background: url('/static/home/left-slider/main-3@2x.jpg') no-repeat center / cover;
    }

    .left-background-4 {
        background: url('/static/home/left-slider/main-4@2x.jpg') no-repeat center / cover;
    }
  }


  @media only screen and (-webkit-min-device-pixel-ratio: 2),
      only screen and (min-resolution: 192dpi),
      only screen and (max-width: 1024px) {

    .left-background-1 {
      background: url('/static/home/left-slider/main-mob-1@2x.jpg') no-repeat center / cover;
    }

    .left-background-2 {
      background: url('/static/home/left-slider/main-mob-2@2x.jpg') no-repeat center / cover;
    }

    .left-background-3 {
        background: url('/static/home/left-slider/main-mob-3@2x.jpg') no-repeat center / cover;
    }

    .left-background-4 {
        background: url('/static/home/left-slider/main-mob-4@2x.jpg') no-repeat center / cover;
    }
  }
</style>
