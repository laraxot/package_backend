<?php

namespace XRA\Backend\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use XRA\Extend\Traits\CrudSimpleTrait as CrudTrait;
use XRA\Extend\Traits\ArtisanTrait;

class BackendController extends Controller{

    public function index(Request $request){
        if ($request->routelist == 1) {
            return ArtisanTrait::exe('route:list');
        }
        $view = CrudTrait::getView();
        return view($view)->with('view', $view);
    }

    public function dashboard(Request $request){
    	$view = CrudTrait::getView();
        return view($view)->with('view', $view);
    }
}
