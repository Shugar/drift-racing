<template>
  <section class="index">
    <Header type="main" />
    <div class="container" >
      <div class="left-background" />
      <div class="left" :class="{'isAnimating': isChanging }">
        <div class="page-title">
          <u-animate
            name="fadeInUp"
            delay="0s"
            duration="0.4s"
            :iteration="1"
            :offset="0"
            animateClass="animated"
            :begin="true"
          >
            <div>{{locale === 'en' ? 'contact' : 'контакты'}}</div>
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
            <div class="city">
              <div class="city-item"
                v-for="(item, index) in contact"
                :key="index"
                :class="{active : currentCity === item.city }"
                @click="setCurrentCity(item.city)">
                {{ item.city }}
              </div>
            </div>
          </u-animate>
        </div>
        <div class="contact-item"
          v-for="(item, index) in contact"
          :key="index"
          v-if="currentCity === item.city">
          <u-animate
            name="fadeInUp"
            delay="0.4s"
            duration="0.4s"
            :iteration="1"
            :offset="0"
            animateClass="animated"
            :begin="true"
          >
            <div class="contact-info">
              <div class="contact-title">{{locale === 'en' ? 'connect with us' : 'свяжитесь с нами'}}</div>
              <div class="contact">
                <a :href="'mailto:' + item.email">{{ item.email }}</a>
                <br/>
                <a :href="'tel:' + item.number">{{ item.number }}</a>
              </div>
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
            <div class="contact-info">
              <div class="contact-title">{{locale === 'en' ? 'location' : 'адрес'}}</div>
              <div class="contact">
                {{ item.address }}
              </div>
            </div>
          </u-animate>
        </div>
      </div>
      <div class="right">
        <!-- <div class="right-background" :style="{background: `url(/contact/map.png) no-repeat center / cover`}"/> -->
        <GmapMap
          :center="{lat: 55.8538053, lng: 37.5195491}"
          :zoom="17"
          :options="{disableDefaultUI: true, styles: styles}"
          ref="mapRef"
          style="width: 100%; height: 100%"
        >
          <GmapMarker
            :key="index"
            v-for="(m, index) in markers"
            :position="m.position"
            :icon="'/contact/marker.svg'"
            :clickable="true"
            :draggable="true"
            @click="center=m.position"
          />
        </GmapMap>
      </div>
    </div>
    <div class="footer-wrapper">
      <u-animate
        name="fadeInUp"
        delay="0.8s"
        duration="0.4s"
        :iteration="1"
        :offset="0"
        animateClass="animated"
        :begin="true"
      >
        <Footer />
      </u-animate>
    </div>
  </section>
</template>

