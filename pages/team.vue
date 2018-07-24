<template>
  <div class="team">
    <Header />
    <div class="wrapper">
      <u-animate
        name="fadeIn"
        delay="0.6s"
        duration="0.4s"
        :iteration="1"
        :offset="0"
        animateClass="animated"
        :begin="true"
      >
        <div class="arrow left" @click="prevSlide()" />
      </u-animate>
      <div class="fade-left" />
      <u-animate
        name="fadeInUp"
        delay="0s"
        duration="0.4s"
        :iteration="1"
        :offset="0"
        animateClass="animated"
        :begin="true"
      >
        <div class="title">{{ locale === 'en' ? 'TEAM' : 'КОМАНДА' }}</div>
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
        <div class="members-wrapper">
          <div
              v-for="(item, index) in team"
              :style="{
                left: count === 0 ? index*550 + 'px' : index*550 - count*550 + 'px',
                opacity: count === index ? '1' : '0.2'
              }"
              :key="index"
              class="member">
            <div class="member-photo" :style="{background: getImageMeta('http://' + item.image.fields.file.url.slice(2)) + ' no-repeat center / cover'}">
              <div class="socials">
                <a :href="item.instagram" class="socials-instagram"></a>
                <a :href="item.facebook" class="socials-facebook"></a>
              </div>
            </div>
            <div class="member-photo-retina" :style="{background: 'url(http://' + item.image.fields.file.url.slice(2) + ') no-repeat center / cover'}">
              <div class="socials">
                <a :href="item.instagram" class="socials-instagram"></a>
                <a :href="item.facebook" class="socials-facebook"></a>
              </div>
            </div>
            <div class="member-photo member-photo-mobile" :style="{background: 'url(http://' + item.imageMobile.fields.file.url.slice(2) + ') no-repeat center / cover'}">
              <div class="socials">
                <a :href="item.instagram" class="socials-instagram"></a>
                <a :href="item.facebook" class="socials-facebook"></a>
              </div>
            </div>
            <div class="descr">
              <div class="name">{{ item.name }}</div>
              <div class="position">{{ item.position }}</div>
              <div class="birth">
                <div class="descr-item">
                  {{locale === 'en' ? 'Birth:' : 'Год рожд.'}}
                  <div class='descr-value'>{{ item.birth }}</div>
                </div>
                <div class="descr-item">
                  {{locale === 'en' ? 'Location:' : 'Локация'}}
                  <div class='descr-value'>{{ item.location }}</div>
                </div>
              </div>
              <div class="descr-item superpower">
                {{locale === 'en' ? 'Superpower' : 'Суперсила'}}
                <div class='descr-value'>{{ item.superpower }}</div>
              </div>
              <div class="descr-item">
                {{locale === 'en' ? 'Favorite car' : 'Любимая машина'}}
                <div class='descr-value'>{{ item.favorite }}</div>
              </div>
              <div class="socials socials-mobile">
                <a :href="item.instagram" class="socials-instagram"></a>
                <a :href="item.facebook" class="socials-facebook"></a>
              </div>
            </div>
          </div>

        </div>
      </u-animate>
        <div class="counter">
          <u-animate
            name="fadeInUp"
            delay="0.4s"
            duration="0.4s"
            :iteration="1"
            :offset="0"
            animateClass="animated"
            :begin="true"
          >
            {{ count + 1 + '/' + team.length }}
          </u-animate>
        </div>
        <u-animate
          name="fadeIn"
          delay="0.6s"
          duration="0.4s"
          :iteration="1"
          :offset="0"
          animateClass="animated"
          :begin="true"
        >
          <div class="arrow right"  @click="nextSlide()"/>
        </u-animate>
      <div class="fade-right" />
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
      <!-- <div class="footer-wrapper"> -->
        <Footer />
      <!-- </div> -->
    </u-animate>
  </div>
</template>


<script>
export default {
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

  data () {
    return {
      count: 0
    }
  },

  methods: {
    nextSlide () {
      this.team.length - 1 > this.count ? this.count++ : this.count = 0
    },

    prevSlide () {
      return this.count > 0 ? this.count-- : this.count = this.team.length - 1
    },

    getImageMeta (url) {
      let img = new Image
      img.src = url
      img.onload = () => {
         return `url(${url}?w=${img.width/2}&h=${img.height/2})`
      }
      return img.onload()
    }
  },

  computed: {
    meta () {
      return this.$store.state.meta[this.$store.state.locale][this.$route.name]
    },

    team () {
      return this.$store.state.entities.team
    },

    locale () {
      return this.$store.state.locale
    }
  },

  components: {
    Header: () => import('@/components/Header'),
    Footer: () => import('@/components/Footer')
  }
}
</script>


