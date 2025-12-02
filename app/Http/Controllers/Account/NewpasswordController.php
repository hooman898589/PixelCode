<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Jobs\Account;
use App\Mail\Newpassword;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Queue\Middleware\RateLimited;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;


class NewpasswordController extends Controller
{
    public function index(){
        return view('account.newpassword');
    }
    public function password(Request $request)
    {
        if (!empty($request->token)) {
            $token = $request->token;
            return view('account.changepass', compact('token'));
        }
        else {
            echo 'wait';
        }
    }
    public function newpassword(Request $request){
$key=$request->ip();

if (RateLimiter::tooManyAttempts($key, 5)) {
    return back()->withErrors(['unmassage'=>'نعداد دفعات ثبت ']);
}
        RateLimiter::hit($key, 60);

         $validate= $request->validate([
            'email' => 'required',
        ]);

         $user=User::where('email', $validate['email'])->Orwhere('name',$validate['email'])->first();
         if(!empty($user)){

             $token = Str::random(64);
             $token_hashed=hash('sha256', $token);
              Account::dispatch($token,$user);


             DB::table('password_reset_tokens')->where('email', $user->email)->delete();
    DB::table('password_reset_tokens')->insert([
        'email' => $user->email,
        'token' => $token_hashed,
        'created_at' => now(),

]);
              return redirect()->route('password');


         }else{
                return redirect()->back()->with(['unmessage'=>'کاربری با این ایمیل , نام  پیدا نشد']);
         }



    }


    public function changepassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'password' => 'required|min:8',
            'com_password' => 'required|same:password',
        ]);

        $hashedToken = hash('sha256', $request->token);


        $record = DB::table('password_reset_tokens')->where('token', $hashedToken)->first();

        // اگر توکن درست نبود
        if (empty($record)) {
            return back()->withErrors(['token' => 'توکن نامعتبر یا منقضی شده است']);
        }

        // پیدا کردن کاربر
        $user = User::where('email', $record->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'کاربر یافت نشد']);
        }

        // ذخیره رمز جدید
        $user->password = $request->password;
        $user->save();

        // پاک کردن توکن
        DB::table('password_reset_tokens')->where('email', $user->email)->delete();

        // لاگین اتوماتیک با Session Auth

        return redirect()->route('login')->with('message', 'رمز عبور با موفقیت تغییر یافت');

    }

}
