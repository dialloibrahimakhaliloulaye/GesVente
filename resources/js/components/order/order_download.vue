<template>
    <div class="container">
        <div class="row">
            <router-link to="/order" class="btn btn-primary">Retour</router-link>
            <a href="" style="margin-left: 5px;" @click.prevent="printme" target="_blank" class="btn btn-primary">Imprimer</a>
        </div>
        <br>
        <div id="cont">
            <table width="100%" style="background: #F7F7F7; padding:0 20px 0 20px;">
                <tr>
                    <td valign="top">
                        <h2 style="color: green; font-size: 26px;"><strong>Modji néné</strong></h2>
                    </td>
                    <td align="right">
            <pre class="font">
               <strong>Modji néné
               Email:support@Modji-nene.com
               Mob: (+221) 78 301 83 34
               Malika, Senegal</strong> <br>

            </pre>
                    </td>
                </tr>

            </table>


            <table width="100%" style="background:white; padding:2px;"></table>
            <table width="100%" style="background: #F7F7F7; padding:0 5px 0 5px;" class="font">
                <tr>
                    <td>
                        <p class="font" style="margin-left: 20px;">
                            <strong>Nom client:</strong> {{ orders.name }}<br>
                            <strong>Télephone:</strong> {{ orders.phone }} <br>
                            <strong>Adresse:</strong> {{ orders.address }} <br>
                        </p>
                    </td>
                    <td>
                        <p class="font">
                        <h3><span style="color: green;">Facture:</span> test</h3>
                        Date Commande : {{ orders.order_date }} <br>
                        Type Paiement : {{ orders.payby }}
                        <br>
                    </td>
                </tr>
            </table>
            <br/>
            <h3>Produit</h3>
            <table width="100%">
                <thead style="background-color: green; color:#FFFFFF;">
                <tr class="font">
                    <th>Désignation</th>
                    <th>Quantité</th>
                    <th>Prix unitaire</th>
                    <th>Total</th>
                </tr>
                </thead>
                <tbody>
                <tr class="font" v-for="item in details">
                    <td align="center"> {{ item.product_name }}</td>
                    <td align="center">{{ item.pro_quantity }}</td>
                    <td align="center">{{ item.product_price }} FCFA</td>
                    <td align="center">{{ item.sub_total }} FCFA</td>
                </tr>
                </tbody>
            </table>
            <br>
            <br>
            <br>
            <table width="100%" style=" padding:0 10px 0 10px;">
                <tr>
                    <td align="right">
                        <h2><span style="color: green;">Total:</span> {{ orders.sub_total }} FCFA</h2>
                    </td>
                </tr>
            </table>
            <div class="thanks mt-3">
                <br>
                <br>
                <br>
                <br>
                <p>Merci d'avoir choisi Modji néné..!!</p>
            </div>
            <div class="authority float-right mt-5">
                <p>-----------------------------------</p>
                <h5>Signature:</h5>
            </div>
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

    data() {
        return {
            errors: {},
            orders: {},
            details: {},
        }
    },
    created() {
        let id = this.$route.params.id
        axios.get('/api/order/details/' + id)
            .then(({data}) => (this.orders = data))
            .catch(console.log('error'))

        axios.get('/api/order/orderdetails/' + id)
            .then(({data}) => (this.details = data))
            .catch(console.log('error'))
    },

    methods: {
        printme() {
            var prtContent = document.getElementById("cont");
            var WinPrint = window.open('', '', 'left=0,top=0,width=800,height=900,toolbar=0,scrollbars=0,status=0');
            WinPrint.document.write(prtContent.innerHTML);
            WinPrint.document.close();
            WinPrint.focus();
            WinPrint.print();
            WinPrint.close();
            // var body=document.getElementById('body').innerHTML;
            // var data=document.getElementById('cont').innerHTML;
            // document.getElementById('body').innerHTML=data;
            // window.print();
        }
    }
}

</script>

<style scoped>
* {
    font-family: Verdana, Arial, sans-serif;
}

table {
    font-size: x-small;
}

tfoot tr td {
    font-weight: bold;
    font-size: x-small;
}

.gray {
    background-color: lightgray
}

.font {
    font-size: 15px;
}

.authority {
    /*text-align: center;*/
    float: right
}

.authority h5 {
    margin-top: -10px;
    color: green;
    /*text-align: center;*/
    margin-left: 35px;
}

.thanks p {
    color: green;;
    font-size: 16px;
    font-weight: normal;
    font-family: serif;
    margin-top: 20px;
}
</style>
