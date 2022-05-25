

<template>
    <div>
        <br>
        <input type="text" v-model="searchTerm" class="form-control" style="width: 300px;" placeholder="rechercher ici">
        <br>
        <div class="row">
            <div class="col-lg-12 mb-4">
                <!-- Simple Tables -->
                <div class="card">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Factures d'aujourd'hui</h6>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                            <tr>
                                <th>Nom client</th>
                                <th>Num facture</th>
                                <th>Mt. total </th>
                                <th>Mt. payé</th>
                                <th>Mt. restant</th>
                                <th>Payé par</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="order in filtersearch" :key="order.id">
                                <td> {{ order.name }} </td>
                                <td> {{ order.order_code }} </td>
                                <td> {{ order.total }} FCFA </td>
                                <td> {{ order.pay }} FCFA </td>
                                <td> {{ order.due }} FCFA  </td>
                                <td> {{ order.payby }} </td>
                                <td>
                                    <router-link :to="{name: 'view-order', params:{id:order.id}}" class="btn btn-sm btn-primary">Voir</router-link>
                                    <router-link :to="{name: 'orderdownload', params:{id:order.id}}" class="btn btn-sm btn-primary">Télécharger</router-link>
<!--                                    <a href="" @click.prevent="OrderDownload(order.id)" class="btn btn-info">Imprimer</a>-->
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer"></div>
                </div>
            </div>
        </div>
        <!--Row-->
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
        return{
            orders:[],
            searchTerm:''
        }
    },
    computed:{
        filtersearch(){
            return this.orders.filter(order => {
                return order.name.toLowerCase().match(this.searchTerm.toLowerCase())
            })
        }
    },

    methods:{
        allOrder(){
            axios.get('/api/orders/')
                .then(({data}) => (this.orders = data))
                .catch()
        },
        // OrderDownload(id){
        //     axios.get('/api/order_download/'+id)
        //         .then(({data}) => (console.log(data)))
        //         .catch()
        //
        //     // axios.get('/api/order_download/'+id)
        //     //     .then(() => {
        //     //         // Notification.download_success();
        //     //     })
        //     //     .catch();
        // },

    },
    created(){
        this.allOrder();
    }


}
</script>


<style type="text/css">
#em_photo{
    height: 40px;
    width: 40px;
}
</style>
