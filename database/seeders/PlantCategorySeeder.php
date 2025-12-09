<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; 
use App\Models\PlantCategory; 

class PlantCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        PlantCategory::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $categories = [
            [
                'category_name' => 'Tanaman Hias Daun',
                'description' => 'Tanaman yang dinikmati keindahan bentuk dan warna daunnya.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_name' => 'Tanaman Hias Bunga',
                'description' => 'Tanaman yang dibudidayakan karena keindahan bunganya.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_name' => 'Kaktus dan Sukulen',
                'description' => 'Tanaman yang dapat menyimpan air di batang atau daunnya.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_name' => 'Tanaman Obat (Toga)',
                'description' => 'Tanaman yang memiliki khasiat untuk kesehatan atau obat-obatan herbal.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_name' => 'Tanaman Buah',
                'description' => 'Tanaman yang dibudidayakan untuk menghasilkan buah.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_name' => 'Sayuran',
                'description' => 'Tanaman hortikultura yang dikonsumsi sebagai sayur.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_name' => 'Tanaman Air',
                'description' => 'Tanaman yang hidup dan tumbuh di media air.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_name' => 'Tanaman Merambat',
                'description' => 'Tanaman yang tumbuh dengan cara merambat atau menjalar.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        PlantCategory::insert($categories);
    }
}