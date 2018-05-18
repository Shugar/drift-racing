<template>
  <section class="partners">
    <Header />
    <div class="container">
      <div class="title">Partners</div>
      <div class="partners-list">
        <div class="partner" v-for="(partner, index) in partners" :key="index">
          <div class="partner-name">{{ partner.name }}</div>
          <div class="partner-description">{{ partner.description }}</div>
        </div>
      </div>
    </div>
    <Footer />
  </section>
</template>

<script>
  export default {
    components: {
      Header: () => import('@/components/Header'),
      Footer: () => import('@/components/Footer')
    },

    computed: {
      partners () {
        return this.$store.state.entities.partner
      }
    }
  }
</script>

<style lang="scss" scoped>
  .partners {
    min-height: 100vh;
    background: #683FFF;
    padding: 200px 0 80px;

    display: flex;
    flex-flow: column nowrap;
    justify-content: space-between;
  }

  .container {
    flex: 1;
    position: relative;
    padding: 0 100px;

    padding-left: 320px;

    display: flex;
    flex-flow: column nowrap;
  }

  .title {
    font-family: 'DIN Condensed', sans-serif;
    font-style: normal;
    font-weight: bold;
    line-height: 60px;
    font-size: 48px;
    text-transform: uppercase;
    color: #FFFFFF;
  }

  .partners-list {
    margin-bottom: 40px;
    flex: 1;
    display: flex;
    flex-flow: row wrap;
    justify-content: space-between;
    align-items: center;
  }

  .partner {
    padding-right: 60px;
    flex: 0 0 33%;
  }

  .partner-name {
    font-family: 'DIN Condensed', sans-serif;
    font-style: normal;
    font-weight: bold;
    line-height: 52px;
    font-size: 36px;
    text-transform: uppercase;
    color: #FFFFFF;
  }

  .partner-description {
    font-style: normal;
    font-weight: 500;
    line-height: 28px;
    font-size: 18px;
    color: rgba(255, 255, 255, 0.8);
  }

  @media (max-width: 768px) {
    .container {
      padding-left: 100px;
      justify-content: space-between;
    }

    .partners-list {
      margin-bottom: 80px;
      flex: 0;
      flex-flow: row wrap;
    }

    .partner {
      margin-right: 0;
      flex: 0 0 51%;
      margin-top: 60px;
    }
  }

  @media (max-width: 425px) {
    .container {
      padding: 0 30px;
    }

    .partners,
    .partners-list,
    .container {
      display: block;
    }

    .partner,
    .partner:last-child {
      margin-top: 40px;
    }

    .partner:first-child {
      margin-top: 30px;
    }
  }
</style>
