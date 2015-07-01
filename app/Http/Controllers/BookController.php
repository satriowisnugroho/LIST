<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Book as Book;
use App\BookUsers as BookUser;

use App\Http\Requests\BookRequest;
use App\Http\Requests\EditBookRequest;
use App\Http\Requests\BookUpdateRequest;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Storage;
use Input;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Validator;
use Redirect;
use Session;

class BookController extends WelcomeController
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $books = Book::all();
        $activeUser = Auth::user();
        return view('admin.books.index', ['books' => $books, 'user' => $activeUser]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $activeUser = Auth::user();
        return view('admin.books.create', ['user' => $activeUser]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(BookRequest $request)
    {

        if (Input::file('cover')->isValid()) {

            $file = Input::file('cover');
            $destinationPath = 'images/cover';
            $fileName = rand(11111, 99999) . '_' . $file->getClientOriginalName();
            Input::file('cover')->move($destinationPath, $fileName);

            $data = new Book();
            $data->fill($request->all());
            $data->cover = $fileName;
            $data->save();

            return Redirect('admin/books')->with(
                'successMessage',
                'Berhasil menambah buku.'
            );
        } else {
            return Redirect()->back();
        }

    }


    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        $activeUser = Auth::user();
        return view('admin.books.show', ['book' => Book::find($id), 'user' => $activeUser]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        $activeUser = Auth::user();
        return view('admin.books.edit', ['book' => Book::find($id), 'user' => $activeUser]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update(BookUpdateRequest $request, $id)
    {

        // proses create data
        $data = Book::find($id);
        $data->fill($request->all());
        $data->save();

        return Redirect('admin/books')->with(
            'successMessage',
            'Berhasil merubah data buku.'
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {

        $path = 'images/cover/';
        $data = Book::find($id);
        if ($data->delete()) {

            Storage::delete($path . $data->cover);
            return response()->json(['message' => 'Berhasil menghapus buku']);

        }

    }

    /**
     * Menampilkan category.
     *
     * @param  int $id
     * @return Response
     */
    public function category($category)
    {
        $ada = false;

        $activeUser = Auth::user();
        if ($category == 'computing') {
            $books = Book::whereCategory('computing & internet')->get();
            if ($books->count() != 0) {
                $ada = true;
            }
        } else {
            $books = Book::whereCategory($category)->get();
            if ($books->count() != 0) {
                $ada = true;
            }
        }

        if ($ada) {
            return view('books', [
                'books' => $books,
                'user' => $activeUser,
                'category' => $category
            ]);
        } else {
            return redirect()->back()
                ->with('category', 'Category ' . $category . ' belum tersedia');
        }

    }

    /**
     * Menampilkan detail buku.
     *
     * @param  int $id
     * @return Response
     */
    public function detail($id)
    {

        $activeUser = Auth::user();
        $book = Book::find($id);

        if ($activeUser) {
            $this->notif();
        }
        if ($this->notif) {
            return view('detail_book', [
                'book' => $book,
                'user' => $activeUser,
                'notif' => $this->notif,
                'length' => $this->length
            ]);
        }
        return view('detail_book', [
            'book' => $book,
            'user' => $activeUser
        ]);

    }

    /**
     * Menampilkan hasil query search (AJAX).
     *
     * @param  String $query
     * @return String
     */
    public function search($query)
    {

        $data = Book::where('title', 'like', '%' . $query . '%')->get();
        $result = '<div id="searching"><ul>';
        if ($data->count() != 0) {
            foreach ($data as $d) {
                $result .= '<li><a href="' . url('books/detail/' . $d->id) . '">' . $d->title . '</a></li>';
            }
            $result .= '</ul></div>';
            return $result;
        }
        $result .= 'Kata kunci tidak ditemukan';
        $result .= '</ul></div>';
        return $result;

    }


    /**
     * Menampilkan hasil query category (AJAX).
     *
     * @param  String $query
     * @return String
     */
    public function categoryQuery($query)
    {

        if ($query == 'ALL') {
            $data = Book::all()->take(9);
            $result = '<h2 class="title text-center">New Arrivals</h2>';
        } else {
            $data = Book::where('category', $query)->take(9)->get();
            $result = '<h2 class="title text-center">'.$query.'</h2>';
        }
        if ($data->count() != 0) {
            foreach ($data as $book) {
                $result .= '<div class="col-sm-4">
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                        <div class="productinfo text-center">
                                            <img src="' . url("image/".$book->id) . '" alt=""/>

                                            <h2></h2>

                                            <p><b>' . $book->title . '</b></p>

                                            <p style="font-size: smaller">' . $book->author . '</p>
                                        </div>
                                        <div class="product-overlay">
                                            <div class="overlay-content">
                                                <h2></h2>
                                                <h4 style="margin: 15px;font-weight:bold">' . $book->title . '</h4>

                                                <p style="margin:15px;text-align:justify">' . $book->description . '</p>

                                                <P style="color:#000">Stock : ' . $book->stock . '</P>' .
                    '<a href="' . route('order', $book->id) . '"
                                                   class="btn btn-default add-to-cart"><i
                                                            class="fa fa-book"></i>Order</a>
                                                <a href=' . url("books/detail/$book->id") . '
                                                   class="btn btn-default add-to-cart"><i
                                                            class="fa fa-eye"></i>Detail</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>';
            }
            return $result;
        }
        $result .= '<div class="col-sm-12" style="margin: 100px 0">
                        <center><h1>KATEGORI TIDAK TERSEDIA</h1></center>
                    </div>';
        return $result;

    }

    function json (){
        $data = Book::all();
        return($data->toJson());
    }

}
