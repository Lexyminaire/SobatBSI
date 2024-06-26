<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $menus = [
            ['name' => 'Mie Ayam', 'price' => 21500, 'is_available' => true, 'thumbnail' => 'thumbnails/Mie Ayam.jpeg'],
            ['name' => 'Mie Ayam Bakso', 'price' => 27000, 'is_available' => true, 'thumbnail' => 'thumbnails/Mie Ayam Bakso.jpeg'],
            ['name' => 'Mie Ayam Pangsit', 'price' => 27000, 'is_available' => true, 'thumbnail' => 'thumbnails/Mie Ayam Pangsit.jpeg'],
            ['name' => 'Mie Ayam Bakso Pangsit', 'price' => 32000, 'is_available' => true, 'thumbnail' => 'thumbnails/Mie Ayam Bakso Pangsit.jpeg'],

            ['name' => 'Bihun Ayam', 'price' => 21500, 'is_available' => true, 'thumbnail' => 'thumbnails/Bihun Ayam.jpeg'],
            ['name' => 'Bihun Ayam Bakso', 'price' => 27000, 'is_available' => true, 'thumbnail' => 'thumbnails/Bihun Ayam Bakso.jpeg'],
            ['name' => 'Bihun Ayam Pangsit', 'price' => 27000, 'is_available' => true, 'thumbnail' => 'thumbnails/Bihun Ayam Pangsit.jpeg'],
            ['name' => 'Bihun Ayam Bakso+Pangsit', 'price' => 32000, 'is_available' => true, 'thumbnail' => 'thumbnails/Bihun Ayam Bakso Pangsit.jpeg'],

            ['name' => 'Kwetiaw Ayam', 'price' => 21500, 'is_available' => true, 'thumbnail' => 'thumbnails/Kwetiaw Ayam.jpeg'],
            ['name' => 'Kwetiaw Ayam Bakso', 'price' => 27000, 'is_available' => true, 'thumbnail' => 'thumbnails/Kwetiaw Ayam Bakso.jpeg'],
            ['name' => 'Kwetiaw Ayam Pangsit', 'price' => 27000, 'is_available' => true, 'thumbnail' => 'thumbnails/Kwetiaw Ayam Pangsit.jpeg'],
            ['name' => 'Kwetiaw Ayam Bakso+Pangsit', 'price' => 32000, 'is_available' => true, 'thumbnail' => 'thumbnails/Kwetiaw Ayam Bakso Pangsit.jpeg'],

            ['name' => 'Bakso Kuah', 'price' => 17500, 'is_available' => true, 'thumbnail' => 'thumbnails/Bakso Kuah.jpeg'],
            ['name' => 'Pangsit Kuah', 'price' => 20000, 'is_available' => true, 'thumbnail' => 'thumbnails/Pangsit Kuah.jpeg'],
            ['name' => 'Bakso+Pangsit Kuah', 'price' => 20000, 'is_available' => true, 'thumbnail' => 'thumbnails/Bakso+Pangsit Kuah.jpeg'],
        ];

        foreach ($menus as $menu) {
            Menu::create($menu);
        }
    }
}
