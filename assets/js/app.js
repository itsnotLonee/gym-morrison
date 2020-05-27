import Vue from 'vue'
import Dashboard from './Dashboard.vue'
import Promote from './Promote.vue'
import userIndex from './userIndex.vue'
import userDashboard from './userDashboard.vue'
import userActivities from './userActivities.vue'
import userPayment from './userPayment.vue'
import Profile from './Profile.vue'
import MyActivities from './MyActivities.vue'
import AllActivities from './AllActivities.vue'
import JwPagination from 'jw-vue-pagination';
import moment from 'moment';
import VueRouter from 'vue-router';

Vue.component('jw-pagination', JwPagination);

Vue.component('user-dashboard', userDashboard)

Vue.use(VueRouter)


const routes = [
    { path: '/dashboard', name: 'dashboard', component: userDashboard },
    { path: '/activities', name: 'activities', component: userActivities },
    { path: '/payment', name: 'payment', component: userPayment },
    { path: '/', redirect: '/dashboard'}
]

const router = new VueRouter({
    routes // short for `routes: routes`
})

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
    components: {Dashboard, Promote, userIndex, userDashboard, userActivities, userPayment, Profile, MyActivities, AllActivities},
    router
})