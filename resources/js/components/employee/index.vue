<template>
    <div>
        <div class="row justify-content-center">
            <router-link to="/store-employee" class="btn btn-primary"> Ajouter un employés </router-link>
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
        }
    },
    methods:{
    }
}
</script>

<style scoped>

</style>
