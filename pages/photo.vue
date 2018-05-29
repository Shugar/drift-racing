<template>
  <section class="photos">
    <Header />
    <div class="container" :class="{'isAnimating': isChanging}">
      <u-animate
        name="fadeInUp"
        delay="0s"
        duration="0.8s"
        :iteration="1"
        :offset="0"
        animateClass="animated"
        :begin="true"
      >
        <div class="title">PHOTO</div>
      </u-animate>
      <u-animate
        name="fadeIn"
        delay="0s"
        duration="0.8s"
        :iteration="1"
        :offset="0"
        animateClass="animated"
        :begin="true"
      >
        <div class="tags" v-if="fetchedPhotos">
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
      </u-animate>

      <div class="list" v-if="filteredPhotos.length === 0">
        <div class="photo" v-for="(photo, index) in fetchedPhotos" :key="index">
          <u-animate
            name="fadeInUp"
            :delay="0.5 + (index - 0.7 * index) + 's'"
            duration="0.8s"
            :iteration="1"
            :offset="0"
            animateClass="animated"
            :begin="true"
          >
            <div class="photo-date">{{ photo.date }}</div>
            <div class="photo-title" v-html="photo.title"></div>
            <div class="photo-list">
              <masonry
                :cols="{default: 4, 768: 2, 425: 1}"
                :gutter="{default: '20px', 768: '40px', 425: '0px'}"
                ref="my-masonry">
                <div class="photo-item"
                  v-for="(image, index) in photo.photos"
                  v-if="image.fields"
                  :key="'image-' + index"
                  @click="$store.commit('openLightbox', {
                    path: 'http://' + image.fields.file.url.slice(2),
                    index: index,
                    photos: photo.photos
                  })"
                  :style="{background: `url(${ 'http://' + image.fields.file.url }) no-repeat center / cover`}" />
              </masonry>
            </div>
          </u-animate>
        </div>
      </div>

      <div class="list" v-else>
        <div class="photo" v-for="(photo, index) in filteredPhotos" :key="index">
          <div class="photo-date">{{ photo.date }}</div>
          <div class="photo-title" v-html="photo.title"></div>
          <div class="photo-list">
            <masonry
              :cols="{default: 4, 768: 2, 425: 1}"
              :gutter="{default: '20px', 768: '40px', 425: '0px'}"
              ref="my-masonry">
              <div class="photo-item"
                v-for="(image, index) in photo.photos"
                v-if="image.fields"
                :key="'image-' + index"
                @click="$store.commit('openLightbox', {
                  path: 'http://' + image.fields.file.url.slice(2),
                  index: index,
                  photos: photo.photos
                })"
                :style="{background: `url(${ 'http://' + image.fields.file.url }) no-repeat center / cover`}" />
            </masonry>
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
      <Footer />
    </u-animate>
  </section>
</template>

<script>
  export default {
    data () {
      return {
        filteredPhotos: [],
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
      fetchedPhotos () {
        return this.$store.state.entities.photo
      },

      meta () {
        return this.$store.state.meta[this.$store.state.locale][this.$route.name]
      },

      championshipTags () {
        return [ ...new Set(this.fetchedPhotos.map(photo => photo.championship )) ]
      },

      countryTags () {
        return [ ...new Set(this.fetchedPhotos.map(photo => photo.country )) ]
      }
    },

    methods: {
      filterByTag (hashtag) {
        this.filteredPhotos = []
        this.fetchedPhotos.map((photo, index) => {
          return (photo.country === hashtag || photo.championship === hashtag)
            && this.filteredPhotos.push(photo)
        })
      }
    },

    mounted () {
      this.isChanging = false
    },

    beforeRouteLeave(to, from, next) {
      this.isChanging = true
      setTimeout(() => next(), 500)
    },


    components: {
      Header: () => import('@/components/Header'),
      Footer: () => import('@/components/Footer')
    }
  }
</script>

<style lang="scss" scoped>
  .fade-enter-active, .fade-more-leave-active {
    transition: opacity .5s ease;
  }

  .fade-enter, .fade-leave-to {
    opacity: 0.8;
  }

  .photos {
    background: #683FFF;
    padding: 200px 0 80px;
    min-height: 100vh;

    display: flex;
    flex-flow: column nowrap;
    justify-content: space-between;
  }

  .container {
    flex: 1;
    position: relative;
    padding: 0 100px;

    padding-left: 320px;
    transition: transform .5s ease, opacity .5s ease;
    will-change: transform, opacity;
  }

  .tags {
    position: fixed;
    top: 80px;
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
    cursor: pointer;
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
      padding: 0 30px;
      display: block;
    }

    .photo-item {
      margin-bottom: 20px;
      max-width: initial;
      height: 160px;
    }

    .tags {
      margin-bottom: 50px;
    }
  }
</style>
