<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PathSeeker — Career Passport</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { font-family: 'Plus Jakarta Sans', system-ui, sans-serif; background-color: #09090b; }
        .glass-panel {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(24px);
            border: 1px solid rgba(255, 255, 255, 0.10);
            box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.37);
        }
        .grad-text {
            background: linear-gradient(135deg, #a78bfa 0%, #818cf8 50%, #f472b6 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
    </style>
</head>
<body class="text-white flex items-center justify-center min-h-screen p-4 relative overflow-hidden">
    <div class="absolute w-96 h-96 bg-purple-600/20 rounded-full blur-3xl -top-20 -left-20 pointer-events-none"></div>
    <div class="absolute w-80 h-80 bg-indigo-600/20 rounded-full blur-3xl -bottom-20 -right-20 pointer-events-none"></div>

    <div class="relative z-10 glass-panel rounded-3xl p-10 max-w-md w-full text-center space-y-6">
        <div class="w-16 h-16 mx-auto rounded-2xl bg-gradient-to-tr from-cyan-400 via-sky-500 to-blue-600 flex items-center justify-center text-slate-950 text-2xl shadow-[0_0_35px_rgba(0,242,254,0.35)] font-black">
            <i class="fa-solid fa-compass text-slate-950"></i>
        </div>
        <div class="space-y-2">
            <h1 class="text-3xl font-black tracking-tight bg-gradient-to-r from-white via-cyan-100 to-cyan-400 bg-clip-text text-transparent">PathSeeker</h1>
            <p class="text-xs text-slate-400">Role-Based Career Exploration Passport Platform</p>
        </div>
        <div class="pt-2">
            <a href="{{ route('home') }}" class="w-full py-3.5 px-6 rounded-2xl font-black text-sm text-slate-950 bg-gradient-to-r from-[#00f2fe] via-sky-400 to-blue-600 hover:from-cyan-300 hover:to-blue-500 shadow-[0_0_30px_rgba(0,242,254,0.35)] transition-all flex items-center justify-center gap-2">
                <span class="text-slate-950 font-black">Enter Platform</span>
                <i class="fa-solid fa-arrow-right text-xs text-slate-950"></i>
            </a>
        </div>
    </div>
</body>
</html>