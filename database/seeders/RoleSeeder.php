<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [
            [
                'id'            => Str::slug('SUPERADMIN'),
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'id'            => Str::slug('PARTICIPANT'),
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
        ];

        foreach($items as $item){
            DB::table('roles')->insert($item);
        }
    }
}
