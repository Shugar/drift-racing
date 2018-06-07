<template>
  <div class="team">
    <Header />
    <div class="wrapper">
      <div class="arrow left" @click="prevSlide()" />
      <div class="fade-left" />
      <div class="title">team</div>

      <div class="members-wrapper">
        <div
            v-for="(item, index) in team"
            :style="{left: count === 0 ? index*550 + 'px' : index*550 - count*550 + 'px'}"
            :key="index"
            class="member">
          <div class="member-photo" :style="{background: 'url(http://' + item.image.fields.file.url.slice(2) + ') no-repeat center / cover'}">
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
                Birth:
                <div class='descr-value'>{{ item.birth }}</div>
              </div>
              <div class="descr-item">
                Location:
                <div class='descr-value'>{{ item.location }}</div>
              </div>
            </div>
            <div class="descr-item">
              Superpower
              <div class='descr-value'>{{ item.superpower }}</div>
            </div>
            <div class="descr-item">
              Favorite car
              <div class='descr-value'>{{ item.favorite }}</div>
            </div>
          </div>
        </div>
      </div>

      <div class="count">
        
      </div>

      <div class="arrow right"  @click="nextSlide()"/>
      <div class="fade-right" />
    </div>
    <div class="footer-wrapper">
      <Footer />
    </div>
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
      return this.count > 0 ? this.count-- : this.count = 0
    }
  },

  computed: {
    meta () {
      return this.$store.state.meta[this.$store.state.locale][this.$route.name]
    },

    team () {
      return this.$store.state.entities.team
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
    background: #683FFF;
    padding: 200px 0 80px;
  }

  .wrapper {
    min-height: 500px;
    padding: 0 80px;
    position: relative;
    padding-left: 240px;
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

    transition: left .2s ease;
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

  .member-photo {
    background: url("~/static/team/team-member.jpeg") center center no-repeat / cover;
    width: 240px;
    height: 360px;
    padding: 30px;
    display: flex;
    flex-flow: column nowrap;
    justify-content: flex-end;
  }

  .fade-left {
    position: absolute;
    top: 0;
    left: 0;
    height: 100%;
    width: 320px;
    background: linear-gradient(90deg, #683FFF 0, rgba(104, 63, 255, 0) 100%);
    z-index: 3;
  }

  .fade-right {
    position: absolute;
    top: 0;
    right: 0;
    height: 100%;
    width: 50%;
    background: linear-gradient(-90deg, #683FFF 0, rgba(104, 63, 255, 0) 100%)
  }

  .arrow {
    position: absolute;
    cursor: pointer;
    background: url('~/static/team/arrow.svg') center center no-repeat / contain;
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
 
 ////////////// SOCIALS /////////////////////////
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






@media ( max-width: 1024px) {

  .wrapper {
    padding: 0 80px;
  }

  .team {
    padding: 200px 0px;
    height: 100%;
  }

  .arrow {
    display: none;
  }

  .member {
    display: block;
    position: initial;
    // left: initial;
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
  }

  .members-wrapper {
    flex-wrap: wrap;
  }

  .fade-left,
  .fade-right {
    display: none;
  }
}

@media (max-width: 425px) {
  .team {
    padding: 180px 0;
  }

  .wrapper {
    padding: 0 40px;
  }
}
</style>
