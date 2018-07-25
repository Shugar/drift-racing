<template>
  <section class="calendar">
    <Header />
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
              <div class="tag"><nuxt-link to="/news/">{{locale === 'en' ? 'back to news' : 'назад к новостям'}}</nuxt-link></div>
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
              <div class="date">{{ article.date }}</div>
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
            <div class="title"> {{ article.title }} </div>
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
            <div class="calendar-text text">
              <vue-markdown> {{ article.text }} </vue-markdown>
            </div>
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
            <div class='article-image-retina' :style="{background: 'url(http://' + article.image.fields.file.url.slice(2) + ') no-repeat center / cover'}" />
            <div class="article-image" :style="{background: getImageMeta('http://' + article.image.fields.file.url.slice(2)) + ' no-repeat center / cover'}" />
          </u-animate>
        </div>
      </div>
      <div class="right">
        <div class="previous-article" v-if="previous.length > 0">
          <u-animate
            name="fadeInUp"
            delay="0.6s"
            duration="0.4s"
            :iteration="1"
            :offset="0"
            animateClass="animated"
            :begin="true"
          >
            <div class="previous-title"> {{ locale === 'en' ? 'PREVIOUS EVENT' : 'ПРЕДЫДУЩИЕ МЕРОПРИЯТИЯ'}} </div>
          </u-animate>
          <nuxt-link  v-for="(item, index) in previous" :to="'/news/' + findItemByTitle(item.title)" :key="index" class="previous">
            <u-animate
              name="fadeInUp"
              :delay="0.8 + (index * 0.1) + 's'"
              duration="0.4s"
              :iteration="1"
              :offset="0"
              animateClass="animated"
              :begin="true"
            >
              <div class="previous-image" :style="{background: getImageMeta('http://' + article.image.fields.file.url.slice(2)) + ' no-repeat center / cover'}" />
              <div class="previous-image-retina" :style="{background: `url(http://${article.image.fields.file.url.slice(2)}) no-repeat center / cover`}" />
              <div class="previous-date"> {{ item.date }} </div>
              <div class="previous-subtitle"> {{ item.title }} </div>
            </u-animate>
          </nuxt-link>
        </div>
      </div>
    </div>
    <u-animate
      name="fadeInUp"
      delay="1s"
      duration="0.8s"
      :iteration="1"
      :offset="0"
      animateClass="animated"
      :begin="true"
    >
      <Footer :propMeta="{
        title: this.article.title,
        description: this.article.text,
        keywords: this.article.keywords,
        facebook_image: `http://${this.article.image.fields.file.url.slice(2)}`,
        facebook_title: this.article.title,
        facebook_description: this.article.text
      }" />
    </u-animate>
  </section>
</template>

<script>
  import VueMarkdown from 'vue-markdown'

  export default {
    data () {
      return {
        url: ''
      }
    },

    head () {
      return {
        title: this.article.title,
        meta: [
          { name: 'description', content: this.article.text },
          { name: 'keywords', content: this.article.keywords },
          { hid: 'og:type', property: 'og:type', content: 'article'},
          { hid: 'og:url', property: 'og:url', content: this.url },
          { hid: 'og:image', property: 'og:image', content: `http://${this.article.image.fields.file.url.slice(2)}` },
          { hid: 'og:title', property: 'og:title', content: this.article.title },
          { hid: 'og:description', property: 'og:description', content: this.article.text },
        ]
      }
    },

    mounted () {
      this.url = window.location.href
    },

    computed: {
      article () {
        return this.$store.state.entities.calendar.map(article => {
          return {
            ...article
          }
        })[this.$route.params.id]
      },


      previous () {
        const array = this.$store.state.entities.calendar.map(article => {
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


      tags () {
        const hashtags = []
        this.article.map((event, index) => {
          article.hashtags.map((tag, index) => {
            hashtags.push(tag)
          })
        })

        return [ ...new Set(hashtags) ]
      },

      locale () {
        return this.$store.state.locale
      }
    },


    methods: {
    getImageMeta (url) {
      let img = new Image
      img.src = url
      img.onload = () => {
         return `url(${url}?w=${img.width/2}&h=${img.height/2})`
      }
      return img.onload()
    },
      findItemByTitle (title) {
        let result
        this.$store.state.entities.calendar.map((item, index) => {
          if (item.title === title) {
            result = index
          }
        })

        return result
      }
    },

    components: {
      Header: () => import('@/components/Header'),
      Footer: () => import('@/components/Footer'),
      VueMarkdown
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
    padding: 200px 0 80px;

    min-height: 100vh;
    display: flex;
    flex-flow: column nowrap;
  }

  .container {
    flex: 1;
    position: relative;
    padding: 0 100px;

    display: flex;
    flex-flow: row nowrap;
    align-content: center;
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
    padding-bottom: 30px;
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

  .mobile {
    display: none;
  }

  .article {
    max-width: 550px;
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
      z-index: 10;
      top: 198px;
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
    color: rgba(255, 255, 255, 0.8);
  }

  .img-fullwidth img {
    height: auto;
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
    display: block;
    margin-bottom: 40px;

    &:hover .previous-subtitle {
      box-shadow:  0 -4px 0 0 #FFF inset;
    }
  }

  .previous-image, .previous-image-retina {
    margin-bottom: 20px;
    height: 169px;
    width: 100%;
  }

  .article-image, .article-image-retina {
    height: 250px;
    width: 100%;
  }

  .previous-image, .article-image {
    display: block;
  }

  .previous-image-retina, .article-image-retina {
    display: none;
  }
  
  @media (-webkit-min-device-pixel-ratio: 2) {
    .previous-image, .article-image{
      display: none;
    }

    .previous-image-retina, .article-image-retina {
      display: block;
    }
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
    .container {
      display: block;
    }

    .back {
      display: none;
    }

    .mobile {
      display: block;
    }

    .tags {
      display: none;
    }

    .title-wrapper {
      justify-content: space-between;
      margin-bottom: 0px;

      .tags {
        // display: none;
        // display: flex;
        // flex-flow: row nowrap;
        // align-items: flex-start;
        // position: relative;
        // top: 0;
        // left: 0;
        // margin-left: 10px;

        &-item {
          display: none;
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
      display: none;
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
    }

    .tags {
      display: block;
      position: inherit;

      .tag {
        margin: 0;
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


<style lang="scss">
  .calendar-text {
    pre,
    code {
      margin-bottom: 20px;
      white-space: initial;
      font-family: 'DIN Pro Medium', sans-serif !important;
    }

    p {
      width: 100%;
      margin-bottom: 20px;
    }

    img {
      height: auto;
      width: 100%;
      max-width: 100%;
    }
  }
</style>