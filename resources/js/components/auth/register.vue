<template>
    <div>
        <div class="row justify-content-center">
            <div class="col-xl-6 col-lg-6 col-md-6">
                <div class="card shadow-sm my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="login-form">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Créer un compte</h1>
                                    </div>
                                    <form class="user" @submit.prevent="signup">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="exampleInputFirstName" placeholder="Nom complet"
                                            v-model="form.name">
                                            <small class="text-danger" v-if="errors.name"> {{ errors.name[0] }} </small>
                                        </div>
                                        <div class="form-group">
                                            <input type="email" class="form-control" id="exampleInputEmail" aria-describedby="emailHelp"
                                                   placeholder="Adresse mail" v-model="form.email">
                                            <small class="text-danger" v-if="errors.email"> {{ errors.email[0] }} </small>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control" id="exampleInputPassword" placeholder="Mot de passe"
                                                   v-model="form.password">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control" id="exampleInputPasswordRepeat"
                                                   placeholder="Confirmation mot de passe" v-model="form.password_confirmation">
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary btn-block">Créer</button>
                                        </div>
                                        <hr>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <router-link to="/" class="font-weight-bold small">Vous avez déjà un compte?</router-link>
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

<script>
export default {
    name: "register",
    created() {
        if (User.loggedIn()){
            this.$router.push({name: 'home'})
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
    methods:{
        signup(){
            axios.post('/api/auth/signup', this.form)
                .then(res => {
                    User.responseAfterLogin(res)
                    Toast.fire({
                        icon: 'success',
                        title: 'Compte crée avec succès'
                    })
                    this.$router.push({name: 'home'})
                })
                .catch(error => this.errors = error.response.data.errors)
        }
    }
}
</script>

<style scoped>

</style>
