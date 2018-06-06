<template>
  <section class="news">
    <Header />
    <div class="container" :class="{'isAnimating': isChanging}">
      <u-animate
        name="fadeIn"
        delay="0s"
        duration="0.8s"
        :iteration="1"
        :offset="0"
        animateClass="animated"
        :begin="true"
      >
        <nuxt-link to="/news/" class="back">{{ locale === 'en' ? 'back to news' : 'назад к новостям'}}</nuxt-link>
      </u-animate>
      <div class="left">
        <u-animate
          name="fadeInUp"
          delay="0s"
          duration="0.8s"
          :iteration="1"
          :offset="0"
          animateClass="animated"
          :begin="true"
        >
          <div class="title">{{ article.title }}</div>
        </u-animate>
        <div class="article">
          <u-animate
            name="fadeInUp"
            delay="0.5s"
            duration="0.8s"
            :iteration="1"
            :offset="0"
            animateClass="animated"
            :begin="true"
          >
            <div class="info">
              <div class="date">{{ article.date }}</div>
              <div class="tags">
                <div class="tag" v-for="(tag, index) in article.tags" :key="index">
                  #{{ tag.trim() }}
                </div>
              </div>
            </div>
          </u-animate>
          <u-animate
            name="fadeInUp"
            delay="1s"
            duration="0.8s"
            :iteration="1"
            :offset="0"
            animateClass="animated"
            :begin="true"
          >
            <div class="subtitle">{{ article.subtitle }}</div>
          </u-animate>
          <u-animate
            name="fadeInUp"
            delay="1.5s"
            duration="0.8s"
            :iteration="1"
            :offset="0"
            animateClass="animated"
            :begin="true"
          >
            <div class="text article-text">
              <vue-markdown>
                {{ article.text }}
              </vue-markdown>
            </div>
          </u-animate>
        </div>
      </div>
      <div class="right" v-if="news.length > 0">
        <div class="previous-article">
          <div class="previous" v-for="(item, index) in news" :key="index">
            <u-animate
              name="fadeInUp"
              delay="1.5s"
              duration="0.8s"
              :iteration="1"
              :offset="0"
              animateClass="animated"
              :begin="true"
            >
              <div class="previous-title">{{ locale === 'en' ? 'Previous news' : 'Предыдущие новости'}}</div>
            </u-animate>
            <u-animate
              name="fadeInUp"
              delay="2s"
              duration="0.8s"
              :iteration="1"
              :offset="0"
              animateClass="animated"
              :begin="true"
            >
              <nuxt-link :to="'/news/' + findItemByTitle(item.title)">
                <div class="previous-image" />
                <div class="previous-date">{{ item.date }}</div>
                <div class="previous-subtitle">{{ item.title }}</div>
                <div class="previous-preview">
                  {{ item.text.length > 92 ? item.text.slice(0, 89) + '...' : item.text }}
                </div>
                <div class="previous-tags">
                  <div class="previous-tag" v-for="(tag, index) in item.tags" :key="index">
                    #{{ tag }}
                  </div>
                </div>
              </nuxt-link>
            </u-animate>
          </div>
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
        facebook_image: `http://${this.article.media.fields.file.url.slice(2)}`,
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
        isChanging: false,
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
          { hid: 'og:image', property: 'og:image', content: `http://${this.article.media.fields.file.url.slice(2)}` },
          { hid: 'og:title', property: 'og:title', content: this.article.title },
          { hid: 'og:description', property: 'og:description', content: this.article.text },
        ]
      }
    },

    computed: {
      article () {
        return this.$store.state.entities.news.map(article => {
          return {
            ...article,
            tags: article.tags.replace(' ', '').split(',')
          }
        })[this.$route.params.id]
      },

      news () {
        const array = this.$store.state.entities.news.map(article => {
          return {
            ...article,
            tags: article.tags.replace(' ', '').split(',')
          }
        })

        if (this.$route.params.id > 1) {
          return [
            array[this.$route.params.id - 1],
            array[this.$route.params.id - 2]
          ]
        } else if (this.$route.params.id > 0) {
          return [ array[0] ]
        } else {
          return []
        }
      },

      fetchedNews () {
        return this.$store.state.entities.news.map(article => {
          return {
            ...article,
            tags: article.tags.replace(' ', '').split(',')
          }
        })
      },

      locale () {
        return this.$store.state.locale
      }
    },

    methods: {
      findItemByTitle (title) {
        let result
        this.fetchedNews.map((item, index) => {
          if (item.title === title) {
            result = index
          }
        })

        return result
      }
    },

    mounted () {
      this.isChanging = false
      this.url = window.location.href
    },

    beforeRouteUpdate(to, from, next) {
      this.isChanging = true
      setTimeout(() => next(), 500)
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

    transition: transform .5s ease, opacity .5s ease;
    will-change: transform, opacity;
  }

  .left {
    position: relative;
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

  .tag {
    margin-right: 10px;
  }

  .tag:last-child {
    margin-right: 0;
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
    position: absolute;
    left: 100px;
    top: 0px;
    z-index: 2;
    text-decoration: none;
    color: #FFF;
    text-transform: uppercase;
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

    a {
      text-decoration: none;
    }
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
    margin-right: 10px;
    font-family: 'DIN Condensed', sans-serif;
    font-style: normal;
    font-weight: bold;
    line-height: 29px;
    font-size: 20px;
    text-transform: uppercase;
    color: #FFFFFF;

    &:last-child {
      margin-right: 0;
    }
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
      padding: 0 30px;
    }

    .back {
      display: none;
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
      font-family: 'DIN Pro Medium', sans-serif;
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


<style lang="scss">
  .article-text {
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