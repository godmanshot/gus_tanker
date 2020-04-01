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
        $price = currency($work->price);
        $paid = currency($work->paid);
        $need_paid = currency(($work->price - $work->paid)>0 ? $work->price - $work->paid : 0);

        $statusChangeCreate = route('works.status', [$work->id, 'status' => \App\Work::STATUS_CREATE]);
        $statusChangeStart = route('works.status', [$work->id, 'status' => \App\Work::STATUS_START]);
        $statusChangeReady = route('works.status', [$work->id, 'status' => \App\Work::STATUS_READY]);

        $ready_status = \App\Work::STATUS_READY;
        
        return <<<HTML
            <div class='row'>
                <div class='col-xs-12'>
                    <a href="$statusChangeCreate" class="btn btn-warning">Не в работе</a>
                    <a href="$statusChangeStart" class="btn btn-primary">В работе</a>
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal" style="padding-top: 6px;padding-bottom: 7px;">
                        Закончить и оплатить
                    </button>
                </div>


                <div class="modal" tabindex="-1" role="dialog" id="exampleModal">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Принять деньги</h4>
                            </div>
                            <form action="$statusChangeReady">
                                <div class="modal-body">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                            <th scope="col">Цена</th>
                                            <th scope="col">Оплачено</th>
                                            <th scope="col">Должен</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th>$price</th>
                                                <td>$paid</td>
                                                <td>$need_paid</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                
                                <div class="form-group">
                                    <label for="paid" class="col-sm-3 asterisk control-label">Оплатил</label>
                                    <div class="col-sm-8">
                                        <input type="number" class="form-control" id="paid" placeholder="Оплатил" name="paid"/>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="paid_comment" class="col-sm-3 asterisk control-label">Примечание к оплате</label>
                                    <div class="col-sm-8">
                                        <textarea class="form-control" id="paid_comment" placeholder="Примечание к оплате" rows="4" name="paid_comment"></textarea>
                                    </div>
                                </div>

                                <input type="hidden" name="status" value="$ready_status"/>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
                                    <button type="submit" class="btn btn-primary">Оплатить</button>
                                </div>
                            </form>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
                
            </div>
HTML;
        // return "<div class='row'><div class='col-lg-6'>".view('admin.fields.show.work', compact('work'))."</div></div>";
    }
}
?>
