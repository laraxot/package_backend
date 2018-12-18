@if(View::exists('adm_theme::admin.dashboard'))
@include('adm_theme::admin.dashboard')
@else
   <h3>'adm_theme::admin.dashboard' not exists [dash]</h3>
   {{ Theme::asset('adm_theme::admin.dashboard.blade.php') }}
@endif
