<template>
  <section class="bio">
    <Header />

    <div class="container">
      <div class="tag">bio</div>
      <div class="left">
        <div class="title">Story of the road</div>
        <div class="text">
          Hello guys! My name is Alexander Dmitrenko. I am 25 years old and live in Moscow, Russia. I started practicing motosport professionally in 2016. 
          <br><br>
          While trying different disciplines out in Germany, Russia, Japan Driving Academy, i decided in favour of drifting.
        </div>
        <div class="img-fullwidth">
          <img src="~/assets/images/bio-1.png" />
        </div>
      </div>
      <div class="right">
        <div class="title">During 2017</div>
        <div class="text">
          During 2017 i took part in a few races of Russian Drift Series. In 2018 i have planes to participate in D1GP, Formula D Japan, Drift Masters, NEZ, HGK Drift Challenge and Russian Drift Series.
          <br><br>
          We have great plans for the next season, energy and the whole world! See you on a Race track!
        </div>
        <div class="img-fullwidth">
          <img src="~/assets/images/bio-2.png" />
        </div>
      </div>
    </div>

    <!-- <div class="container container-image">
      <div class="left">
        <img src="~/assets/images/bio-1.png" />
      </div>
      <div class="right">
        <img src="~/assets/images/bio-2.png" />
      </div>
    </div> -->

    <div class="container container-car">
      <div class="tag">cars</div>
      <div class="left">
        <div class="title">RACING car<br> BMW m3</div>
        <img src="~/assets/images/car-1.jpg" />
        <div class="text">
          The car was built at the end of the past especially for the current season in the Russian Drift Series and the European Drift Allstars Championship.
        </div>
        <div class="numbers">
          <div class="numbers-item">
            <div class="numbers-item__digits">666</div>
            <div class="numbers-item__units">HP</div>
          </div>
          <div class="numbers-item">
            <div class="numbers-item__digits">RWD</div>
            <div class="numbers-item__units">DRIVETRAIN</div>
          </div>
          <div class="numbers-item">
            <div class="numbers-item__digits">6.2 L</div>
            <div class="numbers-item__units">ENGINE</div>
          </div>
        </div>
      </div>
      <div class="right">
        <div class="title">Training car<br> BMW M5</div>
        <img src="~/assets/images/car-2.jpg" />
        <div class="text">
          This is my training M5. Excellent and my favorite machine. E39 — a legend and in drift them very little.
        </div>
        <div class="numbers">
          <div class="numbers-item">
            <div class="numbers-item__digits">550</div>
            <div class="numbers-item__units">HP</div>
          </div>
          <div class="numbers-item">
            <div class="numbers-item__digits">RWD</div>
            <div class="numbers-item__units">DRIVETRAIN</div>
          </div>
          <div class="numbers-item">
            <div class="numbers-item__digits">4.9 L</div>
            <div class="numbers-item__units">ENGINE</div>
          </div>
        </div>
      </div>
    </div>

    <Footer />
  </section>
</template>

<script>
export default {
  components: {
    Header: () => import('@/components/Header'),
    Footer: () => import('@/components/Footer')
  }
}
</script>

<style lang="scss" scoped>
  .bio {
    background: #683FFF;
    padding: 200px 0 80px;
  }

  .container {
    position: relative;
    padding: 0 100px;

    display: flex;
    flex-flow: row nowrap;
    align-content: center;
  }

  .tag {
    position: absolute;
    left: 100px;
    top: 0px;
    font-family: 'DIN Condensed', sans-serif;
    font-style: normal;
    font-weight: bold;
    line-height: normal;
    font-size: 20px;
    text-transform: uppercase;
    color: #FFFFFF;
  }

  .left {
    padding-left: 220px;
    // flex: 0 0 60%;

    display: flex;
    flex-flow: column nowrap;
  }

  .right {
    // flex: 0 0 40%;
    display: flex;
    flex-flow: column nowrap;
  }

  .title {
    font-family: 'DIN Condensed', sans-serif;
    line-height: normal;
    font-size: 64px;
    text-transform: uppercase;
    color: #FFFFFF;
    margin-bottom: 20px;
    padding-right: 110px;
  }

  .text {
    line-height: 25px;
    font-size: 18px;
    letter-spacing: -0.03em;
    color: rgba(255, 255, 255, 0.8);
    max-width: 470px;
    padding-right: 40px;
    flex: 1;
  }

  .right .title,
  .right .text {
    padding-right: 0;
    padding-left: 50px;
  }

  .img-fullwidth {
    margin: 100px 0;
  }

  .img-fullwidth img {
    height: auto;
    width: 100%;
    max-width: 100%;
  }

  .container-car {
    align-content: center;
    margin-bottom: 100px;
  }

  .container-car img {
    width: 100%;
    max-width: 440px;
    height: auto;
    margin-bottom: 40px;
  }

  .container-car .left,
  .container-car .right {
    display: flex;
    flex-flow: column nowrap;
  }

  .container-car .right .numbers,
  .container-car .right img {
    margin-left: 50px;
  }

  .container-car .text {
    padding-right: initial;
    max-width: 360px;
    flex: 1;
  }

  .numbers {
    margin-top: 40px;
    display: flex;
    flex-flow: row nowrap;
    align-items: center;
  }

  .numbers-item {
    margin-right: 40px;
    &:last-child {
      margin-right: 0;
    }
  }

  .numbers-item__digits {
    font-family:  'DIN Condensed', sans-serif;
    font-style: normal;
    font-weight: bold;
    line-height: normal;
    font-size: 48px;
    text-transform: uppercase;
    color: #FFFFFF;
  }

  .numbers-item__units {
    font-family: 'DIN Condensed', sans-serif;
    font-style: normal;
    font-weight: bold;
    line-height: normal;
    font-size: 20px;
    text-transform: uppercase;
    color: rgba(255, 255, 255, 0.8);
  }

  @media (max-width: 1024px) {
    .numbers-item__digits {
      font-size: 38px;
    }
  }

  @media (max-width: 976px) {
    .container {
      display: block;
    }

    .tag {
      display: none;
    }

    .left {
      padding-left: 0;
    }

    .left,
    .right {
      margin-bottom: 60px;
    }

    .text {
      max-width: initial;
      padding: 0;
    }

    .title {
      padding: 0;
    }

    .title br {
      display: none;
    }

    .container-car img {
      max-width: 100%;
    }

    .container-car .text {
      max-width: initial;
    }

    .right .title,
    .right .text {
      padding-left: 0;
    }

    .container-car .right img,
    .container-car .right .numbers {
      margin-left: 0;
    }
  }

  @media (max-width: 425px) {
    .container {
      padding: 0 30px;
    }

    .title {
      font-size: 36px;
      margin-bottom: 10px;
    }

    .container-car img {
      margin-bottom: 30px;
    }

    .img-fullwidth {
      margin: 50px 0 0;
    }

    .left,
    .right {
      margin-bottom: 50px;
    }
  }
</style>
