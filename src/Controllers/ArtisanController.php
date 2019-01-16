<?php



namespace XRA\Backend\Controllers;

use App\Http\Controllers\Controller;
use Artisan;

class ArtisanController extends Controller
{
    public function exe($command, array $arguments = [])
    {
        try {
            $output = '';

            Artisan::call($command, $arguments);
            $output .= '[<pre>'.Artisan::output().'</pre>]';

            return $output;  // dato che mi carico solo le route minime menufull.delete non esiste.. impostare delle route comuni.
        } catch (Exception $e) {
            return '<br/>'.$command.' non effettuato';
        }
        //return view('Backend::admin.index')->with('output', $output);
    }
}
