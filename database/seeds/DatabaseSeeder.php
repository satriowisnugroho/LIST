<?php 

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();

		DB::table('book_users')->delete();
		DB::table('books')->delete();
		DB::table('users')->delete();

		$this->call('BooksTableSeeder');
		$this->call('UsersTableSeeder');
		$this->call('BookUsersTableSeeder');
	}

}
