<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceStationSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $text = <<<EOT
        <p><a href="#">1. Объем и ограничения гарантии.</a><br /><a href="#">2. Сроки и условия гарантийного обслуживания.</a><br /><a href="#">3. Порядок гарантийного обслуживания</a></p>
        <p style="text-align: center;"><a id="1" name="1"></a></p>
        <p>1. Объем и ограничения гарантии.</p>
        <p>1.1. Предприятие гарантирует, что изделие в составе, указанном в документах, выданных Покупателю, является работоспособным, комплектным и не имеет механических повреждений.</p>
        <p>1.2. Гарантийный срок на изделие указывается в гарантийном талоне. Продолжительность гарантийного срока исчисляется с даты, указанной в гарантийном талоне.</p>
        <p>1.3. Гарантия действительна при наличии правильно оформленного гарантийного талона, заверенного печатью Предприятия.</p>
        <p>1.4. В случае выхода изделия из строя в течение гарантийного срока Предприятие обеспечивает его бесплатный ремонт.</p>
        <p>1.5. Предприятие гарантирует Покупателю предоставление необходимых консультаций по вопросам установки, эксплуатации и ремонта изделий Предприятия.</p>
        <p>1.6. Предприятие не отвечает за совместимость изделия с оборудованием других фирм или программным обеспечением Покупателя, равно как и за соответствие характеристик изделия требованиям Покупателя, последствия использования или невозможности использования изделия любым образом и по любым причинам. Вопросы совместимости, производительности и функциональности изделия рассматриваются только в режиме консультаций, либо в рамках отдельных договоров.</p>
        <p style="text-align: center;"><br /><br /></p>
EOT;

        DB::table('service_stations')->insert([
            'id' => 1,
            'name' => 'Газамир-ПРО',
            'full_name' => 'ТОО «Газамир-ПРО»',
            'id_of_company' => 'СТ ТОО 40324310-027-2008',
            'boss_otk' => 'Баситов Р.Т.',
            'image' => 'ыфвфыв',
            'phone' => '+77076060461',
            'address' => 'Джандосова 69/6',
            'currency' => 'тг.',
            'timezone' => '+6',
            'warranty_exp_month' => 24,
            'warranty_exp_lenght' => 40,
            'to_period' => 10,
            'city_name' => 'Алматы',
            'response_person' => 'Ли Максим Владиславович',
            'warranty_text' => $text,
            'balance' => 100,
            'created_at' => NULL,
            'updated_at' => NULL,
        ]);
    }
}