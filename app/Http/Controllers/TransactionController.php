<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Auth;
use App\User as User;
use App\Book as Book;
use App\BookUsers as BookUsers;

class TransactionController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$user = Auth::user();
		$books = Book::all();

		$transactions = User::transactionBorrow()->orderBy('created_at', 'desc')->get();

		return view('operator.transactions.index', 
			[
				'user' => $user, 
				'books' => $books, 
				'transactions' => $transactions
			]
		);
	}

	public function update($id)
	{
		$book = Book::find(\Request::input('book_id'));
		$book->stock += 1;
		$book->save();

		$data = BookUsers::find($id);
		$data->status = \Request::input('status');
		$data->save();

		return redirect('operator/transactions');
	}

}
