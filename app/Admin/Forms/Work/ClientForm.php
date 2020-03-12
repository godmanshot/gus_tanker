<?php

namespace App\Admin\Forms\Work;

use App\Client;
use Illuminate\Http\Request;
use Encore\Admin\Widgets\Form;
use Encore\Admin\Widgets\StepForm;

class ClientForm extends StepForm
{
    /**
     * The form title.
     *
     * @var string
     */
    public $title = 'Шаг 1: Заполните нового клиента или выберите из списка';

    /**
     * Handle the form request.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request)
    {
        return $this->next($request->all());
    }

    /**
     * Build a form here.
     */
    public function form()
    {

        $this->divider('Клиент из базы');

        $this->select('client_id', __('Клиент'))->config('placeholder', 'Введите имя, фамилию или номер телефона')->options(function ($id) {
            $client = Client::find($id);
        
            if ($client) {
                return [$client->id => $client->info];
            }
        })->ajax(url('/admin/api/clients'));

        $this->divider('Новый клиент');

        $fields = $this->clientFormField();

        foreach($fields as $field) {
            $this->pushField($field);
        }

    }

    public function clientFormField()
    {
        $form = (new \App\Admin\Controllers\ClientController)->form();

        return $form->builder()->fields();
    }
}
