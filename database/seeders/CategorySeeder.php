<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [

            'Fashion & Clothing',
            'Footwear',
            'Bags & Luggage',
            'Jewelry & Watches',
            'Beauty & Personal Care',
            'Health & Wellness',
            'Electronics',
            'Mobile Accessories',
            'Gaming',
            'Home & Living',
            'Kitchen & Dining',
            'Furniture',
            'Baby Products',
            'Toys & Games',
            'Pet Supplies',
            'Automotive',
            'Sports & Outdoors',
            'Garden & Outdoor',
            'Office & Stationery',
            'Arts, Crafts & DIY',
            'Books & Education',
            'Travel',
            'Party & Events',
            'Gifts',
            'Eco-Friendly Products',
            'Seasonal Products',
            'Industrial & Business',
            'Smart Home',
            'Trending Niches',
            'Clearance & Offers',

        ];

        foreach ($categories as $category) {

            Category::updateOrCreate(

                [
                    'slug' => Str::slug($category),
                ],

                [
                    'name' => $category,
                    'status' => 1,
                ]

            );

        }
    }
}