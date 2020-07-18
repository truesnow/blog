<?php

namespace App\Admin\Controllers;

use App\Models\WikiSubject;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class WikiSubjectsController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'wiki主题';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new WikiSubject());

        $grid->column('id', __('Id'))->sortable();
        $grid->column('name', __('Name'))->sortable();
        $grid->column('desc', __('Desc'));
        $grid->column('cover', __('Cover'))->image();
        $grid->column('ordinal', __('Ordinal'))->sortable()->editable();
        $grid->column('enable_status', __('Enable status'))->switch();
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

        $grid->filter(function ($filter) {
            $filter->like('name', __('Name'));
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
        $wikiSubject = WikiSubject::findOrFail($id);
        $show = new Show($wikiSubject);

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('desc', __('Desc'));
        $show->field('cover', __('Cover'))->image();
        $show->field('ordinal', __('Ordinal'));
        $show->field('enable_status', __('Enable status'))
            ->using(ENABLE_STATUS_MAP)
            ->label($wikiSubject->enable_status == ENABLED ? 'success' : 'warning');
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
        $form = new Form(new WikiSubject());

        $form->text('name', __('Name'));
        $form->text('desc', __('Desc'));
        $form->image('cover', __('Cover'))->move('/images/wikis/subjects/' . date('Ym'));
        $form->number('ordinal', __('Ordinal'))->default(100);
        $form->switch('enable_status', __('Enable status'))->default(1);

        return $form;
    }
}
