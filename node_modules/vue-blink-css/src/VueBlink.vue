<template>
  <div id="vue-blink" :style="blinkStyling">
      <slot></slot>
  </div>
</template>

<script>
export default {
  name: 'vue-blink',
  props: {
    duration: {
      type: Number,
      required: false,
      default: 5
    },
    iterationCount: {
      required: false,
      default: 'infinite'
    }
  },
  computed: {
    blinkStyling () {
      return {
        animationName: 'blink',
        animationDuration: `${this.duration}s`,
        animationIterationCount: `${this.iterationCount}`
      }
    }
  }
}
</script>

<style>
@keyframes blink {
  1% {
    visibility: visible;
  }

  50% {
    visibility: hidden;
  }

  100% {
    visibility: hidden;
  }
}
</style>
