<?php

namespace App\Http\Controllers\git;

use App\Http\Controllers\Controller;
use App\Models\token;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TokenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $token = token::with('useritem')->where('user_id', Auth::id())->first();



        return view('git.token.index', compact('token'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    return view('git.token.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'token' => 'required|unique:tokens,token',

        ]);
        $data=$request->all();
        $data['user_id']=Auth::id();
        $anytoken=token::where('user_id',Auth::id())->first();
        if (empty($anytoken)) {
            $token = token::create($data);
            return redirect()->route('repo.token.index')->with('massage', 'با موفقیت ثبت شد');
        }else{
            return back()->with('unmassage','هر کاربر فقط اجازه استفاده از یک api توکن را دارد');
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $token=token::find($id);
        $token->delete();
        return back()->with('unmassage','توکن با موفقیت حذف شد');
    }
}
