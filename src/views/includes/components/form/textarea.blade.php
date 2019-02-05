@php
	$label=isset($attributes['label'])?$attributes['label']:trans($lang.'.'.$name);
@endphp
<div class="form-group{{ $errors->has($name) ? ' has-error' : '' }}">
	<div class="col-md-4">
		{{ Form::label($name,  $label, ['class' => 'control-label']) }}
	</div>
	<div class="col-md-6">	
		{{ Form::textarea($name, $value, array_merge(['class' => 'form-control'], $attributes)) }}
		@if ( $errors->has($name) )
			<span class="help-block">
				<strong>{{ $errors->first($name) }}</strong>
			</span>
		@endif
	</div>
</div>