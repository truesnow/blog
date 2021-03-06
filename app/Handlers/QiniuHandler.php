<?php

namespace App\Handlers;

use zgldh\QiniuStorage\QiniuStorage;
use Qiniu\Auth as QiniuAuth;
use Qiniu\Storage\UploadManager;
use Storage;

/**
 * 七牛处理器
 */
class QiniuHandler
{
    /**
     * base64 上传图片，适用于粘贴上传图片的场景
     * @param  string $base64 图片 base64 编码
     * @param  string $source 来源
     * @return [type]         [description]
     */
    public function saveBase64($base64, $source = 'articles')
    {
        // 初始化 UploadManager 对象并进行文件的上传。
        $upload_manager = new UploadManager();
        // 按年月存储，便于查找和定位
        $key = 'images/' . $source . '/' . date('Ym/') . str_random(32) . '.png';
        list($ret, $err) = $upload_manager->putFile($this->getUploadToken(), $key, $base64);
        if ($err === null) {
            return [
                'hash' => $ret['hash'],// 文件hash
                'key' => $ret['key'],// 文件名
                'url' => Storage::url($ret['key']),// 文件链接
            ];
        } else {
            return $err;
        }
    }

    /**
     * 获取七牛云上传 token
     * @return [type] [description]
     */
    public function getUploadToken()
    {
        $access_key = config('filesystems.disks.qiniu.access_key');
        $secret_key = config('filesystems.disks.qiniu.secret_key');
        $bucket = config('filesystems.disks.qiniu.bucket');
        // 初始化签权对象。
        $auth = new QiniuAuth($access_key, $secret_key);
        $upload_token = $auth->uploadToken($bucket);

        return $upload_token;
    }
}
