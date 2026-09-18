import React, { useState } from 'react';
import { ArrowRight, ChevronDown } from 'lucide-react';
import { ProductItem } from '../types';
import { ProductCard } from './ProductCard';

interface ProductSectionProps {
  id?: string;
  title: string;
  subtitle?: string;
  badge?: string;
  badgeColor?: 'red' | 'orange';
  icon?: React.ReactNode;
  products: ProductItem[];
  limit?: number; // Exactly 10 products
  onAddToCart: (product: ProductItem) => void;
  onToggleWishlist?: (productId: number) => void;
  onSeeMore?: () => void;
  seeMoreText?: string;
}

export const ProductSection: React.FC<ProductSectionProps> = ({
  id,
  title,
  subtitle,
  badge,
  badgeColor = 'orange',
  icon,
  products,
  limit = 10,
  onAddToCart,
  onToggleWishlist,
  onSeeMore,
  seeMoreText = 'See More',
}) => {
  const [expanded, setExpanded] = useState(false);

  // If section has no products, hide cleanly
  if (!products || products.length === 0) {
    return null;
  }

  // Exactly 10 products on initial load (2 cols x 5 rows on mobile)
  const displayProducts = expanded ? products : products.slice(0, limit);
  const hasMore = products.length > limit;

  const handleSeeMore = () => {
    if (onSeeMore) {
      onSeeMore();
    } else if (hasMore) {
      setExpanded(true);
    }
  };

  return (
    <section id={id} className="w-full">
      <div className="bg-white rounded-2xl border border-stone-200 p-3 sm:p-6 lg:p-7 shadow-xs">
        {/* Section Header */}
        <div className="flex flex-col sm:flex-row sm:items-center justify-between gap-2.5 sm:gap-3 mb-4 sm:mb-6 pb-3 sm:pb-4 border-b border-stone-100">
          <div className="flex items-center gap-2.5 sm:gap-3">
            {icon && (
              <div className="w-8 h-8 sm:w-10 sm:h-10 rounded-xl bg-orange-50 border border-orange-200/70 text-orange-600 flex items-center justify-center font-black text-base sm:text-lg shrink-0">
                {icon}
              </div>
            )}
            <div>
              <div className="flex items-center gap-1.5 sm:gap-2">
                <h3 className="text-base sm:text-xl md:text-2xl font-black text-stone-900 tracking-tight">
                  {title}
                </h3>
                {badge && (
                  <span
                    className={`text-[9px] sm:text-xs font-extrabold uppercase px-1.5 sm:px-2 py-0.5 rounded-full ${
                      badgeColor === 'red'
                        ? 'bg-rose-100 text-rose-700 border border-rose-200'
                        : 'bg-orange-100 text-orange-800 border border-orange-200'
                    }`}
                  >
                    {badge}
                  </span>
                )}
              </div>
              {subtitle && (
                <p className="text-[11px] sm:text-sm text-stone-500 mt-0.5">{subtitle}</p>
              )}
            </div>
          </div>

          {/* Desktop Top "See More" Link */}
          <button
            type="button"
            onClick={handleSeeMore}
            className="hidden sm:inline-flex items-center gap-1.5 text-xs font-bold text-orange-600 hover:text-orange-700 transition-colors group cursor-pointer"
          >
            <span>{seeMoreText}</span>
            <ArrowRight className="w-3.5 h-3.5 group-hover:translate-x-0.5 transition-transform" />
          </button>
        </div>

        {/* Critical Grid Layout:
            - Mobile: exactly 2 products per row (grid-cols-2) -> 2 cols x 5 rows = 10 products
            - Tablet: 3 columns (sm:grid-cols-3)
            - Desktop: 4-5 columns (lg:grid-cols-4 xl:grid-cols-5)
        */}
        <div className="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-2 sm:gap-4 md:gap-5">
          {displayProducts.map((product) => (
            <ProductCard
              key={product.id}
              product={product}
              onAddToCart={onAddToCart}
              onToggleWishlist={onToggleWishlist}
            />
          ))}
        </div>

        {/* "See More" Button Area below the 10 products */}
        <div className="mt-6 pt-5 border-t border-stone-100 flex items-center justify-center">
          <button
            type="button"
            id={`${id || 'section'}-see-more-btn`}
            onClick={handleSeeMore}
            className="w-full sm:w-auto inline-flex items-center justify-center gap-2 bg-stone-50 hover:bg-orange-50 text-stone-800 hover:text-orange-700 font-bold text-xs sm:text-sm px-6 py-2.5 sm:py-3 rounded-xl border border-stone-200 hover:border-orange-300 transition-all shadow-2xs cursor-pointer"
          >
            <span>{expanded ? 'Showing All Products' : seeMoreText}</span>
            <span className="text-stone-400 font-normal">
              ({products.length} products)
            </span>
            {expanded ? (
              <ChevronDown className="w-4 h-4 text-orange-600 rotate-180 transition-transform" />
            ) : (
              <ArrowRight className="w-4 h-4 text-orange-600" />
            )}
          </button>
        </div>
      </div>
    </section>
  );
};
