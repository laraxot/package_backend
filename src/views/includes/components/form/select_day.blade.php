@php

$timestamp = strtotime('next Sunday');
$days = array();
for ($i = 0; $i < 7; $i++) {
    $days[$i] = strftime('%A', $timestamp);
    $timestamp = strtotime('+1 day', $timestamp);
}
$options=$days;

@endphp
<div class="form-group{{ $errors->has($name) ? ' has-error' : '' }}">
	{{ Form::label($name,  trans($lang.'.'.$name), ['class' => 'col-md-4 control-label']) }}
	<div class="col-md-6">	
		{{ Form::select($name,$options,$value,array_merge(['class' => 'form-control'], $attributes)) }}
		@if ( $errors->has($name) )
			<span class="help-block">
				<strong>{{ $errors->first($name) }}</strong>
			</span>
		@endif
	</div>
</div>