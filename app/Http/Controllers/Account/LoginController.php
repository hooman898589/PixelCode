<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Traits\LogActivete;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use LogActivete;
    public function create(){
        return view('account.login');
    }
    public function store(Request $request){

        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
// اعتبار سنجی کاربر
        if(Auth::attempt($validated)){

$request->session()->regenerate();
$this->logActivete('login',Auth::user());
return redirect('http://localhost:8000//');

        }else{
            return back()->withErrors(['unmessage'=>'کاربری با این نام و رمز پیدا نشد']);
        }
    }



}
