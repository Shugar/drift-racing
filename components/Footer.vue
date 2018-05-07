<template>
  <div class="footer">
    <div class="left">
      <div class="share">
        SHARE
      </div>
      <div class="socials">
        <a href="#" class="socials-youtube"></a>
        <a href="#" class="socials-instagram"></a>
        <a href="#" class="socials-facebook"></a>
      </div>
    </div>

    <div class="right">
      <div class="lang">
        RU — EN
      </div>

      <div class="copy">
        MADE BY APUS AGENCY
      </div>
    </div>
  </div>
</template>

<style lang="scss" scoped>
  .footer {
    position: relative;
    padding: 0px 100px;
    display: flex;
    flex-flow: row nowrap;
    justify-content: space-between;
    align-items: center;
  }

  .share {
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
  }

  .left {
    flex: 0 0 60%;
    display: flex;
    flex-flow: row nowrap;
    justify-content: flex-start;
    align-items: center;
  }

  .right {
    padding-left: 50px;
    flex: 0 0 40%;
    display: flex;
    flex-flow: row nowrap;
    justify-content: space-between;
    align-items: center;
  }

  .socials {
    margin-bottom: 6px;
    display: flex;
    flex-flow: row nowrap;
    align-items: center;
  }

  .socials-youtube {
    background: url('~/assets/images/youtube.svg') no-repeat center / contain;
    width: 20px;
    height: 20px;
    margin-right: 20px;
  }

  .socials-instagram {
    background: url('~/assets/images/inst.svg') no-repeat center / contain;
    width: 20px;
    height: 20px;
    margin-right: 20px;
  }

  .socials-facebook {
    background: url('~/assets/images/facebook.svg') no-repeat center / contain;
    width: 20px;
    height: 20px;
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

  @media (max-width: 768px) {
    .share {
      margin-right: 19px;
    }
  }

  @media (max-width: 425px) {
    .footer {
      padding: 0 50px;
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
