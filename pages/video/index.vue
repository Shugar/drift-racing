<template>
  <section class="videos">
    <Header />
    <u-animate
      name="fadeIn"
      delay="0s"
      duration="0.4s"
      :iteration="1"
      :offset="0"
      animateClass="animated"
      :begin="true">
    <div class="tags">
      <div class="tags-item">
        <div class="tags-title">{{locale === 'en' ? 'CHAMPIONSHIP' : 'ЧЕМПИОНАТ'}}</div>
        <div class="tag" v-for="(tag, index) in championshipTags" :key="'championship-' + index" @click="filterByTag(tag)">
          #{{tag}}
        </div>
      </div>
      <div class="tags-item">
        <div class="tags-title tags-country">{{locale === 'en' ? 'COUNTRY' : 'СТРАНА'}}</div>
        <div class="tag" v-for="(tag, index) in countryTags" :key="'country-' + index" @click="filterByTag(tag)">
          #{{tag}}
        </div>
      </div>
    </div>
  </u-animate>
    <div class="container" :class="{'isAnimating': isChanging}">
      <u-animate
          name="fadeInUp"
          delay="0s"
          duration="0.4s"
          :iteration="1"
          :offset="0"
          animateClass="animated"
          :begin="true">
        <div class="title">{{locale === 'en' ? 'VIDEO' : 'ВИДЕО'}}</div>
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
        <div class="videos-list" v-if="filteredVideos.length === 0">
          <masonry
            :cols="{default: 3, 1024: 2, 425: 1}"
            :gutter="{default: '60px', 768: '40px', 425: '0px'}"
            ref="my-masonry">
            <div class="video" v-for="(video, index) in fetchedVideos" :key="index">
              <nuxt-link :to="'/video/' + index" >
                <div class="video-image" :style="{background: 'url( http://' + video.gif.fields.file.url.slice(2) + ') no-repeat center / cover'}">
                  <div class="video-placeholder" />
                  <div class="play-button" />
                </div>
                <div class="video-date">{{ video.date }}</div>
                <div class="video-title" v-html="video.title"></div>
              </nuxt-link>
            </div>
          </masonry>
        </div>
      </u-animate>
      <u-animate
          name="fadeInUp"
          delay="0.6s"
          duration="0.4s"
          :iteration="1"
          :offset="0"
          animateClass="animated"
          :begin="true"
        >
        <div class="videos-list">
          <masonry
            :cols="{default: 3, 1024: 2, 425: 1}"
            :gutter="{default: '60px', 768: '40px', 425: '0px'}"
            ref="my-masonry">
            <div class="video" v-for="(video, index) in filteredVideos" :key="index">
              <nuxt-link :to="'/video/' + findItemByTitle(video.title)" >
                <div class="video-image"
                  :style="{background: 'url( http://' + video.gif.fields.file.url.slice(2) + ') no-repeat center / cover'}">
                  <div class="video-placeholder" />
                  <div class="play-button" />
                </div>
                <div class="video-date">{{ video.date }}</div>
                <div class="video-title" v-html="video.title"></div>
              </nuxt-link>
            </div>
          </masonry>
        </div>
      </u-animate>
    </div>
    <u-animate
      name="fadeInUp"
      delay="0.4s"
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
        filteredVideos: [],
        championship: [],
        country: [],
        isChanging: false,
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

    computed: {
      championshipTags () {
        return [ ...new Set(this.fetchedVideos.map(video => video.championship )) ]
      },

      meta () {
        return this.$store.state.meta[this.$store.state.locale][this.$route.name]
      },

      countryTags () {
        return [ ...new Set(this.fetchedVideos.map(video => video.country )) ]
      },

      fetchedVideos () {
        return this.$store.state.entities.video
      },

      locale () {
        return this.$store.state.locale
      }
    },

    methods: {
      filterByTag (hashtag) {
        this.filteredVideos = []
        this.fetchedVideos.map((video, index) => {
          return (video.country === hashtag || video.championship === hashtag)
            && this.filteredVideos.push(video)
        })
      },

      findItemByTitle (title) {
        let result
        this.fetchedVideos.map((item, index) => {
          if (item.title === title) {
            result = index
          }
        })

        return result
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
  .videos {
    background: linear-gradient(216.25deg, #565656 0%, #000000 100%), #683FFF;
    padding: 200px 0 80px;
    height: 100%;

    display: flex;
    flex-flow: column nowrap;
    min-height: 100vh;
  }

  .container {
    flex: 1;
    position: relative;
    padding: 0 100px;

    padding-left: 320px;
    transition: transform .4s ease, opacity .4s ease;
    will-change: transform, opacity;
  }

  .tags {
    position: fixed;
    top: 275px;
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

  .tags-country {
    margin-top: 40px;
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

  .video {
    margin-bottom: 50px;
    cursor: pointer;
    max-width: 300px;

    a {
      text-decoration: none;
    }

    &:hover .video-title {
      box-shadow:  0 -4px 0 0 #FFF inset;
    }
  }

  .video-date {
    margin-bottom: 5px;
    font-family: 'DIN Condensed', sans-serif;
    font-style: normal;
    font-weight: bold;
    line-height: 35px;
    font-size: 24px;
    text-transform: uppercase;
    color: rgba(255, 255, 255, 0.8);
  }

  .video-image {
    width: 100%;
    height: 180px;
    margin-bottom: 15px;
    position: relative;
    transition: all 5s ease-in-out;

    &:hover {
      .play-button {
        opacity: 0;
      }
    }
  }

  .video-placeholder {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: url('/videos/tumbnails/drift.png') no-repeat center / cover;

    opacity: 1;
    transition: opacity .3s ease-in-out;

    &:hover {
      opacity: 0;
    }
  }

  .play-button {
    width: 68px;
    height: 50px;
    background: url('~/assets/images/play.svg') no-repeat center / contain;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
  }

  .video-title {
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

  @media (max-width: 1024px) {
    .videos-list {
      flex-flow: row wrap;
    }
  }

  @media (max-width: 768px) {
    .videos {
      display: block
    }

    .container {
      padding-left: 100px;

      display: flex;
      flex-flow: row wrap;
      justify-content: space-between;
    }

    .videos-list {
      margin-top: 40px;
      margin-bottom: 60px;
      flex: 0 0 100%;
    }

    .video-title,
    .video-date {
      margin-bottom: 0;
    }

    .title {
      flex: 1;
    }

    .tags {
      padding-left: 80px;
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

    .video-item {
      margin-bottom: 20px;
    }

    .tags {
      padding: 0 30px;
      margin-bottom: 50px;
    }

    .tags-item:first-child {
      margin-left: 0;
    }
  }
</style>
