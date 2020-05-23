<template>
    <div>
        <!-- NavTop -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top pt-3 mb-3" id="navbar-head">
            <div class="col-4">
                <button class="navbar-toggler mb-3" type="button" data-toggle="collapse" data-target=".navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse navbarSupportedContent float-right mr-5">
                    <form>
                        <input class="form-control input-rounded border-0 shadow-sm" type="search" placeholder="Search" aria-label="Search">
                    </form>
                </div>
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
                        <button id="switch-mode" type="button" class="btn btn-outline-secondary float-right border-0" data-toggle="tooltip" data-placement="top" data-original-title="Dark Mode" @click="darkmode"><i class="fas fa-moon"></i></button>
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
            <div class="col-xl-4 col-lg-9 p-0" >
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
                        <div class="text-primary text-center" ><b style="font-size: 10em">{{ daysLeft }}</b></div>
                    </div>
                    <div class="card-footer bg-transparent">
                        <p class="card-text d-inline"><small class="text-muted">One month sub</small>
                        </p><a href="#" class="card-link float-right"><small>Check sub</small></a>
                    </div>
                </div>
            </div>
            <div class="col-xl-1"></div>

        </div>

        <nav class="navbar fixed-bottom navbar-light bg-light pt-3 mt-5" id="navbar-bottom">
            <div class="col">
                <a>
                    <div class="float-right text-center" style="font-size: 1.2em">
                        <i class="fas fa-clipboard-list"></i> <br> <small>Joined</small>
                    </div>
                </a>
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
                        <i class="fas fa-calendar-alt"></i> <br> <small>Activities</small>
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
            daysLeft: 0
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
                    this.daysLeft = response.data.days_left.days
                })
        },
        methods: {
            darkmode () {
                if ($('body').hasClass('bg-dark')) {
                    console.log('negro')
                    $('#switch-mode').html('<i class="fas fa-moon"></i>').attr('data-original-title', 'Dark Mode');
                    $(".navbar").addClass('bg-light');
                    $("body").removeClass('bg-dark');
                    $('.card').addClass('bg-light');
                    $('.card').children().addClass('text-dark').removeClass('text-white');
                } else {
                    console.log('blanco')
                    $('#switch-mode').html('<i class="fas fa-sun"></i>').attr('data-original-title', 'Turn dark mode off');
                    $(".navbar").css('background-color', 'rgb(66, 66, 66)').removeClass('bg-light');
                    $("body").addClass('bg-dark text-dark').removeClass('bg-light');
                    $('.card').removeClass('bg-light').css('background-color', 'rgb(80, 80, 80)');
                     $('.card').children().removeClass('text-dark').addClass('text-white');
                    // $('h4').removeClass('text-dark').addClass('text-white');
                    // $('h3').removeClass('text-dark').addClass('text-white');
                }
            },
            days () {
                axios
                    .get('/daysLeft')
                    .then(response => (
                        console.log(response.data)
                    ))
            }
        }
    }
</script>

<style scoped>

</style>