<?php

namespace App\Observers;

use App\Models\Reply;
use App\Models\Article;

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
        $reply->article->increment('reply_count', 1);
    }

    public function deleted(Reply $reply)
    {
        Article::find($reply->article_id)->decrement('reply_count');
    }
}
