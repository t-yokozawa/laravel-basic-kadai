<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Posts;

class PostController extends Controller
{
    public function index(){
        $posts = DB::table('posts')->get();
        // $posts = Post::all();
        return view('posts.index', compact('posts'));
    }

    public function show($id){
        $posts = Posts::find($id);
        return view('posts.show', compact('posts'));
    }

    public function create(){
        return view('posts.create');
    }

    public function store (Request $request){
        $request->validate([
            'title' => 'required|max:20',
            'content' => 'required|max:200'
        ]);
        
        $posts = new Posts();
        $posts->title = $request->input('title');
        $posts->content = $request->input('content');
        $posts->save();

        return redirect('/posts');
    }
}
