<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model {

	protected $fillable = [
		'title', 
		'author',
		'publisher',
		'category',
		'date',
		'stock',
		'description'
	];

	public function users()
	{
		return $this->belongsToMany('App\User', 'book_users', 'id', 'user_id');
	}

}