<template>
  <section class="store">
    <Header :productCount="productCount" :productSum="productSum"/>
    <Checkout :isOpen="$store.state.isCheckoutOpen" />
    <u-animate
      name="fadeIn"
      delay="0s"
      duration="0.4s"
      :iteration="1"
      :offset="0"
      animateClass="animated"
      :begin="true"
    >
      <div class="tags">
        <div class="tags-title">{{ locale === 'en' ? 'CATEGORIES' : 'КАТЕГОРИИ'}}</div>
        <div class="tags-item">
          <div class="tag" v-for="(category, index) in categories" :key="index" @click="filterByCategory(category)">
            #{{category}}
          </div>
        </div>
      </div>
    </u-animate>
    <transition name="fade">
      <div class="hint" v-if="isHintVisible && $store.state.hintWasShowedOnce < 1">
        <div class="hint-icon" />
        <span>"{{ $store.state.last }}"</span> {{ locale === 'en' ? 'has been added to the cart.' : 'добавлено в корзину.'}}
      </div>
    </transition>

    <div class="container" :class="{'isAnimating': isChanging}">
      <u-animate
        name="fadeInUp"
        delay="0s"
        duration="0.4s"
        :iteration="1"
        :offset="0"
        animateClass="animated"
        :begin="true"
      >
        <span @click="$store.commit('toggleCheckout')" class="checkout">{{ productCount }} {{ locale === 'en' ? 'items' : 'товаров' }} — $ {{ productSum }}</span>
        <div class="title">
          STORE
          <span @click="$store.commit('toggleCheckout')">{{ productCount }} {{ locale === 'en' ? 'items' : 'товаров' }} — $ {{ productSum }}</span>
        </div>
      </u-animate>

      <u-animate
        name="fadeInUp"
        delay="0.2s"
        duration="0.4s"
        :iteration="1"
        :offset="0"
        animateClass="animated"
        :begin="true"
      >
        <div class="news-list">
          <masonry
            v-if="filteredGoods.length === 0"
            :cols="{default: 3, 1024: 2, 425: 1}"
            :gutter="{default: '60px', 768: '40px', 425: '0px'}"
            ref="my-masonry">
            <div class="item" v-for="(item, index) in store" :key="index">
              <nuxt-link :to="'/store/' + index">
                <div class="item-image"
                  :style="{background: `url(${ 'http://' + item.preview.fields.file.url.slice(2) }) no-repeat center / cover`}" />
                <div class="item-category">{{ item.category }}</div>
                <div class="item-title" v-html="item.title"></div>
                <div class="item-footer">
                  <div class="item-style">{{ item.style }}</div>
                  <div class="item-price">$ {{ item.price }}</div>
                </div>
              </nuxt-link>
            </div>
          </masonry>
          <masonry
            :cols="{default: 3, 1024: 2, 425: 1}"
            :gutter="{default: '60px', 768: '40px', 425: '0px'}"
            ref="my-masonry">
            <div class="item" v-for="(item, index) in filteredGoods" :key="index">
              <nuxt-link :to="'/store/' + findItemByTitle(item.title)">
                <div class="item-image"
                  :style="{background: `url(${ 'http://' + item.preview.fields.file.url.slice(2) }) no-repeat center / cover`}" />
                <div class="item-category">{{ item.category }}</div>
                <div class="item-title" v-html="item.title"></div>
                <div class="item-footer">
                  <div class="item-style">{{ item.style }}</div>
                  <div class="item-price">$ {{ item.price }}</div>
                </div>
              </nuxt-link>
            </div>
          </masonry>
        </div>
      </u-animate>
    </div>
    <u-animate
      name="fadeInUp"
      delay="0.4s"
      duration="0.4s"
      :iteration="1"
      :offset="0"
      animateClass="animated"
      :begin="true"
    >
      <Footer />
    </u-animate>
  </section>
</template>

