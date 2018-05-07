<template>
  <section class="videos">
    <Header />
    <div class="container">
      <div class="tags">
        <div class="tags-title">CHAMPIONSHIP</div>
        <div class="tag" v-for="(tag, index) in championshipTags" :key="'championship-' + index" @click="filterByTag(tag)">
          #{{tag}}
        </div>

        <div class="tags-title tags-country">COUNTRY</div>
        <div class="tag" v-for="(tag, index) in countryTags" :key="'country-' + index" @click="filterByTag(tag)">
          #{{tag}}
        </div>
      </div>
      <div class="title">VIDEO</div>
      <div class="videos-list">
        <masonry :cols="3" :gutter="60" ref="my-masonry">
          <div class="video" v-for="(video, index) in filteredVideos" :key="index">
            <div class="video-image"
              v-if="video.image !== ''"
              :style="{background: `url(${ video.image }) no-repeat center / cover`}">
              <div class="play-button" />
            </div>
            <div class="video-date">{{ video.date }}</div>
            <div class="video-title" v-html="video.title"></div>
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
        filteredVideos: [],
        championship: [],
        country: [],
        videos: [
          {
            date: 'APR 1 — 2017',
            title: '1 stage RDS Grand prix 2018 Moscow',
            image: '/videos/video-1.jpg',
            championship: 'D1 Grand prix',
            country: 'Russia'
          },
          {
            date: 'MAR 26 — 2018',
            title: '2 stage RDS Grand prix 2018 Ryazan',
            image: '/videos/video-2.jpg',
            championship: 'D1 Grand prix',
            country: 'Russia'
          },
          {
            date: 'MAR 19 — 2018',
            title: '3 stage RDS Grand prix 2018 Nizhny Novgorod',
            image: '/videos/video-3.jpg',
            championship: 'Formula D',
            country: 'Japan'
          },
          {
            date: 'FEB 22 — 2018',
            title: '3 stage RDS Grand prix 2018 Nizhny Novgorod',
            image: '/videos/video-4.jpg',
            championship: 'Formula D',
            country: 'Usa'
          },
          {
            date: 'FEB 3 — 2018',
            title: '3 stage RDS Grand prix 2018 Nizhny Novgorod',
            image: '/videos/video-5.jpg',
            championship: 'RDS 2018',
            country: 'Japan'
          },
          {
            date: 'JAN 16 — 2018',
            title: '3 stage RDS Grand prix 2018 Nizhny Novgorod',
            image: '/videos/video-6.jpg',
            championship: 'RDS 2018',
            country: 'Usa'
          },
        ]
      }
    },

    computed: {
      championshipTags () {
        return [ ...new Set(this.videos.map(video => video.championship )) ]
      },

      countryTags () {
        return [ ...new Set(this.videos.map(video => video.country )) ]
      }
    },

    methods: {
      filterByTag (hashtag) {
        this.filteredVideos = []
        this.videos.map((video, index) => {
          return (video.country === hashtag || video.championship === hashtag)
            && this.filteredVideos.push(video)
        })
      }
    },

    mounted () {
      this.filteredVideos = this.videos
    },

    components: {
      Header: () => import('@/components/Header'),
      Footer: () => import('@/components/Footer')
    }
  }
</script>

<style lang="scss" scoped>
  .videos {
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
    margin-bottom: 20px;
  }

  .videos-list {
    margin-bottom: 100px;
  }

  .video {
    margin-bottom: 50px;
    cursor: pointer;
    max-width: 300px;
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
