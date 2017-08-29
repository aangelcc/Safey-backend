<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
class SearchProductController extends Controller
{
    public function __invoke(Request $request){
        $min=0;
        $max=50000000;
        if($request->input('min')!==NULL){
            $min=$request->input('min');
        }
        if($request->input('max')!==NULL){
            $max=$request->input('max');
        }
        //return Product::where('name','LIKE','%'.$request->input('keyword').'%')->pluck('name');
        return Product::where('name','LIKE','%'.$request->input('keyword').'%')
            ->orWhere('description','LIKE','%'.$request->input('keyword').'%')
            ->whereBetween('price', [$min, $max])
            ->get();
    }
}
