

<template>
    <div>
        <div class="row">
            <router-link to="/store-employee" class="btn btn-primary">Ajouter un employé </router-link>
        </div>
        <br>
        <input type="text" v-model="searchTerm" class="form-control" style="width: 300px;" placeholder="rechercher ici">
        <br>
        <div class="row">
            <div class="col-lg-12 mb-4">
                <!-- Simple Tables -->
                <div class="card">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Liste des employés</h6>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                            <tr>
                                <th>Nom</th>
                                <th>Photo</th>
                                <th>Téléphone</th>
                                <th>Salaire</th>
                                <th>Date d'embauche</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="employee in filtersearch" :key="employee.id">
                                <td> {{ employee.name }} </td>
                                <td><img :src="employee.photo" id="em_photo"></td>
                                <td>{{ employee.phone }}</td>
                                <td>{{ employee.sallery }}</td>
                                <td>{{ employee.joining_date }}</td>
                                <td>
                                    <router-link :to="{name: 'pay-salary', params:{id:employee.id}}" class="btn btn-sm btn-primary">Payer salaire</router-link>
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
            employees:[],
            searchTerm:''
        }
    },
    computed:{
        filtersearch(){
            return this.employees.filter(employee => {
                return employee.name.toLowerCase().match(this.searchTerm.toLowerCase())
            })
        }
    },

    methods:{
        allEmployee(){
            axios.get('/api/employee/')
                .then(({data}) => (this.employees = data))
                .catch()
        },

    },
    created(){
        this.allEmployee();
    }

}
</script>


<style type="text/css">
#em_photo{
    height: 40px;
    width: 40px;
}
</style>
