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
    public function run(): void
    {
        //
        
        User::create([
            'id'=>1,
            'name'=>"User",
        'email'=>'user@fcpms.com',
        'password'=>Hash::make("12345678"),
        ]);
    }
}
