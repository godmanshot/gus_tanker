<!-- <div class="form-group {!! !$errors->has($label) ?: 'has-error' !!}">

    <label for="{{$id}}" class="col-sm-2 control-label">{{$label}}</label>

    <div class="col-sm-6">

        @include('admin::form.error')

        <textarea class="form-control" id="{{$id}}" name="{{$name}}" placeholder="{{ trans('admin::lang.input') }} {{$label}}" {!! $attributes !!} >{{ old($column, $value) }}</textarea>
    </div>
</div> -->

<div id="{{$id}}"></div>
<input type="hidden" name="{{$id}}_value">

<style lang="scss">
    .sv_q_title {
        font-size: 2rem !important;
    }
</style>