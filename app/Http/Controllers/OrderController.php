<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Auth;
use App\Book as Book;
use App\User as User;
use App\BookUsers as BookUser;

class OrderController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $user = Auth::user();
        $books = Book::all();

        $transactions = User::order()->get();

        return view('operator.order.index',
            [
                'user' => $user,
                'books' => $books,
                'transactions' => $transactions
            ]
        );
    }

    /**
     * Proses pinjam buku dari pesanan member.
     *
     * @return Response
     */
    public function process($id)
    {
        $data = BookUser::find($id);
        $data->status = 'pinjam';
        $data->save();

        return redirect('operator/transactions');
    }

    /**
     * Proses order buku dari member.
     *
     * @return Response
     */
    public function order($id)
    {

        if(Auth::user()->name)
        {

            $stock = Book::find($id)->stock;

            if ($stock > 0) {

                $user_id = Auth::user()->id;
                $checkBorrowCount = BookUser::whereUser_idAndStatus($user_id, 'pinjam')->count();
                $checkOrderCount = BookUser::whereUser_idAndStatus($user_id, 'pesan')->count();
                $checkCount = $checkBorrowCount + $checkOrderCount;

                if ($checkCount < 5) {

                    $checkBorrow = BookUser::whereUser_idAndBook_idAndStatus($user_id, $id, 'pinjam')->count();
                    $checkOrder = BookUser::whereUser_idAndBook_idAndStatus($user_id, $id, 'pesan')->count();

                    if ($checkBorrow < 1 && $checkOrder < 1) {

                        $book = Book::find($id);
                        $book->stock -= 1;
                        $book->save();

                        $data = new BookUser();
                        $data->user_id = $user_id;
                        $data->book_id = $id;
                        $data->status = 'pesan';
                        $data->save();
                        return redirect('/')->with(
                            'message',
                            'Berhasil memesan buku '.$book->title
                        );

                    } else {

                        return redirect('/')
                            ->withErrors('Hanya bisa memesan/meminjam 1 buku dengan judul yang sama.');

                    }

                } else {

                    return redirect('/')
                        ->withErrors('Hanya bisa memesan/meminjam 5 buku');

                }

            } else {

                return redirect('/')
                    ->withErrors('Stok buku kosong');

            }

        }
        else
        {

            return redirect('/')->with('requiredName', $id);

        }



    }

}
