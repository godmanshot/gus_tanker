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
    public $title = 'Работа';

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

    public function answers()
    {
        $data =
            [
                'locale' => 'ru',
                'title' => 'Новая работа',
                'description' => 'Создание новой рабоиы',
                'pages' => 
                [
                  0 => 
                  [
                    'name' => 'page1',
                    'elements' => 
                    [
                      0 => 
                      [
                        'type' => 'dropdown',
                        'name' => 'question1',
                        'title' => 
                        [
                          'ru' => 'Производитель',
                        ],
                        'choices' => 
                        [
                          0 => 'item1',
                          1 => 'item2',
                        ],
                      ],
                      1 => 
                      [
                        'type' => 'radiogroup',
                        'name' => 'gas_type',
                        'title' => 
                        [
                          'ru' => 'Тип газа',
                        ],
                        'isRequired' => true,
                        'choices' => 
                        [
                          0 => 
                          [
                            'value' => 'LPG',
                            'text' => 
                            [
                              'ru' => 'LPG',
                            ],
                          ],
                          1 => 
                          [
                            'value' => 'CNG',
                            'text' => 
                            [
                              'ru' => 'CNG',
                            ],
                          ],
                        ],
                        'colCount' => 2,
                      ],
                      2 => 
                      [
                        'type' => 'radiogroup',
                        'name' => 'ballon_type',
                        'title' => 
                        [
                          'ru' => 'Тип баллона (LPG)',
                        ],
                        'isRequired' => true,
                        'validators' => 
                        [
                          0 => 
                          [
                            'type' => 'expression',
                          ],
                        ],
                        'choices' => 
                        [
                          0 => 
                          [
                            'value' => 'Тороидальный',
                            'text' => 
                            [
                              'ru' => 'Тороидальный',
                            ],
                          ],
                          1 => 
                          [
                            'value' => 'Цилиндрический',
                            'text' => 
                            [
                              'ru' => 'Цилиндрический',
                            ],
                          ],
                        ],
                        'colCount' => 2,
                      ],
                    ],
                  ],
                ],
            ];
        return json_encode($data);
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
