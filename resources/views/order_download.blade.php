<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Facture</title>

    <style type="text/css">
        * {
            font-family: Verdana, Arial, sans-serif;
        }
        table{
            font-size: x-small;
        }
        tfoot tr td{
            font-weight: bold;
            font-size: x-small;
        }
        .gray {
            background-color: lightgray
        }
        .font{
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

</head>
<body>

<table width="100%" style="background: #F7F7F7; padding:0 20px 0 20px;">
    <tr>
        <td valign="top">
        <!-- {{-- <img src="" alt="" width="150"/> --}} -->
            <h2 style="color: green; font-size: 26px;"><strong>Modji néné</strong></h2>
        </td>
        <td align="right">
            <pre class="font" >
               Modji néné
               Email:support@Modji-nene.com <br>
               Mob: (+221) 78 301 83 34 <br>
               Malika, Senegal <br>

            </pre>
        </td>
    </tr>

</table>


<table width="100%" style="background:white; padding:2px;"></table>
<table width="100%" style="background: #F7F7F7; padding:0 5px 0 5px;" class="font">
    <tr>
        <td>
            <p class="font" style="margin-left: 20px;">
                <strong>Nom:</strong> {{ $order->name }}<br>
                <strong>Télephone:</strong> {{ $order->phone }} <br>
                <strong>Adresse:</strong> {{ $order->address }} <br>
            </p>
        </td>
        <td>
            <p class="font">
            <h3><span style="color: green;">Facture:</span> test</h3>
            Date Commande : {{ $order->order_date }} <br>
            Type Paiement : {{ $order->payby }} </span>
            </p>
        </td>
    </tr>
</table>
<br/>
<h3>Produit</h3>
<table width="100%">
    <thead style="background-color: green; color:#FFFFFF;">
    <tr class="font">
        <th>Image</th>
        <th>Nom Produit</th>
        <th>Code</th>
        <th>Quantité</th>
        <th>Prix unitaire </th>
        <th>Total </th>
    </tr>
    </thead>
    <tbody>
    @foreach($details as $item)
        <tr class="font">
            <td align="center">
{{--                <img src="{{ public_path($item->image??'')  }}" height="60px;" width="60px;" alt="">--}}
                <img src="" alt="">
            </td>
            <td align="center"> {{ $item->product_name }}</td>
            <td align="center">{{ $item->product_code }}</td>
            <td align="center">{{ $item->pro_quantity }}</td>
            <td align="center">${{ $item->product_price }}</td>
            <td align="center">${{ $item->sub_total }} </td>
        </tr>
    @endforeach
    </tbody>
</table>
<br>
<table width="100%" style=" padding:0 10px 0 10px;">
    <tr>
        <td align="right" >
{{--            <h2><span style="color: green;">Subtotal:</span>${{ $order->amount }}</h2>--}}
            <h2><span style="color: green;">Total:</span> ${{ $order->sub_total }}</h2>
            {{-- <h2><span style="color: green;">Full Payment PAID</h2> --}}
        </td>
    </tr>
</table>
<div class="thanks mt-3">
    <p>Merci d'avoir choisi Modji néné..!!</p>
</div>
<div class="authority float-right mt-5">
    <p>-----------------------------------</p>
    <h5>Signature:</h5>
</div>
</body>
</html>
