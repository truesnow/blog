<?php

namespace App\Models\Traits;

trait FieldMapHelper {
    public static function getFieldMap($keyFieldName, $valueFieldName) {
        return static::select($keyFieldName, $valueFieldName)->pluck($valueFieldName, $keyFieldName)->toArray();
    }
}