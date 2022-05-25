
<template>

    <div>
        <div class="row">
            <router-link to="/ticket-view" class="btn btn-primary">Liste des Tickets de caisses </router-link>

        </div>
        <div class="row justify-content-center">
            <div class="col-xl-12 col-lg-12 col-md-12">
                <div class="card shadow-sm my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="login-form">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Ajouter un ticket de caisse</h1>
                                    </div>
                                    <form class="user" @submit.prevent="caisseInsert">
                                        <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-md-12">
                                                    <input type="text" class="form-control" id="exampleInputFirstName"
                                                           placeholder="Montant du ticket" v-model="form.montant">
                                                    <small class="text-danger" v-if="errors.montant"> {{ errors.montant[0] }} </small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary btn-block">Ajouter</button>
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
                montant: null
            },
            errors:{}
        }
    },

    methods:{
        caisseInsert(){
            axios.post('/api/order/caisse',this.form)
                .then(() => {
                    this.$router.push({ name: 'category'})
                    Notification.success()
                })
                .catch(error =>this.errors = error.response.data.errors)
        },
    }

}

</script>


<style type="text/css">

</style>
