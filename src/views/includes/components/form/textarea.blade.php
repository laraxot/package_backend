@php
	if(isset($attributes['label']))
		$label=$attributes['label'];
	else
		$label=trans($lang.'.'.$name);
@endphp
<div class="form-group{{ $errors->has($name) ? ' has-error' : '' }}">
	{{ Form::label($name,  $label, ['class' => 'col-md-4 control-label']) }}
	<div class="col-md-6">	
		{{ Form::textarea($name, $value, array_merge(['class' => 'form-control'], $attributes)) }}
		@if ( $errors->has($name) )
			<span class="help-block">
				<strong>{{ $errors->first($name) }}</strong>
			</span>
		@endif
	</div>
</div>