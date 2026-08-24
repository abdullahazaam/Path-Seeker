@extends('layouts.app')
@section('title', 'Create Passport — PathSeeker')
@section('content')

<div class="min-h-[calc(100vh-16rem)] flex items-center justify-center px-4 py-8">
    <div class="w-full max-w-lg space-y-8">

        <!-- Brand Emblem -->
        <div class="text-center space-y-3">
            <div class="relative inline-block">
                <div class="w-16 h-16 mx-auto rounded-full bg-gradient-to-tr from-indigo-600 via-purple-600 to-pink-600 flex items-center justify-center text-white font-black text-2xl shadow-neon-purple">
                    <i class="fa-solid fa-compass text-white"></i>
                </div>
                <div class="absolute inset-0 rounded-full bg-gradient-to-tr from-indigo-500 via-purple-500 to-pink-500 blur-xl opacity-50 -z-10"></div>
            </div>
            <div>
                <h1 class="text-3xl sm:text-4xl font-black text-slate-900 dark:text-white font-display">Create Career Passport</h1>
                <p class="text-xs sm:text-sm text-slate-700 dark:text-slate-400 mt-1">Unlock personalized career maps, skills tests, and toolkits</p>
            </div>
        </div>

        <!-- Glass Container -->
        <div class="relative glass-panel rounded-3xl p-8 sm:p-9 border border-slate-200/80 dark:border-white/10 shadow-2xl overflow-hidden">
            <div class="relative z-10 space-y-5">
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

                <form action="{{ route('register') }}" method="POST" class="space-y-4">
                    @csrf

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="first_name" class="block text-xs font-black uppercase tracking-widest text-slate-700 dark:text-slate-400 mb-2 flex items-center gap-1.5">
                                <i class="fa-solid fa-user text-indigo-600 dark:text-indigo-400 text-xs"></i>
                                <span>First Name</span>
                            </label>
                            <input type="text" name="first_name" id="first_name" value="{{ old('first_name') }}" required
                                   placeholder="e.g. Alex"
                                   class="app-input w-full px-4 py-3 rounded-2xl text-sm">
                        </div>
                        <div>
                            <label for="last_name" class="block text-xs font-black uppercase tracking-widest text-slate-700 dark:text-slate-400 mb-2 flex items-center gap-1.5">
                                <i class="fa-solid fa-user text-indigo-600 dark:text-indigo-400 text-xs"></i>
                                <span>Last Name</span>
                            </label>
                            <input type="text" name="last_name" id="last_name" value="{{ old('last_name') }}" required
                                   placeholder="e.g. Rivera"
                                   class="app-input w-full px-4 py-3 rounded-2xl text-sm">
                        </div>
                    </div>

                    <div>
                        <label for="email" class="block text-xs font-black uppercase tracking-widest text-slate-700 dark:text-slate-400 mb-2 flex items-center gap-1.5">
                            <i class="fa-solid fa-envelope text-indigo-600 dark:text-indigo-400 text-xs"></i>
                            <span>Email Address</span>
                        </label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}" required
                               placeholder="alex@example.com"
                               class="app-input w-full px-4 py-3 rounded-2xl text-sm">
                    </div>

                    <div>
                        <label for="role" class="block text-xs font-black uppercase tracking-widest text-slate-700 dark:text-slate-400 mb-2 flex items-center gap-1.5">
                            <i class="fa-solid fa-id-card-clip text-purple-600 dark:text-purple-400 text-xs"></i>
                            <span>Select Your Stage</span>
                        </label>
                        <select name="role" id="role" required class="app-input w-full px-4 py-3 rounded-2xl text-sm">
                            <option value="" disabled {{ old('role') ? '' : 'selected' }}>-- Choose Your Role --</option>
                            <option value="student" {{ old('role') === 'student' ? 'selected' : '' }}>Student (College / University)</option>
                            <option value="graduate" {{ old('role') === 'graduate' ? 'selected' : '' }}>Recent Graduate (Entry Level / Job Seeker)</option>
                            <option value="professional" {{ old('role') === 'professional' ? 'selected' : '' }}>Working Professional (Mid / Senior Career)</option>
                        </select>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="password" class="block text-xs font-black uppercase tracking-widest text-slate-700 dark:text-slate-400 mb-2 flex items-center gap-1.5">
                                <i class="fa-solid fa-lock text-purple-600 dark:text-purple-400 text-xs"></i>
                                <span>Password</span>
                            </label>
                            <input type="password" name="password" id="password" required
                                   placeholder="••••••••"
                                   class="app-input w-full px-4 py-3 rounded-2xl text-sm">
                        </div>
                        <div>
                            <label for="password_confirmation" class="block text-xs font-black uppercase tracking-widest text-slate-700 dark:text-slate-400 mb-2 flex items-center gap-1.5">
                                <i class="fa-solid fa-shield text-purple-600 dark:text-purple-400 text-xs"></i>
                                <span>Confirm</span>
                            </label>
                            <input type="password" name="password_confirmation" id="password_confirmation" required
                                   placeholder="••••••••"
                                   class="app-input w-full px-4 py-3 rounded-2xl text-sm">
                        </div>
                    </div>

                    <div>
                        <label for="education_level" class="block text-xs font-black uppercase tracking-widest text-slate-700 dark:text-slate-400 mb-2 flex items-center gap-1.5">
                            <i class="fa-solid fa-graduation-cap text-sky-600 dark:text-sky-400 text-xs"></i>
                            <span>Education Level</span>
                        </label>
                        <input type="text" name="education_level" id="education_level" value="{{ old('education_level') }}"
                               placeholder="e.g. Undergraduate, B.S. Computer Science"
                               class="app-input w-full px-4 py-3 rounded-2xl text-sm">
                    </div>

                    <div>
                        <label for="interests" class="block text-xs font-black uppercase tracking-widest text-slate-700 dark:text-slate-400 mb-2 flex items-center gap-1.5">
                            <i class="fa-solid fa-heart text-pink-600 dark:text-pink-400 text-xs"></i>
                            <span>Career Interests</span>
                        </label>
                        <input type="text" name="interests" id="interests" value="{{ old('interests') }}"
                               placeholder="e.g. Full-Stack, Cloud, AI, Security"
                               class="app-input w-full px-4 py-3 rounded-2xl text-sm">
                    </div>

                    <button type="submit" class="group w-full py-4 rounded-full font-black text-sm text-white bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 hover:from-indigo-500 hover:via-purple-500 hover:to-pink-500 shadow-neon-purple hover:shadow-neon-pink transition-all duration-300 flex items-center justify-center gap-2 hover:scale-[1.02]">
                        <i class="fa-solid fa-passport text-xs text-white"></i>
                        <span class="text-white">Register &amp; Enter Passport</span>
                        <i class="fa-solid fa-arrow-right text-xs text-white group-hover:translate-x-1.5 transition-transform"></i>
                    </button>
                </form>

                <div class="pt-4 border-t border-slate-200/80 dark:border-white/10 text-center text-xs text-slate-700 dark:text-slate-400">
                    Already registered?
                    <a href="{{ route('login') }}" class="font-bold text-indigo-600 dark:text-indigo-400 hover:text-purple-600 dark:hover:text-purple-300 transition-colors ml-1">Sign In &rarr;</a>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection