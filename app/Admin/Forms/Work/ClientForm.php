<?php

namespace App\Admin\Forms\Work;

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
    public $title = 'Работа: Клиент';

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
        $this->text('name')->rules('required');
        $this->email('email')->rules('email');
        $this->datetime('created_at');
    }

    /**
     * The data of the form.
     *
     * @return array $data
     */
    public function data()
    {
        return [
            'name'       => 'John Doe',
            'email'      => 'John.Doe@gmail.com',
            'created_at' => now(),
        ];
    }
}
