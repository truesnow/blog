<?php

namespace App\Admin\Controllers;

use App\Models\Motto;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class MottosController extends Controller
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

            $content->header('格言管理');
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

            $content->header('header');
            $content->description('description');

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

            $content->header('添加格言');
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
        return Admin::grid(Motto::class, function (Grid $grid) {

            $grid->id('ID')->sortable();
            $grid->portrait('肖像')->image();
            $grid->author('作者');
            $grid->source('来源');
            $grid->content('格言内容');

            $grid->created_at('创建时间')->sortable();
            $grid->updated_at('更新时间')->sortable();

            $grid->model()->orderBy('id', 'desc');

            $grid->filter(function ($filter) {
                $filter->like('author', '作者');
                $filter->like('source', '来源');
                $filter->like('content', '格言内容');
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
        return Admin::form(Motto::class, function (Form $form) {

            $form->display('id', 'ID');

            $form->textarea('content', '格言内容');
            $form->text('author', '作者');
            $form->text('source', '来源');
            $form->image('portrait', '肖像')->move('/images/mottos/' . date('Ym'));
            $form->display('created_at', '创建时间');
            $form->display('updated_at', '更新时间');
        });
    }
}
