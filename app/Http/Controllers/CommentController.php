<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Comment::all();
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
            'comment'=>'nullable',
            'user_id'=>'required|exists:users,id',
            'product_rating'=>'required|numeric',
            'comment_rating'=>'nullable|numeric',
            'product_id'=>'required|exists:products,id'
        ]);
        $comment = new Comment($request->all());
        $comment->comment_rating = 0;
        $comment->save();
        return response()->json(['status'=>true,'message'=>'Comment created successfully','data'=>$comment]);
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
            'comment'=>'nullable',
            'product_rating'=>'required|numeric',
            'comment_rating'=>'nullable|numeric',
        ]);
        $comment = Comment::find($id);
        $comment->comment = $request->input('comment');
        $comment->product_rating = $request->input('product_rating');
        $comment->comment_rating = $request->input('comment_rating');
        $comment->save();
        return response()->json(['status'=>true,'message'=>'Comment updated successfully','data'=>$comment]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comment = Comment::find($id);
        $comment->delete();
        return response()->json(['status'=>true,'message'=>'Comment deleted successfully','data'=>$comment]);
    }
}
