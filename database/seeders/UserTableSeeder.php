<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use DB;
use Hash;
use Carbon\Carbon;

class UserTableSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
    DB::table('users')->delete();
    User::create(array(
        'name'     => 'sasi',
        'email'    => 'sasi_kumaran@ymail.com',
        'password' => Hash::make('11111111'),
        'email_verified_at' => Carbon::now()->format('Y-m-d H:i:s'),
    ));
    }
}
