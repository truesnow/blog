<?php

namespace App\Models;

class BookmarkCategory extends Model
{
    protected $fillable = ['name', 'parent_id', 'description'];
}
