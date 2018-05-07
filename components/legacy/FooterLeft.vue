<template>
  <div class="footer">
    <div class="share">
      Share
    </div>
    <div class="socials">
      <div class="socials-item socials-youtube">
        <img src="@/assets/images/youtube.svg">
      </div>
      <div class="socials-item socials-youtube">
        <img src="@/assets/images/inst.svg">
      </div>
      <div class="socials-item socials-youtube">
        <img src="@/assets/images/facebook.svg">
      </div>
    </div>
  </div>
</template>

<script>
  export default {

  }
</script>

<style lang="scss" scoped>
  .footer {
    position: relative;
    z-index: 1;

    display: flex;
    flex-flow: row wrap;

    margin-top: 92px;

    // &:hover {
    //   .share {
    //     background: #683FFF;
    //     transition: 0.5s background ease;
    //   }
    // }
  }

  .share {
    width: 37.3%;;

    font-size: 20px;
    color: #E0E0E0;
    text-transform: uppercase;
  }

  .socials {
    display: flex;
    flex-flow: row nowrap;
    justify-content: space-between;

    width: 100px;

    &-item {
      height: 20px;
      border-radius: 6px;
      transition: 0.5s background ease;
      &:hover {
        background: #683FFF;
      }
    }
  }

  @media (max-width: 1024px) {
    .footer {
      display: none;
    }
  }
</style>
