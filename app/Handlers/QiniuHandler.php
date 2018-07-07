<?php

namespace App\Handlers;

use zgldh\QiniuStorage\QiniuStorage;

class QiniuHandler
{
    public function save($file, $folder)
    {
        $disk = \Storage::disk('qiniu');
        return $disk->put($folder, $file);
    }
}
