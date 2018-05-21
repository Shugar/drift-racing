<template>
  <div
    v-touch:swipe.left="next"
    v-touch:swipe.right="prev"
    v-if="photo !== null"
    class="lightbox"
    :style="{background: 'url(' + photo.path + ') no-repeat center / cover'}">
    <div class="close" @click="$store.commit('closeLightbox')" />
    <div class="prev" @click="prev" />
    <div class="next" @click="next" />
    <div class="index">
      {{ photo.index + 1 }}/{{ photo.photos.length }}
    </div>
  </div>
</template>

<script>
  export default {
    methods: {
      prev () {
        const index = this.photo.index <= 0 ? this.photo.photos.length - 1 : this.photo.index - 1

        this.$store.commit('openLightbox', {
          path: 'http://' + this.photo.photos[index].fields.file.url.slice(2),
          index: index,
          photos: this.photo.photos
        })
      },

      next () {
        const index = (this.photo.photos.length - 1) <= this.photo.index ? 0 : this.photo.index + 1
        const result = {
          path: 'http://' + this.photo.photos[index].fields.file.url.slice(2),
          index: index,
          photos: this.photo.photos
        }

        this.$store.commit('openLightbox', result)
      },

      handleKeypress (e) {
        if (this.photo !== null) {
          if (e.keyCode === 37) {
            this.prev()
          }

          if (e.keyCode === 39) {
            this.next()
          }
        }
      }
    },

    computed: {
      photo () {
        return this.$store.state.lightbox
      }
    },

    mounted () {
      window.addEventListener('keyup', this.handleKeypress)
    }
  }
</script>

<style lang="scss" scoped>
  .lightbox {
    position: fixed;
    height: 100%;
    width: 100%;
    z-index: 11;
    display: block;
  }

  .close {
    position: absolute;
    top: 80px;
    right: 100px;
    background: url('~/assets/images/cross.svg') no-repeat center / contain;
    width: 50px;
    height: 50px;
    cursor: pointer;
  }

  .prev,
  .next {
    width: 28px;
    height: 50px;
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    cursor: pointer;
  }

  .prev {
    background: url('~/assets/images/left.svg') no-repeat center / contain;
    left: 100px;
  }

  .next {
    background: url('~/assets/images/right.svg') no-repeat center / contain;
    right: 100px;
  }

  .index {
    position: absolute;
    left: 50%;
    bottom: 80px;
    transform: translateX(-50%);
    font-family: 'DIN Condensed', sans-serif;
    font-style: normal;
    font-weight: bold;
    line-height: 60px;
    font-size: 48px;
    text-transform: uppercase;
    color: #FFFFFF;
  }

  @media (max-width: 812px) {
    .close {
      right: 50px;
      top: 50px;
    }

    .index {
      bottom: 25px;
    }

    .prev {
      left: 50px;
      top: initial;
      bottom: 36px;
      transform: none;
    }

    .next {
      right: 50px;
      bottom: 36px;
      top: initial;
      transform: none;
    }
  }
</style>
