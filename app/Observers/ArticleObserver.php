<?php

namespace App\Observers;

use App\Models\Article;
use App\Handlers\SlugTranslateHandler;
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
    }

    public function saving(Article $article)
    {
        // XSS 过滤
        $article->content = clean($article->content, 'article_content');

        // 生成话题摘录
        if (empty($article->excerpt)) {
            $article->excerpt = make_excerpt($article->content);
        }

        // 生成 SEO 友好标题 slug，翻译 title
        if (empty($article->slug)) {
            $article->slug = app(SlugTranslateHandler::class)->translate($article->title);
        }
    }
}
