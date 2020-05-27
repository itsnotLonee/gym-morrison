<template>
    <div>
        <div class="card">
            <div class="card-header">
                Activities History
            </div>
            <div class="card-body">
                <div>
                    <h4 class="head3r gradient-1 rounded p-2"><strong>Your Activities History</strong></h4>
                    <p class="text-muted">Ordered by latest joined</p>
                    <div class="media border-bottom-1 pt-3 pb-3" v-for="item in activitiesHistory">
                        <img width="50" height="50" class="mr-3 rounded-circle" v-bind:src="'/uploads/photos/' + item.activity_photo">
                        <div class="media-body">
                            <div>
                                <h5>{{ item.activity_title }}</h5>
                                <button class="float-right btn btn-outline-info btn-sm"  data-toggle="modal" data-target="#modalInfo" @click="modalInfo(item.activity_id)"><i class="far fa-eye"></i></button>
                            </div>
                            <p class="m-3">{{ item.activity_content.slice(0, 100) + '...' }}</p>
                            <div class="float-right">
                                <span class="text-muted"><i class="fas fa-clock"></i> {{ item.activity_starttime.date.slice(11, 16) }}</span> &nbsp;
                                <span class="text-muted"><i class="fas fa-calendar"></i> {{ item.activity_startdate.date.slice(0, 10) }}</span> &nbsp;
                                <span class="text-muted "><i class="fas fa-user"></i> {{ item.activity_teacher }}</span>
                            </div>
                        </div>
                    </div>
                </div>
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
                        <p class="text-secondary">
                            <i class="fas fa-users"></i> <b>{{ infoModal.users_joined }}</b>
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
    </div>
</template>

<script>
    import axios from "axios";

    export default {
        data: () => ({
            activitiesHistory: null,
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
            }
        }),
        mounted () {
            axios
                .get('/get-user-activities')
                .then(response => {
                    this.activitiesHistory = response.data.reverse()
                    console.log(response.data)
                })
        },
        methods: {
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