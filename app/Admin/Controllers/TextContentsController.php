<?php

namespace App\Admin\Controllers;

use App\Models\TextContent;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class TextContentsController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'TextContent';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new TextContent());

        $grid->column('id', __('Id'))->sortable();
        $grid->column('table', __('Table'))->sortable();
        $grid->column('record_id', __('Record id'))->display(function () {
            $link = route('admin.' . str_replace('_', '-', $this->table) . '.show', $this->record_id);
            return "<a href='{$link}'>{$this->record_id}</a>";
        })->sortable();
        $grid->column('content', __('Content'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

        $grid->filter(function($filter) {
            $filter->equal('table', __('Table'));
            $filter->equal('record_id', __('Record id'));
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
        $show = new Show(TextContent::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('table', __('Table'));
        $recordUrl = $this->getRecordUrl($show->getModel()->table, $show->getModel()->record_id);
        $show->field('record_id', __('Record id'))->link($recordUrl);
        $show->field('content', __('Content'));
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
        $form = new Form(new TextContent());

        $form->text('table', __('Table'));
        $form->number('record_id', __('Record id'));
        $form->editormd('content', __('Content'));

        return $form;
    }

    /**
     * 获取关联记录的链接
     */
    public function getRecordUrl($table, $record_id) {
        return route('admin.' . str_replace('_', '-', $table) . '.show', $record_id);
    }
}
