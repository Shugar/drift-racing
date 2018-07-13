<template>
  <section class="calendar" :class="{phone: isMobileInfoVisible, 'videos-isWindows': this.window.navigator.userAgent.includes('Windows') }" >
    <div class="background" :class="{active: isBackgroundAnimation}" :style="{ background: 'url(http://' + store.full.fields.file.url.slice(2) + ') no-repeat center / cover'}"></div>
    <div class="container" >
      <u-animate
        name="fadeIn"
        delay="0.6s"
        duration="0.4s"
        :iteration="1"
        :offset="0"
        animateClass="animated"
        :begin="true"
      >
        <nuxt-link to="/store/">
          <div class="cross" />
        </nuxt-link>
      </u-animate>
    <div class="product" :class="{'product-mobile': isMobileInfoVisible}" >
      <u-animate
        name="fadeInUp"
        delay="0.6s"
        duration="0.4s"
        :iteration="1"
        :offset="0"
        animateClass="animated"
        :begin="true"
      >
        <div class="product-title">
          {{ store.title }} {{ store.gender }} {{ store.category }} {{ store.style }}
        </div>
      </u-animate>
      <u-animate
        name="fadeInUp"
        delay="0.8s"
        duration="0.4s"
        :iteration="1"
        :offset="0"
        animateClass="animated"
        :begin="true"
      >
        <div class="product-price">$ {{ store.price }}</div>
      </u-animate>
      <u-animate
        name="fadeInUp"
        delay="1s"
        duration="0.4s"
        :iteration="1"
        :offset="0"
        animateClass="animated"
        :begin="true"
      >
        <div class="product-descr">
          {{ store.description }}
        </div>
      </u-animate>
      <u-animate
        name="fadeInUp"
        delay="1.2s"
        duration="0.4s"
        :iteration="1"
        :offset="0"
        animateClass="animated"
        :begin="true"
      >
        <div class="size-wrapper">
          {{locale === 'en' ? 'SIZE' : 'РАЗМЕР'}} –
          <v-select class="product-size"
            v-model="selected"
            :options="store.sizes.split(',')"
            :searchable="false"
            :close-on-select="true"
            :allow-empty="false"
            placeholder=""
          />
          <!-- <select class="product-size">
            <option value="xs">xs</option>
            <option value="s">s</option>
            <option value="m" selected>m</option>
            <option value="l">l</option>
            <option value="xl">xl</option>
          </select> -->
        </div>
      </u-animate>
      <u-animate
        name="fadeInUp"
        delay="1.4s"
        duration="0.4s"
        :iteration="1"
        :offset="0"
        animateClass="animated"
        :begin="true"
      >
        <div class="add-to" @click="addToCard" :class="{white: isMobileInfoVisible}" >{{ locale === 'en' ? "add to cart" : "добавить в корзину"}}</div>
        <div class="about mobile-inside" :class="{white: isMobileInfoVisible}" @click="toggleInfoMobile()">{{locale === 'en' ? 'about product' : 'о товаре'}}</div>
      </u-animate>
    </div>
    <div class="about mobile" :class="{white: isMobileInfoVisible}" @click="toggleInfoMobile()">{{locale === 'en' ? 'about product' : 'о товаре'}}</div>
    </div>
  </section>
</template>

<script>
  import Multiselect from 'vue-multiselect'

  export default {
    components: {
      'v-select': Multiselect
    },

    data () {
      return {
        isMobileInfoVisible: false,
        isBackgroundAnimation: false,
        selected: null
      }
    },

    head () {
      return {
        title: this.store.title,
        meta: [
          { name: 'description', content: this.store.description },
          { name: 'keywords', content: this.store.category },
          { hid: 'og:type', property: 'og:type', content: 'article'},
          { hid: 'og:url', property: 'og:url', content: this.url },
          { hid: 'og:image', property: 'og:image', content: `http://${this.store.full.fields.file.url.slice(2)}` },
          { hid: 'og:title', property: 'og:title', content: this.store.title + ' ' + this.store.price },
          { hid: 'og:description', property: 'og:description', content: this.store.description },
        ]
      }
    },

    computed: {
      store () {
        return this.$store.state.entities.store[this.$route.params.id]
      },
      locale () {
        return this.$store.state.locale
      },
      checkoutLenght () {
        return this.$store.state.checkoutList.length
      }
     },


    methods: {
      toggleInfo () {
        this.isInfoVisible = !this.isInfoVisible
      },

      toggleInfoMobile () {
        this.isMobileInfoVisible = !this.isMobileInfoVisible
      },

      addToCard () {
        this.$store.commit('addProductToCart', { ...this.store, sizes: this.selected, id: this.checkoutLenght + 1 })
        this.$store.commit('lastProduct', { ...this.store, sizes: this.selected })
        this.$router.push('/store/')
      }
    },

    mounted () {
      this.selected = this.store.sizes.split(',')[0]

      setTimeout(() => {
        this.isBackgroundAnimation = true
      }, 200);
    },

    validate ({ params }) {
      // Must be a number
      return /^\d+$/.test(params.id)
    }
  }
</script>

