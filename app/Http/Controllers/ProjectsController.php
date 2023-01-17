<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
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
        $projects = Project::latest()->paginate(5);
        $users = User::all();
        $clients = Client::all();
        return view('projects.projects', ['projects' => $projects, 'users' => $users, 'clients' => $clients]);
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
        
        return view('projects.create_project', ['users'=>$users, 'clients'=>$clients]);
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

        
        $formFields['user_id']=implode(',',$request->input('user_id'));
        $formFields['client_id']=implode(',',$request->input('client_id'));
        
        Project::create($formFields);
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
        $project = Project::find($id);
        $tasks = Task::where('project_id', '=', $id)->get();
        return view('projects.project_information', ['project' => $project, 'tasks' => $tasks]);
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
            'user_id' => 'required',
            'client_id' => 'required'
        ]);

        
        $formFields['user_id']=implode(',',$request->input('user_id'));
        $formFields['client_id']=implode(',',$request->input('client_id'));

        $project = Project::find($id);
        $project->update($formFields);

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
}
