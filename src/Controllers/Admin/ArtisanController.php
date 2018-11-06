<?php

namespace XRA\Backend\Controllers\Admin;

use App\Http\Controllers\Controller;
use Artisan;

class ArtisanController extends Controller
{
    public function exe($comando)
    {
        $output = '';
        try {
            Artisan::call($comando);
            $output .= '[' . Artisan::output() . ' ]';
            //return $output;  // dato che mi carico solo le route minime menufull.delete non esiste.. impostare delle route comuni.
        } catch (Exception $e) {
            echo '<br/>'.$comando.' non effettuato';
        }
        return view('backend::admin.index')->with('output', $output)->with('id_dashboard', 1);
    }
}
