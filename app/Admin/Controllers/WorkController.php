<?php

namespace App\Admin\Controllers;

use App\Work;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

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

        $grid->actions(function (Grid\Displayers\Actions $actions) {
            $actions->disableEdit();
        });
        
        $grid->column('work', __('Работа'))->display(function ($model) {
            return $this->items()['install_or_service'];
        })->expand(function ($model) {
            $work = $model;

            return view('admin.fields.show.work', compact('work'));
        });

        $grid->column('client', __('Клиент'))->display(function ($client) {
            return $this->client->info;
        });

        $grid->column('car', __('Машина'))->display(function ($car) {
            return $this->car->info;
        });

        $grid->column('price', __('Цена'))->display(function ($price) {
            return $price.' тг.';
        });

        $grid->column('prepaid', __('Аванс'))->display(function ($price) {
            return $price.' тг.';
        });

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

        $show->work_json(__('Работа'))->work();

        $show->divider();

        $show->field('price', __('Цена'))->color('#dddddd');
        $show->field('prepaid', __('Аванс'));
        $show->field('additional_information', __('Примечание'));
        $show->field('created_at', __('Создано'));

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
