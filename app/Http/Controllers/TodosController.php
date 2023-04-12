<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $priorityValues = [
            'low' => 1,
            'medium' => 2,
            'high' => 3,
        ];

        $id = auth()->user()->id;
        $todos = Todo::all()->where('user_id', $id);
        $todos = $todos->sortByDesc(function ($todo) use ($priorityValues) {
            return $priorityValues[$todo->priority];
        });
        return view('todos.list', ['todos' => $todos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('todos.create_todo');
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
            'priority' => ['required'],
            'description' => ['required'],
        ]);

        $formFields['user_id'] = auth()->user()->id;

        Todo::create($formFields);
        return redirect('/todos')->with('message', 'Todo created Successfully!');
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
        
        $todo = Todo::find($id);
        return view('todos.edit_todo', ['todo' => $todo]);
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
            'priority' => ['required'],
            'description' => ['required'],
        ]);

        $todo = Todo::find($id);
        $todo->update($formFields);
        return redirect('/todos')->with('message', 'Todo updated Successfully!');
    }

    public function update_checked(Request $request, $id)
{
    $todo = Todo::findOrFail($id);
    $todo->completed = $request->has('completed');
    $todo->save();
    return back();
}
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Todo::where('id', $id)->delete();
        return response()->json(['message' => 'Todo deleted successfully!']);
    }
}
