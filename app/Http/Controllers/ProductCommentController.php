<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
class ProductCommentController extends Controller
{
    public function __invoke(Request $request){
        return Comment::where(function($query) use ($request){
            $query->where('product_id', '=', $request->input('id'));
        })->paginate(5);
    }
}
