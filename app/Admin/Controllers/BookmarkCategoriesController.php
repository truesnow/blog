<?php

namespace App\Admin\Controllers;

use App\Models\BookmarkCategory;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class BookmarkCategoriesController extends Controller
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

            $content->header('书签分类');
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

            $content->header('修改书签分类');
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

            $content->header('添加书签分类');
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
        return Admin::grid(BookmarkCategory::class, function (Grid $grid) {

            $grid->id('ID')->sortable();
            $grid->column('parent_category_name', '父级分类')->display(function(){
                if ($this->parent_id != 0) {
                    $parent_category = BookmarkCategory::find($this->parent_id);
                    return $parent_category->name;
                } else {
                    return '';
                }
            });
            $grid->name('名称')->editable();
            $grid->description('描述')->editable('textarea');
            $grid->weight('排序权重值')->editable();

            $grid->created_at('创建时间');
            $grid->updated_at('更新时间');

            $grid->filter(function ($filter) {
                $filter->like('name', '分类名称');
                $filter->equal('parent_id', '父级分类')->select(BookmarkCategory::getTopOptions([0 => '一级分类']));
                $filter->like('description', '描述');
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
        return Admin::form(BookmarkCategory::class, function (Form $form) {

            $form->display('id', 'ID');

            $form->text('name', '书签分类名称');
            $form->textarea('description', '描述');
            $form->select('parent_id', '父级分类')->options(BookmarkCategory::getTopOptions([0 => '一级分类']));
            $form->text('weight', '排序权重值');
            $form->display('created_at', '创建时间');
            $form->display('updated_at', '更新时间');
        });
    }
}
