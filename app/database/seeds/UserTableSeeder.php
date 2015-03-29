<?php


class UserTableSeeder extends Seeder {
    public function run()
    {
        User::create([
            'email'    => 'Shuangjiao.Cao@gmail.com',
            'password' => Hash::make('afldtvenus'),
            'is_admin' => 1,
        ]);
    }
}