<script>
  export default {
    data () {
      return {
        filteredGoods: [],
        isChanging: false,
        isHintVisible: false
      }
    },

    head () {
      return {
        title: this.meta.title,
        meta: [
          { name: 'description', content: this.meta.description },
          { name: 'keywords', content: this.meta.keywords },
          { hid: 'og:type', property: 'og:type', content: 'article'},
          { hid: 'og:url', property: 'og:url', content: this.meta.facebook_url },
          { hid: 'og:image', property: 'og:image', content: this.meta.facebook_image },
          { hid: 'og:title', property: 'og:title', content: this.meta.facebook_title },
          { hid: 'og:description', property: 'og:description', content: this.meta.facebook_description },
        ]
      }
    },

    computed: {
      meta () {
        return this.$store.state.meta[this.$store.state.locale][this.$route.name]
      },

      productCount () {
        return this.$store.state.checkoutList.length
      },

      productSum () {
        const products = this.$store.state.checkoutList
        let sum = 0
        if (this.productCount > 0) {
          return (
            products.reduce((acc, p) => {
              return acc + p.price
            }, 0)
          )
        } else {
          return 0
        }
      },
      categories () {
        return [ ...new Set(this.store.map(item => item.category)) ]
      },

      store () {
        return this.$store.state.entities.store
      },

      locale () {
        return this.$store.state.locale
      }
    },

    methods: {
      filterByCategory (category) {
        this.filteredGoods = []
        this.store.map((item, index) => {
          if (category === item.category) {
            this.filteredGoods.push(item)
          }
        })
      },

      findItemByTitle (title) {
        let result
        this.store.map((item, index) => {
          if (item.title === title) {
            result = index
          }
        })

        return result
      }
    },

    mounted () {
      this.isChanging = false

      if (this.$store.state.last !== '') {
        this.isHintVisible = true

        setTimeout(() => {
          this.isHintVisible = false
          this.$store.commit('isHintShowed', 1)
        }, 4000)
      }
    },

    beforeRouteLeave(to, from, next) {
      this.isChanging = true
      setTimeout(() => next(), 300)
    },

    components: {
      Header: () => import('@/components/Header'),
      Checkout: () => import('@/components/Checkout'),
      Footer: () => import('@/components/Footer')
    }
  }
</script>

