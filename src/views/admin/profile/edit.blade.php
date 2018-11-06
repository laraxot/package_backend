@extends('adm_theme::layouts.app')
@section('page_heading','Profilo')
@section('content')
@include('backend::includes.flash')
@include('backend::includes.components')
<div class="row">
	<div class="col-md-3">
		<!-- Profile Image -->
		<div class="box box-primary">
			<div class="box-body box-profile">
				<img class="profile-user-img img-responsive img-circle" src="{{ Auth::user()->gravatar }}" alt="User profile picture">
				<h3 class="profile-username text-center">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</h3>
				{{--
				<p class="text-muted text-center">Software Engineer</p>
				<ul class="list-group list-group-unbordered">
					<li class="list-group-item">
						<b>Followers</b> <a class="pull-right">1,322</a>
					</li>
					<li class="list-group-item">
						<b>Following</b> <a class="pull-right">543</a>
					</li>
					<li class="list-group-item">
						<b>Friends</b> <a class="pull-right">13,287</a>
					</li>
				</ul>
				<a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>
				--}}
			</div>
			<!-- /.box-body -->
		</div>
		<!-- /.box -->
		@include($view.'.widgets.about_me')
		
	</div>
	<!-- /.col -->
	<div class="col-md-9">
		@include($view.'.tabs')
		<!-- /.nav-tabs-custom -->
	</div>
	<!-- /.col -->
</div>
<!-- /.row -->
@endsection