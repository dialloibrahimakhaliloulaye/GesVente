

<template>
    <div>
        <div class="row">
            <router-link to="/employee" class="btn btn-primary">Liste des employés </router-link>
        </div>
        <div class="row justify-content-center">
            <div class="col-xl-12 col-lg-12 col-md-12">
                <div class="card shadow-sm my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="login-form">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Payer cet employé </h1>
                                    </div>
                                    <form class="user" @submit.prevent="SalaryPaid">
                                        <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <label for="exampleFormControlSelect1"><b>Nom Complet</b></label>
                                                    <input type="text" class="form-control" id="exampleInputFirstName" v-model="form.name">
                                                    <small class="text-danger" v-if="errors.name"> {{ errors.name[0] }} </small>
                                                </div>
<!--                                                <div class="col-md-6">-->
<!--                                                    <label for="exampleFormControlSelect1"><b>Email</b></label>-->
<!--                                                    <input type="email" class="form-control" id="exampleInputFirstName" v-model="form.email">-->
<!--                                                    <small class="text-danger" v-if="errors.email"> {{ errors.email[0] }} </small>-->
<!--                                                </div>-->
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <label for="exampleFormControlSelect1"><b>Mois</b></label>
                                                    <select class="form-control" id="exampleFormControlSelect1" v-model="form.salary_month">
                                                        <option value="Janvier"> Janvier </option>
                                                        <option value="Février"> Février </option>
                                                        <option value="Mars"> Mars </option>
                                                        <option value="Avril"> Avril </option>
                                                        <option value="Mai"> Mai </option>
                                                        <option value="Juin"> Juin </option>
                                                        <option value="Juillet"> Juillet </option>
                                                        <option value="Août"> Août </option>
                                                        <option value="Septembre"> Septembre </option>
                                                        <option value="Octobre"> Octobre </option>
                                                        <option value="Novembre"> Novembre </option>
                                                        <option value="Decembre"> Decembre </option>
                                                    </select>
                                                    <small class="text-danger" v-if="errors.salary_month"> {{ errors.salary_month[0] }} </small>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="exampleFormControlSelect1"><b>Salaire</b></label>
                                                    <input type="text" class="form-control" id="exampleInputFirstName" v-model="form.sallery">
                                                    <small class="text-danger" v-if="errors.sallery"> {{ errors.sallery[0] }} </small>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary btn-block">Payer maintenant</button>
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
            form:{
                name: '',
                // email: '',
                salary_month: '',
                sallery: ''
            },
            errors:{}
        }
    },
    created(){
        let id = this.$route.params.id
        axios.get('/api/employee/'+id)
            .then(({data}) => (this.form = data))
            .catch(console.log('error'))
    },

    methods:{
        SalaryPaid(){
            let id = this.$route.params.id
            axios.post('/api/salary/paid/'+id,this.form)
                .then(() => {
                    this.$router.push({ name: 'given-salary'})
                    Notification.success()
                })
                .catch(error =>this.errors = error.response.data.errors)
        },
    }
}

</script>


<style type="text/css">

</style>
