<?php
namespace XRA\Backend\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

use Illuminate\Http\Request;
use Response;
use Carbon\Carbon;


//---- custom rules ---
//use Xot\Trasferte\Rules\UppercaseRule; // solo per test
//use Xot\Trasferte\Rules\DateTimeRangeRule; 

class ProfileRequest extends FormRequest{
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize(){
		return true;
	}
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules(){
		return [
			'first_name' => 'required|min:3|max:50',
			'last_name' => 'required|min:3|max:50',
			'email' => 'email',
			'passwd' => 'required|confirmed|min:6',
			
		];
	}
	 /**
	 * Custom message for validation
	 *
	 * @return array
	 */
	public function messages(){
		return [
			'id_luogo_start_txt.required' => 'Luogo Partenza Obbligario!',
			'id_luogo_end_txt.required' => 'Luogo Trasferta Obbligatorio!',
			'id_motivo.required' => 'Motivo Obbligatorio!',
			'note.required' => 'Ampliamento obbligatorio ',
			'id_mezzo_proprio.required_if'=>'selezionare motivo mezzo proprio',
			'distanza.required_if'=>'inserire la distanza ipotetica',
		];
	}
	/**
	 *  Filters to be applied to the input.
	 *
	 * @return array
	 */
	public function filters(){
		return [
			'email' => 'trim|lowercase',
			'name' => 'trim|capitalize|escape'
		];
	}


}