<style lang="scss" scoped>
  .calendar {
    background: linear-gradient(216.25deg, #565656 0%, #000000 100%), #683FFF;
    // padding: 200px 0 80px;
    position: relative;
    height: 100%;
    min-height: 700px;
  }

  a {
    text-decoration: none;
  }


  .container {
    padding: 0 100px;
    height: 100%;
    display: flex;
    flex-flow: row nowrap;
    justify-content: flex-end;
    align-items: center;
  }


  .background {
    position: fixed;
    height: 100%;
    width: 100%;
    top: 0;
    left: 0;
    background: url('/store/store-background.png') center / cover no-repeat;

    transform: translateY(40%);
    opacity: 0;
    transition: transform .4s ease, opacity .4s ease;
    will-change: opacity, transform;
  }

  .active {
    transform: translateY(0);
    opacity: 1;
  }


  .cross {
    position: absolute;
    top: 80px;
    right: 100px;
    height: 50px;
    width: 50px;
    background: url('/store/cross.svg') center / cover no-repeat;
  }

  .product {
    position: relative;
    display: flex;
    flex-flow: column nowrap;
    align-items: flex-start;
    z-index: 2;
    font-family: 'DIN Condensed';
    color: #fff;
    width: 300px;
    font-size: 64px;
    margin-top: 80px;
    margin-right: 15%;
  }

  .product-title {
    text-transform: uppercase;
    padding-right: 20px;
    margin-bottom: 32px;
  }

  .product-price {
    text-transform: uppercase;
    color: #683FFF;
    margin-bottom: 40px;
  }

  .product-descr {
    font-family: 'DIN Pro Medium';
    font-size: 18px;
    margin-bottom: 40px;
    line-height: 25px;
  }

  .size-wrapper {
    position: relative;
    font-size: 36px;
    margin-bottom: 40px;

    display: flex;
    align-items: center;
  }

  .product-size {
    position: relative;
    text-transform: uppercase;
    font-family: 'DIN Condensed';
    font-size: 36px;
    margin-left: 10px;
    z-index: 3;
    outline: none;
    color: #fff;
    border: none;
    background: none;
    -webkit-appearance: none;
    -moz-appearance: none;

    display: flex;
    align-items: center;

    &::after {
      margin-bottom: 7px;
      margin-left: 10px;
      content: '';
      display: block;
      width: 16px;
      height: 10px;
      background: url('/store/dropdown-arrow.svg') no-repeat right / contain;
    }
  }

  .add-to {
    margin-bottom: 120px;
  }

  .add-to, .about {
    position: relative;
    text-transform: uppercase;
    font-size: 20px;
    z-index: 1;
    font-family: 'DIN Condensed';
    color: #fff;
    cursor: pointer;

    &:before {
      content: '';
      background: #683FFF;
      position: absolute;
      top: -1.6px;
      left: -1px;
      width: calc(100% + 2px);
      height: calc(100% - 1px);
      z-index: -1;
    }
  }

  .about {
    position: absolute;
    bottom: 80px;
    z-index: 3;
    cursor: pointer;
    display: none;
  }

  /deep/ .multiselect__content-wrapper {
    position: absolute;
  }

  /deep/ .multiselect__content {
    display: flex !important;
    flex-flow: row nowrap;
    padding: 16px 16px 8px;
    background: #683FFF;
  }

  /deep/ .multiselect__element {
    list-style: none;
    cursor: pointer;
    line-height: 36px;
    text-align: center;
    margin-left: 24px;

    opacity: 0.8;
    transition: opacity .2s ease;
    will-change: opacity;

    &:hover {
      opacity: 1;
    }

    &:first-child {
      margin-left: 0;
    }
  }

  @media (max-width: 1024px) {

    .about {
      display: block;
    }


    .product {
      margin-right: 0;
    }

    .product-mobile {
      opacity: 0;
      pointer-events: none;
    }


    .background {
      background: url(/store/product-mobile.png) -160px;
      background-repeat: no-repeat;
      background-size: 122%;
    }
  }

  @media (max-width: 768px) {
    .calendar {
      min-height: 100vh;
    }
  }

  @media (max-width: 425px) {
    .background {
      background: url(/store/product-mobile.png) -50px;
      background-repeat: no-repeat;
      background-size: cover;
    }

    .calendar {
      overflow: hidden;
      height: 100vh;
    }
    
    .phone {
      height: 100%;
      overflow: scroll;
    }

    .container {
      padding: 0;
    }

    .about {
      display: none;
      bottom: 40px;
    }

    .white {
      color: #683FFF;
      &:before {
        background: #fff;
      }
    }

    .mobile {
      display: block;
      left: 50px;
    }

    .cross {
      cursor: pointer;
      top: 50px;
      right: 50px;
      z-index: 16;
    }

    .product {
      opacity: 0;
      pointer-events: none;
      background: linear-gradient(216.25deg, #565656 0%, #000000 100%), #683FFF;
      width: 100%;
      height: 100%;
      padding: 150px 50px 50px 50px;
      margin: 0;
      z-index: 15;
    }

    .product-mobile {
      position: fixed;
      top: 0;
      left: 0;
      height: 100%;
      width: 100%;
      opacity: 1;
      pointer-events: auto;
      overflow-y: scroll;
    }

    .add-to {
      display: inline-block;
      margin-bottom: 24px;
      position: relative;
    }

    .mobile-inside {
      display: block;
      position: relative;
      bottom: initial;
    }

    .product-title {
      font-size: 32px;
    }

    .product-price {
      margin-bottom: 16px;
      color: #fff;
    }

    /deep/ .multiselect--active {
      margin-top: -4px;
    }

    /deep/ .multiselect__content {
      padding: 0;
    }

    .mobile-container {
      height: 100vh;
      overflow-y: scroll;
    }
  }

</style>
