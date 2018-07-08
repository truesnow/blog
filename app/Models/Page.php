<?php

namespace App\Models;

class Page extends Model
{
    protected $fillable = ['name', 'description', 'content', 'view_count', 'is_show'];
}
