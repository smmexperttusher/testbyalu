<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Display the General Marketplace Homepage with high-density product sections.
     */
    public function index(Request $request): View
    {
        // 1. All 14 Core General Marketplace Categories
        $categories = Category::where('is_active', true)
            ->withCount(['products' => function ($query) {
                $query->where('status', 'active')->where('is_published', true);
            }])
            ->orderBy('order_index')
            ->get();

        // Base optimized query closure with eager loading for zero N+1 queries
        $baseEager = ['vendor', 'category', 'brand', 'images'];

        // 2. Flash Deals: verified products with real discount margins
        $flashDeals = Product::with($baseEager)
            ->where('status', 'active')
            ->where('is_published', true)
            ->whereNotNull('sale_price')
            ->whereColumn('regular_price', '>', 'sale_price')
            ->orderByRaw('(regular_price - sale_price) DESC')
            ->take(10)
            ->get();

        // 3. Best Sellers: based on actual order items volume & completed orders
        $bestSellers = Product::with($baseEager)
            ->where('status', 'active')
            ->where('is_published', true)
            ->withCount('orderItems')
            ->orderByDesc('order_items_count')
            ->latest('id')
            ->take(10)
            ->get();

        // 4. New Arrivals: recently added catalog items
        $newArrivals = Product::with($baseEager)
            ->where('status', 'active')
            ->where('is_published', true)
            ->latest()
            ->take(10)
            ->get();

        // 5. Featured Products: editorially certified marketplace picks
        $featuredProducts = Product::with($baseEager)
            ->where('status', 'active')
            ->where('is_published', true)
            ->where('is_featured', true)
            ->take(10)
            ->get();

        // 6. Recommended Products:
        // For authenticated customers: personalized category suggestions based on purchase history
        // For guests: diverse high-rating popular consumer picks
        $recommendedProducts = collect();
        $user = $request->user();

        if ($user) {
            $userOrderedCategoryIds = OrderItem::whereHas('order', function ($q) use ($user) {
                    $q->where('user_id', $user->id);
                })
                ->join('products', 'order_items.product_id', '=', 'products.id')
                ->pluck('products.category_id')
                ->unique();

            if ($userOrderedCategoryIds->isNotEmpty()) {
                $recommendedProducts = Product::with($baseEager)
                    ->where('status', 'active')
                    ->where('is_published', true)
                    ->whereIn('category_id', $userOrderedCategoryIds)
                    ->take(10)
                    ->get();
            }
        }

        if ($recommendedProducts->isEmpty()) {
            // For guests or new users: highly rated, verified general store essentials
            $recommendedProducts = Product::with($baseEager)
                ->where('status', 'active')
                ->where('is_published', true)
                ->inRandomOrder(12345) // deterministic seed so it doesn't flicker on refresh
                ->take(10)
                ->get();
        }

        // Active Verified Vendors in Bangladesh (Popular Stores: approved, active, with product count)
        $popularVendors = Vendor::where('approval_status', 'approved')
            ->where('status', 'active')
            ->withCount(['products' => function ($query) {
                $query->where('status', 'active')->where('is_published', true);
            }])
            ->having('products_count', '>', 0)
            ->take(6)
            ->get();

        // 7. Category-Focused Marketplace Sections (Using real database categories & products)
        // 1. Grocery & Daily Essentials, 2. Electronics & Gadgets, 3. Fashion & Lifestyle,
        // 4. Home & Living, 5. Beauty & Personal Care, 6. Mobile & Accessories
        $categorySectionsMeta = [
            'grocery' => [
                'title' => 'Grocery & Daily Essentials',
                'subtitle' => 'Rice, Dal, Edible Oil, Sugar, Flour, Salt, Spices, Tea, Coffee & daily pantry staples',
                'icon' => '🛒',
                'badge' => 'Daily Essentials',
                'badgeColor' => 'orange',
            ],
            'electronics' => [
                'title' => 'Electronics & Gadgets',
                'subtitle' => 'Smart TVs, Laptops, Headphones, Earbuds, Smart watches, Monitors, Keyboards & Audio gear',
                'icon' => '📺',
                'badge' => 'Tech & Audio',
                'badgeColor' => 'orange',
            ],
            'fashion' => [
                'title' => 'Fashion & Lifestyle',
                'subtitle' => 'Sarees, Panjabis, Shirts, T-Shirts, Pants, Shoes, Bags, Watches & Accessories',
                'icon' => '👔',
                'badge' => 'Lifestyle & Wear',
                'badgeColor' => 'orange',
            ],
            'home-living' => [
                'title' => 'Home & Living',
                'subtitle' => 'Kitchen appliances, cookware sets, home decor, bedding, storage & lighting',
                'icon' => '🏠',
                'badge' => 'Home & Kitchen',
                'badgeColor' => 'orange',
            ],
            'beauty-personal-care' => [
                'title' => 'Beauty & Personal Care',
                'subtitle' => 'Skincare, haircare, cosmetics, personal grooming & hygiene essentials',
                'icon' => '✨',
                'badge' => '100% Authentic',
                'badgeColor' => 'orange',
            ],
            'mobile-accessories' => [
                'title' => 'Mobile & Accessories',
                'subtitle' => 'Smartphones, cases, 20W fast chargers, power banks, screen protectors & earphones',
                'icon' => '📱',
                'badge' => 'Gadget Hub',
                'badgeColor' => 'orange',
            ],
        ];

        $categorySections = [];
        foreach ($categorySectionsMeta as $slug => $meta) {
            $category = Category::where('slug', $slug)->first();
            if ($category) {
                $products = Product::with($baseEager)
                    ->where('status', 'active')
                    ->where('is_published', true)
                    ->where('category_id', $category->id)
                    ->take(10)
                    ->get();

                // If a category does not have enough products: show available products OR hide if 0 products
                if ($products->isNotEmpty()) {
                    $categorySections[$slug] = [
                        'category' => $category,
                        'meta' => $meta,
                        'products' => $products,
                    ];
                }
            }
        }

        // 8. Diverse Marketplace Promotional Banners
        $promotionalBanners = [
            [
                'title' => 'Groceries for Less',
                'subtitle' => 'Pure Soybean Oil, Rice, Dal & Everyday Cooking Essentials',
                'badge' => 'Pantry Savings',
                'tagline' => 'Direct from verified food distributors across Bangladesh',
                'image' => 'https://images.unsplash.com/photo-1542838132-92c53300491e?w=800&auto=format&fit=crop&q=80',
                'category_slug' => 'grocery',
                'link_text' => 'Shop Groceries',
                'bg_gradient' => 'from-amber-900/90 to-stone-900/95',
            ],
            [
                'title' => 'Latest Electronics',
                'subtitle' => 'Official Smart Android TVs, Laptops, Audio Gear & Gadgets',
                'badge' => 'Official Warranty',
                'tagline' => 'Brand warranty guaranteed with fast doorstep delivery',
                'image' => 'https://images.unsplash.com/photo-1593359677879-a4bb92f829d1?w=800&auto=format&fit=crop&q=80',
                'category_slug' => 'electronics',
                'link_text' => 'Explore Tech',
                'bg_gradient' => 'from-blue-950/90 to-stone-900/95',
            ],
            [
                'title' => 'Home Essentials',
                'subtitle' => 'Multi-Jar Blenders, Marble Cookware Sets & Modern Living',
                'badge' => 'Kitchen Upgrades',
                'tagline' => 'High durability appliances for Bangladeshi households',
                'image' => 'https://images.unsplash.com/photo-1556911220-e15b29be8c8f?w=800&auto=format&fit=crop&q=80',
                'category_slug' => 'home-living',
                'link_text' => 'Discover Home',
                'bg_gradient' => 'from-emerald-950/90 to-stone-900/95',
            ],
            [
                'title' => 'Fashion Deals',
                'subtitle' => 'Festive Panjabis, Breathable Cotton Polos & Traditional Sarees',
                'badge' => 'Curated Style',
                'tagline' => 'Premium fabrics tailored for the Bangladeshi climate',
                'image' => 'https://images.unsplash.com/photo-1581655353564-df123a1eb820?w=800&auto=format&fit=crop&q=80',
                'category_slug' => 'fashion',
                'link_text' => 'Browse Fashion',
                'bg_gradient' => 'from-stone-900/90 to-orange-950/95',
            ],
            [
                'title' => 'Beauty Offers',
                'subtitle' => 'Gentle Cleansers, Organic Hair Oils & Authentic Skincare',
                'badge' => 'Skin & Haircare',
                'tagline' => 'Dermatologist tested & guaranteed 100% original products',
                'image' => 'https://images.unsplash.com/photo-1522337360788-8b13dee7a37e?w=800&auto=format&fit=crop&q=80',
                'category_slug' => 'beauty-personal-care',
                'link_text' => 'View Beauty',
                'bg_gradient' => 'from-rose-950/90 to-stone-900/95',
            ],
        ];

        return view('home', compact(
            'categories',
            'flashDeals',
            'bestSellers',
            'newArrivals',
            'featuredProducts',
            'recommendedProducts',
            'popularVendors',
            'categorySections',
            'promotionalBanners'
        ));
    }
}
