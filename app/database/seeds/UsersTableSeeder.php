<?php

class UsersTableSeeder extends Seeder{

	public function run()
	{
		DB::table('users')->delete();

		User::create(
			array(
				'username' => 'admin',
				'email' => 'admin@rst-soepraoen.com',
				'password' => Hash::make('admin1'),
				'name' => 'Administrator',
				'group_id' => 1,
			)
		);
		User::create(
			array(
				'username' => 'kasir',
				'email' => 'kasir@gmail.com',
				'password' => Hash::make('kasir1'),
				'name' => 'Kasir',
				'group_id' => 2,
			)
		);
		User::create(
			array(
				'username' => 'inap',
				'email' => 'rawatinap@gmail.com',
				'password' => Hash::make('inap1'),
				'name' => 'User Rawat Inap',
				'group_id' => 3,
			)
		);
		User::create(
			array(
				'username' => 'jalan',
				'email' => 'doni.arif@gmail.com',
				'password' => Hash::make('jalan1'),
				'name' => 'User Rawat Jalan',
				'group_id' => 4,
			)
		);
		User::create(
			array(
				'username' => 'ugd',
				'email' => 'ade.setiawan@gmail.com',
				'password' => Hash::make('ugd1'),
				'name' => 'User UGD',
				'group_id' => 5,
			)
		);
		User::create(
			array(
				'username' => 'mawar',
				'email' => 'sriwahyuni@gmail.com',
				'password' => Hash::make('mawar1'),
				'name' => 'User Mawar',
				'group_id' => 6,
			)
		);
		User::create(
			array(
				'username' => 'flamboyan',
				'email' => 'marfin@gmail.com',
				'password' => Hash::make('flamboyan1'),
				'name' => 'User Flamboyan',
				'group_id' => 7,
			)
		);
		User::create(
			array(
				'username' => 'apotik_dinas',
				'email' => 'imam.rahmadi@gmail.com',
				'password' => Hash::make('dinas1'),
				'name' => 'User Apotik Dinas',
				'group_id' => 8,
			)
		);
		User::create(
			array(
				'username' => 'apotik_askes',
				'email' => 'yudo.diponegoro@gmail.com',
				'password' => Hash::make('askes1'),
				'name' => 'User Apotik Askes',
				'group_id' => 9,
			)
		);
	}
}