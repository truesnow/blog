<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class WikiItem extends Model
{
    protected $fillable = ['subject_id', 'cate_id', 'name', 'desc', 'url',
        'content_id', 'ordinal', 'enable_status'];

    /**
     * 根据类别获取wiki主题下项目
     */
    public static function getSubjectAllItemsByCate($subjectId, $cateId) {
        return self::where([
            'enable_status' => ENABLED,
            'subject_id' => $subjectId,
            'cate_id' => $cateId
            ])
            ->orderBy('ordinal', 'asc')
            ->get();
    }

    /**
     * 获取主题下各类别的项目数量Map
     */
    public static function getCateToItemCountMapBySubject($subjectId)
    {
        // SELECT cate_id, count(*) as count FROM wiki_items WHERE enable_status = 1 AND subject_id = 1 GROUP BY cate_id;
        return self::select('cate_id', DB::raw('COUNT(*) as count'))
        ->where([
            'enable_status' => ENABLED,
            'subject_id' => $subjectId
        ])
        ->groupBy('cate_id')
        // 左边为 value，右边为 key
        ->pluck('count', 'cate_id')
        ->toArray();
    }

    public function subject() {
        return $this->belongsTo('App\Models\WikiSubject', 'subject_id');
    }
}
