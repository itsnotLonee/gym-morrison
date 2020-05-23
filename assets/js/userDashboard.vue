<template>
    <div>
        <div class="card">
            <div class="card-header">
                Dashboard
            </div>
            <div class="card-body">
                <div>
                    <div v-if="todayUserActivities">
                        <h4  class="head3r gradient-1 rounded p-2"><strong>YOUR ACTIVITIES TODAY</strong></h4>
                        <div class="text-muted">Activities you joined for today</div>
                    </div>
                    <div v-else>
                        <h4 class="head3r gradient-1 rounded p-2"><strong>NO ACTIVITIES TODAY</strong></h4>
                        <p>You can see down here the scheduled today.</p>
                    </div>
                    <div class="media border-bottom-1 pt-3 pb-3" v-for="item in todayUserActivities">
                        <img width="50" height="50" class="mr-3 rounded-circle" v-bind:src="'/uploads/photos/' + item.activity_photo">
                        <div class="media-body">
                            <h5>{{ item.activity_title }}</h5>
                            <p class="m-1">{{ item.activity_content.slice(0, 50) + '...' }}</p>
                            <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modalRemove" @click="removeModalID = item.activity_id">Remove me</button>
                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modalInfo" @click="modalInfo(item.activity_id)">
                                Info
                            </button>
                            <div class="float-right">
                                <span class="text-muted"><i class="far fa-clock"></i> {{ item.activity_starttime.date.slice(11, 16) }}</span> &nbsp; &nbsp;
                                <span class="text-muted"><i class="fas fa-user"></i> {{ item.activity_teacher }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="card-body">
                <div>
                    <h4 v-if="todayActivities" class="head3r gradient-3 rounded p-2"><strong>PUBLIC ACTIVITIES TODAY</strong></h4>
                    <div v-else>
                        <h4 class="head3r gradient-3 rounded p-2"><strong>NO PUBLIC ACTIVITIES TODAY</strong></h4>
                        <p>No public activities scheduled today.</p>
                    </div>
                    <div class="media border-bottom-1 pt-3 pb-3" v-for="item in todayActivities">
                        <img width="50" height="50" class="mr-3 rounded-circle" v-bind:src="'/uploads/photos/' + item.photo">
                        <div class="media-body">
                            <h5> {{ item.title }} </h5>
                            <p class="m-1">{{ item.content.slice(0, 100) + '...'  }} </p>
                            <button class="btn btn-success btn-sm" @click="join(item.id), updateToday()">Join</button>
                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modalInfo" @click="modalInfo(item.id)">
                                Info
                            </button>
                        </div>
                        <span class="text-muted "><i class="fas fa-user"></i> {{ item.owner }}</span>
                    </div>
                </div>
            </div>
            <hr>
            <div class="card-body">
                <div>
                    <h4 v-if="upcomingActivities" class="head3r gradient-7 rounded p-2"><strong>PUBLIC ACTIVITIES UPCOMING</strong></h4>
                    <div v-else>
                        <h4 class="head3r gradient-7 rounded p-2"><strong>NO UPCOMING ACTIVITIES</strong></h4>
                        <p>No public activities scheduled.</p>
                    </div>
                    <div class="media border-bottom-1 pt-3 pb-3" v-for="item in upcomingActivities.reverse()">
                        <img width="50" height="50" class="mr-3 rounded-circle" v-bind:src="'/uploads/photos/' + item.photo">
                        <div class="media-body">
                            <h5> {{ item.title }} </h5>
                            <p class="m-1">{{ item.content.slice(0, 200) + '...'  }} </p>
                            <button class="btn btn-success btn-sm" @click="join(item.id), updateToday()">Join</button>
                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modalInfo" @click="modalInfo(item.id)">
                                Info
                            </button>
                            <div class="float-right">
                                <span class="text-muted"><i class="fas fa-clock"></i> {{ item.start_time.date.slice(11, 16) }}</span> &nbsp;
                                <span class="text-muted"><i class="fas fa-calendar"></i> {{ item.start_date.date.slice(0, 10) }}</span> &nbsp;
                                <span class="text-muted "><i class="fas fa-user"></i> {{ item.owner }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer bg-transparent">
                <p class="card-text d-inline"><small class="text-muted">Last updated 3 mins ago</small>
                </p><a href="#" class="card-link float-right"><small>Card link</small></a>
            </div>
        </div>

        <!-- ModalInfo -->
        <div class="modal fade" id="modalInfo" tabindex="-1" role="dialog" aria-labelledby="infoModalScrollableTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="infoModalScrollableTitle">{{ infoModal.title }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <img class="w-100" v-bind:src="'/uploads/photos/' + infoModal.photo" style="max-height: 400px" alt="Photo">
                    <div class="modal-body">
                        <p>
                            {{ infoModal.content }}
                        </p>
                        <p class="text-secondary">
                            <i class="fas fa-chalkboard-teacher"></i> <b>{{ infoModal.teacher }}</b>
                        </p>
                        <p class="text-info">
                            <i class="fas fa-clock"></i> <b>{{ infoModal.start_time.date.toString().slice(11, 16) }}</b> - <b>{{ infoModal.end_time.date.toString().slice(11, 16) }}</b>
                        </p>
                        <div class="text-info" v-if="infoModal.start_date.date.toString().slice(0, 10) === infoModal.end_date.date.toString().slice(0, 10)">
                            <i class="fas fa-calendar"></i> <b>{{ infoModal.start_date.date.toString().slice(0, 10) }}</b>
                        </div>
                        <div class="text-info" v-else>
                            <i class="fas fa-calendar"></i> From <b>{{ infoModal.start_date.date.toString().slice(0, 10) }}</b> to <b>{{ infoModal.end_date.date.toString().slice(0, 10) }}</b>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- ModalDelete -->
        <div class="modal fade" id="modalRemove" tabindex="-1" role="dialog" aria-labelledby="removeModalScrollableTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="removeModalScrollableTitle">Are you sure?</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Confirm you aren't coming to the activity.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal" @click="remove(removeModalID), updateToday()">Remove me</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from "axios";

    export default {
        data: () => ({
            todayActivities: null,
            upcomingActivities: null,
            todayUserActivities: null,
            infoModal: {
                start_date: {
                    date: new Date()
                },
                end_date: {
                    date: new Date()
                },
                start_time: {
                    date: new Date()
                },
                end_time: {
                    date: new Date()
                }
            },
            infoModalHora: '',
            infoModalFecha: '',
            removeModalID: -1
        }),
        mounted () {
            axios
                .get('/get-today-activities')
                .then(response => {
                    this.todayActivities = response.data
                })
            axios
                .get('/get-all-activities')
                .then(response => {
                    this.upcomingActivities = response.data
                })
            axios
                .get('/get-user-today-activities')
                .then(response => {
                    // console.log(response)
                    var today = new Date()
                    var aux = []
                    var c = 0
                    for (var i = 0; i < response.data.length; i++) {
                        var fechaStart = new Date(response.data[i].activity_startdate.date)
                        var fechaEnd = new Date(response.data[i].activity_enddate.date)
                        if (fechaStart <= today && fechaEnd >= today) {
                            aux[c] = response.data[i]
                            c++
                        }
                    }
                    if (aux.length !== 0) {
                        this.todayUserActivities = aux
                    }
                    // console.log(this.todayUserActivities)
                })

        },
        methods: {
            join (actID) {
                var ruta = '/join'
                $.ajax({
                    type: 'POST',
                    url: ruta,
                    data: ({id: actID}),
                    async: true,
                    dataType: 'json',
                    success: function (data) {
                        console.log(data)
                    }
                })
            },
            remove (actID) {
                var ruta = '/removeFromActivity'
                $.ajax({
                    type: 'POST',
                    url: ruta,
                    data: ({id: actID}),
                    async: true,
                    dataType: 'json',
                    success: function (data) {
                        console.log(data)
                        console.log('Eliminado')
                    }
                })
            },
            updateToday () {
                axios
                    .get('/get-user-today-activities')
                    .then(response => {
                        var today = new Date()
                        var aux = []
                        var c = 0
                        for (var i = 0; i < response.data.length; i++) {
                            var fechaStart = new Date(response.data[i].activity_startdate.date)
                            var fechaEnd = new Date(response.data[i].activity_enddate.date)
                            if (today >= fechaStart && today <= fechaEnd) {
                                aux[c] = response.data[i]
                                c++
                            }
                        }
                        this.todayUserActivities = aux
                        console.log(this.todayUserActivities)
                    })
            },
            modalInfo (actID) {
                var ruta = '/get-activity'
                $.ajax({
                    type: 'POST',
                    url: ruta,
                    data: ({id: actID}),
                    async: true,
                    dataType: 'json',
                    success: (data) => {
                        var aux = data
                        this.infoModal = aux
                        console.log(this.infoModal)
                    }
                })
            }
        }
    }
</script>

<style scoped>

</style>
