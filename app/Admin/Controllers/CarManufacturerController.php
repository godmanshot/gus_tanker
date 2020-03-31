<?php

namespace App\Admin\Controllers;

use App\CarManufacturer;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class CarManufacturerController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Производители';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new CarManufacturer());
        
        $grid->disableExport();

        $grid->column('id', __('#'));
        $grid->column('name', __('Название'));

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
        $show = new Show(CarManufacturer::findOrFail($id));

        $show->field('id', __('#'));
        $show->field('name', __('Название'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new CarManufacturer());

        $form->text('name', __('Название'))->rules('required');

        return $form;
    }
}
