<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $req)
    {
        if (isset($req->tags)){ # Ha vannak tagek a szűrőben, azokra kezd szűrni
            $posts = Post::where(function ($query) use($req) {
             for ($i = 0; $i < count($req->tags); $i++){
                    $query->orwhere('tags', 'like',  '%' . $req->tags[$i] .'%');
             }      
        })->orderBy('id', 'DESC')->simplePaginate(7);

        }else{
            $posts = Post::orderBy('id', 'DESC')->simplePaginate(7);
        }

        $existing_tags = []; # Már létező tagek kigyűjtése, ezen keresztül kapja meg a <select> mindet, mint option
        foreach(Post::get('tags') as $post){
            foreach(explode(',',$post->tags) as $iteg){ # Ismétlődéseket kiveszi, hogy átláthatóbb és barátibb legyen a select
                if(!in_array($iteg, ['PHP','LARAVEL','DEVLOG'])){ # Hardkódolt optionok a PHP, Laravel és Devlog, ha ezek benne vannak a lekérdezésben, vegye ki őket (mert már alapból ott vannak a selectben)
                    array_push($existing_tags, $iteg);
                }
            };
        };
        $existing_tags = array_unique($existing_tags);
        return view('posts.index', [
            'posts' =>$posts,
            'itags' =>$existing_tags
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $existing_tags = [];
        foreach(Post::get('tags') as $post){
            foreach(explode(',',$post->tags) as $iteg){
                if(!in_array($iteg, ['PHP','LARAVEL','DEVLOG'])){
                    array_push($existing_tags, $iteg);
                }
            };
        };
        $existing_tags = array_unique($existing_tags);

        return view('posts.create', [
            'itags' =>$existing_tags # már létező, manuálisan létrehozott tagek hozzáadása
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create_now(Request $req)
    {
        $this->validate($req, [
            'title' => 'required|max:50',
            'tags' => 'required',
            'body' => 'required'
        ]);

        $req->tags = array_map('strtoupper', $req->tags); # a tagek nagybetűssé tétele, hogy ne legyenek ismétlődések kisbetű-nagybetű miatt (pl. Devlog, DEVLOG, DEVlog, DEvlog, stb)
        Post::create([
            'title' => $req->title,
            'tags' => implode(",", $req->tags),
            'body' => $req->body
        ]);

        return Redirect::to(route('home'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('posts.single', [
            'post' => $post
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $existing_tags = [];
        foreach(Post::get('tags') as $post){
            foreach(explode(',',$post->tags) as $iteg){
                if(!in_array($iteg, ['PHP','LARAVEL','DEVLOG'])){
                    array_push($existing_tags, $iteg);
                }
            };
        };
        $existing_tags = array_unique($existing_tags);

        $post = Post::find($id);
        return view('posts.edit', [
            'post' => $post,
            'itags' =>$existing_tags
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, Post $id)
    {
        $this->validate($req, [
            'title' => 'required|max:50',
            'tags' => 'required',
            'body' => 'required'
        ]);

        $req->tags = array_map('strtoupper', $req->tags);
        $id->update([
            'title' => $req->title,
            'tags' => implode(",", $req->tags),
            'body' => $req->body
        ]);

        return Redirect::to(route('home'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $id)
    {
        $id->delete();

        return Redirect::to(route('home'));
    }
}
