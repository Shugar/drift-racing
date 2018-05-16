<template>
  <section class="calendar" :class="{phone: isMobileInfoVisible}">
    <div class="background"></div>
    <div class="container">
      <nuxt-link to="/store/"><div class="cross" /></nuxt-link>
     <div class="product" :class="{'product-mobile': isMobileInfoVisible}" >
       <div class="product-title">BOOST ME men t-shirt WHITE</div>
       <div class="product-price">$ 15</div>
       <div class="product-descr">Phasellus semper vehicula ornare. Donec ante ipsum, maximus ac auctor in, dapibus nec lorem.</div>
       <div class="size-wrapper">
         SIZE –
        <select class="product-size">
          <option value="s">s</option>
          <option value="m" selected>m</option>
          <option value="l">l</option>
        </select>
       </div>
       <div class="add-to" :class="{white: isMobileInfoVisible}" >add to card</div>
     </div>
     <div class="about mobile" :class="{white: isMobileInfoVisible}" @click="toggleInfoMobile()">about product</div>
    </div>
  </section>
</template>

<script>
  export default {
    data () {
      return {
        isMobileInfoVisible: false,
      }
    },

    computed: {
    },

    methods: {
      toggleInfo () {
        this.isInfoVisible = !this.isInfoVisible
      },
      toggleInfoMobile () {
        this.isMobileInfoVisible = !this.isMobileInfoVisible
      }
    },

    mounted () {

    },

    components: {
    },

    validate ({ params }) {
      // Must be a number
      return /^\d+$/.test(params.id)
    }
  }
</script>

<style lang="scss" scoped>
  .calendar {
    background: #683FFF;
    // padding: 200px 0 80px;
    position: relative;
    height: 100vh;
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
    position: absolute;
    height: 100%;
    width: 100%;
    top: 0;
    left: 0;
    background: url('/store/store-background.png') center / cover no-repeat;
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
    margin-top: 150px;
  }

  .product-title {
    text-transform: uppercase;
    padding-right: 20px;
    margin-bottom: 40px;
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
    display: flex;
    position: relative;
    font-size: 36px;
    margin-bottom: 40px;

    &::after {
      content: '';
      display: block;
      width: 16px;
      height: 10px;
      top: 14px;
      left: 110px;
      position: absolute;
      background: url('/store/dropdown-arrow.svg') no-repeat right / contain;
    }
  }
  .product-size {
    text-transform: uppercase;
    font-family: 'DIN Condensed';
    font-size: 36px;
    width: 80px;
    margin-left: 10px;
    z-index: 3;
    outline: none;
    color: #fff;
    border: none;
    background: none;
    -webkit-appearance: none;
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
  }

  @media (max-width: 768px) {

    .calendar {
      min-height: auto;
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

  @media (max-width: 425px) {
    .background {
      background: url(/store/product-mobile.png) -50px;
      background-repeat: no-repeat;
      background-size: cover;
    }

    .calendar {
      // height: 100%;
      overflow: hidden;
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
      z-index: 3;
    }

    .product {
      opacity: 0;
      pointer-events: none;
      background: #683FFF;
      width: 100%;
      height: 100%;
      padding: 150px 50px 0 50px;
      margin: 0;
    }

    .product-mobile {
      opacity: 1;
      pointer-events: auto;
    }

    .product-price {
      color: #fff;
    }

    .mobile-container {
      height: 100vh;
      overflow-y: scroll;
    }
  }

</style>
