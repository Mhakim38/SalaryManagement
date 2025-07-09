<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:20',
            'content' => 'required|string|max:100',
        ]);

        $post = Post::create([
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return response()->json([
            'status' => 'ok',
            'msg' => 'Done Store data',
            'data' => $post,
        ]);
    }

    public function index(){
        $posts = Post::all();
        return response()->json([
            'status' => 'ok',
            'msg' => 'Done Getting Data', 
            'data' => $posts,
        ]);
    }

    public function editPage($id){
        $posts = Post::find($id);
        if ($posts){
            return view('editPage', ['post' => $posts]);
        }
    }
}
