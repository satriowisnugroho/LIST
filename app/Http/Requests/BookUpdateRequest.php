<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class BookUpdateRequest extends Request {

	public function authorize() {
		return true;
	}

	public function rules() {

		$id = $this->route()->parameter('books');

		return [
			'title' => 'required|unique:books,title,'.$id,
			'author' => 'required',
			'publisher' => 'required',
			'category' => 'required',
			'date' => 'required',
			'stock' => 'required',
			'description' => 'required'
		];
	}

}
