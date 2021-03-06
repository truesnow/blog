<?php

namespace App\Admin\Controllers;

use App\Models\Page;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class PagesController extends Controller
{
    use ModelForm;

    public static $is_show_states = [
        'on'  => ['value' => 1, 'text' => '显示', 'color' => 'primary'],
        'off' => ['value' => 0, 'text' => '不显示', 'color' => 'default'],
    ];

    /**
     * Index interface.
     *
     * @return Content
     */
    public function index()
    {
        return Admin::content(function (Content $content) {

            $content->header('静态页面列表');
            $content->description('关于、致谢等页面内容');

            $content->body($this->grid());
        });
    }

    /**
     * Edit interface.
     *
     * @param $id
     * @return Content
     */
    public function edit($id)
    {
        return Admin::content(function (Content $content) use ($id) {

            $content->header('编辑页面内容');
            $content->description('');

            $content->body($this->form()->edit($id));
        });
    }

    /**
     * Create interface.
     *
     * @return Content
     */
    public function create()
    {
        return Admin::content(function (Content $content) {

            $content->header('新建静态页面');
            $content->description('');

            $content->body($this->form());
        });
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Admin::grid(Page::class, function (Grid $grid) {

            $grid->id('ID')->sortable();
            $grid->column('name', '页面名称')->editable();
            $grid->column('description', '摘要')->editable('textarea');
            $grid->column('view_count', '访问量');
            $grid->column('is_show', '是否显示')->switch(self::$is_show_states);
            $grid->created_at('创建时间');
            $grid->updated_at('更新时间');

        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(Page::class, function (Form $form) {

            $form->display('id', 'ID');
            $form->text('name', '页面名称');
            $form->textarea('description', '页面描述');
            $form->editormd('content', '页面内容');
            $form->switch('is_show', '是否显示')->states(self::$is_show_states);
            $form->display('created_at', '创建时间');
            $form->display('updated_at', '更新时间');
        });
    }
}
