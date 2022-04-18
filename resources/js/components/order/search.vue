

<template>
    <div>
        <div class="row">
            <router-link to="/order" class="btn btn-primary">Factures d'aujourd'hui </router-link>
        </div>
        <div class="row justify-content-center">
            <div class="col-xl-12 col-lg-12 col-md-12">
                <div class="card shadow-sm my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="login-form">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Rechercher une facture </h1>
                                    </div>
                                    <form class="user" @submit.prevent="searchDate">
                                        <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-md-12">
                                                    <label for="exampleFormControlTextarea1"><b>Saisir la date </b></label>
                                                    <input type="date" class="form-control" id="exampleInputFirstName" required="" v-model="date">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary btn-block">Chercher</button>
                                        </div>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                    </div>
                                    <div class="text-center">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 mb-4">
                        <!-- Simple Tables -->
                        <div class="card">
                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-primary">Details factures</h6>
                            </div>
                            <div class="table-responsive">
                                <table class="table align-items-center table-flush">
                                    <thead class="thead-light">
                                    <tr>
                                        <th>Nom produit</th>
                                        <th>Qté</th>
                                        <th>Total </th>
                                        <th>Montant payé </th>
                                        <th>Montant restant </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="order in orders">
                                        <td>{{ order.name }}</td>
                                        <td>{{ order.qty }}</td>
<!--                                        <td>{{ order.sub_total }}</td>-->
<!--                                        <td>{{ order.vat }}</td>-->
                                        <td>{{ order.sub_total }} FCFA</td>
                                        <td>{{ order.pay }} FCFA</td>
                                        <td>{{ order.due }} FCFA</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script type="text/javascript">

export default {
    created(){
        if (!User.loggedIn()) {
            this.$router.push({name: '/'})
        }
    },

    data(){
        return {
            date:'',
            orders:{}
        }
    },

    methods:{
        searchDate(){
            var data = {date:this.date}
            axios.post('/api/search/order/',data)
                .then(({data}) => (this.orders = data))
                .catch(error =>this.errors = error.response.data.errors)
        },
    }
}

</script>


<style type="text/css">

</style>
