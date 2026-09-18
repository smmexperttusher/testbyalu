<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderAddress;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Review;
use App\Models\Role;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class MarketplaceCategoryProductSeeder extends Seeder
{
    public function run(): void
    {
        $vendorRole = Role::firstOrCreate(['name' => 'vendor'], ['display_name' => 'Vendor']);
        $customerRole = Role::firstOrCreate(['name' => 'customer'], ['display_name' => 'Customer']);

        // 1. Seed 14 General Marketplace Categories
        $categoriesData = [
            ['name' => 'Grocery', 'slug' => 'grocery', 'icon' => 'shopping-basket', 'description' => 'Rice, Dal, Edible Oil, Spices, Flour and daily kitchen essentials'],
            ['name' => 'Electronics', 'slug' => 'electronics', 'icon' => 'tv', 'description' => 'Smart TVs, sound systems, cameras, and audio gear'],
            ['name' => 'Fashion', 'slug' => 'fashion', 'icon' => 'shirt', 'description' => 'Men, Women and Kids clothing, traditional & casual wear'],
            ['name' => 'Beauty & Personal Care', 'slug' => 'beauty-personal-care', 'icon' => 'sparkles', 'description' => 'Skincare, haircare, fragrances, and personal hygiene'],
            ['name' => 'Mobile & Accessories', 'slug' => 'mobile-accessories', 'icon' => 'smartphone', 'description' => 'Smartphones, power banks, chargers, cases, and earphones'],
            ['name' => 'Computers', 'slug' => 'computers', 'icon' => 'laptop', 'description' => 'Laptops, desktops, monitors, keyboards, and networking'],
            ['name' => 'Home & Living', 'slug' => 'home-living', 'icon' => 'home', 'description' => 'Furniture, home decor, bedding, and storage organizers'],
            ['name' => 'Appliances', 'slug' => 'appliances', 'icon' => 'refrigerator', 'description' => 'Refrigerators, blenders, microwave ovens, and washing machines'],
            ['name' => 'Shoes & Bags', 'slug' => 'shoes-bags', 'icon' => 'briefcase', 'description' => 'Sneakers, formal shoes, leather backpacks, and luggage'],
            ['name' => 'Baby & Kids', 'slug' => 'baby-kids', 'icon' => 'baby', 'description' => 'Baby food, diapers, toys, stroller, and kids fashion'],
            ['name' => 'Sports & Fitness', 'slug' => 'sports-fitness', 'icon' => 'dumbbell', 'description' => 'Gym equipment, sports gear, cricket bats, and activewear'],
            ['name' => 'Books & Stationery', 'slug' => 'books-stationery', 'icon' => 'book-open', 'description' => 'Academic books, novels, office supplies, and notebooks'],
            ['name' => 'Automotive', 'slug' => 'automotive', 'icon' => 'car', 'description' => 'Motorbike helmets, car accessories, engine oils, and tools'],
            ['name' => 'Tools & Hardware', 'slug' => 'tools-hardware', 'icon' => 'wrench', 'description' => 'Power drills, hand toolkits, electrical supplies, and hardware'],
        ];

        $categoryMap = [];
        foreach ($categoriesData as $index => $cat) {
            $createdCat = Category::firstOrCreate(
                ['slug' => $cat['slug']],
                [
                    'name' => $cat['name'],
                    'icon' => $cat['icon'],
                    'description' => $cat['description'],
                    'order_index' => $index + 1,
                    'is_featured' => true,
                    'is_active' => true,
                ]
            );
            $categoryMap[$cat['slug']] = $createdCat;
        }

        // 2. Seed Brands
        $brandsData = [
            ['name' => 'Teer', 'slug' => 'teer'],
            ['name' => 'Pran', 'slug' => 'pran'],
            ['name' => 'Square Consumer', 'slug' => 'square-consumer'],
            ['name' => 'Samsung', 'slug' => 'samsung'],
            ['name' => 'Walton', 'slug' => 'walton'],
            ['name' => 'Vision', 'slug' => 'vision'],
            ['name' => 'Apex', 'slug' => 'apex'],
            ['name' => 'Nivea', 'slug' => 'nivea'],
            ['name' => 'Kiam', 'slug' => 'kiam'],
            ['name' => 'Anker', 'slug' => 'anker'],
            ['name' => 'Lenovo', 'slug' => 'lenovo'],
            ['name' => 'HP', 'slug' => 'hp'],
            ['name' => 'Hatil', 'slug' => 'hatil'],
            ['name' => 'Ingco', 'slug' => 'ingco'],
            ['name' => 'Motul', 'slug' => 'motul'],
        ];

        $brandMap = [];
        foreach ($brandsData as $b) {
            $brandMap[$b['slug']] = Brand::firstOrCreate(
                ['slug' => $b['slug']],
                ['name' => $b['name'], 'is_featured' => true, 'is_active' => true]
            );
        }

        // 3. Seed Diverse General Marketplace Vendors
        $vendorsList = [
            [
                'email' => 'vendor.grocery@shwapno-mart.bd',
                'name' => 'Azizur Rahman (Shwapno Express Mart)',
                'store_name' => 'Shwapno Daily Mart',
                'store_slug' => 'shwapno-daily-mart',
                'desc' => 'Certified daily groceries, Miniket and Nazirshail rice, fortified edible oils, and fresh pantry essentials.',
                'phone' => '01819000101',
                'comm' => 5.00,
                'address' => 'Plot 8, Road 2, Gulshan-1, Dhaka',
            ],
            [
                'email' => 'vendor.electro@bengaltech.bd',
                'name' => 'Mahmudul Hasan (ElectroBD Mega Store)',
                'store_name' => 'ElectroBD Mega Store',
                'store_slug' => 'electrobd-mega-store',
                'desc' => 'Authorized distributor of original smartphones, home electronics, and genuine accessories.',
                'phone' => '01911000102',
                'comm' => 7.00,
                'address' => 'Level 4, Multiplan Center, Elephant Road, Dhaka',
            ],
            [
                'email' => 'vendor.home@bengalhome.bd',
                'name' => 'Farhana Sultana (Bengal Home & Living)',
                'store_name' => 'Bengal Home & Living',
                'store_slug' => 'bengal-home-living',
                'desc' => 'Modern kitchen appliances, non-stick cookware, storage, and home lifestyle utilities.',
                'phone' => '01712000103',
                'comm' => 8.00,
                'address' => 'Mirpur 10, Dhaka-1216',
            ],
            [
                'email' => 'vendor.fashion@dhakalifestyle.bd',
                'name' => 'Anwar Hossain (Dhaka Lifestyle & Apparel)',
                'store_name' => 'Dhaka Lifestyle & Apparel',
                'store_slug' => 'dhaka-lifestyle-apparel',
                'desc' => 'Premium casual wear, Polo shirts, panjabis, sarees and footwear from certified local artisans.',
                'phone' => '01819000104',
                'comm' => 10.00,
                'address' => 'Sector 7, Uttara, Dhaka-1230',
            ],
            [
                'email' => 'vendor.hardware@dhakatools.bd',
                'name' => 'Shafikul Islam (Pioneer Tools & Auto)',
                'store_name' => 'Pioneer Tools & Auto Store',
                'store_slug' => 'pioneer-tools-auto',
                'desc' => 'Original power drills, hand toolkits, motorcycle lubricants, and hardware essentials.',
                'phone' => '01715000105',
                'comm' => 8.00,
                'address' => 'Nawabpur Road, Old Dhaka',
            ],
        ];

        $vendorModelMap = [];
        foreach ($vendorsList as $vData) {
            $user = User::firstOrCreate(
                ['email' => $vData['email']],
                [
                    'name' => $vData['name'],
                    'phone' => $vData['phone'],
                    'password' => Hash::make('password123'),
                    'status' => 'active',
                    'email_verified_at' => now(),
                ]
            );
            $user->roles()->syncWithoutDetaching([$vendorRole->id]);

            $vendor = Vendor::firstOrCreate(
                ['store_slug' => $vData['store_slug']],
                [
                    'user_id' => $user->id,
                    'store_name' => $vData['store_name'],
                    'description' => $vData['desc'],
                    'phone' => $vData['phone'],
                    'email' => $vData['email'],
                    'address' => $vData['address'],
                    'commission_percentage' => $vData['comm'],
                    'approval_status' => 'approved',
                    'status' => 'active',
                    'approved_at' => now(),
                ]
            );
            $vendorModelMap[$vData['store_slug']] = $vendor;
        }

        // 4. Seed Real Multi-Category Products covering:
        // Rice, Dal, Oil, Phone, Laptop, Headphones, Saree, Shoes, Cosmetics, Furniture, Books, Appliances, Tools, Auto
        $products = [
            // --- Rice ---
            [
                'vendor' => 'shwapno-daily-mart',
                'category' => 'grocery',
                'brand' => 'pran',
                'name' => 'Pran Premium Nazirshail Aromatic Rice (5 kg Bag)',
                'slug' => 'pran-premium-nazirshail-rice-5kg',
                'sku' => 'GROC-RICE-5KG',
                'regular_price' => 490.00,
                'sale_price' => 450.00,
                'stock' => 80,
                'short_description' => 'Selected fine polished high-grade Nazirshail rice with authentic grain aroma.',
                'image' => 'https://images.unsplash.com/photo-1586201375761-83865001e31c?w=500&auto=format&fit=crop&q=80',
                'is_featured' => true,
            ],
            [
                'vendor' => 'shwapno-daily-mart',
                'category' => 'grocery',
                'brand' => 'square-consumer',
                'name' => 'Chashi Aromatic Kalijira Polao Rice (1 kg)',
                'slug' => 'chashi-aromatic-kalijira-rice-1kg',
                'sku' => 'GROC-RICE-KALIJIRA',
                'regular_price' => 195.00,
                'sale_price' => 175.00,
                'stock' => 50,
                'short_description' => 'Export-quality pure Kalijira rice, perfect for royal biryani, polao and payesh.',
                'image' => 'https://images.unsplash.com/photo-1536304993881-ff6e9eefa2a6?w=500&auto=format&fit=crop&q=80',
                'is_featured' => true,
            ],

            // --- Dal ---
            [
                'vendor' => 'shwapno-daily-mart',
                'category' => 'grocery',
                'brand' => 'pran',
                'name' => 'Selected Deshi Masoor Dal (1 kg Pack)',
                'slug' => 'selected-deshi-masoor-dal-1kg',
                'sku' => 'GROC-DAL-1KG',
                'regular_price' => 155.00,
                'sale_price' => 140.00,
                'stock' => 60,
                'short_description' => 'Cleaned, stoneless nutritious red lentils for delicious daily dal.',
                'image' => 'https://images.unsplash.com/photo-1585994192701-f1a505c817ea?w=500&auto=format&fit=crop&q=80',
                'is_featured' => true,
            ],
            [
                'vendor' => 'shwapno-daily-mart',
                'category' => 'grocery',
                'brand' => 'square-consumer',
                'name' => 'Radhuni Premium Polished Moong Dal (1 kg)',
                'slug' => 'radhuni-premium-moong-dal-1kg',
                'sku' => 'GROC-DAL-MOONG-1KG',
                'regular_price' => 190.00,
                'sale_price' => 170.00,
                'stock' => 40,
                'short_description' => 'Golden yellow, high-protein split mung bean lentils for rich bhuna dal.',
                'image' => 'https://images.unsplash.com/photo-1599488615731-7e5c2823ff28?w=500&auto=format&fit=crop&q=80',
                'is_featured' => false,
            ],

            // --- Oil ---
            [
                'vendor' => 'shwapno-daily-mart',
                'category' => 'grocery',
                'brand' => 'teer',
                'name' => 'Teer Fortified Pure Soybean Oil (5 Litre Can)',
                'slug' => 'teer-fortified-pure-soybean-oil-5l',
                'sku' => 'GROC-OIL-5L',
                'regular_price' => 930.00,
                'sale_price' => 890.00,
                'stock' => 50,
                'short_description' => 'Vitamin A and D enriched pure vegetable soybean oil for everyday family cooking.',
                'image' => 'https://images.unsplash.com/photo-1474979266404-7eaacbcd87c5?w=500&auto=format&fit=crop&q=80',
                'is_featured' => true,
            ],
            [
                'vendor' => 'shwapno-daily-mart',
                'category' => 'grocery',
                'brand' => 'square-consumer',
                'name' => 'Radhuni Pure Cold-Pressed Mustard Oil (1 Litre)',
                'slug' => 'radhuni-pure-mustard-oil-1l',
                'sku' => 'GROC-MUST-1L',
                'regular_price' => 340.00,
                'sale_price' => 310.00,
                'stock' => 45,
                'short_description' => 'Traditional pungent mustard oil ideal for bhortas, pickles, and deshi curries.',
                'image' => 'https://images.unsplash.com/photo-1627485937980-221c88ac04f9?w=500&auto=format&fit=crop&q=80',
                'is_featured' => true,
            ],

            // --- Phone ---
            [
                'vendor' => 'electrobd-mega-store',
                'category' => 'mobile-accessories',
                'brand' => 'samsung',
                'name' => 'Samsung Galaxy A55 5G (8GB RAM / 128GB ROM, Official Warranty)',
                'slug' => 'samsung-galaxy-a55-5g-8-128',
                'sku' => 'MOB-SAM-A55',
                'regular_price' => 42000.00,
                'sale_price' => 38500.00,
                'stock' => 12,
                'short_description' => 'Super AMOLED 120Hz display, 50MP OIS camera, and 5000mAh battery.',
                'image' => 'https://images.unsplash.com/photo-1511707171634-5f897ff02aa9?w=500&auto=format&fit=crop&q=80',
                'is_featured' => true,
            ],
            [
                'vendor' => 'electrobd-mega-store',
                'category' => 'mobile-accessories',
                'brand' => 'samsung',
                'name' => 'Xiaomi Redmi Note 13 4G (8GB RAM / 256GB ROM)',
                'slug' => 'xiaomi-redmi-note-13-8-256',
                'sku' => 'MOB-XIA-RN13',
                'regular_price' => 24999.00,
                'sale_price' => 22499.00,
                'stock' => 18,
                'short_description' => '108MP ultra-clear camera with 120Hz AMOLED display and 33W fast charging.',
                'image' => 'https://images.unsplash.com/photo-1598327105666-5b89351aff97?w=500&auto=format&fit=crop&q=80',
                'is_featured' => false,
            ],

            // --- Laptop ---
            [
                'vendor' => 'electrobd-mega-store',
                'category' => 'computers',
                'brand' => 'lenovo',
                'name' => 'Lenovo IdeaPad Slim 3 15.6" FHD (Core i5 12th Gen / 16GB / 512GB SSD)',
                'slug' => 'lenovo-ideapad-slim-3-i5-16gb',
                'sku' => 'COMP-LEN-SLIM3',
                'regular_price' => 74500.00,
                'sale_price' => 68500.00,
                'stock' => 7,
                'short_description' => 'Lightweight business & student laptop with anti-glare display and rapid charge.',
                'image' => 'https://images.unsplash.com/photo-1496181133206-80ce9b88a853?w=500&auto=format&fit=crop&q=80',
                'is_featured' => true,
            ],
            [
                'vendor' => 'electrobd-mega-store',
                'category' => 'computers',
                'brand' => 'hp',
                'name' => 'HP 15s Ryzen 5 5500U (16GB RAM / 512GB NVMe SSD / Win 11)',
                'slug' => 'hp-15s-ryzen-5-16gb-512gb',
                'sku' => 'COMP-HP-15S-R5',
                'regular_price' => 69000.00,
                'sale_price' => 63900.00,
                'stock' => 6,
                'short_description' => 'Fast everyday multitasking with AMD Radeon Graphics and micro-edge bezel.',
                'image' => 'https://images.unsplash.com/photo-1588872657578-7efd1f1555ed?w=500&auto=format&fit=crop&q=80',
                'is_featured' => false,
            ],

            // --- Headphones ---
            [
                'vendor' => 'electrobd-mega-store',
                'category' => 'electronics',
                'brand' => 'anker',
                'name' => 'Anker Soundcore Life Q30 Wireless Hybrid Active Noise Cancelling Headphones',
                'slug' => 'anker-soundcore-life-q30-anc',
                'sku' => 'ELEC-ANK-Q30',
                'regular_price' => 8500.00,
                'sale_price' => 7800.00,
                'stock' => 15,
                'short_description' => 'Hi-Res Audio certified with 40-hour playtime and crystal-clear call quality.',
                'image' => 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=500&auto=format&fit=crop&q=80',
                'is_featured' => true,
            ],
            [
                'vendor' => 'electrobd-mega-store',
                'category' => 'mobile-accessories',
                'brand' => 'anker',
                'name' => 'Anker Soundcore R50i True Wireless Bluetooth 5.3 Earbuds',
                'slug' => 'anker-soundcore-r50i-tws',
                'sku' => 'MOB-ANK-R50I',
                'regular_price' => 2100.00,
                'sale_price' => 1750.00,
                'stock' => 30,
                'short_description' => 'Extra bass 10mm drivers with IPX5 water resistance and 30-hour total playtime.',
                'image' => 'https://images.unsplash.com/photo-1590658268037-6bf12165a8df?w=500&auto=format&fit=crop&q=80',
                'is_featured' => true,
            ],

            // --- Saree ---
            [
                'vendor' => 'dhaka-lifestyle-apparel',
                'category' => 'fashion',
                'brand' => 'apex',
                'name' => 'Authentic Tangail Traditional Handloom Soft Cotton Saree',
                'slug' => 'tangail-traditional-cotton-saree',
                'sku' => 'FASH-SAR-TANG',
                'regular_price' => 2200.00,
                'sale_price' => 1850.00,
                'stock' => 25,
                'short_description' => 'Pure breathable cotton handloom weave with traditional par & achol border.',
                'image' => 'https://images.unsplash.com/photo-1610030469983-98e550d6193c?w=500&auto=format&fit=crop&q=80',
                'is_featured' => true,
            ],
            [
                'vendor' => 'dhaka-lifestyle-apparel',
                'category' => 'fashion',
                'brand' => 'apex',
                'name' => 'Dhakai Jamdani Premium Handwoven Silk Saree (Gold Zari)',
                'slug' => 'dhakai-jamdani-handwoven-silk-saree',
                'sku' => 'FASH-SAR-JAMD',
                'regular_price' => 7500.00,
                'sale_price' => 6400.00,
                'stock' => 10,
                'short_description' => 'Intricate hand-loomed floral geometric motifs on fine Bengal silk fabric.',
                'image' => 'https://images.unsplash.com/photo-1617627143750-d86bc21e42bb?w=500&auto=format&fit=crop&q=80',
                'is_featured' => false,
            ],

            // --- Shoes ---
            [
                'vendor' => 'dhaka-lifestyle-apparel',
                'category' => 'shoes-bags',
                'brand' => 'apex',
                'name' => 'Apex Men\'s Formal Handcrafted Genuine Leather Derby Shoes',
                'slug' => 'apex-mens-formal-leather-shoes',
                'sku' => 'SHOE-APEX-DERBY',
                'regular_price' => 4590.00,
                'sale_price' => 3990.00,
                'stock' => 20,
                'short_description' => 'Full-grain genuine cow leather upper with cushioned anti-fatigue footbed.',
                'image' => 'https://images.unsplash.com/photo-1549298916-b41d501d3772?w=500&auto=format&fit=crop&q=80',
                'is_featured' => true,
            ],
            [
                'vendor' => 'dhaka-lifestyle-apparel',
                'category' => 'shoes-bags',
                'brand' => 'apex',
                'name' => 'Ventura Breathable Lightweight Daily Running & Walking Sneakers',
                'slug' => 'ventura-lightweight-running-sneakers',
                'sku' => 'SHOE-VEN-RUN',
                'regular_price' => 2850.00,
                'sale_price' => 2390.00,
                'stock' => 30,
                'short_description' => 'Shock-absorbing EVA phylon sole with aerated knit mesh upper.',
                'image' => 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=500&auto=format&fit=crop&q=80',
                'is_featured' => false,
            ],

            // --- Cosmetics ---
            [
                'vendor' => 'bengal-home-living',
                'category' => 'beauty-personal-care',
                'brand' => 'nivea',
                'name' => 'Nivea Men Deep Clean Anti-Oil Face Wash (100ml)',
                'slug' => 'nivea-men-deep-clean-face-wash-100ml',
                'sku' => 'BEAUTY-NIV-100ML',
                'regular_price' => 420.00,
                'sale_price' => 380.00,
                'stock' => 35,
                'short_description' => 'Black charcoal formula cleanses pores and removes excess facial sebum.',
                'image' => 'https://images.unsplash.com/photo-1556228720-195a672e8a03?w=500&auto=format&fit=crop&q=80',
                'is_featured' => true,
            ],
            [
                'vendor' => 'bengal-home-living',
                'category' => 'beauty-personal-care',
                'brand' => 'nivea',
                'name' => 'Neutrogena Hydro Boost Water Gel Moisturizer (50g)',
                'slug' => 'neutrogena-hydro-boost-water-gel-50g',
                'sku' => 'BEAUTY-NEU-50G',
                'regular_price' => 1650.00,
                'sale_price' => 1450.00,
                'stock' => 25,
                'short_description' => 'Hyaluronic acid instant hydration gel moisturizer for plump, radiant skin.',
                'image' => 'https://images.unsplash.com/photo-1522337360788-8b13dee7a37e?w=500&auto=format&fit=crop&q=80',
                'is_featured' => true,
            ],

            // --- Furniture ---
            [
                'vendor' => 'bengal-home-living',
                'category' => 'home-living',
                'brand' => 'hatil',
                'name' => 'Hatil Ergonomic Executive Mesh Swivel Office Chair (Adjustable Lumbar)',
                'slug' => 'hatil-ergonomic-executive-office-chair',
                'sku' => 'FURN-HATIL-CHAIR',
                'regular_price' => 10500.00,
                'sale_price' => 9200.00,
                'stock' => 8,
                'short_description' => 'Breathable Korean mesh backrest with heavy chrome base and tilt locking mechanism.',
                'image' => 'https://images.unsplash.com/photo-1580481077195-c3a821a5060f?w=500&auto=format&fit=crop&q=80',
                'is_featured' => true,
            ],
            [
                'vendor' => 'bengal-home-living',
                'category' => 'home-living',
                'brand' => 'hatil',
                'name' => 'Modern Minimalist Solid Wood Study Desk & Laptop Table',
                'slug' => 'modern-minimalist-wood-study-desk',
                'sku' => 'FURN-WOOD-DESK',
                'regular_price' => 13500.00,
                'sale_price' => 11900.00,
                'stock' => 5,
                'short_description' => 'Seasoned Malaysian oak finish with smooth sliding stationery drawer.',
                'image' => 'https://images.unsplash.com/photo-1518455027359-f3f8164ba6bd?w=500&auto=format&fit=crop&q=80',
                'is_featured' => false,
            ],

            // --- Books ---
            [
                'vendor' => 'shwapno-daily-mart',
                'category' => 'books-stationery',
                'brand' => 'pran',
                'name' => 'Paradoxical Sajid by Arif Azad (Paperback Original Edition)',
                'slug' => 'paradoxical-sajid-arif-azad',
                'sku' => 'BOOK-PARADOX-01',
                'regular_price' => 320.00,
                'sale_price' => 275.00,
                'stock' => 100,
                'short_description' => 'Top bestselling Bengali logic and faith series exploring critical thinking and philosophy.',
                'image' => 'https://images.unsplash.com/photo-1544716278-ca5e3f4abd8c?w=500&auto=format&fit=crop&q=80',
                'is_featured' => true,
            ],
            [
                'vendor' => 'shwapno-daily-mart',
                'category' => 'books-stationery',
                'brand' => 'pran',
                'name' => 'Bela Furabar Age by Dr. Mizanur Rahman Azhari',
                'slug' => 'bela-furabar-age-book',
                'sku' => 'BOOK-BELA-FURABAR',
                'regular_price' => 360.00,
                'sale_price' => 310.00,
                'stock' => 90,
                'short_description' => 'Spiritual motivational bestseller on conscious living, faith, and purposeful youth.',
                'image' => 'https://images.unsplash.com/photo-1512820790803-83ca734da794?w=500&auto=format&fit=crop&q=80',
                'is_featured' => false,
            ],

            // --- Appliances ---
            [
                'vendor' => 'bengal-home-living',
                'category' => 'appliances',
                'brand' => 'vision',
                'name' => 'Vision Classic 750W 3-in-1 Stainless Steel Mixer Grinder & Blender',
                'slug' => 'vision-classic-750w-blender-grinder',
                'sku' => 'APP-VIS-750W',
                'regular_price' => 3900.00,
                'sale_price' => 3450.00,
                'stock' => 20,
                'short_description' => 'Heavy duty 100% copper motor with 3 stainless steel multi-utility jars.',
                'image' => 'https://images.unsplash.com/photo-1570222094114-d054a817e56b?w=500&auto=format&fit=crop&q=80',
                'is_featured' => true,
            ],
            [
                'vendor' => 'bengal-home-living',
                'category' => 'home-living',
                'brand' => 'kiam',
                'name' => 'Kiam Classic Non-Stick 7-Piece Premium Cookware Set',
                'slug' => 'kiam-classic-nonstick-7piece-cookware-set',
                'sku' => 'HOME-KIAM-7PC',
                'regular_price' => 3600.00,
                'sale_price' => 3200.00,
                'stock' => 15,
                'short_description' => 'Includes Kadhai, saucepans, frypan, and heat resistant tempered glass lids.',
                'image' => 'https://images.unsplash.com/photo-1584990347449-399066601243?w=500&auto=format&fit=crop&q=80',
                'is_featured' => true,
            ],
            [
                'vendor' => 'bengal-home-living',
                'category' => 'appliances',
                'brand' => 'walton',
                'name' => 'Walton 20L Solo Digital Microwave Oven with Express Defrost',
                'slug' => 'walton-20l-digital-microwave-oven',
                'sku' => 'APP-WALT-20L-MW',
                'regular_price' => 9800.00,
                'sale_price' => 8750.00,
                'stock' => 8,
                'short_description' => 'Quick reheating, 5 power levels, and energy-saving eco-mode.',
                'image' => 'https://images.unsplash.com/photo-1585659722983-3a675dabf23d?w=500&auto=format&fit=crop&q=80',
                'is_featured' => false,
            ],
            [
                'vendor' => 'electrobd-mega-store',
                'category' => 'electronics',
                'brand' => 'walton',
                'name' => 'Walton 32-inch Frameless HD Smart Android TV (Voice Remote)',
                'slug' => 'walton-32-inch-frameless-hd-smart-tv',
                'sku' => 'ELEC-WALT-32TV',
                'regular_price' => 18500.00,
                'sale_price' => 16900.00,
                'stock' => 8,
                'short_description' => 'Built-in Google Assistant, Netflix, YouTube, and Dolby Audio decoding.',
                'image' => 'https://images.unsplash.com/photo-1593359677879-a4bb92f829d1?w=500&auto=format&fit=crop&q=80',
                'is_featured' => true,
            ],

            // --- Tools & Hardware ---
            [
                'vendor' => 'pioneer-tools-auto',
                'category' => 'tools-hardware',
                'brand' => 'ingco',
                'name' => 'Ingco 16-Piece Multi-Purpose Household Hand Tool Kit with Hard Case',
                'slug' => 'ingco-16-piece-multi-tool-kit',
                'sku' => 'TOOL-ING-16PC',
                'regular_price' => 2300.00,
                'sale_price' => 1950.00,
                'stock' => 18,
                'short_description' => 'Complete toolkit with hammer, pliers, screwdriver set, tape and tester.',
                'image' => 'https://images.unsplash.com/photo-1581244277943-fe4a9c777189?w=500&auto=format&fit=crop&q=80',
                'is_featured' => true,
            ],
            [
                'vendor' => 'pioneer-tools-auto',
                'category' => 'tools-hardware',
                'brand' => 'ingco',
                'name' => 'Crown 13mm Reversible Impact Drill Machine 650W',
                'slug' => 'crown-13mm-impact-drill-650w',
                'sku' => 'TOOL-CRW-DRILL',
                'regular_price' => 3600.00,
                'sale_price' => 3150.00,
                'stock' => 12,
                'short_description' => 'Variable speed hammer drill for concrete, masonry, steel, and wood.',
                'image' => 'https://images.unsplash.com/photo-1504148455328-c376907d081c?w=500&auto=format&fit=crop&q=80',
                'is_featured' => false,
            ],

            // --- Automotive ---
            [
                'vendor' => 'pioneer-tools-auto',
                'category' => 'automotive',
                'brand' => 'motul',
                'name' => 'Motul 3000 4T 20W50 High-Performance Mineral Motorcycle Engine Oil (1L)',
                'slug' => 'motul-3000-4t-20w50-engine-oil-1l',
                'sku' => 'AUTO-MOT-20W50',
                'regular_price' => 690.00,
                'sale_price' => 620.00,
                'stock' => 40,
                'short_description' => 'Reinforced extreme-pressure additives for maximum gearbox and clutch protection.',
                'image' => 'https://images.unsplash.com/photo-1486006920555-c77dce18193b?w=500&auto=format&fit=crop&q=80',
                'is_featured' => true,
            ],
            [
                'vendor' => 'pioneer-tools-auto',
                'category' => 'automotive',
                'brand' => 'motul',
                'name' => 'Steelbird SBA-7 Full-Face ISI Certified Aerodynamic Motorcycle Helmet',
                'slug' => 'steelbird-sba7-motorcycle-helmet',
                'sku' => 'AUTO-STB-HELMET',
                'regular_price' => 3200.00,
                'sale_price' => 2850.00,
                'stock' => 14,
                'short_description' => 'Quick release buckle with scratch-resistant anti-fog clear optical visor.',
                'image' => 'https://images.unsplash.com/photo-1558981806-ec527fa84c39?w=500&auto=format&fit=crop&q=80',
                'is_featured' => false,
            ],

            // --- Baby & Kids ---
            [
                'vendor' => 'shwapno-daily-mart',
                'category' => 'baby-kids',
                'brand' => 'square-consumer',
                'name' => 'Meril Baby Soft Fragrance-Free Moisture Wipes (80 Pcs)',
                'slug' => 'meril-baby-moisture-wipes-80pcs',
                'sku' => 'BABY-MERIL-WIPES',
                'regular_price' => 260.00,
                'sale_price' => 230.00,
                'stock' => 50,
                'short_description' => 'Alcohol-free, pH 5.5 balanced chamomile extract wipes for tender skin.',
                'image' => 'https://images.unsplash.com/photo-1515488042361-ee00e0ddd4e4?w=500&auto=format&fit=crop&q=80',
                'is_featured' => true,
            ],

            // --- Sports & Fitness ---
            [
                'vendor' => 'dhaka-lifestyle-apparel',
                'category' => 'sports-fitness',
                'brand' => 'apex',
                'name' => 'ProFlex 5-Level Heavy Duty Resistance Exercise Bands Set with Carry Pouch',
                'slug' => 'proflex-5level-resistance-bands-set',
                'sku' => 'SPORT-BAND-5SET',
                'regular_price' => 990.00,
                'sale_price' => 790.00,
                'stock' => 35,
                'short_description' => '100% natural latex resistance loops for home workout, glutes, and strength training.',
                'image' => 'https://images.unsplash.com/photo-1517838277536-f5f99be501cd?w=500&auto=format&fit=crop&q=80',
                'is_featured' => true,
            ],

            // --- Fashion Apparel ---
            [
                'vendor' => 'dhaka-lifestyle-apparel',
                'category' => 'fashion',
                'brand' => 'apex',
                'name' => 'Men\'s Breathable Pique Cotton Classic Polo Shirt (Navy Blue)',
                'slug' => 'mens-breathable-pique-cotton-polo-shirt',
                'sku' => 'FASH-POLO-MEN',
                'regular_price' => 890.00,
                'sale_price' => 750.00,
                'stock' => 40,
                'short_description' => 'Pre-shrunk 100% combed cotton polo shirt with ribbed cuffs and collar.',
                'image' => 'https://images.unsplash.com/photo-1581655353564-df123a1eb820?w=500&auto=format&fit=crop&q=80',
                'is_featured' => true,
            ],
            [
                'vendor' => 'dhaka-lifestyle-apparel',
                'category' => 'fashion',
                'brand' => 'apex',
                'name' => 'Handwoven Jamdani Cotton Festive Panjabi (Royal White)',
                'slug' => 'handwoven-jamdani-cotton-panjabi',
                'sku' => 'FASH-PANJ-01',
                'regular_price' => 2800.00,
                'sale_price' => 2450.00,
                'stock' => 22,
                'short_description' => 'Elegant traditional panjabi with exquisite Jamdani jacquard embroidery.',
                'image' => 'https://images.unsplash.com/photo-1610030469983-98e550d6193c?w=500&auto=format&fit=crop&q=80',
                'is_featured' => true,
            ],
        ];

        $createdProducts = [];
        foreach ($products as $p) {
            $vendor = $vendorModelMap[$p['vendor']] ?? null;
            $category = $categoryMap[$p['category']] ?? null;
            $brand = $brandMap[$p['brand']] ?? null;

            if ($vendor && $category) {
                $product = Product::updateOrCreate(
                    ['sku' => $p['sku']],
                    [
                        'vendor_id' => $vendor->id,
                        'category_id' => $category->id,
                        'brand_id' => $brand?->id,
                        'name' => $p['name'],
                        'slug' => $p['slug'],
                        'type' => 'simple',
                        'regular_price' => $p['regular_price'],
                        'sale_price' => $p['sale_price'],
                        'stock' => $p['stock'],
                        'short_description' => $p['short_description'],
                        'status' => 'active',
                        'is_featured' => $p['is_featured'] ?? false,
                        'is_published' => true,
                    ]
                );

                // Attach primary product image
                ProductImage::firstOrCreate(
                    [
                        'product_id' => $product->id,
                        'image_path' => $p['image'],
                    ],
                    [
                        'is_thumbnail' => true,
                        'sort_order' => 1,
                    ]
                );

                $createdProducts[] = $product;
            }
        }

        // 5. Seed Real Orders & Order Items so BEST SELLERS has actual database sales count!
        $customer = User::firstOrCreate(
            ['email' => 'customer.tusher@example.com'],
            [
                'name' => 'Tusher Ahmed',
                'phone' => '01712345678',
                'password' => Hash::make('password123'),
                'status' => 'active',
                'email_verified_at' => now(),
            ]
        );
        $customer->roles()->syncWithoutDetaching([$customerRole->id]);

        // Real Top-selling products to seed orders for
        $topSoldSkus = [
            'GROC-OIL-5L' => 45,        // Teer Oil 45 sales
            'GROC-RICE-5KG' => 38,      // Nazirshail Rice 38 sales
            'GROC-DAL-1KG' => 34,       // Masoor Dal 34 sales
            'MOB-SAM-A55' => 28,        // Samsung Galaxy A55 28 sales
            'APP-VIS-750W' => 24,       // Vision Blender 24 sales
            'ELEC-ANK-Q30' => 21,       // Anker Q30 Headphones 21 sales
            'SHOE-APEX-DERBY' => 19,    // Apex Shoes 19 sales
            'FASH-SAR-TANG' => 18,      // Tangail Saree 18 sales
            'HOME-KIAM-7PC' => 17,      // Kiam Cookware 17 sales
            'BOOK-PARADOX-01' => 16,    // Paradoxical Sajid 16 sales
            'TOOL-ING-16PC' => 14,      // Ingco Tool kit 14 sales
            'BEAUTY-NIV-100ML' => 13,   // Nivea Wash 13 sales
        ];

        foreach ($topSoldSkus as $sku => $salesCount) {
            $product = Product::where('sku', $sku)->first();
            if ($product) {
                // Seed simulated historical order items
                for ($i = 0; $i < min($salesCount, 8); $i++) {
                    $orderNum = 'BD-HIST-' . ($product->id * 100 + $i);
                    $order = Order::firstOrCreate(
                        ['order_number' => $orderNum],
                        [
                            'user_id' => $customer->id,
                            'subtotal' => $product->sale_price,
                            'discount_amount' => 0,
                            'coupon_discount' => 0,
                            'shipping_cost' => 60.00,
                            'tax_amount' => 0,
                            'grand_total' => $product->sale_price + 60.00,
                            'currency' => 'BDT',
                            'payment_method' => 'bkash',
                            'payment_status' => 'paid',
                            'order_status' => 'delivered',
                            'confirmed_at' => now()->subDays($i + 1),
                            'delivered_at' => now()->subDays($i),
                        ]
                    );

                    OrderItem::firstOrCreate(
                        [
                            'order_id' => $order->id,
                            'product_id' => $product->id,
                        ],
                        [
                            'vendor_id' => $product->vendor_id,
                            'product_name' => $product->name,
                            'sku' => $product->sku,
                            'quantity' => 1 + ($i % 3),
                            'unit_price' => $product->sale_price,
                            'subtotal' => $product->sale_price,
                            'commission_rate' => $product->vendor->commission_percentage ?? 8.0,
                            'commission_amount' => round(($product->sale_price * ($product->vendor->commission_percentage ?? 8.0)) / 100, 2),
                            'vendor_earning' => round($product->sale_price * (1 - ($product->vendor->commission_percentage ?? 8.0) / 100), 2),
                            'vendor_order_status' => 'delivered',
                        ]
                    );
                }

                // Add verified customer review
                Review::firstOrCreate(
                    [
                        'user_id' => $customer->id,
                        'product_id' => $product->id,
                    ],
                    [
                        'rating' => 5,
                        'title' => 'Original genuine product, fast delivery',
                        'comment' => 'Received authentic original item in good packaging. Verified 100% genuine in Bangladesh.',
                        'is_verified_purchase' => true,
                        'status' => 'approved',
                    ]
                );
            }
        }
    }
}
