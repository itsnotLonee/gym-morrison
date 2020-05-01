import Vue from 'vue'
import Dashboard from './Dashboard.vue'
import userDashboard from './userDashboard.vue'
import Profile from './Profile.vue'
import MyActivities from './MyActivities.vue'
import AllActivities from './AllActivities.vue'
import JwPagination from 'jw-vue-pagination';

Vue.component('jw-pagination', JwPagination);

import moment from 'moment';
Vue.use(require('vue-moment'))

Vue.filter('formatDate', function(value) {
        if (value) {
            return moment(String(value)).format('MM/DD/YYYY')
        }
    }
)

Vue.filter('formatTime', function(value) {
        if (value) {
            return moment(String(value)).format('HH:mm')
        }
    }
)

new Vue({
    el: "#app",
    components: {Dashboard, userDashboard, Profile, MyActivities, AllActivities}
})