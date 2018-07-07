<?php

namespace App\Handlers;

use zgldh\QiniuStorage\QiniuStorage;
use Qiniu\Auth as QiniuAuth;
use Qiniu\Storage\UploadManager;

/**
 * 七牛处理器
 */
class QiniuHandler
{
    /**
     * 上传文件
     * @param  object $file   表单中的文件
     * @param  string $folder 上传的目录
     * @return string         文件名（包含存储路径，无域名）
     */
    public function save($file, $folder = 'images')
    {
        $disk = QiniuStorage::disk('qiniu');
        return $disk->put($folder . date('/Ym/'), $file);
    }

    /**
     * base64 上传图片，适用于粘贴上传图片的场景
     * @param  string $base64 图片 base64 编码
     * @param  string $folder 存储文件夹
     * @return [type]         [description]
     */
    public function saveBase64($base64, $folder = 'images')
    {
        // 初始化 UploadManager 对象并进行文件的上传。
        $upload_manager = new UploadManager();
        // 按年月存储，便于查找和定位
        $key = $folder . '/' . date('Ym/') . str_random(15) . '.png';
        list($ret, $err) = $upload_manager->putFile($this->getUploadToken(), $key, $base64);
        if ($err === null) {
            return [
                'hash' => $ret['hash'],// 文件hash
                'key' => $ret['key'],// 文件名
                'url' => static_url($ret['key']),// 文件链接
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
