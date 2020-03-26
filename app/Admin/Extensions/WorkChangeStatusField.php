<?php
namespace App\Admin\Extensions;

use Encore\Admin\Show\AbstractField;

class WorkChangeStatusField extends AbstractField
{
    /**
     * Field value.
     *
     * @var mixed
     */
    protected $value;

    /**
     * Current field model.
     *
     * @var Model
     */
    protected $model;

    /**
     * If this field show with a border.
     *
     * @var bool
     */
    public $border = false;

    /**
     * If this field show escaped contents.
     *
     * @var bool
     */
    public $escape = false;

    public function render($arg = '')
    {
        $work = $this->model;
        $status = $work->statusName;

        $statusChangeCreate = route('works.status', [$work->id, 'status' => \App\Work::STATUS_CREATE]);
        $statusChangeStart = route('works.status', [$work->id, 'status' => \App\Work::STATUS_START]);
        $statusChangeReady = route('works.status', [$work->id, 'status' => \App\Work::STATUS_READY]);
        
        return <<<HTML
            <div class='row'>
                <div class='col-xs-12'>
                    <a href="$statusChangeCreate" class="btn btn-warning">Не в работе</a>
                    <a href="$statusChangeStart" class="btn btn-primary">В работе</a>
                    <a href="$statusChangeReady" class="btn btn-success">Закончено</a>
                </div>
                
            </div>
HTML;
        // return "<div class='row'><div class='col-lg-6'>".view('admin.fields.show.work', compact('work'))."</div></div>";
    }
}