<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Abbr extends Model
{

    protected $fillable = ['abbr', 'full_name', 'cn_name', 'desc'];

}
