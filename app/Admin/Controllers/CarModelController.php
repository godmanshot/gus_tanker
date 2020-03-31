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
    protected $title = 'Справочник машин';

    public function index(\Encore\Admin\Layout\Content $content)
    {
        return $content
            ->title($this->title())
            ->description($this->description['index'] ?? trans('admin.list'))
            ->row((new \Encore\Admin\Widgets\Box('Внимание', 'Все созданные модели машин будут добавлены к стандартному справочнику машин'))->style('info')->removable())
            ->body($this->grid());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new CarModel());

        $grid->model()->whereNotNull('service_station_id');
        
        $grid->disableExport();

        $grid->column('id', __('#'));
        $grid->column('manufacturer.name', __('Производитель'));
        $grid->column('name', __('Название'));
        $grid->column('modification', __('Модификация'));

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
        $show->manufacturer(__('Производитель машины'))->as(function ($manufacturer) {
            return $manufacturer->info;
        });
        $show->field('name', __('Название'));
        $show->field('modification', __('Модификация'));

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

        $form->text('modification', __('Модификация'));

        $form->hidden('service_station_id');

        $form->saving(function (Form $form) {
            $form->service_station_id = station()->id;
        });

        return $form;
    }
}
