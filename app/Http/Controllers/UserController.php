<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Project;
use App\Models\Task;
use App\Models\TaskUser;
use App\Models\User;
use Spatie\Permission\Models\Role;
use GuzzleHttp\Promise\TaskQueue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Contracts\Role as ContractsRole;

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
        $projects = Project::all();
        $tasks = Task::all();

        return view('index', ['users' => $users, 'clients' => $clients, 'projects' => $projects, 'tasks' => $tasks]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        return view('users.create_user', ['roles' => $roles]);
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
            'password' => 'required|confirmed|min:6',
            'address' => 'required',
            'phone' => 'required',
            'city' => 'required',
            'state' => 'required',
            'country' => 'required',
            'zip' => 'required',
        ]);

        $formFields['password'] = bcrypt($formFields['password']);

        if ($request->hasFile('photo')) {
            $formFields['photo'] = $request->file('photo')->store('photos', 'public');
        } else {
            $formFields['photo'] = "photos/no-image.png";
        }

        $user = User::create($formFields);

        $user->assignRole($request->input('role'));

        return redirect('/users/show')->with('message', 'User Registered Successfully!');
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
        $roles = Role::all();
        return view('users.account', ['user' => $user, 'roles' => $roles]);
    }

    public function edit_user($id)
    {
        if (auth()->user()->roles->first()->hasPermissionTo('edit_users')) {
            $user = User::find($id);
            $roles = Role::all();
            return view('users.edit_user', ['user' => $user, 'roles' => $roles]);
        } else {
            return back()->with('error', 'You are not Authorised!');
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
            'first_name' => ['required'],
            'last_name' => ['required'],
            'phone' => 'required',
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'country' => 'required',
            'zip' => 'required',
        ]);
        $user = User::find($id);

        $user->update($formFields);
        $user->syncRoles($request->input('role'));

        return back()->with('message', 'Profile details updated Successfully!');
    }

    public function update_user(Request $request, $id)
    {

        $formFields = $request->validate([
            'first_name' => ['required'],
            'last_name' => ['required'],
            'phone' => 'required',
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'country' => 'required',
            'zip' => 'required',
        ]);
        $user = User::find($id);

        if ($request->hasFile('upload')) {
            $old = User::find($id);
            Storage::disk('public')->delete($old->photo);
            $formFields['photo'] = $request->file('upload')->store('photos', 'public');
        }

        $user->update($formFields);
        $user->syncRoles($request->input('role'));

        return redirect('/users/show')->with('message', 'Profile details updated Successfully!');
    }

    public function update_photo(Request $request, $id)
    {


        if ($request->hasFile('upload')) {
            $old = User::find($id);
            Storage::disk('public')->delete($old->photo);
            $formFields['photo'] = $request->file('upload')->store('photos', 'public');
            User::find($id)->update($formFields);
            return back()->with('message', 'Profile picture updated Successfully!');
        } else {
            return back()->with('error', 'No Profile Picture Selected!');
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
        return redirect('/');
    }

    public function delete_user($id)
    {
        if (auth()->user()->roles->first()->hasPermissionTo('delete_users')) {
            User::find($id)->delete();
            return response()->json(['message' => 'User deleted Successfully!']);
        } else {
            return response()->json(['error' => 'You are not authorised!'], 404);
        }
    }

    public function logout(Request $request)
    {

        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function login()
    {
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        $formFields = $request->validate([
            'email' => ['required', 'email'],
            'password' => 'required'
        ]);

        if (auth()->attempt($formFields)) {
            $request->session()->regenerate();

            return redirect('/index');
        }

        return back()->withErrors(['email' => 'Invalid credentials'])->onlyInput('email');
    }

    public function display($id)
    {
        $user = User::find($id);
        return view('users.user_profile', ['user' => $user]);
    }

    public function list()
    {

        $search = request('search');
        $sort = (request('sort')) ? request('sort') : "id";
        $order = (request('order')) ? request('order') : "DESC";

        $users = User::when($search, function ($query) use ($search) {
            return $query->where('first_name', 'like', '%' . $search . '%')
                ->orWhere('last_name', 'like', '%' . $search . '%')
                ->orWhere('role', 'like', '%' . $search . '%')
                ->orWhere('id', 'like', '%' . $search . '%');
        });

        $totalusers = $users->count();

        $users = $users->orderBy($sort, $order)
            ->paginate(request("limit"))
            ->through(fn ($user) => [
                'id' => $user->id,
                'first_name' => $user->first_name,
                'last_name' => $user->last_name,
                'role' => "<span class='badge bg-label-" . (isset(config('taskhub.role_labels')[$user->getRoleNames()->first()]) ? config('taskhub.role_labels')[$user->getRoleNames()->first()] : config('taskhub.role_labels')['default']) . " me-1'>" . $user->getRoleNames()->first() . "</span>",
                'email' => $user->email,
                'phone' => $user->phone,
                'photo' => "<div class='avatar avatar-md pull-up' title='" . $user->first_name . " " . $user->last_name . "'>
                    <a href='/users/profile/show/" . $user->id . "'>
                    <img src='" . asset('storage/' . $user->photo) . "' alt='Avatar' class='rounded-circle'/>
                    </a>
                    </div>",
                'tasks' => count($user->tasks),
                'projects' => count($user->projects)
            ]);

        return response()->json([
            "rows" => $users->items(),
            "total" => $totalusers,
        ]);
    }


    public function task_list($user_id)
    {

        $search = request('search');
        $sort = (request('sort')) ? request('sort') : "tasks.id";
        $order = (request('order')) ? request('order') : "DESC";

        $tasks = User::find($user_id)->tasks();
        if ($search) {
            $tasks = $tasks->where(function ($query) use ($search) {
                $query->where('tasks.title', 'like', '%' . $search . '%')
                    ->orWhere('tasks.status', 'like', '%' . $search . '%');
            });
        }

        $totalTasks = $tasks->count();

        $tasks = $tasks->orderBy($sort, $order)
            ->paginate(request("limit"))
            ->through(
                fn ($task) => [
                    'id' => $task->id,
                    'title' => "<a href='/tasks/information/" . $task->id . "'><strong>" . $task->title . "</strong></a>",
                    'project' => "<a href='/projects/information/" . $task->project->id . "'><strong>" . $task->project->title . "</strong></a>",
                    'users' => $task->users,
                    'clients' => $task->project->clients,
                    'status' => "<span class='badge bg-label-" . config('taskhub.task_status_labels')[$task->status] . " me-1'>" . $task->status . "</span>",
                ]
            );


        foreach ($tasks->items() as $task => $collection) {
            foreach ($collection['clients'] as $i => $client) {
                $collection['clients'][$i] = "<li class='avatar avatar-sm pull-up'  title='" . $client['first_name'] . " " . $client['last_name'] . "'>
                    <img src='" . asset('storage/' . $client['profile']) . "' alt='Avatar' class='rounded-circle' />
                </li>";
            };
        }

        foreach ($tasks->items() as $task => $collection) {
            foreach ($collection['users'] as $i => $user) {
                $collection['users'][$i] = "<li class='avatar avatar-sm pull-up'  title='" . $user['first_name'] . " " . $user['last_name'] . "'>
                    <img src='" . asset('storage/' . $user['photo']) . "' alt='" . $user['first_name'] . " " . $user['last_name'] . "' class='rounded-circle' />
                </li>";
            };
        }



        return response()->json([
            "rows" => $tasks->items(),
            "total" => $totalTasks,
        ]);
    }





    public function project_list($user_id)
    {

        $search = request('search');
        $sort = (request('sort')) ? request('sort') : "projects.id";
        $order = (request('order')) ? request('order') : "DESC";

        $projects = User::find($user_id)->projects();
        if ($search) {
            $projects = $projects->where(function ($query) use ($search) {
                $query->where('projects.title', 'like', '%' . $search . '%')
                    ->orWhere('projects.status', 'like', '%' . $search . '%');
            });
        }

        $totalprojects = $projects->count();

        $projects = $projects->orderBy($sort, $order)
            ->paginate(request("limit"))
            ->through(
                fn ($project) => [
                    'id' => $project->id,
                    'title' => "<a href='/projects/information/" . $project->id . "'><strong>" . $project->title . "</strong></a>",
                    'users' => $project->users,
                    'clients' => $project->clients,
                    'status' => "<span class='badge bg-label-" . $project->status->color . " me-1'>" . $project->status->title . "</span>",
                ]
            );


        foreach ($projects->items() as $project => $collection) {
            foreach ($collection['clients'] as $i => $client) {
                $collection['clients'][$i] = "<li class='avatar avatar-sm pull-up'  title='" . $client['first_name'] . " " . $client['last_name'] . "'>
                    <img src='" . asset('storage/' . $client['profile']) . "' alt='Avatar' class='rounded-circle' />
                </li>";
            };
        }

        foreach ($projects->items() as $project => $collection) {
            foreach ($collection['users'] as $i => $user) {
                $collection['users'][$i] = "<li class='avatar avatar-sm pull-up'  title='" . $user['first_name'] . " " . $user['last_name'] . "'>
                    <img src='" . asset('storage/' . $user['photo']) . "' alt='" . $user['first_name'] . " " . $user['last_name'] . "' class='rounded-circle' />
                </li>";
            };
        }



        return response()->json([
            "rows" => $projects->items(),
            "total" => $totalprojects,
        ]);
    }
}
