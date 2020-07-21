<?php

namespace App\Admin\Controllers;

use App\Models\Milestone;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class MilestonesController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '里程碑管理';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Milestone);

        $grid->column('id', __('Id'))->sortable();
        $grid->column('type', __('Type'))->select(Milestone::TYPE_MAP);
        $grid->column('version', __('Version'));
        $grid->column('content', __('Content'));
        $grid->column('detail', __('Detail'));
        $grid->column('created_at', __('Created at'))->sortable()->hide();
        $grid->column('updated_at', __('Updated at'))->sortable()->hide();

        $grid->model()->orderBy('id', 'desc');

        $grid->filter(function ($filter) {
            $filter->equal('version', '版本');
            $filter->like('content', '内容');
            $filter->equal('type', '类型')->select(Milestone::TYPE_MAP);
            $filter->between('created_at', '创建时间')->datetime();
            $filter->between('updated_at', '更新时间')->datetime();
        });

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Milestone::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('type', __('Type'))->as(function ($type) {
            return $type . '-' . array_get(Milestone::TYPE_MAP, $type, $type);
        });
        $show->field('version', __('Version'));
        $show->field('content', __('Content'));
        $show->field('detail', __('Detail'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Milestone);

        $form->display('id', __('ID'));
        $form->text('version', __('Version'));
        $form->text('content', __('Content'));
        $form->textarea('detail', __('Detail'));
        $form->select('type', __('Type'))->options(Milestone::TYPE_MAP);

        return $form;
    }
}
