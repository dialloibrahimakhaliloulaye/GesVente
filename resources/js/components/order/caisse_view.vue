
<template>
    <div>
        <div class="row">
            <router-link to="/ticket" class="btn btn-primary">Ajouter un ticket de caisse </router-link>
        </div>
        <br>
        <input type="text" v-model="searchTerm" class="form-control" style="width: 300px;" placeholder="rechercher ici">
        <br>
        <div class="row">
            <div class="col-lg-8 mb-5">
                <!-- Simple Tables -->
                <div class="card">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Liste des tickets de caisse</h6>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                            <tr>
                                <th>Code ticket</th>
                                <th>Montant (FCFA)</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="caisse in filtersearch" :key="caisse.id">
                                <td> {{ caisse.caisse_code }} </td>
                                <td> {{ caisse.montant }} </td>
                                <td>
                                    <router-link :to="{name: 'edit-category', params:{id:category.id}}" class="btn btn-sm btn-primary">Editer</router-link>
                                    <a @click="deleteCategory(category.id)" class="btn btn-sm btn-danger"><font color="#ffffff">Supprimer</font></a>
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
            caisses:[],
            searchTerm:''
        }
    },
    computed:{
        filtersearch(){
            return this.caisses.filter(caisse => {
                return caisse.caisse_code.toLowerCase().match(this.searchTerm.toLowerCase())
            })
        }
    },

    methods:{
        allTicket(){
            axios.get('/api/order/ticket/')
                .then(({data}) => (this.caisses = data))
                .catch()
        },
        deleteTicket(id){
            Swal.fire({
                title: 'Etes-vous sure?',
                text: "Cette action n'est pas reversible!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Oui, Suprimer !',
                cancelButtonText: "Retour"
            }).then((result) => {
                if (result.value) {
                    axios.delete('/api/category/'+id)
                        .then(() => {
                            this.categories = this.categories.filter(category => {
                                return category.id != id
                            })
                        })
                        .catch(() => {
                            this.$router.push({name: 'category'})
                        })
                    Swal.fire(
                        'Suprimé!',
                        'Effectué avec succès',
                        'success'
                    )
                }
            })
        }
    },
    created(){
        this.allTicket();
    }

}
</script>


<style type="text/css">
#em_photo{
    height: 40px;
    width: 40px;
}
</style>
