<?php

namespace App\Admin\Controllers;

use App\Admin\Actions\Abbr\BatchCreate;
use App\Models\Abbr;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class AbbrsController extends Controller
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

            $content->header('计算机专有缩略名词管理');
            $content->description('');
            $content->breadcrumb(
                ['text' => '计算机专有缩略名词管理']
            );

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

            $content->header('修改缩略词');
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

            $content->header('录入缩略词');
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
        return Admin::grid(Abbr::class, function (Grid $grid) {

            $grid->id('ID')->sortable();
            $grid->column('abbr', '缩写')->sortable();
            $grid->column('full_name', '全称')->sortable();
            $grid->cn_name('中文名');
            $grid->desc('说明');
            $grid->created_at('创建时间');
            $grid->updated_at('更新时间');

            $grid->actions(function ($actions) {
            });

            $grid->tools(function (Grid\Tools $tools) {
                $tools->append(new BatchCreate);
            });

            $grid->filter(function ($filter) {
                $filter->equal('abbr', '缩写');
                $filter->like('full_name', '全称');
                $filter->like('cn_name', '中文名');
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
        return Admin::form(Abbr::class, function (Form $form) {

            $form->display('id', 'ID');

            $form->text('abbr', '缩略词');
            $form->text('full_name', '全称');
            $form->text('cn_name', '中文名');
            $form->textarea('desc', '说明');
            $form->display('created_at', '创建时间');
            $form->display('updated_at', '更新时间');
        });
    }
}
