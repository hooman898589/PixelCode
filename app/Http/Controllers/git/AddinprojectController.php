<?php

namespace App\Http\Controllers\git;

use App\Http\Controllers\Controller;
use App\Models\addinproject;
use App\Models\Repo;
use App\Models\User;
use App\Traits\LogActivete;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AddinprojectController extends Controller
{
    use LogActivete;
    public function create($repo)
    {

        return view('git.fixbugs.addinproject.create', compact('repo'));
    }
    public function store(Request $request, $repo)
    {
        $data = [];
        unset($data['_token']);
        $user = User::where('email', $request->email)->select('name', 'id', 'email')->first();

        if (!empty($user)) {
            $reposytory = Repo::where('slug', $repo)->firstOrFail();

            if (!empty($reposytory)) {
                $status = addinproject::where('project_id', $reposytory->id)->where('user_id', $user->id)->first();
//                dd($status);
                if (empty($status)) {

                    $data['user_id'] = $user->id;
                    $data['owner_id'] = Auth::id();

                    $newrepo=Repo::create([
                       'repo'=>$reposytory->repo,
                        'slug'=>$reposytory->slug,
                        'username'=>$reposytory->username,
                        'user_id'=>$user->id,
                    ]);
                    $this->logActivete('create',$newrepo);
                    $data['project_id'] = $newrepo->id;

                    $addinproject = addinproject::create($data);
                    $this->logActivete('create', $addinproject);
                    return redirect()->route('repo.add-in-project.index', ['repo' => $repo])->with('massage', 'باموفقیت ثبت شد');
                }else{
                    return back()->with('unmassage', 'کاربری با این نام قبلا ثبت شده');
                }

            }
        } else {
            return back()->with('unmassage', 'کاربری با این ایمیل پیدا نشد');
        }
    }
        public function index($repository)
    {
        $repo_name=Repo::where('slug', $repository)->get();
        foreach ($repo_name as $repo) {

            $addprojects_demo = addinproject::with(['useritems', 'owneritems', 'repoitems'])->where('project_id', $repo->id)->first();
            $addprojects[$repo->id] = $addprojects_demo;
            $addprojects[$repo->id]['useritems'] = $addprojects_demo->useritems;
            $addprojects[$repo->id]['owneritems']=$addprojects_demo->owneritems;
            $addprojects[$repo->id]['repoitems']=$addprojects_demo->repoitems;
        }


        return view('git.fixbugs.addinproject.index', compact('addprojects'));
    }



    public  function destroy($id)
    {
        $repo=addinproject::where('id', $id)->where('owner_id',Auth::id())->firstOrFail();
        $repo->delete();

        $repo->repoitems()->delete();

        $this->logActivete('delete',$repo);
        return back()->with('unmassage','با موفقیت حذف شد');

    }
}
