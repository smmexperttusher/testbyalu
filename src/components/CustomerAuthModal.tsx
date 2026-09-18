import React, { useState } from 'react';
import { X, Lock, User as UserIcon, Mail, Phone, ShoppingCart, CheckCircle2, AlertCircle } from 'lucide-react';

interface CustomerAuthModalProps {
  isOpen: boolean;
  onClose: () => void;
  onSuccess: (user: { name: string; email: string; phone: string; role: 'customer' }) => void;
  initialMode?: 'login' | 'register';
  pendingProductName?: string;
}

export const CustomerAuthModal: React.FC<CustomerAuthModalProps> = ({
  isOpen,
  onClose,
  onSuccess,
  initialMode = 'login',
  pendingProductName,
}) => {
  const [mode, setMode] = useState<'login' | 'register'>(initialMode);
  
  // Login fields
  const [loginEmailOrPhone, setLoginEmailOrPhone] = useState('');
  const [loginPassword, setLoginPassword] = useState('');
  const [rememberMe, setRememberMe] = useState(true);

  // Register fields
  const [regName, setRegName] = useState('');
  const [regEmail, setRegEmail] = useState('');
  const [regPhone, setRegPhone] = useState('');
  const [regPassword, setRegPassword] = useState('');
  const [regConfirmPassword, setRegConfirmPassword] = useState('');

  const [error, setError] = useState('');

  if (!isOpen) return null;

  const handleLoginSubmit = (e: React.FormEvent) => {
    e.preventDefault();
    setError('');

    if (!loginEmailOrPhone.trim()) {
      setError('Please enter your email address or Bangladeshi phone number.');
      return;
    }

    if (!loginPassword.trim() || loginPassword.length < 6) {
      setError('Password must be at least 6 characters.');
      return;
    }

    const isEmail = loginEmailOrPhone.includes('@');
    const user = {
      name: isEmail ? loginEmailOrPhone.split('@')[0] : 'Customer ' + loginEmailOrPhone.slice(-4),
      email: isEmail ? loginEmailOrPhone : `${loginEmailOrPhone}@customer.bd`,
      phone: isEmail ? '01712345678' : loginEmailOrPhone,
      role: 'customer' as const,
    };

    onSuccess(user);
    onClose();
  };

  const handleRegisterSubmit = (e: React.FormEvent) => {
    e.preventDefault();
    setError('');

    if (!regName.trim()) {
      setError('Full name is required.');
      return;
    }

    const bdPhoneRegex = /^(?:\+88|88)?(01[3-9]\d{8})$/;
    if (!bdPhoneRegex.test(regPhone.trim())) {
      setError('Please enter a valid 11-digit Bangladeshi mobile number (e.g. 017XXXXXXXX).');
      return;
    }

    if (!regEmail.trim() || !regEmail.includes('@')) {
      setError('Please provide a valid email address.');
      return;
    }

    if (!regPassword || regPassword.length < 8) {
      setError('Password must be at least 8 characters long.');
      return;
    }

    if (regPassword !== regConfirmPassword) {
      setError('Passwords do not match. Please re-type.');
      return;
    }

    const user = {
      name: regName.trim(),
      email: regEmail.trim(),
      phone: regPhone.trim(),
      role: 'customer' as const,
    };

    onSuccess(user);
    onClose();
  };

  return (
    <div
      className="fixed inset-0 z-50 flex items-center justify-center p-3 sm:p-4 bg-stone-950/70 backdrop-blur-xs animate-fade-in"
      role="dialog"
      aria-modal="true"
    >
      <div className="relative bg-white w-full max-w-md rounded-2xl shadow-2xl border border-stone-200 overflow-hidden max-h-[94vh] flex flex-col">
        {/* Close Button */}
        <button
          onClick={onClose}
          className="absolute top-3.5 right-3.5 text-stone-400 hover:text-stone-700 bg-stone-100 hover:bg-stone-200 rounded-full p-1.5 transition-colors z-20"
          aria-label="Close"
        >
          <X className="w-4 h-4" />
        </button>

        {/* Modal Banner Header */}
        <div className="bg-gradient-to-br from-stone-950 via-stone-900 to-orange-950 text-white p-5 sm:p-6 text-center shrink-0">
          <div className="w-10 h-10 rounded-xl bg-orange-600 flex items-center justify-center text-white font-black text-xl mx-auto mb-2 shadow-xs">
            অ
          </div>
          <h2 className="text-lg sm:text-xl font-black tracking-tight text-white">
            Welcome Back
          </h2>
          <p className="text-xs text-stone-300 mt-0.5">
            Please log in to continue shopping.
          </p>

          {/* Mandatory Business Notification */}
          <div className="mt-3 bg-orange-900/60 border border-orange-500/40 rounded-xl py-2 px-3 text-xs text-orange-200 font-medium flex items-center justify-center gap-2">
            <ShoppingCart className="w-4 h-4 text-orange-400 shrink-0" />
            <span>
              {pendingProductName
                ? `Please log in or create an account to add "${pendingProductName}" to your cart.`
                : 'Please log in or create an account to add items to your cart.'}
            </span>
          </div>
        </div>

        {/* Mode Switcher Tabs */}
        <div className="flex border-b border-stone-200 bg-stone-50 shrink-0">
          <button
            onClick={() => {
              setMode('login');
              setError('');
            }}
            className={`flex-1 py-3 text-xs sm:text-sm font-bold border-b-2 transition-all ${
              mode === 'login'
                ? 'border-orange-600 text-orange-600 bg-white'
                : 'border-transparent text-stone-500 hover:text-stone-800'
            }`}
          >
            Customer Login
          </button>
          <button
            onClick={() => {
              setMode('register');
              setError('');
            }}
            className={`flex-1 py-3 text-xs sm:text-sm font-bold border-b-2 transition-all ${
              mode === 'register'
                ? 'border-orange-600 text-orange-600 bg-white'
                : 'border-transparent text-stone-500 hover:text-stone-800'
            }`}
          >
            Create Account
          </button>
        </div>

        {/* Body Content */}
        <div className="overflow-y-auto p-5 sm:p-6 space-y-4">
          {error && (
            <div className="p-3 bg-red-50 border border-red-200 text-red-700 text-xs rounded-xl flex items-start gap-2">
              <AlertCircle className="w-4 h-4 shrink-0 mt-0.5" />
              <span>{error}</span>
            </div>
          )}

          {mode === 'login' ? (
            /* 1. Customer Login Form */
            <form onSubmit={handleLoginSubmit} className="space-y-3.5">
              <div>
                <label className="block text-xs font-bold text-stone-700 mb-1">
                  Email or Bangladeshi Mobile Number
                </label>
                <div className="relative">
                  <input
                    type="text"
                    value={loginEmailOrPhone}
                    onChange={(e) => setLoginEmailOrPhone(e.target.value)}
                    placeholder="017XXXXXXXX or customer@amardokan.bd"
                    className="w-full pl-3.5 pr-3 py-2.5 bg-stone-50 border border-stone-300 rounded-xl text-xs sm:text-sm text-stone-900 focus:ring-2 focus:ring-orange-600 focus:bg-white focus:outline-hidden"
                    required
                  />
                </div>
              </div>

              <div>
                <div className="flex justify-between items-center mb-1">
                  <label className="block text-xs font-bold text-stone-700">Password</label>
                  <span className="text-[11px] text-orange-600 hover:underline cursor-pointer">
                    Forgot?
                  </span>
                </div>
                <div className="relative">
                  <input
                    type="password"
                    value={loginPassword}
                    onChange={(e) => setLoginPassword(e.target.value)}
                    placeholder="••••••••"
                    className="w-full pl-3.5 pr-3 py-2.5 bg-stone-50 border border-stone-300 rounded-xl text-xs sm:text-sm text-stone-900 focus:ring-2 focus:ring-orange-600 focus:bg-white focus:outline-hidden"
                    required
                  />
                </div>
              </div>

              <div className="flex items-center justify-between text-xs text-stone-600">
                <label className="flex items-center gap-2 cursor-pointer">
                  <input
                    type="checkbox"
                    checked={rememberMe}
                    onChange={(e) => setRememberMe(e.target.checked)}
                    className="rounded border-stone-300 text-orange-600 focus:ring-orange-500"
                  />
                  <span>Remember me on this browser</span>
                </label>
              </div>

              <button
                type="submit"
                className="w-full py-3 bg-orange-600 hover:bg-orange-700 text-white font-bold text-xs sm:text-sm rounded-xl transition-colors shadow-sm flex items-center justify-center gap-2"
              >
                <span>Sign In & Add to Cart</span>
              </button>

              <div className="pt-2 text-center text-xs text-stone-500">
                New customer?{' '}
                <button
                  type="button"
                  onClick={() => {
                    setMode('register');
                    setError('');
                  }}
                  className="text-orange-600 font-bold hover:underline"
                >
                  Create an account
                </button>
              </div>
            </form>
          ) : (
            /* 2. Customer Registration Form */
            <form onSubmit={handleRegisterSubmit} className="space-y-3">
              <div>
                <label className="block text-xs font-bold text-stone-700 mb-1">Full Name *</label>
                <input
                  type="text"
                  value={regName}
                  onChange={(e) => setRegName(e.target.value)}
                  placeholder="e.g. Tanvir Hossain"
                  className="w-full px-3.5 py-2 bg-stone-50 border border-stone-300 rounded-xl text-xs sm:text-sm text-stone-900 focus:ring-2 focus:ring-orange-600 focus:bg-white focus:outline-hidden"
                  required
                />
              </div>

              <div>
                <label className="block text-xs font-bold text-stone-700 mb-1">Email Address *</label>
                <input
                  type="email"
                  value={regEmail}
                  onChange={(e) => setRegEmail(e.target.value)}
                  placeholder="name@domain.com"
                  className="w-full px-3.5 py-2 bg-stone-50 border border-stone-300 rounded-xl text-xs sm:text-sm text-stone-900 focus:ring-2 focus:ring-orange-600 focus:bg-white focus:outline-hidden"
                  required
                />
              </div>

              <div>
                <label className="block text-xs font-bold text-stone-700 mb-1">
                  Mobile Number (Bangladesh 11-digit) *
                </label>
                <div className="relative flex items-center">
                  <span className="absolute left-3 text-xs font-bold text-stone-500">+88</span>
                  <input
                    type="tel"
                    value={regPhone}
                    onChange={(e) => setRegPhone(e.target.value)}
                    placeholder="01712345678"
                    className="w-full pl-11 pr-3.5 py-2 bg-stone-50 border border-stone-300 rounded-xl text-xs sm:text-sm text-stone-900 focus:ring-2 focus:ring-orange-600 focus:bg-white focus:outline-hidden"
                    required
                  />
                </div>
              </div>

              <div className="grid grid-cols-1 sm:grid-cols-2 gap-2.5">
                <div>
                  <label className="block text-xs font-bold text-stone-700 mb-1">Password *</label>
                  <input
                    type="password"
                    value={regPassword}
                    onChange={(e) => setRegPassword(e.target.value)}
                    placeholder="Min 8 characters"
                    className="w-full px-3 py-2 bg-stone-50 border border-stone-300 rounded-xl text-xs sm:text-sm text-stone-900 focus:ring-2 focus:ring-orange-600 focus:bg-white focus:outline-hidden"
                    required
                  />
                </div>
                <div>
                  <label className="block text-xs font-bold text-stone-700 mb-1">Confirm *</label>
                  <input
                    type="password"
                    value={regConfirmPassword}
                    onChange={(e) => setRegConfirmPassword(e.target.value)}
                    placeholder="Re-type password"
                    className="w-full px-3 py-2 bg-stone-50 border border-stone-300 rounded-xl text-xs sm:text-sm text-stone-900 focus:ring-2 focus:ring-orange-600 focus:bg-white focus:outline-hidden"
                    required
                  />
                </div>
              </div>

              <div className="text-[11px] text-stone-500 leading-tight pt-1">
                By registering, you agree to AmarDokan's Customer Terms of Service.
              </div>

              <button
                type="submit"
                className="w-full py-3 bg-orange-600 hover:bg-orange-700 text-white font-bold text-xs sm:text-sm rounded-xl transition-colors shadow-sm"
              >
                Create Account & Proceed
              </button>

              <div className="pt-2 text-center text-xs text-stone-500">
                Already registered?{' '}
                <button
                  type="button"
                  onClick={() => {
                    setMode('login');
                    setError('');
                  }}
                  className="text-orange-600 font-bold hover:underline"
                >
                  Sign in
                </button>
              </div>
            </form>
          )}
        </div>
      </div>
    </div>
  );
};
