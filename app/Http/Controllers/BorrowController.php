<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Book as Book;
use App\User as User;
use App\BookUsers as BookUser;

use Illuminate\Http\Request;
use Auth;

class BorrowController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$user = Auth::user();
		$books = Book::all();

		$transactions = User::join('book_users', 'users.id', '=', 'book_users.user_id')
			->join('books', 'books.id', '=', 'book_users.book_id')
            ->select(
				'books.title',
				'users.name',
				'book_users.created_at',
				'book_users.updated_at',
				'book_users.status'
			)
            ->whereNotIn('status', ['pesan'])
            ->get();

		return view('operator.borrow.index',
			[
				'user' => $user,
				'books' => $books,
				'transactions' => $transactions
			]
		);
	}

	public function edit($id)
	{

		$userActive = Auth::user();
		$data = Book::find($id);
		if ($data->stock > 0) {
			$dataUser = User::where('role', 'member')->get();
			return view('operator.borrow.edit', ['user' => $userActive, 'dataUser' => $dataUser, 'book_id' => $data->id]);
		} else {
			return redirect('operator/borrow')
				->with('errorMessage', 'Tidak bisa meminjam buku. Stok buku habis.');
		}

	}

	public function update($id)
	{
		$user_id = \Request::input('user_id');
		$checkBorrowCount = BookUser::whereUser_idAndStatus($user_id, 'pinjam')->count();
		$checkOrderCount = BookUser::whereUser_idAndStatus($user_id, 'pesan')->count();
		$checkCount = $checkBorrowCount + $checkOrderCount;

		if($checkCount < 5)
		{

			$check = BookUser::whereUser_idAndBook_idAndStatus( $user_id, $id, 'pinjam' )->count();

			if ($check < 1) {

				$book = Book::find($id);
				$book->stock -= 1;
				$book->save();

				$data = new BookUser();
				$data->user_id = $user_id;
				$data->book_id = $id;
				$data->status = 'pinjam';
				$data->save();
				return redirect('operator/transactions')->with('successMessage', 'Berhasil meminjam buku.');

			} else {

				return redirect('operator/borrow')
					->with('errorMessage', 'User hanya bisa meminjam 1 buku dengan judul yang sama.');

			}

		}
		else
		{

			return redirect('operator/borrow')
				->with('errorMessage', 'User Hanya bisa memesan/meminjam 5 buku');

		}


	}

}
