

<template>
    <div>
        <div class="row">
            <router-link to="/product" class="btn btn-primary">Liste des produits </router-link>
        </div>
        <div class="row justify-content-center">
            <div class="col-xl-12 col-lg-12 col-md-12">
                <div class="card shadow-sm my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="login-form">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Ajouter un produit</h1>
                                    </div>

                                    <form class="user" @submit.prevent="ProductInsert" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <label for="exampleFormControlSelect1">Nom produit</label>
                                                    <input type="text" class="form-control" id="exampleInputFirstName"
                                                            v-model="form.product_name">
                                                    <small class="text-danger" v-if="errors.product_name"> {{ errors.product_name[0] }} </small>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="exampleFormControlSelect1">Code produit</label>
                                                    <input type="text" class="form-control" id="exampleInputFirstName"
                                                            v-model="form.product_code">
                                                    <small class="text-danger" v-if="errors.product_code"> {{ errors.product_code[0] }} </small>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <label for="exampleFormControlSelect1">Catégorie produit</label>
                                                    <select class="form-control" id="exampleFormControlSelect1" v-model="form.category_id">
                                                        <option :value="category.id" v-for="category in categories">{{ category.category_name }}</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="exampleFormControlSelect1">Fournisseur</label>
                                                    <select class="form-control" id="exampleFormControlSelect1" v-model="form.suplier_id">
                                                        <option :value="suplier.id" v-for="suplier in supliers">{{ suplier.name }}</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-md-4">
                                                    <label for="exampleFormControlSelect1">Lieu produit</label>
                                                    <input type="text" class="form-control" id="exampleInputFirstName"  v-model="form.root">
                                                    <small class="text-danger" v-if="errors.root"> {{ errors.root[0] }} </small>
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="exampleFormControlSelect1">Prix de vente</label>
                                                    <input type="text" class="form-control" id="exampleInputFirstName"  v-model="form.buying_price">
                                                    <small class="text-danger" v-if="errors.buying_price"> {{ errors.buying_price[0] }} </small>
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="exampleFormControlSelect1">Prix d'achat</label>
                                                    <input type="text" class="form-control" id="exampleInputFirstName" v-model="form.selling_price">
                                                    <small class="text-danger" v-if="errors.selling_price"> {{ errors.selling_price[0] }} </small>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <label for="exampleFormControlSelect1">Date d'achat produit</label>
                                                    <input type="date" class="form-control" id="exampleInputFirstName" v-model="form.buying_date">
                                                    <small class="text-danger" v-if="errors.buying_date"> {{ errors.buying_date[0] }} </small>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="exampleFormControlSelect1">Quantité produit</label>
                                                    <input type="text" class="form-control" id="exampleInputFirstName"
                                                            v-model="form.product_quantity">
                                                    <small class="text-danger" v-if="errors.product_quantity"> {{ errors.product_quantity[0] }} </small>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <input type="file" class="custom-file-input" id="customFile" @change="onFileSelected">
                                                    <small class="text-danger" v-if="errors.image"> {{ errors.image[0] }} </small>
                                                    <label class="custom-file-label" for="customFile">Choisir une image</label>
                                                </div>
                                                <div class="col-md-6">
                                                    <img :src="form.image" style="height: 40px; width: 40px;">
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
                product_name: null,
                product_code: null,
                category_id: null,
                suplier_id: null,
                root: null,
                buying_price: null,
                selling_price: null,
                buying_date: null,
                image: null,
                product_quantity: null
            },
            errors:{},
            categories:{},
            supliers:{},
        }
    },

    methods:{
        onFileSelected(event){
            let file = event.target.files[0];
            if (file.size > 5242880) {
                Notification.image_validation()
            }else{
                let reader = new FileReader();
                reader.onload = event =>{
                    this.form.image = event.target.result
                    console.log(event.target.result);
                };
                reader.readAsDataURL(file);
            }
        },
        ProductInsert(){
            axios.post('/api/product',this.form)
                .then(() => {
                    this.$router.push({ name: 'product'})
                    Notification.success()
                })
                .catch(error =>this.errors = error.response.data.errors)
        },
    },
    created(){
        axios.get('/api/category/')
            .then(({data}) => (this.categories = data))

        axios.get('/api/suplier/')
            .then(({data}) => (this.supliers = data))
    }
}

</script>


<style type="text/css">

</style>
