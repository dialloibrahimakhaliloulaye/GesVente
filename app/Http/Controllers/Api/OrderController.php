<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf;
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

    public function OrderDownload($id){
        $order = DB::table('orders')
            ->join('customers','orders.customer_id','customers.id')
            ->where('orders.id',$id)
            ->select('customers.name','customers.phone','customers.address','orders.*')
            ->first();

        $details = DB::table('order_details')
            ->join('products','order_details.product_id','products.id')
            ->where('order_details.order_id',$id)
            ->select('products.product_name','products.product_code','products.image','order_details.*')
            ->get();

//        $pdf = PDF::loadView('order_download', compact('order', 'details'))->setPaper('a4')->setOptions([
//            'tempDir' => public_path(),
//            'chroot' => public_path(),
//        ]);
//        return $pdf->download('invoice.pdf');

//        $pdf = PDF::loadView('order_download', compact('order', 'details'))->setPaper('a4', 'landscape')->setWarnings(false);
//
//        return response()->streamDownload(function () use ($pdf) {
//            echo $pdf->output();
//        }, 'invoice.pdf');

        return PDF::loadView('order_download', compact('order', 'details'))
            ->setPaper('a4', 'landscape')
            ->setWarnings(false)
            ->save(public_path("fichier.pdf"))
            ->stream();
    }
}
