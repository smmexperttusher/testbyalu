export interface ProductItem {
  id: number;
  vendorId: number;
  vendorName: string;
  vendorCommission: number;
  name: string;
  categorySlug: string;
  categoryName: string;
  regularPrice: number;
  salePrice: number;
  sku: string;
  stock: number;
  image: string;
  rating?: number;
  reviewCount?: number;
  badge?: string;
  description: string;
  salesCount?: number;
  isFeatured?: boolean;
  createdAt?: string;
}

export interface CartEntry {
  product: ProductItem;
  quantity: number;
}

export interface OrderRecord {
  orderNumber: string;
  customerName: string;
  customerPhone: string;
  address: string;
  subtotal: number;
  shipping: number;
  grandTotal: number;
  paymentMethod: 'cod' | 'bkash' | 'nagad';
  paymentStatus: 'pending' | 'pending_verification' | 'paid' | 'rejected';
  orderStatus: 'pending' | 'payment_verification' | 'confirmed' | 'cancelled';
  transactionId?: string;
  paymentPhone?: string;
  screenshotUrl?: string;
  submittedAt?: string;
  rejectionReason?: string;
  items: {
    vendorName: string;
    productName: string;
    qty: number;
    price: number;
    commissionRate: number;
    vendorEarning: number;
    platformCut: number;
  }[];
}

export interface CategoryItem {
  id: string;
  name: string;
  icon: any;
  count: number;
  image: string;
}

export interface CustomerReview {
  id: number;
  customerName: string;
  customerDistrict: string;
  rating: number;
  comment: string;
  productId: number;
  productName: string;
  productImage: string;
  vendorName: string;
  verifiedPurchase: boolean;
  orderNumber: string;
  date: string;
  isApproved: boolean;
}
