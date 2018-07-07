<?php

namespace App\Http\Controllers;

use zgldh\QiniuStorage\QiniuStorage;

class ResourcesController extends Controllers
{
    public function store()
    {
        $disk = QiniuStorage::disk('qiniu');
    }
}
