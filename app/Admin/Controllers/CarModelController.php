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
        
        $grid->disableExport();

        $grid->column('id', __('#'));
        $grid->column('manufacturer.name', __('Производитель'));
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
        $carModel = CarModel::findOrFail($id);
        $show = new Show($carModel);

        $show->field('id', __('#'));
        $show->field('name', __('Название'));
        $show->manufacturer(__('Производитель машины'))->as(function ($manufacturer) {
            return $manufacturer->info;
        })->link(route('car-manufacturers.show', $carModel->manufacturer_id));

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

        $form->select('manufacturer_id', 'Производитель')
            ->options(\App\CarManufacturer::all()->pluck('name', 'id'))->rules('required');

        $form->text('name', __('Название'))->rules('required');

        return $form;
    }
}
