<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User as User;
use App\BookUsers as BookUser;

use App\Http\Requests\UserRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Requests\RegisterMemberRequest;
use App\Http\Requests\ResetRequest;
use Illuminate\Http\Request;
use Auth;
use Mail;
use Hash;

class UserController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$userActive = Auth::user();
		if ($userActive->role == 'admin') {
			$users = User::whereNotIn('role', ['admin'])->get();
		} else {
			$users = User::whereNotIn('role', ['operator', 'admin'])->get();
		}
		return view('users.index', ['users' => $users, 'user' => $userActive]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$userActive = Auth::user();
		return view('users.create', ['user' => $userActive]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(UserRequest $request)
	{
		$userActive = Auth::user();

		$string = str_random(6);

		Mail::send('emails.create_user', ['password' => $string], function ($message)
		{
			$message->to(\Request::input('email'), \Request::input('name'))->subject('Informasi Akun list.com');
		});

		$data = new User();
		$data->fill($request->all());
		$data->password = bcrypt($string);
		$data->role = \Request::input('role');
		$data->save();

		if ($userActive->role == 'admin') {
			return Redirect('admin/users')
				->with(
					'successMessage',
					'Berhasil menambah user. Password akan dikirim ke email user.'
				);
		} else {
			return Redirect('operator/users')
				->with(
					'successMessage',
					'Berhasil menambah user. Password akan dikirim ke email user.'
				);
		}

	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{

		$userActive = Auth::user();
		return view('users.edit', ['user' => $userActive, 'userData' => User::find($id)]);
		
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(UserRequest $request, $id)
	{
		$userActive = Auth::user();
		$data = User::find($id);
		$data->name = \Request::input('name');
		$data->email = \Request::input('email');
		$data->role = \Request::input('role');
		$data->save();

		if ($userActive->role == 'admin') {
			return Redirect('admin/users')->with(
				'successMessage',
				'Berhasil mengubah data user.'
			);
		} else {
			return Redirect('operator/users')->with(
				'successMessage',
				'Berhasil mengubah data user.'
			);
		}

	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{

			$data = User::find($id);
			if($data->delete())
			{
				return response()->json(['message' => 'Berhasil menghapus user']);
			}
		
	}


	public function reset($id)
	{
		$string = str_random(6);

		$data = User::find($id);
		$data->password = bcrypt($string);

		Mail::send('emails.reset', ['password' => $string], function ($message) use ($data)
		{
			$message->to($data->email, $data->name)->subject('RESET PASSWORD');
		});

		$data->save();

		return redirect()->back()->with(
			'successMessage', 
			'Berhasil mereset password. Password baru telah dikirim ke email user.'
		);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function editProfile()
	{

		$userActive = Auth::user();
		return view('users.profile', ['user' => $userActive, 'userData' => User::find($userActive->id)]);

	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function updateProfile(UserUpdateRequest $request, $id)
	{
		$userActive = Auth::user();
		$data = User::find($id);

		if (Hash::check(\Request::input('oldPassword'), $data->password)) {

			$data->name = \Request::input('name');
			$data->email = \Request::input('email');
			$data->password = bcrypt(\Request::input('password'));
			$data->save();

			if ($userActive->role == 'admin') {
				return Redirect('admin')->with('successMessage', 'Berhasil merubah data profil.');
			} elseif($userActive->role == 'admin') {
				return Redirect('operator')->with('successMessage', 'Berhasil merubah data profil.');
			} else {
				return Redirect('/')->with('message', 'Berhasil merubah data profil.');
			}

		} else {

			return redirect()->back()->withErrors('Password lama yang anda masukkan salah.');

		}

	}

	/**
	 * Update name in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function updateName($id)
	{

		$data = User::find($id);
		$data->name = \Request::input('name');
		$data->save();

		return response()->json(['message' => 'Berhasil mengisi data nama']);

	}

	/**
	 * Register user.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function register(RegisterMemberRequest $request)
	{

		$data = new User();
		$data->email = \Request::input('email');
		$data->password = bcrypt(\Request::input('password'));
		$data->role = 'member';
		$data->save();

		return redirect('/')->with('message', 'Silahkan login kembali');

	}

	/**
	 * Send password reset link.
	 *
	 * @return Response
	 */
	public function resetLink()
	{

		$email = \Request::input('email');
		$link = \Request::input('_token');

		$data = User::whereEmail($email)->get();
		if($data->count() != 0)
		{
			foreach($data as $d)
			{
				$id = $d->id;
			}
			$user = User::find($id);
			$user->remember_token = $link;
			Mail::send('emails.reset_link', ['link' => $link], function ($message) use ($user)
			{
				$message->to($user->email, $user->name)->subject('PASSWORD RESET LINK');
			});
			$user->save();

			return redirect('/')->with(
				'message',
				'Link reset password telah dikirim ke email anda. \n Silahkan cek email anda.'
			);
		}

		return redirect('/login')->with(
			'warning',
			'Email '.$email.' tidak terdaftar di sistem.'
		);

	}

	/**
	 * Menampilkan form reset password.
	 *
	 * @return Response
	 */
	public function resetForm($token)
	{

		$data = User::whereRemember_token($token)->get();
		if($data->count() != 0)
		{
			foreach($data as $d)
			{
				$id = $d->id;
			}
			$user = User::find($id);
			return view('auth2.reset', ['user' => $user]);
		}
		return view('errors.404');

	}

	/**
	 * Proses reset password.
	 *
	 * @return Response
	 */
	public function resetPassword(ResetRequest $request)
	{

		$data = User::find(\Request::input('id'));
		$data->password = bcrypt(\Request::input('password'));
		$data->save();

		return redirect('/')->with(
			'message',
			'Berhasil mereset password anda. \n Silahkan login kembali'
		);

	}

}
