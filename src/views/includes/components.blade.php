@php
//$action = Route::currentRouteAction();
//$tmp=Route::current()->action['uses'];
$tmp= Route::currentRouteAction();
$tmp=explode('\\',$tmp);
$tmp=strtolower($tmp[1]);
$lang=$tmp.'::fields'; 

$view_path=dirname(\View::getFinder()->find('backend::includes.components.form.text')); //devo dargli una view esistente di partenza
$files = File::allFiles($view_path);
foreach($files as $file){
	$filename=$file->getRelativePathname();
	$ext='.blade.php';
	if(ends_with($filename,$ext)){
		$base=substr(($filename),0,-strlen($ext));
		$name=str_replace(DIRECTORY_SEPARATOR,'_',$base);
		$name='bs'.studly_case($name);
		$comp_view=str_replace('/','.',$base);
		//echo '<br/>'.$base.'  --- '.$name.'  --  '.$comp_view;
		//echo '<br/>'.$name;
		Form::component($name, 'backend::includes.components.form.'.$comp_view,
			['name', 'value' => null,'attributes' => [],'lang'=>$lang]);
	}
}
//---- shortcut or custom --- 
Form::component('bsSelect', 'backend::includes.components.form.select',
	['name', 'value' => null,'options'=>[], 'attributes' => [],'lang'=>$lang]);
Form::component('bsCheckbox', 'backend::includes.components.form.checkbox',
	['name', 'value' => 1,'checked'=>false, 'attributes' => [],'lang'=>$lang]);
Form::component('bsDateTimeRangeX', 'backend::includes.components.form.date_time_range_x',
	['start_name','end_name', 'value' => null, 'attributes' => [],'lang'=>$lang]);

Form::macro('bsYearNav', function ($paramz) {
	$routename=\Route::currentRouteName();
	extract($paramz);
	$params=\Route::current()->parameters();
	if (isset($params['anno'])) {
		$anno=$params['anno'];
	} else {
		$anno=date('Y');
	}
	$time=mktime(0, 0, 0, 1, 1, $anno);
	$time_prev=mktime(0, 0, 0, 1, 1, $anno-1);
	$time_next=mktime(0, 0, 0, 1, 1, $anno+1);
	$parz=$params;
	$parz['anno']=$anno;
	
	$route_curr=route($routename, $parz);
	$parz['anno']=date('Y', $time_prev);
	$route_prev=route($routename, $parz);
	$parz['anno']=date('Y', $time_next);
	$route_next=route($routename, $parz);
	
	$html='<nav aria-label="year_nav">
	<ul class="pager pagination justify-content-center">
	<li class="previous page-item"><a class="page-link" href="'.$route_prev.'">&laquo;'.($anno-1).'</a></li>
	<li class="current page-item active"><a class="page-link" href="'.$route_curr.'">'.($anno).' </a></li>
	<li class="next page-item"><a class="page-link" href="'.$route_next.'">'.($anno+1) .' &raquo; </a></li>
	</ul>
	</nav>';

	return $html;
});

