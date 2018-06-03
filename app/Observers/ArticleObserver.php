<?php

namespace App\Observers;

use App\Models\Article;

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
        if (empty($article->excerpt)) {
            $article->excerpt = make_excerpt($article->content);
        }
    }
}
