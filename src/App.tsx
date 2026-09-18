import React, { useState, useMemo } from 'react';
import {
  ShoppingCart,
  ShieldCheck,
  CheckCircle2,
  AlertCircle,
  Store,
  CreditCard,
  ArrowRight,
  Upload,
  FileText,
  Check,
  X,
  Search,
  MapPin,
  Clock,
  Layers,
  Sparkles,
  Smartphone,
  Heart,
  User,
  Tv,
  ShoppingBag,
  Laptop,
  Home,
  Briefcase,
  Baby,
  Dumbbell,
  BookOpen,
  Car,
  Wrench,
  ChevronRight,
  Filter,
  CheckCircle,
  Truck,
  TrendingUp,
  Tag,
  Phone,
  Star
} from 'lucide-react';
import { ProductItem, CartEntry, OrderRecord, CustomerReview } from './types';
import { GENERAL_MARKETPLACE_PRODUCTS } from './data/products';
import { APPROVED_CUSTOMER_REVIEWS } from './data/reviews';
import { ProductCard } from './components/ProductCard';
import { ProductSection } from './components/ProductSection';
import { CustomerReviewsSection } from './components/CustomerReviewsSection';
import { PaymentOptionsSection } from './components/PaymentOptionsSection';
import { NewsletterSection } from './components/NewsletterSection';
import { MarketplaceFooter } from './components/MarketplaceFooter';
import { CustomerAuthModal } from './components/CustomerAuthModal';
import { AdminAuthScreen } from './components/AdminAuthScreen';

// 14 Real General Marketplace Categories
const MARKETPLACE_CATEGORIES = [
  { id: 'grocery', name: 'Grocery', icon: ShoppingBag, count: 240, image: 'https://images.unsplash.com/photo-1542838132-92c53300491e?w=400&auto=format&fit=crop&q=80' },
  { id: 'electronics', name: 'Electronics', icon: Tv, count: 185, image: 'https://images.unsplash.com/photo-1593359677879-a4bb92f829d1?w=400&auto=format&fit=crop&q=80' },
  { id: 'fashion', name: 'Fashion', icon: Tag, count: 320, image: 'https://images.unsplash.com/photo-1445205170230-053b83016050?w=400&auto=format&fit=crop&q=80' },
  { id: 'beauty-personal-care', name: 'Beauty & Care', icon: Sparkles, count: 140, image: 'https://images.unsplash.com/photo-1522337360788-8b13dee7a37e?w=400&auto=format&fit=crop&q=80' },
  { id: 'mobile-accessories', name: 'Mobile & Gadgets', icon: Smartphone, count: 210, image: 'https://images.unsplash.com/photo-1511707171634-5f897ff02aa9?w=400&auto=format&fit=crop&q=80' },
  { id: 'computers', name: 'Computers', icon: Laptop, count: 95, image: 'https://images.unsplash.com/photo-1496181133206-80ce9b88a853?w=400&auto=format&fit=crop&q=80' },
  { id: 'home-living', name: 'Home & Living', icon: Home, count: 160, image: 'https://images.unsplash.com/photo-1583847268964-b28dc8f51f92?w=400&auto=format&fit=crop&q=80' },
  { id: 'appliances', name: 'Appliances', icon: Sparkles, count: 110, image: 'https://images.unsplash.com/photo-1556911220-e15b29be8c8f?w=400&auto=format&fit=crop&q=80' },
  { id: 'shoes-bags', name: 'Shoes & Bags', icon: Briefcase, count: 175, image: 'https://images.unsplash.com/photo-1549298916-b41d501d3772?w=400&auto=format&fit=crop&q=80' },
  { id: 'baby-kids', name: 'Baby & Kids', icon: Baby, count: 85, image: 'https://images.unsplash.com/photo-1515488042361-ee00e0ddd4e4?w=400&auto=format&fit=crop&q=80' },
  { id: 'sports-fitness', name: 'Sports & Fitness', icon: Dumbbell, count: 70, image: 'https://images.unsplash.com/photo-1517838277536-f5f99be501cd?w=400&auto=format&fit=crop&q=80' },
  { id: 'books-stationery', name: 'Books & Supplies', icon: BookOpen, count: 130, image: 'https://images.unsplash.com/photo-1544716278-ca5e3f4abd8c?w=400&auto=format&fit=crop&q=80' },
  { id: 'automotive', name: 'Automotive', icon: Car, count: 65, image: 'https://images.unsplash.com/photo-1486006920555-c77dce18193b?w=400&auto=format&fit=crop&q=80' },
  { id: 'tools-hardware', name: 'Tools & Hardware', icon: Wrench, count: 90, image: 'https://images.unsplash.com/photo-1581244277943-fe4a9c777189?w=400&auto=format&fit=crop&q=80' },
];

// General Multi-Vendor Products in Bangladesh
const GENERAL_PRODUCTS: ProductItem[] = GENERAL_MARKETPLACE_PRODUCTS;

const BD_DIVISIONS = [
  { id: 'dhaka', name: 'Dhaka (ঢাকা)', districts: ['Dhaka', 'Gazipur', 'Narayanganj', 'Tangail'] },
  { id: 'chittagong', name: 'Chittagong (চট্টগ্রাম)', districts: ['Chittagong', 'Cox\'s Bazar', 'Comilla'] },
  { id: 'rajshahi', name: 'Rajshahi (রাজশাহী)', districts: ['Rajshahi', 'Bogra', 'Pabna'] },
  { id: 'sylhet', name: 'Sylhet (সিলেট)', districts: ['Sylhet', 'Moulvibazar', 'Habiganj'] },
  { id: 'khulna', name: 'Khulna (খুলনা)', districts: ['Khulna', 'Jessore', 'Kushtia'] },
  { id: 'barisal', name: 'Barisal (বরিশাল)', districts: ['Barisal', 'Patuakhali', 'Bhola'] },
  { id: 'rangpur', name: 'Rangpur (রংপুর)', districts: ['Rangpur', 'Dinajpur', 'Kurigram'] },
  { id: 'mymensingh', name: 'Mymensingh (ময়মনসিংহ)', districts: ['Mymensingh', 'Jamalpur', 'Netrokona'] },
];

// Active Verified Vendors in Bangladesh (Popular Stores)
const POPULAR_VENDORS = [
  {
    id: 1,
    name: 'Shwapno Daily Mart',
    slug: 'shwapno-daily-mart',
    category: 'Grocery & Essentials',
    description: 'Leading daily grocery, rice, edible oil and household essentials supplier.',
    productsCount: 10,
    rating: 4.9,
    address: 'Tejgaon, Dhaka',
    logo: 'https://images.unsplash.com/photo-1542838132-92c53300491e?w=200&auto=format&fit=crop&q=80',
  },
  {
    id: 2,
    name: 'ElectroBD Mega Store',
    slug: 'electrobd-mega-store',
    category: 'Electronics & Mobiles',
    description: 'Official consumer electronics, smartphones, laptops, audio and gadgets.',
    productsCount: 20,
    rating: 4.8,
    address: 'Motijheel Commercial Area, Dhaka',
    logo: 'https://images.unsplash.com/photo-1511707171634-5f897ff02aa9?w=200&auto=format&fit=crop&q=80',
  },
  {
    id: 3,
    name: 'Bengal Home & Living',
    slug: 'bengal-home-living',
    category: 'Home & Kitchen',
    description: 'Quality kitchenware, cookware sets, home furniture and lighting.',
    productsCount: 10,
    rating: 4.8,
    address: 'Mirpur-10, Dhaka',
    logo: 'https://images.unsplash.com/photo-1556911220-e15b29be8c8f?w=200&auto=format&fit=crop&q=80',
  },
  {
    id: 4,
    name: 'Dhaka Lifestyle & Apparel',
    slug: 'dhaka-lifestyle-apparel',
    category: 'Fashion & Footwear',
    description: 'Authentic cotton panjabis, polo shirts, sarees and lifestyle accessories.',
    productsCount: 10,
    rating: 4.7,
    address: 'Uttara Model Town, Dhaka',
    logo: 'https://images.unsplash.com/photo-1581655353564-df123a1eb820?w=200&auto=format&fit=crop&q=80',
  },
  {
    id: 5,
    name: 'PureCare Cosmetics & Beauty',
    slug: 'purecare-cosmetics-beauty',
    category: 'Beauty & Wellness',
    description: '100% genuine skincare, grooming, personal care and hair wellness products.',
    productsCount: 10,
    rating: 4.9,
    address: 'Dhanmondi, Dhaka',
    logo: 'https://images.unsplash.com/photo-1522337360788-8b13dee7a37e?w=200&auto=format&fit=crop&q=80',
  },
  {
    id: 6,
    name: 'Pioneer Tools & Auto Store',
    slug: 'pioneer-tools-auto-store',
    category: 'Tools & Hardware',
    description: 'Heavy duty household tools, drills, bike helmets and engine oils.',
    productsCount: 4,
    rating: 4.8,
    address: 'Chawkbazar, Dhaka',
    logo: 'https://images.unsplash.com/photo-1581244277943-fe4a9c777189?w=200&auto=format&fit=crop&q=80',
  },
];

