<template>
    <div>
        <div class="card">
            <div class="card-header">
                Payment
            </div>
            <div class="card-body">
                <h3>Select your suscription</h3>
                <p>
                    Here you will select a new suscription.
                </p>
                <div class="text-center">
                    <div class="card mb-4 shadow">
                        <div class="card-header">
                            <h2 class="my-0 mb-2">1 Month</h2>
                            <h3 class="gradient-1 rounded p-3 text-white">20€</h3>
                        </div>
                        <div class="card-body">
                            <h1 class="card-title pricing-card-title">20€ <small class="text-muted">/ mo</small></h1>
                            <ul class="list-unstyled mt-3 mb-4">
                                <li><b>30</b> Days of subscription</li>
                                <li>Access to web</li>
                                <li>Join activities</li>
                                <li>Manage subscription</li>
                            </ul>
                            <button id="one" type="button" class="btn btn-lg btn-block btn-primary" @click="newPayment(1)">Select</button>
                        </div>
                    </div>
                    <div class="card mb-4 shadow">
                        <div class="card-header">
                            <h2 class="my-0 mb-2">2 Months</h2>
                            <h3 class="gradient-8 rounded p-3 text-white">35€</h3>
                        </div>
                        <div class="card-body">
                            <h1 class="card-title pricing-card-title">17,5€ <small class="text-muted">/ mo</small></h1>
                            <ul class="list-unstyled mt-3 mb-4">
                                <li><b>60</b> Days of subscription</li>
                                <li>Access to web</li>
                                <li>Join activities</li>
                                <li>Manage subscription</li>
                            </ul>
                            <button id="two" type="button" class="btn btn-lg btn-block btn-primary" @click="newPayment(2)">Select</button>
                        </div>
                    </div>
                    <div class="card mb-4 shadow">
                        <div class="card-header">
                            <h2 class="my-0 mb-2">3 Months</h2>
                            <h3 class="gradient-7 rounded p-3 text-white">50€</h3>
                        </div>
                        <div class="card-body">
                            <h1 class="card-title pricing-card-title">16,6€ <small class="text-muted">/ mo</small></h1>
                            <ul class="list-unstyled mt-3 mb-4">
                                <li><b>90</b> Days of subscription</li>
                                <li>Access to web</li>
                                <li>Join activities</li>
                                <li>Manage subscription</li>
                            </ul>
                            <button id="three" type="button" class="btn btn-lg btn-block btn-primary" @click="newPayment(3)">Select</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "userPayment",
        methods: {
            newPayment (payID) {
                var ruta = '/modSub'
                $.ajax({
                    type: 'POST',
                    url: ruta,
                    data: ({id: payID}),
                    async: true,
                    dataType: 'json',
                    success: function (data) {
                        console.log('done')
                        window.location.href = "/";
                    }
                })
            }
        }
    }
</script>

<style scoped>

</style>