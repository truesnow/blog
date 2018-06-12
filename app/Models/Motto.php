<?php

namespace App\Models;

class Motto extends Model
{
    protected $table = 'mottos';
    protected $fillable = ['author', 'source', 'portrait', 'content'];

    public static function random()
    {
        $count = Motto::count();
        $rand = rand(1, $count);

        return Motto::find($rand);
    }
}
