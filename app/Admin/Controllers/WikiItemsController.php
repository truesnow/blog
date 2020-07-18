<?php

namespace App\Admin\Controllers;

use App\Models\TextContent;
use App\Models\WikiCate;
use App\Models\WikiItem;
use App\Models\WikiSubject;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use DB;

class WikiItemsController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'wiki资源管理';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new WikiItem());

        $grid->column('id', __('Id'))->sortable();
        $grid->column('subject_id', __('Subject id'))->select(WikiSubject::getFieldMap('id', 'name'));
        $grid->column('cate_id', __('Cate id'))->select(WikiCate::getFieldMap('id', 'name'));
        $grid->column('name', __('Name'));
        $grid->column('desc', __('Desc'));
        $grid->column('url', __('Url'))->link()->copyable();
        $grid->column('content_id', __('Content id'))->display(function () {
            $link = route('admin.text-contents.show', $this->content_id);
            return "<a href='{$link}'>{$this->content_id}</a>";
        })->sortable();
        $grid->column('ordinal', __('Ordinal'))->editable()->sortable();
        $grid->column('enable_status', __('Enable status'))->switch();
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

        $grid->filter(function($filter){
            $filter->equal('subject_id', __('Subject id'))->select(WikiSubject::getFieldMap('id', 'name'));
            $filter->equal('cate_id', __('Cate id'))->select(WikiCate::getFieldMap('id', 'name'));
            $filter->like('name', __('Name'));
            $filter->equal('content_id', __('Content id'));
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
        $wikiItem = WikiItem::findOrFail($id);
        $show = new Show($wikiItem);

        $show->field('id', __('Id'));
        $show->field('subject_id', __('Subject id'))->using(WikiSubject::getFieldMap('id', 'name'));
        $show->field('cate_id', __('Cate id'))->using(WikiCate::getFieldMap('id', 'name'));
        $show->field('name', __('Name'));
        $show->field('desc', __('Desc'));
        $show->field('url', __('Url'));
        $show->field('content_id', __('Content id'))->unescape()->as(function ($content_id) {
            $link = route('admin.text-contents.show', $content_id);
            return "<a href='{$link}'>{$content_id}</a>";
        });
        $show->field('ordinal', __('Ordinal'));
        $show->field('enable_status', __('Enable status'))
            ->using(ENABLE_STATUS_MAP)
            ->label($wikiItem->enable_status == ENABLED ? 'success' : 'warning');;
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
        $form = new Form(new WikiItem());

        $form->select('subject_id', __('Subject id'))->options(WikiSubject::getFieldMap('id', 'name'));
        $form->select('cate_id', __('Cate id'))->options(WikiCate::getFieldMap('id', 'name'));
        $form->text('name', __('Name'));
        $form->text('desc', __('Desc'))->default('');
        $form->url('url', __('Url'));
        $form->number('content_id', __('Content id'));
        $form->number('ordinal', __('Ordinal'))->default(100);
        $form->switch('enable_status', __('Enable status'))->default(1);

        return $form;
    }

}
