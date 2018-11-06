<?php
// to study
//https://laraveldaily.com/laravel-ajax-file-upload-blueimp-jquery-library/
//https://hafiznor.wordpress.com/2016/07/05/laravel-import-read-excel-file-use-chunk-to-avoid-memory-fatal-error/
//https://github.com/blueimp/jQuery-File-Upload/wiki/Chunked-file-uploads
//https://github.com/peinhu/AetherUpload-Laravel // in jappo
//https://github.com/pionl/laravel-chunk-upload  // quello in uso 
//https://hackernoon.com/resumable-file-upload-in-php-handle-large-file-uploads-in-an-elegant-way-e6c6dfdeaedb
//https://quickadminpanel.com/blog/file-upload-in-laravel-the-ultimate-guide/
//https://medium.com/@barryvdh/streaming-large-csv-files-with-laravel-chunked-queries-4158e484a5a2
//https://github.com/axios/axios come guzzle e sizzle ?
//https://colorlib.com/wp/jquery-file-upload-scripts/
//https://www.grok-interactive.com/blog/import-large-csv-into-mysql-with-php-part-1/
// https://www.willstyle.co.jp/blog/326/ solo perche' jappo
// https://tutsforweb.com/15-laravel-collection-methods/
// https://www.sitepoint.com/performant-reading-big-files-php/
// https://www.jasny.net/bootstrap/  // missing components  ??



namespace XRA\Backend\Controllers\Admin\Backend;

use Storage;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Pion\Laravel\ChunkUpload\Exceptions\UploadMissingFileException;
use Pion\Laravel\ChunkUpload\Handler\AbstractHandler;
use Pion\Laravel\ChunkUpload\Handler\HandlerFactory;
use Pion\Laravel\ChunkUpload\Receiver\FileReceiver;


use App\Http\Controllers\Controller;

use XRA\Extend\Traits\CrudContainerItemTrait as CrudTrait;

class UploadController extends Controller{

	//*
	public function store(Request $request){
		return $this->upload($request);
	}
	//*/
	/*
	public function store(FileReceiver $request) {
		return $this->uploadFile($request);
	}
	//*/
	/**
	 * Handles the file upload
	 *
	 * @param Request $request
	 *
	 * @return \Illuminate\Http\JsonResponse
	 *
	 * @throws UploadMissingFileException
	 * @throws \Pion\Laravel\ChunkUpload\Exceptions\UploadFailedException
	 */
	public function uploadFile(FileReceiver $receiver){
		// check if the upload is success, throw exception or return response you need
		if ($receiver->isUploaded() === false) {
			throw new UploadMissingFileException();
		}
		// receive the file
		$save = $receiver->receive();

		// check if the upload has finished (in chunk mode it will send smaller files)
		if ($save->isFinished()) {
			// save the file and return any response you need
			return $this->saveFile($save->getFile());
		}

		// we are in chunk mode, lets send the current progress
		/** @var AbstractHandler $handler */
		$handler = $save->handler();
		return response()->json([
			"done" => $handler->getPercentageDone()
		]);
	}


	public function upload(Request $request) {
		// create the file receiver
		$receiver = new FileReceiver("file", $request, HandlerFactory::classFromRequest($request));

		// check if the upload is success, throw exception or return response you need
		if ($receiver->isUploaded() === false) {
			throw new UploadMissingFileException();
		}

		// receive the file
		$save = $receiver->receive();

		// check if the upload has finished (in chunk mode it will send smaller files)
		if ($save->isFinished()) {
			// save the file and return any response you need, current example uses `move` function. If you are
			// not using move, you need to manually delete the file by unlink($save->getFile()->getPathname())
			return $this->saveFile($save->getFile());
		}

		// we are in chunk mode, lets send the current progress
		/** @var AbstractHandler $handler */
		$handler = $save->handler();

		return response()->json([
			"done" => $handler->getPercentageDone(),
			'status' => true
		]);
	}

	/**
	 * Saves the file to S3 server
	 *
	 * @param UploadedFile $file
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	protected function saveFileToS3($file){
		$fileName = $this->createFilename($file);

		$disk = Storage::disk('s3');
		// It's better to use streaming Streaming (laravel 5.4+)
		$disk->putFileAs('photos', $file, $fileName);

		// for older laravel
		// $disk->put($fileName, file_get_contents($file), 'public');
		$mime = str_replace('/', '-', $file->getMimeType());

		// We need to delete the file when uploaded to s3
		unlink($file->getPathname());

		return response()->json([
			'path' => $disk->url($fileName),
			'name' => $fileName,
			'mime_type' =>$mime
		]);
	}

	/**
	 * Saves the file
	 *
	 * @param UploadedFile $file
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	protected function saveFile(UploadedFile $file){
		$fileName = $this->createFilename($file);
		// Group files by mime type
		$mime = str_replace('/', '-', $file->getMimeType());
		// Group files by the date (week
		$dateFolder = date("Y-m-W");
		$extension = $file->getClientOriginalExtension();
		// Build the file path
		//$filePath = "upload/{$mime}/{$dateFolder}/";
		//$filePath = "upload/{$mime}/";
		$filePath = "uploads/{$extension}/";
		//$finalPath = storage_path("app/".$filePath);
		$finalPath = public_path($filePath);

		// move the file name
		$file->move($finalPath, $fileName);

		return response()->json([
			'path' => $filePath,
			'name' => $fileName,
			'mime_type' => $mime
		]);
	}

	/**
	 * Create unique filename for uploaded file
	 * @param UploadedFile $file
	 * @return string
	 */
	protected function createFilename(UploadedFile $file){
		$extension = $file->getClientOriginalExtension();
		$filename = str_replace(".".$extension, "", $file->getClientOriginalName()); // Filename without extension

		// Add timestamp hash to name of the file
		//$filename .= "_" . md5(time()) . "." . $extension;
		$filename .= "." . $extension;

		return $filename;
	}
}