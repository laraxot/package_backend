<?php

namespace XRA\Backend\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Artisan;

class ArtisanController extends Controller
{
    public function exe($comando)
    {
        try {
            $output = '';
            
            Artisan::call($comando);
            $output .= '[<pre>' . Artisan::output() . '</pre>]';
            return $output;  // dato che mi carico solo le route minime menufull.delete non esiste.. impostare delle route comuni.
        } catch (Exception $e) {
            return '<br/>'.$comando.' non effettuato';
        }
        //return view('Backend::admin.index')->with('output', $output);
    }
}
