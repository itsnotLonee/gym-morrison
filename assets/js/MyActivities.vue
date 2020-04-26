<template>
    <div class="col-lg-12 mt-3">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">My Activities</h4>
                <div>Sorted by date</div>

                <div class="table-responsive">
                    <table class="table header-border table-hover verticle-middle">
                        <thead>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col">ID</th>
                            <th scope="col">Title</th>
                            <th scope="col">Content</th>
                            <th scope="col">Date</th>
                            <th scope="col">Time</th>
                            <th scope="col">Users joined</th>
                            <th scope="col">Actions</th>
                        </tr>
                        </thead>
                        <tbody>

                        <tr v-for="item in pageOfItems">
                            <td>
                                <a type="button" v-bind:href="'/activity/'+item.id" class="btn mb-1 p-1 border-0 btn-rounded btn-info text-white"><i class="fa fa-eye"></i></a>
                            </td>
                            <td>
                                {{ item.id }}
                            </td>
                            <td>
                                {{ item.title }}
                            </td>
                            <td>
                                {{ item.content }}
                            </td>
                            <td>
                                <div v-if="item.start_date.date !== item.end_date.date">
                                    From <b>{{ item.start_date.date | formatDate }}</b> <br>To <b>{{ item.end_date.date | formatDate }}</b>
                                </div>
                                <div v-else>
                                    On <b>{{ item.start_date.date | formatDate }}</b>
                                </div>
                            </td>
                            <td>
                                <b>{{ item.start_time.date | formatTime }} - {{ item.end_time.date | formatTime }}</b>
                            </td>
                            <td>
                                <span class="label gradient-4 btn-rounded"><i class="fas fa-users"></i> &nbsp; 0</span>
                            </td>
                            <td>
                                <span>
                                    <div class="d-flex">
                                        <a class="btn btn-outline-secondary" v-bind:href="'/edit-activity/'+ item.id" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil color-muted m-r-5"></i></a>
                                        &nbsp;
                                            <!-- Button trigger modal -->
                                        <span class="btn btn-outline-danger" data-toggle="modal" v-bind:data-target="'#basico'+item.id" title="Remove"><i class="fa fa-close color-danger"></i></span>
                                            <!-- Modal -->
                                        <div class="modal fade" v-bind:id="'basico'+item.id">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Remove Activity</h5>
                                                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        You are about to delete: <b>{{ item.title }}</b>
                                                        <p class="text-danger text-center mt-3">This action can't be undone</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-success text-white" data-dismiss="modal">Close</button>
                                                        <a type="button" class="btn btn-danger text-white" data-dismiss="modal" @click="removeActivity(item.id)">Confirm remove</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </span>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <div class="text-center mx-auto">
                        <jw-pagination :pageSize="10" :maxPages="5" :items="sorted_myActivities" @changePage="onChangePage"></jw-pagination>
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
            myActivities: [],
            pageOfItems: []
        }),
        mounted () {
            axios
                .get('/get-my-activities')
                .then(response => {
                    var aux = response.data
                    for (let i = 0; i < aux.length; i++) {
                        // problema cuando es una persona
                        if (aux[i].content.length > 100) {
                            aux[i].content = aux[i].content.slice(0, 100) + ' ...'
                        }
                    }
                    this.myActivities = aux
                })
        },
        methods: {
            onChangePage(pageOfItems) {
                // update page of items
                this.pageOfItems = pageOfItems;
            },
            removeActivity(id) {
                $.ajax({
                    type: 'POST',
                    url: '/removeActivity',
                    data: ({id: id}),
                    async: true,
                    datatype: 'json',
                    success: function (data) {
                        console.log(data)
                    }
                })
                this.loadActivities()
            },
            loadActivities () {
                axios
                    .get('/get-my-activities')
                    .then(response => {
                        var aux = response.data
                        for (let i = 0; i < aux.length; i++) {
                            // problema cuando es una persona
                            if (aux[i].content.length > 100) {
                                aux[i].content = aux[i].content.slice(0, 100) + ' ...'
                            }
                        }
                        this.myActivities = aux
                    })
            }

        },
        computed : {
            sorted_myActivities() {
                return this.myActivities.sort((a, b) => { return a.date_created.date - b.date_created.date;}).reverse();
            }
        }
    }
</script>

<style scoped>

</style>