<?php

namespace App\Admin\Controllers;

use App\Work;
use App\CarModel;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\CarManufacturer;
use Encore\Admin\Facades\Admin;
use App\Admin\Actions\Work\Wallbox;
use Encore\Admin\Controllers\AdminController;

class WorkController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Работа';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Work());
        $grid->disableFilter();
        $grid->disableExport();
        $grid->disableRowSelector();
        $grid->disableColumnSelector();

        $wallbox_view = new \App\Admin\Actions\Work\Wallbox();

        $grid->actions(function (Grid\Displayers\Actions $actions) {
            $actions->disableEdit();
        });

        $grid->tools(function (\Encore\Admin\Grid\Tools $tools) use ($wallbox_view) {
            $tools->append($wallbox_view);
        });

        $grid->model()->with('car');
        $grid->model()->orderBy('created_at', 'desc');


        if(!$wallbox_view->isList()) {
            $grid->setView('admin.works.table-to-wallbox');

            $grid->column('work_wall', __('Работа'))->display(function ($model) {
                return view('admin.fields.show.work', ['work' => $this]);
            });
        }

        
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

            /**
             * Поиск по статусу
             */
            $selector->selectOne('status', 'Статус', [
                \App\Work::STATUS_CREATE => 'Не в работе',
                \App\Work::STATUS_START => 'В работе',
                \App\Work::STATUS_READY => 'Закончено',
            ], function ($query, $value) {
                $query->byStatus($value);
            });

        });

        $grid->column('id', __('#'));

        $grid->column('work', __('Работа'))->display(function () {
            return $this->items()['install_or_service'];
        })->expand(function ($work) {
            return view('admin.fields.show.work', compact('work'));
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

        $grid->column('price', __('Цена'))->display(function ($price) {
            return $price;
        });

        $grid->column('prepaid', __('Аванс'))->display(function ($price) {
            return $price;
        });

        $grid->column('created_at', __('Создано'))->display(function ($price) {
            return $this->created_at->format("d.m.Y H:i");
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
        $work = Work::findOrFail($id);

        $show = new Show($work);

        $show->panel()
        ->tools(function ($tools) {
            $tools->disableEdit();
        });

        $show->client(__('Клиент'))->as(function ($client) {
            return $client->info;
        })->link(route('clients.show', $work->client_id));

        $show->car(__('Машина'))->as(function ($car) {
            return $car->info;
        })->link(route('client-cars.show', $work->car_id));

        $show->divider();

        $show->status(__('Сменить статус'))->changeStatus();

            $show->work_json(__('Работа'))->work();

        $show->divider();

        if($work->isInstall()) {
            $show->documents(__('Документы'))->as(function () {
                return "Документы";
            })->link(route('works.documents', $work));
        }

        $show->divider();

        $show->field('price', __('Цена'))->color('#dddddd');
        $show->field('prepaid', __('Аванс'));
        $show->field('additional_information', __('Примечание'));
        $show->field('created_at', __('Создано'));

        if($work->ready_time) {
            $show->field('ready_time', __('Закончено'));
        }

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        // $form = new Form(new Work());

        // $form->number('client_id', __('Client id'));
        // $form->number('car_id', __('Car id'));
        // $form->number('price', __('Price'));
        // $form->number('prepaid', __('Prepaid'));
        // $form->textarea('additional_information', __('Additional information'));

        // return $form;
        $steps = [
            'client' => \App\Admin\Forms\Work\ClientForm::class,
            'car' => \App\Admin\Forms\Work\CarForm::class,
            'work' => \App\Admin\Forms\Work\WorkForm::class,
        ];


        return \Encore\Admin\Widgets\MultipleSteps::make($steps);
    }
}
