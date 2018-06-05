<?php

namespace App\Models;

class Reply extends Model
{
    protected $fillable = ['content'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function article()
    {
        return $this->belongsTo(Article::class);
    }

    public function children()
    {
        return $this->hasMany(Reply::class, 'parent_id');
    }
}
