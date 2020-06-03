<template>
    <div>
        <div class="card">
            <div class="card-header">
                Edit Profile
            </div>
            <div class="card-body">
                <h3>Edit your profile</h3>
                <div>
                    <label>Name:</label>
                    <input type="text" v-model="nombre" class="form-control input-default" >
                    <button type="submit" class="btn btn-dark m-2" @click="modify(nombre, 'name')">Change Name</button> <br>

                    <label>Surname:</label>
                    <input type="text" v-model="apellido" class="form-control input-default">
                    <button type="submit" class="btn btn-dark m-2" @click="modify(apellido, 'surname')">Change Surname</button> <br>

                    <label>Phone:</label>
                    <input type="text" v-model="movil" class="form-control input-default">
                    <button type="submit" class="btn btn-dark m-2" @click="modify(movil, 'phone')">Change Phone</button> <br>


                    <label>New Password:</label>
                    <input type="text" v-model="pass" class="form-control input-default">
                    <button type="submit" class="btn btn-dark m-2" @click="modify(pass, 'pass')">Change Password</button> <br>


                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "userEditProfile",
        data: () => ({
            user: [],
            nombre: '',
            apellido: '',
            movil: '',
            pass: ''
        }),
        methods: {
            modify: function (str, type) {
                if (str !== undefined) {
                    var ruta = '/edit-user'
                    console.log('done')
                    $.ajax({
                        type: 'POST',
                        url: ruta,
                        data: ({str: str, type: type}),
                        async: true,
                        dataType: 'json',
                        success: (data) => {
                            console.log(data)
                            if (type === 'pass'){
                                window.location.href = "/logout";
                            }
                            window.location.href = "/";

                        }
                    })
                }
            }
        }
    }
</script>

<style scoped>

</style>