import React, { useState } from 'react';
import { ShoppingCart, Heart, Store, Star, Check } from 'lucide-react';
import { ProductItem } from '../types';

interface ProductCardProps {
  product: ProductItem;
  onAddToCart: (product: ProductItem) => void;
  onToggleWishlist?: (productId: number) => void;
  isWishlisted?: boolean;
}

export const ProductCard: React.FC<ProductCardProps> = ({
  product,
  onAddToCart,
  onToggleWishlist,
  isWishlisted = false,
}) => {
  const [added, setAdded] = useState(false);
  const [wishlistActive, setWishlistActive] = useState(isWishlisted);

  const discountPercent =
    product.regularPrice > product.salePrice
      ? Math.round(((product.regularPrice - product.salePrice) / product.regularPrice) * 100)
      : null;

  const handleAdd = (e: React.MouseEvent) => {
    e.stopPropagation();
    onAddToCart(product);
    setAdded(true);
    setTimeout(() => setAdded(false), 1200);
  };

  const handleWishlist = (e: React.MouseEvent) => {
    e.stopPropagation();
    setWishlistActive(!wishlistActive);
    if (onToggleWishlist) {
      onToggleWishlist(product.id);
    }
  };

  return (
    <div
      id={`product-card-${product.id}`}
      className="bg-white rounded-xl border border-stone-200 hover:border-orange-500 shadow-2xs hover:shadow-md transition-all duration-200 flex flex-col justify-between overflow-hidden group relative h-full"
    >
      {/* Top Image Container with Badges & Wishlist */}
      <div className="relative w-full aspect-square bg-stone-50 overflow-hidden flex items-center justify-center p-2 sm:p-3 border-b border-stone-100">
        {/* Discount Badge */}
        {discountPercent ? (
          <div className="absolute top-1.5 left-1.5 sm:top-2 sm:left-2 z-10 bg-orange-600 text-white font-extrabold text-[9px] sm:text-xs px-1.5 sm:px-2 py-0.5 rounded shadow-xs flex items-center gap-0.5">
            <span>-{discountPercent}%</span>
          </div>
        ) : product.badge ? (
          <div className="absolute top-1.5 left-1.5 sm:top-2 sm:left-2 z-10 bg-stone-900 text-white font-bold text-[9px] sm:text-[10px] px-1.5 sm:px-2 py-0.5 rounded shadow-xs">
            {product.badge}
          </div>
        ) : null}

        {/* Wishlist Button */}
        <button
          type="button"
          aria-label="Add to Wishlist"
          onClick={handleWishlist}
          className={`absolute top-1.5 right-1.5 sm:top-2 sm:right-2 z-10 w-6 h-6 sm:w-8 sm:h-8 rounded-full bg-white/90 hover:bg-white border border-stone-200/80 shadow-xs flex items-center justify-center transition-colors ${
            wishlistActive ? 'text-rose-600' : 'text-stone-400 hover:text-rose-600'
          }`}
        >
          <Heart className={`w-3 h-3 sm:w-4 sm:h-4 ${wishlistActive ? 'fill-current' : ''}`} />
        </button>

        {/* Product Image (Consistent container preventing stretching/clipping) */}
        <div className="w-full h-full flex items-center justify-center">
          <img
            src={product.image}
            alt={product.name}
            loading="lazy"
            referrerPolicy="no-referrer"
            className="max-w-full max-h-full object-contain group-hover:scale-105 transition-transform duration-300"
          />
        </div>
      </div>

      {/* Product Details Section */}
      <div className="p-2 sm:p-3.5 flex flex-col flex-1 justify-between gap-1.5 sm:gap-2">
        <div>
          {/* Vendor / Store Name */}
          <div className="flex items-center gap-1 text-[10px] sm:text-[11px] text-stone-500 font-medium mb-0.5 sm:mb-1">
            <Store className="w-2.5 h-2.5 sm:w-3 sm:h-3 text-orange-600 shrink-0" />
            <span className="truncate hover:text-orange-700">{product.vendorName}</span>
          </div>

          {/* Product Name */}
          <h4 className="font-bold text-stone-900 text-[11px] sm:text-xs md:text-sm leading-snug line-clamp-2 group-hover:text-orange-600 transition-colors">
            {product.name}
          </h4>

          {/* Rating & Review Count */}
          <div className="flex items-center gap-1 mt-1 sm:mt-1.5">
            <div className="flex items-center text-amber-400">
              <Star className="w-3 h-3 sm:w-3.5 sm:h-3.5 fill-current" />
            </div>
            <span className="text-[11px] sm:text-xs font-bold text-stone-800">
              {product.rating ?? 4.8}
            </span>
            <span className="text-[10px] sm:text-[11px] text-stone-400">
              ({product.reviewCount ?? 45})
            </span>
          </div>
        </div>

        {/* Price & Add to Cart */}
        <div className="pt-1.5 sm:pt-2 border-t border-stone-100 mt-auto">
          <div className="flex items-baseline gap-1 sm:gap-1.5 mb-1.5 sm:mb-2">
            <span className="text-xs sm:text-sm md:text-base font-extrabold text-stone-900">
              ৳{product.salePrice.toLocaleString()}
            </span>
            {product.regularPrice > product.salePrice && (
              <span className="text-[10px] sm:text-xs text-stone-400 line-through">
                ৳{product.regularPrice.toLocaleString()}
              </span>
            )}
          </div>

          {/* Add to Cart Button */}
          <button
            type="button"
            id={`add-to-cart-btn-${product.id}`}
            onClick={handleAdd}
            className={`w-full font-bold text-[11px] sm:text-xs py-1.5 sm:py-2 px-1.5 sm:px-2.5 rounded-lg shadow-2xs transition-colors flex items-center justify-center gap-1 sm:gap-1.5 ${
              added
                ? 'bg-emerald-600 text-white'
                : 'bg-orange-600 hover:bg-orange-700 active:bg-orange-800 text-white'
            }`}
          >
            {added ? (
              <>
                <Check className="w-3 h-3 sm:w-3.5 sm:h-3.5" />
                <span>Added!</span>
              </>
            ) : (
              <>
                <ShoppingCart className="w-3 h-3 sm:w-3.5 sm:h-3.5" />
                <span>Add to Cart</span>
              </>
            )}
          </button>
        </div>
      </div>
    </div>
  );
};
