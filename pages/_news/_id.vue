<template>
  <section class="news">
    <Header />
    <div class="container">
      <nuxt-link to="/news/" class="back">back to news</nuxt-link>
      <div class="left">
        <div class="title">Sochi, closing of the<br /> season 2017 RDS</div>
        <div class="article">
          <div class="info">
            <div class="date">DEC 9 — 2017</div>
            <div class="tags">
              <div class="tag">#EVENTS</div>
              <div class="tag">#RDS2018</div>
            </div>
          </div>
          <div class="subtitle">Donec a tellus malesuada, gravida ligula sit amet, scelerisque neque.</div>
          <div class="text">Duis eget efficitur ipsum, eget porttitor sapien. Proin justo est, tempus in sollicitudin ut, hendrerit non metus. Fusce volutpat mattis lorem, ac posuere lorem consequat accumsan.</div>
          <div class="text">Praesent tempor, turpis sit amet auctor placerat, eros nisl viverra lorem, vel laoreet velit metus vel augue.</div>
          <div class="img-fullwidth">
            <img src="/news/news-1.jpg" />
          </div>
        </div>
      </div>
      <div class="right">
        <div class="previous-article">
          <div class="previous-title">Previous news</div>
          <div class="previous">
            <div class="previous-image" />
            <div class="previous-date">JAN 30 — 2016</div>
            <div class="previous-subtitle">Life of championships<br> Chaper 5</div>
            <div class="previous-preview">
              Phasellus semper vehicula ornare. Donec ante ipsum, maximus ac auctor in, dapibus nec lorem.
            </div>
            <div class="previous-tags">
              <div class="previous-tag">#VIDEO</div>
            </div>
          </div>
          <div class="previous">
            <div class="previous-image" />
            <div class="previous-date">JAN 30 — 2016</div>
            <div class="previous-subtitle">Life of championships<br> Chaper 5</div>
            <div class="previous-preview">
              Phasellus semper vehicula ornare. Donec ante ipsum, maximus ac auctor in, dapibus nec lorem.
            </div>
            <div class="previous-tags">
              <div class="previous-tag">#VIDEO</div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <Footer />
  </section>
</template>

