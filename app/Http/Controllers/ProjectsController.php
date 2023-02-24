<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Project;
use App\Models\Task;
use App\Models\ProjectUser;
use App\Models\ProjectClient;
use App\Models\User;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;

class ProjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $projects = Project::latest()->paginate(6);

        return view('projects.grid_view', ['projects' => $projects]);
        
    }

    public function list_view()
    {
        $projects = Project::all();

        return view('projects.projects', ['projects' => $projects]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        $clients = Client::all();

        return view('projects.create_project', ['users' => $users, 'clients' => $clients]);
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
            'title' => ['required'],
            'status' => ['required'],
            'budget' => ['required'],
            'start_date' => ['required'],
            'end_date' => ['required'],
            'description' => ['required'],
        ]);


        $userIds = $request->input('user_id');
        $clientIds = $request->input('client_id');

        $new_project = Project::create($formFields);
        $project_id = $new_project->id;
        $project = Project::find($project_id);
        $project->users()->attach($userIds);
        $project->clients()->attach($clientIds);

        return redirect('/projects')->with('message', 'Project created Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $project = Project::find($id);;
        return view('projects.project_information', ['project' => $project]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $project = Project::find($id);
        $users = User::all();
        $clients = Client::all();

        return view('projects.update_project', ["project" => $project, "users" => $users, "clients" => $clients]);
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
            'title' => ['required'],
            'status' => ['required'],
            'budget' => ['required'],
            'start_date' => ['required'],
            'end_date' => ['required'],
            'description' => ['required'],
        ]);

        $userIds = $request->input('user_id');
        $clientIds = $request->input('client_id');

        $project = Project::find($id);
        $project->update($formFields);
        $project->users()->sync($userIds);
        $project->clients()->sync($clientIds);

        return redirect('/projects')->with('message', 'Project updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Project::find($id)->delete();
        return back()->with('message', 'Project deleted Successfully!');
    }


    public function list()
    {
        $search = request('search');
        $sort = (request('sort')) ? request('sort') : "id";
        $order = (request('order')) ? request('order') : "DESC";

        $projects = Project::when($search, function ($query) use ($search) {
            return $query->where('title', 'like', '%' . $search . '%')
                ->orWhere('status', 'like', '%' . $search . '%')
                ->orWhere('id', 'like', '%' . $search . '%');
        });

        $totalprojects = $projects->count();

        $projects = $projects->orderBy($sort, $order)
            ->paginate(request("limit"))
            ->through(
                fn ($project) => [
                    'id' => $project->id,
                    'title' => "<a href='/projects/information/" . $project->id . "'><strong>" . $project->title . "</strong></a>",
                    'users' => $project->users,
                    'clients' => $project->clients,
                    'status' => "<span class='badge bg-label-" . config('taskhub.project_status_labels')[$project->status] . " me-1'>" . $project->status . "</span>",
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



    public function task_list($project_id)
    {

        $search = request('search');
        $sort = (request('sort')) ? request('sort') : "tasks.id";
        $order = (request('order')) ? request('order') : "DESC";

        $tasks = Project::find($project_id)->tasks();
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

    public function taskBoard($id) {
        $project = Project::find($id);
        $tasks = $project->tasks;
        return view('projects.task_board', ['project'=>$project, 'tasks'=>$tasks]);
    }

    public function taskList($id) {
        $project = Project::find($id);
        return view('projects.task_list', ['project'=>$project]);
    }
}
