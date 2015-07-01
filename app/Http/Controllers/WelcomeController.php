<?php namespace App\Http\Controllers;

use App\Book as Book;
use App\BookUsers as BookUser;
use Auth;
use Carbon;

class WelcomeController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | Welcome Controller
    |--------------------------------------------------------------------------
    |
    | This controller renders the "marketing page" for the application and
    | is configured to only allow guests. Like most of the other sample
    | controllers, you are free to modify or remove it as you desire.
    |
    */

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public $length;
    public $notif = [];

    public function notif()
    {
        $notif = [];
        $data = BookUser::join('books', 'book_users.book_id', '=', 'books.id')
            ->select(
                'title',
                'book_users.created_at'
            )
            ->whereUser_idAndStatus(Auth::user()->id, 'pinjam')->get();
        foreach ($data as $d) {
            if ($d->created_at->diffInDays(new Carbon\Carbon()) > 6) {
                $notif[] = $d;
                $this->length++;
            }
        }
        $this->notif = $notif;
    }

    /**
     * Show the application welcome screen to the user.
     *
     * @return Response
     */
    public function index()
    {
        $books = Book::orderBy('created_at', 'desc')->take(9)->get();
        $activeUser = Auth::user();

        if ($activeUser) {
            $this->notif();
        }
        if ($this->notif) {
            return view('home', [
                'books' => $books,
                'user' => $activeUser,
                'notif' => $this->notif,
                'length' => $this->length
            ]);
        }
        return view('home', [
            'books' => $books,
            'user' => $activeUser
        ]);
    }

}
