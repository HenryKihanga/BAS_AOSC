<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rough;
class RoughController extends Controller
{
    //
    public function show_all_users(){
        $allUsers = Rough::all();
        return response(['allUser'=>$allUsers]);

    }

}
