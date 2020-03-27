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

        $station = station();

        $works = $station->works;

        return $content
            ->title('Главная')
            ->description('Главная страница')
            ->row($title)
            ->row(function (Row $row) use ($works) {

                $row->column(4, function (Column $column) use ($works) {
                    $column->append(view('admin.charts.work', ['works' => $works->groupBy('status')]));
                });

                $row->column(4, function (Column $column) use ($works) {
                    $sum_by_month = \App\Work::statisticsByMonth(8);
                    $column->append(view('admin.charts.month_cash', ['works' => $works->groupBy('status'), 'sum_by_month' => $sum_by_month]));
                });

                $row->column(4, function (Column $column) {
                    $clients_count = \App\Client::all()->count();
                    $column->append(view('admin.charts.clients', ['clients_count' => $clients_count]));
                });
            })->breadcrumb(
                ['text' => 'Главная', 'url' => '/'],
            );
    }
}
