<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Spatie\Permission\Models\Permission;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::find(auth()->user()->id);
        if ($user->hasRole('admin')) {
            $roles = Role::all();
            return view('settings', ['roles' => $roles]);
        } else {
            return back()->with('error', 'You are not authorised!');
        }
    }

    public function general_settings()
    {
        $user = User::find(auth()->user()->id);
        if ($user->hasRole('admin')) {
            $roles = Role::all();
            return view('general_settings', ['roles' => $roles]);
        } else {
            return back()->with('error', 'You are not authorised!');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = User::find(auth()->user()->id);
        if ($user->hasRole('admin')) {
            $projects = Permission::where('name', 'like', '%projects%')->get()->sortBy('name');
            $tasks = Permission::where('name', 'like', '%tasks%')->get()->sortBy('name');
            $users = Permission::where('name', 'like', '%users%')->get()->sortBy('name');
            $clients = Permission::where('name', 'like', '%clients%')->get()->sortBy('name');
            return view('roles.create_role', ['projects' => $projects, 'tasks' => $tasks, 'users' => $users, 'clients' => $clients]);
        } else {
            return back()->with('error', 'You are not authorised!');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $formFields = $request->validate([
            'name' => ['required']
        ]);

        $formFields['guard'] = 'web';

        $role = Role::create($formFields);
        $role->permissions()->sync($request->input('permissions'));

        return redirect('/settings')->with('message', 'Role created Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find(auth()->user()->id);
        if ($user->hasRole('admin')) {
            $role = Role::find($id);
            return view('roles.edit_role', ['role' => $role]);
        } else {
            return back()->with('error', 'You are not authorised!');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $formFields = $request->validate([
            'name' => ['required']
        ]);

        $role = Role::find($id);
        $role->update($formFields);
        $role->permissions()->sync($request->input('permissions'));
        return back()->with('message', 'Permissions Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Role::find($id)->delete();
        return response()->json(['message' => 'Role deleted successfully!']);
    }
}
