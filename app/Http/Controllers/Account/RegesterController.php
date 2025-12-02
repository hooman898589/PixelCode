<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class RegesterController extends Controller
{
    public function create(){
        return view('account.register');
    }

    public function store(Request $request){
        $valiate = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email|email',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
        ]);

        User::create(
            $request->only('name', 'email', 'password')
        );
    }

}
