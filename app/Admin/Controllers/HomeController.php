<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\Dashboard;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;

class HomeController extends Controller
{
    public function index(Content $content)
    {
        $station = station();
        
        $title = <<<HTML
            <style>
                
                .title {
                    font-size: 50px;
                    color: #636b6f;
                    font-family: 'Raleway', sans-serif;
                    font-weight: 100;
                    display: block;
                    text-align: center;
                    margin: 20px 0 10px 0px;
                }

            </style>

            <div class='title'>{$station->name}</div>
HTML;

        return $content
            ->title('Главная')
            ->description('Главная страница')
            ->row($title)
            ->row(function (Row $row) {

                $row->column(4, function (Column $column) {
                    $column->append(Dashboard::environment());
                });

                $row->column(4, function (Column $column) {
                    $column->append(Dashboard::extensions());
                });

                $row->column(4, function (Column $column) {
                    $column->append(Dashboard::dependencies());
                });
            })->breadcrumb(
                ['text' => 'Главная', 'url' => '/'],
            );
    }
}
