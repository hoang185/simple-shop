<?php

namespace App\Admin\Controllers;

use App\Models\Order;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class OrderController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Order';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Order());

        $grid->column('order_code', __('Order code'));
        $grid->column('customer_name', __('Customer name'));
        $grid->column('phone', __('Phone'));
        $grid->column('send_mail', __('Send mail'));
        $grid->column('date', __('Date'));
        $grid->column('email', __('Email'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));
        $grid->column('city', __('City'));
        $grid->column('district', __('District'));
        $grid->column('village', __('Village'));
        $grid->column('address', __('Address'));
        $grid->column('detail', __('Detail'));
        $grid->column('total_bill', __('Total bill'));
        $grid->column('id', __('Id'));
        $grid->column('payment_method', __('Payment method'));
        $grid->column('payment_status', __('Payment status'));

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
        $show = new Show(Order::findOrFail($id));

        $show->field('order_code', __('Order code'));
        $show->field('customer_name', __('Customer name'));
        $show->field('phone', __('Phone'));
        $show->field('send_mail', __('Send mail'));
        $show->field('date', __('Date'));
        $show->field('email', __('Email'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        $show->field('city', __('City'));
        $show->field('district', __('District'));
        $show->field('village', __('Village'));
        $show->field('address', __('Address'));
        $show->field('detail', __('Detail'));
        $show->field('total_bill', __('Total bill'));
        $show->field('id', __('Id'));
        $show->field('payment_method', __('Payment method'));
        $show->field('payment_status', __('Payment status'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Order());

        $form->text('order_code', __('Order code'));
        $form->text('customer_name', __('Customer name'));
        $form->number('phone', __('Phone'));
        $form->text('send_mail', __('Send mail'));
        $form->date('date', __('Date'))->default(date('Y-m-d'));
        $form->email('email', __('Email'));
        $form->text('city', __('City'));
        $form->text('district', __('District'));
        $form->text('village', __('Village'));
        $form->text('address', __('Address'));
        $form->text('detail', __('Detail'));
        $form->text('total_bill', __('Total bill'));
        $form->text('payment_method', __('Payment method'));
        $form->text('payment_status', __('Payment status'));

        return $form;
    }
}
