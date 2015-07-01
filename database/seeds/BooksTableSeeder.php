<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class BooksTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{

		$books = array(
			array(
				'id' => 1, 
				'title' => 'The Fault in Our Stars', 
				'author' => 'John Green', 
				'publisher' => 'Qanita', 
				'category' => 'Novel',
				'date' => '2012', 
				'stock' => 9,
				'cover' => 'the_fault_in_our_stars.jpg',
				'description' => 'Lorem ipsum dolor sit amet,
				consectetur adipisicing elit. Excepturi nesciunt error, 
				id, eaque aut quia quasi omnis, dignissimos commodi vero eveniet 
				tempore blanditiis molestias voluptatem, iusto. Sit, debitis consequatur non'
			),
			array(
				'id' => 2,
			 	'title' => 'Rekayasa Web', 
			 	'author' => "Janner Simarmata",
			 	'publisher' => 'Andi Publisher', 
			 	'category' => 'Computing & Internet',
			 	'date' => '2012', 
			 	'stock' => 7,
				'cover' => 'rekayasa_web.jpg',
				'description' => 'Lorem ipsum dolor sit amet, 
				consectetur adipisicing elit. Excepturi nesciunt error, 
				id, eaque aut quia quasi omnis, dignissimos commodi vero eveniet 
				tempore blanditiis molestias voluptatem, iusto. Sit, debitis consequatur non'
			 ),
			array(
				'id' => 3, 
				'title' => 'Ketika Menikah Jadi Pilihan', 
				'author' => 'ADIL ABDUL MUNIM ABU ABBAS', 
				'publisher' => 'ALMAHIRA', 
				'category' => 'Religion',
				'date' => '2008', 
				'stock' => 5,
				'cover' => 'ketika_menikah_jadi_pilihan.jpg',
				'description' => 'Lorem ipsum dolor sit amet, 
				consectetur adipisicing elit. Excepturi nesciunt error, 
				id, eaque aut quia quasi omnis, dignissimos commodi vero eveniet 
				tempore blanditiis molestias voluptatem, iusto. Sit, debitis consequatur non'
			),
			array(
				'id' => 4,
				'title' => '500 Rahasia Cantik Alami',
				'author' => 'Author Example',
				'publisher' => 'Publisher Example',
				'category' => 'Health',
				'date' => '2013',
				'stock' => 5,
				'cover' => '500_rahasia_cantik_alami_bebas_jerawat.jpg',
				'description' => 'Lorem ipsum dolor sit amet,
				consectetur adipisicing elit. Excepturi nesciunt error,
				id, eaque aut quia quasi omnis, dignissimos commodi vero eveniet
				tempore blanditiis molestias voluptatem, iusto. Sit, debitis consequatur non'
			),
			array(
				'id' => 5,
				'title' => 'Anak Anak Cemerlang',
				'author' => 'Author Example',
				'publisher' => 'Publisher Example',
				'category' => 'Education',
				'date' => '2013',
				'stock' => 5,
				'cover' => 'anak_anak_cemerlang.jpg',
				'description' => 'Lorem ipsum dolor sit amet,
				consectetur adipisicing elit. Excepturi nesciunt error,
				id, eaque aut quia quasi omnis, dignissimos commodi vero eveniet
				tempore blanditiis molestias voluptatem, iusto. Sit, debitis consequatur non'
			),
			array(
				'id' => 6,
				'title' => 'Dashyatnya Pengobatan Hewan',
				'author' => 'Author Example',
				'publisher' => 'Publisher Example',
				'category' => 'medical',
				'date' => '2013',
				'stock' => 5,
				'cover' => 'dashyatnya_pengobatan_hewan.jpg',
				'description' => 'Lorem ipsum dolor sit amet,
				consectetur adipisicing elit. Excepturi nesciunt error,
				id, eaque aut quia quasi omnis, dignissimos commodi vero eveniet
				tempore blanditiis molestias voluptatem, iusto. Sit, debitis consequatur non'
			),
			array(
				'id' => 7,
				'title' => 'Food Photography',
				'author' => 'Author Example',
				'publisher' => 'Publisher Example',
				'category' => 'Photography',
				'date' => '2013',
				'stock' => 5,
				'cover' => 'food_photography_dari_foto_biasa_jadi_luar_biasa.jpg',
				'description' => 'Lorem ipsum dolor sit amet,
				consectetur adipisicing elit. Excepturi nesciunt error,
				id, eaque aut quia quasi omnis, dignissimos commodi vero eveniet
				tempore blanditiis molestias voluptatem, iusto. Sit, debitis consequatur non'
			),
			array(
				'id' => 8,
				'title' => 'Jus Sehat Golongan Darah AB',
				'author' => 'Author Example',
				'publisher' => 'Publisher Example',
				'category' => 'Health',
				'date' => '2013',
				'stock' => 5,
				'cover' => 'jus_sehat_golongan_darah_ab.jpg',
				'description' => 'Lorem ipsum dolor sit amet,
				consectetur adipisicing elit. Excepturi nesciunt error,
				id, eaque aut quia quasi omnis, dignissimos commodi vero eveniet
				tempore blanditiis molestias voluptatem, iusto. Sit, debitis consequatur non'
			),
			array(
				'id' => 9,
				'title' => 'Karya Tulis Ilmiah',
				'author' => 'Author Example',
				'publisher' => 'Publisher Example',
				'category' => 'Education',
				'date' => '2013',
				'stock' => 5,
				'cover' => 'karya_tulis_ilmiah.jpg',
				'description' => 'Lorem ipsum dolor sit amet,
				consectetur adipisicing elit. Excepturi nesciunt error,
				id, eaque aut quia quasi omnis, dignissimos commodi vero eveniet
				tempore blanditiis molestias voluptatem, iusto. Sit, debitis consequatur non'
			)
		);

		foreach ($books as $book) {
			App\Book::create($book);
		}

	}

}
