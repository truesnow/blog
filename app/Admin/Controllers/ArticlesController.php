<?php

namespace App\Admin\Controllers;

use App\Models\Article;
use App\Models\Subject;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class ArticlesController extends Controller
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

            $content->header('文章管理');
            $content->description('');
            $content->breadcrumb(
                ['text' => '文章管理']
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

            $content->header('修改文章');
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

            $content->header('创建文章');
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
        return Admin::grid(Article::class, function (Grid $grid) {

            $grid->id('ID')->sortable();
            $grid->column('title', '标题');
            $grid->column('excerpt', '摘要');
            $grid->user()->name('作者')->display(function ($user_name) {
                $user_link = route('users.show', $this->user_id);
                return "<a href='{$user_link}'>{$user_name}</a>";
            });
            $grid->subject_id('所属专题')->select(Subject::getSubOptions(['' => '']));
            $grid->reply_count('评论数');
            $grid->view_count('阅读数');
            $grid->created_at('创建时间');
            $grid->updated_at('更新时间');

            $grid->actions(function ($actions) {
                // $actions->disableEdit();
            });

            $grid->filter(function ($filter) {
                $filter->like('title', '标题');
                $filter->equal('subject_id', '所属专题')->select(Subject::getSubOptions(['' => '']));
                $filter->like('excerpt', '摘要');
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
        return Admin::form(Article::class, function (Form $form) {

            $form->display('id', 'ID');

            $form->text('title', '标题');
            $form->textarea('excerpt', '摘要');
            $form->text('slug', 'Slug');
            $form->select('subject_id', '所属专题')->options(Subject::getSubOptions(['' => '']));
            $form->radio('user_id', '作者')->options([1 => 'truesnow']);
            $form->editor('content', '文章内容');
            $form->text('order', '排序')->value(100);
            $form->display('created_at', '创建时间');
            $form->display('updated_at', '更新时间');
        });
    }
}
