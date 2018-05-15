<template>
  <section class="news">
    <Header />
    <div class="container">
      <span class="checkout">0 items — $ 0.00</span>
      <div class="title">
        STORE
        <span>0 items — $ 0.00</span>
      </div>
      <div class="tags">
        <div class="tags-item">
          <div class="tags-title">CATEGORIES</div>
          <div class="tag" v-for="(category, index) in categories" :key="index" @click="filterByCategory(category)">
            #{{category}}
          </div>
        </div>
      </div>
      <div class="news-list">
        <masonry
          :cols="{default: 3, 1024: 2, 425: 1}"
          :gutter="{default: '60px', 768: '40px', 425: '0px'}"
          ref="my-masonry">
          <div class="item" v-for="(item, index) in filteredGoods" :key="index">
            <div class="item-image"
              :style="{background: `url(${ item.image }) no-repeat center / cover`}" />
            <div class="item-category">{{ item.category }}</div>
            <div class="item-title" v-html="item.title"></div>
            <div class="item-footer">
              <div class="item-style">{{ item.style }}</div>
              <div class="item-price">$ {{ item.price }}</div>
            </div>
          </div>
        </masonry>
      </div>
    </div>
    <Footer />
  </section>
</template>

<script>
  export default {
    data () {
      return {
        filteredGoods: [],
        goods: [
          {
            category: 'T-SHIRTS',
            style: 'WHITE',
            title: 'DRIFT IS MY THERAPY <br> men t-shirt',
            image: '/store/store-1.jpg',
            price: 100
          },
          {
            category: 'T-SHIRTS',
            style: 'BLACK',
            title: 'FUCKING HERO STYLE <br> men t-shirt',
            image: '/store/store-2.jpg',
            price: 25
          },
          {
            category: 'T-SHIRTS',
            style: 'WHITE',
            title: 'BOOST ME <br> men t-shirt',
            image: '/store/store-3.jpg',
            price: 19
          },
          {
            category: 'T-SHIRTS',
            style: 'WHITE',
            title: 'DRIFT IS MY THERAPY <br> men t-shirt',
            image: '/store/store-4.jpg',
            price: 14
          },
          {
            category: 'T-SHIRTS',
            style: 'BLACK',
            title: 'FUCKING HERO STYLE <br> men t-shirt',
            image: '/store/store-5.jpg',
            price: 25
          },
          {
            category: 'T-SHIRTS',
            style: 'WHITE',
            title: 'BOOST ME <br> men t-shirt',
            image: '/store/store-6.jpg',
            price: 17
          },
        ],
      }
    },

    computed: {
      categories () {
        return [ ...new Set(this.goods.map(item => item.category)) ]
      }
    },

    methods: {
      filterByCategory (category) {
        this.filteredGoods = []
        this.goods.map((item, index) => {
          if (category === item.category) {
            this.filteredGoods.push(item)
          }
        })
      }
    },

    mounted () {
      this.filteredGoods = this.goods
    },

    components: {
      Header: () => import('@/components/Header'),
      Footer: () => import('@/components/Footer')
    }
  }
</script>

<style lang="scss" scoped>
  .news {
    background: #683FFF;
    padding: 200px 0 80px;
  }

  .container {
    position: relative;
    padding: 0 100px;

    padding-left: 320px;
  }

  .tags {
    position: fixed;
    top: 280px;
    left: 100px;
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

  .news-list {
    margin-bottom: 100px;
  }

  .item {
    margin-bottom: 40px;
    cursor: pointer;
    max-width: 300px;
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

  @media (max-width: 768px) {
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
      flex: 1;
      position: initial;
      display: flex;
      flex-flow: row nowrap;
      justify-content: space-between;
    }

    .tags-item {
      flex: 1;

      &:first-child {
        margin-left: 20px;
        margin-right: 60px;
      }
    }

    .tags-country {
      margin-top: 0;
    }
  }

  @media (max-width: 425px) {
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
      margin-bottom: 50px;
    }

    .tags-item:first-child {
      margin-left: 0;
    }
  }
</style>
