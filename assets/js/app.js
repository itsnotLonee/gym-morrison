import Vue from 'vue'
import Dashboard from './Dashboard.vue'
import Profile from './Profile.vue'
import MyActivities from './MyActivities.vue'
import AllActivities from './AllActivities.vue'
import JwPagination from 'jw-vue-pagination';

Vue.component('jw-pagination', JwPagination);

Vue.use(require('vue-moment'))

import moment from 'moment';

Vue.filter('formatDate', function(value) {
        if (value) {
            return moment(String(value)).format('MM/DD/YYYY')
        }
    }
)

Vue.filter('formatTime', function(value) {
        if (value) {
            return moment(String(value)).format('hh:mm')
        }
    }
)

new Vue({
    el: "#app",
    components: {Dashboard, Profile, MyActivities, AllActivities}
})