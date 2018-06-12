<template>
  <div class="footer" :class="{ 'isHome': $route.path === '/'}">
    <div class="left" :class="{ mainLeft: type === 'main' }">
      <div @click="toggleSharing()" class="share" :class="{'share-active': isSharingActive}">
        <div v-if="isSharingActive" class="sharing" :class="{'sharing-purple': $route.path === '/'}">
          <div class="sharing-title">{{locale === 'en' ? 'Tell your friends in' : 'Расскажи о нас друзьям'}}</div>
          <div class="sharing-socials">
            <social-sharing :url="url"
              :title="meta.title"
              :description="meta.description"
              :hashtags="meta.keywords"
              inline-template>
              <div>
                  <network network="facebook">
                    <i class="fa fa-facebook"></i> Facebook
                  </network>
                  <network network="twitter">
                    <i class="fa fa-twitter"></i> Twitter
                  </network>
                  <network network="vk">
                    <i class="fa fa-vk"></i> vk.com
                  </network>
              </div>
            </social-sharing>
          </div>
        </div>
        {{locale === 'en' ? 'SHARE' : 'ПОДЕЛИТЬСЯ'}}
      </div>
      <div class="socials">
        <a href="https://www.youtube.com/c/AlexDProDrift" class="socials-youtube"></a>
        <a href="https://www.instagram.com/alexd_prodrift/ " class="socials-instagram"></a>
        <a href="https://vk.com/alexd_prodrift " class="socials-facebook"></a>
      </div>
    </div>

    <div class="right" :class="{ mainRight: type === 'main' }">
      <div class="lang">
        <span :class="{'lang-active': locale === 'ru'}" @click="setRU()">RU</span> — <span :class="{'lang-active': locale === 'en'}" @click="setEN()">EN</span>
      </div>

      <div class="copy">
        MADE BY APUS <span>AGENCY</span>
      </div>
    </div>
  </div>
</template>


<script>
export default {
  props: ['type', 'propMeta'],

  data () {
    return {
      isSharingActive: false,
      url: ''
    }
  },

  methods: {
    setRU () {
      this.$store.commit('setLocale', 'ru')
      this.$router.push('/')
    },

    setEN () {
      this.$store.commit('setLocale', 'en')
      this.$router.push('/')
    },

    toggleSharing () {
      this.isSharingActive = !this.isSharingActive
    }
  },

  computed: {
    locale () {
      return this.$store.state.locale
    },

    meta () {
      const meta = this.$store.state.meta[this.$store.state.locale][this.$route.name]
      return meta !== undefined ? meta : this.propMeta
    }
  },

  mounted () {
    this.url = window.location.href
    console.log(this.meta)
  }
}
</script>

<style lang="scss" scoped>
  .footer {
    position: relative;
    padding: 0px 100px;
    display: flex;
    flex-flow: row nowrap;
    justify-content: space-between;
    align-items: center;
    z-index: 6;
  }

  .share {
    position: relative;
    cursor: pointer;
    user-select: none;
    margin-right: 120px;
    width: 100px;
    flex: 0 0 100px;

    font-family: 'DIN Condensed', sans-serif;
    font-style: normal;
    font-weight: bold;
    line-height: normal;
    font-size: 20px;
    text-transform: uppercase;
    color: #E0E0E0;

    transition: color .2s ease;
    will-change: color;

    &:hover {
      color: #FFF;
    }

    &.share-active {
      color: #FFF;
    }
  }

  .sharing {
    position: absolute;
    top: -77px;
    left: 0;
    min-width: 210px;
    padding: 10px;
    padding-bottom: 5px;

    background: #000000;
    color: #E0E0E0;
    text-transform: uppercase;
    transition: opacity .5s ease;

    &.sharing-purple {
      background: #683FFF;
    }

    &-socials {
      color: #fff;
    }

    span {
      display: inline-block;
      &:not(:last-child) {
        margin-right: 10px;
      }
    }
  }

  .left {
    flex: 0 0 60%;
    display: flex;
    flex-flow: row nowrap;
    justify-content: flex-start;
    align-items: center;
  }

  .mainLeft {
    flex: 0 0 55%;
  }

  .right {
    padding-left: 50px;
    flex: 0 0 40%;
    display: flex;
    flex-flow: row nowrap;
    justify-content: space-between;
    align-items: center;
  }

  .mainRight {
    flex: 0 0 45%;
    padding-left: 110px;
  }

  .socials {
    margin-bottom: 6px;
    display: flex;
    flex-flow: row nowrap;
    align-items: center;
  }

  .socials-youtube:before,
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

  .socials-youtube:hover:before,
  .socials-facebook:hover:before,
  .socials-instagram:hover:before {
    background-color: #000;
  }

  .isHome {
    .socials-youtube:hover:before,
    .socials-facebook:hover:before,
    .socials-instagram:hover:before {
      background-color: #673fff;
    }
  }

  .socials-youtube {
    background: url('~/assets/images/youtube.svg') no-repeat center / contain;
    width: 20px;
    height: 20px;
    margin-right: 20px;
    position: relative;
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

  .lang,
  .copy {
    font-family: 'DIN Condensed', sans-serif;
    font-style: normal;
    font-weight: bold;
    line-height: normal;
    font-size: 20px;
    text-transform: uppercase;
    color: #E0E0E0;
  }

  .lang span {
    color: #E0E0E0;
    transition: color .2s ease;
    will-change: color;
    cursor: pointer;
  }

  .lang span:hover {
    color: #FFF;
  }

  .lang-active {
    color: #FFF !important;
  }

  @media (max-width: 768px) {
    .share {
      margin-right: 19px;
    }

    .copy span {
      display: none;
    }

    .right {
      padding-left: 20px;
    }
  }

  @media (max-width: 425px) {
    .footer {
      padding: 0 30px;
    }

    .left {
      flex: 1;
      justify-content: space-between;
    }

    .right {
      display: none;
    }
  }
</style>
