@php
	//$tabs=['activity'=>'Activity','timeline'=>'Timeline','settings'=>'Settings'];
$tabs=['settings'=>'Settings'];
@endphp
<div class="nav-tabs-custom">
	<ul class="nav nav-tabs">
		@foreach($tabs as $k => $v)
		{{--  
		<li class="active"><a href="#activity" data-toggle="tab">Activity</a></li>
		<li><a href="#timeline" data-toggle="tab">Timeline</a></li>
		<li><a href="#settings" data-toggle="tab">Settings</a></li>
		--}}
		<li><a href="#{{ $k }}" data-toggle="tab">{{ $v }}</a></li>
		@endforeach
	</ul>
	<div class="tab-content">
		@foreach($tabs as $k => $v)
		{{--  
		@include($view.'.tabs.activity')
		@include($view.'.tabs.timeline')
		@include($view.'.tabs.settings')
		--}}
		@include($view.'.tabs.'.$k,['active'=>($k==$active)])
		@endforeach
	</div>
	<!-- /.tab-content -->
</div>