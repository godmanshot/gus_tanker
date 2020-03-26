<?php

use Illuminate\Database\Seeder;

class MenuSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Encore\Admin\Auth\Database\Menu::insert([
            [
                'parent_id' => 0,
                'order'     => 8,
                'title'     => 'Работа',
                'icon'      => 'fa-align-justify',
                'uri'       => '/works',
            ],
            [
                'parent_id' => 0,
                'order'     => 9,
                'title'     => 'Клиенты',
                'icon'      => 'fa-align-justify',
                'uri'       => '/clients',
            ],
            [
                'parent_id' => 0,
                'order'     => 10,
                'title'     => 'Производители',
                'icon'      => 'fa-align-justify',
                'uri'       => '/car-manufacturers',
            ],
            [
                'parent_id' => 0,
                'order'     => 11,
                'title'     => 'Модели машин',
                'icon'      => 'fa-align-justify',
                'uri'       => '/car-models',
            ],
            [
                'parent_id' => 0,
                'order'     => 12,
                'title'     => 'Машины клиентов',
                'icon'      => 'fa-align-justify',
                'uri'       => '/client-cars',
            ],
            [
                'parent_id' => 0,
                'order'     => 13,
                'title'     => 'СТО',
                'icon'      => 'fa-align-justify',
                'uri'       => '/service-stations',
            ],
            [
                'parent_id' => 0,
                'order'     => 14,
                'title'     => 'Тех. обслуживание',
                'icon'      => 'fa-align-justify',
                'uri'       => '/tech-inspections',
            ],
        ]);
    }
}
