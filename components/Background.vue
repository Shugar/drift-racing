<template>
  <div class="section">
    <div class="section__img">
      <div class="section__img-inner"></div>
    </div>
  </div>
</template>

<script>
  export default {
    data () {
      return {

      }
    },

    methods: {

    },

    mounted () {

    }
  }
</script>

<style lang="scss" scoped>
  .section {
    height: auto;
		overflow: hidden;
		z-index: 99;
  }

	.js .section:not(.section--current) .section__img-inner {
		opacity: 0;
	}
</style>
