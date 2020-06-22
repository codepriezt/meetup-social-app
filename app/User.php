<?php

namespace App;

use App\Post;
use App\Comment;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use Notifiable;

    public $table = 'users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'username', 'email', 'password', 'photo'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function is($type)
    {
        return $this->type == $type ? true : false;
    }



    public static function changePassword($data)
    {
        self::where('email', $data['email'])->update(
            [
                'password' => Hash::make($data['password'])
            ]
        );
    }

    public function getFullName()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public  function getfullNameOrUsername()
    {
        return $this->getFullName() ?: $this->username;
    }

    public function username()
    {

        return $this->username();
    }

    public function post()
    {
        return $this->hasMany('App\Post', 'user_id');
    }

    public function hasLikedPost(Post $post)
    {
        return (bool) $post->likes->where('user_id', $this->id)->count();
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function likes()
    {
        return $this->hasMany('App\Like', 'user_id');
    }

    public function friends()
    {
        return $this->friendsOfMine()->wherePivot('status', 'confirmed')->get()
            ->merge($this->friendOf()->wherePivot('status', 'confirmed')->get());
    }

    public function not_friends()
    {
        return $this->friendsOfMine()->wherePivot('status', 'inactive')->get()->merge($this->friendOf()->wherePivot('status', 'inactive')->get());
    }


    function friendsOfMine()
    {
        return $this->belongsToMany('App\User', 'friends', 'user_id', 'friend_id');
    }
    //Ffriend that i was invited to
    function friendOf()
    {
        return $this->belongsToMany('App\User', 'friends', 'friend_id', 'user_id');
    }


    // friend request , accepting and declining 
    public function friendRequest()
    {
        return $this->friendOf()->wherePivot('status', 'pending')->get();
    }


    public function friendRequestPending()
    {
        return $this->friendsOfMine()->wherePivot('status', 'pending')->get();
    }


    public function hasFriendRequestPending(User $user)
    {
        return (bool) $this->friendRequestPending()->where('id', $user->id)->count();
    }

    public function hasFriendRequestRecieved(User $user)
    {
        return (bool)  $this->friendRequest()->where('id', $user->id)->count();
    }


    public function addFriend(User $user)
    {
        $this->friendOf()->attach($user->id);
    }

    public function acceptFriendRequest(User $user)
    {
        return $this->friendRequest()->where('id', $user->id)->first()->pivot->update([
            'status' => 'confirmed'
        ]);
    }


    public function declineFriendRequest(User $user)
    {
        return  $this->friendRequest()->where('id', $user->id)->first()->pivot->update([
            'status' => 'inactive'
        ]);
    }




    public  function isFriendwith(User $user)
    {
        return (bool) $this->friends()->where('id', $user->id)->count();
    }


    //deletind friend 

    public function deleteFriend(User $user)
    {
        $this->friendOf()->detach($user);
        $this->friendsOfMine()->detach($user->id);
    }


    //blocking relationship

    public function blockfriend()
    {
        return $this->friendsOfMine()->wherePivot('status', 'confirmed')->get()->merge($this->friendOf()->wherePivot('status', 'confirmed')->get());
    }



    public function blockFriendExisting(User $user)
    {
        return $this->blockfriend()->where('id', $user->id)->first()->pivot->update([
            'status' => 'blocked'
        ]);
    }


    // public function blocked_friends()
    // {
    //     return $this->belongsToMany(User::class, 'friends', 'user_id', 'friend_id')
    //         ->wherePivot('status', '=', 'blocked');
    // }      
    // // friend that this user started but now blocked
    // protected function friendOfUserBlocked()
    // {
    //     return $this->belongsTomany(User::class, 'friends', 'user_id', 'friend_id')
    //         ->wherePivot('status', '=', 'blocked');

    // }

    // //friend that user was invited but now blocked 
    // protected  function thisUserFriendBlocked()
    // {
    //     return $this->belongsToMany(User::class, 'friends', 'user_id', 'friend_id')
    //         ->wherePivot('status', '=', 'blocked');

    // }

    // //accessor allowing to call the $user->blocked_friends
    // public function getBlockedFriendsAttribute()
    // {
    //     if (!array_key_exists('blocked_friends', $this->relations)) $this->loadBlockedFriends();
    //     return $this->getRealation('blocked_friends');
    // }

    // protected function loadBlockedFriends()
    // {
    //     if (!array_key_exists('blocked_friends', $this->relations)) {
    //         $friends = $this->mergeBlockedFriends();
    //         $this->setRelation('blocked_friends', $friends);
    //     }
    // }

    // protected function mergeBlockedFriends()
    // {
    //     if ($temp = $this->friendsOfUserBlocked)
    //         return $temp->merge($this->thisUserFriendsBlocked);
    //     else
    //         return $this->thisUserfriendOfBlocked;
    // }





}