<script>
  export default {
    data () {
      return {

      }
    },

    methods: {

    },

    mounted () {

    },

    components: {
      Header: () => import('@/components/Header'),
      Footer: () => import('@/components/Footer')
    },

    validate ({ params }) {
      // Must be a number
      return /^\d+$/.test(params.id)
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

    display: flex;
    flex-flow: row nowrap;
    align-content: center;
  }

  .left {
    padding-left: 220px;
    padding-bottom: 100px;
    flex: 0 0 60%;

    display: flex;
    flex-flow: column nowrap;
  }

  .right {
    flex: 0 0 40%;
    display: flex;
    flex-flow: column nowrap;
    position: relative;
  }

  .article {
    max-width: 435px;
  }

  .previous-article {
    // position: fixed;
    // top: 200px;
    padding-left: 50px;
    max-width: 350px;
  }

  .back {
    position: absolute;
    left: 100px;
    top: 0px;
  }

  .info {
    display: flex;
    flex-flow: row nowrap;
    align-items: center;
    margin-bottom: 20px;
  }

  .tags {
    display: flex;
    flex-flow: row nowrap;
    align-items: center;
  }

  .date {
    margin-right: 40px;
  }

  .tag:first-child {
    margin-right: 10px;
  }

  .date,
  .tag,
  .back {
    font-family: 'DIN Condensed', sans-serif;
    font-style: normal;
    font-weight: bold;
    line-height: 35px;
    font-size: 24px;
    text-transform: uppercase;
    color: rgba(255, 255, 255, 0.8);
  }

  .back {
    text-decoration: none;
    color: #FFF;
    cursor: pointer;
  }

  .title {
    margin-bottom: 10px;
    font-family: 'DIN Condensed', sans-serif;
    font-style: normal;
    font-weight: bold;
    line-height: normal;
    font-size: 64px;
    text-transform: uppercase;
    color: #FFFFFF;
  }

  .subtitle {
    margin-bottom: 20px;
    font-family: 'DIN Pro', sans-serif;
    font-style: normal;
    font-weight: bold;
    line-height: 37px;
    font-size: 24px;
    color: #FFFFFF;
  }

  .text {
    margin-bottom: 20px;
    font-family: 'DIN Pro', sans-serif;
    font-style: normal;
    font-weight: 500;
    line-height: 28px;
    font-size: 18px;
    color: rgba(255, 255, 255, 0.8);
  }

  .img-fullwidth img {
    height: auto;
    width: 100%;
    max-width: 100%;
  }

  .previous-title {
    margin-bottom: 5px;
    font-family: 'DIN Condensed', sans-serif;
    font-style: normal;
    font-weight: bold;
    line-height: 45px;
    font-size: 36px;
    text-transform: uppercase;
    color: #FFFFFF;
  }

  .previous {
    margin-bottom: 40px;
  }

  .previous-image {
    margin-bottom: 20px;
    height: 169px;
    width: 100%;
    background: url('/news/news-3.jpg') no-repeat center / cover;
  }

  .previous-date {
    margin-bottom: 5px;
    font-family: 'DIN Condensed', sans-serif;
    font-style: normal;
    font-weight: bold;
    line-height: 35px;
    font-size: 24px;
    text-transform: uppercase;
    color: rgba(255, 255, 255, 0.8);
  }

  .previous-subtitle {
    margin-bottom: 5px;
    font-family: 'DIN Condensed', sans-serif;
    font-style: normal;
    font-weight: bold;
    line-height: 52px;
    font-size: 36px;
    text-transform: uppercase;
    color: #FFFFFF;
  }

  .previous-preview {
    margin-bottom: 20px;
    font-family: 'DIN Pro', sans-serif;
    font-style: normal;
    font-weight: 500;
    line-height: 28px;
    font-size: 18px;
    color: rgba(255, 255, 255, 0.8);
  }

  .previous-tags {
    display: flex;
    flex-flow: row wrap;
    align-items: center;
  }

  .previous-tag {
    font-family: 'DIN Condensed', sans-serif;
    font-style: normal;
    font-weight: bold;
    line-height: 29px;
    font-size: 20px;
    text-transform: uppercase;
    color: #FFFFFF;
  }

  @media (max-width: 768px) {
    .back {
      display: none;
    }

    .container {
      display: block;
    }

    .left {
      padding-left: 0;
      padding-bottom: 0;
      margin-bottom: 50px;
    }

    .right {
      padding-bottom: 10px;
    }

    .article {
      max-width: initial;
    }

    .previous-article {
      padding-left: 0;
      max-width: initial;
      display: flex;
      flex-flow: row wrap;
      justify-content: space-between;
    }

    .previous-title {
      flex: 0 0 100%;
    }

    .previous {
      flex: 0 0 46%;
    }

    .previous-subtitle br {
      display: none;
    }
  }

  @media (max-width: 425px) {
    .news {
      padding-top: 180px;
    }

    .container {
      padding: 0 50px;
    }

    .back {
      display: block;
      position: initial;
      margin-bottom: 20px;
    }

    .title {
      margin-bottom: 10px;
      font-family: 'DIN Condensed', sans-serif;
      font-style: normal;
      font-weight: bold;
      line-height: normal;
      font-size: 36px;
      text-transform: uppercase;
      color: #FFFFFF;
    }

    .subtitle {
      font-family: 'DIN Pro', sans-serif;
      font-style: normal;
      font-weight: bold;
      line-height: 28px;
      font-size: 18px;
      color: #FFFFFF;
    }

    .tags {
      display: none;
    }

    .date {
      margin-bottom: 0px;
    }

    .previous {
      flex: 0 0 100%;
    }
  }
</style>
