<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Friend;
use Auth;
use App\User;

class FriendController extends Controller
{

                public function friendRequest( Request $request ,  $id){


               $friend = new Friend();
            

                 $user_id = Auth::user()->id;
                 $status = 'pending';

            $friend = Friend::create([
                'user_id' => $user_id,
                'friend_id'=>$id,
                'status'=>$status,
           ]);

           if(!$friend){
               return back()->with('error' , 'unable to send a friend Request at the moment');
           }

           return redirect()->route('dashboard')->with('info' , 'friendRequest Sent');

     }
    

    public function getAccept($username)
    {



        $user = User::where('username', $username)->first();

        if (!$user) {
            redirect()->route('dashboard')->with('info', 'user cannnot be found');
        }
        if (!Auth::user()->hasFriendRequestRecieved($user)) {
            return redirect()
                ->route('dashboard');
        }

        Auth::user()->acceptFriendRequest($user);

        return redirect()->route('dashboard')->with('success', 'Friend Request Accepted');
    }


    public function declineRequest($username)
    {
        
        $user = User::where('username', $username)->first();

        if (!$user) {
            redirect()->route('dashboard')->with('info', 'user cannnot be found');
        }

        if (!Auth::user()->hasFriendRequestRecieved($user)) {
            return redirect()
                ->route('dashboard');
        }
        Auth::user()->declineFriendRequest($user);

        return redirect()->route('dashboard')->with('info', 'Friend Request Declined');
    }


    public function deleteFriend($username)

    {
                       
            
        $user = User::where('username', $username)->first();

        if (!$user) {
            redirect()->route('dashboard')->with('info', 'user cannot be found');
        }
            if (!Auth::user()->isFriendwith($user)) {
                return redirect()->route('dashboard');
            }

            Auth::user()->deleteFriend($user);

            return redirect()->route('dashboard')->with('info', 'Friend deleted ');
        
    }

    public function blockFriend($username)
    {

        $user = User::where('username', $username)->first();

        if (!$user) {
            redirect()->route('dashboard')->with('info', 'user cannot be found');
        }

        if (!Auth::user()->isFriendwith($user)) {
            return redirect()->route('dashboard');
        }

            Auth::user()->blockFriendExisting($user);
             return redirect()->route('profile' , ['username'=>$username])->with('info' , 'Friend Blocked sucessfully');

    }
}
