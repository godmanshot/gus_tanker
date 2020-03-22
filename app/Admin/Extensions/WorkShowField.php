<?php
namespace App\Admin\Extensions;

use Encore\Admin\Show\AbstractField;

class WorkShowField extends AbstractField
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
        
        return "<div class='row'><div class='col-lg-6'>".view('admin.fields.show.work', compact('work'))."</div></div>";
    }
}