<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function view(){
        return view('user/profile');
    }

    public function viewAll(){

        
        return view('user/allUsers');
    }

    public function changePassword(){

        return view('user/changepassword');
    }
}
