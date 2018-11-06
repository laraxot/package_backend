<?php
namespace XRA\Backend\Controllers\Admin\Backend;

use Storage;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use App\Http\Controllers\Controller;
use XRA\Extend\Traits\CrudContainerItemTrait as CrudTrait;

class UploadCSVController extends Controller{

	public function store(Request $request){
		$data=$request->all();
    	$filename=$_POST['dir'].DIRECTORY_SEPARATOR.$_POST['name'];
		if($_POST['seek']==0){
			$fp = fopen($filename, 'w');
		}else{
			$fp = fopen($filename, 'ab');
			fseek($fp, $_POST['seek']);
		}
		fwrite($fp, $_POST['chunk']);
		fclose ($fp);
		$ris=[
			'filename'=>$filename,
			'path'=>realpath($filename),
			'seek'=>$_POST['seek'],
			//'chunck' =>  $_POST['chunk'],
		];

		echo json_encode($ris);    
    }

}