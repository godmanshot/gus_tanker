<!-- <div class="form-group {!! !$errors->has($label) ?: 'has-error' !!}">

    <label for="{{$id}}" class="col-sm-2 control-label">{{$label}}</label>

    <div class="col-sm-6">

        @include('admin::form.error')

        <textarea class="form-control" id="{{$id}}" name="{{$name}}" placeholder="{{ trans('admin::lang.input') }} {{$label}}" {!! $attributes !!} >{{ old($column, $value) }}</textarea>
    </div>
</div> -->
<div class="row">
<div class="col-sm-3"></div>
<div id="{{$id}}" class="col-sm-6"></div>
<div class="col-sm-3"></div>
</div>
<input type="hidden" name="{{$id}}_value">

<style lang="scss">
    .sv_q_title {
        font-size: 2rem !important;
    }

    .sv_main .sv_p_root > .sv_row {
        border-bottom: 2px solid #3c8dbc !important;
    }

    .sv_main.sv_default_css .sv_p_root > .sv_row:nth-child(2n) {
        background-color: #fff !important;
    }
</style>