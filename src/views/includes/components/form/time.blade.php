<div class="form-group{{ $errors->has($name) ? ' has-error' : '' }}">
	{{ Form::label($name,   trans($lang.'.'.$name), ['class' => 'col-md-4 control-label']) }}
	<div class="col-md-6">
		@php
        //$val=Form::getValueAttribute($name);
        
        @endphp
		<div class="datepicker-input input-group date">
		{{ Form::text($name, $value, array_merge(['class' => 'form-control timepicker'], $attributes)) }}
		<span class="input-group-addon">
            <span class="glyphicon glyphicon-calendar"></span>
        </span>
        </div>
		@if ( $errors->has($name) )
			<span class="help-block">
				<strong>{{ $errors->first($name) }}</strong>
			</span>
		@endif
	</div>
</div>

{{	Theme::addStyle('/theme/bc/bootstrap-daterangepicker/daterangepicker.css') }}

{{  Theme::addScript('/theme/bc/jquery/dist/jquery.min.js') }}
{{--	Theme::addScript('/theme/bc/moment/min/moment.min.js') --}}
{{--	Theme::addScript('/theme/bc/bootstrap-daterangepicker/daterangepicker.js') --}}
{{  Theme::addScript('backend::js/bsTime.js') }}

{{-- 
https://gist.github.com/brunoti/53bd7b3501e3626a9baa
 --}}