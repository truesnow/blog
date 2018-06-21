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
        return Admin::grid(Bookmark::class, function (Grid $grid) {

            $grid->id('ID')->sortable();

            $grid->column('name', '书签名称')->editable();
            $grid->icon('图标')->image();
            // $grid->column('url', '链接')->display(function ($url) {
                // return "<a href='{$url}' target='_blank'>{$url}</a>";
            // });
            $grid->column('url', '链接')->editable('textarea');
            $grid->column('description', '描述')->editable('textarea');
            $grid->column('category_id', '所属分类')->display(function ($category_id) {
                $category = BookmarkCategory::find($category_id);
                $parent_category = BookmarkCategory::find($category->parent_id);
                return $parent_category->name . ' > ' . $category->name;
            });
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
            $form->textarea('description', '描述');
            $form->select('category_id', '书签分类')->options(BookmarkCategory::getSubOptions());
            $form->display('created_at', '创建时间');
            $form->display('updated_at', '更新时间');
        });
    }
}
