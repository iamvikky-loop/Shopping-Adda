<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\SubCategory;

class SubCategorySeeder extends Seeder
{
    public function run(): void
    {
        $data = [

            // ==========================
            // Fashion & Clothing
            // ==========================

            'Fashion & Clothing' => [
                "Men's Clothing",
                "Women's Clothing",
                "Kids' Clothing",
                "Baby Clothing",
                "Plus Size Fashion",
                "Activewear",
                "Sportswear",
                "Hoodies & Sweatshirts",
                "T-Shirts",
                "Shirts",
                "Jeans",
                "Pants & Trousers",
                "Shorts",
                "Jackets & Coats",
                "Sweaters",
                "Dresses",
                "Skirts",
                "Lingerie",
                "Sleepwear",
                "Socks",
                "Underwear",
                "Ethnic Wear",
                "Wedding Clothing",
                "Maternity Wear",
            ],

            // ==========================
            // Footwear
            // ==========================

            'Footwear' => [
                "Men's Shoes",
                "Women's Shoes",
                "Kids' Shoes",
                "Sneakers",
                "Running Shoes",
                "Walking Shoes",
                "Formal Shoes",
                "Casual Shoes",
                "Boots",
                "Sandals",
                "Slippers",
                "Loafers",
                "Heels",
                "Flats",
                "Shoe Care Accessories",
            ],

            // ==========================
            // Bags & Luggage
            // ==========================

            'Bags & Luggage' => [
                "Backpacks",
                "Laptop Bags",
                "School Bags",
                "Travel Bags",
                "Duffel Bags",
                "Suitcases",
                "Cabin Luggage",
                "Handbags",
                "Tote Bags",
                "Sling Bags",
                "Crossbody Bags",
                "Wallets",
                "Card Holders",
                "Passport Holders",
                "Luggage Accessories",
            ],

            // ==========================
            // Jewelry & Watches
            // ==========================

            'Jewelry & Watches' => [
                "Necklaces",
                "Earrings",
                "Rings",
                "Bracelets",
                "Bangles",
                "Anklets",
                "Pendants",
                "Luxury Watches",
                "Smart Watches",
                "Couple Jewelry",
                "Customized Jewelry",
                "Watch Accessories",
            ],

            // ==========================
            // Beauty & Personal Care
            // ==========================

            'Beauty & Personal Care' => [
                "Face Care",
                "Body Care",
                "Hair Care",
                "Hair Styling",
                "Makeup",
                "Lip Care",
                "Eye Makeup",
                "Nail Care",
                "Beard Care",
                "Men's Grooming",
                "Women's Grooming",
                "Perfumes",
                "Deodorants",
                "Beauty Tools",
                "Hair Styling Tools",
                "Oral Care",
                "Bath Essentials",
                "Feminine Hygiene",
            ],
                // ==========================
// Health & Wellness
// ==========================

'Health & Wellness' => [
    "Vitamins",
    "Supplements",
    "Protein Powder",
    "Weight Management",
    "Yoga Equipment",
    "Resistance Bands",
    "Dumbbells",
    "Massage Devices",
    "Posture Correctors",
    "Health Monitors",
    "Blood Pressure Monitors",
    "Thermometers",
    "Smart Health Devices",
],

// ==========================
// Electronics
// ==========================

'Electronics' => [
    "Smartphones",
    "Tablets",
    "Laptops",
    "Desktop Computers",
    "Monitors",
    "Printers",
    "Keyboards",
    "Mouse",
    "Headphones",
    "Earbuds",
    "Bluetooth Speakers",
    "Webcams",
    "Smart Watches",
    "Smart Rings",
    "Power Banks",
    "Chargers",
    "Cables",
    "Memory Cards",
    "USB Drives",
    "Computer Accessories",
    "Networking Equipment",
],

// ==========================
// Mobile Accessories
// ==========================

'Mobile Accessories' => [
    "Phone Cases",
    "Screen Protectors",
    "Phone Holders",
    "Selfie Sticks",
    "Ring Holders",
    "Fast Chargers",
    "Wireless Chargers",
    "Car Chargers",
    "Camera Lens Attachments",
    "Mobile Skins",
],

// ==========================
// Gaming
// ==========================

'Gaming' => [
    "Gaming Consoles",
    "Gaming Keyboards",
    "Gaming Mouse",
    "Gaming Chairs",
    "Gaming Desks",
    "Controllers",
    "VR Accessories",
    "RGB Lighting",
    "Gaming Headsets",
    "Microphones",
],

// ==========================
// Home & Living
// ==========================

'Home & Living' => [
    "Home Decor",
    "Wall Art",
    "Clocks",
    "Mirrors",
    "Artificial Plants",
    "Rugs",
    "Curtains",
    "Cushions",
    "Blankets",
    "Candles",
    "Storage Boxes",
    "Laundry Accessories",
    "Cleaning Supplies",
    "Furniture",
    "Smart Home Devices",
],
// ==========================
// Kitchen & Dining
// ==========================

'Kitchen & Dining' => [
    "Cookware",
    "Bakeware",
    "Kitchen Gadgets",
    "Kitchen Appliances",
    "Storage Containers",
    "Water Bottles",
    "Coffee Accessories",
    "Tea Accessories",
    "Cutlery",
    "Dinnerware",
    "Kitchen Organizers",
    "Air Fryer Accessories",
    "Blender Accessories",
],

// ==========================
// Furniture
// ==========================

'Furniture' => [
    "Office Chairs",
    "Gaming Chairs",
    "Study Tables",
    "Coffee Tables",
    "Dining Tables",
    "Sofas",
    "TV Units",
    "Bookshelves",
    "Shoe Racks",
    "Wardrobes",
    "Bedside Tables",
],

// ==========================
// Baby Products
// ==========================

'Baby Products' => [
    "Baby Toys",
    "Baby Clothing",
    "Baby Feeding",
    "Baby Strollers",
    "Baby Carriers",
    "Baby Bedding",
    "Baby Safety Products",
    "Baby Care",
    "Diaper Bags",
    "Baby Furniture",
],

// ==========================
// Toys & Games
// ==========================

'Toys & Games' => [
    "Educational Toys",
    "RC Cars",
    "Dolls",
    "Action Figures",
    "Building Blocks",
    "Board Games",
    "Puzzles",
    "STEM Toys",
    "Outdoor Toys",
    "Musical Toys",
],

// ==========================
// Pet Supplies
// ==========================

'Pet Supplies' => [
    "Dog Food",
    "Cat Food",
    "Pet Toys",
    "Pet Beds",
    "Pet Clothing",
    "Grooming Products",
    "Feeding Bowls",
    "Pet Carriers",
    "Aquariums",
    "Bird Supplies",
    "Pet Health",
],
// ==========================
// Automotive
// ==========================

'Automotive' => [
    "Car Accessories",
    "Bike Accessories",
    "Car Cleaning",
    "Seat Covers",
    "Phone Mounts",
    "Dash Cameras",
    "LED Lights",
    "Car Perfumes",
    "Tire Accessories",
    "Emergency Kits",
],

// ==========================
// Sports & Outdoors
// ==========================

'Sports & Outdoors' => [
    "Camping Equipment",
    "Hiking Gear",
    "Cycling",
    "Fishing",
    "Cricket Equipment",
    "Football Equipment",
    "Basketball Equipment",
    "Badminton Equipment",
    "Swimming Gear",
    "Gym Equipment",
    "Travel Accessories",
],

// ==========================
// Garden & Outdoor
// ==========================

'Garden & Outdoor' => [
    "Gardening Tools",
    "Plant Pots",
    "Seeds",
    "Fertilizers",
    "Watering Equipment",
    "Outdoor Furniture",
    "BBQ Equipment",
    "Outdoor Lighting",
],

// ==========================
// Office & Stationery
// ==========================

'Office & Stationery' => [
    "Office Supplies",
    "Pens",
    "Pencils",
    "Notebooks",
    "Diaries",
    "Planners",
    "Desk Organizers",
    "Whiteboards",
    "Office Furniture",
    "Printer Accessories",
],

// ==========================
// Arts, Crafts & DIY
// ==========================

'Arts, Crafts & DIY' => [
    "Painting Supplies",
    "Drawing Supplies",
    "Craft Kits",
    "Resin Art",
    "Sewing Supplies",
    "Knitting Supplies",
    "DIY Tools",
    "Scrapbooking",
],
// ==========================
// Books & Education
// ==========================

'Books & Education' => [
    "Fiction Books",
    "Non-Fiction Books",
    "Children's Books",
    "Educational Books",
    "Language Learning",
    "Exam Preparation",
    "Journals",
    "Coloring Books",
],

// ==========================
// Travel
// ==========================

'Travel' => [
    "Luggage",
    "Travel Organizers",
    "Passport Holders",
    "Neck Pillows",
    "Travel Bottles",
    "Portable Fans",
    "Travel Electronics",
],

// ==========================
// Party & Events
// ==========================

'Party & Events' => [
    "Birthday Decorations",
    "Wedding Decorations",
    "Anniversary Decorations",
    "Baby Shower Decorations",
    "Balloons",
    "Party Supplies",
    "Gift Wrapping",
    "Return Gifts",
],

// ==========================
// Gifts
// ==========================

'Gifts' => [
    "Personalized Gifts",
    "Gift Boxes",
    "Photo Frames",
    "Mugs",
    "Keychains",
    "Greeting Cards",
    "Anniversary Gifts",
    "Birthday Gifts",
    "Wedding Gifts",
    "Corporate Gifts",
],

// ==========================
// Eco-Friendly Products
// ==========================

'Eco-Friendly Products' => [
    "Reusable Bottles",
    "Bamboo Products",
    "Compost Bins",
    "Reusable Bags",
    "Solar Lights",
    "Eco-Friendly Kitchenware",
    "Sustainable Home Products",
],
// ==========================
// Seasonal Products
// ==========================

'Seasonal Products' => [
    "Christmas",
    "Halloween",
    "Valentine's Day",
    "Easter",
    "Mother's Day",
    "Father's Day",
    "Diwali",
    "Raksha Bandhan",
    "Eid",
    "New Year",
    "Holi",
    "Thanksgiving",
],

// ==========================
// Industrial & Business
// ==========================

'Industrial & Business' => [
    "Safety Equipment",
    "Packaging Supplies",
    "Warehouse Equipment",
    "Commercial Kitchen Equipment",
    "Office Equipment",
    "Cleaning Equipment",
],

// ==========================
// Smart Home
// ==========================

'Smart Home' => [
    "Smart Lights",
    "Smart Switches",
    "Smart Plugs",
    "Security Cameras",
    "Video Doorbells",
    "Motion Sensors",
    "Smart Locks",
    "Smart Thermostats",
    "Smart Sensors",
],

// ==========================
// Trending Niches
// ==========================

'Trending Niches' => [
    "AI Gadgets",
    "Portable Electronics",
    "Ergonomic Office Products",
    "Home Office Essentials",
    "LED Decor",
    "Sleep Products",
    "Wellness Devices",
    "Smart Fitness Equipment",
    "Electric Scooters",
    "Drone Accessories",
    "Sustainable Products",
    "Creator Equipment",
    "Podcast Equipment",
    "Photography Accessories",
    "Streaming Equipment",
    "Wearable Technology",
    "Minimalist Lifestyle Products",
    "Organization & Storage",
    "Remote Work Essentials",
    "Digital Lifestyle Accessories",
],

// ==========================
// Clearance & Offers
// ==========================

'Clearance & Offers' => [
    "Flash Sale",
    "Today's Deals",
    "Best Sellers",
    "New Arrivals",
    "Limited Time Offers",
    "Clearance Sale",
    "Combo Deals",
    "Bundle Offers",
],
        ];

        foreach ($data as $categoryName => $subCategories) {

            $category = Category::where('name', $categoryName)->first();

            if (!$category) {
                continue;
            }

            foreach ($subCategories as $name) {

                SubCategory::updateOrCreate(
                    [
                        'slug' => Str::slug($name),
                    ],
                    [
                        'category_id' => $category->id,
                        'name' => $name,
                        'slug' => Str::slug($name),
                        'image' => strtolower(str_replace([' ', '&', "'"], ['-', '', ''], $name)) . '.jpg',
                        'description' => $name . ' available at the best price on Shopping Adda.',
                        'status' => 1,
                    ]
                );
            }
        }
    }
}