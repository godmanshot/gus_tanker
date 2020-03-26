<div class="col-12">
    <h4 style="margin-top: 0;">
        @if($work->isInstall())
            <span class="label label-success">Установка</span>
        @else
            <span class="label label-info">Сервис</span>
        @endif

        @if($work->status == \App\Work::STATUS_CREATE)
            <span class="label btn-warning">Статус: {{$work->statusName}}</span>
        @elseif($work->status == \App\Work::STATUS_START)
            <span class="label btn-primary">Статус: {{$work->statusName}}</span>
        @elseif($work->status == \App\Work::STATUS_READY)
            <span class="label btn-success">Статус: {{$work->statusName}}</span>
        @endif
    </h4>
</div>

@if($work->isInstall())
<div class="col-12">
    <div class="table-responsive">
        <table class="table table-bordered ">
            <tr>
                <td class="">Тип газа</td>
                <td class=""><b>{{$work->gas_type()}}</b></td>
            </tr>
            @foreach($work->balloons() as $balloon)
            <tr>
                <td class="">Баллон</td>
                <td class=""><b>{{$balloon['name']}}</b></td>
            </tr>
            @endforeach
            @foreach([$work->ecu()] as $ecu)
            <tr>
                <td class="">ЭБУ</td>
                <td class=""><b>{{$ecu['name']}}</b></td>
            </tr>
            @endforeach
            @foreach([$work->reducer()] as $reducer)
            <tr>
                <td class="">Редуктор</td>
                <td class=""><b>{{$reducer['name']}}</b></td>
            </tr>
            @endforeach
            @foreach([$work->rails()] as $rails)
            <tr>
                <td class="">Форсунки</td>
                <td class=""><b>{{$rails['name']}}</b></td>
            </tr>
            @endforeach
        </table>
    </div>
</div>
@else
<div class="col-12">
    <div class="table-responsive">
        <table class="table table-bordered ">
            @if(!empty($work->items()['repair']))
            <tr>
                <td class="">Ремонт</td>
                <td class="">
                    <ul>
                    @foreach($work->items()['repair'] as $item)
                        @if($item == 'other')
                        @continue
                        @endif
                        <li>{{$item}}</li>
                    @endforeach
                    @if(!empty($work->items()['repair-Comment']))
                        <li>{{$work->items()['repair-Comment']}}</li>
                    @endif
                    </ul>
                </td>
            </tr>
            @endif
            @if(!empty($work->items()['replacement']))
            <tr>
                <td class="">Замена</td>
                <td class="">
                    <ul>
                    @foreach($work->items()['replacement'] as $item)
                        @if($item == 'other')
                        @continue
                        @endif
                        <li>{{$item}}</li>
                    @endforeach
                    @if(!empty($work->items()['replacement-Comment']))
                        <li>{{$work->items()['replacement-Comment']}}</li>
                    @endif
                    </ul>
                </td>
            </tr>
            @endif
            @if(!empty($work->items()['other']))
            <tr>
                <td class="">Остальное</td>
                <td class="">
                    <ul>
                    @foreach($work->items()['other'] as $item)
                        @if($item == 'other')
                        @continue
                        @endif
                        <li>{{$item}}</li>
                    @endforeach
                    @if(!empty($work->items()['other-Comment']))
                        <li>{{$work->items()['other-Comment']}}</li>
                    @endif
                    </ul>
                </td>
            </tr>
            @endif
        </table>
    </div>
</div>
@endif