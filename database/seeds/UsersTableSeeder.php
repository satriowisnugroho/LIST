<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class UsersTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{

		$users = array(
			array(
				'id' => 1, 
				'name' => 'Satrio Wisnugroho', 
				'email' => 'wisnugrohosatrio@gmail.com', 
				'role' => 'admin', 
				'password' => bcrypt('admin123')
			),
			array(
				'id' => 2, 
				'name' => 'List Operator', 
				'email' => 'operator@list.com', 
				'role' => 'operator', 
				'password' => bcrypt('operator123')
			 ),
			array(
				'id' => 3, 
				'name' => 'List Member', 
				'email' => 'member@list.com', 
				'role' => 'member',
				'password' => bcrypt('member123')
			 )
		);

		foreach ($users as $user) {
			App\User::create($user);
		}

	}

}
