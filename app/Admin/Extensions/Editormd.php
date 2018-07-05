<?php

namespace App\Admin\Extensions;

use Encore\Admin\Form\Field;

class Editormd extends Field
{
    protected $view = 'admin.editormd';

    protected static $css = [
        '/css/editormd.css',
    ];

    protected static $js = [
        '/js/editormd.min.js',
    ];

    public function render()
    {
        $this->script = <<<EOT

testEditor = editormd({
    id      : "admin-editormd",
    width   : "66%",
    height  : 640,
    path    : "/vendor/editormd/lib/"
});

EOT;
        return parent::render();
    }
}
