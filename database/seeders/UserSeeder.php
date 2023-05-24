<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [
            [
                'id'                => 'INT-'.strtoupper(Str::random('10')),
                'role'              => Str::slug('SUPERADMIN'),
                'name'              => 'Super Admin',
                'email'             => 'superadmin@example.com',
                'email_verified_at' => now(),
                'password'          => bcrypt('password123!'),
                'created_at'        => now(),
                'updated_at'        => now(),
            ]
        ];

        foreach($items as $item){
            DB::table('users')->insert($item);
        }
    }
}
