<?php

namespace App\Admin\Controllers;

use App\Work;
use App\Client;
use App\CarModel;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\TechInspection;
use App\CarManufacturer;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Layout\Content;

class TechInspectionController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Тех. обслуживание';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new TechInspection());
        
        $grid->disableExport();
        
        $grid->selector(function (\Encore\Admin\Grid\Tools\Selector $selector) {
            $items = $selector->parseSelected();
            $manufacturers = CarManufacturer::get()->keyBy('id')->pluck('name', 'id');
            $selector->manufacturers = $manufacturers;
            Admin::style('.grid-selector .select-label {line-height: 2rem;}');

            if(!empty($items['manufacturer'])) {
                $models = CarModel::where('manufacturer_id', $items['manufacturer'][0])->get()->keyBy('id')->pluck('name', 'id');
            } else {
                $models = CarModel::get()->keyBy('id')->pluck('name', 'id');
            }

            /**
             * Поиск по производителю
             */
            $selector->selectOne('manufacturer', 'Производитель', $manufacturers, function ($query, $value) {
                $query->byManufacturer($value);
            });

            if(!empty($items['manufacturer'])) {
                /**
                 * Поиск по моделям
                 */
                $selector->selectOne('model', 'Модель', $models, function ($query, $value) use ($items) {
                    if(CarManufacturer::find($items['manufacturer'][0])->where('id', $items['manufacturer'][0])->byModel($value)->get()->count()) {
                        $query->byModel($value);
                    }
                });
            }

            /**
             * Поиск по цилиндрам
             */
            $selector->selectOne('cylinders', 'Кол. цилиндров', [
                4 => '4 цилиндра',
                8 => '8 цилиндров',
            ], function ($query, $value) {
                $query->byCylinders($value);
            });

        });

        $grid->column('client', __('Клиент'))->display(function () {
            return $this->client->info;
        });
        
        $grid->column('government_number', __('Гос. номер'))->display(function () {
            return $this->car->government_number;
        });

        $grid->column('car', __('Машина'))->display(function ($car) {
            return $this->car->info;
        });

        $grid->column('number_ti', __('Номер ТО'));
        $grid->column('comment', __('Заметка'))->limit(20)->ucfirst();
        $grid->column('time_ti', __('Время ТО'));

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
        $techInspection = TechInspection::findOrFail($id);
        $show = new Show($techInspection);

        $show->client(__('Клиент'))->as(function ($client) {
            return $client->info;
        })->link(route('clients.show', $techInspection->client_id));

        $show->car(__('Машина'))->as(function ($car) {
            return $car->info;
        })->link(route('client-cars.show', $techInspection->car_id));

        $show->field('number_ti', __('Номер ТО'));
        $show->field('comment', __('Заметка'));
        $show->field('time_ti', __('Time ti'));
        $show->field('car_id', __('Car id'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    public function edit($id, Content $content)
    {
        return $content
            ->title($this->title())
            ->description($this->description['edit'] ?? trans('admin.edit'))
            ->body($this->form($id)->edit($id));
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form($tech_inspection_id = null)
    {
        $techInspection = TechInspection::find($tech_inspection_id);
        $form = new Form(new TechInspection());


        $clients = Client::all()->keyBy('id')->map(function($m) { return $m->info;});

        $form->select('client_id', 'Клиент')->options($clients)->rules('required')->load('car_id', url('/admin/api/client-cars/by-client'));

        if(isset($techInspection)) {
            $client = Client::find($techInspection->client_id);
            $cars = $client->cars->keyBy('id')->map(function($m) { return $m->info;});
        } else {
            $cars = [];
        }

        $form->select('car_id', 'Машина клиента')->options($cars)->rules('required');
        
        $form->number('number_ti', __('Номер ТО'))->default(1)->rules('required');
        $form->textarea('comment', __('Заметка'))->rules('required');
        $form->datetime('time_ti', __('Время ТО'))->default(date('Y-m-d H:i:s'))->rules('required');

        $form->footer(function ($footer) {
        
            $footer->disableViewCheck();
        
        });

        return $form;
    }
}
