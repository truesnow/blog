<?php

namespace App\Admin\Controllers;

use App\Models\VisitLog;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class VisitLogsController extends Controller
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

            $content->header('访问记录');
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
        return Admin::grid(VisitLog::class, function (Grid $grid) {

            $grid->id('ID')->sortable();
            // $grid->log_id('记录ID');
            $grid->column('user')->display(function () {
                if (!empty($this->user_id) && class_exists($this->user_model)) {
                    $user = $this->user_model::find($this->user_id);
                    if ($user) {
                        return "<a href='/admin/users/{$this->user_id}/edit'>" . $user->name . "</a>";
                    } else {
                        return $this->user_id;
                    }
                } else {
                    return $this->user_id;
                }
            });
            $grid->created_at('访问时间');
            $grid->column('ip', 'IP 地址')->display(function () {
                return long2ip($this->ip);
            });
            $grid->column('user_agent', '浏览器');
            $grid->column('method', '请求方式');
            $grid->column('url', '请求 URL');
            $grid->column('query_string', 'GET 参数');
            $grid->column('form_data', 'POST 参数');

            $grid->actions(function ($actions) {
                $actions->disableDelete();
                $actions->disableEdit();
            });

            $grid->filter(function ($filter) {
                $filter->equal('ip', 'IP 地址')->ip();
                $filter->like('user_agent', '浏览器');
                $filter->in('method', '请求方式')->checkbox(['get' => 'GET 请求', 'post' => 'POST 请求']);
                $filter->equal('url', '请求 URL');
                $filter->between('created_at', '访问时间')->datetime();
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
        return Admin::form(VisitLog::class, function (Form $form) {

            $form->display('id', 'ID');

            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');
        });
    }
}
