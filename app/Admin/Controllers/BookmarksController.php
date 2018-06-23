<?php

namespace App\Admin\Controllers;

use App\Models\Bookmark;
use App\Models\BookmarkCategory;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class BookmarksController extends Controller
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

            $content->header('书签管理');
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

            $content->header('编辑书签');
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

            $content->header('添加书签');
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
        $sub_options = BookmarkCategory::getSubOptions(['' => '请选择']);
        return Admin::grid(Bookmark::class, function (Grid $grid) use ($sub_options) {

            $grid->id('ID')->sortable();

            $grid->column('name', '书签名称')->editable();
            $grid->icon('图标')->image();
            $grid->column('url', '链接')->editable('textarea');
            $grid->column('description', '描述')->editable('textarea');
            $grid->category_id('所属分类')->select($sub_options);
            $grid->weight('排序权重值')->editable();
            $grid->created_at('创建时间');
            $grid->updated_at('更新时间');

            $grid->filter(function ($filter) {
                $filter->like('name', '标题');
                $filter->equal('category_id', '所属分类')->select(BookmarkCategory::getSubOptions(['' => '请选择']));
                $filter->like('url', '链接');
                $filter->like('description', '摘要');
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
        return Admin::form(Bookmark::class, function (Form $form) {

            $form->display('id', 'ID');

            $form->text('name', '书签名称');
            $form->text('url', '链接');
            $form->image('icon', '图标')->move('/images/bookmarks/' . date('Ym'));
            $form->textarea('description', '描述')->rules('nullable');
            $form->select('category_id', '书签分类')->options(BookmarkCategory::getSubOptions());
            $form->text('weight', '排序权重值');
            $form->display('created_at', '创建时间');
            $form->display('updated_at', '更新时间');
        });
    }
}
