<?php

namespace App\Admin\Controllers;

use App\Models\Product;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ProductController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Product';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Product());

        $grid->column('id', __('Id'));
        $grid->column('cat_id', __('Cat id'));
        $grid->column('type', __('Type'));
        $grid->column('name', __('Name'));
        $grid->column('image', __('Image'));
        $grid->column('price', __('Price'));
        $grid->column('quantity', __('Quantity'));
        $grid->column('product_sale', __('Product sale'));
        $grid->column('product_new', __('Product new'));
        $grid->column('product_best', __('Product best'));
        $grid->column('updated_at', __('Updated at'));
        $grid->column('created_at', __('Created at'));
        $grid->column('namevi', __('Namevi'));
        $grid->column('size', __('Size'));
        $grid->column('sale_price', __('Sale price'));

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
        $show = new Show(Product::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('cat_id', __('Cat id'));
        $show->field('type', __('Type'));
        $show->field('name', __('Name'));
        $show->field('image', __('Image'));
        $show->field('price', __('Price'));
        $show->field('quantity', __('Quantity'));
        $show->field('product_sale', __('Product sale'));
        $show->field('product_new', __('Product new'));
        $show->field('product_best', __('Product best'));
        $show->field('updated_at', __('Updated at'));
        $show->field('created_at', __('Created at'));
        $show->field('namevi', __('Namevi'));
        $show->field('size', __('Size'));
        $show->field('sale_price', __('Sale price'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Product());

        $form->number('cat_id', __('Cat id'));
        $form->number('type', __('Type'));
        $form->text('name', __('Name'));
        $form->image('image', __('Image'));
        $form->number('price', __('Price'));
        $form->number('quantity', __('Quantity'));
        $form->text('product_sale', __('Product sale'));
        $form->text('product_new', __('Product new'));
        $form->text('product_best', __('Product best'));
        $form->text('namevi', __('Namevi'));
        $form->text('size', __('Size'));
        $form->number('sale_price', __('Sale price'));

        return $form;
    }
}
