{{ Theme::add('/vendor/laravel-filemanager/js/lfm.js') }}
{{ Theme::add('/vendor/laravel-filemanager/js/lfm.js') }}
@php
$src=Form::getValueAttribute($name);
$src=str_replace('/laravel-filemanager/','/',$src);
$src=asset($src);
@endphp
<div class="form-group{{ $errors->has($name) ? ' has-error' : '' }}">
	<div class="col-md-4">
		{{ Form::label($name,  trans($lang.'.'.$name), ['class' => 'control-label']) }}
		<br style="clear:both;"/>
		<img id="holder" style="margin-top:15px;max-height:100px;" src="{{ $src }}"/>
	</div>
	<div class="col-md-6">
		<div class="input-group">
			<span class="input-group-btn">
			<a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
				<i class="fa fa-picture-o"></i> Choose
			</a>
			</span>	
			{{ Form::text($name, $value, array_merge(['id'=>'thumbnail', 'class' => 'form-control'], $attributes)) }}
		</div>
		@if ( $errors->has($name) )
		<span class="help-block">
		<strong>{{ $errors->first($name) }}</strong>
		</span>
		@endif
	</div>
</div>
<br style="clear:both;"/>
@push('scripts')
<script>
	var domain = "{{asset(config('lfm.prefix')) }}";
	$('#lfm').filemanager('image', {prefix: domain} );
</script>
@endpush