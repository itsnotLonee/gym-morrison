<template>
    <div>
        <div class="container-fluid mt-3">
            <div class="row">
                <div class="col-lg-3 col-sm-6">
                    <div class="card gradient-1">
                        <div class="card-body">
                            <h3 class="card-title text-white">Activities Created</h3>
                            <div class="d-inline-block">
                                <!--<button @click="activitiesCreated">Click</button>-->
                                <h2 class="text-white">{{ actCreated }}</h2>
                                <p class="text-white mb-0">All the activities you have created</p>
                            </div>
                            <span class="float-right display-5 opacity-5"><i class="fa fa-calendar-plus"></i></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Last Activities Created</h4>
                        <div id="activity">
                            <div class="media border-bottom-1 pt-3 pb-3" v-for="item in myActivities">
                                <img width="35" src="" class="mr-3 rounded-circle">
                                <div class="media-body">
                                    <h5>{{ item.title }}</h5>
                                    <p class="mb-0">I shared this on my fb wall a few months back,</p>
                                </div><span class="text-muted ">April 24, 2018</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    <!-- #/ container -->
    </div>
</template>

<script>
    import axios from "axios";

    export default {
        data: () => ({
            actCreated: 0,
            myActivities: [],
            allActivities: []
        }),
        mounted () {
            axios
                .get('/my-activities')
                .then(response => (
                    this.actCreated = response.data.length,
                    this.myActivities = response.data,
                    console.log(response.data)
                ))
        }
    }
</script>

<style scoped>

</style>