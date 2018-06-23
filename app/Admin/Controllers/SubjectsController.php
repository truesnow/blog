<?php

namespace App\Admin\Controllers;

use App\Models\Subject;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class SubjectsController extends Controller
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

            $content->header('专题管理');
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

            $content->header('修改专题');
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

            $content->header('添加专题');
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
        return Admin::grid(Subject::class, function (Grid $grid) {

            $grid->id('ID')->sortable();
            $grid->parent_id('父级专题')->select(Subject::getTopOptions(['' => '']));
            $grid->name('专题名称')->editable();
            $grid->description('专题描述')->editable('textarea');
            $grid->article_count('文章数量');
            $grid->created_at('创建时间');
            $grid->updated_at('更新时间');

            $grid->filter(function ($filter) {
                $filter->like('name', '专题名称');
                $filter->equal('parent_id', '父级专题')->select(Subject::getTopOptions([0 => '顶级专题']));
                $filter->like('description', '专题描述');
            });
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(Subject::class, function (Form $form) {
            $form->display('id', 'ID');

            $form->text('name', '专题名称');
            $form->textarea('description', '专题描述');
            $form->select('parent_id', '父级专题')->options(Subject::getTopOptions([0 => '一级专题']));
            $form->display('created_at', '创建时间');
            $form->display('updated_at', '更新时间');
        });
    }
}
