<?php

namespace App\Http\Controllers\git;

use App\Http\Controllers\Controller;
use App\Models\token;
use Illuminate\Support\Facades\Auth;

class RepoSettingController extends Controller
{
    public function branches($username , $repo)
    {
        $token=token::where('user_id',Auth::id())->first();

        var_dump($token);
    }
}
