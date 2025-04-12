<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User;
        $user->username = "Samiha_Joyeeta";
        $user->registration_number = "1000000";
        $user->email = "samihasumaia6@gmail.com";
        $user->password = md5("Adminpassword28@");
        $user->phone_number = "01613-005654";
        $user->user_type = 1;
        $user->save();
        
        return redirect()->route('users.create');
    }
}
