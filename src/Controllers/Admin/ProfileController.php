<?php

namespace XRA\Backend\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use XRA\Extend\Traits\CrudSimpleTrait as CrudTrait;
use XRA\Extend\Traits\ArtisanTrait;

//-------- requests ----------
use XRA\Backend\Requests\ProfileRequest;


class ProfileController extends Controller{
	use CrudTrait;

	public function getModel(){
		$model=config('auth.providers.users.model');
		return new $model; 	
	}

	public function index(Request $request){
		// utente normale non deve vedere da qui la lista degli utenti.. esiste in front end
	    return redirect()->route('profile.edit',['id_profile'=>'my']);
	}
	public function show(Request $request){
		// utente normale non deve vedere da qui la dettaglio utente.. esiste in front end
	    return redirect()->route('profile.edit',['id_profile'=>'my']);
	}

	public function edit(Request $request){
		//edit esiste solo per il proprio profilo
		$row=\Auth::user();
		$view=CrudTrait::getView();
		return view($view)->with('view',$view)->with('row',$row);
	}

	public function update(ProfileRequest $request){
		//update esiste solo per il proprio profilo
		$data=$request->all();
		$row=\Auth::user();
		$row->update($data);
		\Session::flash('status', 'aggiornato! '.$row->handle);
        return back()->withInput();
		
	}



}
