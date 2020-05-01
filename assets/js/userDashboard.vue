<template>
    <div>
        <div class="row">
            <div class="col-xl-1"></div>
            <div class="col-xl-3 col-lg-3">
                <div class="card sticky-top" style="z-index: 0; top: 6.5em">
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
                            <li class="mb-1"><strong class="text-dark mr-4">Phone</strong> <span>01793931609</span></li>
                            <li><strong class="text-dark mr-4">Email</strong> <span>name@domain.com</span></li>
                        </ul>
                    </div>
                    <div class="card-footer bg-transparent">
                        <p class="card-text d-inline"><small class="text-muted">Private profile</small>
                        </p><a href="" class="card-link float-right"><small>Edit Profile</small></a>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-9">
                <div class="card">
                    <div class="card-header">
                        Dashboard
                    </div>
                    <div class="card-body">
                        <h4 class="head3r">Your activities today</h4>
                        This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.This is some text within a card body.
                    </div>
                    <div class="card-footer bg-transparent">
                        <p class="card-text d-inline"><small class="text-muted">Last updated 3 mins ago</small>
                        </p><a href="#" class="card-link float-right"><small>Card link</small></a>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-12">
                <div class="card sticky-top" style="z-index: 0; top: 6.5em">
                    <div class="card-header">
                        Suscription
                    </div>
                    <div class="card-body">
                        <h4 class="head3r text-center">Days left</h4>
                        <div class="text-primary text-center" ><b style="font-size: 10em">35</b></div>
                    </div>
                    <div class="card-footer bg-transparent">
                        <p class="card-text d-inline"><small class="text-muted">One month sub</small>
                        </p><a href="#" class="card-link float-right"><small>Check sub</small></a>
                    </div>
                </div>
            </div>
            <div class="col-xl-1"></div>
        </div>
    </div>
</template>

<script>
    import axios from "axios";

    export default {
        data: () => ({
            myProfile: []
        }),
        mounted () {

            axios
                .get('/my-profile')
                .then(response => (
                    this.myProfile = response.data,
                    console.log(this.myProfile)
                ))

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
            }
        }
    }
</script>

<style scoped>

</style>