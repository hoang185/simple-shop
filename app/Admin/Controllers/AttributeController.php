<?php

namespace App\Admin\Controllers;

use App\Models\Attribute;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class AttributeController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Attribute';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Attribute());

        $grid->column('id', __('Id'));
        $grid->column('product_id', __('Product id'));
        $grid->column('product_color_id', __('Product color id'));
        $grid->column('status', __('Status'));
        $grid->column('color_thumb', __('Color thumb'));
        $grid->column('image_1', __('Image 1'));
        $grid->column('image_2', __('Image 2'));
        $grid->column('image_3', __('Image 3'));
        $grid->column('image_4', __('Image 4'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

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
        $show = new Show(Attribute::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('product_id', __('Product id'));
        $show->field('product_color_id', __('Product color id'));
        $show->field('status', __('Status'));
        $show->field('color_thumb', __('Color thumb'));
        $show->field('image_1', __('Image 1'));
        $show->field('image_2', __('Image 2'));
        $show->field('image_3', __('Image 3'));
        $show->field('image_4', __('Image 4'));
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
        $form = new Form(new Attribute());

        $form->number('product_id', __('Product id'));
        $form->number('product_color_id', __('Product color id'));
        $form->number('status', __('Status'));
        $form->text('color_thumb', __('Color thumb'));
        $form->text('image_1', __('Image 1'));
        $form->text('image_2', __('Image 2'));
        $form->text('image_3', __('Image 3'));
        $form->text('image_4', __('Image 4'));

        return $form;
    }
}
