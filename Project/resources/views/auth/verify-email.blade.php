@extends('layouts.app')
@section('title', 'Verify Email Address — PathSeeker')
@section('content')

<section class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-6 sm:pt-10 pb-16">
    <div class="max-w-lg mx-auto">
        <div class="relative bg-white dark:bg-[#080B12] border border-slate-200 dark:border-white/10 shadow-2xl dark:shadow-[0_8px_32px_0_rgba(0,0,0,0.37)] rounded-3xl p-6 sm:p-8 overflow-hidden space-y-6">
            
            {{-- Ambient Corner Glows --}}
            <div class="absolute -top-16 -right-16 w-48 h-48 rounded-full bg-purple-500/15 dark:bg-purple-500/20 blur-3xl pointer-events-none"></div>
            <div class="absolute -bottom-16 -left-16 w-48 h-48 rounded-full bg-cyan-500/10 dark:bg-cyan-500/15 blur-3xl pointer-events-none"></div>

            <div class="relative z-10 text-center space-y-3">
                <div class="w-14 h-14 rounded-2xl bg-gradient-to-tr from-cyan-400 via-sky-500 to-blue-600 flex items-center justify-center text-slate-950 text-2xl shadow-md mx-auto font-black">
                    <i class="fa-solid fa-envelope-circle-check text-slate-950"></i>
                </div>

                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-cyan-500/10 dark:bg-cyan-500/20 border border-cyan-500/20 text-xs font-mono font-bold text-cyan-700 dark:text-cyan-300">
                    <span class="w-2 h-2 rounded-full bg-cyan-500 animate-ping"></span>
                    <span>Step 2 of 2: Security Verification</span>
                </div>

                <h1 class="text-2xl sm:text-3xl font-black text-slate-900 dark:text-white font-display tracking-tight">
                    Verify Your Email Address
                </h1>

                <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-400 leading-relaxed max-w-md mx-auto">
                    Thanks for registering for your Career Passport! Before you can access your dashboard and explore career intelligence pathways, please verify your email address by clicking on the link we just sent to <strong class="text-slate-900 dark:text-white">{{ Auth::user()->email ?? 'your inbox' }}</strong>.
                </p>
            </div>

            {{-- Status Banner --}}
            @if (session('status') == 'verification-link-sent')
                <div class="p-4 rounded-2xl bg-emerald-500/10 border border-emerald-500/25 text-emerald-700 dark:text-emerald-300 text-xs font-semibold flex items-center gap-3">
                    <i class="fa-solid fa-circle-check text-emerald-500 text-base shrink-0"></i>
                    <span>A new verification link has been dispatched to your registered email address.</span>
                </div>
            @endif

            {{-- Resend & Actions --}}
            <div class="relative z-10 space-y-4 pt-2">
                <form action="{{ route('verification.send') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn-sweep group w-full py-3.5 rounded-full font-black text-xs sm:text-sm text-slate-950 bg-gradient-to-r from-[#00f2fe] via-sky-400 to-blue-600 hover:from-cyan-300 hover:to-blue-500 shadow-[0_0_20px_rgba(0,242,254,0.35)] transition-all duration-300 flex items-center justify-center gap-2 hover:scale-[1.02] cursor-pointer">
                        <i class="fa-solid fa-paper-plane text-xs text-slate-950"></i>
                        <span class="text-slate-950 font-black">Resend Verification Email</span>
                    </button>
                </form>

                <div class="flex items-center justify-between pt-4 border-t border-slate-200/80 dark:border-white/10 text-xs">
                    <span class="text-slate-500 dark:text-slate-400">Need to switch accounts?</span>
                    <form action="{{ url('/logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="font-bold text-rose-600 dark:text-rose-400 hover:underline flex items-center gap-1.5 cursor-pointer">
                            <i class="fa-solid fa-arrow-right-from-bracket text-xs"></i>
                            <span>Sign Out</span>
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</section>

@endsection
