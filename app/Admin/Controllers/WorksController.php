<?php

namespace App\Admin\Controllers;

use App\Models\Work;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class WorksController extends Controller
{
    use ModelForm;

    /**
     * Index interface.
     *
     * @return Content
     */
    public function index()
    {
        return Admin::content(function (Content $content) {

            $content->header('我的作品管理');
            $content->description('');

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

            $content->header('编辑我的作品');
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

            $content->header('创建我的作品');
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
        return Admin::grid(Work::class, function (Grid $grid) {

            $grid->id('ID')->sortable();

            $grid->column('name', '作品名称')->editable();
            $grid->column('category', '所属分类')->select(Work::$category_map);
            $grid->column('image', '作品图')->image();
            $grid->column('url', '链接')->editable('textarea');
            $grid->column('description', '描述')->editable('textarea');
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
        return Admin::form(Work::class, function (Form $form) {

            $form->display('id', 'ID');

            $form->text('name', '作品名称');
            $form->select('category', '所属分类')->options(Work::$category_map);
            $form->text('url', '链接');
            $form->image('image', '作品图')->move('/images/works/' . date('Ym'));
            $form->textarea('description', '描述')->rules('nullable');

            $form->display('created_at', '创建时间');
            $form->display('updated_at', '更新时间');
        });
    }
}
