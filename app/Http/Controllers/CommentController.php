<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($id){
        $post =Post::where('id',$id)->first();
        return view('posts.comment')->with('post',$post);
    }

    public function replyIndex($id){
        $comment =Comment::where('id',$id)->first();
        return view('posts.reply')->with('comment',$comment);
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'title'=>'required|string|max:255',
            'body'=>'required|string|max:1000'
        ]);
        $post = Post::where('id',$request->id)->first();
        // dd($post);
        $comment = Comment::create([
            'title'=>$request->title,
            'body'=>$request->body,
            'user_id'=>Auth::id(),
            'parent_id'=>$post->id,
            'post_id'=>$post->id
        ]);
        return redirect()->route('Post.show',$post->slug);
    }

    public function replyStore(Request $request)
    {
        $this->validate($request,[
            'title'=>'required|string|max:255',
            'body'=>'required|string|max:1000'
        ]);
        $comment = Comment::where('id',$request->id)->first();
        // dd($comment);
        $reply = Comment::create([
            'title'=>$request->title,
            'body'=>$request->body,
            'user_id'=>Auth::id(),
            'post_id'=>$comment->post_id,
            'parent_id'=>$comment->id
        ]);
        return redirect()->route('Post.show',$comment->post->slug);
    }

    public function update(Request $request, Comment $comment)
    {
        //
    }

    public function show($id)
    {

        $comment = Comment::where('id',$id)->first();
        $post = Post::where('id',$comment->post_id)->first();
        $reply = Comment::all();
        return view('posts.commentPost')->with('comment',$comment)->with('reply',$reply)->with('post',$post);
    }

    public function destroy($id)
    {
        $comment = Comment::where('id',$id)->where('user_id',Auth::id())->first();
        $replies = Comment::all();
        foreach($replies as $item)
        {
            if ($item->parent_id == $id)
            {
                $item->delete($item->id);
            }
        }
        $comment->delete($id);


        return redirect()->back();
    }
}
