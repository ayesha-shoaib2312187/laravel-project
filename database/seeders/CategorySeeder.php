<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = ['Flowers', 'toys', 'bags', 'blankets', 'cardigan', 'beanies', 'keychains'];
        foreach ($categories as $cat) {
            \App\Models\Category::firstOrCreate(
                ['slug' => \Illuminate\Support\Str::slug($cat)],
                ['name' => ucfirst($cat)]
            );
        }
    }
}
