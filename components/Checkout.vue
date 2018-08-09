<template>
  <div class="checkout" :class="{'checkout--opened': isOpen}">
      <div class="left" @click="$store.commit('toggleCheckout')" />
      <div class="right">
        <div class="right-wrapper">
          <div class="title">
            {{ this.isOrder ? (locale === 'en' ? 'CHECKOUT' : 'ОФОРМЛЕНИЕ ЗАКАЗА') : (locale  === 'en' ? 'CART' : 'КОРЗИНА')}}
          </div>
          <div class="products" v-if="!isOrder">
            <div class="product-item" v-for="(product, index) in checkoutList" :key="index">
              <div class="delete" @click="$store.commit('removeProductFromCart', product.id)"/>
              <div class="image" :style="{background: `url(${ 'http://' + product.preview.fields.file.url.slice(2) }) no-repeat center / cover`}" />
              <div class="descr-wrapper">
                <div class="descr">
                  <div class="name">{{product.title}} {{ product.category}} </div>
                  <div class="color-size">{{ product.style }} — {{product.sizes}}</div>
                </div>
                <div class="price">$ {{product.price}}</div>
              </div>
            </div>
          </div>
            <form v-if="this.isOrder">
              <div class="input-wrapper">
                <div class="input-label"> {{ locale === 'en' ? 'NAME' : 'ИМЯ' }} </div>
                <input  v-model="customer.name" type="text" placeholder="Sylvester Stallone" name="name"/>
              </div>
              <div class="input-wrapper">
                <div class="input-label"> {{ locale === 'en' ? 'EMAIL' : 'EMAIL' }} </div>
                <input v-model="customer.email" type="email" placeholder="firstblood@rambo.com" name="email"/>
              </div>
              <div class="input-wrapper">
                <div class="input-label"> {{ locale === 'en' ? 'ADRESS' : 'АДРЕС' }} </div>
                <input  v-model="customer.address" type="text" placeholder="Vietnam, jungle" name="address"/>
              </div>
              <div class="input-inner">
                <div class="input-wrapper small">
                  <div class="input-label"> {{ locale === 'en' ? 'ZIP CODE' : 'ИНДЕКС' }} </div>
                  <input v-model="customer.zip" type="number" placeholder="765200" name="zip"/>
                </div>
                <div class="input-wrapper small">
                  <div class="input-label"> {{ locale === 'en' ? 'PHONE' : 'ТЕЛЕФОН' }} </div>
                  <input v-model="customer.phone" type="tel" placeholder="+7 999 999 99 99" name="phone"/>
                </div>
              </div>
            </form>
        </div>
        <div class="button-wrapper" v-if="!isOrder">
          <div class="order" @click="$store.commit('toggleCheckout')" >{{(locale === 'en' ? 'back to catalog' : 'вернуться в каталог')}}</div>
          <div class="order blacked" @click="isOrder = true" >{{(locale === 'en' ? 'checkout' : 'оформить заказ')}}</div>
        </div>
        <div class="button-wrapper" v-if="isOrder">
          <div class="order" @click="isOrder = false">{{(locale === 'en' ? 'back to cart' : 'Вернуться в корзину')}}</div>
          <div @click="postFormData" class="order blacked">{{(locale === 'en' ? 'send' : 'отправить')}}</div>
        </div>
      </div>
  </div>
</template>

<script>
import axios from 'axios'
  export default {
    props: ['isOpen'],

    data () {
      return {
        isOrder: false,
        customer: {
          name: '',
          email: '',
          address: '',
          zip: '',
          phone: ''
        }
      }
    },

    computed: {
      checkoutList () {
        return this.$store.state.checkoutList
      },

      locale () {
        return this.$store.state.locale
      }
    },

    methods: {
      postFormData () {
        axios.post('/checkout.php', {
          ...this.customer,
          products: JSON.stringify(this.checkoutList)
        },
        {
          'Content-Type': 'application/x-www-form-urlencoded'
        }
        )
        .then(function (response) {
          // eslint-disable-next-line
          console.log(response)
        })
        .catch(function (error) {
          // eslint-disable-next-line
          console.log(error)
        })
      }
    }
  }
</script>

