<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TextContent extends Model
{
    protected $fillable = ['table', 'record_id', 'content'];
}