Form::macro('bsMonthYearNav', function ($paramz) {
	$routename=\Route::currentRouteName();
	extract($paramz);
	$params=\Route::current()->parameters();
	if (isset($params['mese'])) {
		$mese=$params['mese'];
	} else {
		$mese=date('m');
	}
	if (isset($params['anno'])) {
		$anno=$params['anno'];
	} else {
		$anno=date('Y');
	}
	$time=mktime(0, 0, 0, $mese, 1, $anno);
	$time_prev=mktime(0, 0, 0, $mese-1, 1, $anno);
	$time_next=mktime(0, 0, 0, $mese+1, 1, $anno);
	$parz=$params;
	$parz['mese']=$mese;
	$parz['anno']=$anno;
	//echo '<pre>';print_r($parz);echo '</pre>';die();
	$route_mese_curr=route($routename, $parz);
	$parz['mese']=date('m', $time_prev);
	$parz['anno']=date('Y', $time_prev);
	$route_mese_prev=route($routename, $parz);
	$parz['mese']=date('m', $time_next);
	$parz['anno']=date('Y', $time_next);
	$route_mese_next=route($routename, $parz);

	$mese_curr=\Carbon\Carbon::createFromDate($anno, $mese, 1);

	$mese_prev=\Carbon\Carbon::createFromDate($anno, $mese-1, 1);

	$mese_next=\Carbon\Carbon::createFromDate($anno, $mese+1, 1);

	$html='<ul class="pager">
	<li class="previous"><a href="'.$route_mese_prev.'">&laquo;'.$mese_prev->formatLocalized('%B %Y').'</a></li>
	<li class="current"><a href="'.$route_mese_curr.'">'.$mese_curr->formatLocalized('%B %Y').' </a></li>
	<li class="next"><a href="'.$route_mese_next.'">'.$mese_next->formatLocalized('%B %Y') .' &raquo; </a></li>
	</ul>';
	return $html;
});
/*
Form::macro('bsFormSearch', function () {
	$html='';
	$q=\Request::input('q');
	//$html=view('backend::includes.components.form.form_search');


	$html.='<div>';
	$html.=Form::open(['method'=>'GET','class'=>'navbar-form navbar-right','role'=>'search']);
	$html.='<div class="input-group custom-search-form">
	<input type="text" class="form-control" name="q" value="'.$q.'" placeholder="Search...">
	<span class="input-group-btn">
		<button class="btn btn-default-sm" type="submit">
			<i class="fa fa-search"><!--<span class="hiddenGrammarError" pre="" data-mce-bogus="1"--></i>
		</button>
	</span>
	</div>';
	$html.=Form::close();
	$html.='<a href="?scoutimport" class="navbar-right"><i class="fa fa-refresh"></i></a>';
	$html.='</div>';

	return $html;
});
//*/
/*
Form::macro('bsFormLatLngSearch', function () {
	$html='';
	$q=\Request::input('q');

	$html.='<div>';
	$html.=Form::open(['method'=>'GET','class'=>'navbar-form navbar-right','role'=>'search']);
	$html.='<div class="input-group custom-search-form">
	<input type="text" class="form-control" name="q" value="'.$q.'" placeholder="Search...">
	<span class="input-group-btn">
		<button class="btn btn-default-sm" type="submit">
			<i class="fa fa-search"><!--<span class="hiddenGrammarError" pre="" data-mce-bogus="1"--></i>
		</button>
	</span>
	</div>';
	$html.=Form::close();
	$html.='<a href="?scoutimport" class="navbar-right"><i class="fa fa-refresh"></i></a>';
	$html.='</div>';

	return $html;
});
//*/

/*
Form::macro('bsFormLatLngSearch', function () {
	$html='';
	$q=\Request::input('q');
	$html.='<div>';
	$html.=Form::open(['method'=>'GET','class'=>'navbar-form navbar-right','role'=>'search']);
	$html.='<div class="input-group custom-search-form">
	<input type="text" class="form-control" name="q" value="'.$q.'" placeholder="Search...">
	<span class="input-group-btn">
		<button class="btn btn-default-sm" type="submit">
			<i class="fa fa-search"><!--<span class="hiddenGrammarError" pre="" data-mce-bogus="1"--></i>
		</button>
	</span>
	</div>';
	$html.=Form::close();
	$html.='<a href="?scoutimport" class="navbar-right"><i class="fa fa-refresh"></i></a>';
	$html.='</div>';
	return $html;
});
//*/



