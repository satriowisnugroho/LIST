<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use App\BookUsers as BookUser;

use Illuminate\Http\Request;

class OperatorController extends Controller {

	public function index()
	{
		$user = Auth::user();
		$pinjam = BookUser::whereStatus('pinjam')->get();
		$kembali = BookUser::whereStatus('kembali')->get();
		$pesan = BookUser::whereStatus('pesan')->get();

		return view('operator.index', [
			'user' => $user,
			'pinjam' => $pinjam,
			'kembali' => $kembali,
			'pesan' => $pesan
		]);
	}

}
