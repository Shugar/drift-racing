<template>
  <div class="header">
    <ul class="main-nav__right">
      <div class="main-nav__right-wrapper">
        <li class="nav__item">
          <a href="#" class="nav__link">News</a>
        </li>
        <li class="nav__item">
          <a href="#" class="nav__link">Store</a>
        </li>
        <li class="nav__item">
          <a href="#" class="nav__link">Partners</a>
        </li>
      </div>
      <li class="nav__item nav__item-contact">
        <a href="#" class="nav__link">Contact</a>
      </li>
    </ul>
  </div>
</template>

<script>
  export default {

  }
</script>

<style scoped>
  .main-nav__right {
    display: flex;
    flex-flow: row nowrap;
    justify-content: space-between;

    max-width: 460px;
    width: 100%;
    padding-top: 83px;
  }

  .main-nav__right-wrapper {
    display: flex;
    flex-flow: row nowrap;
    justify-content: space-between;
    max-width: 220px;
    width: 100%;
  }

  .nav__link {
    text-transform: uppercase;
    font-size: 20px;
    line-height: 23px;
    color: #E0E0E0;
  }
</style>
