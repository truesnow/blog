<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WikiSubject extends Model
{
    use Traits\FieldMapHelper;

    protected $fillable = ['name', 'desc', 'cover', 'ordinal', 'enable_status'];

    /**
     * 启用的按排序值排序
     */
    public static function allEnabledWikis() {
        return WikiSubject::where(['enable_status' => ENABLED])->orderBy('ordinal', 'asc')->get();
    }

    public function items() {
        return $this->hasMany('App\Models\WikiItem', 'subject_id');
    }
}
