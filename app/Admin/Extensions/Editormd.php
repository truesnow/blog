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
    ];

    public function render()
    {
        $this->script = <<<EOT

adminEditor = editormd({
    id      : "admin-editormd",
    width   : "66%",
    height  : 640,
    path    : "/vendor/editormd/lib/"
});

EOT;
        return parent::render();
    }
}
