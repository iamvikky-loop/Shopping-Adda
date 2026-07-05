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

            [
                'name' => 'Fashion & Clothing',
                'slug' => Str::slug('Fashion & Clothing'),
                'description' => 'Discover the latest fashion trends for men, women, kids, and babies. Shop premium clothing, ethnic wear, sportswear, casual wear, and designer collections.',
                'image' => 'fashion-clothing.jpg',
                'banner' => 'fashion-banner.jpg',
                'icon' => 'fashion.png',
                'meta_title' => 'Fashion & Clothing | Shopping Adda',
                'meta_description' => 'Shop trendy fashion, clothing, dresses, jeans, shirts, ethnic wear and more at Shopping Adda.',
                'status' => 1,
            ],

            [
                'name' => 'Footwear',
                'slug' => Str::slug('Footwear'),
                'description' => 'Explore stylish footwear including sneakers, formal shoes, sandals, boots, heels, sports shoes and slippers for every occasion.',
                'image' => 'footwear.jpg',
                'banner' => 'footwear-banner.jpg',
                'icon' => 'footwear.png',
                'meta_title' => 'Footwear | Shopping Adda',
                'meta_description' => 'Buy branded shoes, sneakers, sandals, boots and slippers online.',
                'status' => 1,
            ],

            [
                'name' => 'Bags & Luggage',
                'slug' => Str::slug('Bags & Luggage'),
                'description' => 'Travel smart with backpacks, trolley bags, handbags, laptop bags, wallets and premium luggage accessories.',
                'image' => 'bags-luggage.jpg',
                'banner' => 'bags-banner.jpg',
                'icon' => 'bags.png',
                'meta_title' => 'Bags & Luggage | Shopping Adda',
                'meta_description' => 'Travel bags, backpacks, handbags, wallets and luggage at the best prices.',
                'status' => 1,
            ],

            [
                'name' => 'Jewelry & Watches',
                'slug' => Str::slug('Jewelry & Watches'),
                'description' => 'Premium jewellery collection including rings, necklaces, earrings, bracelets and luxury watches for every style.',
                'image' => 'jewelry.jpg',
                'banner' => 'jewelry-banner.jpg',
                'icon' => 'jewelry.png',
                'meta_title' => 'Jewelry & Watches | Shopping Adda',
                'meta_description' => 'Luxury jewellery, watches and fashion accessories online.',
                'status' => 1,
            ],

            [
                'name' => 'Beauty & Personal Care',
                'slug' => Str::slug('Beauty & Personal Care'),
                'description' => 'Everything you need for skincare, haircare, makeup, perfumes, grooming and beauty essentials.',
                'image' => 'beauty.jpg',
                'banner' => 'beauty-banner.jpg',
                'icon' => 'beauty.png',
                'meta_title' => 'Beauty & Personal Care | Shopping Adda',
                'meta_description' => 'Shop beauty products, skincare, haircare, makeup and perfumes.',
                'status' => 1,
            ],

            [
                'name' => 'Health & Wellness',
                'slug' => Str::slug('Health & Wellness'),
                'description' => 'Health supplements, vitamins, fitness accessories, wellness devices and healthcare essentials.',
                'image' => 'health.jpg',
                'banner' => 'health-banner.jpg',
                'icon' => 'health.png',
                'meta_title' => 'Health & Wellness | Shopping Adda',
                'meta_description' => 'Buy vitamins, supplements, health monitors and wellness products.',
                'status' => 1,
            ],

            [
                'name' => 'Electronics',
                'slug' => Str::slug('Electronics'),
                'description' => 'Latest smartphones, laptops, tablets, accessories, smart devices and consumer electronics.',
                'image' => 'electronics.jpg',
                'banner' => 'electronics-banner.jpg',
                'icon' => 'electronics.png',
                'meta_title' => 'Electronics | Shopping Adda',
                'meta_description' => 'Smartphones, laptops, gadgets and electronics online.',
                'status' => 1,
            ],

            [
                'name' => 'Mobile Accessories',
                'slug' => Str::slug('Mobile Accessories'),
                'description' => 'Phone cases, chargers, power banks, screen protectors, holders and mobile accessories.',
                'image' => 'mobile-accessories.jpg',
                'banner' => 'mobile-banner.jpg',
                'icon' => 'mobile.png',
                'meta_title' => 'Mobile Accessories | Shopping Adda',
                'meta_description' => 'Shop mobile cases, chargers, power banks and accessories.',
                'status' => 1,
            ],
