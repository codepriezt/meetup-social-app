<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    

    use Notifiable;

            public $table = 'messages';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'message'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
