<template>
  <div class="wapper">
    <div
      v-touch:swipe.left="next"
      v-touch:swipe.right="prev"
      v-if="photo !== null"
      class="lightbox simple"
      :style="{ background: imageSrc + ' no-repeat center / cover' }">
      <div class="close" @click="$store.commit('closeLightbox')" />
      <div class="prev" @click="prev" />
      <div class="next" @click="next" />
      <div class="index">
        {{ photo.index + 1 }}/{{ photo.photos.length }}
      </div>
    </div>
    <div
      v-touch:swipe.left="next"
      v-touch:swipe.right="prev"
      v-if="photo !== null"
      class="lightbox retina"
      :style="{background: 'url(' + photo.path + ') no-repeat center / cover'}">
      <div class="close" @click="$store.commit('closeLightbox')" />
      <div class="prev" @click="prev" />
      <div class="next" @click="next" />
      <div class="index">
        {{ photo.index + 1 }}/{{ photo.photos.length }}
      </div>
    </div>
    <div v-if="photo !== null" class="background" />
  </div>
</template>

<script>
  export default {
    data () {
      return {
        imageSrc: ''
      }
    },
    methods: {
      getImageForBackground (url) {
        let img = new Image
        img.src = url
        img.onload = () => {
          return `url(${url}?w=${Math.round(img.width/2)}&h=${Math.round(img.height/2)})`
        }
       this.imageSrc = img.onload()
      },

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
    },

    updated () {
      this.getImageForBackground(this.photo.path)
    },
  }
</script>

<style lang="scss" scoped>
  .lightbox {
    position: fixed;
    height: 100%;
    width: 100%;
    z-index: 10000;
    display: block;

  }
  .background {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(101, 101, 101, 1);
    z-index: 9999;
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
    font-family: 'DIN Pro', sans-serif;
    font-style: normal;
    font-weight: 500;
    line-height: 32px;
    font-size: 24px;
    text-transform: uppercase;
    color: rgba(255, 255, 255, 0.6);
  }



  .simple {
    display: none;
  }

  .retina {
    display: block;
  }

  @media (-webkit-min-device-pixel-ratio: 2) {
    .simple {
      display: block;
    }

    .retina {
      display: none;
    }
  }

  @media (max-width: 812px) {
    .close {
      right: 50px;
      top: 50px;
    }

    .index {
      bottom: 84px;
    }

    .prev {
      left: 50px;
      top: initial;
      bottom: 76px;
      transform: none;
    }

    .next {
      right: 50px;
      bottom: 76px;
      top: initial;
      transform: none;
    }
  }

  @media (max-width: 425px) {
    .index {
      bottom: 54px;
    }

    .prev,
    .next {
      bottom: 42px;
    }
  }
</style>
