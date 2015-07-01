<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\BookUsers as BookUsers;

class BookUsersTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		
		DB::table('book_users')->delete();

		$book_users = array(
			array(
				'id' => 1, 
				'user_id' => 3, 
				'book_id' => 1,
				'status' => 'pesan'
			),
			array(
				'id' => 2, 
				'user_id' => 3,
				'book_id' => 2,
				'status' => 'pinjam'
			),
			array(
				'id' => 3, 
				'user_id' => 3,
				'book_id' => 3,
				'status' => 'kembali'
			)
		);

		foreach ($book_users as $book) {
			BookUsers::create($book);
		}

	}

}