<style lang="scss" scoped>
  .transform-animation-enter-active, .transform-animation-leave-active {
    transition: transform .5s ease-in;
  }

  .transform-animation-leave-to {
    transform: translateY(110%);
  }

  .transform-animation-enter {
    transform: translateY(-110%);
  }

  .store {
    background: linear-gradient(216.25deg, #565656 0%, #000000 100%), #683FFF;
    padding: 200px 0 80px;
    height: 100%;

    min-height: 100vh;
    display: flex;
    flex-flow: column nowrap;
  }

  a {
    text-decoration: none;
  }

  .container {
    position: relative;
    padding: 0 100px;
    flex: 1;
    padding-left: 320px;
    transition: transform .4s ease, opacity .4s ease;
    will-change: transform, opacity;
  }

  .tags {
    position: fixed;
    top: 280px;
    left: 100px;
    z-index: 10;
  }

  .tags-title {
    margin-bottom: 10px;
    font-family: 'DIN Condensed', sans-serif;
    font-style: normal;
    font-weight: bold;
    line-height: normal;
    font-size: 20px;
    text-transform: uppercase;
    color: #E0E0E0;
  }

  .tag {
    margin-bottom: 10px;
    font-family: 'DIN Condensed', sans-serif;
    font-style: normal;
    font-weight: bold;
    line-height: normal;
    font-size: 20px;
    text-transform: uppercase;
    color: #FFFFFF;
    cursor: pointer;
  }

  .title {
    font-family: 'DIN Condensed', sans-serif;
    font-style: normal;
    font-weight: bold;
    line-height: 60px;
    font-size: 48px;
    text-transform: uppercase;
    color: #FFFFFF;
    margin-bottom: 20px;

    display: flex;
    flex-flow: row nowrap;
    justify-content: space-between;
    align-items: center;
  }

  .title span,
  .checkout {
    cursor: pointer;
    font-family: 'DIN Condensed', sans-serif;
    font-style: normal;
    font-weight: bold;
    line-height: normal;
    font-size: 20px;
    text-align: right;
    text-transform: uppercase;
    color: #FFFFFF;
  }

  .checkout {
    display: none;
  }

  .product-list {
    margin-bottom: 100px;
  }

  .item {
    margin-bottom: 40px;
    cursor: pointer;
    max-width: 300px;

    &:hover .item-title {
      box-shadow:  0 -4px 0 0 #FFF inset;
    }
  }

  .item-category {
    font-family: 'DIN Condensed', sans-serif;
    font-style: normal;
    font-weight: bold;
    line-height: 35px;
    font-size: 24px;
    text-transform: uppercase;
    color: rgba(255, 255, 255, 0.8);
  }

  .item-image {
    width: 100%;
    height: 180px;
    margin-bottom: 20px;
  }

  .item-title {
    font-family: 'DIN Condensed', sans-serif;
    font-style: normal;
    font-weight: bold;
    line-height: 52px;
    font-size: 36px;
    text-transform: uppercase;
    color: #FFFFFF;

    display: inline;
    box-shadow: 0 0px 0 0 transparent inset;
    transition: box-shadow .1s ease-in;
    will-change: box-shadow;
  }

  .item-footer {
    display: flex;
    flex-flow: row nowrap;
    justify-content: space-between;
    align-items: center;
  }

  .item-style {
    font-family: 'DIN Condensed', sans-serif;
    font-style: normal;
    font-weight: bold;
    line-height: 52px;
    font-size: 36px;
    text-transform: uppercase;
    color: rgba(255, 255, 255, 0.8);
  }

  .item-price {
    font-family: 'DIN Condensed', sans-serif;
    font-style: normal;
    font-weight: bold;
    line-height: 52px;
    font-size: 36px;
    text-align: right;
    text-transform: uppercase;
    color: #FFFFFF;
  }

  .hint {
    position: fixed;
    left: 100px;
    bottom: 100px;
    max-width: 324px;
    width: 100%;
    padding: 30px;
    background: #000000;
    font-weight: 500;
    line-height: 25px;
    font-size: 18px;
    color: #FFFFFF;
    z-index: 10;

    span {
      text-transform: uppercase;
    }
  }

  .hint-icon {
    background: url('~/assets/images/info.svg') no-repeat center / contain;
    height: 20px;
    width: 20px;
    margin-bottom: 10px;
  }

  @media (max-width: 1024px) {

    .container {
      padding-left: 100px;

      display: flex;
      flex-flow: row wrap;
      justify-content: space-between;
    }

    .news-list {
      margin-top: 40px;
      margin-bottom: 60px;
      flex: 0 0 100%;
    }

    .title {
      flex: 1;

      span {
        display: none;
      }
    }

    .tags {
      padding-left: 60px;
      flex: 1;
      position: initial;
      display: flex;
      flex-flow: column nowrap;
      justify-content: space-between;
      margin-left: 43px;
      margin-top: 32px;
    }

    .tags-item {
      flex: 1;
      display: flex;
      flex-flow: column wrap;
      max-height: 105px;

      &:first-child {
        margin-left: 20px;
        // margin-right: 60px;
      }
    }

    .tags-country {
      margin-top: 0;
    }
  }

  @media (max-width: 425px) {
    .hint {
      left: 0;
      bottom: -1px;
      width: 100%;
      max-width: initial;
    }

    .store {
      height: auto;
      min-height: auto;
    }

    .container {
      padding: 0 30px;
      display: block;
    }

    .checkout {
      display: block;
      margin-bottom: 30px;
      text-align: left;
    }

    .video-item {
      margin-bottom: 20px;
    }

    .tags {
      padding: 0 30px;
      margin-bottom: 50px;
      margin-left: 0;
    }

    .tags-item {
      margin-left: 0;
    }
  }
</style>
