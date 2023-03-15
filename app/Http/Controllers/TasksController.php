<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Request as FacadesRequest;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $tasks = Task::all();
        return view('tasks.tasks', ['tasks' => $tasks]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        if (auth()->user()->roles->first()->hasPermissionTo('create_tasks')) {
            $project = Project::find($id);
            return view('tasks.create_task', ['project' => $project]);
        }
        else {
            return back()->with('error', 'You are not Authorised!');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $formFields = $request->validate([
            'title' => ['required'],
            'status' => ['required'],
            'start_date' => ['required'],
            'due_date' => ['required'],
            'description' => ['required'],
        ]);

        $formFields['project_id'] = $id;
        $userIds = $request->input('user_id');

        $new_task = Task::create($formFields);
        $task_id = $new_task->id;
        $task = Task::find($task_id);
        $task->users()->attach($userIds);
        return redirect('/tasks')->with('message', 'Task created Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $task = Task::find($id);
        return view('tasks.task_information', ['task' => $task]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (auth()->user()->roles->first()->hasPermissionTo('edit_tasks')) {
            $task = Task::find($id);
            return view('tasks.update_task', ["task" => $task]);
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
            'title' => ['required'],
            'status' => ['required'],
            'start_date' => ['required'],
            'due_date' => ['required'],
            'description' => ['required'],
        ]);

        $userIds = $request->input('user_id');

        $task = Task::find($id);
        $task->update($formFields);
        $task->users()->sync($userIds);
        return redirect('/tasks')->with('message', 'Task updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (auth()->user()->roles->first()->hasPermissionTo('delete_tasks')) {
            Task::find($id)->delete();
            return response()->json(['message' => 'Task deleted successfully!']);
        } else {
            return back()->with('error', 'You are not authorised!');
        }
    }

    public function list()
    {
        $search = request('search');
        $sort = (request('sort')) ? request('sort') : "id";
        $order = (request('order')) ? request('order') : "DESC";

        $tasks = Task::when($search, function ($query) use ($search) {
            return $query->where('title', 'like', '%' . $search . '%')
                ->orWhere('status', 'like', '%' . $search . '%')
                ->orWhere('id', 'like', '%' . $search . '%');
        });

        $totaltasks = $tasks->count();

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
            "total" => $totaltasks,
        ]);
    }

    public function dragula()
    {
        $tasks = Task::all();
        return view('tasks.board_view', ['tasks' => $tasks]);
    }

    public function updateStatus($id, $newStatus)
    {
        $task = Task::find($id);
        $task->status = $newStatus;
        $task->save();

        return response()->json(['status' => 'success']);
    }
}
