<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EditprofilekController extends Controller
{
       public function index()
    {
        $user = [
            'name' => 'Marisa D',
            'email' => 'marisaD@gmail.com',
            'phone' => '+62 8324858351',
        ];

        return view('index', compact('user'));
    }

}