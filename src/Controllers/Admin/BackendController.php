<?php

namespace XRA\Backend\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use XRA\Extend\Traits\CrudSimpleTrait as CrudTrait;
//--- services
use XRA\Extend\Services\ThemeService;

class BackendController extends Controller
{
    public function index(Request $request)
    {
        if ($request->routelist == 1) {
            return ArtisanTrait::exe('route:list');
        }
        if ($request->dusk == 1) {
            //   \Artisan::queue('command:dusk');
            return ArtisanTrait::exe('dusk');
        }
        return ThemeService::view();
    }

    public function dashboard(Request $request)
    {
        if ($request->routelist == 1) {
            return ArtisanTrait::exe('route:list');
        }
        return ThemeService::view();
    }
}
