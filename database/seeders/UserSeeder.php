<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (Schema::hasTable('users')) {
            User::query()->truncate();

            User::create([
                'name'              => "Abdullah Al Mamun",
                'email'             => "admin@admin.com",
                'email_verified_at' => now(),
                'password'          => bcrypt(12345678),
                'remember_token'    => Str::random(10),
                'designation'       => 'Web App Developer',
                'phone' => '01967141689',
                'quote' => 'I code simple things beautifully and I love what I do :)',
                'status' => 'Online'
            ]);
        }
    }
}
