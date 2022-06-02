<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Seller;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
Admin::create([
'name'=>'Admin',
'phone'=>'01616209034',
'email'=>'admin@mail.com',
'email_verified_at'=>null,
'password'=>Hash::make('111111')
]);
Seller::create([
'name'=>'Seller',
'shop'=>'msn',
'email'=>'seller@mail.com',
'email_verified_at'=>null,
'password'=>Hash::make('111111')
]);
User::create([
'name'=>'User',
'email'=>'user@mail.com',
'email_verified_at'=>null,
'password'=>Hash::make('111111')
]);



    }
}
