
<template>

    <div>
        <div class="row">
            <router-link to="/salary" class="btn btn-primary">Retour </router-link>
        </div>
        <div class="row justify-content-center">
            <div class="col-xl-12 col-lg-12 col-md-12">
                <div class="card shadow-sm my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="login-form">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Modifier le salaire </h1>
                                    </div>
                                    <form class="user" @submit.prevent="SalaryUpdate">
                                        <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <label for="exampleFormControlSelect1"><b>Nom complet</b></label>
                                                    <input type="text" class="form-control" disabled="disabled" id="exampleInputFirstName" v-model="form.name">
                                                    <small class="text-danger" v-if="errors.name"> {{ errors.name[0] }} </small>
                                                </div>
<!--                                                <div class="col-md-6">-->
<!--                                                    <label for="exampleFormControlSelect1"><b>Email</b></label>-->
<!--                                                    <input type="email" class="form-control" disabled="disabled" id="exampleInputFirstName" v-model="form.email">-->
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
                                                <input type="hidden" v-model="form.employee_id" >
                                                <div class="col-md-6">
                                                    <label for="exampleFormControlSelect1"><b>Somme (FCFA)</b></label>
                                                    <input type="text" class="form-control" id="exampleInputFirstName" v-model="form.amount">
                                                    <small class="text-danger" v-if="errors.amount"> {{ errors.amount[0] }} </small>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary btn-block">Modifier</button>
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
                email: '',
                salary_month: '',
                amount: '',
                employee_id:''
            },
            errors:{}
        }
    },
    created(){
        let id = this.$route.params.id
        axios.get('/api/edit/salary/'+id)
            .then(({data}) => (this.form = data))
            .catch(console.log('error'))
    },

    methods:{
        SalaryUpdate(){
            let id = this.$route.params.id
            axios.post('/api/salary/update/'+id,this.form)
                .then(() => {
                    this.$router.push({ name: 'salary'})
                    Notification.success()
                })
                .catch(error =>this.errors = error.response.data.errors)
        },
    }
}

</script>


<style type="text/css">

</style>
