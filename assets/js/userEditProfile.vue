<template>
    <div>
        <div class="card">
            <form @submit="modify">
                <div class="card-header">
                    <h2 class="m-3">Personal Profile · EDIT <i class="fas fa-user-edit"></i></h2>
                </div>
                <div class="card-body">
                    <span class="text-warning" v-if="!modified()">Changes not saved</span>
                    <ul class="card-profile__info">
                        <li>
                            <div class="d-flex">
                                <strong class="align-self-center text-dark mr-4">Name</strong>
                                <input type="text"
                                       v-model="user.name"
                                       @keyup="modified"
                                       class="form-control input-default border-top-0 border-left-0 border-right-0 font-medium rounded-0"
                                       pattern="[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{2,18}"
                                >
                            </div>
                        </li>
                        <li>
                            <div class="d-flex">
                                <strong class="align-self-center text-dark mr-4">Surname</strong>
                                <input type="text"
                                       v-model="user.surname"
                                       @keyup="modified"
                                       class="form-control input-default border-top-0 border-left-0 border-right-0 font-medium rounded-0"
                                       pattern="[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{2,18}"
                                >
                            </div>
                        </li>
                        <li>
                            <div class="d-flex">
                                <strong class="align-self-center text-dark mr-4">Email</strong>
                                <input type="text"
                                       v-model="user.email"
                                       @keyup="modified"
                                       class="form-control input-default border-top-0 border-left-0 border-right-0 font-medium rounded-0"
                                       pattern="^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$"
                                >
                            </div>
                        </li>
                        <li class="mb-1">
                            <div class="d-flex">
                                <strong class="align-self-center text-dark mr-4">Phone</strong>
                                <input type="text"
                                       v-model="user.phone"
                                       @keyup="modified"
                                       class="form-control input-default border-top-0 border-left-0 border-right-0 font-medium rounded-0"
                                       pattern="[0-9]{1,14}"
                                >
                            </div>
                        </li>
                        <li><strong class="text-dark mr-4">Birthdate</strong> {{ user.birth.date.substring(0,10) }}</li>
                    </ul>
                </div>
                <div class="card-footer">
                    <button v-if="modified()" type="submit" class="btn btn-dark m-2" disabled><i class="fas fa-save"></i> Save</button>
                    <button v-else type="submit" class="btn btn-primary m-2"><i class="fas fa-save"></i> Save</button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    import axios from "axios";

    export default {
        data () {
            return {
                user: [],
                userOriginal: []
            }
        },
        created () {
            axios
                .get('/my-profile')
                .then(response => {
                    this.user = response.data
                })
            axios
                .get('/my-profile')
                .then(response => {
                    this.userOriginal = response.data
                })
        },
        methods: {
            modified () {
                return JSON.stringify(this.user) === JSON.stringify(this.userOriginal)
            },
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
                        window.location.reload()
                    }
                })
            }
        }
    }
</script>

<style scoped>

</style>