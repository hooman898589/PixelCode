<?php

namespace App\Http\Controllers\git;

use App\Http\Controllers\Controller;
use App\Models\Repo;
use App\Traits\LogActivete;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RepoController extends Controller
{
    use LogActivete;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $repos=Repo::where('user_id', Auth::id())->get();

        return view('git.repo.index', compact('repos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('git.repo.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data=$request->all();
        $validatedData = $request->validate([
            'username' => 'required',
            'repo' => 'required|max:100',

        ]);
        $data['user_id']=Auth::id();
        $repo = Repo::create($data);

        $this->logActivete('create',$repo);

        return redirect()->route('repo.index')->with('massage', 'ریپازیتوری با موفقیت ثبت شد');


    }

    /**
     * Display the specified resource.
     */


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $repo=Repo::find($id);
        return view('git.repo.edit', compact('repo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data=$request->all();
        $data['user_id']=Auth::id();
        $repo=Repo::findorfail($id);
        $validatedData = $request->validate([
            'username' => 'required',
            'repo' => 'required|max:100',
        ]);

        $repo->update($data);
        $repo->save();

        $this->logActivete('update',$repo);

        return redirect()->route('repo.index')->with('massage','ریپازیتوری باموفقیت اپدیت شد');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $repo=Repo::find($id);
        $repo->delete();
        $this->logActivete('delete',$repo);

        return back()->with('unmassage',"ریپازیتوری با موفقیت حذف شد");
    }
}
