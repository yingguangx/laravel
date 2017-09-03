<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::statement("SET foreign_key_checks=0");
		DB::table('users')->truncate();
		DB::statement("SET foreign_key_checks=1");
		
//		$super_admin = User::create([
//				'name' => "超级管理员",
//				'email' => 'zyg@163.com',
//				'password' => bcrypt('a123456'),
//				'remember_token' => str_random(10),
//		]);
//		$super_admin->save();
//
//		$admin = User::create([
//				'name' => "管理员",
//				'email' => 'ck@163.com',
//				'password' => bcrypt('a123456'),
//				'remember_token' => str_random(10),
//		]);
//		$admin->save();
//
//		$business_manager = User::create([
//				'name' => "业务经理",
//				'email' => 'ycg@163.com',
//				'password' => bcrypt('a123456'),
//				'remember_token' => str_random(10),
//		]);
//		$business_manager->save();
//
//		$officer = User::create([
//				'name' => "业务员",
//				'email' => 'zzq@163.com',
//				'password' => bcrypt('a123456'),
//				'remember_token' => str_random(10),
//		]);
//		$officer->save();
		
        $officer_users = factory(User::class, 50)->create();
	
	}
}
