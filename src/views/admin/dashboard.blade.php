@if(View::exists('adm_theme::admin.dashboard'))
@include('adm_theme::admin.dashboard')
@else
   <h3>'adm_theme::admin.dashboard' not exists </h3>
@endif
