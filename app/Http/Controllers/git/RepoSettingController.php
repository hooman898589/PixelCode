<?php

namespace App\Http\Controllers\git;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Repo;
use App\Models\token;
use App\Traits\LogActivete;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class RepoSettingController extends Controller
{
    use logActivete;
    public function branches($username , $repo)
    {
        $token=token::where('user_id',Auth::id())->first();
        if (!empty($token->token)) {
            $token = $token->token;
        }
        $url='https://api.github.com/repos/'.$username.'/'.$repo.'/branches';
        $repo=Repo::with('branches')->where('username',$username)->where('repo',$repo)->first();
        $bool=$repo->branches->isEmpty();
      

        if ($bool) {
            if (!empty($token)) {
                $auth = [
                    'Authorization' => 'Bearer ' . $token,
                    'Accept' => 'application/vnd.github+json',
                ];
            } else {
                $auth = [
                    'Accept' => 'application/vnd.github+json',
                ];
            }

            $branch_api = http::withHeaders($auth)->get($url);
            $branches = $branch_api->json();
            foreach ($branches as $branch) {

                $branchdb=Branch::create([
                    'repo_id' => $repo->id,
                    'name' => $branch['name'],
                    'sha' => $branch['commit']['sha'],

                ]);
                $this->logActivete('create',$branchdb);

            }
        }else {
            $branches = $repo->branches;
        }
        return view('git.setting_repo.branches.index',compact('branches'));

    }
}
