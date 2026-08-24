@extends('layouts.app')
@section('title', 'Sign In — PathSeeker')
@section('content')

<div class="min-h-[calc(100vh-16rem)] flex items-center justify-center px-4 py-8">
    <div class="w-full max-w-md space-y-8">

        <!-- Brand Emblem -->
        <div class="text-center space-y-3">
            <div class="relative inline-block">
                <div class="w-16 h-16 mx-auto rounded-full bg-gradient-to-tr from-indigo-600 via-purple-600 to-pink-600 flex items-center justify-center text-white font-black text-2xl shadow-neon-purple">
                    <i class="fa-solid fa-compass text-white"></i>
                </div>
                <div class="absolute inset-0 rounded-full bg-gradient-to-tr from-indigo-500 via-purple-500 to-pink-500 blur-xl opacity-50 -z-10"></div>
            </div>
            <div>
                <h1 class="text-3xl sm:text-4xl font-black text-slate-900 dark:text-white font-display">Welcome Back</h1>
                <p class="text-xs sm:text-sm text-slate-700 dark:text-slate-400 mt-1">Sign in to your intelligent career passport</p>
            </div>
        </div>

        <!-- Glass Auth Container -->
        <div class="relative glass-panel rounded-3xl p-8 sm:p-9 border border-slate-200/80 dark:border-white/10 shadow-2xl overflow-hidden">
            <div class="relative z-10 space-y-6">
                @if($errors->any())
                    <div class="glass-panel border border-rose-500/30 text-rose-700 dark:text-rose-300 px-4 py-3 rounded-2xl text-xs space-y-1">
                        @foreach($errors->all() as $error)
                            <div class="flex items-center gap-2">
                                <i class="fa-solid fa-circle-exclamation text-rose-500 text-xs"></i>
                                <span>{{ $error }}</span>
                            </div>
                        @endforeach
                    </div>
                @endif

                <form action="{{ url('/login') }}" method="POST" class="space-y-5">
                    @csrf
                    <div>
                        <label for="email" class="block text-xs font-black uppercase tracking-widest text-slate-700 dark:text-slate-400 mb-2 flex items-center gap-1.5">
                            <i class="fa-solid fa-envelope text-indigo-600 dark:text-indigo-400 text-xs"></i>
                            <span>Email Address</span>
                        </label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus
                               placeholder="you@example.com"
                               class="app-input w-full px-4 py-3.5 rounded-2xl text-sm">
                    </div>

                    <div>
                        <label for="password" class="block text-xs font-black uppercase tracking-widest text-slate-700 dark:text-slate-400 mb-2 flex items-center gap-1.5">
                            <i class="fa-solid fa-lock text-purple-600 dark:text-purple-400 text-xs"></i>
                            <span>Password</span>
                        </label>
                        <input type="password" name="password" id="password" required
                               placeholder="••••••••"
                               class="app-input w-full px-4 py-3.5 rounded-2xl text-sm">
                    </div>

                    <div class="flex items-center justify-between text-xs">
                        <label class="flex items-center gap-2 text-slate-700 dark:text-slate-400 cursor-pointer select-none">
                            <input type="checkbox" name="remember" id="remember" class="w-4 h-4 rounded border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900 text-purple-600 focus:ring-purple-500">
                            <span>Remember this device</span>
                        </label>
                    </div>

                    <button type="submit" class="group w-full py-4 rounded-full font-black text-sm text-white bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 hover:from-indigo-500 hover:via-purple-500 hover:to-pink-500 shadow-neon-purple hover:shadow-neon-pink transition-all duration-300 flex items-center justify-center gap-2 hover:scale-[1.02]">
                        <i class="fa-solid fa-right-to-bracket text-xs text-white"></i>
                        <span class="text-white">Sign In to Passport</span>
                        <i class="fa-solid fa-arrow-right text-xs text-white group-hover:translate-x-1.5 transition-transform"></i>
                    </button>
                </form>

                <div class="pt-4 border-t border-slate-200/80 dark:border-white/10 text-center text-xs text-slate-700 dark:text-slate-400">
                    Don't have an account yet?
                    <a href="{{ route('register') }}" class="font-bold text-indigo-600 dark:text-indigo-400 hover:text-purple-600 dark:hover:text-purple-300 transition-colors ml-1">Create Career Passport &rarr;</a>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection