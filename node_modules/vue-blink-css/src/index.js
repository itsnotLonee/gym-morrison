import Vue from 'vue'
import VueBlink from './VueBlink.vue'

const plugin = {
  install(Vue, options) {
  	Vue.component('VueBlink', VueBlink)
  }
}

export default plugin
