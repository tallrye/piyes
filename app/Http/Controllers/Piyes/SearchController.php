<?php

namespace App\Http\Controllers\Piyes;

use Illuminate\Http\Request;
use App\Models\Piyes\SearchIndex;


class SearchController extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show search results
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $results = SearchIndex::where('keyword', 'LIKE', '%'.$request->keyword.'%')->get();
        $keyword = $request->keyword;
        return view('piyes.search', compact('results', 'keyword'));
    }   
}