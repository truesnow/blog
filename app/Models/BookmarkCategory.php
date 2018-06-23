<?php

namespace App\Models;

class BookmarkCategory extends Model
{
    use Traits\OptionsHelper;

    protected $fillable = ['name', 'parent_id', 'description', 'weight'];

    public function bookmarks()
    {
        return $this->hasMany(Bookmark::class, 'category_id')->orderBy('weight', 'desc');
    }

    public static function firsts()
    {
        return self::where('parent_id', 0)->orderBy('weight', 'desc');
    }

    public function parent()
    {
        return $this->belongsTo(BookmarkCategory::class, 'parent_id', 'id');
    }

    public function children()
    {
        return $this->hasMany(BookmarkCategory::class, 'parent_id')->orderBy('weight', 'desc');
    }
}
