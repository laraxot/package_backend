<div class="form-group{{ $errors->has($name) ? ' has-error' : '' }}">
	<div class="col-md-4">
		{{ $label }}
	</div>
	<div class="col-md-8">
		{{ $input }}
	</div>
</div>