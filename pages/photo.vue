<template>
  <section class="photos">
    <Header />
    <div class="container">
      <div class="title">PHOTO</div>
      <div class="tags">
        <div class="tags-item">
          <div class="tags-title">CHAMPIONSHIP</div>
          <div class="tag" v-for="(tag, index) in championshipTags" :key="'championship-' + index" @click="filterByTag(tag)">
            #{{tag}}
          </div>
        </div>

        <div class="tags-item">
          <div class="tags-title tags-country">COUNTRY</div>
          <div class="tag" v-for="(tag, index) in countryTags" :key="'country-' + index" @click="filterByTag(tag)">
            #{{tag}}
          </div>
        </div>
      </div>
      <div class="list">
        <div class="photo" v-for="(photo, index) in filteredPhotos" :key="index">
          <div class="photo-date">{{ photo.date }}</div>
          <div class="photo-title" v-html="photo.title"></div>
          <div class="photo-list">
            <masonry
              :cols="{default: 4, 768: 2, 425: 1}"
              :gutter="{default: '20px', 768: '40px', 425: '0px'}"
              ref="my-masonry">
              <div class="photo-item"
                v-for="(image, index) in photo.images"
                :key="'image-' + index"
                @click="$store.commit('openLightbox', {
                  path: image,
                  index: index,
                  length: photo.images.length
                })"
                :style="{background: `url(${ image }) no-repeat center / cover`}" />
            </masonry>
          </div>
        </div>
      </div>
    </div>
    <Footer />
  </section>
</template>

<script>
  export default {
    data () {
      return {
        filteredPhotos: [],
        championship: [],
        country: [],
        photos: [
          {
            date: 'APR 1 — 2017',
            title: '1 stage RDS Grand prix 2018 Moscow',
            images: [
              '/videos/video-1.jpg',
              '/videos/video-2.jpg',
              '/videos/video-3.jpg',
              '/videos/video-4.jpg',
              '/videos/video-5.jpg',
              '/videos/video-6.jpg'
            ],
            championship: 'D1 Grand prix',
            country: 'Russia'
          },
          {
            date: 'MAR 26 — 2018',
            title: '2 stage RDS Grand prix 2018 Ryazan',
            images: [
              '/videos/video-1.jpg',
              '/videos/video-2.jpg',
              '/videos/video-3.jpg',
              '/videos/video-4.jpg',
              '/videos/video-5.jpg',
              '/videos/video-6.jpg'
            ],
            championship: 'D1 Grand prix',
            country: 'Russia'
          },
          {
            date: 'MAR 19 — 2018',
            title: '3 stage RDS Grand prix 2018 Nizhny Novgorod',
            images: [
              '/videos/video-1.jpg',
              '/videos/video-2.jpg',
              '/videos/video-3.jpg',
              '/videos/video-4.jpg',
              '/videos/video-5.jpg',
              '/videos/video-6.jpg'
            ],
            championship: 'Formula D',
            country: 'Japan'
          },
          {
            date: 'FEB 22 — 2018',
            title: '3 stage RDS Grand prix 2018 Nizhny Novgorod',
            images: [
              '/videos/video-1.jpg',
              '/videos/video-2.jpg',
              '/videos/video-3.jpg',
              '/videos/video-4.jpg',
              '/videos/video-5.jpg',
              '/videos/video-6.jpg'
            ],
            championship: 'Formula D',
            country: 'Usa'
          },
          {
            date: 'FEB 3 — 2018',
            title: '3 stage RDS Grand prix 2018 Nizhny Novgorod',
            images: [
              '/videos/video-1.jpg',
              '/videos/video-2.jpg',
              '/videos/video-3.jpg',
              '/videos/video-4.jpg',
              '/videos/video-5.jpg',
              '/videos/video-6.jpg'
            ],
            championship: 'RDS 2018',
            country: 'Japan'
          },
          {
            date: 'JAN 16 — 2018',
            title: '3 stage RDS Grand prix 2018 Nizhny Novgorod',
            images: [
              '/videos/video-1.jpg',
              '/videos/video-2.jpg',
              '/videos/video-3.jpg',
              '/videos/video-4.jpg',
              '/videos/video-5.jpg',
              '/videos/video-6.jpg'
            ],
            championship: 'RDS 2018',
            country: 'Usa'
          },
        ]
      }
    },

    computed: {
      championshipTags () {
        return [ ...new Set(this.photos.map(video => video.championship )) ]
      },

      countryTags () {
        return [ ...new Set(this.photos.map(video => video.country )) ]
      }
    },

    methods: {
      filterByTag (hashtag) {
        this.filteredPhotos = []
        this.photos.map((video, index) => {
          return (video.country === hashtag || video.championship === hashtag)
            && this.filteredPhotos.push(video)
        })
      }
    },

    mounted () {
      this.filteredPhotos = this.photos
    },

    components: {
      Header: () => import('@/components/Header'),
      Footer: () => import('@/components/Footer')
    }
  }
</script>

<style lang="scss" scoped>
  .photos {
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

  .videos-list {
    margin-bottom: 100px;
  }

  .photo {
    margin-bottom: 50px;
  }

  .photo-date {
    font-family: 'DIN Condensed', sans-serif;
    font-style: normal;
    font-weight: bold;
    line-height: 35px;
    font-size: 24px;
    text-transform: uppercase;
    color: rgba(255, 255, 255, 0.8);
  }

  .photo-item {
    max-width: 240px;
    width: 100%;
    height: 140px;
    margin-bottom: 15px;
    position: relative;
  }

  .photo-title {
    margin-bottom: 5px;
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
      padding-left: 100px;

      display: flex;
      flex-flow: row wrap;
      justify-content: space-between;
    }

    .list {
      flex: 0 0 100%;
    }

    .photo-title {
      margin-bottom: 10px;
    }

    .photo-item {
      max-width: 264px;
      margin-bottom: 40px;

      &:last-child {
        margin-bottom: 0;
      }
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
        margin-right: 60px;
      }
    }

    .tags-country {
      margin-top: 0;
    }
  }

  @media (max-width: 425px) {
    .container {
      padding: 0 50px;
      display: block;
    }

    .photo-item {
      margin-bottom: 20px;
    }

    .tags {
      margin-bottom: 50px;
    }
  }
</style>
