<template>
    <div>
        <div class="row justify-content-center">
            <router-link to="" class="btn btn-primary"> Liste des employés </router-link>
        </div>
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card shadow-sm my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="login-form">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Ajouter un employé</h1>
                                    </div>
                                    <form class="user" @submit.prevent="signup">
                                        <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" id="exampleInputFirstName" placeholder="Nom complet"
                                                           v-model="form.name">
                                                    <small class="text-danger" v-if="errors.name"> {{ errors.name[0] }} </small>
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" id="exampleInputFirstName" placeholder="email"
                                                           v-model="form.name">
                                                    <small class="text-danger" v-if="errors.name"> {{ errors.name[0] }} </small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" id="exampleInputFirstName" placeholder="Adresse"
                                                           v-model="form.name">
                                                    <small class="text-danger" v-if="errors.name"> {{ errors.name[0] }} </small>
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" id="exampleInputFirstName" placeholder="Téléphone"
                                                           v-model="form.name">
                                                    <small class="text-danger" v-if="errors.name"> {{ errors.name[0] }} </small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" id="exampleInputFirstName" placeholder="Salaire"
                                                           v-model="form.name">
                                                    <small class="text-danger" v-if="errors.name"> {{ errors.name[0] }} </small>
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="date" class="form-control" id="exampleInputFirstName" placeholder="Date d'embauche"
                                                           v-model="form.name">
                                                    <small class="text-danger" v-if="errors.name"> {{ errors.name[0] }} </small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" id="exampleInputFirstName" placeholder="Nid"
                                                           v-model="form.name">
                                                    <small class="text-danger" v-if="errors.name"> {{ errors.name[0] }} </small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                        <input type="file" class="custom-file-input" id="customFile">
                                                        <label class="custom-file-label" for="customFile">Choisir un fichier</label>
                                                    <small class="text-danger" v-if="errors.name"> {{ errors.name[0] }} </small>
                                                </div>
                                                <div class="col-md-6">
                                                    <img src="form.photo" style="width: 50px; height: 50px" alt="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary btn-block">Ajouter</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "register",
    created() {
        if (!User.loggedIn()){
            this.$router.push({name: '/'})
        }
    },

    //name: "login",
    data(){
        return{
            form:{
                name: null,
                email: null,
                password: null,
                confirm_password: null
            },
            errors: {}
        }
    },
    // methods:{
    //     signup(){
    //         axios.post('/api/auth/signup', this.form)
    //             .then(res => {
    //                 User.responseAfterLogin(res)
    //                 Toast.fire({
    //                     icon: 'success',
    //                     title: 'Compte crée avec succès'
    //                 })
    //                 this.$router.push({name: 'home'})
    //             })
    //             .catch(error => this.errors = error.response.data.errors)
    //     }
    // }
}
</script>

<style scoped>

</style>
