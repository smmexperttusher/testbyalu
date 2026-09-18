import React, { useState } from 'react';
import {
  ShieldCheck,
  Phone,
  Mail,
  MapPin,
  Clock,
  ExternalLink,
  HelpCircle,
  FileText,
  Truck,
  RotateCcw,
  CheckCircle,
  X,
  Facebook,
  Youtube,
  Instagram,
  Linkedin,
} from 'lucide-react';

interface MarketplaceFooterProps {
  onCategoryClick?: (categorySlug: string) => void;
  onNavigateSection?: (sectionId: string) => void;
  onOpenVendorTab?: () => void;
}

export const MarketplaceFooter: React.FC<MarketplaceFooterProps> = ({
  onCategoryClick,
  onNavigateSection,
  onOpenVendorTab,
}) => {
  const [activePolicyModal, setActivePolicyModal] = useState<
    'terms' | 'privacy' | 'refund' | 'shipping' | 'faq' | 'contact' | null
  >(null);

  const socialLinks = [
    { name: 'Facebook', icon: Facebook, url: 'https://facebook.com', handle: '@AmarDokanBD' },
    { name: 'YouTube', icon: Youtube, url: 'https://youtube.com', handle: 'AmarDokan Marketplace' },
    { name: 'Instagram', icon: Instagram, url: 'https://instagram.com', handle: '@amardokan_bd' },
    { name: 'LinkedIn', icon: Linkedin, url: 'https://linkedin.com', handle: 'AmarDokan Bangladesh' },
  ];

  return (
    <>
      <footer className="bg-stone-950 text-stone-300 text-xs border-t border-stone-800 mt-12">
        {/* Top Feature Highlights Bar */}
        <div className="border-b border-stone-800/80 bg-stone-900/60 py-6">
          <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div className="grid grid-cols-2 md:grid-cols-4 gap-4 sm:gap-6 text-center sm:text-left">
              <div className="flex items-center gap-3 justify-center sm:justify-start">
                <div className="w-10 h-10 rounded-xl bg-orange-600/20 text-orange-400 border border-orange-500/30 flex items-center justify-center shrink-0">
                  <Truck className="w-5 h-5" />
                </div>
                <div>
                  <div className="font-bold text-white text-xs sm:text-sm">Nationwide Delivery</div>
                  <div className="text-[11px] text-stone-400">All 64 districts in Bangladesh</div>
                </div>
              </div>

              <div className="flex items-center gap-3 justify-center sm:justify-start">
                <div className="w-10 h-10 rounded-xl bg-emerald-600/20 text-emerald-400 border border-emerald-500/30 flex items-center justify-center shrink-0">
                  <ShieldCheck className="w-5 h-5" />
                </div>
                <div>
                  <div className="font-bold text-white text-xs sm:text-sm">100% Genuine Stores</div>
                  <div className="text-[11px] text-stone-400">Verified trade licenses</div>
                </div>
              </div>

              <div className="flex items-center gap-3 justify-center sm:justify-start">
                <div className="w-10 h-10 rounded-xl bg-blue-600/20 text-blue-400 border border-blue-500/30 flex items-center justify-center shrink-0">
                  <RotateCcw className="w-5 h-5" />
                </div>
                <div>
                  <div className="font-bold text-white text-xs sm:text-sm">7-Day Easy Returns</div>
                  <div className="text-[11px] text-stone-400">Hassle-free replacement policy</div>
                </div>
              </div>

              <div className="flex items-center gap-3 justify-center sm:justify-start">
                <div className="w-10 h-10 rounded-xl bg-amber-600/20 text-amber-400 border border-amber-500/30 flex items-center justify-center shrink-0">
                  <Phone className="w-5 h-5" />
                </div>
                <div>
                  <div className="font-bold text-white text-xs sm:text-sm">Direct Customer Support</div>
                  <div className="text-[11px] text-stone-400">09612-000000 (9 AM - 10 PM)</div>
                </div>
              </div>
            </div>
          </div>
        </div>

        {/* Main 7 Sections Grid */}
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 sm:py-14">
          <div className="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-7 gap-6 sm:gap-8">
            {/* 1. Customer Service */}
            <div className="space-y-3">
              <h4 className="font-black text-white text-xs sm:text-sm uppercase tracking-wider text-orange-500">
                Customer Service
              </h4>
              <ul className="space-y-2 text-[11px] sm:text-xs">
                <li>
                  <button
                    onClick={() => setActivePolicyModal('faq')}
                    className="hover:text-orange-400 transition-colors text-left"
                  >
                    Help Center & FAQ
                  </button>
                </li>
                <li>
                  <button
                    onClick={() => setActivePolicyModal('shipping')}
                    className="hover:text-orange-400 transition-colors text-left"
                  >
                    Order Tracking
                  </button>
                </li>
                <li>
                  <button
                    onClick={() => setActivePolicyModal('refund')}
                    className="hover:text-orange-400 transition-colors text-left"
                  >
                    Returns & Refunds
                  </button>
                </li>
                <li>
                  <button
                    onClick={() => setActivePolicyModal('shipping')}
                    className="hover:text-orange-400 transition-colors text-left"
                  >
                    Shipping Rates (৳60 / ৳120)
                  </button>
                </li>
                <li>
                  <button
                    onClick={() => setActivePolicyModal('contact')}
                    className="hover:text-orange-400 transition-colors text-left"
                  >
                    File a Complaint
                  </button>
                </li>
              </ul>
            </div>

            {/* 2. Shop */}
            <div className="space-y-3">
              <h4 className="font-black text-white text-xs sm:text-sm uppercase tracking-wider text-orange-500">
                Shop
              </h4>
              <ul className="space-y-2 text-[11px] sm:text-xs">
                <li>
                  <button
                    onClick={() => onNavigateSection && onNavigateSection('flash-deals')}
                    className="hover:text-orange-400 transition-colors text-left"
                  >
                    Flash Deals
                  </button>
                </li>
                <li>
                  <button
                    onClick={() => onNavigateSection && onNavigateSection('best-sellers')}
                    className="hover:text-orange-400 transition-colors text-left"
                  >
                    Best Sellers
                  </button>
                </li>
                <li>
                  <button
                    onClick={() => onNavigateSection && onNavigateSection('new-arrivals')}
                    className="hover:text-orange-400 transition-colors text-left"
                  >
                    New Arrivals
                  </button>
                </li>
                <li>
                  <button
                    onClick={() => onNavigateSection && onNavigateSection('featured-products')}
                    className="hover:text-orange-400 transition-colors text-left"
                  >
                    Featured Selections
                  </button>
                </li>
                <li>
                  <button
                    onClick={() => onNavigateSection && onNavigateSection('popular-stores')}
                    className="hover:text-orange-400 transition-colors text-left"
                  >
                    Popular Stores
                  </button>
                </li>
              </ul>
            </div>

            {/* 3. Categories */}
            <div className="space-y-3">
              <h4 className="font-black text-white text-xs sm:text-sm uppercase tracking-wider text-orange-500">
                Categories
              </h4>
              <ul className="space-y-2 text-[11px] sm:text-xs">
                <li>
                  <button
                    onClick={() => onCategoryClick && onCategoryClick('grocery')}
                    className="hover:text-orange-400 transition-colors text-left"
                  >
                    Grocery & Rice
                  </button>
                </li>
                <li>
                  <button
                    onClick={() => onCategoryClick && onCategoryClick('electronics')}
                    className="hover:text-orange-400 transition-colors text-left"
                  >
                    Electronics & Tech
                  </button>
                </li>
                <li>
                  <button
                    onClick={() => onCategoryClick && onCategoryClick('fashion')}
                    className="hover:text-orange-400 transition-colors text-left"
                  >
                    Fashion & Apparel
                  </button>
                </li>
                <li>
                  <button
                    onClick={() => onCategoryClick && onCategoryClick('home-living')}
                    className="hover:text-orange-400 transition-colors text-left"
                  >
                    Home & Living
                  </button>
                </li>
                <li>
                  <button
                    onClick={() => onCategoryClick && onCategoryClick('beauty-personal-care')}
                    className="hover:text-orange-400 transition-colors text-left"
                  >
                    Beauty & Personal Care
                  </button>
                </li>
                <li>
                  <button
                    onClick={() => onCategoryClick && onCategoryClick('mobile-accessories')}
                    className="hover:text-orange-400 transition-colors text-left"
                  >
                    Mobile & Accessories
                  </button>
                </li>
              </ul>
            </div>

            {/* 4. Sell on Marketplace */}
            <div className="space-y-3">
              <h4 className="font-black text-white text-xs sm:text-sm uppercase tracking-wider text-orange-500">
                Sell on Marketplace
              </h4>
              <ul className="space-y-2 text-[11px] sm:text-xs">
                <li>
                  <button
                    onClick={onOpenVendorTab}
                    className="text-orange-400 hover:text-orange-300 font-bold transition-colors text-left"
                  >
                    Merchant Registration
                  </button>
                </li>
                <li>
                  <button
                    onClick={onOpenVendorTab}
                    className="hover:text-orange-400 transition-colors text-left"
                  >
                    Seller Center Portal
                  </button>
                </li>
                <li>
                  <button
                    onClick={onOpenVendorTab}
                    className="hover:text-orange-400 transition-colors text-left"
                  >
                    Commission Rates (5%–12%)
                  </button>
                </li>
                <li>
                  <button
                    onClick={onOpenVendorTab}
                    className="hover:text-orange-400 transition-colors text-left"
                  >
                    Payout & Finance Rules
                  </button>
                </li>
                <li>
                  <button
                    onClick={() => setActivePolicyModal('terms')}
                    className="hover:text-orange-400 transition-colors text-left"
                  >
                    Vendor Code of Conduct
                  </button>
                </li>
              </ul>
            </div>

            {/* 5. About */}
            <div className="space-y-3">
              <h4 className="font-black text-white text-xs sm:text-sm uppercase tracking-wider text-orange-500">
                About
              </h4>
              <ul className="space-y-2 text-[11px] sm:text-xs">
                <li>
                  <span className="text-stone-300 font-semibold block">AmarDokan Bangladesh</span>
                </li>
                <li>
                  <span className="text-stone-400 block">Multivendor E-Commerce</span>
                </li>
                <li>
                  <span className="text-stone-400 block">Registered Trade License: TRAD/DNCC/024819</span>
                </li>
                <li>
                  <span className="text-stone-400 block">BIN: 004928174-0101</span>
                </li>
                <li>
                  <span className="text-stone-400 block">Careers & Culture</span>
                </li>
              </ul>
            </div>

            {/* 6. Policies */}
            <div className="space-y-3">
              <h4 className="font-black text-white text-xs sm:text-sm uppercase tracking-wider text-orange-500">
                Policies
              </h4>
              <ul className="space-y-2 text-[11px] sm:text-xs">
                <li>
                  <button
                    onClick={() => setActivePolicyModal('terms')}
                    className="hover:text-orange-400 transition-colors text-left font-medium"
                  >
                    Terms & Conditions
                  </button>
                </li>
                <li>
                  <button
                    onClick={() => setActivePolicyModal('privacy')}
                    className="hover:text-orange-400 transition-colors text-left font-medium"
                  >
                    Privacy Policy
                  </button>
                </li>
                <li>
                  <button
                    onClick={() => setActivePolicyModal('refund')}
                    className="hover:text-orange-400 transition-colors text-left font-medium"
                  >
                    Refund & Return Policy
                  </button>
                </li>
                <li>
                  <button
                    onClick={() => setActivePolicyModal('shipping')}
                    className="hover:text-orange-400 transition-colors text-left font-medium"
                  >
                    Shipping Policy
                  </button>
                </li>
                <li>
                  <button
                    onClick={() => setActivePolicyModal('faq')}
                    className="hover:text-orange-400 transition-colors text-left font-medium"
                  >
                    Frequently Asked Questions
                  </button>
                </li>
              </ul>
            </div>

            {/* 7. Contact */}
            <div className="space-y-3 col-span-2 sm:col-span-1">
              <h4 className="font-black text-white text-xs sm:text-sm uppercase tracking-wider text-orange-500">
                Contact
              </h4>
              <div className="space-y-2 text-[11px] sm:text-xs text-stone-400">
                <div className="flex items-start gap-2">
                  <Phone className="w-3.5 h-3.5 text-orange-500 mt-0.5 shrink-0" />
                  <div>
                    <div className="text-white font-bold">09612-000000</div>
                    <div>+880 1712-345678</div>
                  </div>
                </div>
                <div className="flex items-start gap-2">
                  <Mail className="w-3.5 h-3.5 text-orange-500 mt-0.5 shrink-0" />
                  <div className="break-all">support@amardokan.com.bd</div>
                </div>
                <div className="flex items-start gap-2">
                  <MapPin className="w-3.5 h-3.5 text-orange-500 mt-0.5 shrink-0" />
                  <div>Plot 12, Road 4, Gulshan-1, Dhaka-1212</div>
                </div>
                <div className="flex items-start gap-2">
                  <Clock className="w-3.5 h-3.5 text-orange-500 mt-0.5 shrink-0" />
                  <div>9:00 AM – 10:00 PM (Daily)</div>
                </div>
              </div>
            </div>
          </div>

          {/* Social Links & Payment Verification Badges */}
          <div className="mt-10 pt-8 border-t border-stone-800 flex flex-col md:flex-row items-center justify-between gap-6">
            {/* Social Links */}
            <div className="flex items-center gap-4">
              <span className="text-xs text-stone-400 font-bold">Follow AmarDokan:</span>
              <div className="flex items-center gap-2">
                {socialLinks.map((s) => {
                  const Icon = s.icon;
                  return (
                    <a
                      key={s.name}
                      href={s.url}
                      target="_blank"
                      rel="noreferrer"
                      aria-label={s.name}
                      className="w-8 h-8 rounded-lg bg-stone-900 hover:bg-orange-600 border border-stone-800 hover:border-orange-500 text-stone-300 hover:text-white flex items-center justify-center transition-colors"
                      title={`${s.name}: ${s.handle}`}
                    >
                      <Icon className="w-4 h-4" />
                    </a>
                  );
                })}
              </div>
            </div>

            {/* Payment Options Badges */}
            <div className="flex flex-wrap items-center justify-center gap-2 text-[11px]">
              <span className="text-stone-500 mr-1 font-semibold">Accepted Payments:</span>
              <span className="bg-stone-900 border border-stone-800 text-emerald-400 px-2.5 py-1 rounded-md font-bold">
                Cash on Delivery
              </span>
              <span className="bg-stone-900 border border-stone-800 text-pink-400 px-2.5 py-1 rounded-md font-bold">
                bKash Send Money
              </span>
              <span className="bg-stone-900 border border-stone-800 text-orange-400 px-2.5 py-1 rounded-md font-bold">
                Nagad Send Money
              </span>
            </div>
          </div>

          {/* Prompt-mandated standalone links row */}
          <div className="mt-6 pt-6 border-t border-stone-800/60 flex flex-wrap items-center justify-center gap-4 sm:gap-6 text-xs text-stone-400">
            <button
              onClick={() => setActivePolicyModal('terms')}
              className="hover:text-white transition-colors"
            >
              Terms
            </button>
            <span>•</span>
            <button
              onClick={() => setActivePolicyModal('privacy')}
              className="hover:text-white transition-colors"
            >
              Privacy
            </button>
            <span>•</span>
            <button
              onClick={() => setActivePolicyModal('refund')}
              className="hover:text-white transition-colors"
            >
              Refund Policy
            </button>
            <span>•</span>
            <button
              onClick={() => setActivePolicyModal('shipping')}
              className="hover:text-white transition-colors"
            >
              Shipping Policy
            </button>
            <span>•</span>
            <button
              onClick={() => setActivePolicyModal('faq')}
              className="hover:text-white transition-colors"
            >
              FAQ
            </button>
            <span>•</span>
            <button
              onClick={() => setActivePolicyModal('contact')}
              className="hover:text-white transition-colors"
            >
              Contact
            </button>
          </div>

          {/* Bottom Copyright */}
          <div className="mt-6 pt-4 border-t border-stone-900 flex flex-col sm:flex-row items-center justify-between gap-3 text-[11px] text-stone-500 text-center sm:text-left">
            <div>
              &copy; {new Date().getFullYear()} AmarDokan Bangladesh. All rights reserved. General Multivendor Marketplace.
            </div>
            <div>
              Bangladesh Standard Time (BST) • 64 Districts Courier Coverage • BDT (৳) Currency
            </div>
          </div>
        </div>
      </footer>

      {/* Policy and FAQ Modal */}
      {activePolicyModal && (
        <div className="fixed inset-0 z-50 bg-stone-950/75 backdrop-blur-xs flex items-center justify-center p-4">
          <div className="bg-white rounded-2xl max-w-2xl w-full max-h-[85vh] overflow-y-auto p-6 sm:p-8 shadow-2xl border border-stone-200 text-stone-800 space-y-4">
            <div className="flex items-center justify-between pb-4 border-b border-stone-200">
              <div className="flex items-center gap-2">
                <FileText className="w-5 h-5 text-orange-600" />
                <h3 className="text-lg font-black text-stone-900 capitalize">
                  {activePolicyModal === 'terms' && 'Terms & Conditions'}
                  {activePolicyModal === 'privacy' && 'Privacy Policy'}
                  {activePolicyModal === 'refund' && 'Refund & Return Policy'}
                  {activePolicyModal === 'shipping' && 'Shipping & Delivery Policy'}
                  {activePolicyModal === 'faq' && 'Frequently Asked Questions (FAQ)'}
                  {activePolicyModal === 'contact' && 'Contact Us & Head Office'}
                </h3>
              </div>
              <button
                onClick={() => setActivePolicyModal(null)}
                className="w-8 h-8 rounded-full bg-stone-100 hover:bg-stone-200 text-stone-600 flex items-center justify-center transition-colors"
              >
                <X className="w-4 h-4" />
              </button>
            </div>

            {/* Modal Content */}
            <div className="text-xs leading-relaxed space-y-3 text-stone-600">
              {activePolicyModal === 'terms' && (
                <>
                  <p>
                    <strong>1. Marketplace Operations:</strong> AmarDokan is a general multivendor marketplace facilitating commerce between verified Bangladeshi merchants and consumers nationwide.
                  </p>
                  <p>
                    <strong>2. Product Authenticity:</strong> All vendors must hold a legitimate Trade License and guarantee genuine, unadulterated products across grocery, tech, lifestyle, and beauty.
                  </p>
                  <p>
                    <strong>3. Orders & Cancellation:</strong> Customers may cancel an order free of charge prior to parcel pickup by courier agents.
                  </p>
                  <p>
                    <strong>4. Pricing:</strong> All listed prices are in Bangladeshi Taka (BDT ৳) and inclusive of applicable government VAT where required.
                  </p>
                </>
              )}

              {activePolicyModal === 'privacy' && (
                <>
                  <p>
                    <strong>Customer Data Security:</strong> We collect customer name, phone number, and delivery address solely for shipping fulfillment and verification across Bangladesh.
                  </p>
                  <p>
                    <strong>Manual Payment Proof:</strong> bKash and Nagad transaction screenshots and TrxIDs are stored in private encrypted storage and accessed only by authenticated merchant finance personnel.
                  </p>
                  <p>
                    <strong>No Third-Party Sharing:</strong> We do not sell or lease customer contact information to unsolicited marketing networks.
                  </p>
                </>
              )}

              {activePolicyModal === 'refund' && (
                <>
                  <p>
                    <strong>7-Day Replacement Guarantee:</strong> If an item arrives damaged, expired, defective, or incorrect, customers are entitled to a full replacement or refund.
                  </p>
                  <p>
                    <strong>Return Process:</strong> File a return request through customer service with photos of the damaged packaging and delivery slip within 7 days of delivery.
                  </p>
                  <p>
                    <strong>Refund Timeline:</strong> Once the vendor receives and inspects the returned item, cash or mobile banking refunds are issued within 3 business days.
                  </p>
                </>
              )}

              {activePolicyModal === 'shipping' && (
                <>
                  <p>
                    <strong>Delivery Timeline:</strong>
                  </p>
                  <ul className="list-disc pl-5 space-y-1">
                    <li>Inside Dhaka: 24 to 48 hours (Flat Rate ৳60)</li>
                    <li>Outside Dhaka (All 64 districts): 48 to 72 hours (Flat Rate ৳120)</li>
                  </ul>
                  <p>
                    <strong>Courier Partners:</strong> We partner with RedX, Pathao, Steadfast, and eCourier for nationwide tracked delivery.
                  </p>
                </>
              )}

              {activePolicyModal === 'faq' && (
                <>
                  <div className="space-y-2">
                    <div>
                      <strong className="text-stone-900 block">Q: How does Cash on Delivery work?</strong>
                      <span>You pay in cash to the delivery agent after inspecting the outer package seal at your door.</span>
                    </div>
                    <div>
                      <strong className="text-stone-900 block">Q: How does bKash / Nagad verification work?</strong>
                      <span>You send money to our merchant account, then enter your phone number, TrxID, and upload screenshot at checkout. Our finance team checks the transaction statement before processing.</span>
                    </div>
                    <div>
                      <strong className="text-stone-900 block">Q: What if I close the payment popup?</strong>
                      <span>If you close or cancel the payment modal, you are safely returned to checkout with NO order created.</span>
                    </div>
                  </div>
                </>
              )}

              {activePolicyModal === 'contact' && (
                <>
                  <p>
                    <strong>Helpline:</strong> 09612-000000 / +880 1712-345678 (9:00 AM – 10:00 PM BST)
                  </p>
                  <p>
                    <strong>Email:</strong> support@amardokan.com.bd
                  </p>
                  <p>
                    <strong>Corporate Address:</strong> Plot 12, Level 4, Road 4, Gulshan-1, Dhaka-1212, Bangladesh
                  </p>
                </>
              )}
            </div>

            <div className="pt-3 border-t border-stone-100 flex justify-end">
              <button
                onClick={() => setActivePolicyModal(null)}
                className="bg-stone-900 hover:bg-stone-800 text-white font-bold text-xs px-5 py-2.5 rounded-xl transition-colors"
              >
                Close
              </button>
            </div>
          </div>
        </div>
      )}
    </>
  );
};
