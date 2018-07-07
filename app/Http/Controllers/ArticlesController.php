<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Http\Requests\ArticleRequest;
use App\Models\Subject;
use Auth;
use App\Handlers\ImageUploadHandler;
use App\Handlers\QiniuHandler;

class ArticlesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
        parent::__construct();
    }

    public function index(Request $request, Article $article)
    {
        $articles = $article->with('user', 'replies', 'subject')->withOrder($request->order)->paginate(20);
        return $this->view('articles.index', compact('articles'));
    }

    public function show(Request $request, Article $article)
    {
        if (!empty($article->slug) && $article->slug != $request->slug) {
            return redirect($article->link(), 301);
        }
        // 阅读数+1
        $article->increment('view_count', 1);
        $replies = $article->replies;

        return $this->view('articles.show', compact('article', 'replies'));
    }

    public function create(Article $article)
    {
        $this->authorize('create', $article);
        $subjects = Subject::allSorted();
        return $this->view('articles.create_and_edit', compact('article', 'subjects'));
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

    public function editormdUploadImage(Request $request, QiniuHandler $qiniu)
    {
        $result = [
            'success' => 0,
            'message' => '上传失败！',
            'url' => '',
        ];

        $file = $request->file('editormd-image-file') ? : $request->input('editormd-image-file');

        if ($url = $qiniu->save($file, 'images/articles')) {
            $result = [
                'success' => 1,
                'message' => '上传成功！',
                'url' => static_url($url),
            ];
        }

        return $result;
    }
}
