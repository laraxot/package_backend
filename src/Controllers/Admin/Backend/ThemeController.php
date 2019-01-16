<?php



namespace XRA\Backend\Controllers\Admin\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//--- services
use XRA\Extend\Services\ThemeService;

class ThemeController extends Controller
{
    public function index(Request $request)
    {
        $params = \Route::current()->parameters();
        $path = public_path('themes');
        $dirs = \File::directories($path);
        //echo '<h3>['.($path).']</h3>';
        $rows = [];
        foreach ($dirs as $dir) {
            $tmp = new \stdClass();
            $tmp->id = \basename($dir);
            $tmp->img_src = url('themes/'.\basename($dir).'/screenshot.png');
            $rows[] = $tmp;
        }

        return ThemeService::addViewParam('rows', $rows)->view();
    }

    //end function

    public function edit(Request $request)
    {
        $params = \Route::current()->parameters();
        \extract($params);
        $msg = 'Theme ['.$id_theme.']!';
        setConfig([
            'file' => 'xra.php',
            'data' => ['adm_theme' => $id_theme],
            ]);
        \Session::flash('status', $msg.' '.\Carbon\Carbon::now());

        return \Redirect::back();
    }
}//end class
