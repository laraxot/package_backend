@php
	//Theme::addScript("/theme/bc/jquery/dist/jquery.min.js");
 	//Theme::addScript("/theme/bc/bootstrap/dist/js/bootstrap.min.js");
	Theme::addScript('/theme/bc/multiselect/dist/js/multiselect.js');
	$val=Form::getValueAttribute($name);
	$all=Form::getValueAttribute('all_'.$name);
	//$my=collect($value->toArray());
	//ddd($val);
	if($val==null) $val=[];
	//ddd($all);
@endphp

<br style="clear:both"/>
<div class="row">
  <p>{{ trans('lu::help.nota_multiselect') }}</p><br/>
    <div class="col-sm-5">
        <select {{-- name="from[]" --}} id="multiselect" class="form-control" size="8" multiple="multiple">
            @foreach($all as $k => $v)
            <option value="{{ $v->opt_key }}" >{{ $v->opt_label }}</option>
            @endforeach
        </select>
    </div>

    <div class="col-sm-1">
        <button type="button" id="multiselect_rightAll" class="btn btn-block"><i class="glyphicon glyphicon-forward"></i></button>
        <button type="button" id="multiselect_rightSelected" class="btn btn-block"><i class="glyphicon glyphicon-chevron-right"></i></button>
        <button type="button" id="multiselect_leftSelected" class="btn btn-block"><i class="glyphicon glyphicon-chevron-left"></i></button>
        <button type="button" id="multiselect_leftAll" class="btn btn-block"><i class="glyphicon glyphicon-backward"></i></button>
    </div>
      
    <div class="col-sm-5">
        <select name="{{$name}}[]" id="multiselect_to" class="form-control" size="8" multiple="multiple">
            @foreach($val as $k => $v)
            <option value="{{ $v->opt_key }}" >{{ $v->opt_label }}</option>
            @endforeach
        </select>
    </div>
    
</div>
@push('scripts')
<script type="text/javascript">
jQuery(document).ready(function($) {
    $('#multiselect').multiselect();
});
</script>
@endpush