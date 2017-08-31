<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;

class OrderController extends Controller
{
    public function __construct(){
        $this->middleware('jwt.auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Order::paginate(5);
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
            'user_id'=>'required|exists:users,id',
            'url'=>'nullable',
            'product_id'=>'nullable|exists:products,id',
            'delivery_date'=>'nullable',
            'observation'=>'nullable'
        ]);
        $order = new Order($request->all());
        $order->status = 1;
        if($order->url===NULL && $order->product_id===NULL){
            return response()->json(['status'=>true,'message'=>'url or product_id required','data'=>$order], 422);
        }
        $order->save();
        return response()->json(['status'=>true,'message'=>'Order successfully created','data'=>$order]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Order::findOrFail($id);
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
            'delivery_date'=>'nullable',
            'observation'=>'nullable',
            'status'=>'required|numeric'
        ]);
        $order = Order::find($id);
        $order->delivery_date = $request->input('delivery_date');
        $order->observation = $request->input('observation');
        $order->status = $request->input('status');

        $order->save();
        return response()->json(['status'=>true,'message'=>'Order successfully updated','data'=>$order]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = Order::find($id);
        $order->delete();
        return response()->json(['status'=>true,'message'=>'Order successfully deleted','data'=>$order]);
    }
}
