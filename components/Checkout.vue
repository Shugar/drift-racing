<template>
  <div class="checkout">
      <div class="left" @click="$store.commit('toggleCheckout')" />
      <div class="right">
        <div class="right-wrapper">
          <div class="title">{{ this.isOrder ? 'CHECKOUT' : 'CART'}}</div>
          <div class="products" v-if="!this.isOrder">
            <div class="product-item" v-for="(product, index) in checkoutList" :key="index">
              <div class="image" :style="{background: `url(${ 'http://' + product.preview.fields.file.url.slice(2) }) no-repeat center / cover`}" />
              <div class="descr">
                <div class="name">{{product.title}}<br> {{product.category}} </div>
                <div class="color-size">{{ product.style }} — {{product.sizes}}</div>
              </div>
              <div class="price">$ {{product.price}}</div>
            </div>
          </div>
          <form v-if="this.isOrder" class="order-form">
            <input type="text" placeholder="NAME"/>
            <input type="email" placeholder="EMAIL"/>
            <input type="number" placeholder="PHONE"/>
            <input type="text" placeholder="ADRESS"/>
            <input type="number" placeholder="ZIP"/>
          </form>
        </div>
        <div class="order" @click="orderProducts()"> {{this.isOrder ? 'send an order' : 'CHECKOUT'}} </div>
      </div>
  </div>
</template>

<script>
  export default {
    data () {
      return {
        isOrder: false
      }
    },

    computed: {
      checkoutList () {
        return this.$store.state.checkoutList
      },
    },

    methods: {

      orderProducts () {
        if ( !this.isOrder ) {
          return (
            this.isOrder = true
          )
        } else {
          null
        }
      }
    }
  }
</script>

<style lang="scss" scoped>
  .checkout {
    z-index: 22;
    position: fixed;
    display: flex;
    height: 100%;
    width: 100%;
    right: 0;
    top: 0;
  }

  .left {
    cursor: pointer;
    background: rgba(51, 51, 51, .6);
    height: 100%;
    width: calc(100% - 350px);
  }

  .right {
    position: relative;
    // height: 100%;
    width: 350px;
    background: #FAFAFA;

    display: flex;
    flex-flow: column nowrap;
    justify-content: space-between;

    font-family: 'DIN Condensed';
    color: #683FFF;
    text-align: left;
    overflow-y: scroll;
  }
  .right-wrapper {
    // height: 100%;
    padding: 0 40px;
    padding-top: 80px;
  }


  .order {
    background: #fff;
    text-transform: uppercase;
    position: relative;
    width: 100%;
    padding: 23px 0;
    padding-top: 30px;
    text-align: center;
    cursor: pointer;
    user-select: none;
  }

  .title {
    font-size: 48px;
    margin-bottom: 20px;
  }

  .products {
    padding-bottom: 40px;
  }
  .product-item {
    display: flex;
    align-items: flex-start;
    margin-bottom: 40px;
  }

  .image {
    height: 86px;
    width: 86px;
    background: url('~/store/product-image.png') center no-repeat / cover;
  }

  .descr {
    color: #000;
    line-height: 35px;
    font-size: 24px;
    text-align: left;
    text-transform: uppercase;

    width: 96px;
    margin-top: -5px;
    margin-left: 20px;
  }

  .color-size {
    opacity: 0.5;
  }

  .price {
    font-size: 24px;
    margin-left: 20px;
  }


  .order-form {
    display: flex;
    flex-flow: column nowrap;

    input {
      opacity: 0.8;
      font-family: 'DIN Condensed';
      color: #000;
      border: 2px solid #BDBDBD;
      outline: none;
      margin-bottom: 20px;
      font-size: 20px;
      padding: 11px 0 6px 15px;

      &::placeholder {
        color: #BDBDBD;
      }

    }
  }

input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
}

</style>
