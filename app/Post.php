<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public $table = 'posts';


    protected $fillable = [
       'user_id','body' , 'image'
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }


  public function comments(){
      return $this->morphMany(Comment::class, 'commentable')->latest();
  }

  public function  likes(){
      return $this->morphMany(Like::class , 'likeable');
  }

}
