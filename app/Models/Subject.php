<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use Traits\OptionsHelper;

    protected $fillable = ['name', 'description', 'parent_id'];

    public function articles()
    {
        return $this->hasMany(Article::class)->orderBy('created_at', 'desc');
    }

    public function parent()
    {
        return $this->belongsTo(Subject::class, 'parent_id', 'id');
    }

    public function children()
    {
        return $this->hasMany(Subject::class, 'parent_id');
    }

    public static function allSorted()
    {
        return Subject::where('parent_id', 0)->with('children')->get();
    }
}
