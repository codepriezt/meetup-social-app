<?php

namespace App\Http\Controllers\Main;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Friend;
use Auth;
use App\Post;

class PageController extends Controller
{
    public function dashboard(){
        $request = Auth::user()->friendRequest();
        $friends = Auth::user()->friends();
        if(Auth::check()){
            $post = Post::where(function($query){
                return $query->where('user_id', Auth::user()->id)
                ->orWhereIn('user_id',Auth::user()->friends()->pluck('id'));      
        })
         ->orderBy('created_at','desc')
         ->limit(7)->get(); 
        }
        $not_friends = User::where('status', 'active')->limit(7)->get();
        return view('main.home.index' , ['friends'=> $friends , 'post'=>$post,'request'=>$request, 'not_friends'=>$not_friends ]);
    }

    public function profile($username){
        $user = User::where('username' ,$username)->first();
            if(!$user){
                abort(404);
            }

        $friends = $user->friends();
        

        return view('main.profile.index')
        ->with('user' ,$user )
        ->with('friends' ,$friends);
        

    }
    public function users(){
        $not_friends = User::where('status', 'active')->get();
        return view('main.users.index', ['not_friends'=>$not_friends] );
    }

     
        public function userSetting(){
            return view ('main.users.user-setting');
        }


        public function messaging(){
            return view('main.message.index');
        }

        public function singlePost($id){
            $post = Post::findOrFail($id);
            return view('main.post.index', ['post'=>$post]);
        }
}
