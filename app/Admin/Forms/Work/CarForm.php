<?php

namespace App\Admin\Forms\Work;

use App\ClientCar;
use App\Client;
use Illuminate\Http\Request;
use Encore\Admin\Widgets\Form;
use Encore\Admin\Widgets\StepForm;

class CarForm extends StepForm
{
    public $title = 'Машина';



    public function handle(Request $request)
    {
        if($request->filled('model_id')) {
            $model = ClientCar::create($request->all());
        } elseif($request->filled('car_id')) {
            $model = ClientCar::find($request->car_id);
        }

        return $this->next(['car' => $model]);
    }



    public function form()
    {

        $this->divider('Машина клиента из базы');

        $clients = Client::all()->keyBy('id')->map(function($m) { return $m->info;});

        $this->select('client_id', 'Клиент')->options($clients)->load('car_id', url('/admin/api/client-cars/by-client'));

        if(isset($this->data()['client_id'])) {
            $client = Client::find($this->data()['client_id']);
            $cars = $client->cars->keyBy('id')->map(function($m) { return $m->info;});
        } else {
            $cars = [];
        }

        $this->select('car_id', 'Машина клиента')->options($cars);

        $this->divider('Создать новую машину клиента');

        foreach($this->clientFormField() as $field) {
            $field->rules("required_without_all:car_id", ['required_without_all' => "Заполните все данные или выберите машину клиента из базы"]);
            $this->pushField($field);
        }
    }



    public function data()
    {
        $client_id = $this->all()['client']['client']->id;

        return [
            'client_id' => $client_id,
        ];
    }



    public function clientFormField()
    {
        $form = (new \App\Admin\Controllers\CarController)->form();

        return $form->builder()->fields();
    }
}
