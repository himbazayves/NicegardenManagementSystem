<?php
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => Str::random(10),
            'email' => 'mugiranezahimbaza06@gmail.com',
            'password' => Hash::make('password'),
            'userable_type'=>'App\Admin',
            'userable_id'=>1
        ]);


        // User::factory()
        // ->count(50)
        // // ->hasPosts(1)
        // ->create();
    }
}
