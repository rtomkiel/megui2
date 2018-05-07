<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Eloquent::unguard();
        $this->call('UserSeederTable');
    }
    
}

class UserSeederTable extends Seeder {
    public function run()
    {
        $users = App\User::get();
        if($users->count() == 0){
            App\User::create(array(
                'email' => 'admin@email.com',
                'password' => Hash::make('admin'),
                'name' => 'Administrator',
                'user' => 'admin',
                'type' => 'admin',
                'image' => '1admin-admin.'
            ));
        }
    }
}
