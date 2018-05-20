<template>
  <div
    :class="{'lightbox': true, 'lightbox-visible': $store.state.lightboxPhotoPath !== ''}"
    :style="{background: 'url(' + $store.state.lightboxPhotoPath + ') no-repeat center / cover'}">
    <div class="close" @click="$store.commit('closeLightbox')" />
    <div class="prev" @click="prev()" />
    <div class="next" @click="next()" />
    <div class="index">
      {{ $store.state.lightboxIndex + 1 }}/{{ $store.state.lightboxLength }}
    </div>
  </div>
</template>

<script>
  export default {
    data () {
      return {
        index: this.$store.state.lighboxIndex
      }
    },

    methods: {
      prev () {
        this.$store.state.lighboxIndex
      },

      next () {

      }
    }
  }
</script>

<style lang="scss" scoped>
  .lightbox {
    position: fixed;
    height: 100%;
    width: 100%;
    z-index: 11;
    display: none;

    &.lightbox-visible {
      display: block;
    }
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
    }

    .next {
      right: 50px;
    }
  }
</style>
