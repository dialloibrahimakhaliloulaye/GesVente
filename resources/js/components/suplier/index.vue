

<template>

    <div>
        <div class="row">
            <router-link to="/store-suplier" class="btn btn-primary">Ajouter un fournisseur </router-link>

        </div>
        <br>
        <input type="text" v-model="searchTerm" class="form-control" style="width: 300px;" placeholder="Search Here">
        <br>
        <div class="row">
            <div class="col-lg-12 mb-4">
                <!-- Simple Tables -->
                <div class="card">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Liste des fournisseurs</h6>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                            <tr>
                                <th>Nom</th>
                                <th>Photo</th>
                                <th>Téléphone</th>
                                <th>Entreprise</th>
<!--                                <th>Email</th>-->
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="suplier in filtersearch" :key="suplier.id">
                                <td> {{ suplier.name }} </td>
                                <td><img :src="suplier.photo" id="em_photo"></td>
                                <td>{{ suplier.phone }}</td>
                                <td>{{ suplier.shopname }}</td>
<!--                                <td>{{ suplier.email }}</td>-->
                                <td>
                                    <router-link :to="{name: 'edit-suplier', params:{id:suplier.id}}" class="btn btn-sm btn-primary">Editer</router-link>

                                    <a @click="deleteSuplier(suplier.id)" class="btn btn-sm btn-danger"><font color="#ffffff">Supprimer</font></a>
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
            supliers:[],
            searchTerm:''
        }
    },
    computed:{
        filtersearch(){
            return this.supliers.filter(suplier => {
                return suplier.name.toLowerCase().match(this.searchTerm.toLowerCase())
            })
        }
    },

    methods:{
        allSuplier(){
            axios.get('/api/suplier/')
                .then(({data}) => (this.supliers = data))
                .catch()
        },
        deleteSuplier(id){
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
                    axios.delete('/api/suplier/'+id)
                        .then(() => {
                            this.supliers = this.supliers.filter(suplier => {
                                return suplier.id != id
                            })
                        })
                        .catch(() => {
                            this.$router.push({name: 'suplier'})
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
        this.allSuplier();
    }


}
</script>


<style type="text/css">
#em_photo{
    height: 40px;
    width: 40px;
}
</style>
