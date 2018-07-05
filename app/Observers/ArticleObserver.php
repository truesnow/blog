<?php

namespace App\Observers;

use App\Models\Article;
use App\Handlers\SlugTranslateHandler;
use App\Jobs\TranslateSlug;
use App\Models\Subject;
// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class ArticleObserver
{
    public function creating(Article $article)
    {
        //
    }

    public function updating(Article $article)
    {
        //
    }

    public function created(Article $article)
    {
        $article->order = $article->id;
        $article->save();
        // 更新专题下文章数量
        Subject::where('id', $article->subject_id)->increment('article_count');
    }

    public function saving(Article $article)
    {
        // XSS 过滤
        // $article->content = clean($article->content, 'article_content');

        // 生成话题摘录
        if (empty($article->excerpt)) {
            $article->excerpt = make_excerpt($article->content);
        }
    }

    public function saved(Article $article)
    {
        // 生成 SEO 友好标题 slug，翻译 title
        if (empty($article->slug)) {
            // 推送人物到队列
            dispatch(new TranslateSlug($article));
            // $article->slug = app(SlugTranslateHandler::class)->translate($article->title);
        }
    }

    public function deleted(Article $article)
    {
        // 更新专题下文章数量
        Subject::where('id', $article->subject_id)->decrement('article_count');
        // 同时删除文章下回复
        \DB::table('replies')->where('article_id', $article->id)->delete();
    }
}
