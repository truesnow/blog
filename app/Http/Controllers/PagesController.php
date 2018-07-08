<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Motto;
use App\Models\Article;
use App\Models\Subject;
use App\Models\Page;
use DB;

class PagesController extends Controller
{
    public function index()
    {
        $motto = Motto::last();
        $articles = Article::listByRecent();
        $article_count = DB::table('articles')->count();
        $subjects = Subject::allSorted();

        return $this->view('pages.index', compact('motto', 'articles', 'article_count', 'subjects'));
    }

    public function show($name)
    {
        $page = Page::where('name', $name)->first();
        $page->increment('view_count', 1);

        return $this->view('pages.show', compact('page'));
    }
}
