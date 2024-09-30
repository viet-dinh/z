<?php

namespace App\Http\Controllers;

use App\Models\Story;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    //todo: move it to service and fulltext index
    private function findStories(string $query)
    {
        return Story::where('title', 'like', '%' . $query . '%')
            ->limit(10)
            ->get();
    }

    public function index(Request $request)
    {
        $query = $request->input('q');
        $stories = $this->findStories($query);

        return view('search.index', compact('stories', 'query'));
    }

    public function search(Request $request)
    {
        $query = $request->input('q');
        $stories = $this->findStories($query);

        return response()->json($stories);
    }
}
