<template>
    <div>
        <!-- NavTop -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top pt-3 mb-3" id="navbar-head">
            <div class="col-4">
            </div>
            <div class="col-4">
                <div class="d-flex justify-content-center">
                    <router-link to="/dashboard">
                        <h3 class="text-primary"><i class="fas fa-dumbbell"></i>
                            Gym-Morrison</h3>
                    </router-link>
                </div>
            </div>
            <div class="col-4">
                <div class="header-right float-left ml-5">
                    <ul class="clearfix">
                        <a class="text-danger font-small" data-toggle="modal" data-target="#basicModal"><i class="fas fa-sign-out-alt"></i></a>
                    </ul>
                </div>
            </div>

        </nav>

        <!-- View -->
        <div class="row">
            <div class="col-xl-1"></div>
            <div class="col-xl-3 col-lg-3 pr-3">
                <div class="card sticky-top" style="z-index: 10; top: 6.5em">
                    <div class="card-header">
                        Profile
                    </div>
                    <div class="card-body">
                        <div class="media align-items-center mb-4">
                            <img class="mr-3 rounded-circle p-1 shadow" v-bind:src="'/uploads/photos/' + myProfile.photo" width="80" height="80" alt="">
                            <div class="media-body">
                                <h3 class="mb-0 head3r">{{ myProfile.name }} {{ myProfile.surname }}</h3>
                            </div>
                        </div>
                        <ul class="card-profile__info">
                            <li class="mb-1"><strong class="text-dark mr-4">Phone</strong> <span>{{ myProfile.phone }}</span></li>
                            <li><strong class="text-dark mr-4">Email</strong> <span>{{ myProfile.email }}</span></li>
                        </ul>
                    </div>
                    <div class="card-footer bg-transparent">
                        <p class="card-text d-inline"><small class="text-muted">Private profile</small>
                        </p><a href="" class="card-link float-right"><small>Edit Profile</small></a>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-9 p-0 mb-5">
                <!--<user-dashboard />-->

                <transition name="list-complete">
                    <router-view class="list-complete-item w-100"></router-view>
                </transition>

            </div>
            <div class="col-xl-3 col-lg-12 pl-3">
                <div class="card sticky-top" style="z-index: 10; top: 6.5em">
                    <div class="card-header">
                        Suscription
                    </div>
                    <div class="card-body">
                        <h4 class="head3r text-center">Days left</h4>
                        <div class="text-primary text-center" ><b style="font-size: 10em">{{ daysLeft.days_left.days }}</b></div>
                    </div>
                    <div class="card-footer bg-transparent">
                        <p class="card-text d-inline"><small class="text-muted">{{ daysLeft.description }}</small>
                        </p><router-link to="/payment" class="card-link float-right"><small>Check sub</small></router-link>
                    </div>
                </div>
            </div>
            <div class="col-xl-1"></div>

        </div>

        <nav class="navbar fixed-bottom navbar-light bg-light pt-3 mt-5" id="navbar-bottom">
            <div class="col">
                <router-link to="/payment">
                    <div class="float-right text-center" style="font-size: 1.2em">
                        <i class="fas fa-money-check-alt"></i> <br> <small>Payment</small>
                    </div>
                </router-link>
            </div>
            <div class="col">
                <router-link to="/dashboard">
                    <div class="text-center" style="font-size: 1.2em">
                        <i class="fas fa-home"></i> <br> <small>Home</small>
                    </div>
                </router-link>
            </div>
            <div class="col">
                <router-link to="/activities">
                    <div class="float-left text-center" style="font-size: 1.2em">
                        <i class="fas fa-clipboard-list"></i> <br> <small>Activities</small>
                    </div>
                </router-link>
            </div>
        </nav>
    </div>
</template>

<script>
    import axios from "axios";

    export default {
        data: () => ({
            myProfile: [],
            daysLeft: []
        }),
        mounted () {
            axios
                .get('/my-profile')
                .then(response => (
                    this.myProfile = response.data
                ))
            axios
                .get('/daysLeft')
                .then(response => {
                    console.log(response.data)
                    this.daysLeft = response.data
                })
        }
    }
</script>

<style scoped>

</style>