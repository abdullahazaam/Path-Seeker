@extends('layouts.app')
@section('title', 'Edit Profile & Account Settings — PathSeeker')
@section('content')

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 space-y-8">

    {{-- Breadcrumbs & Back Navigation --}}
    <div class="flex items-center justify-between gap-4">
        <div class="flex items-center gap-2 text-xs font-mono text-slate-500 dark:text-slate-400">
            <a href="{{ route('dashboard') }}" class="hover:text-purple-600 dark:hover:text-purple-400 transition-colors">Dashboard</a>
            <span>/</span>
            <span class="text-slate-800 dark:text-slate-200 font-bold">Profile &amp; Settings</span>
        </div>

        <a href="{{ route('dashboard') }}" class="px-4 py-2 rounded-xl bg-slate-100 dark:bg-white/5 hover:bg-slate-200 dark:hover:bg-white/10 text-xs font-bold text-slate-700 dark:text-slate-300 transition-all inline-flex items-center gap-1.5 shadow-sm">
            <i class="fa-solid fa-arrow-left text-[10px]"></i>
            <span>Back to Dashboard</span>
        </a>
    </div>

    {{-- Header Banner --}}
    <div class="p-8 sm:p-10 rounded-3xl bg-white dark:bg-[#080B12] border border-slate-200 dark:border-white/10 shadow-2xl flex flex-col sm:flex-row items-start sm:items-center justify-between gap-6">
        <div class="flex items-center gap-5">
            <div class="w-16 h-16 sm:w-20 sm:h-20 rounded-3xl bg-gradient-to-tr from-cyan-400 via-sky-500 to-blue-600 flex items-center justify-center text-slate-950 font-black text-2xl sm:text-3xl shadow-md shrink-0">
                {{ substr($user->name, 0, 1) }}
            </div>
            <div class="space-y-1">
                <div class="flex items-center gap-2">
                    <h1 class="text-xl sm:text-2xl font-black text-slate-900 dark:text-white font-display">{{ $user->name }}</h1>
                    <span class="px-2.5 py-0.5 rounded-full text-[10px] font-black uppercase font-mono {{ $user->role === 'admin' ? 'bg-rose-500/15 text-rose-700 dark:text-rose-400 border border-rose-500/25' : 'bg-cyan-500/15 text-cyan-700 dark:text-cyan-300 border border-cyan-500/25' }}">
                        {{ $user->role }}
                    </span>
                </div>
                <p class="text-xs sm:text-sm text-slate-500 dark:text-slate-400 font-mono">{{ $user->email }}</p>
            </div>
        </div>

        <div class="text-xs text-slate-400 font-mono">
            Member since {{ $user->created_at->format('M Y') }}
        </div>
    </div>

    {{-- Edit Profile Form --}}
    <div class="p-6 sm:p-10 rounded-3xl bg-white dark:bg-[#080B12] border border-slate-200 dark:border-white/10 shadow-xl space-y-8">
        
        <div class="border-b border-slate-200 dark:border-white/10 pb-4">
            <h2 class="text-lg font-black text-slate-900 dark:text-white font-display flex items-center gap-2">
                <i class="fa-solid fa-user-pen text-indigo-500"></i>
                <span>Personal &amp; Academic Credentials</span>
            </h2>
            <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">Update your personal account credentials and career preferences.</p>
        </div>

        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Full Name --}}
                <div>
                    <label for="name" class="block text-xs font-bold text-slate-700 dark:text-slate-300 uppercase font-mono mb-1.5">Full Name</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required class="w-full px-4 py-3 rounded-2xl bg-slate-50 dark:bg-slate-950 border border-slate-300 dark:border-white/10 text-xs sm:text-sm text-slate-900 dark:text-white focus:ring-2 focus:ring-indigo-500">
                    @error('name')
                        <p class="text-rose-500 text-xs mt-1 font-mono">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Email Address --}}
                <div>
                    <label for="email" class="block text-xs font-bold text-slate-700 dark:text-slate-300 uppercase font-mono mb-1.5">Email Address</label>
                    <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required class="w-full px-4 py-3 rounded-2xl bg-slate-50 dark:bg-slate-950 border border-slate-300 dark:border-white/10 text-xs sm:text-sm text-slate-900 dark:text-white focus:ring-2 focus:ring-indigo-500">
                    @error('email')
                        <p class="text-rose-500 text-xs mt-1 font-mono">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Education Level --}}
                <div>
                    <label for="education_level" class="block text-xs font-bold text-slate-700 dark:text-slate-300 uppercase font-mono mb-1.5">Education / Career Level</label>
                    <input type="text" name="education_level" id="education_level" value="{{ old('education_level', $profile->education_level) }}" placeholder="e.g. Undergraduate / Senior Software Engineer" class="w-full px-4 py-3 rounded-2xl bg-slate-50 dark:bg-slate-950 border border-slate-300 dark:border-white/10 text-xs sm:text-sm text-slate-900 dark:text-white focus:ring-2 focus:ring-indigo-500">
                </div>

                {{-- Career Interests --}}
                <div>
                    <label for="interests" class="block text-xs font-bold text-slate-700 dark:text-slate-300 uppercase font-mono mb-1.5">Primary Focus / Specializations</label>
                    <input type="text" name="interests" id="interests" value="{{ old('interests', $profile->interests) }}" placeholder="e.g. AI Architecture, Full-Stack Development, Cloud Ops" class="w-full px-4 py-3 rounded-2xl bg-slate-50 dark:bg-slate-950 border border-slate-300 dark:border-white/10 text-xs sm:text-sm text-slate-900 dark:text-white focus:ring-2 focus:ring-indigo-500">
                    @error('interests')
                        <p class="text-rose-500 text-xs mt-1 font-mono">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Technical & Professional Skills Section --}}
            <div class="p-5 sm:p-6 rounded-2xl bg-slate-50 dark:bg-slate-950/60 border border-slate-200 dark:border-white/10 space-y-3">
                <div class="flex items-center justify-between">
                    <label for="skills" class="block text-xs font-bold text-slate-900 dark:text-white font-display uppercase tracking-wider flex items-center gap-2">
                        <i class="fa-solid fa-code text-cyan-500"></i>
                        <span>Technical &amp; Domain Skills</span>
                    </label>
                    <span class="text-[11px] text-slate-400 font-mono">Comma-separated</span>
                </div>
                <p class="text-[11px] text-slate-500 dark:text-slate-400">
                    List your programming languages, frameworks, cloud tools, or methodologies (e.g. <code class="font-mono text-cyan-600 dark:text-cyan-400 font-semibold">Laravel, PHP, Vue.js, Tailwind CSS, Docker, PostgreSQL, CI/CD</code>).
                </p>
                <textarea name="skills" id="skills" rows="3" placeholder="Laravel, PHP, Python, JavaScript, TypeScript, React, Tailwind CSS, Docker, MySQL, AWS..." class="w-full px-4 py-3 rounded-2xl bg-white dark:bg-slate-900 border border-slate-300 dark:border-white/10 text-xs sm:text-sm text-slate-900 dark:text-white focus:ring-2 focus:ring-cyan-500 leading-relaxed">{{ old('skills', $profile->skills) }}</textarea>
                @error('skills')
                    <p class="text-rose-500 text-xs mt-1 font-mono">{{ $message }}</p>
                @enderror
                @if(!empty($profile->skills))
                    <div class="pt-2 flex flex-wrap gap-1.5 items-center">
                        <span class="text-[10px] font-mono font-bold text-slate-400 uppercase mr-1">Active Skills:</span>
                        @foreach(array_filter(array_map('trim', explode(',', $profile->skills))) as $skillBadge)
                            <span class="px-2.5 py-1 rounded-lg text-xs font-medium bg-cyan-500/10 text-cyan-700 dark:text-cyan-300 border border-cyan-500/20 font-mono inline-flex items-center gap-1">
                                <i class="fa-solid fa-check text-[9px] text-cyan-500"></i>
                                <span>{{ $skillBadge }}</span>
                            </span>
                        @endforeach
                    </div>
                @endif
            </div>

            {{-- Work Experience & Professional Milestones Section --}}
            <div class="p-5 sm:p-6 rounded-2xl bg-slate-50 dark:bg-slate-950/60 border border-slate-200 dark:border-white/10 space-y-3">
                <div class="flex items-center justify-between">
                    <label for="work_experience" class="block text-xs font-bold text-slate-900 dark:text-white font-display uppercase tracking-wider flex items-center gap-2">
                        <i class="fa-solid fa-briefcase text-purple-500"></i>
                        <span>Work Experience &amp; Career Journey</span>
                    </label>
                    <span class="text-[11px] text-slate-400 font-mono">Roles &amp; Milestones</span>
                </div>
                <p class="text-[11px] text-slate-500 dark:text-slate-400">
                    Detail previous employment, internships, open-source projects, or engineering milestones.
                </p>
                <textarea name="work_experience" id="work_experience" rows="4" placeholder="e.g.