<script>
  export default {
    data () {
      return {
        isWindows: false,
        currentCity: 'moscow',
        markers: [],
        isChanging: false,
        isPurpleChanging: false,
        styles: [
          {
            "featureType": "all",
            "elementType": "labels.text.fill",
            "stylers": [
              {
                "saturation": 36
              },
              {
                "color": "#000000"
              },
              {
                "lightness": 40
              }
            ]
          },
          {
            "featureType": "all",
            "elementType": "labels.text.stroke",
            "stylers": [
              {
                "visibility": "on"
              },
              {
                "color": "#000000"
              },
              {
                "lightness": 16
              }
            ]
          },
          {
            "featureType": "all",
            "elementType": "labels.icon",
            "stylers": [
              {
                "visibility": "off"
              }
            ]
          },
          {
            "featureType": "administrative",
            "elementType": "geometry.fill",
            "stylers": [
              {
                "color": "#000000"
              },
              {
                "lightness": 20
              }
            ]
          },
          {
            "featureType": "administrative",
            "elementType": "geometry.stroke",
            "stylers": [
              {
                "color": "#000000"
              },
              {
                "lightness": 17
              },
              {
                "weight": 1.2
              }
            ]
          },
          {
            "featureType": "landscape",
            "elementType": "geometry",
            "stylers": [
              {
                "color": "#000000"
              },
              {
                "lightness": 20
              }
            ]
          },
          {
            "featureType": "poi",
            "elementType": "geometry",
            "stylers": [
              {
                "color": "#000000"
              },
              {
                "lightness": 21
              }
            ]
          },
          {
            "featureType": "road.highway",
            "elementType": "geometry.fill",
            "stylers": [
              {
                "color": "#000000"
              },
              {
                "lightness": 17
              }
            ]
          },
          {
            "featureType": "road.highway",
            "elementType": "geometry.stroke",
            "stylers": [
              {
                "color": "#000000"
              },
              {
                "lightness": 29
              },
              {
                "weight": 0.2
              }
            ]
          },
          {
            "featureType": "road.arterial",
            "elementType": "geometry",
            "stylers": [
              {
                "color": "#000000"
              },
              {
                "lightness": 18
              }
            ]
          },
          {
            "featureType": "road.local",
            "elementType": "geometry",
            "stylers": [
              {
                "color": "#000000"
              },
              {
                "lightness": 16
              }
            ]
          },
          {
            "featureType": "transit",
            "elementType": "geometry",
            "stylers": [
              {
                "color": "#000000"
              },
              {
                "lightness": 19
              }
            ]
          },
          {
            "featureType": "water",
            "elementType": "geometry",
            "stylers": [
              {
                "color": "#000000"
              },
              {
                "lightness": 17
              }
            ]
          }
        ]
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

    components: {
      Header: () => import('@/components/Header.vue'),
      Footer: () => import('@/components/Footer.vue')
    },

    computed: {
      meta () {
        return this.$store.state.meta[this.$store.state.locale][this.$route.name]
      },

      contact () {
        return this.$store.state.entities.contact
      },

    locale () {
      return this.$store.state.locale
    }
    },

    mounted () {
      this.isPurpleChanging = true
      this.isChanging = false
      this.$refs.mapRef.$mapPromise.then((map) => {
        this.contact.map((item, index) => {
          if (item.city === this.currentCity) {
            map.panTo({
              lat: item.mapLat,
              lng: item.mapLng
            })
          }

          this.markers.push({
            position: { lat: item.mapLat, lng: item.mapLng }
          })
        })
      })
    },

    beforeRouteLeave(to, from, next) {
      this.isChanging = true
      this.isPurpleChanging = false
      setTimeout(() => next(), 300)
    },

    methods: {
      setCurrentCity (city) {
        this.currentCity = city
        this.$refs.mapRef.$mapPromise.then((map) => {
          this.contact.map((item, index) => {
            if (item.city === city) {
              map.panTo({
                lat: item.mapLat,
                lng: item.mapLng
              })
            }
          })
        })
      }
    }
  }
</script>

<style lang="scss" scoped>
  .index {
    position: relative;
    height: 100vh;
    min-height: 700px;
  }

  .container {
    height: 100%;
    display: flex;
    flex-flow: row nowrap;
    background: #565656;
  }

  .left-background {
    width: 100%;
    height: 100%;
    background: #565656;
    position: absolute;
    top: 0;
    left: 0;
    transform: translateX(0%);
    z-index: 4;

    transition: transform 1s ease;
    will-change: transform;
  }

  .isPurpleChanging {
    transform: translateX(-45%);
  }

  .left {
    flex: 0 0 55%;
    min-width: 728px;
    position: relative;
    // padding-bottom: 230px;
    display: flex;
    flex-flow: column nowrap;
    justify-content: center;
    font-family: 'DIN Condensed';
    text-transform: uppercase;
    color: #fff;
    padding: 180px 0 140px;
    padding-left: 100px;
    z-index: 6;


    transition: transform .4s ease, opacity .4s ease;
    will-change: transform, opacity;
  }

  .page-title {
    font-size: 48px;
    margin-left: 220px;
    margin-bottom: 90px;
  }

  .city {
    display: flex;
    justify-content: space-between;
    font-size: 20px;
    color: #fff;
    width: 180px;
    margin-top: 40px;

  }

  .city-item {
    cursor: pointer;

    &.active {
      position: relative;
      color: #683FFF;
      z-index: 1;

      &:before {
        content: '';
        display: block;
        position: absolute;
        top: -3px;
        left: -2px;
        width: calc(100% + 5px);
        height: 100%;
        background: #fff;
        z-index: -1;
      }
    }
  }

  .contact-info {
    display: flex;
    width: 560px;
    min-width: 256px;
    margin-bottom: 40px;
  }

  .contact {
    font-size: 36px;
    margin-left: 60px;
    max-width: 310px;

    a {
      color: #FFF;
      text-decoration: none;
    }
  }

  .contact-title {
    font-size: 24px;
    width: 160px;
    opacity: 0.8;
  }

  .right {
    position: relative;
    height: 100%;
    flex: 0 0 45%;
    display: flex;
    flex-flow: column nowrap;
    justify-content: flex-end;
    background: #333333;

    .right-background {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      z-index: 0;
    }
  }

  .footer-wrapper {
    width: 100%;
    position: absolute;
    z-index: 10;
    bottom: 60px;
  }

  .category-animation-enter-active, .category-animation-leave-active {
    transition: transform .3s;
  }

  .category-animation-leave-to {
    transform: translateY(-110%);
  }

  .category-animation-enter {
    transform: translateY(110%);
  }

  @media (max-width: 1024px) {
    .left-background {
      display: none;
    }

    .index {
      min-height: 100vh;
      height: auto;
    }
    .container {
      flex-flow: column nowrap;
      height: 100%;
    }

    .left {
      flex-flow: row wrap;
      align-items: flex-end;
      justify-content: flex-start;
      padding-bottom: 0;
      height: 70%;
      min-width: auto;
      padding-top: 0;
    }

    .right {
      height: 550px;

    }

    .page-title {
      margin: 0;
      margin-top: 190px;
      margin-bottom: 20px;
      width: 100%;
    }

    .contact-info {
      flex-flow: column nowrap;
      width: 50%;
      &:last-child {
        margin-bottom: 40px;
      }
    }

    .contact {
      margin-left: 0;
      font-size: 24px;
    }

    .contact-item {
      display: flex;
      flex-flow: row wrap;
      margin-bottom: 30px;
    }

    .contact-title {
      margin-bottom: 20px;
    }
  }

  @media (max-width: 425px) {

    .index {
      height: auto;
    }

    .left {
      // flex: 0 0 85%;
      padding-left: 55px;
      align-items: flex-start;
    }

    .right {
      height: 400px;
    }

    .page-title {
      margin-top: 0;
      width: 100%;
      margin-top: 150px;
    }

    .contact-title {
      margin-bottom: 15px;
    }

    .contact-info {
      width: 100%;
      margin-bottom: 15px;
      &:last-child {
        margin-bottom: 15px;
      }
    }

    .footer-wrapper {
      position: absolute;
      bottom: 40px;
    }
  }
</style>

<style lang="scss">
  .gmnoprint,
  .gm-style-cc {
    display: none !important;
  }

  .vue-map div a div img {
    display: none;
  }
</style>