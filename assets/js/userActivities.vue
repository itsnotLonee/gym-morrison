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
                    <div class="media border-bottom-1 pt-3 pb-3" v-for="item in activitiesHistory.reverse()">
                        <img width="50" height="50" class="mr-3 rounded-circle" v-bind:src="'/uploads/photos/' + item.activity_photo">
                        <div class="media-body">
                            <div>
                                <h5>{{ item.activity_title }}</h5>
                                <button class="float-right btn btn-outline-info btn-sm"><i class="far fa-eye"></i></button>
                            </div>
                            <p class="m-3">{{ item.activity_content.slice(0, 100) + '...' }}</p>

                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer bg-transparent">
                <p class="card-text d-inline"><small class="text-muted">Last updated 3 mins ago</small>
                </p><a href="#" class="card-link float-right"><small>Card link</small></a>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from "axios";

    export default {
        data: () => ({
            activitiesHistory: null,
        }),
        mounted () {
            axios
                .get('/get-user-activities')
                .then(response => {
                    this.activitiesHistory = response.data
                    console.log(response.data)
                })
        }
    }
</script>

<style scoped>

</style>