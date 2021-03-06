<?php

namespace App\Admin\Controllers;

use App\Models\User;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class UsersController extends Controller
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

            $content->header('用户管理');
            $content->description('');
            $content->breadcrumb(
                ['text' => '用户管理']
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

            $content->header('header');
            $content->description('description');

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
        return Admin::grid(User::class, function (Grid $grid) {

            $grid->id('ID')->sortable();
            $grid->column('avatar', '头像')->display(function ($avatar) {
                return "<img src='{$this->avatar()}' alt='{$this->name}' width='45' height='45' />";
            });
            $grid->name('用户名');
            $grid->column('email', '邮箱');
            $grid->introduction('简介');
            $grid->last_actived_at('最后活跃于')->sortable();
            $grid->created_at('注册时间')->sortable();
            $grid->updated_at('更新时间')->sortable();

            $grid->filter(function($filter) {
                $filter->like('name', __('Name'));
                $filter->like('email', __('Email'));
                $filter->between('created_at', '注册时间')->datetime();
            });

            $grid->disableCreateButton();
            $grid->disableExport();

            $grid->actions(function ($actions) {
                $actions->disableEdit();
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
        return Admin::form(User::class, function (Form $form) {

            $form->display('id', 'ID');
            // $form->image('avatar', '头像')->move('/images/mottos/' . date('Ym'));
            $form->text('name', '用户名');
            $form->text('email', '邮箱');
            $form->textarea('introduction', '简介');

            $form->display('created_at', '注册时间');
            $form->display('updated_at', '更新时间');
        });
    }

    public function show($id)
    {
        return Admin::content(function ($content) use ($id) {
            $content->body(Admin::show(User::findOrFail($id)));
        });
    }

}
