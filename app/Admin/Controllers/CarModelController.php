<?php

namespace App\Admin\Controllers;

use App\CarModel;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class CarModelController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Модели';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new CarModel());

        $grid->column('id', __('#'));
        $grid->column('name', __('Название'));
        $grid->column('manufacturer.name', __('Производитель'));

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
        $show = new Show(CarModel::findOrFail($id));

        $show->field('id', __('#'));
        $show->field('name', __('Название'));
        $show->field('manufacturer_id', __('Производитель'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new CarModel());

        $form->text('name', __('Название'));

        $manufacturers =  \App\CarManufacturer::all()->pluck('name', 'id');

        $form->select('manufacturer_id', 'Производитель')->options($manufacturers);

        return $form;
    }
}
