<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Store;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required',
            'description'=>'required',
            'address'=>'required',
            'image'=>'required',
            'email'=>'required',
            'phone_number'=>'required|numeric',
            'cif'=>'required',
            'owner_id'=>'required'
        ]);
        $store = new Store($request->all());
        $store->rating = 0;
        $store->save();
        return response()->json(['status'=>true,'message'=>'Store successfully created','data'=>$store]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $this->validate($request,[
            'name'=>'required',
            'description'=>'required',
            'address'=>'required',
            'image'=>'required',
            'email'=>'required',
            'phone_number'=>'required|numeric',
            'cif'=>'required',
            'owner_id'=>'required'
        ]);
        $store = Store::find($id);
        $store->name = $request->input('name');
        $store->description = $request->input('description');
        $store->address = $request->input('address');
        $store->image = $request->input('image');
        $store->email = $request->input('email');
        $store->phone_number = $request->input('phone_number');
        $store->cif = $request->input('cif');
        $store->owner_id = $request->input('owner_id');
        $store->save();
        return response()->json(['status'=>true,'message'=>'Store successfully updated','data'=>$store]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $store = Store::find($id);
        $store->delete();
        return response()->json(['status'=>true,'message'=>'Product successfully deleted','data'=>$store]);
    }
}
