import React, { useState, useEffect } from 'react';
import { Mail, Check, Sparkles, BellRing, ArrowRight } from 'lucide-react';

export const NewsletterSection: React.FC = () => {
  const [email, setEmail] = useState('');
  const [isSubscribed, setIsSubscribed] = useState(false);
  const [errorMessage, setErrorMessage] = useState('');
  const [isLoading, setIsLoading] = useState(false);

  useEffect(() => {
    const saved = localStorage.getItem('amardokan_newsletter_subscriber');
    if (saved) {
      setIsSubscribed(true);
      setEmail(saved);
    }
  }, []);

  const handleSubmit = (e: React.FormEvent) => {
    e.preventDefault();
    setErrorMessage('');

    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!email.trim() || !emailRegex.test(email.trim())) {
      setErrorMessage('Please enter a valid email address (e.g. name@example.com).');
      return;
    }

    setIsLoading(true);
    setTimeout(() => {
      setIsLoading(false);
      setIsSubscribed(true);
      localStorage.setItem('amardokan_newsletter_subscriber', email.trim());
    }, 400);
  };

  const handleUnsubscribe = () => {
    localStorage.removeItem('amardokan_newsletter_subscriber');
    setIsSubscribed(false);
    setEmail('');
  };

  return (
    <section id="newsletter-section" className="w-full">
      <div className="relative rounded-2xl overflow-hidden bg-stone-900 border border-stone-800 p-6 sm:p-8 lg:p-10 text-white shadow-xs">
        {/* Subtle Background Elements */}
        <div className="absolute -right-20 -top-20 w-64 h-64 rounded-full bg-orange-600/10 blur-3xl pointer-events-none"></div>
        <div className="absolute -left-20 -bottom-20 w-64 h-64 rounded-full bg-amber-600/10 blur-3xl pointer-events-none"></div>

        <div className="relative z-10 max-w-3xl mx-auto text-center space-y-4">
          <div className="inline-flex items-center gap-1.5 bg-orange-600/20 text-orange-400 border border-orange-500/30 text-[11px] sm:text-xs font-extrabold px-3 py-1 rounded-full uppercase tracking-wider">
            <Sparkles className="w-3.5 h-3.5 text-orange-400" />
            <span>Marketplace Weekly Briefing</span>
          </div>

          <h2 className="text-2xl sm:text-3xl lg:text-4xl font-black tracking-tight text-white">
            Get the Latest Deals & Offers
          </h2>

          <p className="text-xs sm:text-sm text-stone-300 max-w-xl mx-auto leading-relaxed">
            Subscribe to receive verified grocery price alerts, weekend gadget discounts, and new merchant launches across Bangladesh.
          </p>

          {isSubscribed ? (
            <div className="bg-emerald-950/60 border border-emerald-500/40 rounded-xl p-4 sm:p-5 max-w-md mx-auto text-center space-y-2">
              <div className="w-10 h-10 rounded-full bg-emerald-500/20 text-emerald-400 flex items-center justify-center mx-auto">
                <Check className="w-5 h-5" />
              </div>
              <h4 className="font-bold text-emerald-300 text-sm">
                You're on the VIP Deal List!
              </h4>
              <p className="text-xs text-stone-300">
                Weekly deal alerts will be sent to <strong className="text-white">{email}</strong>.
              </p>
              <button
                type="button"
                onClick={handleUnsubscribe}
                className="text-[11px] text-stone-400 hover:text-rose-300 underline pt-1"
              >
                Unsubscribe or change email
              </button>
            </div>
          ) : (
            <form onSubmit={handleSubmit} className="max-w-md mx-auto space-y-2">
              <div className="flex flex-col sm:flex-row gap-2">
                <div className="relative flex-1">
                  <div className="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-stone-400">
                    <Mail className="w-4 h-4" />
                  </div>
                  <input
                    type="email"
                    value={email}
                    onChange={(e) => {
                      setEmail(e.target.value);
                      if (errorMessage) setErrorMessage('');
                    }}
                    placeholder="Enter your email address"
                    className="w-full pl-10 pr-4 py-3 bg-stone-800 border border-stone-700 rounded-xl text-xs sm:text-sm text-white placeholder-stone-400 focus:outline-hidden focus:border-orange-500 focus:ring-1 focus:ring-orange-500 transition-colors"
                  />
                </div>
                <button
                  type="submit"
                  disabled={isLoading}
                  className="bg-orange-600 hover:bg-orange-700 active:bg-orange-800 text-white font-bold text-xs sm:text-sm px-6 py-3 rounded-xl shadow-xs transition-colors flex items-center justify-center gap-2 shrink-0 cursor-pointer"
                >
                  {isLoading ? (
                    <span>Subscribing...</span>
                  ) : (
                    <>
                      <span>Subscribe</span>
                      <ArrowRight className="w-4 h-4" />
                    </>
                  )}
                </button>
              </div>

              {errorMessage && (
                <p className="text-xs text-rose-400 text-left font-medium pl-1">
                  {errorMessage}
                </p>
              )}

              <div className="flex items-center justify-center gap-3 text-[11px] text-stone-400 pt-1">
                <span>No spam</span>
                <span>•</span>
                <span>Unsubscribe anytime</span>
                <span>•</span>
                <span>Exclusive subscriber discounts</span>
              </div>
            </form>
          )}
        </div>
      </div>
    </section>
  );
};
