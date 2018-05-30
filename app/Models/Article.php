<?php

namespace App\Models;

class Article extends Model
{
    protected $fillable = ['title', 'content', 'user_id', 'subject_id', 'reply_count', 'view_count', 'order', 'excerpt', 'slug'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
}
