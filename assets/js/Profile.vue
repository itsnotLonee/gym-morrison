<template>
    <div>
        <h2 class="m-3">Personal Profile</h2>
        <div class="col-lg-4 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="media align-items-center mb-4">
                        <img class="mr-3" src="" width="80" height="80" alt="">
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
    </div>
    <!-- #/ container -->
    </div>
</template>

<script>
    import axios from "axios";

    export default {
        data: () => ({
            user: []
        }),
        mounted () {
            axios
                .get('/my-profile')
                .then(response => (
                    this.user = response.data
                ))
        }
    }
</script>

<style scoped>

</style>