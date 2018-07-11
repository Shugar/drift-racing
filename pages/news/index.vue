<template>
  <section class="calendar">
    <Header />
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
          <div class="tags-title">{{locale === 'en' ? 'CHAMPIONSHIP' : 'ЧЕМПИОНАТ'}}</div>
          <div class="tag" v-for="(tag, index) in championshipTags" :key="'championship-' + index" @click="setTag(tag)">
            #{{tag}}
          </div>
        </div>
        <div class="tags-item">
          <div class="tags-title tags-country">{{ locale === 'en' ? 'COUNTRY' : 'СТРАНА' }}</div>
          <div class="tag" v-for="(tag, index) in countryTags" :key="'country-' + index" @click="setCountry(tag)">
            #{{tag}}
          </div>
        </div>
      </div>
    </u-animate>
    <div class="wrapper" :class="{'isAnimating': isChanging}">
      <div class="title-wrapper">
        <u-animate
          name="fadeInUp"
          delay="0s"
          duration="0.4s"
          :iteration="1"
          :offset="0"
          animateClass="animated"
          :begin="true"
          >
          <div class="title">{{locale === 'en' ? 'news' : 'новости'}}</div>
        </u-animate>
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
              <div class="tags-title">{{locale === 'en' ? 'CHAMPIONSHIP' : 'ЧЕМПИОНАТ'}}</div>
              <div class="tag" v-for="(tag, index) in championshipTags" :key="'championship-' + index" @click="setTag(tag)">
                #{{tag}}
              </div>
            </div>
            <div class="tags-item">
              <div class="tags-title tags-country">{{ locale === 'en' ? 'COUNTRY' : 'СТРАНА' }}</div>
              <div class="tag" v-for="(tag, index) in countryTags" :key="'country-' + index" @click="setCountry(tag)">
                #{{tag}}
              </div>
            </div>
          </div>
        </u-animate>
      </div>
      <div class="container">
        <div class="left">
          <div class="article" v-for="(article, index) in (events.length > 0 ? events : leftCalendar)" :key="index">
            <u-animate
              name="fadeInUp"
              :delay="0.2 + (index * 0.1) + 's'"
              duration="0.4s"
              :iteration="1"
              :offset="0"
              animateClass="animated"
              :begin="true"
            >
              <nuxt-link :to="'/calendar/' + findItemByTitle(article.title)">
                <div class="img-fullwidth">
                  <img :src="'http://' + article.image.fields.file.url.slice(2)" />
                </div>
                <div class="date">{{ article.date }}</div>
                <div class="title">{{ article.title }}</div>
                <div class="text">{{ article.preview }}</div>
              </nuxt-link>
            </u-animate>
          </div>
        </div>
        <div class="right">
          <div class="previous-article">
              <nuxt-link class="previous" v-for="(article, index) in (rightEvents.length > 0 ? rightEvents : rightCalendar)" :to="'/calendar/' + findItemByTitle(article.title)" :key="index">
                  <u-animate
                    name="fadeInUp"
                    :delay="0.2 + (index * 0.1) + 's'"
                    duration="0.4s"
                    :iteration="1"
                    :offset="0"
                    animateClass="animated"
                    :begin="true"
                  >
                    <div class="previous-image" :style="{background: `url(http://${article.image.fields.file.url.slice(2)}) no-repeat center / cover `}" />
                    <div class="previous-date">{{ article.date }}</div>
                    <div class="previous-subtitle">{{ article.title }}</div>
                  </u-animate>
              </nuxt-link>
          </div>
        </div>
      </div>

      <div class="container container-mobile">
        <div :class="{'previous': article.column === 'right', 'article': article.column === 'left'}" v-for="(article, index) in (events.length > 0 ? events : leftCalendar)" :key="index">
          <u-animate
            name="fadeInUp"
            :delay="0.2 + (index * 0.1) + 's'"
            duration="0.4s"
            :iteration="1"
            :offset="0"
            animateClass="animated"
            :begin="true"
          >
            <nuxt-link class="hui" :to="'/calendar/' + findItemByTitle(article.title)">
              <div class="previous-image"
                :style="{background: `url(http://${article.image.fields.file.url.slice(2)}) no-repeat center / cover `}" />
              <div :class="{'previous-date': article.column === 'right', 'date': article.column === 'left'}">
                {{ article.date }}
              </div>
              <div :class="{'previous-subtitle': article.column === 'right', 'title': article.column === 'left'}">
                {{ article.title }}
              </div>
              <div class="text" v-if="article.column === 'left'">{{ article.preview }}</div>
            </nuxt-link>
          </u-animate>
        </div>
      </div>
    </div>

    <u-animate
      name="fadeInUp"
      delay="0.8s"
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
        events: [],
        rightEvents: [],
        isChanging: false
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

    methods: {
      setTag (tag) {
        const events = this.leftCalendar
        const rightEvents = this.rightCalendar
        this.events = events.filter(article => { return article.championship === tag })
        this.rightEvents = rightEvents.filter(article => { return article.championship === tag })
      },

      setCountry (tag) {
        const events = this.leftCalendar
        const rightEvents = this.rightCalendar
        this.events = events.filter(article => { return article.country === tag } )
        this.rightEvents = rightEvents.filter(article => { return article.country === tag } )
      },

      findItemByTitle (title) {
        let result
        this.calendar.map((item, index) => {
          if (item.title === title) {
            result = index
          }
        })

        return result
      }
    },

    computed: {
      meta () {
        return this.$store.state.meta[this.$store.state.locale][this.$route.name]
      },

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
      },
      
      locale () {
        return this.$store.state.locale
      }
    },

    mounted () {
      this.isChanging = false
    },

    beforeRouteLeave(to, from, next) {
      this.isChanging = true
      setTimeout(() => next(), 300)
    },

    components: {
      Header: () => import('@/components/Header'),
      Footer: () => import('@/components/Footer')
    }
  }
</script>

<style lang="scss" scoped>
  .calendar {
    background: linear-gradient(216.25deg, #565656 0%, #000000 100%), #683FFF;
    padding: 200px 0 80px;
  }

  .wrapper {
    transition: transform .4s ease, opacity .4s ease;
    will-change: transform, opacity;
  }

  a {
    text-decoration: none;
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
    padding-bottom: 40px;
    display: flex;
    flex-flow: column nowrap;
    position: relative;
  }

  .article {
    max-width: 620px;
    margin-bottom: 40px;
    cursor: pointer;
    text-decoration: none;

    .title {
      padding: 0;

      display: inline;
      box-shadow: 0 0px 0 0 transparent inset;
      transition: box-shadow .1s ease-in;
      will-change: box-shadow;
    }

    &:hover .title {
      box-shadow:  0 -6px 0 0 #FFF inset;
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
    top: 305px;
    left: 100px;
    z-index: 100;
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
    display: block;

    &:hover .previous-subtitle {
      box-shadow:  0 -4px 0 0 #FFF inset;
    }
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
    margin-top: 10px;
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
