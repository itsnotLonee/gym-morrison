<template>
    <div>
        <div class="container-fluid">
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
                    <div class="card gradient-2">
                        <div class="card-body">
                            <h3 class="card-title text-white">Example1</h3>
                            <div class="d-inline-block">
                                <!--<button @click="activitiesCreated">Click</button>-->
                                <h2 class="text-white">{{ actCreated }}</h2>
                                <p class="text-white mb-0">text</p>
                            </div>
                            <span class="float-right display-5 opacity-5"><i class="fa fa-users"></i></span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="card gradient-3">
                        <div class="card-body">
                            <h3 class="card-title text-white">Example2</h3>
                            <div class="d-inline-block">
                                <!--<button @click="activitiesCreated">Click</button>-->
                                <h2 class="text-white">{{ actCreated }}</h2>
                                <p class="text-white mb-0">text</p>
                            </div>
                            <span class="float-right display-5 opacity-5"><i class="fa fa-users"></i></span>
                        </div>
                    </div>
                    <div class="card gradient-4">
                        <div class="card-body">
                            <h3 class="card-title text-white">Example3</h3>
                            <div class="d-inline-block">
                                <!--<button @click="activitiesCreated">Click</button>-->
                                <h2 class="text-white">{{ actCreated }}</h2>
                                <p class="text-white mb-0">text</p>
                            </div>
                            <span class="float-right display-5 opacity-5"><i class="fa fa-users"></i></span>
                        </div>
                    </div>
                </div>

                <!-- /# column -->
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Activities created</h4>
                            <div class="text-muted m-3">These are the activities you created this year</div>
                            <canvas id="team-chart" width="500" height="250"></canvas>
                        </div>
                    </div>
                    <!-- /# card -->
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Last activities you created</h4>
                            <hr>
                            <div id="MyActivities">
                                <div class="media border-bottom-1 pt-3 pb-3" v-for="item in sorted_myActivities">
                                    <img width="35" src="" class="mr-3 rounded-circle">
                                    <div class="media-body">
                                        <h5>{{ item.title }}</h5>
                                        <p class="mb-0">{{ item.content.substring(0,400)+"... " }}</p>
                                        <a type="button" class="btn mt-2 btn-rounded btn-primary" v-bind:href="'/activity/'+ item.id">Show more</a>
                                    </div>
                                    <span class="text-white text-right gradient-9 ml-1 p-1 rounded">
                                        <div class="text-left"><i class="fas fa-calendar-alt"></i><b> Timetable</b></div>
                                        <b>{{ item.start_time.date.substring(10,16) }}</b>  - <b>{{ item.end_time.date.substring(10,16) }}</b>  <br>
                                        <div v-if="item.start_date.date.substring(0,10) == item.end_date.date.substring(0,10)">
                                            <b>{{ item.start_date.date.substring(0,10) }}</b>
                                        </div>
                                        <div v-else>From <b>{{ item.start_date.date.substring(0,10) }}</b> To <b>{{ item.end_date.date.substring(0,10) }}</b></div>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-xxl-6 col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Last public activities</h4>
                            <div id="PublicActivities">
                                <hr>
                                <div class="media border-bottom-1 pt-3 pb-3" v-for="item in sorted_allActivities">
                                    <img width="35" src="" class="mr-3 rounded-circle">
                                    <div class="media-body">
                                        <h5>{{ item.title }}</h5>
                                        <p class="mb-0">{{ item.content.substring(0,100)+"... " }} <b><a v-bind:href="'/activity/'+ item.id">show more</a></b> </p>
                                    </div>
                                    <span class="text-white text-right gradient-7 p-1 ml-1 rounded">
                                        <div><i class="fas fa-calendar-alt"></i> <b>{{ item.start_date.date.substring(0,10) }}</b></div>
                                    </span>
                                </div>
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
            array: [],
            allActivities: []
        }),
        mounted () {
            axios
                .get('/get-my-activities')
                .then(response => (
                    this.actCreated = response.data.length,
                    this.myActivities = response.data
                ))
            setInterval(() => {
                axios
                    .get('/get-my-activities')
                    .then(response => {
                        var aux = response.data
                        if (aux < this.myActivities ? -1 : +(aux > this.myActivities)){
                            this.myActivities = aux
                        }
                    })
            }, 1e3)

            axios
                .get('/get-all-activities')
                .then(response => (
                    this.allActivities = response.data
                ))
            setInterval(() => {
                axios
                    .get('/get-all-activities')
                    .then(response => {
                        var aux = response.data
                        if (aux < this.allActivities ? -1 : +(aux > this.allActivities)){
                            this.allActivities = aux
                        }
                    })
            }, 1e3)

        },
        computed : {
            sorted_myActivities() {
                return this.myActivities.sort((a, b) => { return a.date_created.date - b.date_created.date;}).reverse().slice(0,3);
            },
            sorted_allActivities() {
                return this.allActivities.sort((a, b) => { return a.date_created.date - b.date_created.date;}).reverse().slice(0,5);
            }
        }
    }
</script>

<style scoped>

</style>