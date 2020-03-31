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
        
        $grid->disableExport();

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

        $grid->column('created_at', __('Создано'))->display(function ($price) {
            return $this->created_at->format("d.m.Y");
        });

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
        $clientCar = ClientCar::findOrFail($id);
        $show = new Show($clientCar);

        $show->field('id', __('#'));
        
        $show->model(__('Модель машины'))->as(function ($model) {
            return $model->info;
        })->link(route('car-models.show', $clientCar->model_id));

        $show->client(__('Клиент'))->as(function ($client) {
            return $client->info;
        })->link(route('clients.show', $clientCar->client_id));

        $show->field('year_manufacture', __('Год выпуска'));
        $show->field('cylinders', __('Кол. цилиндров'));
        $show->field('vin', __('VIN'));
        $show->field('government_number', __('Гос. номер'));
        $show->field('body_number', __('Номер кузова'));
        $show->field('chassis', __('Шасси'));
        $show->field('data_sheet', __('Тех. пасспорт'));
        $show->field('equipment', __('Комплектация АТС'))->using([1 => 'Полная', 0 => 'Не полная']);
        $show->field('state', __('Техническое состояние АТС'))->using([1 => 'Норм', 0 => 'Не норм']);
        $show->field('auto_length', __('Пробег в км.'));
        $show->field('created_at', __('Создан'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    public function form($need_require = true)
    {
        $form = new Form(new ClientCar());

        $clients = Client::all()->keyBy('id');

        $clients = $clients->map(function($m) { return $m->info;});

        $form->select('client_id', 'Клиент')
            ->options($clients)->rules($need_require ? 'required' : '');

        $car_models = CarModel::all()->keyBy('id');

        $car_models = $car_models->map(function($m) { return $m->info;});

        $form->select('model_id', 'Модель машины')->options($car_models)->rules($need_require ? 'required' : '');

        $form->date('year_manufacture', __('Год выпуска'))->placeholder(__('Год выпуска'))->icon(false)->format('YYYY')->width('200px')->rules($need_require ? 'required' : '');
        $form->radio('cylinders', __('Кол. цилиндров'))->options(['4' => '4 цилиндров', '8'=> '8 цилиндров'])->default('4')->rules($need_require ? 'required' : '');
        $form->text('vin', __('VIN'))->placeholder(__('VIN'))->inputmask(['mask' => '*****************', 'clearIncomplete' => true])->help('Заполните 17 символов VIN номера или оставьте поле пустым')->rules('nullable|min:17');
        $form->text('government_number', __('Гос. номер'))->placeholder(__('Гос. номер'))->rules($need_require ? 'required' : '');
        $form->text('body_number', __('Номер кузова'))->placeholder(__('Номер кузова'))->rules($need_require ? 'required' : '');
        $form->text('chassis', __('Шасси'))->placeholder(__('Шасси'))->rules($need_require ? 'required' : '');
        $form->text('data_sheet', __('Тех. пасспорт'))->placeholder(__('Тех. пасспорт'))->rules($need_require ? 'required' : '');
        $form->radio('equipment', __('Комплектация АТС'))->placeholder(__('Комплектация АТС'))->options([1 => 'Полная', 0 => 'Не полная'])->default(1)->rules($need_require ? 'required' : '');
        $form->radio('state', __('Техническое состояние АТС'))->placeholder(__('Техническое состояние АТС'))->options([1 => 'Норм', 0 => 'Не норм'])->default(1)->rules($need_require ? 'required' : '');
        $form->number('auto_length', __('Пробег в км.'))->placeholder(__('Пробег в км.'))->rules($need_require ? 'required' : '');
        
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
