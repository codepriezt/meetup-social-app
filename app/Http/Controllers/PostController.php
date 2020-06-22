<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Auth;
use App\User;
use JD\Cloudder\Facades\Cloudder;

class PostController extends Controller
{
    public function createPostImage(Request $request)
    {
        $post = new Post;
        $post->user = Auth::user()->id;
        $post->body = $request->body;
        $image = $request->image;


        if ($image) {

            Cloudder::upload($request->image->getRealPath(), null);
            $upload = Cloudder::getResult();
            $url = $upload["url"];
        
        }

            $post->create([
                'user_id'=>$post->user,
                'body'=> $post->body,
                'image'=>$url,
            ]);
                

        if (!$post) {
            return back()->with('error', 'Unable to create post at the moment');
        }
        return back()->with('info', 'Post successfully created');
    }


    public function createPost(Request $request)
    {
        $this->validate($request, [
            "description" => 'required',
        ]);

        Auth::user()->post()->create([
            'body' => $request->description,
        ]);

        return back()->with('info', 'Post succefully created');
    }


    public function editPost(Request $request, $postId)
    {
        $post = Post::find($request->postId);
        $user_id = User::find(Auth::user());
        $body = $request->description;

        $edit = $post->update([
            'user_id' => $user_id,
            'body' => $body,
        ]);

        if (!$edit) {
            return back()->with('error', "unable to update post");
        }
        return  back()->with('info', "post updated");
    }


    public function deletePost($postId)
    {
        $post = Post::where('id', $postId)->first();

        if (!$post) {
            return back()->with('error', "you post does not exist");
        }

        $post->delete();

        return back()->with('info', "post deleted");
    }



    public function getlikes($postId)
    {

        $post = Post::find($postId);

        if (!$post) {
            return back()->with('error', 'unable to get post');
        }

        // if(!Auth::user()->isFriendWith($post->user)){
        //     return back()->with('info' , 'sorry, you cant like this post.. not a friend to the post author');

        // }

        if (Auth::user()->hasLikedPost($post)) {
            return back()->with('info', 'Cant like this post more than once');
        }

        $like = $post->likes()->create([
            'user_id' => Auth::user()->id
        ]);

        Auth::user()->likes()->save($like);

        return back()->with('info', 'post successfully liked');
    }
}
