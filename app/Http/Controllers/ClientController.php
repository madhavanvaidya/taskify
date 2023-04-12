<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request as FacadesRequest;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Project;
use App\Models\Task;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::all();
        return view('clients.clients', ['clients' => $clients]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (auth()->user()->roles->first()->hasPermissionTo('create_clients')) {
            return view('clients.create_client');
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
    public function store(Request $request)
    {
        $formFields = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'company' => 'required',
            'email' => ['required', 'email'],
            'phone' => 'required',
            'password' => 'required|confirmed|min:6',
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'country' => 'required',
            'zip' => 'required',
        ]);

        $formFields['password'] = bcrypt($formFields['password']);

        if ($request->hasFile('profile')) {
            $formFields['profile'] = $request->file('profile')->store('photos', 'public');
        }


        Client::create($formFields);

        return redirect('/clients/show')->with('message', 'Client added Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $client = Client::find($id);
        return view('clients.client_profile', ['client' => $client]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (auth()->user()->roles->first()->hasPermissionTo('edit_clients')) {
            $client = Client::find($id);
            return view('clients.update_client')->with('client', $client);
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
            'first_name' => 'required',
            'last_name' => 'required',
            'company' => 'required',
            'phone' => 'required',
            'email' => ['required', 'email'],
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'country' => 'required',
            'zip' => 'required',
        ]);
        $client = Client::find($id);

        $client->update($formFields);

        return redirect('/clients/show')->with('message', 'Client details updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (auth()->user()->roles->first()->hasPermissionTo('delete_clients')) {
            Client::find($id)->delete();
            return response()->json(['message' => 'Client deleted Successfully!']);
        } else {
            return back()->with('error', 'You are not Authorised!');
        }
    }



    public function list()
    {
        $search = request('search');
        $sort = (request('sort')) ? request('sort') : "id";
        $order = (request('order')) ? request('order') : "DESC";

        $clients = Client::when($search, function ($query) use ($search) {
            return $query->where('first_name', 'like', '%' . $search . '%')
                ->orWhere('last_name', 'like', '%' . $search . '%')
                ->orWhere('company', 'like', '%' . $search . '%')
                ->orWhere('id', 'like', '%' . $search . '%');
        });

        $totalclients = $clients->count();

        $clients = $clients->orderBy($sort, $order)
            ->paginate(request("limit"))

            // ->withQueryString()
            ->through(fn ($client) => [
                'id' => $client->id,
                'first_name' => $client->first_name,
                'last_name' => $client->last_name,
                'company' => $client->company,
                'email' => $client->email,
                'phone' => $client->phone,
                'profile' => "<div class='avatar avatar-md pull-up' title='" . $client->first_name . " " . $client->last_name . "'>
                                <a href='/clients/profile/show/" . $client->id . "'>
                                <img src='" . asset('storage/' . $client->profile) . "' alt='Avatar' class='rounded-circle'/>
                                </a>
                                </div>",
                'projects' => count($client->projects)
            ]);

        return response()->json([
            "rows" => $clients->items(),
            "total" => $totalclients,
        ]);
    }


    public function project_list($client_id)
    {

        $search = request('search');
        $sort = (request('sort')) ? request('sort') : "projects.id";
        $order = (request('order')) ? request('order') : "DESC";

        $projects = Client::find($client_id)->projects();
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