[
    'name' => 'Gaming',
    'slug' => Str::slug('Gaming'),
    'description' => 'Gaming consoles, keyboards, gaming mouse, RGB accessories, VR headsets and professional gaming equipment.',
    'image' => 'gaming.jpg',
    'banner' => 'gaming-banner.jpg',
    'icon' => 'gaming.png',
    'meta_title' => 'Gaming | Shopping Adda',
    'meta_description' => 'Gaming accessories, consoles, gaming chairs and more.',
    'status' => 1,
],

[
    'name' => 'Home & Living',
    'slug' => Str::slug('Home & Living'),
    'description' => 'Decorate your home with stylish décor, lighting, storage, curtains, cushions and smart home essentials.',
    'image' => 'home-living.jpg',
    'banner' => 'home-living-banner.jpg',
    'icon' => 'home.png',
    'meta_title' => 'Home & Living | Shopping Adda',
    'meta_description' => 'Home décor, storage, lighting and furniture online.',
    'status' => 1,
],

[
    'name' => 'Kitchen & Dining',
    'slug' => Str::slug('Kitchen & Dining'),
    'description' => 'Cookware, dinnerware, kitchen appliances, organizers, bottles and dining essentials.',
    'image' => 'kitchen.jpg',
    'banner' => 'kitchen-banner.jpg',
    'icon' => 'kitchen.png',
    'meta_title' => 'Kitchen & Dining | Shopping Adda',
    'meta_description' => 'Kitchen appliances, cookware and dining essentials.',
    'status' => 1,
],

[
    'name' => 'Furniture',
    'slug' => Str::slug('Furniture'),
    'description' => 'Modern furniture including sofas, beds, wardrobes, tables, office furniture and storage solutions.',
    'image' => 'furniture.jpg',
    'banner' => 'furniture-banner.jpg',
    'icon' => 'furniture.png',
    'meta_title' => 'Furniture | Shopping Adda',
    'meta_description' => 'Premium furniture for your home and office.',
    'status' => 1,
],

[
    'name' => 'Baby Products',
    'slug' => Str::slug('Baby Products'),
    'description' => 'Baby clothing, toys, feeding products, strollers, safety products and newborn essentials.',
    'image' => 'baby-products.jpg',
    'banner' => 'baby-banner.jpg',
    'icon' => 'baby.png',
    'meta_title' => 'Baby Products | Shopping Adda',
    'meta_description' => 'Everything for babies in one place.',
    'status' => 1,
],

[
    'name' => 'Toys & Games',
    'slug' => Str::slug('Toys & Games'),
    'description' => 'Educational toys, puzzles, action figures, board games and fun activities for children.',
    'image' => 'toys.jpg',
    'banner' => 'toys-banner.jpg',
    'icon' => 'toys.png',
    'meta_title' => 'Toys & Games | Shopping Adda',
    'meta_description' => 'Educational toys, puzzles and games.',
    'status' => 1,
],

[
    'name' => 'Pet Supplies',
    'slug' => Str::slug('Pet Supplies'),
    'description' => 'Dog food, cat food, grooming products, toys, pet beds and health care supplies.',
    'image' => 'pets.jpg',
    'banner' => 'pets-banner.jpg',
    'icon' => 'pets.png',
    'meta_title' => 'Pet Supplies | Shopping Adda',
    'meta_description' => 'Food and accessories for your pets.',
    'status' => 1,
],

[
    'name' => 'Automotive',
    'slug' => Str::slug('Automotive'),
    'description' => 'Car and bike accessories, cleaning kits, seat covers, dash cameras and travel essentials.',
    'image' => 'automotive.jpg',
    'banner' => 'automotive-banner.jpg',
    'icon' => 'automotive.png',
    'meta_title' => 'Automotive | Shopping Adda',
    'meta_description' => 'Car accessories, bike accessories and automotive products.',
    'status' => 1,
],
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(
                ['slug' => $category['slug']],
                $category
            );
        }
    }
}