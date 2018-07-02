<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Motto;
use App\Models\Article;
use App\Models\Subject;
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

    public function mine()
    {
        $data = config('mine');
        return $this->view('pages.mine', compact('data'));
    }
}