<style lang="scss" scoped>
  .checkout {
    z-index: 10000;
    position: fixed;
    display: flex;
    height: 100%;
    width: 100%;
    right: 0;
    top: 0;
    pointer-events: none;
    transform: translateY(-100%);

    &.checkout--opened {
      pointer-events: initial;
      transform: translateY(0%);
    }
  }

  .left {
    cursor: pointer;
    background: rgba(51, 51, 51, .6);
    height: 100%;
    width: calc(100% - 350px);
  }

  .right {
    position: relative;
    height: 100%;
    flex: 0 0 460px;
    background: #FAFAFA;

    display: flex;
    flex-flow: column nowrap;
    justify-content: space-between;

    font-family: 'DIN Condensed';
    color: #000000;
    text-align: left;
    overflow-y: scroll;
  }

  .right-wrapper {
    // height: 100%;
    padding: 0 40px;
    padding-top: 80px;
  }

  .delete {
    position: absolute;
    top: 0;
    right: 0;
    width: 24px;
    height: 24px;
    background: url('~/assets/images/delete.svg') no-repeat center / contain;
  }

  .button-wrapper {
    display: flex;
    width: 100%;
  }

  .order {
    background: #fff;
    text-transform: uppercase;
    position: relative;
    width: 50%;
    padding: 23px 0;
    padding-top: 30px;
    text-align: center;
    cursor: pointer;
    user-select: none;
  }

  .blacked {
    background: linear-gradient(196.26deg, #565656 0%, #000000 100%);
    text-transform: uppercase;
    color: #FFFFFF;
  }

  .title {
    font-size: 48px;
    margin-bottom: 20px;
  }

  .products {
    width: 100%;
    padding-bottom: 40px;
  }
  .product-item {
    position: relative;
    width: 100%;
    display: flex;
    align-items: flex-start;
    margin-bottom: 40px;
  }

  .image {
    height: 86px;
    width: 86px;
    background: url('~/store/product-image.png') center no-repeat / cover;
  }

  .descr-wrapper {
    display: flex;
    width: calc(100% - 86px);
  }

  .descr {
    flex: 1;
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
    align-self: flex-end;
    font-size: 24px;
    margin-left: 20px;
  }

  .input-label {
    font-size: 13px;
  }

  .input-wrapper {
    width: 100%;
  }

  .input-inner {
    width: 100%;
    display: flex;
    flex-flow: row wrap;
    justify-content: space-between;
  }

  .small {
    width: calc(50% - 10px);
  }

  .order-form {
    display: flex;
    flex-flow: column nowrap;
  }
  
    input {
      opacity: 0.8;
      font-family: 'DIN Condensed';
      color: #000;
      border: none;
      background: transparent;
      border-bottom: 2px solid #000;
      outline: none;
      margin-bottom: 20px;
      font-size: 20px;
      width: 100%;
      -webkit-appearance: none;
      -moz-appearance: textfield;
      &::placeholder {
        color: #BDBDBD;
        text-transform: uppercase;
      }

    }


  input::-webkit-outer-spin-button,
  input::-webkit-inner-spin-button {
      -webkit-appearance: none;
      -moz-appearance: none;
      margin: 0;
  }

@media (max-width: 1024px) {
  .product-item {
    // max-width: 286px;
    padding-right: 0;
    flex-wrap: wrap;
    justify-content: space-between;
  }

  .close {
    display: block;
  }

  .title {
    display: flex;
    flex-flow: row nowrap;
    justify-content: space-between;
  }

  .descr-wrapper {
    width: 100%;
  }

  .price {
    align-self: flex-start;
  }

  .descr {
    margin-left: 0;
    width: 70%;
  }

  .image {
    margin-bottom: 20px;
    margin-right: 10px;
  }

  .right {
    width: 100%;
    transform: translateX(100%);
    transition: transform .2s ease;
    will-change: transform;
  }

  .left {
    width: calc(100% - 300px);
    opacity: 0;
    transition: opacity .2s ease;
    will-change: opacity;
  }
  .checkout {
    transform: translateY(0%);
  }

  .checkout--opened {
    .left {
      opacity: 1;
    }

    .right {
      transform: translateX(0%);
    }
  }
}

@media (max-width: 425px) {
  .checkout {
    transition: transform .3s ease;
    will-change: transform;
  }

  .small {
    width: 100%;
  }

  .close {
    display: block;
  }

  .left {
    display: none;
  }

  .right {
    flex: 0 0 100%;
  }
  .title {
    display: flex;
    flex-flow: row nowrap;
    justify-content: space-between;
  }
}
</style>
