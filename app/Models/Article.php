<?php

namespace App\Models;

class Article extends Model
{
    protected $fillable = ['title', 'content', 'subject_id', 'order', 'excerpt', 'slug'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function scopeWithOrder($query, $order)
    {
        switch ($order) {
            case 'recent':
                $query->recent();
                break;
            default:
                $query->recentReplied();
                break;
        }
    }

    public function scopeRecentReplied($query)
    {
        return $query->orderBy('updated_at', 'desc');
    }

    public function scopeRecent($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    public function link($params = [])
    {
        return route('articles.show', array_merge([$this->id, $this->slug], $params));
    }

    public function replies()
    {
        return $this->hasMany(Reply::class)->recent();
    }

    public static function listByRecent()
    {
        $articles = Article::with('user', 'replies', 'subject')->withOrder('recent')->paginate(10);

        return $articles;
    }
}
