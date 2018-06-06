<template>
  <div class="team">
    <Header />
    <div class="arrow left"></div>
    <div class="title">team</div>

    <div class="members-wrapper">
      <div class="member">
        <div class="member-photo"/>
        <div class="descr">
          <div class="name">Alexandr<br/>Dmitrenko</div>
          <div class="position">race-driver</div>
          <div class="birth">
            <div class="descr-item">
              Birth:
              <div class='descr-value'>1992</div>
            </div>
            <div class="descr-item">
              Location: 
              <div class='descr-value'>Moscow</div>
            </div>
          </div>
          <div class="descr-item">
            Superpower
            <div class='descr-value'>Ride slideaways by car</div>
          </div>
          <div class="descr-item">
            Favorite car
            <div class='descr-value'>BMW</div>
          </div>
        </div>
      </div>
      <div class="member">
        <div class="member-photo"/>
        <div class="descr">
          <div class="name">Alexandr<br/>Dmitrenko</div>
          <div class="position">race-driver</div>
          <div class="birth">
            <div class="descr-item">
              Birth:
              <div class='descr-value'>1992</div>
            </div>
            <div class="descr-item">
              Location: 
              <div class='descr-value'>Moscow</div>
            </div>
          </div>
          <div class="descr-item">
            Superpower
            <div class='descr-value'>Ride slideaways by car</div>
          </div>
          <div class="descr-item">
            Favorite car
            <div class='descr-value'>BMW</div>
          </div>
        </div>
      </div>
      <div class="member">
        <div class="member-photo"/>
        <div class="descr">
          <div class="name">Alexandr<br/>Dmitrenko</div>
          <div class="position">race-driver</div>
          <div class="birth">
            <div class="descr-item">
              Birth:
              <div class='descr-value'>1992</div>
            </div>
            <div class="descr-item">
              Location: 
              <div class='descr-value'>Moscow</div>
            </div>
          </div>
          <div class="descr-item">
            Superpower
            <div class='descr-value'>Ride slideaways by car</div>
          </div>
          <div class="descr-item">
            Favorite car
            <div class='descr-value'>BMW</div>
          </div>
        </div>
      </div>
    </div>

    <div class="arrow right"></div>
    <div class="footer-wrapper">
      <Footer />
    </div>
  </div>
</template>


<script>
export default {
  components: {
    Header: () => import('@/components/Header'),
    Footer: () => import('@/components/Footer')
  }
}
</script>


<style lang="scss" scoped>
  .team {
    font-family: 'DIN Condensed';
    position: relative;
    height: 100vh;
    min-height: 700px;
    width: 100%;
    padding: 200px 0;
    padding-left: 320px;
    background: #683FFF;
  }

  .members-wrapper {
    display: flex;
  }


  .title {
    font-size: 48px;
    margin-bottom: 25px;
    color: #fff;
    text-transform: uppercase;
  }


  .member {
    display: flex;
    margin-right: 80px;
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
    height: 360px
  }
  .arrow {
    position: absolute;
    cursor: pointer;
    background: url('~/static/team/arrow.svg') center center no-repeat / contain;
    height: 50px;
    width: 28px;
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
    position: absolute;
    bottom: 80px;
    left: 0;
    width: 100%;
  }



@media ( max-width: 768px) {

  .team {
    padding: 200px 100px;
    height: 100%;
  }

  .arrow {
    display: none;
  }
  
  .member {
    display: block;
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
}

@media (max-width: 375px) {
  .team {
    padding: 180px 50px;
  }
}
</style>
