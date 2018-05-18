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
    -webkit-transform: translate3d(-50%, -50%, 0);
    -moz-transform: translate3d(-50%, -50%, 0);
    -o-transform: translate3d(-50%, -50%, 0);
    -ms-transform: translate3d(-50%, -50%, 0);
    transform: translate3d(-50%, -50%, 0);
    width: 160px;
    height: 121.22px
  }

  .preload__sign i {
    position: absolute;
    left: 0;
    top: 0;
    width: 160px;
    height: 121.22px;
    background: url('~/assets/images/loader-bg-d.gif') no-repeat;
    -webkit-transform: translate3d(0, 0, 0) skewX(15deg);
    -moz-transform: translate3d(0, 0, 0) skewX(15deg);
    -o-transform: translate3d(0, 0, 0) skewX(15deg);
    -ms-transform: translate3d(0, 0, 0) skewX(15deg);
    transform: translate3d(0, 0, 0) skewX(15deg);
    overflow: hidden
  }

  .preload__sign i:last-child {
    top: -4.8px;
    left: 0;
    -webkit-transform: translate3d(-1.44px, 0, 0) skewX(15deg);
    -moz-transform: translate3d(-1.44px, 0, 0) skewX(15deg);
    -o-transform: translate3d(-1.44px, 0, 0) skewX(15deg);
    -ms-transform: translate3d(-1.44px, 0, 0) skewX(15deg);
    transform: translate3d(-1.44px, 0, 0) skewX(15deg);
    -webkit-animation: preload-sign 1.5s linear infinite;
    -moz-animation: preload-sign 1.5s linear infinite;
    -o-animation: preload-sign 1.5s linear infinite;
    -ms-animation: preload-sign 1.5s linear infinite;
    animation: preload-sign 1.5s linear infinite;
    height: 127.02px
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

  .preload_hide {
    -webkit-transition: opacity .25s ease .25s;
    -moz-transition: opacity .25s ease .25s;
    -o-transition: opacity .25s ease .25s;
    -ms-transition: opacity .25s ease .25s;
    transition: opacity .25s ease .25s;
    opacity: 0;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
    filter: alpha(opacity=0)
  }

  @-moz-keyframes preload-sign {
    0% {
      -webkit-transform: translate3d(-160px, 0, 0) skewX(15deg);
      -moz-transform: translate3d(-160px, 0, 0) skewX(15deg);
      -o-transform: translate3d(-160px, 0, 0) skewX(15deg);
      -ms-transform: translate3d(-160px, 0, 0) skewX(15deg);
      transform: translate3d(-160px, 0, 0) skewX(15deg);
      background-position-x: 160px
    }
    100% {
      -webkit-transform: translate3d(160px, 0, 0) skewX(15deg);
      -moz-transform: translate3d(160px, 0, 0) skewX(15deg);
      -o-transform: translate3d(160px, 0, 0) skewX(15deg);
      -ms-transform: translate3d(160px, 0, 0) skewX(15deg);
      transform: translate3d(160px, 0, 0) skewX(15deg);
      background-position-x: -160px
    }
  }

  @-webkit-keyframes preload-sign {
    0% {
      -webkit-transform: translate3d(-160px, 0, 0) skewX(15deg);
      -moz-transform: translate3d(-160px, 0, 0) skewX(15deg);
      -o-transform: translate3d(-160px, 0, 0) skewX(15deg);
      -ms-transform: translate3d(-160px, 0, 0) skewX(15deg);
      transform: translate3d(-160px, 0, 0) skewX(15deg);
      background-position-x: 160px
    }
    100% {
      -webkit-transform: translate3d(160px, 0, 0) skewX(15deg);
      -moz-transform: translate3d(160px, 0, 0) skewX(15deg);
      -o-transform: translate3d(160px, 0, 0) skewX(15deg);
      -ms-transform: translate3d(160px, 0, 0) skewX(15deg);
      transform: translate3d(160px, 0, 0) skewX(15deg);
      background-position-x: -160px
    }
  }

  @-o-keyframes preload-sign {
    0% {
      -webkit-transform: translate3d(-160px, 0, 0) skewX(15deg);
      -moz-transform: translate3d(-160px, 0, 0) skewX(15deg);
      -o-transform: translate3d(-160px, 0, 0) skewX(15deg);
      -ms-transform: translate3d(-160px, 0, 0) skewX(15deg);
      transform: translate3d(-160px, 0, 0) skewX(15deg);
      background-position-x: 160px
    }
    100% {
      -webkit-transform: translate3d(160px, 0, 0) skewX(15deg);
      -moz-transform: translate3d(160px, 0, 0) skewX(15deg);
      -o-transform: translate3d(160px, 0, 0) skewX(15deg);
      -ms-transform: translate3d(160px, 0, 0) skewX(15deg);
      transform: translate3d(160px, 0, 0) skewX(15deg);
      background-position-x: -160px
    }
  }

  @keyframes preload-sign {
    0% {
      -webkit-transform: translate3d(-160px, 0, 0) skewX(15deg);
      -moz-transform: translate3d(-160px, 0, 0) skewX(15deg);
      -o-transform: translate3d(-160px, 0, 0) skewX(15deg);
      -ms-transform: translate3d(-160px, 0, 0) skewX(15deg);
      transform: translate3d(-160px, 0, 0) skewX(15deg);
      background-position-x: 160px
    }
    100% {
      -webkit-transform: translate3d(160px, 0, 0) skewX(15deg);
      -moz-transform: translate3d(160px, 0, 0) skewX(15deg);
      -o-transform: translate3d(160px, 0, 0) skewX(15deg);
      -ms-transform: translate3d(160px, 0, 0) skewX(15deg);
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
