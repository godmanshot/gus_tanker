<?php

namespace App\Admin\Controllers;

use App\Car;
use App\Client;
use App\CarModel;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Admin\Controllers\ClientController;
use Encore\Admin\Controllers\AdminController;

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
        $grid->column('manufacturer_id', __('Производитель'));
        $grid->column('model_id', __('Модель'));
        $grid->column('client_id', __('Клиент'));
        $grid->column('year_manufacture', __('Год выпуска'));
        $grid->column('cylinders', __('Кол. цилиндров'));
        $grid->column('vin', __('VIN'));
        $grid->column('government_number', __('Гос. номер'));
        $grid->column('body_number', __('Номер кузова'));
        $grid->column('chassis', __('Шасси'));
        $grid->column('data_sheet', __('Тех. пасспорт'));
        $grid->column('created_at', __('Создан'));

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
        $show->field('manufacturer_id', __('Производитель'));
        $show->field('model_id', __('Модель'));
        $show->field('client_id', __('Клиент'));
        $show->field('year_manufacture', __('Год выпуска'));
        $show->field('cylinders', __('Кол. цилиндров'));
        $show->field('vin', __('VIN'));
        $show->field('government_number', __('Гос. номер'));
        $show->field('body_number', __('Номер кузова'));
        $show->field('chassis', __('Шасси'));
        $show->field('data_sheet', __('Тех. пасспорт'));
        $show->field('created_at', __('Создан'));

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

        $clients = Client::all()->keyBy('id');

        $clients = $clients->map(function($m) { return $m->last_name.' '.$m->first_name.' '.$m->phone;});

        $form->select('client_id', 'Клиент')
            ->options($clients);

        $form->select('model_id', 'Модель машины')
            ->options(CarModel::all()->pluck('name', 'id'));

        $form->date('year_manufacture', __('Год выпуска'))->placeholder(__('Год выпуска'))->icon(false)->format('YYYY')->width('200px');
        $form->radio('cylinders', __('Кол. цилиндров'))->options(['4' => '4 цилиндров', '8'=> '8 цилиндров'])->default('4');
        $form->text('vin', __('VIN'))->placeholder(__('VIN'));
        $form->text('government_number', __('Гос. номер'))->placeholder(__('Гос. номер'));
        $form->text('body_number', __('Номер кузова'))->placeholder(__('Номер кузова'));
        $form->text('chassis', __('Шасси'))->placeholder(__('Шасси'));
        $form->text('data_sheet', __('Тех. пасспорт'))->placeholder(__('Тех. пасспорт'));

        // $f = $this->clientForm();

        // $form->html($f->render());

        $form->disableEditingCheck();
        
        $form->disableViewCheck();
        return $form;
    }

    public function clientForm()
    {
        $form = (new ClientController)->form();

        return $form;
    }
}
