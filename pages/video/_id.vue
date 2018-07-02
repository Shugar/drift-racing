<template>
  <section class="calendar" ref="mySubComponent">
    <Header />
    <div class="wrappe">

      <div class="title-wrapper">
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
            <div class="tags-item">
              <div class="tag"><nuxt-link to="/video/" >{{locale === 'en' ? 'back to videos' : 'назад к видео'}}</nuxt-link></div>
            </div>
          </div>
        </u-animate>
      </div>
      <div class="container">
        <div class="left">
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
              <div class="tags-item">
                <div class="tag"><nuxt-link to="/video/">{{locale === 'en' ? 'back to videos' : 'назад к видео'}}</nuxt-link></div>
              </div>
            </div>
          </u-animate>
          
          <div class="article">
            <u-animate
              name="fadeInUp"
              delay="0s"
              duration="0.4s"
              :iteration="1"
              :offset="0"
              animateClass="animated"
              :begin="true"
            >
              <div class="info">
                <div class="date">{{ video.date }}</div>
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
              <div class="title">{{ video.title }}</div>
            </u-animate>
            <u-animate
              name="fadeInUp"
              delay="0.4s"
              duration="0.4s"
              :iteration="1"
              :offset="0"
              animateClass="animated"
              :begin="true"
            >
              <div class="video-wrapper">
                <iframe width="100%" height="100%" :src="video.videoSource.replace('watch?v=', '/embed/')" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
              </div>
              <div class="text">{{ video.text }}</div>
            </u-animate>
          </div>
        <div class="right mobile">
          <div class="previous-article">
            <div class="previous-title">{{ previous.length > 0 ? (locale === 'en' ? 'Previous videos' : 'Предыдущие видео') : '' }}</div>
            <nuxt-link class="previous" v-for="(item, index) in previous"  :to="'/video/' + findItemByTitle(item.title)" :key="index">
              <div class="previous-image" :style="{background: `url(http://${item.video.fields.file.url.slice(2)}) no-repeat center / cover`}" />
              <div class="previous-date">{{ item.date }}</div>
              <div class="previous-subtitle">{{ item.title }}</div>
            </nuxt-link>
          </div>
        </div>
        </div>
      </div>
    </div>
    <u-animate
      name="fadeInUp"
      delay="0.6s"
      duration="0.4s"
      :iteration="1"
      :offset="0"
      animateClass="animated"
      :begin="true"
    >
      <Footer :propMeta="{
        title: this.video.title,
        description: this.video.text,
        keywords: this.video.keywords,
        facebook_image: `http://${this.video.video.fields.file.url.slice(2)}`,
        facebook_title: this.video.title,
        facebook_description: this.video.text
      }" />
    </u-animate>
  </section>
</template>

<script>
  export default {
    data () {
      return {
        isChanging: false
      }
    },

    head () {
      return {
        title: this.video.title,
        meta: [
          { name: 'description', content: this.video.text },
          { name: 'keywords', content: this.video.keywords },
          { hid: 'og:type', property: 'og:type', content: 'article'},
          { hid: 'og:url', property: 'og:url', content: this.url },
          { hid: 'og:image', property: 'og:image', content: `http://${this.video.video.fields.file.url.slice(2)}` },
          { hid: 'og:title', property: 'og:title', content: this.video.title },
          { hid: 'og:description', property: 'og:description', content: this.video.text },
        ]
      }
    },


    methods: {
      findItemByTitle (title) {
        let result
        this.$store.state.entities.video.map((item, index) => {
          if (item.title === title) {
            return result = index
          }
        })

        return result
      }
    },

    computed: {
      video () {
        return this.$store.state.entities.video[this.$route.params.id]
      },

      previous () {
        const array = this.$store.state.entities.video.map(article => {
          return {
            ...article,
            tags: article.championship.replace(' ', '').split(',')
          }
        })
        if (this.$route.params.id > 1) {
          return [
            array[this.$route.params.id - 1],
            array[this.$route.params.id - 2]
          ]
        } else if (this.$route.params.id > 0  ) {
          return [ array[0] ]
        } else {
          return []
        }
      },
      locale () {
        return this.$store.state.locale
      }
    },

    components: {
      Header: () => import('@/components/Header'),
      Footer: () => import('@/components/Footer')
    },

    mounted () {
      this.isChanging = false
    },

    watch: {
      '$route' (to, from) {
        this.isChanging = true
      }
    },

    validate ({ params }) {
      // Must be a number
      return /^\d+$/.test(params.id)
    }
  }
