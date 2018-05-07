<template>
  <section class="container">
    <div>
      <h1 class="title">
        DRIFT
      </h1>
      <div class="links">
        <nuxt-link to="/bio/">BIO</nuxt-link><br>
        <nuxt-link to="/news/">NEWS</nuxt-link><br>
        <nuxt-link to="/video/">VIDEO</nuxt-link><br>
        <nuxt-link to="/photo/">PHOTO</nuxt-link><br>
        На странице PHOTO уже работает открытие картинок в модальном окне
      </div>
    </div>
  </section>
</template>

<script>

</script>

<style lang="scss" scoped>
.container {
  min-height: 100vh;
  display: flex;
  justify-content: center;
  align-items: center;
  text-align: center;
}

.title {
  font-family: "Quicksand", "Source Sans Pro", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif; /* 1 */
  display: block;
  font-weight: 300;
  font-size: 100px;
  color: #35495e;
  letter-spacing: 1px;
}

.subtitle {
  font-weight: 300;
  font-size: 42px;
  color: #526488;
  word-spacing: 5px;
  padding-bottom: 15px;
}

.links {
  padding-top: 15px;
}
</style>
