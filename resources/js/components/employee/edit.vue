

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
                                        <h1 class="h4 text-gray-900 mb-4">Modifier les infos de l'employé</h1>
                                    </div>

                                    <form class="user" @submit.prevent="employeeUpdate" enctype="multipart/form-data">

                                        <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" id="exampleInputFirstName" placeholder="Nom complet"
                                                           v-model="form.name">
                                                    <small class="text-danger" v-if="errors.name"> {{ errors.name[0] }} </small>
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" id="exampleInputFirstName" placeholder="Email"
                                                           v-model="form.email">
                                                    <small class="text-danger" v-if="errors.email"> {{ errors.email[0] }} </small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" id="exampleInputFirstName" placeholder="Adresse"
                                                           v-model="form.address">
                                                    <small class="text-danger" v-if="errors.address"> {{ errors.address[0] }} </small>
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" id="exampleInputFirstName" placeholder="Téléphone"
                                                           v-model="form.phone">
                                                    <small class="text-danger" v-if="errors.phone"> {{ errors.phone[0] }} </small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" id="exampleInputFirstName" placeholder="Salaire"
                                                           v-model="form.sallery">
                                                    <small class="text-danger" v-if="errors.sallery"> {{ errors.sallery[0] }} </small>
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="date" class="form-control" id="exampleInputFirstName" placeholder="Date d'embauche"
                                                           v-model="form.joining_date">
                                                    <small class="text-danger" v-if="errors.joining_date"> {{ errors.joining_date[0] }} </small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" id="exampleInputFirstName" placeholder="Nid"
                                                           v-model="form.nid">
                                                    <small class="text-danger" v-if="errors.nid"> {{ errors.nid[0] }} </small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <input type="file" class="custom-file-input" id="customFile" @change="onFileSelected">
                                                    <label class="custom-file-label" for="customFile">Choisir un fichier</label>
                                                    <small class="text-danger" v-if="errors.photo"> {{ errors.photo[0] }} </small>
                                                </div>
                                                <div class="col-md-6">
                                                    <img :src="form.photo" style="width: 50px; height: 50px" alt="">
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
        let id = this.$route.params.id
        axios.get('/api/employee/'+id)
            .then(({data}) => (this.form = data))
            .catch(console.log('error'))
    },

    data(){
        return {
            form:{
                name: '',
                email: '',
                phone: '',
                sallery: '',
                address: '',
                photo: '',
                newphoto: '',
                nid: '',
                joining_date: ''
            },
            errors:{}
        }
    },
    // created(){
    //     let id = this.$route.params.id
    //     axios.get('/api/employee/'+id)
    //         .then(({data}) => (this.form = data))
    //         .catch(console.log('error'))
    // },

    methods:{
        onFileSelected(event){
            let file = event.target.files[0];
            if (file.size > 5242880) {
                Notification.image_validation()
            }else{
                let reader = new FileReader();
                reader.onload = event =>{
                    this.form.newphoto = event.target.result
                };
                reader.readAsDataURL(file);
            }
        },
        employeeUpdate(){
            let id = this.$route.params.id
            axios.patch('/api/employee/'+id,this.form)
                .then(() => {
                    this.$router.push({ name: 'employee'})
                    Notification.success()
                })
                .catch(error =>this.errors = error.response.data.errors)
        },
    }
}

</script>


<style type="text/css">

</style>
