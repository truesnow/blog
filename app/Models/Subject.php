<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable = ['name', 'description', 'parent_id'];

    public function articles()
    {
        return $this->hasMany(Article::class)->orderBy('created_at', 'desc');
    }

    public function parent()
    {
        return $this->belongsTo(Subject::class, 'id')->where('id', $this->parent_id);
    }

    public function children()
    {
        return $this->hasMany(Subject::class, 'parent_id');
    }

    public static function allSorted()
    {
        return Subject::where('parent_id', 0)->with('children')->get();
    }

    public static function topOptions()
    {
        $list = Subject::where('parent_id', 0)->get();
        $map = [0 => '顶级专题'];
        foreach ($list as $k => $v) {
            $map[$v['id']] = $v['name'];
        }

        return $map;
    }
}
