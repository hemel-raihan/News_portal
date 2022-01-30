<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\support\Facades\Gate;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('app.users.self');
        $users = User::all();
        $auth = Auth::guard('admin')->user();
        return view('backend.admin.users.index',compact('users','auth'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('app.users.create');
        $roles = Role::all();
        $auth = Auth::user();
        Artisan::call('cache:clear');
        return view('backend.admin.users.form',compact('roles','auth'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Gate::authorize('app.users.create');
        $this->validate($request,[
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users|max:255',
            'role_id' => 'required',
            'password' => 'required|confirmed|string|min:6',
        ]);

        $user = User::create([
            'role_id' => $request->role_id,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Artisan::call('cache:clear');
        notify()->success("User added succefully");
        return redirect()->route('admin.users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        Gate::authorize('app.users.edit');
        $roles = Role::all();
        Artisan::call('cache:clear');
        return view('backend.admin.users.form',compact('roles','user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        Gate::authorize('app.users.edit');
        $this->validate($request,[
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'role_id' => 'required',
            'password' => 'nullable|confirmed|string|min:6',
        ]);

        $user->update([
            'role_id' => $request->role_id,
            'name' => $request->name,
            'email' => $request->email,
            'password' => isset($request->password) ? Hash::make($request->password) : $user->password
        ]);

        Artisan::call('cache:clear');
        notify()->success("user Updated Successfully");
        return redirect()->route('admin.users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //Gate::authorize('app.users.destroy');
        $user->delete();
        Artisan::call('cache:clear');
        notify()->success("User Delete Succefully");
        return back();
    }
}
