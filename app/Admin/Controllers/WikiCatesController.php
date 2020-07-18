<?php

namespace App\Admin\Controllers;

use App\Models\WikiCate;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class WikiCatesController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'wiki资源分类';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new WikiCate());

        $grid->column('id', __('Id'))->sortable();
        $grid->column('name', __('Name'));
        $grid->column('desc', __('Desc'));
        $grid->column('resource_type', __('Resource type'))->using(WikiCate::RESOURCE_TYPE_MAP);
        $grid->column('ordinal', __('Ordinal'))->sortable()->editable();
        $grid->column('enable_status', __('Enable status'))->switch();
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

        $grid->filter(function ($filter) {
            $filter->like('name', __('Name'));
            $filter->equal('resource_type', __('Resource type'))->select(WikiCate::RESOURCE_TYPE_MAP);
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
        $wikiCate = WikiCate::findOrFail($id);
        $show = new Show($wikiCate);

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('desc', __('Desc'));
        $show->field('resource_type', __('Resource type'))->using(WikiCate::RESOURCE_TYPE_MAP);
        $show->field('ordinal', __('Ordinal'));
        $show->field('enable_status', __('Enable status'))
            ->using(ENABLE_STATUS_MAP)
            ->label($wikiCate->enable_status == ENABLED ? 'success' : 'warning');;
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
        $form = new Form(new WikiCate());

        $form->text('name', __('Name'));
        $form->text('desc', __('Desc'))->default('');
        $form->select('resource_type', __('Resource type'))->options(WikiCate::RESOURCE_TYPE_MAP);
        $form->number('ordinal', __('Ordinal'))->default(100);
        $form->switch('enable_status', __('Enable status'))->default(1);

        return $form;
    }
}
