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
    <div class="footer-right">
      <div class="footer-lang">
        Ru-en
      </div>
      <div class="footer-made">
        Made by Apus AgencyMade by Apus
      </div>
    </div>
  </div>
</template>

<script>
  export default {

  }
</script>

<style scoped>
  .footer {
    display: none;
    position: relative;
    z-index: 1;

    flex-flow: row nowrap;

    margin-top: 92px;
  }

  .footer-left {
    flex: 1;
    display: flex;
    flex-flow: row nowrap;
  }

  .share {
    width: 28.3%;

    font-size: 20px;
    color: #E0E0E0;
    text-transform: uppercase;
  }

  .socials {
    display: flex;
    flex-flow: row nowrap;
    justify-content: space-between;

    max-width: 100px;
    width: 100%;
  }

  .footer-right {
    flex: 1;
    display: flex;
    flex-flow: row nowrap;

    max-width: 460px;
    justify-content: flex-end;

    font-size: 20px;
    text-transform: uppercase;
    color: #E0E0E0;
  }

  .footer-lang {
    margin-right: 60px;
  }

  @media (max-width: 1024px) {
    .footer {
      display: flex;
    }
  }

  @media (max-width: 420px) {
    .footer {
      margin-top: 55px;
      justify-content: space-between;
    }

    .footer-right {
      display: none;
    }

    .share {
      width: initial;
    }
  }
</style>
