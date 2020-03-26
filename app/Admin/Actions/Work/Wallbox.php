<?php

namespace App\Admin\Actions\Work;

use Encore\Admin\Actions\Action;
use Illuminate\Database\Eloquent\Collection;

class Wallbox extends Action
{
    public $name = 'Панель';
    protected $selector = '.import-post';

    public function handle(\Illuminate\Http\Request $request)
    {
        if(strpos(url()->previous(), 'view=list') !== false) {
            $url = route('works.index');
        } else {
            $url = route('works.index', ['view'=>'list']);
        }

        return $this->response()->redirect($url);
    }

    public function html()
    {
        if($this->isList()) {
            $html = <<<HTML
                <a class="btn btn-sm btn-warning import-post">Карточками</a>
HTML;
        } else {
            $html = <<<HTML
                <a class="btn btn-sm btn-warning import-post">Списком</a>
HTML;
        }

        return $html;
    }

    public function isList()
    {
        return request()->view == 'list';
    }
}