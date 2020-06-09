<template>
    <div>
        <div class="row m-3">
            <div class="col-lg-6 col-xl-6">
                <div class="card">
                    <form @submit="modify">
                        <div class="card-header">
                            <h2 class="m-3">Personal Profile · EDIT <i class="fas fa-user-edit"></i></h2>
                        </div>
                        <div class="card-body">
                            <div class="media align-items-center mb-4">
                                <img class="mr-3 rounded-circle p-1 shadow" v-bind:src="'/uploads/photos/' + user.photo" height="80" width="80">
                                <div class="media-body">
                                    <div class="d-flex">
                                        <div class="align-self-center">Name:</div>
                                        <input type="text" v-model="user.name" class="form-control input-default border-top-0 border-left-0 border-right-0 font-medium rounded-0">
                                    </div>
                                    <div class="d-flex">
                                        <div class="align-self-center">Surname:</div>
                                        <input type="text" v-model="user.surname" class="form-control input-default border-top-0 border-left-0 border-right-0 font-medium rounded-0">
                                    </div>
                                    <p class="text-muted mb-0">{{ user.rol[0].slice(5,10) }}</p>
                                </div>
                            </div>

                            <h4>About Me</h4>
                            <ul class="card-profile__info">
                                <li>
                                    <div class="d-flex">
                                        <strong class="align-self-center text-dark mr-4">Email</strong>
                                        <input type="text" v-model="user.email" class="form-control input-default border-top-0 border-left-0 border-right-0 font-medium rounded-0">
                                    </div>
                                </li>
                                <li class="mb-1">
                                    <div class="d-flex">
                                        <strong class="align-self-center text-dark mr-4">Phone</strong>
                                        <input type="text" v-model="user.phone" class="form-control input-default border-top-0 border-left-0 border-right-0 font-medium rounded-0">
                                    </div>
                                </li>
                                <li><strong class="text-dark mr-4">Birthdate</strong> {{ user.birth.date.substring(0,10) }}</li>
                            </ul>
                        </div>
                        <div class="card-footer">
                            <button v-if="user !== userOriginal" type="submit" class="btn btn-dark m-2"><i class="fas fa-save"></i> Save</button>
                            <button v-else type="submit" class="btn btn-dark m-2" disabled><i class="fas fa-save"></i> Save</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-4 col-xl-3">
                <div class="card">
                    <div class="card-header">
                        Edit-Profile
                    </div>
                    <div class="card-body">
                        <label>Name:</label>
                        <label>{{ user.name }}</label>
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
        user: [],
        userOriginal: []
    }),
    mounted () {
        axios
            .get('/my-profile')
            .then(response => (
                this.user = response.data,
                this.userOriginal = this.user
            ))
    },
    methods: {
        modify () {
            var ruta = '/edit-user'
            $.ajax({
                type: 'POST',
                url: ruta,
                data: ({user: this.user}),
                async: true,
                dataType: 'json',
                success: (data) => {
                    console.log(data)
                }
            })
        },
        updateProfile () {
            axios
                .get('/my-profile')
                .then(response => (
                    this.user = response.data
                ))
        }
    }
}
</script>

<style scoped>

</style>