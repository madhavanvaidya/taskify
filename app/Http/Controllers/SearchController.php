<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use ProtoneMedia\LaravelCrossEloquentSearch\Search;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {

        $query = $request->input('query');

        if (!$query) {
            $results = collect([]);
            return view('search', ['results' => $results, 'query'=>$query]);
        } else {
            $results = Search::addMany([
                [Project::class, 'title'],
                [Task::class, 'title'],
                [User::class, 'first_name'],
                [Client::class, 'first_name']
            ])
                ->paginate(10)
                ->beginWithWildcard()
                ->search($query);

            return view('search', ['results' => $results, 'query'=>$query]);
        }
    }
}
