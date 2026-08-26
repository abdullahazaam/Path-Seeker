<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PathSeeker — Career Passport</title>
    
    <script>
        (function() {
            try {
                var theme = localStorage.getItem('theme');
                var prefersDark = window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;
                if (theme === 'light' || (!theme && !prefersDark)) {
                    document.documentElement.classList.remove('dark');
                    document.documentElement.setAttribute('data-theme', 'light');
                } else {
                    document.documentElement.classList.add('dark');
                    document.documentElement.setAttribute('data-theme', 'dark');
                }
            } catch (e) {
                document.documentElement.classList.add('dark');
                document.documentElement.setAttribute('data-theme', 'dark');
            }
        })();
    </script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
        }
    </script>
    <style>
        body { font-family: 'Plus Jakarta Sans', system-ui, sans-serif; }
        .glass-panel {
            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);
        }
    </style>
</head>
<body class="bg-[#F8F9FC] dark:bg-[#06080f] text-[#111827] dark:text-white flex items-center justify-center min-h-screen p-4 relative overflow-hidden transition-colors duration-500">
    <!-- Atmospheric Ambient Glows -->
    <div class="absolute w-96 h-96 bg-purple-500/5 dark:bg-purple-600/20 rounded-full blur-3xl -top-20 -left-20 pointer-events-none"></div>
    <div class="absolute w-80 h-80 bg-cyan-500/5 dark:bg-indigo-600/20 rounded-full blur-3xl -bottom-20 -right-20 pointer-events-none"></div>

    <div class="relative z-10 glass-panel bg-white dark:bg-white/[0.03] border border-slate-200/80 dark:border-white/10 shadow-2xl dark:shadow-[0_8px_32px_0_rgba(0,0,0,0.37)] rounded-3xl p-10 max-w-md w-full text-center space-y-6">
        <div class="w-16 h-16 mx-auto rounded-2xl bg-gradient-to-tr from-cyan-400 via-sky-500 to-blue-600 flex items-center justify-center text-slate-950 text-2xl shadow-[0_0_35px_rgba(0,242,254,0.35)] font-black">
            <i class="fa-solid fa-compass text-slate-950"></i>
        </div>
        <div class="space-y-2">
            <h1 class="text-3xl font-black tracking-tight text-slate-900 dark:text-transparent dark:bg-gradient-to-r dark:from-white dark:via-cyan-100 dark:to-cyan-400 dark:bg-clip-text">PathSeeker</h1>
            <p class="text-xs text-slate-500 dark:text-slate-400">Role-Based Career Exploration Passport Platform</p>
        </div>
        <div class="pt-2">
            <a href="{{ route('home') }}" class="w-full py-3.5 px-6 rounded-2xl font-black text-sm text-slate-950 bg-gradient-to-r from-[#00f2fe] via-sky-400 to-blue-600 hover:from-cyan-300 hover:to-blue-500 shadow-[0_0_30px_rgba(0,242,254,0.35)] hover:scale-105 transition-all flex items-center justify-center gap-2">
                <span class="text-slate-950 font-black">Enter Platform</span>
                <i class="fa-solid fa-arrow-right text-xs text-slate-950"></i>
            </a>
        </div>
    </div>
</body>
</html>