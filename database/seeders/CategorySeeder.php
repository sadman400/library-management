<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['classname' => 'Fiction'],
            ['classname' => 'Non-Fiction'],
            ['classname' => 'Science & Technology'],
            ['classname' => 'History'],
            ['classname' => 'Biography'],
            ['classname' => 'Business & Economics'],
            ['classname' => 'Self-Help'],
            ['classname' => 'Children\'s Books'],
            ['classname' => 'Reference'],
            ['classname' => 'Academic']
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
