<?php

namespace App\Admin\Controllers;

use App\ClientCar;
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
        $grid = new Grid(new ClientCar());

        $grid->column('id', __('#'));

        $grid->column('model_name', __('Модель'))->display(function () {
            return $this->model->info;
        });

        $grid->column('client_info', __('Клиент'))->display(function () {
            return $this->client->info;
        });

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
        $show = new Show(ClientCar::findOrFail($id));

        $show->field('id', __('#'));
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
    public function form()
    {
        $form = new Form(new ClientCar());

        $clients = Client::all()->keyBy('id');

        $clients = $clients->map(function($m) { return $m->info;});

        $form->select('client_id', 'Клиент')
            ->options($clients);

        $car_models = CarModel::all()->keyBy('id');

        $car_models = $car_models->map(function($m) { return $m->info;});

        $form->select('model_id', 'Модель машины')->options($car_models);

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
