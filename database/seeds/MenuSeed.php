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
            ['id' => 8, 'parent_id' => 0, 'order' => 3, 'title' => 'Работа', 'icon' => 'fa-wrench', 'uri' => '/works'],
            ['id' => 9, 'parent_id' => 16, 'order' => 4, 'title' => 'Клиенты', 'icon' => 'fa-user', 'uri' => '/clients'],
            ['id' => 10, 'parent_id' => 15, 'order' => 7, 'title' => 'Производители', 'icon' => 'fa-user-plus', 'uri' => '/car-manufacturers'],
            ['id' => 11, 'parent_id' => 15, 'order' => 8, 'title' => 'Модели', 'icon' => 'fa-car', 'uri' => '/car-models'],
            ['id' => 12, 'parent_id' => 16, 'order' => 5, 'title' => 'Машины клиентов', 'icon' => 'fa-car', 'uri' => '/client-cars'],
            ['id' => 13, 'parent_id' => 0, 'order' => 9, 'title' => 'Настройка СТО', 'icon' => 'fa-building-o', 'uri' => '/service-stations'],
            ['id' => 14, 'parent_id' => 0, 'order' => 4, 'title' => 'Тех. обслуживание', 'icon' => 'fa-eye', 'uri' => '/tech-inspections'],
            ['id' => 15, 'parent_id' => 0, 'order' => 6, 'title' => 'Справочники машин', 'icon' => 'fa-book', 'uri' => NULL],
            ['id' => 16, 'parent_id' => 0, 'order' => 5, 'title' => 'Клиенты', 'icon' => 'fa-users', 'uri' => NULL],
        ]);

        \Encore\Admin\Auth\Database\Menu::find(2)->delete();
        $dashboard = \Encore\Admin\Auth\Database\Menu::find(1);
        $dashboard->title = __('Главная');
        $dashboard->save();

    }
}
