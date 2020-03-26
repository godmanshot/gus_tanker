<div class="box">
    @if(isset($title))
    <div class="box-header with-border">
        <h3 class="box-title"> {{ $title }}</h3>
    </div>
    @endif

    @if ( $grid->showTools() || $grid->showExportBtn() || $grid->showCreateBtn() )
    <div class="box-header with-border">
        <div class="pull-right">
            {!! $grid->renderColumnSelector() !!}
            {!! $grid->renderExportButton() !!}
            {!! $grid->renderCreateButton() !!}
        </div>
        @if ( $grid->showTools() )
        <div class="pull-left">
            {!! $grid->renderHeaderTools() !!}
        </div>
        @endif
    </div>
    @endif

    {!! $grid->renderFilter() !!}

    {!! $grid->renderHeader() !!}

    <!-- /.box-header -->
    <div class="box-body">
        @foreach($grid->rows() as $row)
        <div class="col-sm-3">
            <div class="thumbnail">
                <div class="caption">
                    <h3 style="margin: 0;">{{$row->model()['government_number']}}</h3>
                    <p>{{$row->model()['car']}}</p>
                    <p style="margin-bottom: 0px;">Создано: <b>{{$row->model()['created_at']}}</b></p>
                    <!-- <p style="margin-bottom: 0px;">Цена: <b>{{$row->model()['price']}}</b></p>
                    <p style="margin-bottom: 5px;">Аванс: <b>{{$row->model()['prepaid']}}</b></p> -->
                    <div class="content_work" style="height: 200px; overflow: auto;margin-bottom: 10px;">
                        {!!$row->model()['work_wall']!!}
                    </div>
                    <p><a href="{{route('works.show', $row->model()['id'])}}" class="btn btn-primary" role="button">Подробнее</a></p>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    {!! $grid->renderFooter() !!}

    <div class="box-footer clearfix">
        {!! $grid->paginator() !!}
    </div>
    <!-- /.box-body -->
</div>
