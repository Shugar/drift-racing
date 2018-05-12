<template>
  <section class="calendar">
    <Header />
    <div class="title-wrapper">
      <div class="tags">
        <div class="tags-item">
          <div class="tag"><nuxt-link to="/videos/" >back to videos</nuxt-link></div>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="left">
        <div class="tags">
          <div class="tags-item">
            <div class="tag"><nuxt-link to="/videos/">back to videos</nuxt-link></div>
          </div>
        </div>
        <div class="article">
          <div class="info">
            <div class="date">DEC 9 — 2017</div>
          </div>
          <div class="title">1 stage Grand Prix RDS 2018 Moscow</div>
          <div class="video-wrapper">
            <iframe width="100%" height="100%" src="https://www.youtube.com/embed/3MkSDObecV0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
          </div>
          <div class="text">Duis eget efficitur ipsum, eget porttitor sapien. Proin justo est, tempus in sollicitudin ut, hendrerit non metus. Fusce volutpat mattis lorem, ac posuere lorem consequat accumsan.</div>
        </div>
       <div class="right mobile">
        <div class="previous-article">
          <div class="previous-title">Previous videos</div>
          <div class="previous">
            <div class="previous-image" :style="{background: `url(/calendar/event-2.png) no-repeat center / cover`}" />
            <div class="previous-date">JAN 30 — 2016</div>
            <div class="previous-subtitle">2 stage Grand prix RDS 2018 Ryazan</div>
          </div>
          <div class="previous">
            <div class="previous-image" :style="{background: `url(/calendar/event-2.png) no-repeat center / cover`}" />
            <div class="previous-date">JAN 30 — 2016</div>
            <div class="previous-subtitle">2 stage Grand prix RDS 2018 Ryazan</div>
          </div>
          <div class="previous">
            <div class="previous-image" :style="{background: `url(/calendar/event-2.png) no-repeat center / cover`}" />
            <div class="previous-date">JAN 30 — 2016</div>
            <div class="previous-subtitle">2 stage Grand prix RDS 2018 Ryazan</div>
          </div>
        </div>
      </div> 
      </div>
      <!-- <div class="right">
        <div class="previous-article">
          <div class="previous">
            <div class="previous-image" :style="{background: `url(/calendar/event-2.png) no-repeat center / cover`}" />
            <div class="previous-date">JAN 30 — 2016</div>
            <div class="previous-subtitle">2 stage Grand prix RDS 2018 Ryazan</div>
          </div>
          <div class="previous">
            <div class="previous-image" :style="{background: `url(/calendar/event-3.png) no-repeat center / cover `}" />
            <div class="previous-date">JAN 30 — 2016</div>
            <div class="previous-subtitle">2 stage Grand prix RDS 2018 Ryazan</div>
          </div>
        </div>
      </div> -->
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
            hashtags: ['D1 Grand prix']
          },
          {
            date: 'DEC 7 — 2017',
            title: 'MotorShow Bologna.<br>Italy 2-10 December',
            preview: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            image: '',
            hashtags: ['RDS 2018']
          },
          {
            date: 'JAN 30 — 2016',
            title: 'Life of championships<br>Chaper 5',
            preview: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            image: '/news/news-2.jpg',
            hashtags: ['Formula D']
          },
          {
            date: 'DEC 1 — 2017',
            title: 'Life of championships<br>moscow raceway',
            preview: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            image: '',
            hashtags: ['Russia']
          },
          {
            date: 'DEC 3 — 2017',
            title: 'Drift all<br>the time you got!',
            preview: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            image: '/news/news-3.jpg',
            hashtags: ['Japan']
          },
          {
            date: 'DEC 9 — 2017',
            title: 'Sochi, closing of the season 2017 RDS',
            preview: '',
            image: '',
            hashtags: ['USA']
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

    },

    mounted () {

    },

    components: {
      Header: () => import('@/components/Header'),
      Footer: () => import('@/components/Footer')
    },

    // validate ({ params }) {
    //   // Must be a number
    //   return /^\d+$/.test(params.id)
    // }
  }
</script>

<style lang="scss" scoped>
  .calendar {
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

    .tags {
      display: none;
    }

    .title-wrapper {
      justify-content: space-between;
      margin-bottom: 0px;

      .tags {
        display: flex;
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
      padding: 0 50px;
    }

    .title-wrapper {
      padding: 0 50px;
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
