<?php

namespace App\Admin\Controllers;

use App\Client;
use App\ServiceStation;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ClientController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Клиенты';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Client());
        
        $grid->disableExport();

        $grid->column('id', __('#'));
        $grid->column('first_name', __('Имя'));
        $grid->column('last_name', __('Фамилия'));
        $grid->column('iin', __('ИИН'));
        $grid->column('phone', __('Телефон'));
        $grid->column('address', __('Адрес'));
        $grid->column('created_at', __('Создан'))->date('Y-m-d h:m');

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
        $show = new Show(Client::findOrFail($id));

        $show->field('id', __('#'));
        $show->field('first_name', __('Имя'));
        $show->field('last_name', __('Фамилия'));
        $show->field('iin', __('ИИН'));
        $show->field('phone', __('Телефон'));
        $show->field('address', __('Адрес'));
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
        $form = new Form(new Client());

        $form->text('first_name', __('Имя'))->rules($need_require ? 'required' : '');
        $form->text('last_name', __('Фамилия'))->rules($need_require ? 'required' : '');
        $form->text('iin', __('ИИН'))->rules($need_require ? 'required' : '');
        $form->mobile('phone', __('Телефон'))->help('Например: 77071234567')->rules($need_require ? 'required' : '');
        $form->text('address', __('Адрес'))->rules($need_require ? 'required' : '');
        // ->options(['mask' => '+7 999 9999999'])
        return $form;
    }
}
