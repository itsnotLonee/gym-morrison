<template>
    <div>
        <h2 class="m-3">Personal Profile</h2>
        <div class="row m-3">
            <div class="col-lg-4 col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <div class="media align-items-center mb-4">
                            <img class="mr-3 rounded-circle p-1 shadow" v-bind:src="'/uploads/photos/' + user.photo" height="80" width="80">
                            <div class="media-body">
                                <h3 class="mb-0">{{ user.name }} {{ user.surname }}</h3>
                                <p class="text-muted mb-0">{{ user.rol[0].slice(5,10) }}</p>
                            </div>
                        </div>

                        <h4>About Me</h4>
                        <ul class="card-profile__info">
                            <li><strong class="text-dark mr-4">Email</strong> <span>{{ user.email }}</span></li>
                            <li class="mb-1"><strong class="text-dark mr-4">Phone</strong> <span>{{ user.phone }}</span></li>
                            <li><strong class="text-dark mr-4">Birthdate</strong> {{ user.birth.date.substring(0,10) }}</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-xl-3">
                <div class="card">
                    <div class="card-header">
                        Edit-Profile
                    </div>
                    <div class="card-body">
                        <label>Name:</label>
                        <input type="text" v-model="nombre" class="form-control input-default">
                        <button type="submit" class="btn btn-dark m-2" @click="modify(nombre, 'name'), updateProfile()">Change Name</button> <br>

                        <label>Surname:</label>
                        <input type="text" v-model="apellido" class="form-control input-default">
                        <button type="submit" class="btn btn-dark m-2" @click="modify(apellido, 'surname'), updateProfile()">Change Surname</button> <br>

                        <label>Email:</label>
                        <input type="text" v-model="email" class="form-control input-default">
                        <button type="submit" class="btn btn-dark m-2" @click="modify(email, 'email'), updateProfile()">Change Email</button> <br>

                        <label>Password:</label>
                        <input type="text" v-model="pass" class="form-control input-default">
                        <button type="submit" class="btn btn-dark m-2" @click="modify(pass, 'pass')">Change Password</button> <br>

                        <label>Phone:</label>
                        <input type="text" v-model="movil" class="form-control input-default">
                        <button type="submit" class="btn btn-dark m-2" @click="modify(movil, 'phone'), updateProfile()">Change Phone</button> <br>
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
        nombre: '',
        apellido: '',
        email: '',
        pass: '',
        movil: ''
    }),
    mounted () {
        axios
            .get('/my-profile')
            .then(response => (
                this.user = response.data
            ))
    },
    methods: {
        modify (str, type) {
            if (str !== undefined) {
                var ruta = '/edit-user'
                $.ajax({
                    type: 'POST',
                    url: ruta,
                    data: ({str: str, type: type}),
                    async: true,
                    dataType: 'json',
                    success: (data) => {
                        console.log(data)
                    }
                })
            }
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