Form::macro('bsOpen', function ($model, $from, $to='', $params = null) {
	if ($params == null) {
		$params=\Route::current()->parameters();
	}
	$req_params=\Request::all();

	//if(is_array($req_params)) $params=array_merge($req_params,$params);


	if ($to=='') {
		$to=$from;
		switch ($to) {
			case 'update': $from='edit'; break;
			case 'store': $from='create'; break;
		}
	}
	
	$routename=Request::route()->getName();
	$routename=str_replace('.'.$from, '.'.$to, $routename);

	$route=route($routename, $params);

	$parz=array_merge([$routename], array_values($params));
	switch ($to) {
		case 'store':
			$method='POST';
		break;
		case 'update':
			$method='PUT'; //PUT/PATCH
		break;
		case 'destroy':
			$method='DELETE';
		break;
		default:
			$method='POST';
		break;
	}
	if (isset($params['method'])) {
		$method=$params['method'];
	}



	return Form::model($model, [
	'route' => $parz
	//'action' => $route
	])
	//.csrf_field()
	.method_field($method);
});


/*
Form::macro('bsDate',function ($model,$act) {
	$theme=\App\Services\ThemeService::class;

	Theme::addScript('/theme/bc/jquery/dist/jquery.min.js');
	Theme::addScript('/theme/bc/moment/min/moment.min.js');
	Theme::addScript('/theme/bc/bootstrap-daterangepicker/daterangepicker.js');

});
*/

Form::macro('bsBtnRoute', function ($parz) {
	$route='';
	$routename=Request::route()->getName();
	extract($parz);
	$params=\Route::current()->parameters();
	if (isset($extra)) {
		$params=array_merge($params, $extra);
	}
	if (isset($from) && isset($to)) {
		$route=route(str_replace('.'.$from, '.'.$to, $routename), $params);
	}

	return '<a class="btn btn-small btn-warning" href="'.$route.'">
		<i class="'.$icons.' fa-fw" aria-hidden="true"></i>
	</a>';
});

Form::macro('bsBtnCrud', function ($extra) {
	$btns='';
	$btns.=Form::bsBtnEdit($extra);
	$btns.=Form::bsBtnDelete($extra);
	return $btns;
});

Form::macro('bsBtnEdit', function ($extra, $from='index', $to='edit') {
	$params=\Route::current()->parameters();
	$params=array_merge($params, $extra);
	$routename=Request::route()->getName();
	//echo '<h3>'.$routename.'</h3>';
	$route=route(str_replace('.'.$from, '.'.$to, $routename), $params);
	$class='btn btn-small btn-info';
	if (isset($extra['class'])) {
		$class.=' '.$extra['class'];
	}
	return '<a class="'.$class.'" href="'.$route.'" data-toggle="tooltip" title="Modifica"><i class="fa fa-pencil fa-fw far fa-edit" aria-hidden="true"></i></a>';
});


Form::macro('bsBtnClone', function ($extra, $from='index', $to='edit' /*$to='replicate' */) {
	$params=\Route::current()->parameters();
	$params=array_merge($params, $extra);
	$params['replicate']=1;
	$route=route(str_replace('.'.$from, '.'.$to, Request::route()->getName()), $params);
	return '<a class="btn btn-small btn-warning" href="'.$route.'"  data-toggle="tooltip" title="Duplica"><i class="fa fa-clipboard fa-fw far fa-clone" aria-hidden="true"></i></a>';
});

