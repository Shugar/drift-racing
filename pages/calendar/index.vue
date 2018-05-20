<template>
  <section class="calendar">
    <Header />
    <div class="title-wrapper">
      <div class="title">calendar</div>
      <div class="tags">
        <div class="tags-item">
          <div class="tags-title">CHAMPIONSHIP</div>
          <div class="tag" v-for="(tag, index) in championshipTags" :key="'championship-' + index" @click="setTag(tag)">
            #{{tag}}
          </div>
        </div>
        <div class="tags-item">
          <div class="tags-title tags-country">COUNTRY</div>
          <div class="tag" v-for="(tag, index) in countryTags" :key="'country-' + index" @click="setCountry(tag)">
            #{{tag}}
          </div>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="left">
        <div class="tags">
          <div class="tags-item">
            <div class="tags-title">CHAMPIONSHIP</div>
            <div class="tag" v-for="(tag, index) in championshipTags" :key="'championship-' + index" @click="setTag(tag)">
              #{{tag}}
            </div>
          </div>
          <div class="tags-item">
            <div class="tags-title tags-country">COUNTRY</div>
            <div class="tag" v-for="(tag, index) in countryTags" :key="'country-' + index" @click="setCountry(tag)">
              #{{tag}}
            </div>
          </div>
        </div>

        <div class="article" v-for="(article, index) in (events.length > 0 ? events : leftCalendar)" :key="index">
          <div class="img-fullwidth">
            <img :src="'http://' + article.image.fields.file.url.slice(2)" />
          </div>
          <div class="date">{{ article.date }}</div>
          <div class="title">{{ article.title }}</div>
          <div class="text">{{ article.preview }}</div>
        </div>
      </div>
      <div class="right">
        <div class="previous-article">
          <div class="previous" v-for="(article, index) in rightCalendar" :key="index">
            <div class="previous-image" :style="{background: `url(http://${article.image.fields.file.url.slice(2)}) no-repeat center / cover `}" />
            <div class="previous-date">{{ article.date }}</div>
            <div class="previous-subtitle">{{ article.title }}</div>
          </div>
        </div>
      </div>
    </div>


    <div class="container container-mobile">
      <div :class="{'previous': article.column === 'right', 'article': article.column === 'left'}" v-for="(article, index) in calendar" :key="index">
        <div class="previous-image"
          :style="{background: `url(http://${article.image.fields.file.url.slice(2)}) no-repeat center / cover `}" />
        <div :class="{'previous-date': article.column === 'right', 'date': article.column === 'left'}">
          {{ article.date }}
        </div>
        <div :class="{'previous-subtitle': article.column === 'right', 'title': article.column === 'left'}">
          {{ article.title }}
        </div>
        <div class="text" v-if="article.column === 'left'">{{ article.preview }}</div>
      </div>
    </div>

    <Footer />
  </section>
</template>

<script>
  export default {
    data () {
      return {
        events: []
      }
    },

    methods: {
      setTag (tag) {
        const events = this.leftCalendar
        this.events = events.filter(article => { return article.championship === tag })
      },
      setCountry (tag) {
        const events = this.leftCalendar
        this.events = events.filter(article => { return article.country === tag } )
      }
    },

    computed: {
      championshipTags () {
        return [ ...new Set(this.calendar.map(article => article.championship )) ]
      },

      countryTags () {
        return [ ...new Set(this.calendar.map(article => article.country )) ]
      },

      calendar () {
        return this.$store.state.entities.calendar
      },

      leftCalendar () {
        const left = []
        this.$store.state.entities.calendar.map(article => {
          if (article.column === 'left') {
            left.push(article)
          }
        })
        return left
      },

      rightCalendar () {
        const right = []
        this.$store.state.entities.calendar.map(article => {
          if (article.column === 'right') {
            right.push(article)
          }
        })

        return right
      }
    },

    components: {
      Header: () => import('@/components/Header'),
      Footer: () => import('@/components/Footer')
    }
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

  .container-mobile {
    display: none;
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
    margin-bottom: 40px;

    .title {
      padding: 0;
      margin-bottom: 10px;
    }
  }

  .previous-article {
    padding-left: 50px;
    max-width: 350px;
  }

  .tags {
    display: flex;
    flex-flow: column nowrap;
    justify-content: center;
  }

  .tags-item:first-child {
    margin-bottom: 40px;
  }

  .date {
    margin-bottom: 20px;
  }

  .date,
  .tag {
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
      top: 310px;
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
    margin-bottom: 40px;
  }

  .previous-image {
    margin-bottom: 20px;
    height: 169px;
    width: 100%;
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

  @media (max-width: 768px) {
    .container {
      display: none;

      &.container-mobile {
        display: flex;
        flex-flow: row wrap;
        justify-content: space-between;
      }
    }

    .tags {
      display: none;
    }

    .title-wrapper {
      justify-content: space-between;
      margin-bottom: 40px;

      .tags {
        display: flex;
        flex-flow: row nowrap;
        align-items: flex-start;
        position: relative;
        top: 0;
        left: 0;
      }

      .tags-item:first-child {
        margin-bottom: 0;
        margin-right: 60px;
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
      display: none;
    }

    .right {
      padding-bottom: 10px;
    }

    .article {
      max-width: initial;
      // flex: 0 0 100%;
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
      }

      .tags-item:first-child {
        margin-bottom: 0;
        margin-right: 30px;
      }
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
