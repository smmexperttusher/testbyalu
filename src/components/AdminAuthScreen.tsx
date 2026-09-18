import React, { useState } from 'react';
import { Lock, AlertCircle, ArrowLeft, Shield } from 'lucide-react';

interface AdminAuthScreenProps {
  onSuccess: () => void;
  onBackToStore: () => void;
}

export const AdminAuthScreen: React.FC<AdminAuthScreenProps> = ({ onSuccess, onBackToStore }) => {
  const [email, setEmail] = useState('');
  const [password, setPassword] = useState('');
  const [error, setError] = useState('');
  const [loading, setLoading] = useState(false);

  const handleSubmit = (e: React.FormEvent) => {
    e.preventDefault();
    setError('');
    setLoading(true);

    setTimeout(() => {
      // Administrative credential check (matches production seeders: super_admin / admin)
      if (
        (email.trim().toLowerCase() === 'admin@amardokan.bd' || email.trim().toLowerCase() === 'admin@example.com') &&
        password.trim() === 'admin123'
      ) {
        setLoading(false);
        onSuccess();
      } else {
        setLoading(false);
        setError('Access Denied: You do not possess administrative privileges.');
      }
    }, 400);
  };

  return (
    <div className="min-h-[75vh] flex items-center justify-center px-4 py-12 bg-stone-950 rounded-2xl my-6">
      <div className="w-full max-w-md bg-stone-900 rounded-2xl shadow-2xl border border-stone-800 overflow-hidden">
        {/* Header */}
        <div className="p-6 sm:p-8 text-center border-b border-stone-800 bg-stone-950/70">
          <div className="w-12 h-12 rounded-xl bg-orange-600 flex items-center justify-center text-white font-black text-2xl mx-auto mb-3 shadow-lg shadow-orange-600/20">
            <Lock className="w-6 h-6 text-white" />
          </div>
          <h1 className="text-xl font-black tracking-tight text-white">AmarDokan Internal Operations</h1>
          <p className="text-xs text-stone-400 mt-1">Authorized Administrative Personnel Only</p>
          <div className="mt-3 inline-flex items-center gap-1.5 px-3 py-1 bg-red-950/80 border border-red-800/40 rounded-full text-[10px] font-bold text-red-300">
            <span className="w-1.5 h-1.5 rounded-full bg-red-500 animate-ping"></span>
            <span>Restricted Gateway: Access Logged & Audited</span>
          </div>
        </div>

        <div className="p-6 sm:p-8">
          {error && (
            <div className="mb-5 p-3.5 bg-red-950/80 border border-red-800/50 text-red-200 text-xs rounded-xl flex items-start gap-2">
              <AlertCircle className="w-4 h-4 text-red-400 shrink-0 mt-0.5" />
              <span>{error}</span>
            </div>
          )}

          <div className="mb-4 p-3 bg-stone-800/60 border border-stone-700/50 rounded-xl text-stone-300 text-[11px] space-y-1">
            <div className="text-stone-400 font-semibold">Demo Administrator Credentials:</div>
            <div>Email: <strong className="text-orange-400">admin@amardokan.bd</strong></div>
            <div>Password: <strong className="text-stone-200">admin123</strong></div>
          </div>

          <form onSubmit={handleSubmit} className="space-y-4">
            <div>
              <label className="block text-xs font-bold text-stone-300 mb-1">Administrative Email</label>
              <input
                type="email"
                value={email}
                onChange={(e) => setEmail(e.target.value)}
                placeholder="admin@amardokan.bd"
                required
                className="w-full px-3.5 py-2.5 bg-stone-950 border border-stone-700 rounded-xl text-xs sm:text-sm text-white placeholder-stone-500 focus:outline-hidden focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all"
              />
            </div>

            <div>
              <label className="block text-xs font-bold text-stone-300 mb-1">Administrative Secret Key</label>
              <input
                type="password"
                value={password}
                onChange={(e) => setPassword(e.target.value)}
                placeholder="••••••••••••"
                required
                className="w-full px-3.5 py-2.5 bg-stone-950 border border-stone-700 rounded-xl text-xs sm:text-sm text-white placeholder-stone-500 focus:outline-hidden focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all"
              />
            </div>

            <button
              type="submit"
              disabled={loading}
              className="w-full py-3 bg-gradient-to-r from-orange-600 to-amber-600 hover:from-orange-500 hover:to-amber-500 text-white font-extrabold text-xs sm:text-sm rounded-xl transition-all shadow-lg shadow-orange-950 flex items-center justify-center gap-2 cursor-pointer disabled:opacity-50"
            >
              <Shield className="w-4 h-4" />
              <span>{loading ? 'Verifying Credentials...' : 'Verify Privileges & Enter Console'}</span>
            </button>
          </form>

          <div className="mt-6 pt-5 border-t border-stone-800 text-center">
            <button
              onClick={onBackToStore}
              className="text-[11px] text-stone-400 hover:text-stone-200 inline-flex items-center gap-1.5 transition-colors cursor-pointer"
            >
              <ArrowLeft className="w-3.5 h-3.5" />
              <span>Return to Public Storefront</span>
            </button>
          </div>
        </div>
      </div>
    </div>
  );
};
