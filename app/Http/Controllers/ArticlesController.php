<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleRequest;
use App\Models\Subject;
use Auth;
use App\Handlers\ImageUploadHandler;

class ArticlesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    public function index(Request $request, Article $article)
    {
        $articles = $article->with('user', 'replies')->withOrder($request->order)->paginate(20);
        return view('articles.index', compact('articles'));
    }

    public function show(Request $request, Article $article)
    {
        if (!empty($article->slug) && $article->slug != $request->slug) {
            return redirect($article->link(), 301);
        }

        return view('articles.show', compact('article'));
    }

    public function create(Article $article)
    {
        $this->authorize('create', $article);
        $subjects = Subject::allSorted();
        return view('articles.create_and_edit', compact('article', 'subjects'));
    }

    public function store(ArticleRequest $request, Article $article)
    {
        $this->authorize('create', $article);
        $article->fill($request->all());
        $article->user_id = Auth::id();
        $article->save();
        return redirect()->to($article->link())->with('success', '更新文章成功');
    }

    public function edit(Article $article)
    {
        $this->authorize('update', $article);
        $subjects = Subject::allSorted();
        return view('articles.create_and_edit', compact('article', 'subjects'));
    }

    public function update(ArticleRequest $request, Article $article)
    {
        $this->authorize('update', $article);
        $article->update($request->all());

        return redirect()->to($article->link())->with('success', '更新成功');
    }

    public function destroy(Article $article)
    {
        $this->authorize('destroy', $article);
        $article->delete();

        return redirect()->route('articles.index')->with('success', '删除成功');
    }

    public function uploadImage(Request $request, ImageUploadHandler $uploader)
    {
        $data = [
            'success' => false,
            'msg' => '上传失败！',
            'file_path' => '',
        ];
        if ($file = $request->upload_file) {
            $result = $uploader->save($request->upload_file, 'articles', \Auth::id(), 1024);
            if ($result) {
                $data['file_path'] = $result['path'];
                $data['msg'] = '上传成功';
                $data['success'] = true;
            }
        }

        return $data;
    }
}
