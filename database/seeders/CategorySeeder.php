<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create([
            'name' => 'Batuk',
            'slug' => 'batuk',
            'icon' => 'batuk'
        ]);
        Category::create([
            'name' => 'Pilek',
            'slug' => 'pilek',
            'icon' => 'pilek'
        ]);
        Category::create([
            'name' => 'Sakit kepala',
            'slug' => 'sk',
            'icon' => 'sk'
        ]);
        Category::create([
            'name' => 'Sakit perut',
            'slug' => 'sp',
            'icon' => 'sp'
        ]);
        Category::create([
            'name' => 'Sakit kaki',
            'slug' => 'skaki',
            'icon' => 'skak'
        ]);
    }
}
