<?php

namespace App\Admin\Controllers;

use App\Car;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class CarController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Машины клиентов';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Car());

        $grid->column('id', __('#'));
        $grid->column('manufacturer_id', __('Manufacturer id'));
        $grid->column('model_id', __('Model id'));
        $grid->column('client_id', __('Client id'));
        $grid->column('year_manufacture', __('Year manufacture'));
        $grid->column('cylinders', __('Cylinders'));
        $grid->column('vin', __('Vin'));
        $grid->column('government_number', __('Government number'));
        $grid->column('body_number', __('Body number'));
        $grid->column('chassis', __('Chassis'));
        $grid->column('data_sheet', __('Data sheet'));
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
        $show = new Show(Car::findOrFail($id));

        $show->field('id', __('#'));
        $show->field('manufacturer_id', __('Manufacturer id'));
        $show->field('model_id', __('Model id'));
        $show->field('client_id', __('Client id'));
        $show->field('year_manufacture', __('Year manufacture'));
        $show->field('cylinders', __('Cylinders'));
        $show->field('vin', __('Vin'));
        $show->field('government_number', __('Government number'));
        $show->field('body_number', __('Body number'));
        $show->field('chassis', __('Chassis'));
        $show->field('data_sheet', __('Data sheet'));
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
        $form = new Form(new Car());

        $form->number('manufacturer_id', __('Manufacturer id'));
        $form->number('model_id', __('Model id'));
        $form->number('client_id', __('Client id'));
        $form->number('year_manufacture', __('Year manufacture'));
        $form->number('cylinders', __('Cylinders'));
        $form->text('vin', __('Vin'));
        $form->text('government_number', __('Government number'));
        $form->text('body_number', __('Body number'));
        $form->text('chassis', __('Chassis'));
        $form->text('data_sheet', __('Data sheet'));

        return $form;
    }
}
