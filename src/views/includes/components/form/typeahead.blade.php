<div class="form-group{{ $errors->has($name) ? ' has-error' : '' }}">
	{{ Form::label($name,  trans('table.'.$name), ['class' => 'col-md-4 control-label']) }}
	<div class="col-md-6">	
		{{ Form::text($name, $value, array_merge([
			'class' => 'form-control search-input',
            'size'=>80,
			'placeholder'=>"Search",
			'autocomplete'=>"off"
			], $attributes)) }}
		@if ( $errors->has($name) )
			<span class="help-block">
				<strong>{{ $errors->first($name) }}</strong>
			</span>
		@endif
	</div>
</div>

{{ Theme::add('/theme/bc/jquery/dist/jquery.min.js') }}
{{ Theme::add('/theme/bc/bootstrap/dist/js/bootstrap.min.js') }}
{{ Theme::add('/theme/bc/typeahead.js/dist/typeahead.bundle.min.js') }}


@push('scripts')
<!-- Typeahead Initialization -->
<script>
    jQuery(document).ready(function($) {
        // Set the Options for "Bloodhound" suggestion engine
        var engine = new Bloodhound({
            remote: {
                url: '{{ URL::current() }}?q=%QUERY%',
                wildcard: '%QUERY%'
            },
            datumTokenizer: Bloodhound.tokenizers.whitespace('q'),
            queryTokenizer: Bloodhound.tokenizers.whitespace
        });

        $(".search-input").typeahead({
            hint: true,
            highlight: true,
            minLength: 1
        }, {
            source: engine.ttAdapter(),
            displayKey: 'name',
            // This will be appended to "tt-dataset-" to form the class name of the suggestion menu.
            //name: '{{ $name }}',

            // the key from the array we want to display (name,id,email,etc...)
            templates: {
                empty: [
                    '<div class="list-group search-results-dropdown"><div class="list-group-item">Nothing found.</div></div>'
                ],
                header: [
                    '<div class="list-group search-results-dropdown">'
                ]/*
                ,suggestion: function (data) {
                    return '<a href="" class="list-group-item">' + data.name + '</a>'
                }*/
                ,suggestion: function (data) {
                     return '<a  class="list-group-item">' + data.name + '</a>'
                }
            }
        });
    });
</script>
@endpush
