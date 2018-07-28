<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Handlers\QiniuHandler;
use zgldh\QiniuStorage\QiniuStorage;

/**
 * 资源管理控制器，包含图片上传等
 */
class ResourcesController extends Controller
{
    /**
     * editor.md 编辑器中粘贴上传图片
     * @param  Request      $request [description]
     * @param  QiniuHandler $handler [description]
     * @return [type]                [description]
     */
    public function editormdPasteUploadImage(Request $request, QiniuHandler $handler)
    {
        $result = [
            'success' => 0,
            'message' => '上传失败！',
            'url' => '',
        ];

        $save_ret = $handler->saveBase64($request->input('image'));

        if (isset($save_ret['url'])) {
            $result = [
                'success' => 1,
                'message' => '上传成功！',
                'url' => $save_ret['url'],
            ];
        } else {
            $result['message'] = $save_ret;
        }

        return $result;
    }

    public function create(Request $request)
    {
        return $this->view('resources/create');
    }

    public function store(Request $request)
    {
        $file = $request->file('file');
        $disk = QiniuStorage::disk('qiniu');

        $name = $disk->put('uploads/images/' . date('Ym'), $file);
        $url = $disk->downloadUrl($name);

        return $this->view('resources.show', compact('name', 'url'));
    }
}
