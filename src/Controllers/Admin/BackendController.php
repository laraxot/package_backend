<?php



namespace XRA\Backend\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//--- services
use XRA\Extend\Services\ThemeService;
//--- traits 
use XRA\Extend\Traits\ArtisanTrait;

class BackendController extends Controller
{
    public function index(Request $request)
    {
        if (1 == $request->routelist) {
            return ArtisanTrait::exe('route:list');
        }
        if (1 == $request->dusk) {
            //   \Artisan::queue('command:dusk');
            return ArtisanTrait::exe('dusk');
        }

        return ThemeService::view();
    }

    public function dashboard(Request $request)
    {
        if (1 == $request->routelist) {
            return ArtisanTrait::exe('route:list');
        }

        return ThemeService::view();
    }
}
