<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VisitLog extends Model
{
    protected $fillable = [
        'log_id', 'user_id', 'user_model', 'subject_id', 'subject_model',
        'ip', 'user_agent', 'method', 'url', 'query_string', 'form_data',
        'description', 'created_at', 'updated_at'];
}