</script>

<style lang="scss" scoped>
  .calendar {
    min-height: 100vh;
    background: linear-gradient(216.25deg, #565656 0%, #000000 100%), #683FFF;
    padding: 200px 0 80px;
  }

  .container {
    position: relative;
    padding: 0 100px;

    display: flex;
    flex-flow: row nowrap;
    align-content: center;
  }

  .wrapper {
    transition: transform .4s ease, opacity .4s ease;
    will-change: transform, opacity;
  }

  .title-wrapper {
    padding: 0 100px;

    display: flex;
    flex-flow: row nowrap;
    align-content: center;

    .tags {
      display: none;
    }
  }

  .left {
    padding-left: 220px;
    padding-bottom: 100px;
    flex: 0 0 80%;

    display: flex;
    flex-flow: column nowrap;
  }

  .right {
    flex: 0 0 40%;
    display: flex;
    flex-flow: column nowrap;
    position: relative;
  }

  .mobile {
    display: none;
  }

  .article {
    width: 100%;
    margin-bottom: 40px;

    .title {
      padding: 0;
      margin-bottom: 10px;
    }
  }

  .previous-article {
    // position: fixed;
    // top: 200px;
    padding-left: 50px;
    max-width: 350px;
  }

  .previous-title {
    margin-bottom: 20px;
    min-height: 20px;
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
    flex-flow: column nowrap;
    justify-content: center;

    &-item {
      &:first-child {
        margin-bottom: 40px;
      }
    }
  }

  .date {
    margin-right: 40px;
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

  .tags {
      position: fixed;
      top: 198px;
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
    cursor: pointer;
    a {
      color: #FFFFFF;
      text-decoration: none;
    }
  }

  .title {
    margin-bottom: 30px;
    padding-left: 220px;
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
    font-family: 'DIN Pro Medium', sans-serif;
    font-style: normal;
    font-weight: bold;
    line-height: 37px;
    font-size: 24px;
    color: #FFFFFF;
  }

  .text {
    margin-bottom: 20px;
    font-family: 'DIN Pro Medium', sans-serif;
    font-style: normal;
    font-weight: 500;
    line-height: 28px;
    font-size: 18px;
    max-width: 480px;
    color: rgba(255, 255, 255, 0.8);
  }

  .video-wrapper {
    height: 432px;
    width: 100%;
    max-width: 100%;
    margin-bottom: 20px;
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
    // background: url('/news/news-2.jpg') no-repeat center / cover;
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
    font-family: 'DIN Pro Medium', sans-serif;
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



  @media (max-width: 1024px) {
    .video-wrapper {
      height: 270px;
    }

    .tag {
      display: none;
    }
  }

  @media (max-width: 768px) {
    .back {
      display: none;
    }

    .container {
      display: block;
    }

    .mobile {
      display: block;
    }

    .title-wrapper {
      justify-content: space-between;
      margin-bottom: 0px;

      .tags {
        display: none;
        flex-flow: row nowrap;
        align-items: flex-start;
        position: relative;
        top: 0;
        left: 0;
        // margin-left: 10px;

        &-item {
          &:first-child {
            margin-bottom: 0;
            margin-right: 60px;
          }
        }
      }
    }

    .title {
      padding: 0;
    }

    .left {
      padding-left: 0;
      padding-bottom: 0;
      margin-bottom: 50px;
    }

    .right {
      padding-bottom: 10px;
      flex: 0 0 100%;
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
      padding: 0 30px;
    }

    .title-wrapper {
      padding: 0 30px;
      flex-flow: column nowrap;

      .tags {
        display: flex;
        flex-flow: row nowrap;
        align-items: flex-start;
        justify-content: flex-start;

        &-item {
          &:first-child {
            margin-bottom: 0;
            margin-right: 30px;
          }
        }
      }

      .tag {
        display: block;
      }
    }

    .back {
      display: block;
      position: initial;
      margin-bottom: 20px;
    }

    .title {
      margin-bottom: 30px;
      font-family: 'DIN Condensed', sans-serif;
      font-style: normal;
      font-weight: bold;
      line-height: normal;
      font-size: 36px;
      text-transform: uppercase;
      color: #FFFFFF;
    }

    .subtitle {
      font-family: 'DIN Pro Medium', sans-serif;
      font-style: normal;
      font-weight: bold;
      line-height: 28px;
      font-size: 18px;
      color: #FFFFFF;
    }

    .date {
      margin-bottom: 0px;
    }

    .previous {
      flex: 0 0 100%;
    }
  }
</style>
