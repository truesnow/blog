<?php

namespace App\Observers;

use App\Models\Reply;
use App\Models\Article;
use App\Notifications\ArticleReplied;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class ReplyObserver
{
    public function creating(Reply $reply)
    {
        $reply->content = clean($reply->content, 'article_content');
    }

    public function created(Reply $reply)
    {
        $article = $reply->article;
        $reply->article->increment('reply_count', 1);

        $article->user->notify(new ArticleReplied($reply));
    }

    public function deleted(Reply $reply)
    {
        $article = Article::find($reply->article_id);
        // 防止出现因数据问题导致数量减少后为负的情况
        if ($article->reply_count >= 1) {
            $article->decrement('reply_count', 1);
        }
    }
}
