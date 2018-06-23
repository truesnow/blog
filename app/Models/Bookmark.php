<?php

namespace App\Models;

class Bookmark extends Model
{
    protected $fillable = ['name', 'url', 'category_id', 'description', 'icon', 'weight'];

    public function category()
    {
        return $this->belongsTo(BookmarkCategory::class, 'id', 'category_id');
    }

    public static function nav()
    {
        return BookmarkCategory::firsts()->with('children', 'children.bookmarks')->get();
    }

    public function category_full_name()
    {
        $sub_options = BookmarkCategory::getSubOptions();
        return array_get($sub_options, $this->category_id, '');
    }
}
