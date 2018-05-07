<template>
  <section class="news">
    <Header />
    <div class="container">
      <div class="tags">
        <div class="tags-title">TAGS</div>
        <div class="tag" v-for="(tag, index) in tags" :key="index" @click="filterByTag(tag)">
          #{{tag}}
        </div>
      </div>
      <div class="title">NEWS</div>
      <div class="news-list">
        <masonry :cols="3" :gutter="60" ref="my-masonry">
          <div class="article" v-for="(article, index) in filteredArticles" :key="index">
            <div class="article-date">{{ article.date }}</div>
            <div class="article-title" v-html="article.title"></div>
            <div class="article-image"
              v-if="article.image !== ''"
              :style="{background: `url(${ article.image }) no-repeat center / cover`}" />
            <div class="article-preview">{{ article.preview }}</div>
            <div class="article-hashtags">
              <div class="article-hashtag"
                v-for="(hashtag, index) in article.hashtags"
                :key="index">
                #{{ hashtag }}
              </div>
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
        filteredArticles: [],
        articles: [
          {
            date: 'DEC 9 — 2017',
            title: 'Sochi, closing of the<br>season 2017 RDS',
            preview: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            image: '/news/news-1.jpg',
            hashtags: ['events', 'rds2018']
          },
          {
            date: 'DEC 7 — 2017',
            title: 'MotorShow Bologna.<br>Italy 2-10 December',
            preview: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            image: '',
            hashtags: ['garage']
          },
          {
            date: 'JAN 30 — 2016',
            title: 'Life of championships<br>Chaper 5',
            preview: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            image: '/news/news-2.jpg',
            hashtags: ['video']
          },
          {
            date: 'DEC 1 — 2017',
            title: 'Life of championships<br>moscow raceway',
            preview: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            image: '',
            hashtags: ['events', 'rds2018']
          },
          {
            date: 'DEC 3 — 2017',
            title: 'Drift all<br>the time you got!',
            preview: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            image: '/news/news-3.jpg',
            hashtags: ['events', 'rds2018']
          },
          {
            date: 'DEC 9 — 2017',
            title: 'Sochi, closing of the season 2017 RDS',
            preview: '',
            image: '',
            hashtags: ['events', 'rds2018']
          },
        ]
      }
    },

    computed: {
      tags () {
        const hashtags = []
        this.articles.map((article, index) => {
          article.hashtags.map((tag, index) => {
            hashtags.push(tag)
          })
        })

        return [ ...new Set(hashtags) ]
      }
    },

    methods: {
      filterByTag (hashtag) {
        this.filteredArticles = []
        this.articles.map((article, index) => {
          article.hashtags.map((tag, index) => {
            if (hashtag === tag) {
              this.filteredArticles.push(article)
            }
          })
        })
      }
    },

    mounted () {
      this.filteredArticles = this.articles
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
    top: 200px;
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
  }

  .news-list {
    margin-bottom: 100px;
  }

  .article {
    cursor: pointer;
    max-width: 300px;
  }

  .article-date {
    margin-bottom: 20px;
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
    margin-bottom: 20px;
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
      display: block;
    }
  }

  @media (max-width: 425px) {
    .container {
      padding: 0 50px;
    }
  }
</style>
