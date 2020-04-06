<?php

namespace App\Admin\Controllers;

use Encore\Admin\Form;
use Illuminate\Http\Request;
use Encore\Admin\Controllers\AuthController as BaseAuthController;

class AuthController extends BaseAuthController
{
    public function register(Request $request)
    {
        if ($this->guard()->check()) {
            return redirect($this->redirectPath());
        }

        return view('admin.auth.register', ['form' => $this->form()]);
    }

    public function store(Request $request)
    {
        return $this->form()->store();
    }

    public function form()
    {
        $form = new Form(new \Encore\Admin\Auth\Database\Administrator);
        $form->setView('admin.auth.register-form');
        $form->setAction(admin_url('/auth/register'));

        $form->text('username', __('Логин'))->placeholder(__('Логин'))->setWidth(8, 4)->icon('fa-user')->autofocus()
            ->rules('required|unique:admin_users', ['unique' => 'Такой пользователь уже существует']);

        $form->password('password', __('Пароль'))->placeholder(__('Пароль'))->setWidth(8, 4)
            ->rules('required|min:6|confirmed', ['confirmed' => 'Пароли не совпадают', 'min' => 'Минимум 6 символов']);

        $form->password('password_confirmation', __('Повтор пароля'))->placeholder(__('Повтор пароля'))->setWidth(8, 4)
            ->rules('required');

        $form->hidden('name');

        $form->submitted(function (Form $form) {
            $form->ignore('password_confirmation');
        });

        $form->saving(function (Form $form) {
            $form->name = $form->username;
            $form->password = \Illuminate\Support\Facades\Hash::make($form->password);
        });

        $form->saved(function (Form $form) {
            $roleModel = config('admin.database.roles_model');

            $form->model()->roles()->attach($roleModel::where('id', 2)->get());
            \App\ServiceStationUser::create(['service_station_id' => $this->createStation()->id, 'user_id' => $form->model()->id]);
            
            admin_toastr(__('Регистрация прошла успешно!'), 'success');

            return redirect('/admin');
        });
        
        return $form;
    }

    public function createStation()
    {
        return \App\ServiceStation::create([
            'name' => 'Газамир-ПРО',
            'full_name' => 'ТОО «Газамир-ПРО»',
            'id_of_company' => 'СТ ТОО 40324310-027-2008',
            'boss_otk' => 'Баситов Р.Т.',
            'phone' => '+77077777777',
            'address' => 'Джандосова 189',
            'currency' => 'тг.',
            'timezone' => '+6',
            'warranty_exp_month' => 24,
            'warranty_exp_lenght' => 40,
            'to_period' => 10,
            'city_name' => 'Алматы',
            'response_person' => 'Ли Максим Владиславович',
            'warranty_text' => '',
            'balance' => 100,
            'created_at' => NULL,
            'updated_at' => NULL,
        ]);
    }
}
