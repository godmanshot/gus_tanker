<?php

namespace App\Admin\Controllers;

use App\ServiceStation;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class StationController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'СТО';

    public function index(\Encore\Admin\Layout\Content $content)
    {

        $station = station();

        return $content
            ->title($this->title())
            ->description($this->description['index'] ?? trans('admin.list'))
            ->body($this->form()->edit($station->id));
    }
    
    protected function form()
    {
        $station = station();

        $form = new Form(new ServiceStation());
        
        $form->setAction('service-stations/'.$station->id);

        $form->text('name', __('Название'))->help('Газамир-ПРО')->rules('required');
        $form->text('full_name', __('Полное название'))->help('Например: ТОО «Газамир-ПРО»')->rules('required');
        $form->text('id_of_company', __('Регистрационный номер'))->rules('required');
        $form->text('сertificate_install', __('Свидетельство о согласовании конструкции'))->rules('required');
        $form->text('boss_otk', __('Название'))->rules('required');

        $form->image('image', __('Логотип'))->rules('required');
        $form->mobile('phone', __('Телефон в международном формате'))->help('Например: 77071234567')->rules('required');
        $form->text('city_name', __('Город'))->rules('required');
        $form->text('address', __('Адрес'))->rules('required');
        $form->text('currency', __('Валюта'))->help('Например: тг. или руб.')->rules('required');
        $form->text('response_person', __('ФИО ответственного'))->rules('required');
        // $form->text('timezone', __('Timezone'))->rules('required');
        $form->select('to_period', __('Период тех. осмотра'))->options([10 => '10 тыс. км.', 15 => '15 тыс. км.'])->rules('required');
        $form->number('warranty_exp_month', __('Истечение гарантии, срок в месяцах'))->rules('required');
        $form->number('warranty_exp_lenght', __('Истечение гарантии, срок в тыс. км.'))->rules('required');
        $form->editor('warranty_text', __('Текс гарантии'))->rules('required');

        $form->footer(function ($footer) {
        
            // $footer->disableReset();
            $footer->disableViewCheck();
            $footer->disableEditingCheck();
            $footer->disableCreatingCheck();
        
        });

        return $form;
    }
}