• Senior Full-Stack Engineer at Zynex Technologies (2023 - Present) — Architected high-throughput microservices and responsive Blade frontends.
• Backend Developer at CloudScale Inc (2021 - 2023) — Engineered secure RESTful APIs, optimized SQL queries, and automated CI/CD pipelines." class="w-full px-4 py-3 rounded-2xl bg-white dark:bg-slate-900 border border-slate-300 dark:border-white/10 text-xs sm:text-sm text-slate-900 dark:text-white focus:ring-2 focus:ring-purple-500 leading-relaxed font-sans">{{ old('work_experience', $profile->work_experience) }}</textarea>
                @error('work_experience')
                    <p class="text-rose-500 text-xs mt-1 font-mono">{{ $message }}</p>
                @enderror
            </div>

            {{-- Resume Document Upload & Download Section --}}
            <div class="p-5 rounded-2xl bg-slate-50 dark:bg-slate-950/60 border border-slate-200 dark:border-white/10 space-y-4">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                    <div class="space-y-1">
                        <label for="resume" class="block text-xs font-bold text-slate-900 dark:text-white font-display uppercase tracking-wider flex items-center gap-2">
                            <i class="fa-solid fa-file-arrow-up text-indigo-500"></i>
                            <span>Career Resume &amp; CV (PDF, DOCX)</span>
                        </label>
                        <p class="text-[11px] text-slate-500 dark:text-slate-400">
                            Upload your updated resume for talent matching and toolkit evaluation (Max 10MB).
                        </p>
                    </div>

                    @if(!empty($profile->resume_path))
                        <a href="{{ route('profile.resume.download') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl text-xs font-bold text-emerald-600 dark:text-emerald-400 bg-emerald-500/10 border border-emerald-500/20 hover:bg-emerald-500/20 transition-all shrink-0">
                            <i class="fa-solid fa-cloud-arrow-down text-xs"></i>
                            <span>Download Resume</span>
                        </a>
                    @endif
                </div>

                <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3">
                    <input type="file" 
                           name="resume" 
                           id="resume" 
                           accept=".pdf,.docx,.doc"
                           class="w-full px-4 py-2.5 rounded-xl bg-white dark:bg-slate-900 border border-slate-300 dark:border-white/10 text-xs text-slate-700 dark:text-slate-300 file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-bold file:bg-indigo-500/15 file:text-indigo-600 dark:file:text-indigo-300 hover:file:bg-indigo-500/25 cursor-pointer">
                </div>

                @if(!empty($profile->resume_path))
                    <div class="flex items-center gap-2 text-[11px] text-slate-500 dark:text-slate-400 font-mono">
                        <i class="fa-solid fa-circle-check text-emerald-500"></i>
                        <span>Current file: <strong>{{ $profile->resume_filename ?? 'resume.pdf' }}</strong></span>
                        @if($profile->resume_updated_at)
                            <span class="text-slate-400 dark:text-slate-600">&bull; Uploaded {{ \Carbon\Carbon::parse($profile->resume_updated_at)->diffForHumans() }}</span>
                        @endif
                    </div>
                @endif

                @error('resume')
                    <p class="text-rose-500 text-xs font-mono">{{ $message }}</p>
                @enderror
            </div>

            {{-- Security & Password Change Section --}}
            <div class="pt-6 border-t border-slate-200 dark:border-white/10 space-y-6">
                <div>
                    <h3 class="text-sm font-black text-slate-900 dark:text-white font-display flex items-center gap-2">
                        <i class="fa-solid fa-lock text-purple-500"></i>
                        <span>Security &amp; Password Update (Optional)</span>
                    </h3>
                    <p class="text-xs text-slate-500 dark:text-slate-400 mt-0.5">Leave blank unless you wish to change your account password.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label for="current_password" class="block text-xs font-bold text-slate-700 dark:text-slate-300 uppercase font-mono mb-1.5">Current Password</label>
                        <input type="password" name="current_password" id="current_password" placeholder="••••••••" class="w-full px-4 py-2.5 rounded-xl bg-slate-50 dark:bg-slate-950 border border-slate-300 dark:border-white/10 text-xs sm:text-sm text-slate-900 dark:text-white focus:ring-2 focus:ring-purple-500">
                        @error('current_password')
                            <p class="text-rose-500 text-xs mt-1 font-mono">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="new_password" class="block text-xs font-bold text-slate-700 dark:text-slate-300 uppercase font-mono mb-1.5">New Password</label>
                        <input type="password" name="new_password" id="new_password" placeholder="••••••••" class="w-full px-4 py-2.5 rounded-xl bg-slate-50 dark:bg-slate-950 border border-slate-300 dark:border-white/10 text-xs sm:text-sm text-slate-900 dark:text-white focus:ring-2 focus:ring-purple-500">
                        @error('new_password')
                            <p class="text-rose-500 text-xs mt-1 font-mono">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="new_password_confirmation" class="block text-xs font-bold text-slate-700 dark:text-slate-300 uppercase font-mono mb-1.5">Confirm New Password</label>
                        <input type="password" name="new_password_confirmation" id="new_password_confirmation" placeholder="••••••••" class="w-full px-4 py-2.5 rounded-xl bg-slate-50 dark:bg-slate-950 border border-slate-300 dark:border-white/10 text-xs sm:text-sm text-slate-900 dark:text-white focus:ring-2 focus:ring-purple-500">
                    </div>
                </div>
            </div>

            <div class="pt-6 border-t border-slate-200 dark:border-white/10 flex items-center justify-end gap-4">
                <a href="{{ route('dashboard') }}" class="px-6 py-3 rounded-full text-xs font-bold text-slate-700 dark:text-slate-300 bg-slate-100 dark:bg-white/5 hover:bg-slate-200 dark:hover:bg-white/10 transition-all">
                    Cancel
                </a>
                <button type="submit" class="btn-sweep px-8 py-3 rounded-full font-black text-xs text-slate-950 bg-gradient-to-r from-[#00f2fe] via-sky-400 to-blue-600 shadow-md hover:scale-105 transition-all cursor-pointer">
                    <span>Save Changes</span>
                </button>
            </div>
        </form>

    </div>

</div>

@endsection
