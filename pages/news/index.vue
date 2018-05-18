<template>
  <section class="news">
    <Header />
    <div class="container">
      <div class="title">NEWS</div>
      <div class="tags">
        <div class="tags-item">
          <div class="tags-title">TAGS</div>
          <div class="tag" v-for="(tag, index) in tags" :key="index" @click="filterByTag(tag.trim())">
            #{{tag}}
          </div>
        </div>
      </div>
      <div class="news-list" v-if="filteredArticles.length === 0">
        <masonry
          :cols="{default: 3, 1024: 2, 425: 1}"
          :gutter="{default: '60px', 768: '40px', 425: '0px'}"
          ref="my-masonry">
          <div class="article" v-for="(article, index) in fetchedNews" :key="index">
            <nuxt-link :to="'/news/' + index">
              <div class="article-date">{{ article.date }}</div>
              <div class="article-title" v-html="article.title"></div>
              <div class="article-image"
                :style="{background: `url(${ 'http://' + article.media.fields.file.url.slice(2) }) no-repeat center / cover`}" />
              <div class="article-preview">{{ article.preview }}</div>
              <div class="article-hashtags">
                <div class="article-hashtag"
                  v-for="(hashtag, index) in article.tags"
                  :key="index">
                  #{{ hashtag.trim() }}
                </div>
              </div>
            </nuxt-link>
          </div>
        </masonry>
      </div>
      <div class="news-list">
        <masonry
          :cols="{default: 3, 1024: 2, 425: 1}"
          :gutter="{default: '60px', 768: '40px', 425: '0px'}"
          ref="my-masonry">
          <div class="article" v-for="(article, index) in filteredArticles" :key="index">
            <nuxt-link :to="'/news/' + findItemByTitle(article.title)">
              <div class="article-date">{{ article.date }}</div>
              <div class="article-title" v-html="article.title"></div>
              <div class="article-image"
                :style="{background: `url(${ 'http://' + article.media.fields.file.url.slice(2) }) no-repeat center / cover`}" />
              <div class="article-preview">{{ article.preview }}</div>
              <div class="article-hashtags">
                <div class="article-hashtag"
                  v-for="(hashtag, index) in article.tags"
                  :key="index">
                  #{{ hashtag.trim() }}
                </div>
              </div>
            </nuxt-link>
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
        filteredArticles: [],
      }
    },

    computed: {
      tags () {
        const hashtags = []
        this.fetchedNews.map((article, index) => {
          article.tags.map((tag, index) => {
            hashtags.push(tag.trim())
          })
        })

        return [ ...new Set(hashtags) ]
      },

      fetchedNews () {
        return this.$store.state.entities.news.map(article => {
          return {
            ...article,
            tags: article.tags.replace(' ', '').split(',')
          }
        })
      }
    },

    methods: {
      filterByTag (hashtag) {
        this.filteredArticles = []
        this.fetchedNews.map((article, index) => {
          article.tags.map((tag, index) => {
            if (hashtag === tag) {
              this.filteredArticles.push(article)
            }
          })
        })
      },

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
    margin-bottom: 15px;
  }

  .news-list {
    margin-bottom: 100px;
  }

  .article {
    margin-bottom: 60px;
    cursor: pointer;
    max-width: 300px;

    a {
      text-decoration: none;
    }
  }

  .article-date {
    font-family: 'DIN Condensed', sans-serif;
    font-style: normal;
    font-weight: bold;
    line-height: 35px;
    font-size: 24px;
    text-transform: uppercase;
    color: rgba(255, 255, 255, 0.8);
  }

  .article-image {
    width: 100%;
    height: 180px;
    margin-bottom: 20px;
  }

  .article-title {
    margin-bottom: 10px;
    font-family: 'DIN Condensed', sans-serif;
    font-style: normal;
    font-weight: bold;
    line-height: 52px;
    font-size: 36px;
    text-transform: uppercase;
    color: #FFFFFF;
  }

  .article-preview {
    margin-bottom: 10px;
    line-height: 25px;
    font-size: 18px;
    color: rgba(255, 255, 255, 0.7);
  }

  .article-hashtags {
    display: flex;
    flex-flow: row wrap;
    align-items: center;
  }

  .article-hashtag {
    margin-right: 8px;
    font-family: 'DIN Condensed', sans-serif;
    font-style: normal;
    font-weight: bold;
    line-height: 29px;
    font-size: 20px;
    text-transform: uppercase;
    color: rgba(255, 255, 255, 0.8);
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

    .tags {
      margin-bottom: 50px;
    }

    .tags-item:first-child {
      margin-left: 0;
    }
  }
</style>
