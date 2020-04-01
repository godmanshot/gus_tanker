<?php

namespace App\Admin\Controllers;

use App\ServiceStation;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class StationController extends AdminController
{
    protected $title = 'СТО';

    public function index(\Encore\Admin\Layout\Content $content)
    {
        return redirect()->route('service-stations.edit', station());
    }

    public function show($id, \Encore\Admin\Layout\Content $content)
    {
        return abort(404);
    }

    public function edit($id, \Encore\Admin\Layout\Content $content)
    {
        if($id != station()->id) {
            abort(404);
        }

        return $content
            ->title($this->title())
            ->description($this->description['edit'] ?? trans('admin.edit'))
            ->body($this->form()->edit($id));
    }
    
    protected function form()
    {
        $station = station();

        $form = new Form(new ServiceStation());
        
        $form->text('name', __('Название'))->help('Газамир-ПРО')->rules('required');
        $form->text('full_name', __('Полное название'))->help('Например: ТОО «Газамир-ПРО»')->rules('required');
        $form->text('id_of_company', __('Регистрационный номер'))->rules('required');
        $form->text('сertificate_install', __('Свидетельство о согласовании конструкции'))->rules('required');
        $form->text('boss_otk', __('Название'))->rules('required');

        $form->image('image', __('Логотип'))->removable();
        $form->mobile('phone', __('Телефон в международном формате'))->help('Например: 77071234567')->rules('required');
        $form->text('city_name', __('Город'))->rules('required');
        $form->text('address', __('Адрес'))->rules('required');
        $form->text('currency', __('Валюта'))->help('Например: тг. или руб.')->rules('required');
        $form->text('response_person', __('ФИО ответственного'))->rules('required');
        $form->select('to_period', __('Период тех. осмотра'))->options([10 => '10 тыс. км.', 15 => '15 тыс. км.'])->rules('required');
        $form->number('warranty_exp_month', __('Истечение гарантии, срок в месяцах'))->rules('required');
        $form->number('warranty_exp_lenght', __('Истечение гарантии, срок в тыс. км.'))->rules('required');
        $form->editor('warranty_text', __('Текс гарантии'))->rules('required');
        $form->multipleFile('files', __('Документы'))->removable()->move('stations/'.$station->id)->help("Загруженные документы будут поставлятся с пакетом документов выполненных работ");

        $form->footer(function ($footer) {
        
            $footer->disableViewCheck();
            // $footer->disableEditingCheck();
            $footer->disableCreatingCheck();
            $footer->checkEditing();
        
        });

        return $form;
    }
}
