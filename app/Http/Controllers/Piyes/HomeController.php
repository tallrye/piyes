<?php

namespace App\Http\Controllers\Piyes;

use Illuminate\Http\Request;
use App\Models\Piyes\Task;
use Analytics;
use Spatie\Analytics\Period;
use App\Models\Piyes\Inbox\InboxMail;

class HomeController extends BaseController
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        $totalVisitorsAndPageViews = Analytics::fetchTotalVisitorsAndPageViews(Period::days(60));

        $topOs = Analytics::performQuery(Period::days(30), 'ga:pageviews', ['dimensions' => 'ga:operatingSystem', 'sort' => '-ga:pageviews']);
        $topReferrers = Analytics::fetchTopReferrers(Period::days(30))->take(4);
        $topBrowser = Analytics::fetchTopBrowsers(Period::days(30))->first();
        $mostVisitedPage = Analytics::fetchMostVisitedPages(Period::days(30))->first();
        $newSessions = Analytics::performQuery(Period::days(30), 'ga:percentNewSessions', ['dimensions' => 'ga:source']);
        $tasks = Task::all();
        $mails = InboxMail::where('isTrash', false)->where('isSent', false)->where('isDraft', false)->orderBy('created_at', 'DESC')->take(10)->get();
        return view('piyes.home', compact('tasks', 'mostVisitedPage', 'topBrowser', 'totalVisitorsAndPageViews', 'topReferrer', 'topReferrers', 'newSessions', 'topOs', 'mails'));
    }



    
}
