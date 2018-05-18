<template>
  <section class="index">
    <Header type="main" />
    <div class="container">
      <div class="left">
        <div class="page-title">
          <div>contact</div>
          <div class="city">
            <div class="city-item"
              v-for="(item, index) in contact"
              :key="index"
              :class="{active : currentCity === item.city }"
              @click="setCurrentCity(item.city)">
              {{ item.city }}
            </div>
          </div>
        </div>
        <div class="contact-item"
          v-for="(item, index) in contact"
          :key="index"
          v-if="currentCity === item.city">
          <div class="contact-info">
            <div class="contact-title">connect with us</div>
            <div class="contact">
              <a :href="'mailto:' + item.email">{{ item.email }}</a>
              <br/>
              <a :href="'tel:' + item.number">{{ item.number }}</a>
            </div>
          </div>
          <div class="contact-info">
            <div class="contact-title">location</div>
            <div class="contact">
              {{ item.address }}
            </div>
          </div>
        </div>
        </div>
      <div class="right">
        <div class="right-background" :style="{background: `url(/contact/map.png) no-repeat center / cover`}"/>
      </div>
    </div>
    <div class="footer-wrapper">
      <Footer />
    </div>
  </section>
</template>

<script>
  export default {
    data () {
      return {
        currentCity: 'moscow'
      }
    },

    components: {
      Header: () => import('@/components/Header.vue'),
      Footer: () => import('@/components/Footer.vue')
    },

    computed: {
      contact () {
        return this.$store.state.entities.contact
      }
    },

    methods: {
      setCurrentCity (city) {
        return this.currentCity = city
      }
    }
  }
</script>

<style lang="scss" scoped>
  .index {
    position: relative;
    height: 100vh;
    min-height: 700px;
  }

  .container {
    height: 100%;
    display: flex;
    flex-flow: row nowrap;
  }

  .left {
    flex: 0 0 55%;
    min-width: 728px;
    position: relative;
    // padding-bottom: 230px;
    background: #683FFF;
    display: flex;
    flex-flow: column nowrap;
    justify-content: center;
    font-family: 'DIN Condensed';
    text-transform: uppercase;
    color: #fff;
    padding: 180px 0 140px;
    padding-left: 100px;
  }

  .page-title {
    font-size: 48px;
    margin-left: 220px;
    margin-bottom: 90px;
  }

  .city {
    display: flex;
    justify-content: space-between;
    font-size: 20px;
    color: #fff;
    width: 180px;
    margin-top: 40px;

  }

  .city-item {
    cursor: pointer;

    &.active {
      position: relative;
      color: #683FFF;
      z-index: 1;

      &:before {
        content: '';
        display: block;
        position: absolute;
        top: -3px;
        left: -2px;
        width: calc(100% + 5px);
        height: 100%;
        background: #fff;
        z-index: -1;
      }
    }
  }

  .contact-info {
    display: flex;
    width: 560px;
    min-width: 256px;
    margin-bottom: 40px;


  }

  .contact {
    font-size: 36px;
    margin-left: 60px;
    max-width: 310px;

    a {
      color: #FFF;
      text-decoration: none;
    }
  }

  .contact-title {
    font-size: 24px;
    width: 160px;
    opacity: 0.8;
  }

  .right {
    position: relative;
    height: 100%;
    flex: 0 0 45%;
    display: flex;
    flex-flow: column nowrap;
    justify-content: flex-end;
    padding-bottom: 120px;

    .right-background {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      z-index: 0;
    }
  }

  .footer-wrapper {
    width: 100%;
    position: absolute;
    bottom: 60px;
  }

  .category-animation-enter-active, .category-animation-leave-active {
    transition: transform .3s;
  }

  .category-animation-leave-to {
    transform: translateY(-110%);
  }

  .category-animation-enter {
    transform: translateY(110%);
  }

@media (max-width: 1024px) {
}

  @media (max-width: 768px) {

    .index {
      min-height: 100vh;
      height: auto;
    }
    .container {
      flex-flow: column nowrap;
      height: 100%;
    }

    .left {
      flex-flow: row wrap;
      align-items: flex-end;
      justify-content: flex-start;
      padding-bottom: 0;
      height: 70%;
      min-width: auto;
      padding-top: 0;
    }

    .right {
      height: 550px;
    }

    .page-title {
      margin: 0;
      margin-top: 190px;
      margin-bottom: 20px;
      width: 100%;
    }

    .contact-info {
      flex-flow: column nowrap;
      width: 50%;
      &:last-child {
        margin-bottom: 40px;
      }
    }

    .contact {
      margin-left: 0;
      font-size: 24px;
    }

    .contact-item {
      display: flex;
      flex-flow: row wrap;
      margin-bottom: 30px;
    }

    .contact-title {
      margin-bottom: 20px;
    }
  }

  @media (max-width: 425px) {

    .index {
      height: auto;
    }

    .left {
      // flex: 0 0 85%;
      padding-left: 55px;
      align-items: flex-start;
    }

    .right {
      height: 400px;
    }

    .page-title {
      margin-top: 0;
      width: 100%;
      margin-top: 150px;
    }

    .contact-title {
      margin-bottom: 15px;
    }

    .contact-info {
      width: 100%;
      margin-bottom: 15px;
      &:last-child {
        margin-bottom: 15px;
      }
    }

    .footer-wrapper {
      position: absolute;
      bottom: 40px;
    }
  }
</style>
