<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\Suplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;

class SuplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suplier = Suplier::all();
        return response()->json($suplier);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required|unique:supliers|max:255',
//            'email' => 'required',
            'phone' => 'required',

        ]);

        if ($request->photo) {
            $position = strpos($request->photo, ';');
            $sub = substr($request->photo, 0, $position);
            $ext = explode('/', $sub)[1];

            $name = time() . "." . $ext;
            $img = Image::make($request->photo)->resize(240, 200);
            $upload_path = 'backend/suplier/';
            $image_url = $upload_path . $name;
            $img->save($image_url);

            $suplier = new Suplier;
            $suplier->name = $request->name;
//            $suplier->email = $request->email;
            $suplier->phone = $request->phone;
            $suplier->shopname = $request->shopname;
            $suplier->address = $request->address;
            $suplier->photo = $image_url;
            $suplier->save();
        } else {
            $suplier = new Suplier;
            $suplier->name = $request->name;
//            $suplier->email = $request->email;
            $suplier->phone = $request->phone;
            $suplier->shopname = $request->shopname;
            $suplier->address = $request->address;

            $suplier->save();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $suplier = DB::table('supliers')->where('id',$id)->first();
        return response()->json($suplier);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = array();
        $data['name'] = $request->name;
//        $data['email'] = $request->email;
        $data['phone'] = $request->phone;
        $data['shopname'] = $request->shopname;
        $data['address'] = $request->address;

        $image = $request->newphoto;

        if ($image) {
            $position = strpos($image, ';');
            $sub = substr($image, 0, $position);
            $ext = explode('/', $sub)[1];

            $name = time().".".$ext;
            $img = Image::make($image)->resize(240,200);
            $upload_path = 'backend/suplier/';
            $image_url = $upload_path.$name;
            $success = $img->save($image_url);

            if ($success) {
                $data['photo'] = $image_url;
                $img = DB::table('supliers')->where('id',$id)->first();
                $image_path = $img->photo;
                $done = unlink($image_path);
                $user  = DB::table('supliers')->where('id',$id)->update($data);
            }

        }else{
            $oldphoto = $request->photo;
            $data['photo'] = $oldphoto;
            $user = DB::table('supliers')->where('id',$id)->update($data);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $suplier = DB::table('supliers')->where('id',$id)->first();
        $photo = $suplier->photo;
        if ($photo) {
            unlink($photo);
            DB::table('supliers')->where('id',$id)->delete();
        }else{
            DB::table('supliers')->where('id',$id)->delete();
        }
    }
}
