<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use Auth;
use App\Mail\PasswordResetToken;
use App\PasswordReset;
use App\Mail\Activationmail;
use Mail;


class UserController extends Controller
{
    public function register(Request $request){
        $data =$request->all();
        $data['password']= bcrypt($data['password']);

        $this->validate($request,[
            'first_name'=>'required',
            'last_name' =>'required' ,
            'username' => 'required',      
            'email' => 'required|unique:users,email',
            'password' => 'required',
        ]);

        $user = User::create([
                'first_name'=>$data['first_name'],
                'last_name'=> $data['last_name'],
                'username'=>$data['username'],
                'email'=>$data['email'],
                'password'=>$data['password'], 
        ]);

        if(!$user){
           return back()->with('error', 'User registeration not completed');
        }
         if($user){
         return redirect()->route('loginPage')->with('success' , 'User sucessfully created Login now ');

        }
        
    }

    public function login(Request $request){
        
            $this->validate($request,[
                'username'=>'required|exists:users,username',
                'password'=>'required'
            ]);

                $Auth_valid = Auth::attempt(['username'=>$request->username, 'password'=>$request->password , 'status'=>'active']);
                
                if(!$Auth_valid){
                    return back()->with('login-error' , 'invalid credentials, please check yourself') ;  
                }
                     return redirect()->route('dashboard')->with('success' ,'User successfully logged in ');
    }

        public function forgetPassword(Request $request){
                $this->validate($request ,[
                    'email'=>'required|exists:users,email',
                ]);

                $email = $request->email;

                $token = PasswordReset::createToken($email);

                //send Email

                Mail::to($email)->send(new PasswordResetToken($token));

                return redirect()->route('loginPage')->with('success','Password reset instruction has been sent to you email,
                 please check');
        }

                public function resetPassword(Request $request){
                    $this->validate($request,[
                        'password'=>'required',
                        'confirm_password'=>'required|same:password'
                    ]);
                        $token = $request->reset_token;
                        $user_email = PasswordReset::confirmcode($token);

                     if($user_email){
                        // 404 page...
                        dd('error');
                        return;
                    }
                    User::changePassword([
                        'email'=>$user_email,
                        'password'=>$request->password
                    ]);

                    return redirect()->route('loginPage')->with('success','Password reset, you can login now');
                }


                    public function changePassword(Request $request)
                    {

                      
                        $this->validate($request, [
                            'old_password' => 'required',
                            'new_password' => 'required|confirmed',
                            'repeat_password' => 'required',
                        ]);

                        $user = User::find(Auth::user()->id);

                        if (!Hash::check($request->old_password, $user->password)) {
                            return redirect()->route('dashboard')->with('error', 'Invalid Old Password');
                        }
                        $updated = $user->update([
                            'password' => Hash::make($request->new_password)
                        ]);
                        if (!$updated) {
                            return redirect()->route('dashboard')->with('error', 'Unable to complete at the moment try again');
                        }
                        return redirect()->route('dashboard')->with('info', 'Password changed successfully');
                    }


                    
                    public function logout()
                    {
                        Auth::logout();
                        return redirect()->route('loginPage');
                    }
}
