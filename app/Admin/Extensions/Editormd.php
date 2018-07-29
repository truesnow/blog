<?php

namespace App\Admin\Extensions;

use Encore\Admin\Form\Field;

class Editormd extends Field
{
    protected $view = 'admin.editormd';

    protected static $css = [
        '/vendor/editormd/css/editormd.css',
    ];

    protected static $js = [
        '/vendor/editormd/editormd.min.js',
        '/js/utils.js',
    ];

    public function render()
    {
        $this->script = <<<EOT

adminEditor = editormd({
    id      : "admin-editormd",
    width   : "66%",
    height  : 640,
    path    : "/vendor/editormd/lib/",
    imageUpload    : true,
    imageFormats   : ["jpg", "jpeg", "gif", "png", "bmp", "webp"],
    imageUploadURL : '/articles/editormd_upload_image',
    imageParams: { _token: '{{ csrf_token() }}' }
});

document.addEventListener('paste', function (event) {
    $.pasteUploadImage(event, adminEditor, 'articles');
})

EOT;
        return parent::render();
    }
}
