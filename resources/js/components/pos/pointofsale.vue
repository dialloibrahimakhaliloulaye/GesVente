<template>

    <div>
        <div class="container-fluid" id="container-wrapper">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Saisie facturation</h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="./">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                </ol>
            </div>

            <div class="row mb-3">
                <!-- Earnings (Monthly) Card Example -->

                <!-- Area Chart -->
                <div class="col-xl-5 col-lg-5">
                    <div class="card mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Ajouter des frais</h6>
                            <a href="" class="btn btn-sm btn-primary">Ajouter un client</a>
                        </div>
                        <div class="table-responsive">
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                <tr>
                                    <th>Nom</th>
                                    <th>Qté</th>
                                    <th>P. U</th>
                                    <th>Total</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td><a href="#">Nom</a></td>
                                    <td>Qté</td>
                                    <td>P U</td>
                                    <td>P U</td>
                                    <td><a href="#" class="btn btn-sm btn-primary">X</a></td>
                                </tr>

                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer">
                            <ul class="list-group">
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Qté total : <strong>57</strong>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    S. Total : <strong>57 FCFA</strong>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Vat : <strong>35 %</strong>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Total : <strong>57</strong>
                                </li>
                            </ul>
                            <br>
                            <form action="">
                                <div class="form-group">
                                    <label>Nom client</label>
                                    <select name="" class="form-control" v-model="customer_id">
                                        <option value="" v-for="customer in customers">{{customer.name}}</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Montant rémis</label>
                                    <input type="text" class="form-control" required v-model="pay">
                                </div>
                                <div class="form-group">
                                    <label>Montant restant à payer</label>
                                    <input type="text" class="form-control" disabled required v-model="due">
                                </div>
                                <div class="form-group">
                                    <label>Payer par</label>
                                    <select name="" class="form-control" v-model="customer_id">
                                        <option value="HandCash">Cash maintenant</option>
                                        <option value="Reception">à la reception</option>
                                        <option value="Autre">Autre</option>
                                    </select>
                                </div>
                                <br>
                                <buton type="submit" class="btn btn-success">Soumettre</buton>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Pie Chart -->
                <div class="col-xl-7 col-lg-7">
                    <div class="card mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Liste compléte des produits</h6>

                        </div>
                        <!--  Categorie wise product-->
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                                   aria-controls="home" aria-selected="true">Tous les produits</a>
                            </li>
                            <li class="nav-item" role="presentation" v-for="category in categories" :key="category.id">
                                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                                   aria-controls="profile" aria-selected="false"
                                   @click="subProduct(category.id)">{{ category.category_name }}</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <div class="card-body">
                                    <input type="text" v-model="searchTerm" class="form-control" style="width: 550px;"
                                           placeholder="rechercher ici">
                                    <div class="row">
                                        <div class="col-lg-3 col-md-3 col-sm-6 col-6" v-for="product in filtersearch"
                                             :key="product.id">
                                            <a class="btn-btn-sm" @click.prevent="AddToCart(product.id)">
                                                <div class="card" style="width: 8.5rem; margin-bottom: 5px;">
                                                    <img :src="product.image" id="em_photo" class="card-img-top">
                                                    <div class="card-body">
                                                        <h6 class="card-title">{{ product.product_name }}</h6>
                                                        <span v-if="product.product_quantity  >= 1 "
                                                              class="badge badge-success">
                                                    En stock ({{ product.product_quantity }})</span>
                                                        <span v-else=" " class="badge badge-danger">Stock fini </span>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <input type="text" v-model="getsearchTerm" class="form-control" style="width: 550px;"
                                       placeholder="rechercher ici">
                                <div class="row">
                                    <div class="col-lg-3 col-md-3 col-sm-6 col-6" v-for="getproduct in getfiltersearch"
                                         :key="getproduct.id">
                                        <a href="">
                                            <div class="card" style="width: 8.5rem; margin-bottom: 5px;">
                                                <img :src="getproduct.image" id="em_photo" class="card-img-top">
                                                <div class="card-body">
                                                    <h6 class="card-title">{{ getproduct.product_name }}</h6>
                                                    <span v-if="getproduct.product_quantity  >= 1 "
                                                          class="badge badge-success">
                                                En stock ({{ getproduct.product_quantity }})</span>
                                                    <span v-else=" " class="badge badge-danger">Stock fini </span>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--    Categorie wise product end -->

                    </div>
                </div>
                <!-- Invoice Example -->
            </div>
            <!--Row-->

        </div>

    </div>

</template>


<script type="text/javascript">

export default {
    created() {
        if (!User.loggedIn()) {
            this.$router.push({name: '/'})
        }
    },
    created() {
        this.allProduct();
        this.allCategory();
        this.allCustomer();
    },
    data() {
        return {
            products: [],
            categories: '',
            getproducts: [],
            searchTerm: '',
            getsearchTerm: '',
            customers: '',
            errors: ''
        }
    },
    computed: {
        filtersearch() {
            return this.products.filter(product => {
                return product.product_name.match(this.searchTerm)
            })
        },
        getfiltersearch() {
            return this.getproducts.filter(getproduct => {
                return getproduct.product_name.match(this.getsearchTerm)
            })
        },
    },

    methods: {
        AddToCart(id){
            axios.get('/api/addToCart/'+id)
                .then(() => {
                    Notification.cart_success()
                })
                .catch()
        },
        allProduct() {
            axios.get('/api/product/')
                .then(({data}) => (this.products = data))
                .catch()
        },
        allCategory() {
            axios.get('/api/category/')
                .then(({data}) => (this.categories = data))
                .catch()
        },
        allCustomer() {
            axios.get('/api/customer/')
                .then(({data}) => (this.customers = data))
                .catch(console.log('error'))
        },
        subProduct(id) {
            axios.get('/api/getting/product/' + id)
                .then(({data}) => (this.getproducts = data))
                .catch()
        }
    }


}
</script>


<style type="text/css" scoped>
#em_photo {
    height: 100px;
    width: 135px;
}
</style>
