import Vue from 'vue'
import Dashboard from './Dashboard.vue'
import Profile from './Profile.vue'

Vue.use(require('vue-moment'))

new Vue({
    el: "#app",
    components: {Dashboard, Profile}
})