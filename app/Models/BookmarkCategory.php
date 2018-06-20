<?php

namespace App\Models;

class BookmarkCategory extends Model
{
    protected $fillable = ['name', 'parent_id', 'description'];

    public function bookmarks()
    {
        return $this->hasMany(Bookmark::class, 'category_id');
    }

    public static function firsts()
    {
        return self::where('parent_id', 0);
    }

    public function parent()
    {
        return $this->belongsTo(BookmarkCategory::class, 'id')->where('id', $this->parent_id);
    }

    public function children()
    {
        return $this->hasMany(BookmarkCategory::class, 'parent_id');
    }
}
