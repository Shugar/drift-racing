<template>
  <div class="team">
    <Header />
    <div class="arrow left" @click="prevSlide()" />
    <div class="fade-left" />
    <div class="title">team</div>

    <div class="members-wrapper">
      <div
          v-for="(item, index) in testArray"
          :style="{left: count === 0 ? index*550 + 'px' : index*550 - count*550 + 'px'}"
          :key="index"
          class="member">
        <div class="member-photo">
          <div class="socials">
            <a href="https://www.instagram.com/alexd_prodrift/ " class="socials-instagram"></a>
            <a href="https://vk.com/alexd_prodrift " class="socials-facebook"></a>
          </div>
        </div>
        <div class="descr">
          <div class="name">Alexandr<br/>Dmitrenko</div>
          <div class="position">race-driver {{ index + '|| ' + count}}</div>
          <div class="birth">
            <div class="descr-item">
              Birth:
              <div class='descr-value'>1992</div>
            </div>
            <div class="descr-item">
              Location: 
              <div class='descr-value'>Moscow</div>
            </div>
          </div>
          <div class="descr-item">
            Superpower
            <div class='descr-value'>Ride slideaways by car</div>
          </div>
          <div class="descr-item">
            Favorite car
            <div class='descr-value'>BMW</div>
          </div>
        </div>
      </div>
    </div>

    <div class="arrow right"  @click="nextSlide()"/>
    <div class="fade-right" />
    <div class="footer-wrapper">
      <Footer />
    </div>
  </div>
</template>


<script>
export default {

  data () {
    return {
      testArray: [1, 2, 3, 4],
      count: 0
    }
  },

  methods: {
    nextSlide () {
      console.log('@@@@@@@@@', this.count)
      this.testArray.length - 1 > this.count ? this.count++ : this.count = 0
    },


    prevSlide () {
      console.log('@@@@@@@@@', this.count)
      return this.count > 0 ? this.count-- : this.count = 0
    }
  },
  components: {
    Header: () => import('@/components/Header'),
    Footer: () => import('@/components/Footer')
  }
}
</script>


<style lang="scss" scoped>
  .team {
    font-family: 'DIN Condensed';
    position: relative;
    height: 100vh;
    min-height: 700px;
    width: 100%;
    padding: 200px 0;
    padding-left: 320px;
    background: #683FFF;
  }

  .members-wrapper {
    position: relative;
    display: flex;
  }


  .title {
    font-size: 48px;
    margin-bottom: 25px;
    color: #fff;
    text-transform: uppercase;
  }


  .member {
    position: absolute;
    display: flex;
    margin-right: 80px;

    transition: left .5s ease;
  }

  .descr {
    color: #fff;
    margin-left: 40px;
    width: 180px;
  }

  .name {
    font-family: 'DIN Condensed';
    font-size: 36px;
    text-transform: uppercase;
    margin-bottom: 20px;
  }

  .position {
    color: rgba(255, 255, 255, 0.8);
    text-transform: uppercase;
    margin-bottom: 20px;
    font-size: 24px;
  }

  .birth {
    display: flex;
  }

  .descr-item {
    font-family: 'DIN Pro Medium';
    font-size: 18px;
    color: rgba(255, 255, 255, 0.8);

    &:first-child {
      margin-right: 20px;
    }

    &:not(:last-child) {
      margin-bottom: 20px;
    }
  }

  .descr-value {
    color: #fff;
  }

  .member-photo {
    background: url("~/static/team/team-member.jpeg") center center no-repeat / cover;
    width: 240px;
    height: 360px;
    padding: 30px;
    display: flex;
    flex-flow: column nowrap;
    justify-content: flex-end;
  }

  .fade-left {
    position: absolute;
    top: 0;
    left: 0;
    height: 100%;
    width: 320px;
    background: linear-gradient(90deg, #683FFF 0, rgba(104, 63, 255, 0) 100%);
    z-index: 3;
  }

  .fade-right {
    position: absolute;
    top: 0;
    right: 0;
    height: 100%;
    width: 50%;
    background: linear-gradient(-90deg, #683FFF 0, rgba(104, 63, 255, 0) 100%)
  }

  .arrow {
    position: absolute;
    cursor: pointer;
    background: url('~/static/team/arrow.svg') center center no-repeat / contain;
    height: 50px;
    width: 28px;

    z-index: 4;
  }

    .left {
      left: 100px;
      transform: translateY(-50%);
      top: 50%;
    }

    .right {
      right: 100px;
      transform: translateY(-50%) rotate(180deg);
      top: 50%;
    }

  .footer-wrapper {
    position: absolute;
    bottom: 80px;
    left: 0;
    width: 100%;
  }
 
 ////////////// SOCIALS /////////////////////////
 .socials {
    display: flex;
    flex-flow: row nowrap;
    align-items: center;
  }

  .socials-facebook:before,
  .socials-instagram:before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    border-radius: 6px;
    z-index: -1;

    transition: background-color .3s ease;
    will-change: background-color;
  }

  .socials-facebook:hover:before,
  .socials-instagram:hover:before {
    background-color: #000;
  }

  .socials-instagram {
    background: url('~/assets/images/inst.svg') no-repeat center / contain;
    width: 20px;
    height: 20px;
    margin-right: 20px;
    position: relative;
  }

  .socials-facebook {
    background: url('~/assets/images/facebook.svg') no-repeat center / contain;
    width: 20px;
    height: 20px;
    position: relative;
  }






@media ( max-width: 768px) {

  .team {
    padding: 200px 100px;
    height: 100%;
  }

  .arrow {
    display: none;
  }
  
  .member {
    display: block;
    position: initial;
    // left: initial;
    margin: 0;


    &-photo {
      margin-bottom: 40px;
    }
    &:nth-child(odd) {
      margin-right: 60px;
    }
  }

  .descr {
    margin: 0;
    margin-bottom: 80px;
  }

  .members-wrapper {
    flex-wrap: wrap;
  }

  .fade-left,
  .fade-right {
    display: none;
  }
}

@media (max-width: 375px) {
  .team {
    padding: 180px 50px;
  }
}
</style>
