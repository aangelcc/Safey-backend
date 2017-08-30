<?php

namespace App\Http\Controllers;

use function Couchbase\defaultDecoder;
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
        $searchQuery = Product::where(function($query) use ($request) {
            $query->where('name', 'LIKE', '%'.$request->input('keyword').'%')
                ->orWhere('description', 'LIKE', '%'.$request->input('keyword').'%');
        })->whereBetween('price',[$min,$max]);
        if($request->input('store_id')!==NULL){
            $searchQuery->whereIn('store_id',explode(',',$request->input('store_id')));
        }
        switch ($request->input('order_by')){
            case 1:
                $searchQuery->orderBy('name','asc');
                break;
            case 2:
                $searchQuery->orderBy('name','desc');
                break;
            case 3:
                $searchQuery->orderBy('price','asc');
                break;
            case 4:
                $searchQuery->orderBy('price','desc');
                break;
            default:
                $searchQuery->orderBy('rating','desc');
        }
        return $searchQuery->paginate(5);
    }
}
