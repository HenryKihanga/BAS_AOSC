<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rough;

class RoughController extends Controller
{
    //
    public function index(Request $request)

    {
        $request->validate([
            'registrationNumber' => 'required',
            'registrationName' => 'required',
            'phoneNumber' => 'required',
            'email' => 'required',
            'address' => 'required',
        ]);

        return view('rough');
    }
}
