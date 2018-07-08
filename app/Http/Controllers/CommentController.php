<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;

//models
use App\Comment;

class CommentController extends Controller
{
   
    public function index(Request $request)
    {
        if($request->no_parent)
        return Comment::
        where('parent_id','=',null)
        ->get();
        else return Comment::where('parent_id','!=',null)->orderBy('created_at','ASC')->get()->groupBy('parent_id');
    }
    public function store(Request $request)
    {
        $input = $request->all();
        return Comment::create($input);
    }
}
