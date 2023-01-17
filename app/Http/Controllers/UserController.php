<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;

use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = User::all();
        $clients = Client::all();
        $projects = Project::latest()->paginate(5);
        $tasks = Task::latest()->paginate(5);
        return view('index', ['users' => $users, 'clients' => $clients, 'projects' => $projects, 'tasks' => $tasks]);

        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('register');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, User $user)
    {
        $formFields = $request->validate([
            'first_name' => ['required'],
            'last_name' => ['required'],
            'email' => ['required', 'email'],
            'password' => 'required|confirmed|min:6'
        ]);

        $formFields['password'] = bcrypt($formFields['password']);

        $user = User::create($formFields);

        auth()->login($user);

        return redirect('/')->with('message', 'Registered Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $users = User::latest()->paginate(5);

        return view('users.users', ['users' => $users]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('users.account', ['user' => $user]);
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
            'first_name' => ['required'],
            'last_name' => ['required'],
            'phone' => 'required',
            'role' => 'required',
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'country' => 'required',
            'zip' => 'required',
        ]);
        $user = User::find($id);

        $user->update($formFields);

        return back()->with('message', 'Profile details updated Successfully!');
    }

    public function update_photo(Request $request, $id)
    {
        if ($request->hasFile('upload')) {
            $formFields['photo'] = $request->file('upload')->store('photos', 'public');
            User::find($id)->update($formFields);
            return back()->with('message', 'Profile picture update Successfully!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();


        return redirect('/login');
    }

    public function logout(Request $request)
    {

        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }

    public function login()
    {
        return view('login');
    }

    public function authenticate(Request $request)
    {
        $formFields = $request->validate([
            'email' => ['required', 'email'],
            'password' => 'required'
        ]);

        if (auth()->attempt($formFields)) {
            $request->session()->regenerate();

            return redirect('/');
        }

        return back()->withErrors(['email' => 'Invalid credentials'])->onlyInput('email');
    }

    public function display($id)
    {
        $user = User::find($id);
        $projects = Project::where('user_id', 'like', '%'.$id.'%')->get();
        $tasks = Task::where('user_id', 'like', '%'.$id.'%')->get();
        return view('users.user_profile', ['user' => $user, 'projects' => $projects, 'tasks' => $tasks]);
    }
}
