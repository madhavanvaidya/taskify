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
        return view('clients.create_client');
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
        $client = Client::find($id);

        return view('clients.update_client')->with('client', $client);
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
        Client::find($id)->delete();


        return back()->with('message', 'Client deleted Successfully!');
    }



    public function list()
    {
        $clients = Client::query()
                ->when(FacadesRequest::input("search"), function ($query, $search) {
                    $query->where("first_name", "like", "%{$search}%")
                        ->orWhere("last_name", "like", "%{$search}%")
                        ->orWhere("role", "like", "%{$search}%")
                        ->orWhere("id", "like", "%{$search}%");
                })
                ->when(request("sort"), function ($query, $field) {
                    $query->orderBy($field, (request("order")));
                })
                // ->get();
                ->latest()
                ->paginate(request("limit"))

            // ->withQueryString()
            ->through(fn ($client) => [
                'id' => $client->id,
                'first_name' => $client->first_name,
                'last_name' => $client->last_name,
                'company' => $client->company,
                'email' => $client->email,
                'phone' => $client->phone,
                'profile' => "<div class='avatar avatar-md pull-up' title='".$client->first_name." ".$client->last_name."'>
                                <a href='/clients/profile/show/".$client->id."'>
                                <img src='".asset('storage/'.$client->profile)."' alt='Avatar' class='rounded-circle'/>
                                </a>
                                </div>"
            ]);
        
        return response()->json([
            "rows" => $clients->items(),
            "total" => $clients->total(),
        ]);
    }
}
