<?php

namespace App\Http\Controllers;

use App\Utilities\Country;
use Illuminate\Http\Request;
use App\Http\Requests\GetPostRequest;
use App\User;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Services\RedditHelper;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{
    public function account_view()
    {
        $user =  Auth::user();
        $info = [
            'name' => $user->name,
            'reddit_name' => $user->reddit_username,
            'email' => $user->email,
            'country' => $user->country,
        ];
        return view('user.account',$info);
    }
    public function country_update(GetPostRequest $request){
        $user= User::find(Auth::user()->id);
        $user->country = $request->input('value');
        $user->save();
        return $user->country;
    }
    public function name_update(GetPostRequest $request){
        $user= User::find(Auth::user()->id);
        $user->name = $request->input('value');
        $user->save();
        return $user->name;
    }
    public function get_countries(Country $country){
        return $country->all();
    }
    public function update_pass(GetPostRequest $request){
        $user = User::find(Auth::user()->id);
        $old_pass = $request->input('old_pass');
        if($request->input('new_pass') === $request->input('confirm_pass')){
            if (Hash::check($old_pass, $user->password)) {
                $user->password = bcrypt($request->input('new_pass'));
                $user->save();
                return 'success';
            }
            else{
                return array('error'=>'Wrong password!');
            }
        }
    }
}
