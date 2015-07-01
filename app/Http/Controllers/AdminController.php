<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use App\Book as Book;

use Illuminate\Http\Request;

class AdminController extends Controller {

	public function index()
	{		
		$user = Auth::user();
		$comp = Book::whereCategory('computing & internet')->get();
		$cooking = Book::whereCategory('cooking')->get();
		$education = Book::whereCategory('education')->get();
		$health = Book::whereCategory('health')->get();
		$medical = Book::whereCategory('medical')->get();
		$novel = Book::whereCategory('novel')->get();
		$photography = Book::whereCategory('photography')->get();
		$religion = Book::whereCategory('religion')->get();

		return view('admin.index', [
			'user' => $user,
			'comp' => $comp,
			'cooking' => $cooking,
			'education' => $education,
			'health' => $health,
			'medical' => $medical,
			'novel' => $novel,
			'photography' => $photography,
			'religion' => $religion
		]);
	}

}
