<?php

namespace App\Admin\Forms\Work;

use Illuminate\Http\Request;
use Encore\Admin\Widgets\Form;
use Encore\Admin\Widgets\StepForm;

class WorkForm extends StepForm
{
    /**
     * The form title.
     *
     * @var string
     */
    public $title = 'Новая работа';

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
        $this->surveyjs('work')->answers($this->answers())->fillable_data($this->data());

        $this->divider('Цена и примечание');

        $this->number('price', __('Цена'))->placeholder(__('Цена'));
        $this->number('prepaid', __('Аванс'))->placeholder(__('Аванс'));
        $this->textarea('additional_info', __('Примечание'))->rows(5);

    }

    /**
     * The data of the form.
     *
     * @return array $data
     */
    public function data()
    {
        return [
            // 'name'       => 'John Doe',
            // 'email'      => 'John.Doe@gmail.com',
            // 'created_at' => now(),
        ];
    }

    public function answers()
    {
        $path = base_path('survey/new_work.json');
        $json = file_get_contents($path); 

        return $json;
    }

    protected function addFooter()
    {
        $footer = '';

        $index = array_search($this->current, $this->steps);

        $trans = [
            'prev'   => __('admin.prev'),
            'next'   => __('admin.next'),
            'submit' => __('admin.submit'),
        ];

        if ($index !== 0) {
            $step = $this->steps[$index - 1];
            $prevUrl = request()->fullUrlWithQuery(compact('step'));
            $footer .= "<a href=\"{$prevUrl}\" class=\"btn btn-warning pull-left\">{$trans['prev']}</a>";
        }

        if ($index !== count($this->steps) - 1) {
            $footer .= "<button class=\"btn btn-info pull-right\">{$trans['next']}</button>";
        }

        if ($index === count($this->steps) - 1) {
            $footer .= "<button class=\"btn btn-info pull-right\" id='work_form'>{$trans['submit']}</button>";
        }

        $this->html($footer);
    }
}
