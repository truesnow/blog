<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Motto;
use App\Models\Article;
use App\Models\Subject;
use App\Models\Page;
use DB;
use Storage;
use Illuminate\Support\Facades\Redis;

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

    public function randomCircles()
    {
        return $this->view('pages.random-circles');
    }

    public function bouncingBalls()
    {
        return $this->view('pages.bouncing-balls');
    }

    // Generate Github markdown README.md TOC use https://github.com/ekalinin/github-markdown-toc
    public function ghtoc()
    {
        return $this->view('pages.ghtoc');
    }

    public function ghtocRun(Request $request)
    {
        $res = '';
        $ghtoc_command = config('custom.ghtoc_path');
        $this->validate($request, [
            'type' => 'in:url,content',
            'url' => 'url',
            'content' => 'string',
        ]);

        switch ($request['type']) {
            case 'url':
                $res = passthru("$ghtoc_command " . $request['url']);
                break;
            case 'content':
                // 存储 content 到文件再执行
                $filename = 'ghtoc/' . date('YmdHis') . '_' . str_random(10) . '.md';
                Storage::disk('local')->put($filename, $request['content']);
                $file_path = storage_path('app') . '/' . $filename;
                $res = passthru("$ghtoc_command " . $file_path);
                break;
            default:
                ;
        }

        return $res;
    }

    /**
     * 空方法，用于记录书签和作品中的第三方链接的访问
     */
    public function redirectTo()
    {
        $type = request()->input('type');
        $key = 'blog:redirect:' . $type;
        $url = request()->input('url');
        Redis::hincrby($key, $url, 1);

        return response()->json(['msg' => 'recorded', 'url' => $url]);
    }
}