<style lang="scss" scoped>
  .team {
    font-family: 'DIN Condensed';
    min-height: 100vh;
    width: 100%;
    background: linear-gradient(216.25deg, #565656 0%, #000000 100%), #683FFF;
    padding: 200px 0 80px;
    overflow: hidden;
    display: flex;
    flex-flow: column nowrap;
    justify-content: space-between;
  }

  .wrapper {
    margin-bottom: 80px;
    min-height: 500px;
    padding: 0 80px;
    position: relative;
    padding-left: 320px;
  }

  .counter {
    font-family: 'DIN Pro Medium';
    position: absolute;
    bottom: 0;
    // left: 0;
    font-size: 24px;
    color: rgba(255, 255, 255, 0.6);
  }
  .members-wrapper {
    margin-bottom: 40px;
    position: relative;
    display: flex;
  }

  .title {
    font-size: 48px;
    margin-bottom: 25px;
    color: #fff;
    text-transform: uppercase;
  }


  .member {
    position: absolute;
    display: flex;
    margin-right: 80px;

    transition: left .2s ease, opacity .2s ease;
    will-change: left, opacity;
  }

  .descr {
    color: #fff;
    margin-left: 40px;
    width: 180px;
  }

  .name {
    font-family: 'DIN Condensed';
    font-size: 36px;
    text-transform: uppercase;
    margin-bottom: 20px;
  }

  .position {
    color: rgba(255, 255, 255, 0.8);
    text-transform: uppercase;
    margin-bottom: 20px;
    font-size: 24px;
  }

  .birth {
    display: flex;
  }

  .descr-item {
    font-family: 'DIN Pro Medium';
    font-size: 18px;
    color: rgba(255, 255, 255, 0.8);

    &:first-child {
      margin-right: 20px;
    }

    &:not(:last-child) {
      margin-bottom: 20px;
    }
  }

  .descr-value {
    color: #fff;
  }


  .member-photo, .member-photo-retina {
    width: 240px;
    height: 360px;
    padding: 30px;
    display: flex;
    flex-flow: column nowrap;
    justify-content: flex-end;
  }

  @media (-webkit-min-device-pixel-ratio: 2) {
    .member-photo {
      display: none;
    }

    .member-photo-retina {
      display: flex;
    }
  }

  .fade-left {
    position: absolute;
    top: 0;
    left: 0;
    height: 100%;
    width: 320px;
    opacity: 0.5;
    display: none;
    z-index: 3;
  }

  .fade-right {
    position: absolute;
    top: 0;
    right: 0;
    height: 100%;
    width: 50%;
    opacity: 0.5;
    display: none;
  }

  .arrow {
    position: absolute;
    cursor: pointer;
    background: url('~/static/team/arrow.svg') no-repeat center center / contain;
    height: 50px;
    width: 28px;

    z-index: 4;
  }

    .left {
      left: 100px;
      transform: translateY(-50%);
      top: 50%;
    }

    .right {
      right: 100px;
      transform: translateY(-50%) rotate(180deg);
      top: 50%;
    }

  .footer-wrapper {
    width: 100%;
  }

  .socials {
    display: flex;
    flex-flow: row nowrap;
    align-items: center;
  }

  .socials-facebook:before,
  .socials-instagram:before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    border-radius: 6px;
    z-index: -1;

    transition: background-color .3s ease;
    will-change: background-color;
  }

  .socials-facebook:hover:before,
  .socials-instagram:hover:before {
    background-color: #000;
  }

  .socials-instagram {
    background: url('~/assets/images/inst.svg') no-repeat center / contain;
    width: 20px;
    height: 20px;
    margin-right: 20px;
    position: relative;
  }

  .socials-facebook {
    background: url('~/assets/images/facebook.svg') no-repeat center / contain;
    width: 20px;
    height: 20px;
    position: relative;
  }

  .member-photo-mobile,
  .socials-mobile {
    display: none;
  }

  @media ( max-width: 1024px) {
    .wrapper {
      padding: 0 100px;
    }

    .team {
      padding: 200px 0px;
      height: 100%;
    }

    .arrow {
      display: none;
    }

    .member {
      flex: 1;
      display: block;
      position: initial;
      // left: initial;
      opacity: 1 !important;
      margin: 0;


      &-photo {
        margin-bottom: 40px;
      }

      &:nth-child(odd) {
        margin-right: 60px;
      }
    }

    .descr {
      margin: 0;
      margin-bottom: 80px;
      margin-top: 30px;
    }

    .members-wrapper {
      flex-wrap: wrap;
    }

    .fade-left,
    .fade-right {
      display: none;
    }

    .counter {
      display: none;
    }
  }

  @media (max-width: 425px) {
    .team {
      padding: 180px 0 80px;
    }

    .socials {
      display: none;
    }

    .socials-mobile {
      order: 6;
      display: flex;
    }

    .descr {
      margin-bottom: 0;
      margin-top: 0;
      position: relative;
      display: flex;
      flex-flow: column nowrap;
    }

    .name {
      order: 1;
    }

    .position {
      order: 2;
    }

    .birth {
      order: 3;
    }

    .superpower {
      order: 5 !important;
    }

    .descr-item {
      order: 4;
    }

    .birth {
      display: block;

      .descr-item {
        margin-bottom: 20px;
      }
    }

    .member {
      margin-bottom: 100px;
      position: relative;
      left: 0 !important;
      width: 100%;
      margin-right: 0 !important;

      &:last-child {
        margin-bottom: 0;
      }
    }

    .member-photo, .member-photo-retina {
      display: none;
    }

    .member-photo-mobile {
      display: block;
      position: absolute;
      right: 0;
      top: 50%;
      transform: translateY(-50%);

      &::after {
        content: '';
        left: 0;
        top: 0;
        height: 100%;
        width: 100%;
        // background: linear-gradient(180deg, rgba(51, 51, 51, 0) 0%, rgba(51, 51, 51, .8) 74.56%, #333333 103%);
        position: absolute;
      }
    }

    .wrapper {
      padding: 0 30px;
    }
  }
</style>
