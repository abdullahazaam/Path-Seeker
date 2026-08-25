<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'PathSeeker - Career Passport')</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#2563eb',
                        secondary: '#4f46e5',
                        accent: '#06b6d4',
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-slate-50 text-slate-900 min-h-screen flex flex-col font-sans antialiased">
    <!-- Top Navigation Bar -->
    <nav class="bg-white border-b border-slate-200 shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center space-x-6 lg:space-x-8">
                    <a href="{{ route('home') }}" class="flex items-center space-x-2">
                        <div class="w-9 h-9 bg-gradient-to-tr from-blue-600 to-indigo-600 rounded-lg flex items-center justify-center text-white font-bold text-xl shadow-sm">
                            P
                        </div>
                        <span class="text-xl font-extrabold tracking-tight bg-gradient-to-r from-blue-600 to-indigo-700 bg-clip-text text-transparent">
                            PathSeeker
                        </span>
                        <span class="hidden sm:inline-block px-2 py-0.5 text-xs font-semibold bg-blue-100 text-blue-800 rounded-full">
                            Passport
                        </span>
                    </a>

                    <div class="hidden md:flex space-x-2 lg:space-x-3">
                        <a href="{{ route('home') }}" class="px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('home') ? 'text-blue-600 bg-blue-50 font-semibold' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100' }}">
                            Home
                        </a>
                        <a href="{{ route('careers.index') }}" class="px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('careers.*') ? 'text-blue-600 bg-blue-50 font-semibold' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100' }}">
                            Career Bank
                        </a>
                        <a href="{{ route('quiz.index') }}" class="px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('quiz.*') ? 'text-blue-600 bg-blue-50 font-semibold' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100' }}">
                            Interest Quiz
                        </a>
                        <a href="{{ route('multimedia.index') }}" class="px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('multimedia.*') ? 'text-blue-600 bg-blue-50 font-semibold' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100' }}">
                            Multimedia
                        </a>
                        <a href="{{ route('resources.index') }}" class="px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('resources.*') ? 'text-blue-600 bg-blue-50 font-semibold' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100' }}">
                            Resources
                        </a>
                    </div>
                </div>

                <div class="flex items-center space-x-3">
                    @auth
                        <div class="hidden sm:flex items-center space-x-2 pr-2">
                            <span class="text-xs font-semibold text-slate-700">{{ Auth::user()->name }}</span>
                            <span class="text-[10px] uppercase font-extrabold px-2 py-0.5 bg-blue-100 text-blue-800 rounded-full">
                                {{ Auth::user()->role }}
                            </span>
                        </div>
                        <a href="{{ route('dashboard') }}" class="inline-flex items-center px-3.5 py-1.5 text-xs sm:text-sm font-medium rounded-lg text-white bg-blue-600 hover:bg-blue-700 shadow-sm transition">
                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                            Dashboard
                        </a>
                        <form action="{{ url('/logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="px-3 py-1.5 text-xs text-slate-600 hover:text-rose-600 font-medium">
                                Logout
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="px-3 py-1.5 text-sm font-medium text-slate-700 hover:text-blue-600">
                            Sign In
                        </a>
                        <a href="{{ route('register') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium rounded-lg text-white bg-blue-600 hover:bg-blue-700 shadow-sm transition">
                            Register
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Flash Messages -->
    @include('components.flash-message')

    <!-- Main Content Area -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t border-slate-200 py-8 mt-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col sm:flex-row items-center justify-between text-sm text-slate-500">
            <div class="flex items-center space-x-2 mb-4 sm:mb-0">
                <span class="font-bold text-slate-700">PathSeeker - Career Passport</span>
                <span>&copy; {{ date('Y') }} All rights reserved.</span>
            </div>
            <div class="flex space-x-6">
                <a href="{{ route('careers.index') }}" class="hover:text-slate-800">Careers</a>
                <a href="{{ route('quiz.index') }}" class="hover:text-slate-800">Interest Quiz</a>
                <a href="{{ route('multimedia.index') }}" class="hover:text-slate-800">Media Center</a>
                <a href="{{ route('resources.index') }}" class="hover:text-slate-800">Resource Library</a>
                <a href="{{ route('dashboard') }}" class="hover:text-slate-800">Passport Dashboard</a>
            </div>
        </div>
    </footer>
</body>
</html>
