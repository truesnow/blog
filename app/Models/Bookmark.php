<?php

namespace App\Models;

class Bookmark extends Model
{
    protected $fillable = ['name', 'url', 'category_id', 'description', 'icon'];
}
