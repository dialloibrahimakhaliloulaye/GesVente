<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\Caisses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function TodayOrder(){
        $data = date('d/m/Y');
        $order = DB::table('orders')
            ->join('customers','orders.customer_id','customers.id')
            ->where('order_date',$data)
            ->select('customers.name','orders.*')
            ->orderBy('orders.id','DESC')->get();
        return response()->json($order);
    }

    public function OrderDetails($id){
        //return response()->json($id);
        $order = DB::table('orders')
            ->join('customers','orders.customer_id','customers.id')
            ->where('orders.id',$id)
            ->select('customers.name','customers.phone','customers.address','orders.*')
            ->first();
        return response()->json($order);
    }

    public function OrderDetailsAll($id){
        $details = DB::table('order_details')
            ->join('products','order_details.product_id','products.id')
            ->where('order_details.order_id',$id)
            ->select('products.product_name','products.product_code','products.image','order_details.*')
            ->get();
        return response()->json($details);
    }

    public function AddCaisse(Request $request){
        $validateData = $request->validate([
            'montant' => 'required|max:255',
        ]);

        $caisse = new Caisses;
        $caisse->montant = $request->montant;
        $caisse->caisse_code  ='tk-'.strtoupper(substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, 7));
        $caisse->save();
    }

    public function Ticket()
    {
        $caisses = Caisses::all();
        return response()->json($caisses);
    }

}