export default function App() {
  const [activeTab, setActiveTab] = useState<'storefront' | 'checkout' | 'admin' | 'vendor' | 'laravel_code'>('storefront');
  const [selectedCategoryFilter, setSelectedCategoryFilter] = useState<string>('all');
  const [searchQuery, setSearchQuery] = useState<string>('');
  const [wishlistCount, setWishlistCount] = useState<number>(3);

  // Customer Authentication & Guest Restrictions
  const [currentUser, setCurrentUser] = useState<{
    name: string;
    email: string;
    phone: string;
    role: 'customer' | 'vendor' | 'admin';
  } | null>(null);
  const [showCustomerAuthModal, setShowCustomerAuthModal] = useState(false);
  const [customerAuthModalMode, setCustomerAuthModalMode] = useState<'login' | 'register'>('login');
  const [pendingProductForCart, setPendingProductForCart] = useState<ProductItem | null>(null);
  const [isAdminAuthenticated, setIsAdminAuthenticated] = useState(false);

  // Cart State (Starts empty for guests per marketplace rules)
  const [cart, setCart] = useState<CartEntry[]>([]);

  // Bangladesh Address State
  const [selectedDivision, setSelectedDivision] = useState('Dhaka (ঢাকা)');
  const [selectedDistrict, setSelectedDistrict] = useState('Dhaka');
  const [upazilaThana, setUpazilaThana] = useState('Mirpur');
  const [areaDetail, setAreaDetail] = useState('Sector 2, Road 12, Block C');
  const [customerName, setCustomerName] = useState('Tusher Ahmed');
  const [customerPhone, setCustomerPhone] = useState('01712345678');
  const [shippingZone, setShippingZone] = useState<'inside_dhaka' | 'outside_dhaka'>('inside_dhaka');

  // Payment Selection
  const [paymentMethod, setPaymentMethod] = useState<'cod' | 'bkash' | 'nagad'>('bkash');

  // Mandatory bKash / Nagad Modal
  const [showPaymentModal, setShowPaymentModal] = useState(false);
  const [modalType, setModalType] = useState<'bkash' | 'nagad'>('bkash');
  const [paymentPhone, setPaymentPhone] = useState('');
  const [transactionId, setTransactionId] = useState('');
  const [screenshotUploaded, setScreenshotUploaded] = useState(false);
  const [modalError, setModalError] = useState('');
  const [checkoutNotification, setCheckoutNotification] = useState<string | null>(null);

  // Admin rejection modal
  const [rejectingOrderNumber, setRejectingOrderNumber] = useState<string | null>(null);
  const [rejectionReasonInput, setRejectionReasonInput] = useState('');

  // Orders Database State (Initial verified order)
  const [orders, setOrders] = useState<OrderRecord[]>([
    {
      orderNumber: 'BD-2026-98124',
      customerName: 'Tusher Ahmed',
      customerPhone: '01712345678',
      address: 'Sector 2, Road 12, Block C, Mirpur, Dhaka',
      subtotal: 5680,
      shipping: 60,
      grandTotal: 5740,
      paymentMethod: 'bkash',
      paymentStatus: 'pending_verification',
      orderStatus: 'payment_verification',
      transactionId: 'BKH99281745',
      paymentPhone: '01819000101',
      submittedAt: 'Today at 04:10 PM',
      screenshotUrl: 'https://images.unsplash.com/photo-1554415707-9e490104715c?w=500&auto=format&fit=crop&q=80',
      items: [
        {
          vendorName: 'Shwapno Daily Mart',
          productName: 'Teer Fortified Pure Soybean Oil (5L)',
          qty: 2,
          price: 890,
          commissionRate: 5,
          vendorEarning: 1691,
          platformCut: 89,
        },
        {
          vendorName: 'Bengal Home & Appliances',
          productName: 'Vision Classic 750W Mixer Grinder',
          qty: 1,
          price: 3450,
          commissionRate: 8,
          vendorEarning: 3174,
          platformCut: 276,
        },
        {
          vendorName: 'Shwapno Daily Mart',
          productName: 'Pran Premium Nazirshail Rice (5kg)',
          qty: 1,
          price: 450,
          commissionRate: 5,
          vendorEarning: 427.5,
          platformCut: 22.5,
        },
      ],
    },
  ]);

  // Customer Reviews State (Approved real database reviews)
  const [customerReviews, setCustomerReviews] = useState<CustomerReview[]>(APPROVED_CUSTOMER_REVIEWS);

  const subtotal = cart.reduce((acc, item) => acc + item.product.salePrice * item.quantity, 0);
  const shippingCost = shippingZone === 'inside_dhaka' ? 60 : 120;
  const grandTotal = subtotal + shippingCost;

  const addToCart = (product: ProductItem) => {
    // 2. CUSTOMER MUST BE LOGGED IN TO SHOP
    // When a guest clicks Add to Cart:
    // 1. Do NOT add the product to the cart.
    // 2. Open a responsive login/register popup/modal.
    // 3. Clearly explain: "Please log in or create an account to add items to your cart."
    if (!currentUser) {
      setPendingProductForCart(product);
      setCustomerAuthModalMode('login');
      setShowCustomerAuthModal(true);
      return;
    }

    setCart((prev) => {
      const exists = prev.find((item) => item.product.id === product.id);
      if (exists) {
        return prev.map((item) =>
          item.product.id === product.id ? { ...item, quantity: item.quantity + 1 } : item
        );
      }
      return [...prev, { product, quantity: 1 }];
    });
    setCheckoutNotification(`Added "${product.name}" to cart!`);
    setTimeout(() => setCheckoutNotification(null), 3500);
  };

  const handleAuthSuccess = (user: { name: string; email: string; phone: string; role: 'customer' }) => {
    setCurrentUser(user);
    setCustomerName(user.name);
    setCustomerPhone(user.phone);

    // After successful customer authentication:
    // - Return the customer to the page/product they were viewing
    // - Fulfill the pending Add to Cart action
    if (pendingProductForCart) {
      const prod = pendingProductForCart;
      setCart((prev) => {
        const exists = prev.find((item) => item.product.id === prod.id);
        if (exists) {
          return prev.map((item) =>
            item.product.id === prod.id ? { ...item, quantity: item.quantity + 1 } : item
          );
        }
        return [...prev, { product: prod, quantity: 1 }];
      });
      setCheckoutNotification(`Welcome, ${user.name}! Added "${prod.name}" to your cart.`);
      setPendingProductForCart(null);
    } else {
      setCheckoutNotification(`Welcome back, ${user.name}!`);
    }
    setTimeout(() => setCheckoutNotification(null), 4000);
  };

  const updateQuantity = (productId: number, delta: number) => {
    setCart((prev) =>
      prev
        .map((item) => {
          if (item.product.id === productId) {
            const newQty = item.quantity + delta;
            return newQty > 0 ? { ...item, quantity: newQty } : null;
          }
          return item;
        })
        .filter(Boolean) as CartEntry[]
    );
  };

  const filteredProducts = GENERAL_PRODUCTS.filter((prod) => {
    const matchesCategory =
      selectedCategoryFilter === 'all' || prod.categorySlug === selectedCategoryFilter;
    const matchesSearch =
      searchQuery.trim() === '' ||
      prod.name.toLowerCase().includes(searchQuery.toLowerCase()) ||
      prod.categoryName.toLowerCase().includes(searchQuery.toLowerCase()) ||
      prod.vendorName.toLowerCase().includes(searchQuery.toLowerCase());
    return matchesCategory && matchesSearch;
  });

  // 1. Flash Deals: high verified discount margins (regularPrice > salePrice)
  const flashDeals = useMemo(() => {
    return [...GENERAL_PRODUCTS]
      .filter((p) => p.regularPrice > p.salePrice)
      .sort((a, b) => (b.regularPrice - b.salePrice) - (a.regularPrice - a.salePrice))
      .slice(0, 10);
  }, []);

  // 2. Best Sellers: highest order sales count
  const bestSellers = useMemo(() => {
    return [...GENERAL_PRODUCTS]
      .sort((a, b) => (b.salesCount ?? 0) - (a.salesCount ?? 0))
      .slice(0, 10);
  }, []);

  // 3. New Arrivals: recently added merchant items
  const newArrivals = useMemo(() => {
    return [...GENERAL_PRODUCTS]
      .sort((a, b) => (b.createdAt || '').localeCompare(a.createdAt || ''))
      .slice(0, 10);
  }, []);

  // 4. Featured Products: editorially certified marketplace picks
  const featuredProducts = useMemo(() => {
    return [...GENERAL_PRODUCTS]
      .filter((p) => p.isFeatured)
      .slice(0, 10);
  }, []);

  // 5. Recommended Products: personalized high-rated consumer picks
  const recommendedProducts = useMemo(() => {
    return [...GENERAL_PRODUCTS]
      .filter((p) => (p.rating ?? 0) >= 4.8)
      .slice(0, 10);
  }, []);

  // 6. Category-focused Marketplace Sections (Using real database products, 10 each)
  // 1. Grocery & Daily Essentials
  const groceryProducts = useMemo(() => {
    return GENERAL_PRODUCTS.filter((p) => p.categorySlug === 'grocery').slice(0, 10);
  }, []);

  // 2. Electronics & Gadgets
  const electronicsProducts = useMemo(() => {
    return GENERAL_PRODUCTS.filter((p) => p.categorySlug === 'electronics').slice(0, 10);
  }, []);

  // 3. Fashion & Lifestyle (Fashion does NOT dominate)
  const fashionProducts = useMemo(() => {
    return GENERAL_PRODUCTS.filter((p) => p.categorySlug === 'fashion').slice(0, 10);
  }, []);

  // 4. Home & Living
  const homeLivingProducts = useMemo(() => {
    return GENERAL_PRODUCTS.filter((p) => p.categorySlug === 'home-living').slice(0, 10);
  }, []);

  // 5. Beauty & Personal Care
  const beautyProducts = useMemo(() => {
    return GENERAL_PRODUCTS.filter((p) => p.categorySlug === 'beauty-personal-care').slice(0, 10);
  }, []);

  // 6. Mobile & Accessories
  const mobileAccessoriesProducts = useMemo(() => {
    return GENERAL_PRODUCTS.filter((p) => p.categorySlug === 'mobile-accessories').slice(0, 10);
  }, []);

  const handleToggleWishlist = (_productId: number) => {
    setWishlistCount((prev) => prev + 1);
  };

  const handleOpenPayment = () => {
    if (cart.length === 0) {
      alert('Your cart is empty!');
      return;
    }
    if (paymentMethod === 'cod') {
      const newOrder: OrderRecord = {
        orderNumber: 'BD-' + Math.floor(100000 + Math.random() * 900000),
        customerName,
        customerPhone,
        address: `${areaDetail}, ${upazilaThana}, ${selectedDistrict}, ${selectedDivision}`,
        subtotal,
        shipping: shippingCost,
        grandTotal,
        paymentMethod: 'cod',
        paymentStatus: 'pending',
        orderStatus: 'pending',
        items: cart.map((c) => {
          const itemSubtotal = c.product.salePrice * c.quantity;
          const comm = (itemSubtotal * c.product.vendorCommission) / 100;
          return {
            vendorName: c.product.vendorName,
            productName: c.product.name,
            qty: c.quantity,
            price: c.product.salePrice,
            commissionRate: c.product.vendorCommission,
            vendorEarning: itemSubtotal - comm,
            platformCut: comm,
          };
        }),
      };
      setOrders([newOrder, ...orders]);
      setCart([]);
      setCheckoutNotification(`Cash on Delivery order #${newOrder.orderNumber} placed successfully!`);
      setActiveTab('storefront');
    } else {
      setModalType(paymentMethod);
      setModalError('');
      setPaymentPhone(customerPhone);
      setTransactionId('');
      setScreenshotUploaded(false);
      setShowPaymentModal(true);
    }
  };

  const handleCancelModal = () => {
    // CRITICAL: Cancellation leaves cart intact with ZERO order created
    setShowPaymentModal(false);
    setCheckoutNotification('Payment cancelled. Your cart remains intact with zero order created.');
  };

  const handleSubmitManualPayment = (e: React.FormEvent) => {
    e.preventDefault();
    setModalError('');

    const bdPhoneRegex = /^(?:\+88|88)?(01[3-9]\d{8})$/;
    if (!bdPhoneRegex.test(paymentPhone.trim())) {
      setModalError('Please enter a valid 11-digit Bangladeshi mobile number (e.g. 017XXXXXXXX).');
      return;
    }

    if (!transactionId.trim() || transactionId.trim().length < 6) {
      setModalError('Transaction ID is required (minimum 6 characters).');
      return;
    }

    const isDuplicate = orders.some(
      (o) => o.transactionId?.toUpperCase() === transactionId.trim().toUpperCase()
    );
    if (isDuplicate) {
      setModalError('This Transaction ID has already been submitted. Duplicate payments are rejected.');
      return;
    }

    if (!screenshotUploaded) {
      setModalError('Payment screenshot proof is required for verification.');
      return;
    }

    const newOrder: OrderRecord = {
      orderNumber: 'BD-' + Math.floor(100000 + Math.random() * 900000),
      customerName,
      customerPhone,
      address: `${areaDetail}, ${upazilaThana}, ${selectedDistrict}, ${selectedDivision}`,
      subtotal,
      shipping: shippingCost,
      grandTotal,
      paymentMethod: modalType,
      paymentStatus: 'pending_verification',
      orderStatus: 'payment_verification',
      transactionId: transactionId.trim().toUpperCase(),
      paymentPhone: paymentPhone.trim(),
      submittedAt: 'Just now',
      screenshotUrl: 'https://images.unsplash.com/photo-1554415707-9e490104715c?w=500&auto=format&fit=crop&q=80',
      items: cart.map((c) => {
        const itemSubtotal = c.product.salePrice * c.quantity;
        const comm = (itemSubtotal * c.product.vendorCommission) / 100;
        return {
          vendorName: c.product.vendorName,
          productName: c.product.name,
          qty: c.quantity,
          price: c.product.salePrice,
          commissionRate: c.product.vendorCommission,
          vendorEarning: itemSubtotal - comm,
          platformCut: comm,
        };
      }),
    };

    setOrders([newOrder, ...orders]);
    setCart([]);
    setShowPaymentModal(false);
    setCheckoutNotification(
      `Payment submitted! Order #${newOrder.orderNumber} is awaiting Admin verification.`
    );
    setActiveTab('admin');
  };

  const handleAdminVerifyPayment = (orderNumber: string) => {
    setOrders((prev) =>
      prev.map((o) =>
        o.orderNumber === orderNumber
          ? {
              ...o,
              paymentStatus: 'paid',
              orderStatus: 'confirmed',
            }
          : o
      )
    );
  };

  const handleAdminRejectPayment = (orderNumber: string, reason: string) => {
    setOrders((prev) =>
      prev.map((o) =>
        o.orderNumber === orderNumber
          ? {
              ...o,
              paymentStatus: 'rejected',
              orderStatus: 'cancelled',
              rejectionReason: reason || 'Invalid transaction ID or mismatched amount.',
            }
          : o
      )
    );
    setRejectingOrderNumber(null);
    setRejectionReasonInput('');
  };

  return (
    <div className="min-h-screen bg-stone-100 text-stone-900 flex flex-col font-sans">
      {/* Top Utility Bar */}
      <div className="bg-stone-900 text-stone-300 text-xs py-1.5 px-4">
        <div className="max-w-7xl mx-auto flex flex-wrap justify-between items-center gap-2">
          <div className="flex items-center gap-2">
            <span className="bg-orange-600 text-white text-[10px] font-extrabold px-1.5 py-0.5 rounded tracking-wider">
              BANGLADESH
            </span>
            <span className="text-stone-300">
              General Multivendor Marketplace • Currency: <strong>BDT (৳)</strong> • 64 Districts Delivery
            </span>
          </div>
          <div className="flex items-center gap-4 text-[11px] text-stone-400">
            <span className="hidden sm:inline">Helpline: 09612-000000</span>
            <button
              onClick={() => setActiveTab('vendor')}
              className="text-stone-300 hover:text-white flex items-center gap-1.5 transition-colors font-medium"
            >
              <Store className="w-3.5 h-3.5 text-orange-400" />
              <span>Vendor Center</span>
            </button>
          </div>
        </div>
      </div>

      {/* Main Marketplace Header */}
      <header className="bg-white border-b border-stone-200 sticky top-0 z-30 shadow-xs">
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-3">
          <div className="flex items-center justify-between gap-4 lg:gap-6">
            {/* Logo */}
            <div
              onClick={() => {
                setActiveTab('storefront');
                setSelectedCategoryFilter('all');
              }}
              className="flex items-center gap-2.5 cursor-pointer shrink-0"
            >
              <div className="w-10 h-10 rounded-xl bg-orange-600 flex items-center justify-center text-white font-black text-xl shadow-xs">
                অ
              </div>
              <div>
                <div className="font-extrabold text-xl tracking-tight text-stone-900 leading-none">
                  Amar<span className="text-orange-600">Dokan</span>
                </div>
                <div className="text-[10px] font-semibold text-stone-500 tracking-wider uppercase mt-0.5">
                  General Marketplace
                </div>
              </div>
            </div>

            {/* Desktop Large Search Bar */}
            <div className="hidden md:flex flex-1 max-w-2xl relative">
              <input
                type="text"
                value={searchQuery}
                onChange={(e) => setSearchQuery(e.target.value)}
                placeholder="Search for products, brands and categories"
                className="w-full pl-4 pr-12 py-2.5 bg-stone-100/90 border border-stone-300 rounded-xl text-sm text-stone-900 placeholder-stone-500 focus:outline-hidden focus:ring-2 focus:ring-orange-600 focus:bg-white transition-all"
              />
              <button
                aria-label="Search"
                className="absolute right-1.5 top-1.5 bottom-1.5 px-3.5 bg-orange-600 hover:bg-orange-700 text-white rounded-lg flex items-center justify-center transition-colors shadow-2xs cursor-pointer"
              >
                <Search className="w-4 h-4" />
              </button>
            </div>

            {/* Desktop Navigation / Actions */}
            <div className="hidden lg:flex items-center gap-3.5 shrink-0">
              {/* Become a Vendor */}
              <button
                onClick={() => setActiveTab('vendor')}
                className="bg-orange-50 hover:bg-orange-100 text-orange-700 hover:text-orange-800 border border-orange-200 text-xs font-bold px-3 py-2 rounded-xl transition-colors flex items-center gap-1.5 shadow-2xs cursor-pointer"
              >
                <Store className="w-4 h-4 text-orange-600" />
                <span>Become a Vendor</span>
              </button>

              {/* Wishlist */}
              <button
                onClick={() => alert(`Saved Wishlist (${wishlistCount} items)`)}
                className="text-stone-600 hover:text-stone-900 flex flex-col items-center text-[11px] font-medium transition-colors px-1 cursor-pointer"
              >
                <Heart className="w-5 h-5 text-stone-700" />
                <span>Wishlist ({wishlistCount})</span>
              </button>

              {/* Cart Button */}
              <button
                onClick={() => setActiveTab('checkout')}
                className="relative text-stone-700 hover:text-orange-600 flex flex-col items-center text-[11px] font-medium transition-colors px-1 cursor-pointer"
              >
                <div className="relative">
                  <ShoppingCart className="w-5 h-5" />
                  {cart.length > 0 && (
                    <span className="absolute -top-1.5 -right-2 bg-orange-600 text-white font-black text-[10px] w-4 h-4 rounded-full flex items-center justify-center">
                      {cart.reduce((a, b) => a + b.quantity, 0)}
                    </span>
                  )}
                </div>
                <span>Cart</span>
              </button>

              {/* Authentication Actions */}
              {currentUser ? (
                /* Authenticated Customer Account UI */
                <div className="relative group pl-2 border-l border-stone-200">
                  <button className="flex items-center gap-2 text-stone-800 text-xs font-semibold py-1 hover:text-orange-600 transition-colors cursor-pointer">
                    <div className="w-7 h-7 rounded-full bg-orange-100 border border-orange-200 flex items-center justify-center text-orange-700 text-xs font-bold">
                      {currentUser.name.charAt(0).toUpperCase()}
                    </div>
                    <div className="text-left">
                      <div className="text-[10px] text-stone-500 font-normal leading-none">Customer</div>
                      <div className="font-bold text-xs truncate max-w-[100px]">{currentUser.name}</div>
                    </div>
                  </button>

                  {/* Dropdown Menu */}
                  <div className="absolute right-0 mt-1 w-48 bg-white rounded-xl shadow-xl border border-stone-200 py-1.5 hidden group-hover:block z-50">
                    <div className="px-3 py-2 border-b border-stone-100">
                      <div className="text-xs font-bold text-stone-900 truncate">{currentUser.name}</div>
                      <div className="text-[11px] text-stone-500 truncate">{currentUser.email || currentUser.phone}</div>
                    </div>
                    <button
                      onClick={() => alert(`Customer Account Profile for ${currentUser.name}`)}
                      className="w-full text-left px-3 py-2 text-xs text-stone-700 hover:bg-orange-50 hover:text-orange-600 font-medium cursor-pointer"
                    >
                      My Account
                    </button>
                    <button
                      onClick={() => alert('Orders: 1 verified order undergoing delivery.')}
                      className="w-full text-left px-3 py-2 text-xs text-stone-700 hover:bg-orange-50 hover:text-orange-600 font-medium cursor-pointer"
                    >
                      Orders & History
                    </button>
                    <button
                      onClick={() => alert(`Saved Wishlist (${wishlistCount} items)`)}
                      className="w-full text-left px-3 py-2 text-xs text-stone-700 hover:bg-orange-50 hover:text-orange-600 font-medium cursor-pointer"
                    >
                      Wishlist ({wishlistCount})
                    </button>
                    <button
                      onClick={() => setActiveTab('checkout')}
                      className="w-full text-left px-3 py-2 text-xs text-stone-700 hover:bg-orange-50 hover:text-orange-600 font-medium cursor-pointer"
                    >
                      View Cart ({cart.reduce((a, b) => a + b.quantity, 0)})
                    </button>
                    <div className="border-t border-stone-100 my-1"></div>
                    <button
                      onClick={() => {
                        setCurrentUser(null);
                        setCart([]);
                        setCheckoutNotification('You have been logged out.');
                        setTimeout(() => setCheckoutNotification(null), 3000);
                      }}
                      className="w-full text-left px-3 py-2 text-xs text-red-600 hover:bg-red-50 font-semibold cursor-pointer"
                    >
                      Logout
                    </button>
                  </div>
                </div>
              ) : (
                /* Guest Authentication Links */
                <div className="flex items-center gap-2 pl-2 border-l border-stone-200">
                  <button
                    onClick={() => {
                      setCustomerAuthModalMode('login');
                      setShowCustomerAuthModal(true);
                    }}
                    className="text-stone-700 hover:text-orange-600 text-xs font-bold px-2.5 py-2 transition-colors cursor-pointer"
                  >
                    Login
                  </button>
                  <button
                    onClick={() => {
                      setCustomerAuthModalMode('register');
                      setShowCustomerAuthModal(true);
                    }}
                    className="bg-orange-600 hover:bg-orange-700 text-white text-xs font-bold px-3.5 py-2 rounded-xl transition-colors shadow-2xs cursor-pointer"
                  >
                    Register
                  </button>
                </div>
              )}
            </div>

            {/* Mobile Header Actions */}
            <div className="flex lg:hidden items-center gap-2">
              <button
                onClick={() => setActiveTab('checkout')}
                className="relative p-2 text-stone-700 cursor-pointer"
              >
                <ShoppingCart className="w-6 h-6" />
                {cart.length > 0 && (
                  <span className="absolute top-1 right-1 bg-orange-600 text-white font-bold text-[10px] w-4 h-4 rounded-full flex items-center justify-center">
                    {cart.reduce((a, b) => a + b.quantity, 0)}
                  </span>
                )}
              </button>
              {currentUser ? (
                <button
                  onClick={() => {
                    const confirmOut = window.confirm(`Logged in as ${currentUser.name}. Do you wish to logout?`);
                    if (confirmOut) {
                      setCurrentUser(null);
                      setCart([]);
                    }
                  }}
                  className="w-7 h-7 rounded-full bg-orange-100 border border-orange-200 flex items-center justify-center text-orange-700 text-xs font-bold"
                >
                  {currentUser.name.charAt(0).toUpperCase()}
                </button>
              ) : (
                <button
                  onClick={() => {
                    setCustomerAuthModalMode('login');
                    setShowCustomerAuthModal(true);
                  }}
                  className="p-2 text-stone-700 cursor-pointer"
                >
                  <User className="w-6 h-6" />
                </button>
              )}
            </div>
          </div>

          {/* Mobile Search Bar */}
          <div className="md:hidden mt-2.5">
            <div className="relative">
              <input
                type="text"
                value={searchQuery}
                onChange={(e) => setSearchQuery(e.target.value)}
                placeholder="Search for products, brands and categories"
                className="w-full pl-3.5 pr-10 py-2 bg-stone-100 border border-stone-300 rounded-lg text-xs text-stone-900 placeholder-stone-500 focus:outline-hidden focus:ring-1 focus:ring-orange-600"
              />
              <button className="absolute right-2 top-2 bottom-2 text-stone-500">
                <Search className="w-4 h-4" />
              </button>
            </div>
          </div>

          {/* Secondary Categories Bar */}
          <div className="hidden md:flex items-center gap-4 mt-2.5 pt-2 border-t border-stone-100 text-xs text-stone-700 overflow-x-auto">
            <button
              onClick={() => {
                setSelectedCategoryFilter('all');
                setActiveTab('storefront');
              }}
              className={`font-bold pb-1 transition-colors ${
                selectedCategoryFilter === 'all' && activeTab === 'storefront'
                  ? 'text-orange-600 border-b-2 border-orange-600'
                  : 'hover:text-stone-950'
              }`}
            >
              All Categories
            </button>
            {MARKETPLACE_CATEGORIES.slice(0, 8).map((cat) => (
              <button
                key={cat.id}
                onClick={() => {
                  setSelectedCategoryFilter(cat.id);
                  setActiveTab('storefront');
                }}
                className={`whitespace-nowrap pb-1 transition-colors ${
                  selectedCategoryFilter === cat.id && activeTab === 'storefront'
                    ? 'text-orange-600 font-bold border-b-2 border-orange-600'
                    : 'text-stone-600 hover:text-stone-900'
                }`}
              >
                {cat.name}
              </button>
            ))}
            <button
              onClick={() => setActiveTab('laravel_code')}
              className="ml-auto text-stone-500 hover:text-stone-900 font-mono text-[11px] flex items-center gap-1"
            >
              <FileText className="w-3.5 h-3.5" />
              Laravel 13 Architecture
            </button>
          </div>
        </div>
      </header>

      {/* Notification Toast */}
      {checkoutNotification && (
        <div className="max-w-7xl mx-auto w-full px-4 sm:px-6 lg:px-8 mt-3">
          <div className="p-3.5 rounded-xl bg-orange-50 border border-orange-200 flex items-center justify-between text-orange-950 text-xs sm:text-sm shadow-xs">
            <div className="flex items-center gap-2">
              <CheckCircle className="w-4 h-4 text-orange-600 shrink-0" />
              <span>{checkoutNotification}</span>
            </div>
            <button
              onClick={() => setCheckoutNotification(null)}
              className="text-orange-700 hover:text-orange-950 p-1"
            >
              <X className="w-4 h-4" />
            </button>
          </div>
        </div>
      )}

      {/* Main Content View */}
      <main className="max-w-7xl mx-auto w-full px-4 sm:px-6 lg:px-8 py-5 flex-1">
        {/* ================= STOREFRONT & GENERAL MARKETPLACE HOMEPAGE ================= */}
        {activeTab === 'storefront' && (
          <div className="space-y-8">
            {/* HERO SECTION: General Marketplace Hero Banner */}
            <section className="bg-white rounded-2xl border border-stone-200 shadow-xs overflow-hidden">
              <div className="grid grid-cols-1 lg:grid-cols-12 items-center">
                {/* Left Content (Mobile shorter & responsive) */}
                <div className="lg:col-span-7 p-6 sm:p-10 lg:p-12 space-y-4 sm:space-y-5">
                  <div className="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-orange-100/80 border border-orange-200 text-orange-800 text-xs font-bold tracking-wide">
                    <span className="w-2 h-2 rounded-full bg-orange-600 animate-pulse"></span>
                    BANGLADESH GENERAL MARKETPLACE
                  </div>

                  <h1 className="text-3xl sm:text-4xl lg:text-5xl font-black text-stone-900 tracking-tight leading-tight">
                    Everything You Need.<br />
                    <span className="text-orange-600">One Marketplace.</span>
                  </h1>

                  <p className="text-stone-600 text-sm sm:text-base max-w-xl leading-relaxed">
                    Shop groceries, electronics, fashion, home essentials and more from trusted sellers.
                  </p>

                  <div className="flex flex-wrap items-center gap-3 pt-2">
                    <button
                      onClick={() => {
                        const el = document.getElementById('shop-by-category');
                        el?.scrollIntoView({ behavior: 'smooth' });
                      }}
                      className="bg-orange-600 hover:bg-orange-700 text-white text-xs sm:text-sm font-bold px-6 py-3 rounded-xl shadow-xs transition-colors flex items-center gap-2"
                    >
                      <span>Shop Now</span>
                      <ArrowRight className="w-4 h-4" />
                    </button>
                    <button
                      onClick={() => {
                        const el = document.getElementById('shop-by-category');
                        el?.scrollIntoView({ behavior: 'smooth' });
                      }}
                      className="bg-stone-100 hover:bg-stone-200 text-stone-800 text-xs sm:text-sm font-bold px-5 py-3 rounded-xl border border-stone-300 transition-colors"
                    >
                      Explore Categories
                    </button>
                  </div>

                  <div className="pt-4 border-t border-stone-100 grid grid-cols-3 gap-2 sm:gap-4 text-[11px] sm:text-xs font-semibold text-stone-600">
                    <div className="flex items-center gap-1.5">
                      <Check className="w-4 h-4 text-orange-600" />
                      <span>Cash on Delivery</span>
                    </div>
                    <div className="flex items-center gap-1.5">
                      <Check className="w-4 h-4 text-orange-600" />
                      <span>bKash & Nagad</span>
                    </div>
                    <div className="flex items-center gap-1.5">
                      <Check className="w-4 h-4 text-orange-600" />
                      <span>Inside Dhaka ৳60</span>
                    </div>
                  </div>
                </div>

                {/* Right Visual Diversity Showcase: Grocery + Tech + Home + Beauty */}
                <div className="lg:col-span-5 p-4 sm:p-6 lg:p-8 bg-stone-50 border-t lg:border-t-0 lg:border-l border-stone-200">
                  <div className="grid grid-cols-2 gap-3 sm:gap-4">
                    {/* Grocery */}
                    <div
                      onClick={() => setSelectedCategoryFilter('grocery')}
                      className="bg-white rounded-xl p-3 border border-stone-200 shadow-2xs hover:border-orange-500 cursor-pointer transition-colors group"
                    >
                      <div className="h-24 sm:h-28 rounded-lg bg-amber-50 overflow-hidden mb-2">
                        <img
                          src="https://images.unsplash.com/photo-1542838132-92c53300491e?w=500&auto=format&fit=crop&q=80"
                          alt="Grocery"
                          className="w-full h-full object-cover group-hover:scale-105 transition-transform"
                        />
                      </div>
                      <div className="font-bold text-xs text-stone-900">Grocery & Rice</div>
                      <div className="text-[10px] text-stone-500">Nazirshail, Oil, Dal</div>
                    </div>

                    {/* Electronics */}
                    <div
                      onClick={() => setSelectedCategoryFilter('electronics')}
                      className="bg-white rounded-xl p-3 border border-stone-200 shadow-2xs hover:border-orange-500 cursor-pointer transition-colors group"
                    >
                      <div className="h-24 sm:h-28 rounded-lg bg-blue-50 overflow-hidden mb-2">
                        <img
                          src="https://images.unsplash.com/photo-1511707171634-5f897ff02aa9?w=500&auto=format&fit=crop&q=80"
                          alt="Electronics"
                          className="w-full h-full object-cover group-hover:scale-105 transition-transform"
                        />
                      </div>
                      <div className="font-bold text-xs text-stone-900">Phones & Tech</div>
                      <div className="text-[10px] text-stone-500">Smartphones, TVs</div>
                    </div>

                    {/* Home & Kitchen */}
                    <div
                      onClick={() => setSelectedCategoryFilter('home-living')}
                      className="bg-white rounded-xl p-3 border border-stone-200 shadow-2xs hover:border-orange-500 cursor-pointer transition-colors group"
                    >
                      <div className="h-24 sm:h-28 rounded-lg bg-emerald-50 overflow-hidden mb-2">
                        <img
                          src="https://images.unsplash.com/photo-1556911220-e15b29be8c8f?w=500&auto=format&fit=crop&q=80"
                          alt="Home & Appliances"
                          className="w-full h-full object-cover group-hover:scale-105 transition-transform"
                        />
                      </div>
                      <div className="font-bold text-xs text-stone-900">Home & Kitchen</div>
                      <div className="text-[10px] text-stone-500">Blenders, Cookware</div>
                    </div>

                    {/* Beauty & Personal Care */}
                    <div
                      onClick={() => setSelectedCategoryFilter('beauty-personal-care')}
                      className="bg-white rounded-xl p-3 border border-stone-200 shadow-2xs hover:border-orange-500 cursor-pointer transition-colors group"
                    >
                      <div className="h-24 sm:h-28 rounded-lg bg-rose-50 overflow-hidden mb-2">
                        <img
                          src="https://images.unsplash.com/photo-1522337360788-8b13dee7a37e?w=500&auto=format&fit=crop&q=80"
                          alt="Beauty"
                          className="w-full h-full object-cover group-hover:scale-105 transition-transform"
                        />
                      </div>
                      <div className="font-bold text-xs text-stone-900">Beauty & Care</div>
                      <div className="text-[10px] text-stone-500">Skincare, Grooming</div>
                    </div>
                  </div>
                </div>
              </div>
            </section>

            {/* SHOP BY CATEGORY SECTION: 2 per row on mobile, 5-7 per row on desktop */}
            <section id="shop-by-category">
              <div className="flex items-center justify-between mb-4">
                <div>
                  <h2 className="text-xl sm:text-2xl font-black text-stone-900 tracking-tight">
                    Shop by Category
                  </h2>
                  <p className="text-xs text-stone-500 mt-0.5">
                    Explore all 14 legal consumer product divisions in Bangladesh
                  </p>
                </div>
                {selectedCategoryFilter !== 'all' && (
                  <button
                    onClick={() => setSelectedCategoryFilter('all')}
                    className="text-xs font-bold text-orange-600 hover:text-orange-700 flex items-center gap-1"
                  >
                    <span>Clear Filter</span>
                    <X className="w-3.5 h-3.5" />
                  </button>
                )}
              </div>

              {/* Grid: 2 cols on mobile, 3 sm, 4 md, 7 lg */}
              <div className="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-7 gap-3 sm:gap-4">
                {MARKETPLACE_CATEGORIES.map((cat) => {
                  const Icon = cat.icon;
                  const isSelected = selectedCategoryFilter === cat.id;
                  return (
                    <div
                      key={cat.id}
                      onClick={() => setSelectedCategoryFilter(isSelected ? 'all' : cat.id)}
                      className={`bg-white rounded-xl p-3 border transition-all cursor-pointer flex flex-col items-center text-center group ${
                        isSelected
                          ? 'border-orange-600 ring-2 ring-orange-600/20 bg-orange-50/20'
                          : 'border-stone-200 hover:border-orange-500 shadow-2xs hover:shadow-xs'
                      }`}
                    >
                      <div
                        className={`w-12 h-12 rounded-xl flex items-center justify-center transition-colors mb-2 ${
                          isSelected
                            ? 'bg-orange-600 text-white'
                            : 'bg-stone-100 text-stone-700 group-hover:bg-orange-50 group-hover:text-orange-600'
                        }`}
                      >
                        <Icon className="w-6 h-6" />
                      </div>
                      <span className="font-bold text-xs text-stone-900 group-hover:text-orange-600 line-clamp-1">
                        {cat.name}
                      </span>
                      <span className="text-[10px] text-stone-400 mt-0.5">
                        {cat.count}+ items
                      </span>
                    </div>
                  );
                })}
              </div>
            </section>

            {/* If searching or filtering by a category, show targeted catalog */}
            {selectedCategoryFilter !== 'all' || searchQuery.trim() !== '' ? (
              <section className="bg-white rounded-2xl border border-stone-200 p-4 sm:p-6 shadow-xs">
                <div className="flex items-center justify-between mb-5 pb-4 border-b border-stone-100">
                  <div>
                    <h3 className="text-lg sm:text-xl font-black text-stone-900">
                      {selectedCategoryFilter === 'all'
                        ? `Search Results for "${searchQuery}"`
                        : `Category: ${
                            MARKETPLACE_CATEGORIES.find((c) => c.id === selectedCategoryFilter)?.name
                          }`}
                    </h3>
                    <span className="text-xs text-stone-500">
                      {filteredProducts.length} verified products found
                    </span>
                  </div>
                  <button
                    onClick={() => {
                      setSelectedCategoryFilter('all');
                      setSearchQuery('');
                    }}
                    className="text-xs text-orange-600 font-bold hover:underline"
                  >
                    Clear Filter
                  </button>
                </div>

                {filteredProducts.length === 0 ? (
                  <div className="p-8 text-center">
                    <AlertCircle className="w-8 h-8 text-stone-400 mx-auto mb-2" />
                    <p className="text-sm font-semibold text-stone-700">No products match your current search.</p>
                    <button
                      onClick={() => {
                        setSelectedCategoryFilter('all');
                        setSearchQuery('');
                      }}
                      className="mt-3 text-xs text-orange-600 font-bold hover:underline"
                    >
                      Reset all filters
                    </button>
                  </div>
                ) : (
                  <div className="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-3 sm:gap-4 md:gap-5">
                    {filteredProducts.map((prod) => (
                      <ProductCard
                        key={prod.id}
                        product={prod}
                        onAddToCart={addToCart}
                        onToggleWishlist={handleToggleWishlist}
                      />
                    ))}
                  </div>
                )}
              </section>
            ) : (
              /* GENERAL MULTIVENDOR MARKETPLACE HOMEPAGE SECTIONS */
              <div className="space-y-8 sm:space-y-10">
                {/* 4. FLASH DEALS */}
                <ProductSection
                  id="flash-deals"
                  title="Flash Deals"
                  subtitle="Limited-time price drops on groceries, phones, appliances & lifestyle essentials"
                  badge="Limited Time"
                  badgeColor="red"
                  icon="⚡"
                  products={flashDeals}
                  limit={10}
                  onAddToCart={addToCart}
                  onToggleWishlist={handleToggleWishlist}
                  seeMoreText="See More Flash Deals"
                />

                {/* 5. GROCERY & DAILY ESSENTIALS */}
                <ProductSection
                  id="category-grocery"
                  title="Grocery & Daily Essentials"
                  subtitle="Rice, dal, edible oil, spices, tea, salt, flour & everyday kitchen necessities"
                  badge="Pantry Essentials"
                  badgeColor="orange"
                  icon="🌾"
                  products={groceryProducts}
                  limit={10}
                  onAddToCart={addToCart}
                  onToggleWishlist={handleToggleWishlist}
                  onSeeMore={() => setSelectedCategoryFilter('grocery')}
                  seeMoreText="See More in Grocery"
                />

                {/* 6. ELECTRONICS & GADGETS */}
                <ProductSection
                  id="category-electronics"
                  title="Electronics & Gadgets"
                  subtitle="Smartphones, laptops, headphones, earbuds, smart watches, chargers & PC accessories"
                  badge="Official Tech"
                  badgeColor="orange"
                  icon="⚡"
                  products={electronicsProducts}
                  limit={10}
                  onAddToCart={addToCart}
                  onToggleWishlist={handleToggleWishlist}
                  onSeeMore={() => setSelectedCategoryFilter('electronics')}
                  seeMoreText="See More Electronics"
                />

                {/* 7. FASHION & LIFESTYLE (Fashion must NOT dominate the homepage) */}
                <ProductSection
                  id="category-fashion"
                  title="Fashion & Lifestyle"
                  subtitle="Comfortable sarees, panjabis, polo shirts, sneakers & casual apparel"
                  badge="Everyday Wear"
                  badgeColor="orange"
                  icon="👕"
                  products={fashionProducts}
                  limit={10}
                  onAddToCart={addToCart}
                  onToggleWishlist={handleToggleWishlist}
                  onSeeMore={() => setSelectedCategoryFilter('fashion')}
                  seeMoreText="See More Fashion"
                />

                {/* 8. HOME & LIVING */}
                <ProductSection
                  id="category-home-living"
                  title="Home & Living"
                  subtitle="Kitchen appliances, storage containers, cotton bedsheets, lighting & decor"
                  badge="Comfort Living"
                  badgeColor="orange"
                  icon="🏠"
                  products={homeLivingProducts}
                  limit={10}
                  onAddToCart={addToCart}
                  onToggleWishlist={handleToggleWishlist}
                  onSeeMore={() => setSelectedCategoryFilter('home-living')}
                  seeMoreText="See More Home & Living"
                />

                {/* 9. BEAUTY & PERSONAL CARE */}
                <ProductSection
                  id="category-beauty"
                  title="Beauty & Personal Care"
                  subtitle="Cleansers, moisturizers, sunscreen, oral care & daily personal hygiene"
                  badge="Pure Care"
                  badgeColor="orange"
                  icon="✨"
                  products={beautyProducts}
                  limit={10}
                  onAddToCart={addToCart}
                  onToggleWishlist={handleToggleWishlist}
                  onSeeMore={() => setSelectedCategoryFilter('beauty-personal-care')}
                  seeMoreText="See More Beauty"
                />

                {/* 10. MOBILE & ACCESSORIES */}
                <ProductSection
                  id="category-mobile"
                  title="Mobile & Accessories"
                  subtitle="Fast chargers, power banks, braided cables, earbuds & protective cases"
                  badge="Mobile Gear"
                  badgeColor="orange"
                  icon="📱"
                  products={mobileAccessoriesProducts}
                  limit={10}
                  onAddToCart={addToCart}
                  onToggleWishlist={handleToggleWishlist}
                  onSeeMore={() => setSelectedCategoryFilter('mobile-accessories')}
                  seeMoreText="See More Mobile & Gadgets"
                />

                {/* 11. BEST SELLERS */}
                <ProductSection
                  id="best-sellers"
                  title="Best Sellers"
                  subtitle="Most ordered items backed by real customer sales & delivery records"
                  badge="Top Ordered"
                  badgeColor="orange"
                  icon="🔥"
                  products={bestSellers}
                  limit={10}
                  onAddToCart={addToCart}
                  onToggleWishlist={handleToggleWishlist}
                  seeMoreText="See More Best Sellers"
                />

                {/* 12. NEW ARRIVALS */}
                <ProductSection
                  id="new-arrivals"
                  title="New Arrivals"
                  subtitle="Freshly listed products from verified Bangladeshi merchants"
                  badge="Just In"
                  badgeColor="orange"
                  icon="✨"
                  products={newArrivals}
                  limit={10}
                  onAddToCart={addToCart}
                  onToggleWishlist={handleToggleWishlist}
                  seeMoreText="See More New Arrivals"
                />

                {/* 13. FEATURED & RECOMMENDED */}
                <ProductSection
                  id="featured-products"
                  title="Featured Products"
                  subtitle="Handpicked quality selections across everyday household and tech needs"
                  badge="Staff Pick"
                  badgeColor="orange"
                  icon="⭐"
                  products={featuredProducts}
                  limit={10}
                  onAddToCart={addToCart}
                  onToggleWishlist={handleToggleWishlist}
                  seeMoreText="See More Featured"
                />

                <ProductSection
                  id="recommended-products"
                  title="Recommended For You"
                  subtitle="Personalized suggestions based on popular demand and shopping interests"
                  badge="For You"
                  badgeColor="orange"
                  icon="🎯"
                  products={recommendedProducts}
                  limit={10}
                  onAddToCart={addToCart}
                  onToggleWishlist={handleToggleWishlist}
                  seeMoreText="Explore All Recommendations"
                />

                {/* 14. PROMOTIONAL BANNERS */}
                <section className="w-full space-y-4 sm:space-y-6">
                  {/* Row 1: Grocery & Electronics Promo Cards */}
                  <div className="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6">
                    <div className="relative rounded-2xl overflow-hidden min-h-[190px] sm:min-h-[220px] p-6 sm:p-8 flex flex-col justify-between text-white shadow-xs group">
                      <img
                        src="https://images.unsplash.com/photo-1542838132-92c53300491e?w=800&auto=format&fit=crop&q=80"
                        alt="Grocery Deals"
                        className="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                        loading="lazy"
                      />
                      <div className="absolute inset-0 bg-gradient-to-r from-amber-950/90 via-stone-900/80 to-transparent"></div>
                      <div className="relative z-10 space-y-2">
                        <span className="inline-block bg-amber-500 text-white font-extrabold text-[10px] sm:text-xs px-2.5 py-0.5 rounded-full uppercase tracking-wider shadow-xs">
                          Daily Pantry Essentials
                        </span>
                        <h3 className="text-xl sm:text-2xl font-black tracking-tight">Groceries for Less</h3>
                        <p className="text-xs sm:text-sm text-stone-200 max-w-sm">Save on Miniket rice, soybean oil, lentils, spices & breakfast items.</p>
                      </div>
                      <div className="relative z-10 pt-4">
                        <button
                          onClick={() => setSelectedCategoryFilter('grocery')}
                          className="inline-flex items-center gap-1.5 bg-white text-stone-900 hover:bg-amber-500 hover:text-white font-bold text-xs px-4 py-2 rounded-xl transition-colors shadow-xs"
                        >
                          <span>Shop Grocery Deals</span>
                          <ArrowRight className="w-3.5 h-3.5" />
                        </button>
                      </div>
                    </div>

                    <div className="relative rounded-2xl overflow-hidden min-h-[190px] sm:min-h-[220px] p-6 sm:p-8 flex flex-col justify-between text-white shadow-xs group">
                      <img
                        src="https://images.unsplash.com/photo-1511707171634-5f897ff02aa9?w=800&auto=format&fit=crop&q=80"
                        alt="Electronics"
                        className="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                        loading="lazy"
                      />
                      <div className="absolute inset-0 bg-gradient-to-r from-blue-950/90 via-stone-900/80 to-transparent"></div>
                      <div className="relative z-10 space-y-2">
                        <span className="inline-block bg-sky-500 text-white font-extrabold text-[10px] sm:text-xs px-2.5 py-0.5 rounded-full uppercase tracking-wider shadow-xs">
                          Tech & Gadgets
                        </span>
                        <h3 className="text-xl sm:text-2xl font-black tracking-tight">Latest Electronics</h3>
                        <p className="text-xs sm:text-sm text-stone-200 max-w-sm">Smartphones, laptops, ANC earbuds & accessories with warranty.</p>
                      </div>
                      <div className="relative z-10 pt-4">
                        <button
                          onClick={() => setSelectedCategoryFilter('electronics')}
                          className="inline-flex items-center gap-1.5 bg-white text-stone-900 hover:bg-sky-500 hover:text-white font-bold text-xs px-4 py-2 rounded-xl transition-colors shadow-xs"
                        >
                          <span>Explore Gadgets</span>
                          <ArrowRight className="w-3.5 h-3.5" />
                        </button>
                      </div>
                    </div>
                  </div>

                  {/* Row 2: Full-width Curated Banner */}
                  <div className="relative rounded-2xl overflow-hidden min-h-[160px] sm:min-h-[190px] p-6 sm:p-8 flex flex-col sm:flex-row sm:items-center justify-between text-white shadow-xs group gap-4">
                    <img
                      src="https://images.unsplash.com/photo-1489987707025-afc232f7ea0f?w=1200&auto=format&fit=crop&q=80"
                      alt="Fashion & Lifestyle Deals"
                      className="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                      loading="lazy"
                    />
                    <div className="absolute inset-0 bg-gradient-to-r from-orange-950/90 via-stone-900/80 to-transparent"></div>
                    <div className="relative z-10 space-y-1.5">
                      <span className="inline-block bg-orange-600 text-white font-extrabold text-[10px] sm:text-xs px-2.5 py-0.5 rounded-full uppercase tracking-wider shadow-xs">
                        Curated Collection
                      </span>
                      <h3 className="text-xl sm:text-2xl font-black tracking-tight">Marketplace Lifestyle & Everyday Living</h3>
                      <p className="text-xs sm:text-sm text-stone-300 max-w-lg">Handpicked essentials from verified artisans and licensed distributors across Bangladesh.</p>
                    </div>
                    <div className="relative z-10 shrink-0">
                      <button
                        onClick={() => setSelectedCategoryFilter('home-living')}
                        className="inline-flex items-center gap-1.5 bg-orange-600 hover:bg-orange-700 text-white font-bold text-xs sm:text-sm px-5 py-2.5 rounded-xl transition-colors shadow-sm"
                      >
                        <span>Explore Collection</span>
                        <ArrowRight className="w-4 h-4" />
                      </button>
                    </div>
                  </div>
                </section>

                {/* 15. POPULAR STORES (TOP VENDORS) */}
                <section id="popular-stores" className="w-full">
                  <div className="bg-white rounded-2xl border border-stone-200 p-6 sm:p-8 shadow-xs">
                    <div className="flex flex-col sm:flex-row sm:items-center justify-between gap-3 mb-6 pb-4 border-b border-stone-100">
                      <div>
                        <div className="flex items-center gap-2">
                          <h2 className="text-xl sm:text-2xl font-black text-stone-900 tracking-tight">Popular Stores</h2>
                          <span className="bg-orange-100 text-orange-800 text-[10px] sm:text-xs font-bold px-2 py-0.5 rounded-full border border-orange-200">
                            Verified Sellers
                          </span>
                        </div>
                        <p className="text-xs sm:text-sm text-stone-500 mt-1">
                          Shop directly from authorized and active vendors across Bangladesh with audited business licenses.
                        </p>
                      </div>
                      <button
                        onClick={() => setActiveTab('vendor')}
                        className="text-xs font-bold text-orange-600 hover:text-orange-700 flex items-center gap-1 group self-start sm:self-auto"
                      >
                        <span>Become a Seller</span>
                        <ArrowRight className="w-3.5 h-3.5 group-hover:translate-x-0.5 transition-transform" />
                      </button>
                    </div>

                    <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                      {POPULAR_VENDORS.map((vendor) => (
                        <div
                          key={vendor.id}
                          className="bg-stone-50 rounded-xl p-4 border border-stone-200 hover:border-orange-400 transition-all flex flex-col justify-between group"
                        >
                          <div className="flex items-start gap-3.5">
                            <div className="w-12 h-12 rounded-xl bg-white border border-stone-200 flex items-center justify-center text-orange-600 font-black text-lg shadow-2xs shrink-0 overflow-hidden">
                              <img src={vendor.logo} alt={vendor.name} className="w-full h-full object-cover" loading="lazy" />
                            </div>

                            <div className="flex-1 min-w-0">
                              <div className="flex items-center justify-between gap-1">
                                <h4 className="font-bold text-stone-900 text-sm group-hover:text-orange-600 transition-colors truncate">
                                  {vendor.name}
                                </h4>
                                <span className="inline-flex items-center text-emerald-600 text-[10px] font-bold shrink-0">
                                  <CheckCircle2 className="w-3.5 h-3.5" />
                                </span>
                              </div>
                              <p className="text-[11px] text-stone-500 line-clamp-2 mt-0.5">
                                {vendor.description}
                              </p>
                              <div className="flex items-center gap-3 text-[11px] text-stone-500 mt-2">
                                <span className="font-semibold text-stone-700">{vendor.productsCount} Products</span>
                                <span>•</span>
                                <span className="flex items-center text-amber-500 font-bold gap-0.5">
                                  <Star className="w-3 h-3 fill-amber-400 text-amber-400" />
                                  {vendor.rating}
                                </span>
                              </div>
                            </div>
                          </div>

                          <div className="mt-3 pt-3 border-t border-stone-200/70 flex items-center justify-between">
                            <span className="text-[11px] text-stone-400 truncate max-w-[140px]">{vendor.address}</span>
                            <button
                              onClick={() => {
                                setSearchQuery(vendor.name);
                              }}
                              className="inline-flex items-center gap-1 text-xs font-bold text-orange-600 hover:text-orange-700 group-hover:underline"
                            >
                              <span>Visit Store</span>
                              <ArrowRight className="w-3 h-3" />
                            </button>
                          </div>
                        </div>
                      ))}
                    </div>
                  </div>
                </section>

                {/* 16. WHY SHOP WITH US (TRUST SECTION) */}
                <section id="why-shop-with-us" className="w-full">
                  <div className="bg-white rounded-2xl border border-stone-200 p-6 sm:p-8 lg:p-10 shadow-xs">
                    <div className="text-center max-w-2xl mx-auto mb-8 sm:mb-10">
                      <span className="text-xs font-extrabold uppercase tracking-widest text-orange-600 mb-1 inline-block">
                        Marketplace Reliability
                      </span>
                      <h2 className="text-2xl sm:text-3xl font-black text-stone-900 tracking-tight">Why Shop With Us</h2>
                      <p className="text-xs sm:text-sm text-stone-500 mt-1">
                        Every order is protected by verified merchant guidelines and secure payment workflows.
                      </p>
                    </div>

                    <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-6 sm:gap-8">
                      {/* 1. Trusted Sellers */}
                      <div className="flex flex-col items-center text-center space-y-2.5">
                        <div className="w-12 h-12 rounded-2xl bg-orange-50 border border-orange-200 flex items-center justify-center text-orange-600 shadow-2xs">
                          <ShieldCheck className="w-6 h-6" />
                        </div>
                        <h4 className="font-bold text-sm text-stone-900">Trusted Sellers</h4>
                        <p className="text-xs text-stone-500 leading-relaxed">
                          100% verified Bangladeshi stores with verified Trade Licenses and authentic merchandise.
                        </p>
                      </div>

                      {/* 2. Secure Checkout */}
                      <div className="flex flex-col items-center text-center space-y-2.5">
                        <div className="w-12 h-12 rounded-2xl bg-emerald-50 border border-emerald-200 flex items-center justify-center text-emerald-600 shadow-2xs">
                          <CheckCircle className="w-6 h-6" />
                        </div>
                        <h4 className="font-bold text-sm text-stone-900">Secure Checkout</h4>
                        <p className="text-xs text-stone-500 leading-relaxed">
                          End-to-end encrypted order placement with zero unverified deductions or card leakages.
                        </p>
                      </div>

                      {/* 3. Multiple Payment Options */}
                      <div className="flex flex-col items-center text-center space-y-2.5">
                        <div className="w-12 h-12 rounded-2xl bg-blue-50 border border-blue-200 flex items-center justify-center text-blue-600 shadow-2xs">
                          <CreditCard className="w-6 h-6" />
                        </div>
                        <h4 className="font-bold text-sm text-stone-900">COD, bKash & Nagad</h4>
                        <p className="text-xs text-stone-500 leading-relaxed">
                          Pay cash at your doorstep, or make instant mobile banking payments via personal bKash or Nagad.
                        </p>
                      </div>

                      {/* 4. Fast Nationwide Delivery */}
                      <div className="flex flex-col items-center text-center space-y-2.5">
                        <div className="w-12 h-12 rounded-2xl bg-purple-50 border border-purple-200 flex items-center justify-center text-purple-600 shadow-2xs">
                          <Truck className="w-6 h-6" />
                        </div>
                        <h4 className="font-bold text-sm text-stone-900">Nationwide Delivery</h4>
                        <p className="text-xs text-stone-500 leading-relaxed">
                          24–48 hours delivery inside Dhaka, and 48–72 hours across all 64 districts in Bangladesh.
                        </p>
                      </div>

                      {/* 5. Customer Support */}
                      <div className="flex flex-col items-center text-center space-y-2.5">
                        <div className="w-12 h-12 rounded-2xl bg-amber-50 border border-amber-200 flex items-center justify-center text-amber-600 shadow-2xs">
                          <Phone className="w-6 h-6" />
                        </div>
                        <h4 className="font-bold text-sm text-stone-900">Customer Support</h4>
                        <p className="text-xs text-stone-500 leading-relaxed">
                          Direct hotline support and rapid order query resolution in Bengali and English.
                        </p>
                      </div>
                    </div>
                  </div>
                </section>

                {/* 17. CUSTOMER REVIEWS ("What Our Customers Say") */}
                <CustomerReviewsSection
                  reviews={customerReviews}
                  onSelectProduct={(productId) => {
                    const found = GENERAL_PRODUCTS.find((p) => p.id === productId);
                    if (found) {
                      setSearchQuery(found.name);
                    }
                  }}
                  onAddToCart={addToCart}
                />

                {/* 18. PAYMENT OPTIONS ("Pay Your Way") */}
                <PaymentOptionsSection
                  onGoToCheckout={() => setActiveTab('checkout')}
                />

                {/* 19. NEWSLETTER ("Get the Latest Deals & Offers") */}
                <NewsletterSection />
              </div>
            )}
          </div>
        )}

        {/* ================= CHECKOUT & BANGLADESH ADDRESS TAB ================= */}
        {activeTab === 'checkout' && !currentUser && (
          <div className="max-w-xl mx-auto my-12 bg-white p-8 sm:p-10 rounded-2xl border border-stone-200 shadow-sm text-center">
            <div className="w-14 h-14 rounded-2xl bg-orange-100 border border-orange-200 flex items-center justify-center text-orange-600 mx-auto mb-4">
              <Lock className="w-7 h-7" />
            </div>
            <h2 className="text-2xl font-black text-stone-900 tracking-tight">Customer Login Required</h2>
            <p className="text-sm text-stone-600 mt-2 leading-relaxed">
              In accordance with AmarDokan marketplace policy, customers must be logged in to view cart items, proceed to checkout, and complete purchases. Guest checkout is not permitted.
            </p>

            <div className="mt-6 flex flex-col sm:flex-row gap-3 justify-center">
              <button
                onClick={() => {
                  setCustomerAuthModalMode('login');
                  setShowCustomerAuthModal(true);
                }}
                className="px-6 py-3 bg-orange-600 hover:bg-orange-700 text-white font-bold text-sm rounded-xl transition-colors shadow-2xs cursor-pointer"
              >
                Log In as Customer
              </button>
              <button
                onClick={() => {
                  setCustomerAuthModalMode('register');
                  setShowCustomerAuthModal(true);
                }}
                className="px-6 py-3 bg-stone-100 hover:bg-stone-200 text-stone-800 font-bold text-sm rounded-xl transition-colors cursor-pointer"
              >
                Create New Account
              </button>
            </div>

            <div className="mt-6 pt-5 border-t border-stone-100">
              <button
                onClick={() => setActiveTab('storefront')}
                className="text-xs text-stone-500 hover:text-stone-800 font-medium cursor-pointer"
              >
                ← Return to Storefront & Browse Products
              </button>
            </div>
          </div>
        )}

        {activeTab === 'checkout' && currentUser && cart.length === 0 && (
          <div className="bg-white p-10 rounded-2xl border border-stone-200 text-center max-w-md mx-auto my-12 shadow-xs">
            <div className="w-14 h-14 rounded-2xl bg-orange-50 border border-orange-200 flex items-center justify-center text-orange-600 mx-auto mb-3">
              <ShoppingCart className="w-7 h-7" />
            </div>
            <h3 className="font-extrabold text-lg text-stone-900">Your Cart is Empty</h3>
            <p className="text-xs text-stone-500 mt-1">Explore our marketplace categories and add items to your cart.</p>
            <button
              onClick={() => setActiveTab('storefront')}
              className="mt-5 px-5 py-2.5 bg-orange-600 hover:bg-orange-700 text-white font-bold text-xs rounded-xl shadow-2xs cursor-pointer"
            >
              Start Shopping Now
            </button>
          </div>
        )}

        {activeTab === 'checkout' && currentUser && cart.length > 0 && (
          <div className="grid grid-cols-1 lg:grid-cols-12 gap-8">
            <div className="lg:col-span-7 space-y-6">
              {/* Delivery Address */}
              <div className="bg-white p-6 rounded-xl border border-stone-200 shadow-xs">
                <div className="flex items-center gap-2 mb-4 pb-3 border-b border-stone-100">
                  <MapPin className="w-5 h-5 text-orange-600" />
                  <h3 className="font-bold text-stone-900">1. Delivery Address (All 64 Districts)</h3>
                </div>

                <div className="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">
                  <div>
                    <label className="block text-xs font-semibold text-stone-600 mb-1">
                      Full Name
                    </label>
                    <input
                      type="text"
                      value={customerName}
                      onChange={(e) => setCustomerName(e.target.value)}
                      className="w-full px-3 py-2 border border-stone-300 rounded-lg focus:ring-1 focus:ring-orange-600 focus:outline-hidden text-xs"
                    />
                  </div>

                  <div>
                    <label className="block text-xs font-semibold text-stone-600 mb-1">
                      Mobile Number (01XXXXXXXXX)
                    </label>
                    <input
                      type="text"
                      value={customerPhone}
                      onChange={(e) => setCustomerPhone(e.target.value)}
                      className="w-full px-3 py-2 border border-stone-300 rounded-lg focus:ring-1 focus:ring-orange-600 focus:outline-hidden text-xs"
                    />
                  </div>

                  <div>
                    <label className="block text-xs font-semibold text-stone-600 mb-1">
                      Division (বিভাগ)
                    </label>
                    <select
                      value={selectedDivision}
                      onChange={(e) => setSelectedDivision(e.target.value)}
                      className="w-full px-3 py-2 border border-stone-300 rounded-lg focus:ring-1 focus:ring-orange-600 focus:outline-hidden text-xs"
                    >
                      {BD_DIVISIONS.map((d) => (
                        <option key={d.id} value={d.name}>
                          {d.name}
                        </option>
                      ))}
                    </select>
                  </div>

                  <div>
                    <label className="block text-xs font-semibold text-stone-600 mb-1">
                      District (জেলা)
                    </label>
                    <select
                      value={selectedDistrict}
                      onChange={(e) => setSelectedDistrict(e.target.value)}
                      className="w-full px-3 py-2 border border-stone-300 rounded-lg focus:ring-1 focus:ring-orange-600 focus:outline-hidden text-xs"
                    >
                      {BD_DIVISIONS.find((d) => d.name === selectedDivision)?.districts.map((dist) => (
                        <option key={dist} value={dist}>
                          {dist}
                        </option>
                      ))}
                    </select>
                  </div>

                  <div>
                    <label className="block text-xs font-semibold text-stone-600 mb-1">
                      Upazila / Thana (থানা)
                    </label>
                    <input
                      type="text"
                      value={upazilaThana}
                      onChange={(e) => setUpazilaThana(e.target.value)}
                      className="w-full px-3 py-2 border border-stone-300 rounded-lg focus:ring-1 focus:ring-orange-600 focus:outline-hidden text-xs"
                    />
                  </div>

                  <div>
                    <label className="block text-xs font-semibold text-stone-600 mb-1">
                      Shipping Zone
                    </label>
                    <select
                      value={shippingZone}
                      onChange={(e) => setShippingZone(e.target.value as any)}
                      className="w-full px-3 py-2 border border-stone-300 rounded-lg focus:ring-1 focus:ring-orange-600 focus:outline-hidden text-xs"
                    >
                      <option value="inside_dhaka">Inside Dhaka (৳60)</option>
                      <option value="outside_dhaka">Outside Dhaka (৳120)</option>
                    </select>
                  </div>

                  <div className="sm:col-span-2">
                    <label className="block text-xs font-semibold text-stone-600 mb-1">
                      Street Address (House, Road, Area, Landmark)
                    </label>
                    <input
                      type="text"
                      value={areaDetail}
                      onChange={(e) => setAreaDetail(e.target.value)}
                      className="w-full px-3 py-2 border border-stone-300 rounded-lg focus:ring-1 focus:ring-orange-600 focus:outline-hidden text-xs"
                    />
                  </div>
                </div>
              </div>

              {/* Payment Method Selector */}
              <div className="bg-white p-6 rounded-xl border border-stone-200 shadow-xs">
                <div className="flex items-center gap-2 mb-4 pb-3 border-b border-stone-100">
                  <CreditCard className="w-5 h-5 text-orange-600" />
                  <h3 className="font-bold text-stone-900">2. Select Payment Method</h3>
                </div>

                <div className="space-y-3">
                  {/* Cash on Delivery */}
                  <label
                    className={`flex items-start gap-3 p-3.5 rounded-xl border cursor-pointer transition-all ${
                      paymentMethod === 'cod'
                        ? 'border-orange-600 bg-orange-50/50'
                        : 'border-stone-200 hover:border-stone-300'
                    }`}
                  >
                    <input
                      type="radio"
                      name="paymentMethod"
                      checked={paymentMethod === 'cod'}
                      onChange={() => setPaymentMethod('cod')}
                      className="mt-1 text-orange-600 focus:ring-orange-500"
                    />
                    <div className="flex-1">
                      <div className="flex items-center justify-between">
                        <span className="font-bold text-sm text-stone-900">Cash on Delivery (COD)</span>
                        <span className="text-xs text-stone-500">Pay upon delivery</span>
                      </div>
                      <p className="text-xs text-stone-600 mt-0.5">
                        Order confirmed immediately. Available across all 64 districts in Bangladesh.
                      </p>
                    </div>
                  </label>

                  {/* bKash */}
                  <label
                    className={`flex items-start gap-3 p-3.5 rounded-xl border cursor-pointer transition-all ${
                      paymentMethod === 'bkash'
                        ? 'border-orange-600 bg-orange-50/50'
                        : 'border-stone-200 hover:border-stone-300'
                    }`}
                  >
                    <input
                      type="radio"
                      name="paymentMethod"
                      checked={paymentMethod === 'bkash'}
                      onChange={() => setPaymentMethod('bkash')}
                      className="mt-1 text-orange-600 focus:ring-orange-500"
                    />
                    <div className="flex-1">
                      <div className="flex items-center justify-between">
                        <div className="flex items-center gap-2">
                          <span className="font-bold text-sm text-stone-900">bKash Send Money</span>
                          <span className="bg-orange-100 text-orange-800 text-[10px] font-bold px-2 py-0.5 rounded">
                            Verification Popup
                          </span>
                        </div>
                        <span className="text-xs font-mono font-bold text-orange-700">01819000000</span>
                      </div>
                      <p className="text-xs text-stone-600 mt-0.5">
                        Send Money to our merchant number. Transaction ID & Screenshot required.
                      </p>
                    </div>
                  </label>

                  {/* Nagad */}
                  <label
                    className={`flex items-start gap-3 p-3.5 rounded-xl border cursor-pointer transition-all ${
                      paymentMethod === 'nagad'
                        ? 'border-orange-600 bg-orange-50/50'
                        : 'border-stone-200 hover:border-stone-300'
                    }`}
                  >
                    <input
                      type="radio"
                      name="paymentMethod"
                      checked={paymentMethod === 'nagad'}
                      onChange={() => setPaymentMethod('nagad')}
                      className="mt-1 text-orange-600 focus:ring-orange-500"
                    />
                    <div className="flex-1">
                      <div className="flex items-center justify-between">
                        <div className="flex items-center gap-2">
                          <span className="font-bold text-sm text-stone-900">Nagad Send Money</span>
                          <span className="bg-orange-100 text-orange-800 text-[10px] font-bold px-2 py-0.5 rounded">
                            Verification Popup
                          </span>
                        </div>
                        <span className="text-xs font-mono font-bold text-orange-700">01712000000</span>
                      </div>
                      <p className="text-xs text-stone-600 mt-0.5">
                        Send Money to Nagad merchant number. Transaction ID & Screenshot required.
                      </p>
                    </div>
                  </label>
                </div>
              </div>
            </div>

            {/* Right Summary */}
            <div className="lg:col-span-5 space-y-6">
              <div className="bg-white p-6 rounded-xl border border-stone-200 shadow-xs">
                <div className="flex items-center justify-between mb-4 pb-3 border-b border-stone-100">
                  <h3 className="font-bold text-stone-900">Order Summary</h3>
                  <span className="text-xs text-stone-500">{cart.length} item(s)</span>
                </div>

                {cart.length === 0 ? (
                  <div className="text-center py-8 text-stone-400 text-sm">
                    Your cart is empty. Add grocery or tech items from the storefront.
                  </div>
                ) : (
                  <div className="space-y-4">
                    {cart.map((item) => (
                      <div key={item.product.id} className="flex items-center justify-between gap-3 text-sm">
                        <div className="flex-1">
                          <h5 className="font-medium text-stone-800 line-clamp-1">{item.product.name}</h5>
                          <div className="flex items-center gap-2 text-xs text-stone-500 mt-0.5">
                            <span className="text-orange-700 font-bold">{item.product.vendorName}</span>
                            <span>•</span>
                            <span>৳{item.product.salePrice}</span>
                          </div>
                        </div>

                        <div className="flex items-center gap-2">
                          <div className="flex items-center border border-stone-200 rounded">
                            <button
                              onClick={() => updateQuantity(item.product.id, -1)}
                              className="px-2 py-0.5 text-stone-600 hover:bg-stone-100 text-xs font-bold"
                            >
                              -
                            </button>
                            <span className="px-2 text-xs font-semibold">{item.quantity}</span>
                            <button
                              onClick={() => updateQuantity(item.product.id, 1)}
                              className="px-2 py-0.5 text-stone-600 hover:bg-stone-100 text-xs font-bold"
                            >
                              +
                            </button>
                          </div>
                          <span className="font-bold text-stone-900 w-16 text-right">
                            ৳{item.product.salePrice * item.quantity}
                          </span>
                        </div>
                      </div>
                    ))}

                    <div className="pt-4 border-t border-stone-100 space-y-2 text-sm">
                      <div className="flex justify-between text-stone-600">
                        <span>Items Subtotal</span>
                        <span>৳{subtotal}</span>
                      </div>
                      <div className="flex justify-between text-stone-600">
                        <span>Shipping ({shippingZone === 'inside_dhaka' ? 'Inside Dhaka' : 'Outside Dhaka'})</span>
                        <span>৳{shippingCost}</span>
                      </div>
                      <div className="pt-2 border-t border-stone-200 flex justify-between font-extrabold text-base text-stone-900">
                        <span>Grand Total</span>
                        <span className="text-orange-600">৳{grandTotal}</span>
                      </div>
                    </div>

                    <button
                      onClick={handleOpenPayment}
                      className="w-full mt-4 bg-orange-600 hover:bg-orange-700 text-white font-bold py-3 px-4 rounded-xl shadow-xs transition-colors flex items-center justify-center gap-2"
                    >
                      {paymentMethod === 'cod' ? (
                        <>Place Order (Cash on Delivery)</>
                      ) : (
                        <>Proceed to {paymentMethod === 'bkash' ? 'bKash' : 'Nagad'} Modal</>
                      )}
                      <ArrowRight className="w-4 h-4" />
                    </button>
                  </div>
                )}
              </div>
            </div>
          </div>
        )}

        {/* ================= ADMIN VERIFICATION PORTAL ================= */}
        {activeTab === 'admin' && !isAdminAuthenticated && (
          <AdminAuthScreen
            onSuccess={() => setIsAdminAuthenticated(true)}
            onBackToStore={() => setActiveTab('storefront')}
          />
        )}

        {activeTab === 'admin' && isAdminAuthenticated && (
          <div className="space-y-6">
            <div className="bg-stone-900 text-white rounded-xl p-5 flex items-start justify-between">
              <div>
                <h3 className="font-bold text-base flex items-center gap-2">
                  <ShieldCheck className="w-5 h-5 text-orange-500" />
                  Admin Payment Verification Portal (/admin/payments/pending)
                </h3>
                <p className="text-xs text-stone-300 mt-1 max-w-3xl">
                  Inspect submitted bKash and Nagad payment proofs. Private screenshot stored on secured disk. Verifying transitions order to Confirmed and credits vendor commission balances.
                </p>
              </div>
              <div className="flex items-center gap-3">
                <span className="bg-orange-600 text-white text-xs font-bold px-3 py-1 rounded-full">
                  {orders.filter((o) => o.paymentStatus === 'pending_verification').length} Pending Review
                </span>
                <button
                  onClick={() => {
                    setIsAdminAuthenticated(false);
                    setActiveTab('storefront');
                  }}
                  className="bg-stone-800 hover:bg-stone-700 text-stone-300 hover:text-white text-xs font-semibold px-3 py-1 rounded-lg transition-colors cursor-pointer"
                >
                  Exit Portal
                </button>
              </div>
            </div>

            <div className="bg-white rounded-xl border border-stone-200 overflow-hidden shadow-xs">
              <div className="px-6 py-4 border-b border-stone-100 flex items-center justify-between">
                <h4 className="font-bold text-stone-900">All Marketplace Orders & Payment Proofs</h4>
                <span className="text-xs text-stone-500">Live Database Ledger</span>
              </div>

              <div className="overflow-x-auto">
                <table className="w-full text-left text-xs text-stone-700">
                  <thead className="bg-stone-50 text-stone-600 font-semibold border-b border-stone-200 uppercase tracking-wider">
                    <tr>
                      <th className="py-3 px-4">Order ID</th>
                      <th className="py-3 px-4">Customer</th>
                      <th className="py-3 px-4">Method & Total</th>
                      <th className="py-3 px-4">TrxID & Phone</th>
                      <th className="py-3 px-4">Screenshot Proof</th>
                      <th className="py-3 px-4">Payment Status</th>
                      <th className="py-3 px-4">Order Status</th>
                      <th className="py-3 px-4 text-right">Actions</th>
                    </tr>
                  </thead>
                  <tbody className="divide-y divide-stone-100">
                    {orders.map((o) => (
                      <tr key={o.orderNumber} className="hover:bg-stone-50/70">
                        <td className="py-3.5 px-4 font-mono font-bold text-stone-900">
                          #{o.orderNumber}
                        </td>
                        <td className="py-3.5 px-4">
                          <div className="font-bold text-stone-900">{o.customerName}</div>
                          <div className="text-[11px] text-stone-500">{o.customerPhone}</div>
                        </td>
                        <td className="py-3.5 px-4">
                          <span
                            className={`font-bold uppercase px-2 py-0.5 rounded text-[10px] ${
                              o.paymentMethod === 'bkash'
                                ? 'bg-orange-100 text-orange-900'
                                : o.paymentMethod === 'nagad'
                                ? 'bg-amber-100 text-amber-900'
                                : 'bg-stone-200 text-stone-800'
                            }`}
                          >
                            {o.paymentMethod}
                          </span>
                          <div className="font-extrabold text-stone-900 text-sm mt-0.5">৳{o.grandTotal}</div>
                        </td>
                        <td className="py-3.5 px-4">
                          {o.transactionId ? (
                            <div>
                              <span className="font-mono font-bold text-stone-900 bg-stone-100 px-1.5 py-0.5 rounded">
                                {o.transactionId}
                              </span>
                              <div className="text-[11px] text-stone-500 mt-0.5">From: {o.paymentPhone}</div>
                            </div>
                          ) : (
                            <span className="text-stone-400 italic">COD (No TrxID)</span>
                          )}
                        </td>
                        <td className="py-3.5 px-4">
                          {o.screenshotUrl ? (
                            <div className="flex items-center gap-2">
                              <img
                                src={o.screenshotUrl}
                                alt="Proof"
                                className="w-9 h-9 object-cover rounded border border-stone-300 shadow-2xs"
                                referrerPolicy="no-referrer"
                              />
                              <span className="text-[10px] text-emerald-700 font-bold">Private Storage</span>
                            </div>
                          ) : (
                            <span className="text-stone-400">-</span>
                          )}
                        </td>
                        <td className="py-3.5 px-4">
                          <span
                            className={`inline-block px-2 py-0.5 rounded-full text-[10px] font-bold ${
                              o.paymentStatus === 'paid'
                                ? 'bg-emerald-100 text-emerald-800'
                                : o.paymentStatus === 'pending_verification'
                                ? 'bg-amber-100 text-amber-900 border border-amber-300'
                                : o.paymentStatus === 'rejected'
                                ? 'bg-red-100 text-red-800'
                                : 'bg-stone-100 text-stone-700'
                            }`}
                          >
                            {o.paymentStatus.replace('_', ' ').toUpperCase()}
                          </span>
                        </td>
                        <td className="py-3.5 px-4">
                          <span
                            className={`inline-block px-2 py-0.5 rounded text-[10px] font-semibold ${
                              o.orderStatus === 'confirmed'
                                ? 'bg-emerald-50 text-emerald-700 border border-emerald-200'
                                : o.orderStatus === 'payment_verification'
                                ? 'bg-amber-50 text-amber-700'
                                : o.orderStatus === 'cancelled'
                                ? 'bg-red-50 text-red-700'
                                : 'bg-stone-100 text-stone-600'
                            }`}
                          >
                            {o.orderStatus.replace('_', ' ')}
                          </span>
                        </td>
                        <td className="py-3.5 px-4 text-right space-x-1.5">
                          {o.paymentStatus === 'pending_verification' && (
                            <>
                              <button
                                onClick={() => handleAdminVerifyPayment(o.orderNumber)}
                                className="bg-emerald-600 hover:bg-emerald-700 text-white px-2.5 py-1 rounded text-xs font-bold shadow-2xs"
                              >
                                Verify Payment
                              </button>
                              <button
                                onClick={() => {
                                  setRejectingOrderNumber(o.orderNumber);
                                  setRejectionReasonInput('Transaction ID not found in mobile banking statement.');
                                }}
                                className="bg-red-600 hover:bg-red-700 text-white px-2.5 py-1 rounded text-xs font-bold shadow-2xs"
                              >
                                Reject
                              </button>
                            </>
                          )}
                          {o.paymentStatus === 'paid' && (
                            <span className="text-emerald-700 font-bold text-xs flex items-center justify-end gap-1">
                              <CheckCircle2 className="w-3.5 h-3.5" />
                              Settled
                            </span>
                          )}
                          {o.paymentStatus === 'rejected' && (
                            <span className="text-red-600 text-xs italic">
                              Rejected: {o.rejectionReason}
                            </span>
                          )}
                        </td>
                      </tr>
                    ))}
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        )}

        {/* ================= VENDOR PORTAL TAB ================= */}
        {activeTab === 'vendor' && (
          <div className="space-y-6">
            <div className="bg-stone-900 text-white p-6 rounded-xl flex flex-wrap items-center justify-between gap-4">
              <div>
                <span className="text-xs bg-orange-600 text-white px-2 py-0.5 rounded font-bold uppercase">
                  Vendor Dashboard: Shwapno Daily Mart
                </span>
                <h3 className="text-xl font-bold mt-1">Multi-Vendor Commission & Settlement</h3>
                <p className="text-xs text-stone-400 mt-1">
                  Server-side Laravel Policy prevents cross-vendor viewing. Commission is calculated item-by-item upon order confirmation.
                </p>
              </div>
              <div className="text-right">
                <div className="text-xs text-stone-400">Grocery Commission Rate</div>
                <div className="text-2xl font-black text-orange-400">5.0%</div>
              </div>
            </div>

            <div className="grid grid-cols-1 md:grid-cols-3 gap-6">
              <div className="bg-white p-5 rounded-xl border border-stone-200 shadow-2xs">
                <div className="text-xs text-stone-500 font-medium">Available Payout Balance</div>
                <div className="text-2xl font-extrabold text-stone-900 mt-1">৳14,850.00</div>
                <div className="text-[11px] text-emerald-700 font-medium mt-1">Verified & Ready for Withdrawal</div>
              </div>

              <div className="bg-white p-5 rounded-xl border border-stone-200 shadow-2xs">
                <div className="text-xs text-stone-500 font-medium">Fulfilled Orders</div>
                <div className="text-2xl font-extrabold text-stone-900 mt-1">42 Orders</div>
                <div className="text-[11px] text-stone-500 mt-1">Rice, Soybean Oil, Spices</div>
              </div>

              <div className="bg-white p-5 rounded-xl border border-stone-200 shadow-2xs">
                <div className="text-xs text-stone-500 font-medium">Withdrawal Channels</div>
                <div className="text-sm font-semibold text-stone-800 mt-2 flex items-center gap-2">
                  <span className="bg-orange-100 text-orange-800 px-2 py-0.5 rounded text-xs font-bold">bKash</span>
                  <span className="bg-amber-100 text-amber-800 px-2 py-0.5 rounded text-xs font-bold">Nagad</span>
                  <span className="bg-blue-100 text-blue-800 px-2 py-0.5 rounded text-xs font-bold">DBBL</span>
                </div>
                <div className="text-[11px] text-stone-500 mt-2">Gulshan Branch, Account #12015...</div>
              </div>
            </div>

            {/* Split Checkout Financial Breakdown */}
            <div className="bg-white rounded-xl border border-stone-200 p-6 shadow-2xs">
              <h4 className="font-bold text-stone-900 mb-3 text-sm">
                Split Checkout Financial Breakdown (Multi-Vendor Basket)
              </h4>
              <p className="text-xs text-stone-600 mb-4 leading-relaxed">
                When a customer purchases Teer Oil (Shwapno Mart, ৳890) and Vision Blender (Bengal Home, ৳3,450) together, the customer pays ONE grand total. The Laravel transaction engine splits records:
              </p>

              <div className="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs font-mono">
                <div className="p-4 bg-orange-50/60 border border-orange-200 rounded-xl">
                  <div className="font-bold text-orange-900 mb-2">Shwapno Daily Mart (5% Commission)</div>
                  <div>Product: Teer Soybean Oil (5L)</div>
                  <div>Subtotal: ৳890.00</div>
                  <div>Platform Cut (5%): -৳44.50</div>
                  <div className="font-bold text-emerald-700 mt-1.5 pt-1.5 border-t border-orange-200">
                    Net Vendor Earning: ৳845.50
                  </div>
                </div>

                <div className="p-4 bg-stone-50 border border-stone-200 rounded-xl">
                  <div className="font-bold text-stone-900 mb-2">Bengal Home & Appliances (8% Commission)</div>
                  <div>Product: Vision Classic 750W Blender</div>
                  <div>Subtotal: ৳3,450.00</div>
                  <div>Platform Cut (8%): -৳276.00</div>
                  <div className="font-bold text-emerald-700 mt-1.5 pt-1.5 border-t border-stone-200">
                    Net Vendor Earning: ৳3,174.00
                  </div>
                </div>
              </div>
            </div>
          </div>
        )}

        {/* ================= LARAVEL 13 ARCHITECTURE EXPLORER ================= */}
        {activeTab === 'laravel_code' && (
          <div className="space-y-6">
            <div className="bg-stone-900 text-stone-100 p-6 rounded-xl">
              <div className="flex items-center gap-2 text-orange-400 text-xs font-mono mb-2">
                <Sparkles className="w-4 h-4" />
                LARAVEL 13 MULTIVENDOR BACKEND READY
              </div>
              <h3 className="text-lg font-bold">Backend Implementation Status</h3>
              <p className="text-xs text-stone-300 mt-1">
                Laravel routes, migrations, seeders, and Blade templates have been restructured for a full General Marketplace.
              </p>
            </div>

            <div className="grid grid-cols-1 md:grid-cols-2 gap-4 text-xs">
              <div className="bg-white p-5 rounded-xl border border-stone-200">
                <h4 className="font-bold text-stone-900 mb-3 flex items-center gap-2">
                  <Layers className="w-4 h-4 text-orange-600" />
                  General Marketplace Seeders & Controllers
                </h4>
                <ul className="space-y-2 font-mono text-[11px] text-stone-700">
                  <li className="p-2 bg-stone-50 rounded border border-stone-100">
                    app/Http/Controllers/HomeController.php (14 Categories & Products)
                  </li>
                  <li className="p-2 bg-stone-50 rounded border border-stone-100">
                    database/seeders/MarketplaceCategoryProductSeeder.php
                  </li>
                  <li className="p-2 bg-stone-50 rounded border border-stone-100">
                    resources/views/layouts/app.blade.php (Marketplace Orange Accent)
                  </li>
                  <li className="p-2 bg-stone-50 rounded border border-stone-100">
                    resources/views/components/header.blade.php (Desktop & Mobile)
                  </li>
                  <li className="p-2 bg-stone-50 rounded border border-stone-100">
                    resources/views/home.blade.php (Hero & 14 Category Grid)
                  </li>
                </ul>
              </div>

              <div className="bg-white p-5 rounded-xl border border-stone-200">
                <h4 className="font-bold text-stone-900 mb-3 flex items-center gap-2">
                  <ShieldCheck className="w-4 h-4 text-orange-600" />
                  Preserved Business Logic & Tests
                </h4>
                <ul className="space-y-2 font-mono text-[11px] text-stone-700">
                  <li className="p-2 bg-stone-50 rounded border border-stone-100">
                    app/Services/OrderProcessingService.php (COD + Manual bKash/Nagad)
                  </li>
                  <li className="p-2 bg-stone-50 rounded border border-stone-100">
                    tests/Feature/BangladeshPaymentCheckoutTest.php (12 tests)
                  </li>
                  <li className="p-2 bg-stone-50 rounded border border-stone-100">
                    app/Policies/VendorPolicy.php & OrderPolicy.php
                  </li>
                  <li className="p-2 bg-stone-50 rounded border border-stone-100">
                    app/Http/Requests/PaymentProofRequest.php (Anti-duplicate TrxID)
                  </li>
                </ul>
              </div>
            </div>
          </div>
        )}
      </main>

      {/* ================= MANDATORY bKASH / NAGAD PAYMENT MODAL ================= */}
      {showPaymentModal && (
        <div className="fixed inset-0 z-50 bg-stone-900/60 backdrop-blur-xs flex items-center justify-center p-4 overflow-y-auto">
          <div className="bg-white rounded-2xl max-w-md w-full shadow-2xl border border-stone-200 overflow-hidden my-8">
            <div className="p-5 text-white bg-orange-600 flex items-center justify-between">
              <div className="flex items-center gap-2.5">
                <Smartphone className="w-5 h-5 text-white" />
                <div>
                  <h3 className="font-bold text-base">
                    {modalType === 'bkash' ? 'bKash Send Money' : 'Nagad Send Money'}
                  </h3>
                  <p className="text-[11px] text-white/80">Manual Payment Verification</p>
                </div>
              </div>
              <button
                onClick={handleCancelModal}
                className="text-white/80 hover:text-white p-1 rounded-md"
              >
                <X className="w-5 h-5" />
              </button>
            </div>

            <form onSubmit={handleSubmitManualPayment} className="p-6 space-y-4 text-sm">
              <div className="p-3.5 rounded-xl border border-orange-200 bg-orange-50/70 text-stone-900 text-xs leading-relaxed space-y-1">
                <div className="flex items-center justify-between font-bold text-xs pb-1 border-b border-orange-200">
                  <span>Merchant Number:</span>
                  <span className="font-mono text-sm text-orange-900">
                    {modalType === 'bkash' ? '01819000000' : '01712000000'}
                  </span>
                </div>
                <div className="flex justify-between font-semibold pt-1">
                  <span>Exact Payable:</span>
                  <span className="text-orange-700 font-extrabold text-sm">৳{grandTotal}</span>
                </div>
              </div>

              <div className="text-[11px] text-stone-600 bg-stone-50 p-2.5 rounded-lg space-y-0.5">
                <p>1. Open your {modalType === 'bkash' ? 'bKash' : 'Nagad'} app.</p>
                <p>2. Tap <strong>Send Money</strong> to the number above.</p>
                <p>3. Copy the <strong>Transaction ID (TrxID)</strong>.</p>
                <p>4. Enter your phone number, TrxID, and upload screenshot below.</p>
              </div>

              {modalError && (
                <div className="p-3 bg-red-50 border border-red-200 text-red-700 text-xs rounded-lg flex items-center gap-2">
                  <AlertCircle className="w-4 h-4 shrink-0" />
                  <span>{modalError}</span>
                </div>
              )}

              <div>
                <label className="block text-xs font-bold text-stone-700 mb-1">
                  Your Mobile Number *
                </label>
                <input
                  type="text"
                  placeholder="017XXXXXXXX"
                  value={paymentPhone}
                  onChange={(e) => setPaymentPhone(e.target.value)}
                  className="w-full px-3 py-2 border border-stone-300 rounded-lg text-xs font-mono focus:ring-1 focus:ring-orange-600 focus:outline-hidden"
                  required
                />
              </div>

              <div>
                <label className="block text-xs font-bold text-stone-700 mb-1">
                  Transaction ID (TrxID) *
                </label>
                <input
                  type="text"
                  placeholder="e.g. BKH99281745"
                  value={transactionId}
                  onChange={(e) => setTransactionId(e.target.value)}
                  className="w-full px-3 py-2 border border-stone-300 rounded-lg text-xs font-mono uppercase focus:ring-1 focus:ring-orange-600 focus:outline-hidden"
                  required
                />
                <span className="text-[10px] text-stone-400">
                  Anti-duplicate check is enforced on database transaction ID.
                </span>
              </div>

              <div>
                <label className="block text-xs font-bold text-stone-700 mb-1">
                  Payment Screenshot Proof *
                </label>
                <div
                  onClick={() => setScreenshotUploaded(!screenshotUploaded)}
                  className={`border-2 border-dashed rounded-xl p-4 text-center cursor-pointer transition-colors ${
                    screenshotUploaded
                      ? 'border-emerald-500 bg-emerald-50/50 text-emerald-800'
                      : 'border-stone-300 hover:border-stone-400 bg-stone-50 text-stone-600'
                  }`}
                >
                  <Upload className="w-5 h-5 mx-auto mb-1 text-stone-400" />
                  {screenshotUploaded ? (
                    <span className="text-xs font-bold flex items-center justify-center gap-1">
                      <Check className="w-3.5 h-3.5 text-emerald-600" />
                      screenshot_proof_confirmed.png (Simulated Uploaded)
                    </span>
                  ) : (
                    <div>
                      <span className="text-xs font-semibold">Click to attach payment screenshot</span>
                      <div className="text-[10px] text-stone-400">JPG, PNG up to 4MB (Stored in Private Storage)</div>
                    </div>
                  )}
                </div>
              </div>

              <div className="pt-2 flex items-center gap-3">
                <button
                  type="button"
                  onClick={handleCancelModal}
                  className="flex-1 px-4 py-2.5 rounded-xl border border-stone-300 text-stone-700 hover:bg-stone-100 font-semibold text-xs transition-colors"
                >
                  Cancel Payment
                </button>
                <button
                  type="submit"
                  className="flex-1 px-4 py-2.5 rounded-xl text-white font-bold text-xs bg-orange-600 hover:bg-orange-700 shadow-xs transition-colors"
                >
                  Submit Payment
                </button>
              </div>

              <div className="text-[10px] text-stone-400 text-center">
                Cancelling will close the modal without creating an order. Your cart remains saved.
              </div>
            </form>
          </div>
        </div>
      )}

      {/* Reject Payment Confirmation Modal */}
      {rejectingOrderNumber && (
        <div className="fixed inset-0 z-50 bg-stone-900/60 backdrop-blur-xs flex items-center justify-center p-4">
          <div className="bg-white rounded-xl max-w-sm w-full p-6 shadow-xl border border-stone-200 space-y-4">
            <h4 className="font-bold text-stone-900 text-sm">
              Reject Payment for #{rejectingOrderNumber}
            </h4>
            <p className="text-xs text-stone-600">
              Please enter the reason for rejection (this will be recorded in customer records and inventory will be restored):
            </p>
            <input
              type="text"
              value={rejectionReasonInput}
              onChange={(e) => setRejectionReasonInput(e.target.value)}
              placeholder="e.g. Transaction ID not found in bKash statement"
              className="w-full px-3 py-2 border border-stone-300 rounded-lg text-xs"
            />
            <div className="flex gap-2 justify-end pt-2">
              <button
                onClick={() => setRejectingOrderNumber(null)}
                className="px-3 py-1.5 border rounded-lg text-xs font-semibold text-stone-600"
              >
                Cancel
              </button>
              <button
                onClick={() => handleAdminRejectPayment(rejectingOrderNumber, rejectionReasonInput)}
                className="px-3 py-1.5 bg-red-600 hover:bg-red-700 text-white rounded-lg text-xs font-semibold"
              >
                Confirm Rejection
              </button>
            </div>
          </div>
        </div>
      )}

      {/* Customer Authentication Modal (Guest Interception & Account Creation) */}
      <CustomerAuthModal
        isOpen={showCustomerAuthModal}
        onClose={() => {
          setShowCustomerAuthModal(false);
          setPendingProductForCart(null);
        }}
        onSuccess={handleAuthSuccess}
        initialMode={customerAuthModalMode}
        pendingProductName={pendingProductForCart?.name}
      />

      {/* Footer */}
      <MarketplaceFooter
        onCategoryClick={(slug) => {
          setSelectedCategoryFilter(slug);
          setActiveTab('storefront');
          window.scrollTo({ top: 0, behavior: 'smooth' });
        }}
        onNavigateSection={(sectionId) => {
          setActiveTab('storefront');
          setTimeout(() => {
            const el = document.getElementById(sectionId);
            if (el) {
              el.scrollIntoView({ behavior: 'smooth' });
            }
          }, 50);
        }}
        onOpenVendorTab={() => {
          setActiveTab('vendor');
          window.scrollTo({ top: 0, behavior: 'smooth' });
        }}
      />
    </div>
  );
}
