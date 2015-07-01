<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class BookRequest extends Request {

	public function authorize() {
		return true;
	}

	public function rules() {
		return [
			'title' => 'required|unique:books',
			'author' => 'required',
			'publisher' => 'required',
			'category' => 'required',
			'date' => 'required',
			'stock' => 'required',
			'cover' => 'required',
			'description' => 'required'
		];
	}

}
