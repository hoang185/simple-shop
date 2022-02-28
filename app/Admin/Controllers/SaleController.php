<?php

namespace App\Admin\Controllers;

use App\Models\Sale;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class SaleController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Sale';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Sale());

        $grid->column('id', __('Id'));
        $grid->column('sale_price', __('Sale price'));
        $grid->column('ship_price', __('Ship price'));

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
        $show = new Show(Sale::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('sale_price', __('Sale price'));
        $show->field('ship_price', __('Ship price'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Sale());

        $form->number('sale_price', __('Sale price'));
        $form->number('ship_price', __('Ship price'));

        return $form;
    }
}
