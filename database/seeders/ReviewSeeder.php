<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('reviews')->insert([
            'fingerprint' => Str::random(30),
            'review' => '1',
            'couponId' => '1',
            'storeName' => 'jumia'
        ]);
        DB::table('reviews')->insert([
            'fingerprint' => Str::random(30),
            'review' => '1',
            'couponId' => '1',
            'storeName' => 'jumia'
        ]);
        DB::table('reviews')->insert([
            'fingerprint' => Str::random(30),
            'review' => '1',
            'couponId' => '1',
            'storeName' => 'jumia'
        ]);
    }
}
