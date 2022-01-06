<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $post=Post::orderBy('created_at','Desc')->get();
        return view('posts.index')->with('post',$post);
    }

    public function trashedPosts()
    {
        $post=Post::onlyTrashed()->where('user_id',Auth::id())->get();
        return view('posts.trash')->with('post',$post);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tag = Tag::all();
        $user = Auth::user();
        if(count($tag)==0){
            return redirect()->route('Tag.create');
        }
        return view('posts.create')->with('user',$user)->with('tags',$tag);
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
            "title"=>"required",
            "subject"=>"required",
            "name"=>"required",
            "photo"=>"required|image"
        ]);

        $photo = $request->photo;
        $newPhoto = time().$photo->getClientOriginalName();
        $photo->move('uploads/posts',$newPhoto);

        $post = Post::create([
            "title"=>$request->title,
            "subject"=>$request->subject,
            "photo"=>'uploads/posts/'.$newPhoto,
            "user_id"=>Auth::id(),
            "slug"=> str_slug($request->title)
        ]);


        $post->tags()->attach($request->name);
        return redirect()->route('Post.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post ,$slug)
    {

        $post=Post::where('slug',$slug)->first();
        $comment = Comment::all();
        $reply = Comment::all();
        // dd($comment);
        return view('posts.show')->with('post',$post)->with('comment',$comment)->with('reply',$reply);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $tag= Tag::all();
        $user = Auth::user();
        if($user->is_admin == 1)
        {
            $post=Post::where('id',$id)->first();
            return view('posts.edit')->with('post',$post)->with('user',$user)->with('tags',$tag);

        }
        $post=Post::where('id',$id)->where('user_id',Auth::id())->first();
        if($post === null)
        {
            return redirect()->back();
        }
        return view('posts.edit')->with('post',$post)->with('user',$user)->with('tags',$tag);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = Post::find($id);
        $this->validate($request,[
            "title"=>"required",
            "subject"=>"required",
            "name"=>"required",
            "photo"=>"image"
        ]);
        if($request->has('photo')){
            $photo = $request->photo;
            $newPhoto = time().$photo->getClientOriginalName();
            $photo->move('uploads/posts',$newPhoto);
            $post->photo = 'uploads/posts/'.$newPhoto;
        }
        $post->title = $request->title;
        $post->subject = $request->subject;
        $post->save();
        $post->tags()->sync($request->name);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post=Post::where('id',$id)->where('user_id',Auth::id())->first();
        if($post === null)
        {
            return redirect()->back();
        }
        $post->delete($id);
        return redirect()->back();
    }

    public function delete($id)
    {
        $post = Post::onlyTrashed()->where('id',$id);
        $post->forceDelete();
        return redirect()->back();
    }

    public function restoreTrashed($id)
    {
        $post = Post::withTrashed()->where('id',$id)->first()->restore();
        return redirect()->back();
    }
}
