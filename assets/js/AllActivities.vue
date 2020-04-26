<template>
    <div class="col-lg-12 mt-3">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Public Activities</h4>
                <p>Sorted by date</p>
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
                            <th scope="col">Owner</th>
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
                                {{ item.owner }}
                            </td>
                        </tr>
                        {{ pageOfItems.page }}
                        </tbody>
                    </table>
                    <div class="text-center mx-auto">
                        <jw-pagination :pageSize="10" :maxPages="5" :items="sorted_allActivities" @changePage="onChangePage"></jw-pagination>
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
            allActivities: [],
            pageOfItems: [],
            pagina: 0
        }),
        mounted () {
            axios
                .get('/get-all-activities')
                .then(response => {
                    var aux = response.data
                    for (let i = 0; i < aux.length; i++) {
                        if (aux[i].content.length > 100) {
                            aux[i].content = aux[i].content.slice(0, 100) + ' ...'
                        }
                    }
                    this.allActivities = aux
                })
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
        methods: {
            onChangePage(pageOfItems) {
                // update page of items
                this.pageOfItems = pageOfItems;
                console.log(this.pagina)
            }
        },
        computed: {
            sorted_allActivities() {
                return this.allActivities.sort((a, b) => { return a.date_created.date - b.date_created.date;}).reverse();
            }
        }
    }
</script>

<style scoped>

</style>