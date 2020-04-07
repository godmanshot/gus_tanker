<?php

namespace App\Admin\Controllers;

use App\Client;
use App\CarModel;
use App\ClientCar;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Layout\Row;
use Illuminate\Http\Request;
use Encore\Admin\Layout\Content;
use App\Admin\Controllers\ClientController;
use Encore\Admin\Controllers\AdminController;

class BalanceController extends AdminController
{
    public $title = 'Баланс';
    public $description = '';

    public function index(Content $content)
    {
        return $content
            ->title($this->title())
            ->row(function(Row $row) {
                $box = new \Encore\Admin\Widgets\Box(__('Баланс'));
                $box->style('info');

                $balance = station()->balanceF;
                $recharge_url = admin_url('/balance/recharge');

                $html = <<<HTML
                <div class="row">
                    <div class="col-xs-3"><h2 style="margin: 10px 0;">Баланс:</h2></div>
                    <div class="col-xs-9"><h2 style="margin: 10px 0;"><b>$balance</b></h2></div>
                </div>
                    <div class="row">
                        <div class="col-xs-3"><h2 style="margin: 10px 0;">Пополнить:</h2></div>
                        <div class="col-xs-9">
                            <h2 style="margin: 10px 0;">
                                <form action="$recharge_url" class="form-inline">
                                    <input type="number" class="form-control" name="price" placeholder="Введите сумму пополнения" style="min-width: 22%;margin: 0 5px;font-size: 2rem;" value="5">$
                                    <button type="submit" class="btn btn-success" role="button">Пополнить</button>
                                </form>
                            </h2>
                        </div>
                    </div>
HTML;

                $box->content($html);

                $row->column(12, $box);
            });
    }

    public function recharge(Request $request)
    {
        $request->validate([
            'price' => 'required'
        ]);

        $station = station();

        $recharge = \App\BalanceRecharge::create([
            'service_station_id' => $station->id,
            'price' => (int)$request->price,
            'status' => 1,
        ]);

        $request = [
            'pg_merchant_id'=> 511678,
            'pg_amount' => (int)$request->price,
            'pg_salt' => 'some_random_string',
            'pg_order_id'=>$recharge->id,
            'pg_description' => 'Пополнение баланса',
            'pg_result_url' => url('/paybox-result'),
            'pg_currency' => 'USD'
        ];
        
        ksort($request);
        array_unshift($request, 'payment.php');
        array_push($request, 'QR3w7eFXCmNOyn5i');
        
        
        $request['pg_sig'] = md5(implode(';', $request));
        
        unset($request[0], $request[1]);
        
        $query = http_build_query($request);

        return redirect('https://api.paybox.money/payment.php?'.$query);
    }

    public function payboxResult(Request $request)
    {
        throw new \Exception(json_encode($request->all()), 1);
        
        return 1;
    }
}
?>