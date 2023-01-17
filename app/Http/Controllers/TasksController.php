<?php

namespace App\Http\Controllers;
use App\Models\Client;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::latest()->paginate(5);
        $projects = Project::all();
        $users = User::all();
        $clients = Client::all();
        return view('tasks.tasks',['tasks' => $tasks, 'projects' => $projects, 'users' => $users, 'clients' => $clients]);
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
        $projects = Project::all();
        
        return view('tasks.create_task', ['users' => $users, 'clients' => $clients, 'projects' => $projects]);
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
            'project_id' => ['required'],
            'start_date' => ['required'],
            'due_date' => ['required'],
            'description' => ['required'],
        ]);

        
        $formFields['user_id']=implode(',',$request->input('user_id'));
        
        Task::create($formFields);
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
        $task = Task::find($id);
        $projects = Project::all();
        $users = User::all();
        $clients = Client::all();

        return view('tasks.update_task', ["projects" => $projects, "users" => $users, "clients" => $clients, "task" => $task]);
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
            'project_id' => ['required'],
            'start_date' => ['required'],
            'due_date' => ['required'],
            'description' => ['required'],
        ]);

        
        $formFields['user_id']=implode(',',$request->input('user_id'));
        
        $task = Task::find($id);
        $task->update($formFields);
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
        Task::find($id)->delete();
        return back()->with('message', 'Task deleted Successfully!');
    }
}
