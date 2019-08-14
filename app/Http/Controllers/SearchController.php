<?php

namespace App\Http\Controllers;
use App\User;
use DB; 
use Illuminate\Http\Request;

class SearchController extends Controller
{
        public function getResults(Request $request){
            $query = $request->input('query');

            
            if(!$query){
                return redirect()->route('dashboard');
            }

            $users = User::where(DB::raw("CONCAT(first_name ,' ' ,last_name)") , 'LIKE' , "%{$query}%")
                    ->orWhere('username' ,'LIKE', "%{$query}%")
                    ->get();

            Return view('main.search.results')->with('users' ,$users);
        }
}
