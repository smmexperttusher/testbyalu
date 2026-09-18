import React from 'react';
import { Banknote, ShieldAlert, ArrowRight, CheckCircle2, Clock, Smartphone, Building2 } from 'lucide-react';

interface PaymentOptionsSectionProps {
  onGoToCheckout?: () => void;
}

export const PaymentOptionsSection: React.FC<PaymentOptionsSectionProps> = ({ onGoToCheckout }) => {
  return (
    <section id="payment-options" className="w-full">
      <div className="bg-white rounded-2xl border border-stone-200 p-4 sm:p-6 lg:p-8 shadow-xs">
        {/* Section Header */}
        <div className="flex flex-col sm:flex-row sm:items-center justify-between gap-3 mb-6 pb-4 border-b border-stone-100">
          <div>
            <div className="flex items-center gap-2">
              <h2 className="text-xl sm:text-2xl font-black text-stone-900 tracking-tight">
                Pay Your Way
              </h2>
              <span className="bg-orange-100 text-orange-800 text-[10px] sm:text-xs font-bold px-2 py-0.5 rounded-full border border-orange-200">
                Transparent Checkout
              </span>
            </div>
            <p className="text-xs sm:text-sm text-stone-600 mt-1 font-medium">
              Choose your preferred payment option at checkout.
            </p>
          </div>

          {onGoToCheckout && (
            <button
              type="button"
              onClick={onGoToCheckout}
              className="inline-flex items-center gap-1.5 text-xs font-bold text-orange-600 hover:text-orange-700 transition-colors group cursor-pointer self-start sm:self-auto"
            >
              <span>View in Checkout</span>
              <ArrowRight className="w-3.5 h-3.5 group-hover:translate-x-0.5 transition-transform" />
            </button>
          )}
        </div>

        {/* 3 Payment Methods Grid */}
        <div className="grid grid-cols-1 md:grid-cols-3 gap-4 sm:gap-5">
          {/* 1. Cash on Delivery (COD) */}
          <div className="bg-stone-50 rounded-xl p-5 border border-stone-200 hover:border-emerald-500 transition-all flex flex-col justify-between group">
            <div>
              <div className="flex items-center justify-between mb-3">
                <div className="w-11 h-11 rounded-xl bg-emerald-100 text-emerald-700 border border-emerald-200 flex items-center justify-center font-bold shadow-2xs">
                  <Banknote className="w-6 h-6" />
                </div>
                <span className="bg-emerald-100 text-emerald-800 text-[10px] font-extrabold px-2 py-0.5 rounded-full uppercase tracking-wider">
                  64 Districts
                </span>
              </div>

              <h3 className="font-extrabold text-stone-900 text-base mb-1.5">
                Cash on Delivery (COD)
              </h3>
              <p className="text-xs text-stone-600 leading-relaxed mb-3">
                Pay with physical cash directly to the courier agent upon doorstep delivery and parcel inspection.
              </p>

              <div className="space-y-1.5 text-[11px] text-stone-600 border-t border-stone-200/70 pt-2.5">
                <div className="flex items-center gap-1.5">
                  <CheckCircle2 className="w-3.5 h-3.5 text-emerald-600 shrink-0" />
                  <span>Available inside Dhaka (৳60) & outside Dhaka (৳120)</span>
                </div>
                <div className="flex items-center gap-1.5">
                  <CheckCircle2 className="w-3.5 h-3.5 text-emerald-600 shrink-0" />
                  <span>No upfront payment or card information required</span>
                </div>
                <div className="flex items-center gap-1.5">
                  <CheckCircle2 className="w-3.5 h-3.5 text-emerald-600 shrink-0" />
                  <span>Exact change appreciated by delivery personnel</span>
                </div>
              </div>
            </div>

            <div className="mt-4 pt-3 border-t border-stone-200/80 flex items-center justify-between text-[11px] font-bold text-emerald-700">
              <span>Status: Standard Active</span>
              <span>Zero Convenience Fee</span>
            </div>
          </div>

          {/* 2. bKash (Mobile Banking) */}
          <div className="bg-stone-50 rounded-xl p-5 border border-stone-200 hover:border-pink-500 transition-all flex flex-col justify-between group">
            <div>
              <div className="flex items-center justify-between mb-3">
                <div className="w-11 h-11 rounded-xl bg-pink-100 text-pink-700 border border-pink-200 flex items-center justify-center font-black text-sm shadow-2xs">
                  <span className="text-pink-600 font-extrabold text-base">bKash</span>
                </div>
                <span className="bg-pink-100 text-pink-800 text-[10px] font-extrabold px-2 py-0.5 rounded-full uppercase tracking-wider">
                  Manual Verification
                </span>
              </div>

              <h3 className="font-extrabold text-stone-900 text-base mb-1.5">
                bKash Send Money
              </h3>
              <p className="text-xs text-stone-600 leading-relaxed mb-3">
                Transfer the order total from your bKash app or *247# to our authorized merchant personal wallet.
              </p>

              <div className="space-y-1.5 text-[11px] text-stone-600 border-t border-stone-200/70 pt-2.5">
                <div className="flex items-center gap-1.5">
                  <Smartphone className="w-3.5 h-3.5 text-pink-600 shrink-0" />
                  <span>Merchant Number: <strong>01712-345678</strong></span>
                </div>
                <div className="flex items-center gap-1.5">
                  <Clock className="w-3.5 h-3.5 text-pink-600 shrink-0" />
                  <span>Provide Phone Number, TrxID & Screenshot proof</span>
                </div>
                <div className="flex items-center gap-1.5">
                  <ShieldAlert className="w-3.5 h-3.5 text-amber-600 shrink-0" />
                  <span>Manual review by finance admin before dispatch</span>
                </div>
              </div>
            </div>

            <div className="mt-4 pt-3 border-t border-stone-200/80 flex items-center justify-between text-[11px] font-bold text-pink-700">
              <span>Status: Manual Audit</span>
              <span>Approval within 30 mins</span>
            </div>
          </div>

          {/* 3. Nagad (Post Office Digital Banking) */}
          <div className="bg-stone-50 rounded-xl p-5 border border-stone-200 hover:border-orange-500 transition-all flex flex-col justify-between group">
            <div>
              <div className="flex items-center justify-between mb-3">
                <div className="w-11 h-11 rounded-xl bg-orange-100 text-orange-700 border border-orange-200 flex items-center justify-center font-black text-sm shadow-2xs">
                  <span className="text-orange-600 font-extrabold text-base">Nagad</span>
                </div>
                <span className="bg-orange-100 text-orange-800 text-[10px] font-extrabold px-2 py-0.5 rounded-full uppercase tracking-wider">
                  Manual Verification
                </span>
              </div>

              <h3 className="font-extrabold text-stone-900 text-base mb-1.5">
                Nagad Send Money
              </h3>
              <p className="text-xs text-stone-600 leading-relaxed mb-3">
                Send the exact order amount using the Nagad app or *167# to our merchant account number.
              </p>

              <div className="space-y-1.5 text-[11px] text-stone-600 border-t border-stone-200/70 pt-2.5">
                <div className="flex items-center gap-1.5">
                  <Smartphone className="w-3.5 h-3.5 text-orange-600 shrink-0" />
                  <span>Merchant Number: <strong>01819-000101</strong></span>
                </div>
                <div className="flex items-center gap-1.5">
                  <Clock className="w-3.5 h-3.5 text-orange-600 shrink-0" />
                  <span>Submit Sender Phone, TrxID & Screenshot at checkout</span>
                </div>
                <div className="flex items-center gap-1.5">
                  <ShieldAlert className="w-3.5 h-3.5 text-amber-600 shrink-0" />
                  <span>Verified directly against bank statements</span>
                </div>
              </div>
            </div>

            <div className="mt-4 pt-3 border-t border-stone-200/80 flex items-center justify-between text-[11px] font-bold text-orange-700">
              <span>Status: Manual Audit</span>
              <span>Approval within 30 mins</span>
            </div>
          </div>
        </div>

        {/* Important Disclosure Banner on Manual Payment Verification */}
        <div className="mt-5 p-3.5 sm:p-4 rounded-xl bg-amber-50/80 border border-amber-200 flex items-start gap-3 text-stone-800">
          <ShieldAlert className="w-5 h-5 text-amber-600 shrink-0 mt-0.5" />
          <div className="text-xs leading-relaxed">
            <span className="font-bold text-stone-900">
              Important Notice Regarding Mobile Banking Verification:
            </span>{' '}
            Our bKash and Nagad payment gateways utilize <strong>manual payment verification</strong>.
            We do not claim automatic payment verification or official API integration. When placing an order via bKash or Nagad, customers submit their transaction details, which are verified by merchant financial administrators before orders transition to confirmed packing status.
          </div>
        </div>
      </div>
    </section>
  );
};
