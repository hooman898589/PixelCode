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
        $repodb=Repo::with('branches')->where('username',$username)->where('repo',$repo)->first();
        $bool=$repodb->branches->isEmpty();


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
                    'repo_id' => $repodb->id,
                    'name' => $branch['name'],
                    'sha' => $branch['commit']['sha'],

                ]);
                $this->logActivete('create',$branchdb);


            }
        }else {

            $branches = $repodb->branches;

        }

        return view('git.setting_repo.branches.index',compact('branches','username','repo'));

    }





    public function commits($username , $repo,$branch)
    {
        $page=request()->get('page',1);

        $token=token::where('user_id',Auth::id())->first();
        if (!empty($token->token)) {
            $token = $token->token;
        }
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

        $url='https://api.github.com/repos/'.$username.'/'.$repo.'/commits?sha='.$branch.'&page='.$page.'&per_page=20';


        $commits_api = http::withHeaders($auth)->get($url);
        $commits = $commits_api->json();


        return view('git.setting_repo.commits.commits',compact('commits','username','repo','page','branch'));



    }





    public function files($sha,$username , $repo,$branch)
    {
        $token=token::where('user_id',Auth::id())->first();
        if (!empty($token->token)) {
            $token = $token->token;
        }
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
        $url='https://api.github.com/repos/'.$username.'/'.$repo.'/commits/'.$sha;
$codes_api = http::withHeaders($auth)->get($url);
$codes = $codes_api->json();

return view('git.setting_repo.codes.codes',compact('codes','username','repo','branch'));

    }


    public function code($username , $repo,$branch)
    {
        $path=request()->get('filename');
        $token=token::where('user_id',Auth::id())->first();
        if (!empty($token->token)) {
            $token = $token->token;
        }
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
        $url='https://api.github.com/repos/'.$username.'/'.$repo.'/contents/'.$path;
        $codes_api = http::withHeaders($auth)->get($url,[
            'ref'=>$branch,
        ]);
        $codes = $codes_api->json();
        $content=base64_decode($codes['content']);

        return view('git.setting_repo.content.content',compact('content','repo','branch'));


    }
}
