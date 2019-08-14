<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PasswordReset extends Model
{
    public $table = 'password_resets';

    protected $fillable = [
        'email', 'token'
    ];

    public static function createToken(String $email)
    {
        $reset_exist = self::where('email', $email)->first();

        if ($reset_exist) {
            return $reset_exist->token;
        }

        $reset = self::create([
            'email' => $email,
            'token' => str_random(6)
        ]);
        return $reset->token;
    }

    public static function confirmCode($token)
    {
        $reset = self::where('token', $token)->first();

        if (!$reset) {
            return null;
        }

        $email = $reset->email;
        $reset->delete();
        return $email;
    }
}
