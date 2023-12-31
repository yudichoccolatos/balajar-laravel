<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        User::create([
            'name'=> 'wahyudi',
            'email'=> 'wahyudi@gmail.com',
            'password'=> Hash::make('S3mp4kb4s4h+'),
            'email_verified_at'=>now()
        ]);
    }
}
