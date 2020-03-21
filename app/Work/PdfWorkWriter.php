<?php

namespace App\Work;

use App\Work;

class PdfWorkWriter extends WorkWriter {

    public function write()
    {
        $warranty_no = $this->work->warranty_no();
        $date_install = $this->work->date_install();
        $company_name = $this->work->company_name();
        $cert_no = $this->work->cert_no();
        $warranty_exp_month = $this->work->warranty_exp_month();
        $warranty_exp_lenght = $this->work->warranty_exp_lenght();
        $to_period = $this->work->to_period();
        $city = $this->work->city();
        $response_person = $this->work->response_person();
        $auto_name = $this->work->auto_name();
        $gov_number = $this->work->gov_number();
        $vin = $this->work->vin();
        $auto_length = $this->work->auto_length();
        
        $balloons = $this->work->balloons();
        $reducer = $this->work->reducer();
        $ecu = $this->work->ecu();
        $rails = $this->work->rails();

        
        $warranty_text = $this->work->warranty_text();

        $square_img = base_path('public/images/square.png');
        $square_ok_img = base_path('public/images/square_ok.png');

        $first_square = $to_period == 10 ? $square_ok_img : $square_img;

        $second_square = $to_period == 15 ? $square_ok_img : $square_img;


        $defaultConfig = (new \Mpdf\Config\ConfigVariables())->getDefaults();
        $fontDirs = $defaultConfig['fontDir'];

        $defaultFontConfig = (new \Mpdf\Config\FontVariables())->getDefaults();
        $fontData = $defaultFontConfig['fontdata'];

        $mpdf = new \Mpdf\Mpdf([
            'margin_left' => 0,
            'margin_right' => 0,
            'margin_top' => 0,
            'margin_bottom' => 0,
            'margin_header' => 0,
            'margin_footer' => 0,
            'fontDir' => array_merge($fontDirs, [
                base_path('public/fonts/Roboto_Slab'),
            ]),
            'fontdata' => $fontData + [
                'roboto_slab' => [
                    'R' => 'RobotoSlab-Regular.ttf',
                    'B' => 'RobotoSlab-Bold.ttf',
                ],
                'roboto_slab_black' => [
                    'R' => 'RobotoSlab-Black.ttf',
                ]
            ],
            'default_font' => 'roboto_slab'
        ]);

        $balloons_html = '';
        foreach ($balloons as $balloon) {
            $balloons_html .= <<<EOT

            <tr>
                <td style="width: 33%;padding: 5px 10px;">
                    Баллон
                </td>
                <td style="width: 33%;padding: 5px 10px; text-align: center;">
                    {$balloon['name']}
                </td>
                <td style="width: 33%;padding: 5px 10px; text-align: center;">
                    {$balloon['id']}
                </td>
            </tr>
EOT;
        }

        $html = <<<EOT
        <html>
        <head>
        <style>
            body, html {
                background-color: #ffffff;
                font-size: 14px;
            }
            header {
                background-color: #0073b9;
                color: #fff;
                text-align: center;
                font-size: 2rem;
                font-family: roboto_slab_black;
                text-transform: uppercase;
                padding: 30px 0;
            }
            .content {
                padding: 40px 50px;
            }
            table {
                margin-bottom: 25px;
            }
            p {
                font-size: 18px;
                line-height: 1.5rem;
            }
        </style>
        </head>
        <body>
            <header>
                Гарантийный талон
            </header>
            <div class="content">
                <p style="color: #0073b9; paddin-bottom: 30px;">Зарегистрируйте гарантийный талон на сайте okgas.ru и получите по электронной почте инструкции по эксплуатации ГБО.</p>
                <table width="100%" style="overflow: visible;">
                    <tr>
                        <td style="">
                            Гарантийный талон №
                        </td>
                        <td style="width: 21%;border-bottom: 1px solid;text-align: center;">
                            $warranty_no
                        </td>
                        <td style="">
                            Дата установки
                        </td>
                        <td style="width:35%;border-bottom: 1px solid;text-align: center;">
                            $date_install
                        </td>
                    </tr>
                </table>
                <table width="100%" style="overflow: wrap;">
                    <tr>
                        <td style="width: 19%;">
                            Единая гарантия
                        </td>
                        <td style="width: 22%;border-bottom: 1px solid;text-align: center;">
                            $company_name
                        </td>
                        <td style="width: 17%;">
                            , Сертификат №
                        </td>
                        <td style="border-bottom: 1px solid;text-align: center;">
                            $cert_no
                        </td>
                    </tr>
                </table>
                <table width="100%" style="overflow: wrap;">
                    <tr>
                        <td style="width: 19%;">
                            Период гарантии
                        </td>
                        <td style="width: 7%;border-bottom: 1px solid;text-align: center;">
                            $warranty_exp_month
                        </td>
                        <td style="width: 10%;">
                            мес, или 
                        </td>
                        <td style="width: 7%;border-bottom: 1px solid;text-align: center;">
                            $warranty_exp_lenght
                        </td>
                        <td style="">
                            тыс. км, в зависимости от того, что наступит раньше
                        </td>
                    </tr>
                </table>
                <table width="100%" style="overflow: wrap;">
                    <tr>
                        <td style="">
                            Периодичность прохождения ТО
                        </td>
                        <td style="width: 20%;vertical-align: middle;">
                            <img src="$first_square" width="25px"/> 10 000 км.
                        </td>
                        <td style="width: 20%;">
                            <img src="$second_square" width="25px"/> 15 000 км.
                        </td>
                    </tr>
                </table>
                <table width="100%" style="overflow: wrap;">
                    <tr>
                        <td style="">
                            СТО
                        </td>
                        <td style="width: 45%;border-bottom: 1px solid;text-align: center;">
                            $company_name
                        </td>
                        <td style="">
                            г.
                        </td>
                        <td style="width: 45%;border-bottom: 1px solid;text-align: center;">
                            $city
                        </td>
                    </tr>
                </table>
                <table width="100%" style="overflow: wrap;">
                    <tr>
                        <td style="">
                            Ответственный за монтаж ФИО:
                        </td>
                        <td style="width: 65%;border-bottom: 1px solid;text-align: center;">
                            $response_person
                        </td>
                    </tr>
                </table>
                <table width="100%" style="overflow: wrap;">
                    <tr>
                        <td style="width: 65%;">
                        </td>
                        <td style="">
                            Подпись
                        </td>
                        <td style="width: 15%;border-bottom: 1px solid;text-align: center;">
                            
                        </td>
                        <td style="">
                            М.П.
                        </td>
                    </tr>
                </table>
                <table width="100%" style="overflow: wrap;" border="1" style="border-collapse: collapse">
                    <tr>
                        <td colspan="2" style="text-align: center;background-color: #0073b9;color: #fff;font-family: roboto_slab_black;text-transform: uppercase;padding:10px;">
                            Автомобиль
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 50%; padding:5px 10px;">
                            Марка и модель авто
                        </td>
                        <td style="width: 50%; padding: 5px 10px;">
                            $auto_name
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 50%; padding:5px 10px;">
                            Государственный регистрационный номер
                        </td>
                        <td style="width: 50%; padding: 5px 10px;">
                            $gov_number
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 50%; padding:5px 10px;">
                            VIN
                        </td>
                        <td style="width: 50%; padding: 5px 10px;">
                            $vin
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 50%; padding:5px 10px;">
                            Пробег на момент установки
                        </td>
                        <td style="width: 50%; padding: 5px 10px;">
                            $auto_length
                        </td>
                    </tr>
                </table>
                <table width="100%" style="overflow: wrap;" border="1" style="border-collapse: collapse">
                    <tr>
                        <td colspan="3" style="text-align: center;background-color: #0073b9;color: #fff;font-family: roboto_slab_black;text-transform: uppercase;padding:10px;">
                            Газобаллонное оборудование
                        </td>
                    </tr>
                    <tr style="background-color: #f0f0f0;">
                        <td style="width: 33%;padding: 5px 10px;">
                            Название
                        </td>
                        <td style="width: 33%;padding: 5px 10px; text-align: center;">
                            Модель
                        </td>
                        <td style="width: 33%;padding: 5px 10px; text-align: center;">
                            Идентификационный номер
                        </td>
                    </tr>
                    $balloons_html
                    <tr>
                        <td style="width: 33%;padding: 5px 10px;">
                            Редуктор
                        </td>
                        <td style="width: 33%;padding: 5px 10px; text-align: center;">
                            {$reducer['name']}
                        </td>
                        <td style="width: 33%;padding: 5px 10px; text-align: center;">
                            {$reducer['id']}
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 33%;padding: 5px 10px;">
                            ЭБУ
                        </td>
                        <td style="width: 33%;padding: 5px 10px; text-align: center;">
                            {$ecu['name']}
                        </td>
                        <td style="width: 33%;padding: 5px 10px; text-align: center;">
                            {$ecu['id']}
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 33%;padding: 5px 10px;">
                            Форсунки
                        </td>
                        <td style="width: 33%;padding: 5px 10px; text-align: center;">
                            {$rails['name']}
                        </td>
                        <td style="width: 33%;padding: 5px 10px; text-align: center;">
                            {$rails['id']}
                        </td>
                    </tr>
                </table>
            </div>
        </body>
        </html>
EOT;
        $mpdf->WriteHTML($html);
        $mpdf->WriteHTML('<pagebreak resetpagenum="1" pagenumstyle="a" suppress="off" />');
        $talon_img = base_path('public/images/talons.jpg');
        $talons = <<<EOT
<html>
<head>
<style>
    body, html {
        background-color: #ffffff;
        font-size: 14px;
    }
    header {
        background-color: #0073b9;
        color: #fff;
        text-align: center;
        font-size: 2rem;
        font-family: roboto_slab_black;
        text-transform: uppercase;
        padding: 30px 0;
    }
    .content {
        padding: 40px 50px;
    }
    table {
        margin-bottom: 25px;
    }
    p {
        font-size: 18px;
        line-height: 1.5rem;
    }
</style>
</head>
<body>
    <header>
        Талоны техобслуживания
    </header>
    <div class="content">
        <img src="$talon_img" width="100%"/>
    </div>
</body>
</html>
EOT;
        $mpdf->WriteHTML($talons);
        $mpdf->WriteHTML('<pagebreak resetpagenum="1" pagenumstyle="a" suppress="off" />');
        $reglament = <<<EOT
<html>
<head>
<style>
    body, html {
        background-color: #ffffff;
        font-size: 14px;
    }
    header {
        background-color: #0073b9;
        color: #fff;
        text-align: center;
        font-size: 2rem;
        font-family: roboto_slab_black;
        text-transform: uppercase;
        padding: 30px 0;
    }
    .content {
        padding: 40px 50px;
    }
    table {
        margin-bottom: 25px;
    }
    p {
        font-size: 18px;
        line-height: 1.5rem;
    }
</style>
</head>
<body>
    <header>
        Регламент ТО
    </header>
    <div class="content">
        <p style="color: #0073b9; paddin-bottom: 30px;text-align: center;">Периодичность ТО указана на стр. 1.</p>
        <table width="100%" border="1" style="overflow: hidden;border-collapse: collapse; text-align: center;font-size: 0.7rem;" autosize="1">
            <tr style="background-color: #f0f0f0;">
                <td style="width:10%">
                    Работы
                </td>
                <td style="">
                    ТО 1
                </td>
                <td style="">
                    ТО 2
                </td>
                <td style="">
                    ТО 3
                </td>
                <td style="">
                    ТО 4
                </td>
                <td style="">
                    ТО 5
                </td>
                <td style="">
                    ТО 6
                </td>
                <td style="">
                    ТО 7
                </td>
                <td style="">
                    ТО 8
                </td>
                <td style="">
                    ТО 9
                </td>
                <td style="">
                    ТО 10
                </td>
            </tr>
            <tr>
                <td style="background-color: #e0e0e0;padding: 12px 0;">
                    Соединения
                </td>
                <td style="">
                    Проверка
                </td>
                <td style="">
                    Проверка
                </td>
                <td style="">
                    Проверка
                </td>
                <td style="">
                    Проверка
                </td>
                <td style="">
                    Проверка
                </td>
                <td style="">
                    Проверка
                </td>
                <td style="">
                    Проверка
                </td>
                <td style="">
                    Проверка
                </td>
                <td style="">
                    Проверка
                </td>
                <td style="">
                    Проверка
                </td>
            </tr>
            <tr>
                <td style="background-color: #e0e0e0;">
                    Фильтр жидкой фазы
                </td>
                <td style="">
                    
                </td>
                <td style="">
                    Замена
                </td>
                <td style="">
                    
                </td>
                <td style="">
                    Замена
                </td>
                <td style="">
                    
                </td>
                <td style="">
                    Замена
                </td>
                <td style="">
                    
                </td>
                <td style="">
                    Замена
                </td>
                <td style="">
                    
                </td>
                <td style="">
                    Замена
                </td>
            </tr>
            <tr>
                <td style="background-color: #e0e0e0;">
                    Фильтр паровой фазы
                </td>
                <td style="">
                    Замена
                </td>
                <td style="">
                    Замена
                </td>
                <td style="">
                    Замена
                </td>
                <td style="">
                    Замена
                </td>
                <td style="">
                    Замена
                </td>
                <td style="">
                    Замена
                </td>
                <td style="">
                    Замена
                </td>
                <td style="">
                    Замена
                </td>
                <td style="">
                    Замена
                </td>
                <td style="">
                    Замена
                </td>
            </tr>
            <tr>
                <td style="background-color: #e0e0e0;padding: 7px 0;">
                    Резиновые рукава
                </td>
                <td style="">
                    
                </td>
                <td style="">
                    Проверка
                </td>
                <td style="">
                    
                </td>
                <td style="">
                    Проверка
                </td>
                <td style="">
                    
                </td>
                <td style="">
                    Проверка
                </td>
                <td style="">
                    
                </td>
                <td style="">
                    Проверка
                </td>
                <td style="">
                    
                </td>
                <td style="">
                    Проверка
                </td>
            </tr>
            <tr>
                <td style="background-color: #e0e0e0;padding: 12px 0;">
                    Инжекторы
                </td>
                <td style="">
                    
                </td>
                <td style="">
                    Обслуживание
                </td>
                <td style="">
                
                </td>
                <td style="">
                    Замена
                </td>
                <td style="">
                    
                </td>
                <td style="">
                    Обслуживание
                </td>
                <td style="">
                    
                </td>
                <td style="">
                    Замена
                </td>
                <td style="">
                    
                </td>
                <td style="">
                    Обслуживание
                </td>
            </tr>
            <tr>
                <td style="background-color: #e0e0e0;padding: 12px 0;">
                    Редуктор
                </td>
                <td style="">
                    Продувка
                </td>
                <td style="">
                    Продувка
                </td>
                <td style="">
                    Продувка
                </td>
                <td style="">
                    Замена рем. комплекта
                </td>
                <td style="">
                    Продувка
                </td>
                <td style="">
                    Продувка
                </td>
                <td style="">
                    Продувка
                </td>
                <td style="">
                    Замена рем. комплекта
                </td>
                <td style="">
                    Продувка
                </td>
                <td style="">
                    Продувка
                </td>
            </tr>
        </table>
        <p>Стоимость ТО уточняйте на станции тезнического обслуживания.</p>
        <p>Список всех авторизованных СТО указан на сайте okgas.ru</p>
        <p>Регламент проведения ТО рассчитан при условии использования оригинальных запасных частей.</p>
    </div>
</body>
</html>
EOT;
$mpdf->WriteHTML($reglament);
$mpdf->WriteHTML('<pagebreak resetpagenum="1" pagenumstyle="a" suppress="off" />');
$conditions = <<<EOT
<html>
<head>
<style>
    body, html {
        background-color: #ffffff;
        font-size: 14px;
    }
    header {
        background-color: #0073b9;
        color: #fff;
        text-align: center;
        font-size: 2rem;
        font-family: roboto_slab_black;
        text-transform: uppercase;
        padding: 30px 0;
    }
    .content {
        padding: 40px 50px;
    }
    table {
        margin-bottom: 25px;
    }
    p {
        font-size: 18px;
        line-height: 1.5rem;
    }
</style>
</head>
<body>
    <header>
        Гарантийные условия
    </header>
    <div class="content">
        <p style="color: #0073b9; paddin-bottom: 30px;">Гарантийные условия</p>
        <div class="conditions">$warranty_text</div>
        <table width="100%" style="overflow: visible;">
            <tr>
                <td style="width:100%;border-bottom: 1px solid;text-align: center;">
                    $date_install
                </td>
            </tr>
            <tr>
                <td style="width:100%;text-align: center;color: #707070;">
                    ФИО Клиента
                </td>
            </tr>
        </table>
        <table width="100%" style="overflow: visible;">
            <tr>
                <td style="">
                    С условиями предоставления гарантии ознакомлен
                </td>
                <td style="width:40%;border-bottom: 1px solid;text-align: center;">
                    
                </td>
            </tr>
        </table>
    </div>
</body>
</html>
EOT;
$mpdf->WriteHTML($conditions);
        

        return $mpdf->Output();
    }
}