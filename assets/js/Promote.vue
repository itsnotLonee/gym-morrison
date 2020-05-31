<template>
    <div class="col-lg-12 mt-3">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Manage Users</h4>
                <div>Sorted by latest created</div>

                <div class="table-responsive">
                    <table class="table header-border table-hover verticle-middle">
                        <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Photo</th>
                            <th scope="col">Name</th>
                            <th scope="col">Surname</th>
                            <th scope="col">Email</th>
                            <th scope="col">ROL</th>
                            <th scope="col">Phone</th>
                            <th scope="col"><div class="text-center">SWITCH ROLE</div></th>
                        </tr>
                        </thead>
                        <tbody>

                        <tr v-for="item in pageOfItems">
                            <td>
                                {{ item.id }}
                            </td>
                            <td>
                                <img class="p-1 rounded-circle shadow" v-bind:src="'/uploads/photos/' + item.photo" width="50" height="50" alt="No-Photo"/>
                            </td>
                            <td>
                                {{ item.name }}
                            </td>
                            <td>
                                {{ item.surname }}
                            </td>
                            <td>
                                <b>{{ item.email }}</b>
                            </td>
                            <td>
                                <b class="text-primary">{{ item.rol }}</b>
                            </td>
                            <td>
                                {{ item.phone }}
                            </td>
                            <td>
                                <span>
                                    <div class="text-center">
                                        <!-- Button trigger modal -->
                                        <span class="btn btn-outline-info" data-toggle="modal" v-bind:data-target="'#basico'+item.id" title="Remove"><i class="fas fa-sync"></i></span>
                                        <!-- Modal -->
                                    </div>
                                    <div class="modal fade" v-bind:id="'basico'+item.id">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">SWITCH ROLE</h5>
                                                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>
                                                        If the user is an <b>STAFF MEMBER</b> it will be downgraded to <b>USER</b>.
                                                        Otherwise if the it is an <b>USER</b> it will be promoted to <b>STAFF</b>
                                                    </p>
                                                    You are about to promote: <b>{{ item.email }}</b>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-success text-white" data-dismiss="modal">Close</button>
                                                    <a type="button" class="btn btn-info text-white" data-dismiss="modal" @click="promote(item.id), loadUsers()">Confirm SWITCH</a>
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
                        <jw-pagination :pageSize="10" :maxPages="5" :items="sorted_users" @changePage="onChangePage"></jw-pagination>
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
            users: [],
            pageOfItems: []
        }),
        mounted () {
            axios
                .get('/get-users')
                .then(response => {
                    var aux = response.data
                    for (var i = 0; i < aux.length; i++) {
                        aux[i].rol = aux[i].rol[0].slice(5,10)
                    }
                    this.users = aux
                })
        },
        methods: {
            onChangePage(pageOfItems) {
                // update page of items
                this.pageOfItems = pageOfItems;
            },
            promote(idUser) {
                $.ajax({
                    type: 'POST',
                    url: '/promote-user',
                    data: ({id: idUser}),
                    async: true,
                    datatype: 'json',
                    success: function (data) {
                        console.log(data)
                    }
                })
                this.loadUsers()
            },
            loadUsers () {
                axios
                    .get('/get-users')
                    .then(response => {
                        var aux = response.data
                        for (var i = 0; i < aux.length; i++) {
                            aux[i].rol = aux[i].rol[0].slice(5,10)
                        }
                        this.users = aux
                    })
            }

        },
        computed : {
            sorted_users() {
                return this.users.reverse();
            }
        }
    }
</script>

<style scoped>

</style>