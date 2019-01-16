<?php



namespace XRA\Backend\Controllers\Admin\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UploadCSVController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->all();
        $filename = $_POST['dir'].\DIRECTORY_SEPARATOR.$_POST['name'];
        if (0 == $_POST['seek']) {
            $fp = \fopen($filename, 'w');
        } else {
            $fp = \fopen($filename, 'a');
            \fseek($fp, $_POST['seek']);
        }
        \fwrite($fp, $_POST['chunk']);
        \fclose($fp);
        $ris = [
            'filename' => $filename,
            'path' => \realpath($filename),
            'seek' => $_POST['seek'],
            //'chunck' =>  $_POST['chunk'],
        ];

        echo \json_encode($ris);
    }
}
