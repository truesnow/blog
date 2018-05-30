<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable = ['name', 'description', 'parent_id'];

    public function articles()
    {
        return $this->hasMany(Article::class);
    }
}
