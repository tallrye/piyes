<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Piyes\Inbox\ContactForm;
use App\Models\Piyes\Articles\Article;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('web');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pageForm = ContactForm::findOrFail(1);

        $articles = Article::where('publish', true)
                            ->where('publish_at', '<=', todayWithFormat('Y-m-d'))
                            ->where('publish_until', '>=', todayWithFormat('Y-m-d'))
                            ->orWhere('publish_until', null)
                            ->orderBy('position', 'ASC')
                            ->get();

        return view('welcome', compact('pageForm', 'articles'));
    }

    /**
     * Show the about page.
     *
     * @return \Illuminate\Http\Response
     */
    public function about(Request $request)
    {
        $pageForm = ContactForm::findOrFail(1);
        return view('about', compact('pageForm'));
    }

    /**
     * Show the article detail page.
     *
     * @return \Illuminate\Http\Response
     */
    public function detail(Request $request)
    {
        $pageForm = ContactForm::findOrFail(1);
        $article = Article::where('url', $request->url)->firstOrFail();
        return view('detail', compact('pageForm', 'article'));
    }
}