Form::macro('bsBtnDelete', function ($extra) {
	$theme=\App\Services\ThemeService::class;
	//-----------
	$id=array_values($extra)[0];
	
	$params=\Route::current()->parameters();
	$params=array_merge($params, $extra);
	if (is_object($id)) {
		$obj=$id;
		$id=$id->getRouteKey();
		$params['k']=$obj->getKeyName();
		$params['v']=$obj->getKey();
	}
	$routename=Request::route()->getName();
	$routename_next=str_replace('.index', '.destroy', $routename);

	$route=route($routename_next, $params);
	//echo '<br/>'.$routename_next.'   '.$route;
	//Theme::add('/theme/bc/jquery/dist/jquery.min.js');
	Theme::add('theme/bc/sweetalert2/dist/sweetalert2.min.js');
	Theme::add('theme/bc/sweetalert2/dist/sweetalert2.min.css');
	Theme::add('extend::js/btnDeleteX2.js');
	
	/*-- sweet alert 1 --
	Theme::add('/theme/bc/sweetalert/dist/sweetalert.css');
	Theme::add('/theme/bc/sweetalert/dist/sweetalert.min.js');
	Theme::add('/theme/js/btnDeleteX.js');
	*/
	$class='btn btn-small btn-danger';
	if (isset($extra['class'])) {
		$class.=' '.$extra['class'];
	}
	/*-- sweetalert 1
	return '<a class="'.$class.'" href="#" data-token="'. csrf_token() .'" data-id="'.$id.'" data-href="'.$route.'" data-toggle="tooltip" title="Cancella"><i class="fa fa-trash-o fa-fw" aria-hidden="true"></i></a>';
	*/
	$html='<a class="'.$class.'" data-delete="" data-toggle="tooltip" title="Cancella" data-title="Sei Sicuro ?" data-message="di volere cancellare " data-button-text="cancella" data-id="'.$id.'" href="#" data-href="'.$route.'"><i class="fa fa-trash-o fa-fw far fa-trash" aria-hidden="true"></i></a>';
	return $html;
});


 Form::macro('bsBtnCreate', function ($extra=[]) {
	 //---default var ---
	 $txt='Nuova ';
	 $params=[];
	 extract($extra);
	 $routename=str_replace('.index', '.create', Request::route()->getName());

	 $params=array_merge(\Route::current()->parameters(), $params);
	 $route=route($routename, $params);
	 $class='btn btn-small btn-info btn-xs';
	 if (isset($extra['class'])) {
		 $class.=' '.$extra['class'];
	 }
	 return '<a class="'.$class.'" href="'.$route.'" data-toggle="tooltip" title="Create"><i class="fa fa-plus-square fa-fw" aria-hidden="true"></i>&nbsp;'.$txt.'</a>';
 });

 Form::macro('bsBtnBack', function ($act='.edit', $anchor='') { //
	 $routename=str_replace('.'.$act, '', Request::route()->getName());
	 if (!\Route::has($routename)) {
		 $routename=str_replace('.index', '', $routename);
	 }
	 if (!\Route::has($routename)) {
		 $routename.='.index';
	 }
	 //return $routename;
	 $params=\Route::current()->parameters();
	 //$prova=\Route::parameters();
	 $route=route($routename, $params);
	 $x=parse_url($route);
	 //print_r($x);
	 if (!isset($x['query'])) {
		 $x['query']='';
	 }
	 parse_str($x['query'], $var_get);
	 //echo '<pre>';print_r(array_values($var_get)[0]);echo '</pre>';
	 if ($x['query']!='') {
		 $anchor=array_values($var_get)[0];
	 }
	 return '<a class="btn btn-small btn-info" href="'.$x['path'].'#'.$anchor.'"><i class="fa fa-step-backward fa-fw" aria-hidden="true"></i>&nbsp;torna indietro</a>';
 });




Form::macro('bsDateTimeRangePicker_c', function ($name, $label = null, $value = null, $attributes = []) {
	//
	$theme=\App\Services\ThemeService::class;
	//global $theme;
	/*
	$element = '<div class="datepicker-input input-group date">';
	$element .= Form::text($name, $value ? $value : old($name), field_attributes($name, array_merge($attributes, ['data-input' => 'date'])));
	$element .= '<span class="input-group-addon">';
	$element .= '<i class="fa fa-calendar"></i>';
	$element .= '</span>';
	$element .= '</div>';
	*/
	Theme::addScript('/theme/js/datetimerangepickerX.js');
	//return 'aaa';/*field_wrapper($name, $label, $element, $attributes);*/
	//return Form::bsDateTimeRangePicker1
	return 'aa';
});
@endphp
