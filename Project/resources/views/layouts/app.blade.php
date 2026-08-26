<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    {{-- Dynamic Technical SEO Meta Tags --}}
    <title>@yield('title', 'PathSeeker | AI-Powered Career Intelligence & Tech Roadmaps 2026')</title>
    <meta name="description" content="@yield('meta_description', 'Discover high-growth tech career paths, 10-year predictive market trajectories, real-time salary benchmarks, skill analysis, and verified toolkits on PathSeeker.')">
    <meta name="keywords" content="@yield('meta_keywords', 'tech careers, salary benchmarks, career roadmap, web development, cloud computing, AI machine learning, cybersecurity, DevOps')">
    <meta name="author" content="PathSeeker AI">
    <meta name="robots" content="@yield('meta_robots', 'index, follow')">
    <link rel="canonical" href="@yield('canonical_url', url()->current())">

    {{-- Open Graph / Facebook --}}
    <meta property="og:type" content="@yield('og_type', 'website')">
    <meta property="og:url" content="@yield('og_url', url()->current())">
    <meta property="og:title" content="@yield('title', 'PathSeeker | AI-Powered Career Intelligence & Tech Roadmaps 2026')">
    <meta property="og:description" content="@yield('meta_description', 'Discover high-growth tech career paths, 10-year predictive market trajectories, real-time salary benchmarks, skill analysis, and verified toolkits on PathSeeker.')">
    <meta property="og:image" content="@yield('og_image', asset('images/og-preview.png'))">
    <meta property="og:site_name" content="PathSeeker">

    {{-- Twitter Cards --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="@yield('twitter_url', url()->current())">
    <meta name="twitter:title" content="@yield('title', 'PathSeeker | AI-Powered Career Intelligence & Tech Roadmaps 2026')">
    <meta name="twitter:description" content="@yield('meta_description', 'Discover high-growth tech career paths, 10-year predictive market trajectories, real-time salary benchmarks, skill analysis, and verified toolkits on PathSeeker.')">
    <meta name="twitter:image" content="@yield('twitter_image', asset('images/og-preview.png'))">

    {{-- JSON-LD Structured Schema Markup --}}
    @if(trim($__env->yieldContent('schema')))
        @yield('schema')
    @else
    <script type="application/ld+json">
    {
      "@@context": "https://schema.org",
      "@@type": "SoftwareApplication",
      "name": "PathSeeker",
      "applicationCategory": "EducationalApplication",
      "operatingSystem": "Web",
      "offers": {
        "@@type": "Offer",
        "price": "0",
        "priceCurrency": "USD"
      },
      "description": "AI-Powered Career Intelligence, 10-Year Market Growth Trajectories, Real-Time Tech Salary Benchmarks, and Verified Industry Toolkits.",
      "url": "{{ url('/') }}",
      "publisher": {
        "@@type": "Organization",
        "name": "PathSeeker",
        "url": "{{ url('/') }}"
      }
    }
    </script>
    @endif
    
    <!-- Instant Theme Detection Script (Eliminates FOUC / Light-mode dark flash on refresh) -->
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

                // Instant Font-Size Scaling (Phase 9 A11y)
                var scaleIndex = localStorage.getItem('fontSizeScaleIndex') || '1';
                var scales = ['90%', '100%', '115%', '125%'];
                if (scales[scaleIndex]) {
                    document.documentElement.style.fontSize = scales[scaleIndex];
                }
            } catch (e) {
                document.documentElement.classList.add('dark');
                document.documentElement.setAttribute('data-theme', 'dark');
            }
        })();
    </script>
    
    <!-- Google Fonts: Plus Jakarta Sans & Space Grotesk -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800;900&family=Space+Grotesk:wght@500;700;900&display=swap" rel="stylesheet">
    
    <!-- FontAwesome 6 CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- html2pdf.js CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Alpine.js Plugins & Core CDN -->
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/collapse@3.x.x/dist/cdn.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.8/dist/cdn.min.js"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        obsidian: '#06080f',
                        surface: {
                            800: '#121624',
                            900: '#090d18',
                            950: '#06080f',
                        },
                        cyan: {
                            accent: '#00f2fe',
                        }
                    },
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'system-ui', 'sans-serif'],
                        display: ['"Space Grotesk"', '"Plus Jakarta Sans"', 'sans-serif'],
                    },
                    boxShadow: {
                        'neon-purple': '0 4px 20px rgba(168, 85, 247, 0.20), 0 10px 30px rgba(168, 85, 247, 0.08)',
                        'neon-pink': '0 4px 20px rgba(244, 114, 182, 0.20), 0 10px 30px rgba(244, 114, 182, 0.08)',
                        'neon-cyan': '0 4px 20px rgba(0, 242, 254, 0.25), 0 10px 30px rgba(0, 242, 254, 0.12)',
                        'glass-card': '0 10px 30px 0 rgba(0, 0, 0, 0.35), inset 0 1px 0 0 rgba(255, 255, 255, 0.05)',
                    }
                }
            }
        }
    </script>
    <style>
        [x-cloak] { display: none !important; }
        body { font-family: 'Plus Jakarta Sans', system-ui, sans-serif; }
        .font-display { font-family: 'Space Grotesk', sans-serif; }

        /* ══════════════════ AMBIENT BACKGROUND & SCANLINE CSS ANIMATIONS ══════════════════ */
        @keyframes aurora-drift-1 {
            0%, 100% { transform: translate3d(0px, 0px, 0) scale(1); }
            50% { transform: translate3d(5vw, 6vh, 0) scale(1.14); }
        }
        @keyframes aurora-drift-2 {
            0%, 100% { transform: translate3d(0px, 0px, 0) scale(1); }
            50% { transform: translate3d(-5vw, -6vh, 0) scale(1.10); }
        }
        @keyframes aurora-drift-3 {
            0%, 100% { transform: translate3d(0px, 0px, 0) scale(1); opacity: 0.6; }
            50% { transform: translate3d(4vw, -4vh, 0) scale(1.18); opacity: 0.95; }
        }
        @keyframes scanline {
            0% { transform: translateY(-120%); opacity: 0; }
            30% { opacity: 0.6; }
            70% { opacity: 0.6; }
            100% { transform: translateY(1200%); opacity: 0; }
        }
        @keyframes pulse-glow {
            0%, 100% { opacity: 0.35; transform: scale(1); }
            50% { opacity: 0.75; transform: scale(1.05); }
        }
        .animate-aurora-drift-1 { animation: aurora-drift-1 18s ease-in-out infinite; will-change: transform; }
        .animate-aurora-drift-2 { animation: aurora-drift-2 22s ease-in-out infinite; will-change: transform; }
        .animate-aurora-drift-3 { animation: aurora-drift-3 26s ease-in-out infinite; will-change: transform; }
        .animate-scanline { animation: scanline 4s cubic-bezier(0.4, 0, 0.6, 1) infinite; }
        .animate-pulse-glow { animation: pulse-glow 6s ease-in-out infinite; }

        /* ══════════════════ CENTRALIZED 2026 DESIGN TOKENS ══════════════════ */
        :root {
            --color-primary: #7c3aed;
            --color-primary-hover: #6d28d9;
            --color-primary-light: rgba(124, 58, 237, 0.08);
            --color-secondary: #0ea5e9;
            --color-secondary-hover: #0284c7;
            --color-bg: #f8fafc;
            --color-surface: rgba(255, 255, 255, 0.95);
            --color-surface-hover: rgba(241, 245, 249, 0.95);
            --color-text: #0f172a;
            --color-text-muted: #475569;
            --color-text-dim: #64748b;
            --color-border: rgba(226, 232, 240, 0.90);
            --color-border-hover: rgba(124, 58, 237, 0.30);
            --color-success: #10b981;
            --color-warning: #f59e0b;
            --color-danger: #ef4444;
            --radius-sm: 8px;
            --radius-md: 12px;
            --radius-lg: 16px;
            --radius-xl: 24px;
            --radius-full: 9999px;
            --shadow-glass: 0 8px 24px rgba(0, 0, 0, 0.04);
            --shadow-neon-primary: 0 4px 20px rgba(124, 58, 237, 0.20);
        }

        .dark, html.dark {
            --color-primary: #a855f7;
            --color-primary-hover: #9333ea;
            --color-primary-light: rgba(168, 85, 247, 0.08);
            --color-secondary: #00f2fe;
            --color-secondary-hover: #38bdf8;
            --color-bg: #06080f;
            --color-surface: #090d18;
            --color-surface-hover: #101524;
            --color-text: #f8fafc;
            --color-text-muted: #94a3b8;
            --color-text-dim: #64748b;
            --color-border: rgba(255, 255, 255, 0.10);
            --color-border-hover: rgba(168, 85, 247, 0.30);
            --color-success: #34d399;
            --color-warning: #fbbf24;
            --color-danger: #f43f5e;
            --shadow-glass: 0 8px 24px 0 rgba(0, 0, 0, 0.30);
            --shadow-neon-primary: 0 4px 14px rgba(124, 58, 237, 0.15);
        }

        /* ══════════════════ UNIFIED COMPONENT STANDARDS ══════════════════ */
        .app-card {
            background: #080b12;
            border: 1px solid rgba(255, 255, 255, 0.10);
            box-shadow: 0 4px 20px -2px rgba(0, 0, 0, 0.35);
            border-radius: var(--radius-xl);
            position: relative;
            transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
        }
        html:not(.dark) .app-card {
            background: #ffffff;
            border: 1px solid rgba(226, 232, 240, 0.95);
            box-shadow: 0 4px 15px -2px rgba(0, 0, 0, 0.05);
        }
        .app-card:hover, .career-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px -4px rgba(0, 0, 0, 0.45);
            border-color: rgba(255, 255, 255, 0.18);
        }
        html:not(.dark) .app-card:hover, html:not(.dark) .career-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px -4px rgba(0, 0, 0, 0.08);
            border-color: rgba(99, 102, 241, 0.35);
        }

        /* Standardized Buttons */
        .btn-primary {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            padding: 0.75rem 1.75rem;
            font-size: 0.875rem;
            font-weight: 800;
            color: #040812 !important;
            border-radius: var(--radius-full);
            background: linear-gradient(135deg, #00f2fe 0%, #38bdf8 50%, #3b82f6 100%);
            box-shadow: 0 4px 18px rgba(0, 242, 254, 0.35);
            transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
            position: relative;
            overflow: hidden;
        }
        .btn-primary:hover {
            transform: translateY(-2px) scale(1.01);
            box-shadow: 0 6px 24px rgba(0, 242, 254, 0.50);
            background: linear-gradient(135deg, #38bdf8 0%, #00f2fe 50%, #60a5fa 100%);
        }

        .btn-secondary {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            padding: 0.75rem 1.5rem;
            font-size: 0.875rem;
            font-weight: 700;
            border-radius: var(--radius-full);
            background: rgba(255, 255, 255, 0.04);
            border: 1px solid rgba(255, 255, 255, 0.10);
            color: #f1f5f9;
            transition: all 0.25s ease;
        }
        html:not(.dark) .btn-secondary {
            background: rgba(255, 255, 255, 0.95);
            border: 1px solid rgba(226, 232, 240, 0.9);
            color: #0f172a;
        }
        .btn-secondary:hover {
            border-color: rgba(0, 242, 254, 0.40);
            color: #00f2fe;
            transform: translateY(-1px);
        }
        html:not(.dark) .btn-secondary:hover {
            border-color: rgba(2, 132, 199, 0.5);
            color: #0284c7;
        }

        .btn-outline {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            padding: 0.625rem 1.25rem;
            font-size: 0.8125rem;
            font-weight: 700;
            border-radius: var(--radius-full);
            background: transparent;
            border: 1px solid rgba(0, 242, 254, 0.30);
            color: #00f2fe;
            transition: all 0.25s ease;
        }
        .btn-outline:hover {
            background: rgba(0, 242, 254, 0.10);
            border-color: rgba(0, 242, 254, 0.60);
            transform: translateY(-1px);
        }

        .btn-danger {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            padding: 0.75rem 1.5rem;
            font-size: 0.875rem;
            font-weight: 700;
            color: #ffffff !important;
            border-radius: var(--radius-full);
            background: linear-gradient(135deg, #e11d48 0%, #be123c 100%);
            box-shadow: 0 4px 14px rgba(225, 29, 72, 0.25);
            transition: all 0.25s ease;
        }
        .btn-danger:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(225, 29, 72, 0.35);
        }

        /* 2026 Premium Signature Glassmorphic Container & Card Architecture (Reserved for Hero & Primary Stage) */
        .glass-panel, .signature-container {
            background: rgba(15, 23, 42, 0.65);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.10);
            box-shadow: 0 16px 36px -10px rgba(0, 0, 0, 0.45), inset 0 1px 0 0 rgba(255, 255, 255, 0.08);
            position: relative;
        }
        html:not(.dark) .glass-panel, html:not(.dark) .signature-container {
            background: rgba(255, 255, 255, 0.94);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(226, 232, 240, 0.90);
            box-shadow: 0 16px 35px -10px rgba(0, 0, 0, 0.05), inset 0 1px 0 0 rgba(255, 255, 255, 0.95);
            position: relative;
        }
        .signature-card {
            background: #080b12;
            border: 1px solid rgba(255, 255, 255, 0.10);
            transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
        }
        html:not(.dark) .signature-card {
            background: #ffffff;
            border: 1px solid rgba(226, 232, 240, 0.90);
            transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .signature-card:hover {
            transform: translateY(-2px);
            border-color: rgba(255, 255, 255, 0.18);
            box-shadow: 0 8px 24px -4px rgba(0, 0, 0, 0.35);
        }

        /* Floating Pill Navbar */
        .glass-pill-nav {
            background: rgba(8, 11, 18, 0.85);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.10);
            box-shadow: 0 12px 32px -8px rgba(0, 0, 0, 0.5), inset 0 1px 0 0 rgba(255, 255, 255, 0.06);
        }
        html:not(.dark) .glass-pill-nav {
            background: rgba(255, 255, 255, 0.94);
            border: 1px solid rgba(226, 232, 240, 0.95);
            box-shadow: 0 12px 30px -8px rgba(0, 0, 0, 0.05), inset 0 1px 0 0 rgba(255, 255, 255, 1);
        }

        /* Gradient Text Hooks - Signature Electric Cyan / Sky / Indigo */
        .grad-text {
            background: linear-gradient(135deg, #00f2fe 0%, #38bdf8 50%, #818cf8 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .grad-text-cyan {
            background: linear-gradient(135deg, #00f2fe 0%, #38bdf8 60%, #6366f1 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        html:not(.dark) .grad-text {
            background: linear-gradient(135deg, #0284c7 0%, #0369a1 50%, #4338ca 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        html:not(.dark) .grad-text-cyan {
            background: linear-gradient(135deg, #0284c7 0%, #0369a1 60%, #4338ca 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* 3D Perspective Stage */
        .perspective-stage {
            perspective: 1200px;
        }
        .passport-card-3d {
            transform-style: preserve-3d;
            transition: transform 0.2s cubic-bezier(0.25, 1, 0.5, 1), box-shadow 0.3s ease;
        }
        .passport-card-3d:hover {
            box-shadow: 0 16px 40px -8px rgba(0, 0, 0, 0.45), inset 0 1px 0 0 rgba(255, 255, 255, 0.15);
        }

        /* 2026 Magnetic Card Lift with Crisp Restrained Border & 3D Tilt */
        .card-tilt, .card-tilt-3d, .career-card, [data-tilt] {
            position: relative;
            transform-style: preserve-3d;
            will-change: transform;
            transition: transform 0.3s cubic-bezier(0.16, 1, 0.3, 1), box-shadow 0.3s cubic-bezier(0.16, 1, 0.3, 1), border-color 0.3s ease;
        }
        .card-tilt:hover, .card-tilt-3d:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 24px -4px rgba(0, 0, 0, 0.4);
            border-color: rgba(255, 255, 255, 0.18);
        }
        html:not(.dark) .card-tilt:hover, html:not(.dark) .card-tilt-3d:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px -4px rgba(0, 0, 0, 0.06);
            border-color: rgba(99, 102, 241, 0.30);
        }

        /* Glowing Sweep Button Effect */
        .btn-sweep {
            position: relative;
            overflow: hidden;
        }
        .btn-sweep::after {
            content: '';
            position: absolute;
            top: -50%;
            left: -60%;
            width: 40%;
            height: 200%;
            background: linear-gradient(to right, transparent, rgba(255, 255, 255, 0.35), transparent);
            transform: rotate(30deg);
            transition: none;
        }
        .btn-sweep:hover::after {
            left: 120%;
            transition: left 0.75s ease-in-out;
        }

        /* ══════════════════ EXACT STAGGERED SCROLL-TRIGGERED REVEAL SYSTEM ══════════════════ */
        .reveal-element,
        .reveal-on-scroll,
        [data-reveal] {
            opacity: 0;
            transform: translateY(40px) scale(0.96);
            transition: opacity 0.65s cubic-bezier(0.16, 1, 0.3, 1), transform 0.65s cubic-bezier(0.16, 1, 0.3, 1);
            will-change: opacity, transform;
        }

        .reveal-element.reveal-fade,
        .reveal-on-scroll.reveal-fade,
        [data-reveal="fade"] {
            transform: scale(0.98);
        }

        .reveal-element.reveal-left,
        .reveal-on-scroll.reveal-left,
        [data-reveal="left"] {
            transform: translateX(-40px) scale(0.96);
        }

        .reveal-element.reveal-right,
        .reveal-on-scroll.reveal-right,
        [data-reveal="right"] {
            transform: translateX(40px) scale(0.96);
        }

        .reveal-element.reveal-scale,
        .reveal-on-scroll.reveal-scale,
        [data-reveal="scale"] {
            transform: scale(0.92);
        }

        /* Revealed State (locks in place, does not reverse on scroll up) */
        .reveal-element.revealed,
        .reveal-on-scroll.revealed,
        [data-reveal].revealed {
            opacity: 1 !important;
            transform: translateY(0px) translateX(0px) scale(1) !important;
        }

        /* Precise Stagger Delays (50ms - 100ms sequential intervals) */
        .stagger-1, [data-reveal-delay="75"]  { transition-delay: 75ms !important; }
        .stagger-2, [data-reveal-delay="150"] { transition-delay: 150ms !important; }
        .stagger-3, [data-reveal-delay="225"] { transition-delay: 225ms !important; }
        .stagger-4, [data-reveal-delay="300"] { transition-delay: 300ms !important; }
        .stagger-5, [data-reveal-delay="375"] { transition-delay: 375ms !important; }
        .stagger-6, [data-reveal-delay="450"] { transition-delay: 450ms !important; }
        .stagger-7, [data-reveal-delay="525"] { transition-delay: 525ms !important; }
        .stagger-8, [data-reveal-delay="600"] { transition-delay: 600ms !important; }

        /* ══════════════════ UNIVERSAL 3D TILT & LIGHT REFLECTION ENGINE ══════════════════ */
        .card-tilt-3d,
        .career-card,
        .app-card,
        .glass-panel,
        [data-tilt] {
            transform-style: preserve-3d;
            backface-visibility: hidden;
            position: relative;
        }

        /* Dynamic Mouse Glare Reflection Overlay */
        .tilt-glare-overlay {
            position: absolute;
            inset: 0;
            border-radius: inherit;
            pointer-events: none;
            background: radial-gradient(circle 320px at var(--mouse-x, 50%) var(--mouse-y, 50%), rgba(255, 255, 255, 0.08), transparent 70%);
            opacity: 0;
            transition: opacity 0.3s ease;
            z-index: 5;
        }

        .dark .tilt-glare-overlay {
            background: radial-gradient(circle 320px at var(--mouse-x, 50%) var(--mouse-y, 50%), rgba(0, 242, 254, 0.12), transparent 70%);
        }

        .card-tilt-3d:hover .tilt-glare-overlay,
        .career-card:hover .tilt-glare-overlay,
        .app-card:hover .tilt-glare-overlay,
        .glass-panel:hover .tilt-glare-overlay,
        [data-tilt]:hover .tilt-glare-overlay {
            opacity: 1;
        }

        /* Inputs */
        .app-input {
            background: rgba(255, 255, 255, 0.04);
            border: 1px solid rgba(255, 255, 255, 0.10);
            color: #f1f5f9;
            transition: all 0.25s;
        }
        .app-input:focus {
            outline: none;
            border-color: rgba(168, 85, 247, 0.5);
            background: rgba(255, 255, 255, 0.06);
            box-shadow: 0 0 0 3px rgba(168, 85, 247, 0.15);
        }
        html:not(.dark) .app-input {
            background: rgba(255, 255, 255, 0.95);
            border-color: #cbd5e1;
            color: #0f172a;
        }
        html:not(.dark) .app-input:focus {
            border-color: #6366f1;
            background: #ffffff;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.12);
        }
        select.app-input option {
            background: #050507;
            color: #f1f5f9;
        }
        html:not(.dark) select.app-input option {
            background: #ffffff;
            color: #0f172a;
        }

        /* Category Accent Badges & Borders */
        .badge-software { border-color: rgba(168, 85, 247, 0.25); color: #c084fc; background: rgba(168, 85, 247, 0.08); }
        .badge-cloud { border-color: rgba(56, 189, 248, 0.25); color: #38bdf8; background: rgba(56, 189, 248, 0.08); }
        .badge-ai { border-color: rgba(244, 114, 182, 0.25); color: #f472b6; background: rgba(244, 114, 182, 0.08); }
        .badge-cyber { border-color: rgba(52, 211, 153, 0.25); color: #34d399; background: rgba(52, 211, 153, 0.08); }
        .badge-mobile { border-color: rgba(96, 165, 250, 0.25); color: #60a5fa; background: rgba(96, 165, 250, 0.08); }
        .badge-design { border-color: rgba(192, 132, 252, 0.25); color: #e879f9; background: rgba(232, 121, 249, 0.08); }
        .badge-game { border-color: rgba(251, 191, 36, 0.25); color: #fbbf24; background: rgba(251, 191, 36, 0.08); }
        .badge-blockchain { border-color: rgba(45, 212, 191, 0.25); color: #2dd4bf; background: rgba(45, 212, 191, 0.08); }

        /* Custom Interactive Cursor (Desktop Only) */
        @media (hover: hover) and (pointer: fine) {
            #customCursor {
                pointer-events: none;
                position: fixed;
                top: 0;
                left: 0;
                width: 18px;
                height: 18px;
                border-radius: 50%;
                background: radial-gradient(circle, rgba(168, 85, 247, 0.4) 0%, rgba(236, 72, 153, 0.10) 70%, transparent 100%);
                border: 1px solid rgba(255, 255, 255, 0.2);
                transform: translate(-50%, -50%);
                transition: width 0.25s ease, height 0.25s ease, background 0.25s ease, border-color 0.25s ease, opacity 0.25s ease;
                z-index: 99999;
                opacity: 0;
            }
            #customCursor.active {
                opacity: 1;
            }
            #customCursor.hovered {
                width: 38px;
                height: 38px;
                background: radial-gradient(circle, rgba(168, 85, 247, 0.25) 0%, rgba(56, 189, 248, 0.10) 80%, transparent 100%);
                border-color: rgba(168, 85, 247, 0.4);
            }
        }

        /* Accessibility: Prefers Reduced Motion Respect */
        @media (prefers-reduced-motion: reduce) {
            *, ::before, ::after {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.01ms !important;
                scroll-behavior: auto !important;
            }
            .animate-aurora-drift-1, .animate-aurora-drift-2, .animate-aurora-drift-3, .animate-scanline, .animate-pulse-glow {
                animation: none !important;
            }
            .reveal-element, .reveal-on-scroll, [data-reveal], [data-reveal] * {
                opacity: 1 !important;
                transform: none !important;
                transition: none !important;
            }
        }

        /* Strict Light Mode Text Rules */
        html:not(.dark) .text-slate-400 { color: #475569 !important; }
        html:not(.dark) .text-slate-300 { color: #334155 !important; }
        html:not(.dark) .text-slate-500 { color: #475569 !important; }
        html:not(.dark) .text-slate-600 { color: #334155 !important; }
        html:not(.dark) .text-white { color: #0f172a; }

        html:not(.dark) a.text-white,
        html:not(.dark) button.text-white,
        html:not(.dark) span.text-white,
        html:not(.dark) div.bg-gradient-to-tr .text-white,
        html:not(.dark) a.bg-gradient-to-r,
        html:not(.dark) button.bg-gradient-to-r,
        html:not(.dark) .btn-white-text,
        html:not(.dark) .bg-[#050507] .text-white,
        html:not(.dark) .bg-slate-950 .text-white,
        html:not(.dark) footer .text-white {
            color: #ffffff !important;
        }
        html:not(.dark) footer .text-slate-400 { color: #94a3b8 !important; }
        html:not(.dark) footer .text-slate-500 { color: #64748b !important; }
    </style>
</head>
<body class="min-h-screen flex flex-col antialiased transition-colors duration-500 relative overflow-x-hidden bg-slate-50 dark:bg-[#06080f]">

    <!-- ══════════════════ SAFE FULL-SCREEN ANIMATED AMBIENT BACKGROUND CONTAINER ══════════════════ -->
    <div class="fixed inset-0 z-[-1] pointer-events-none overflow-hidden bg-slate-50 dark:bg-[#06080f] transition-colors duration-500" aria-hidden="true">
        <!-- Floating Aurora Orb 1 (Top-Left Indigo/Purple) -->
        <div class="absolute -top-[15%] -left-[10%] w-[55vw] h-[55vw] rounded-full bg-gradient-to-br from-indigo-500/20 via-purple-600/20 to-transparent dark:from-indigo-600/30 dark:via-purple-700/25 dark:to-transparent blur-[120px] sm:blur-[160px] animate-aurora-drift-1"></div>
        
        <!-- Floating Aurora Orb 2 (Bottom-Right Pink/Rose) -->
        <div class="absolute -bottom-[15%] -right-[10%] w-[55vw] h-[55vw] rounded-full bg-gradient-to-tl from-pink-500/20 via-purple-600/15 to-transparent dark:from-pink-600/25 dark:via-purple-700/15 dark:to-transparent blur-[120px] sm:blur-[160px] animate-aurora-drift-2"></div>

        <!-- Floating Aurora Orb 3 (Center-Floating Cyan/Emerald Shimmer) -->
        <div class="absolute top-[35%] left-[20%] w-[45vw] h-[45vw] rounded-full bg-gradient-to-tr from-cyan-500/15 via-indigo-500/10 to-transparent dark:from-cyan-500/20 dark:via-indigo-500/15 dark:to-transparent blur-[130px] sm:blur-[170px] animate-aurora-drift-3"></div>

        <!-- Subtle Ambient Grid / Dot Texture -->
        <div class="absolute inset-0 bg-[radial-gradient(#6366f1_1px,transparent_1px)] dark:bg-[radial-gradient(#a855f7_1px,transparent_1px)] [background-size:32px_32px] opacity-[0.03] dark:opacity-[0.05]"></div>
    </div>

    <!-- ══════════════════ FLOATING GLASS PILL NAVBAR ══════════════════ -->
    @include('components.navbar')

    <!-- Top Spacing -->
    <div class="h-20 sm:h-24"></div>

    <!-- Navigation Breadcrumbs Component -->
    @include('components.breadcrumbs')

    <!-- Global Flash Notifications -->
    @include('components.flash-message')

    <!-- Main Dynamic Content -->
    <main class="relative z-10 flex-grow">
        @yield('content')
    </main>

    @if(!request()->routeIs('home') && !request()->routeIs('login') && !request()->routeIs('register'))
    <!-- ══════════════════ 6. INNER PAGE CLOSING STATEMENT & GLOBAL FOOTER ══════════════════ -->
    <section class="relative z-10 my-10 md:my-14 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
        <!-- The Bold Closing Statement Banner -->
        <div class="relative rounded-3xl p-8 sm:p-12 lg:p-14 text-center space-y-8 bg-white dark:bg-[#080B12] border border-slate-200 dark:border-white/10 shadow-2xl dark:shadow-[0_8px_32px_0_rgba(0,0,0,0.37)] overflow-hidden reveal-element">
            {{-- Ambient Corner Glows --}}
            <div class="absolute -top-24 -left-24 w-72 h-72 rounded-full bg-purple-500/10 dark:bg-purple-500/15 blur-3xl pointer-events-none"></div>
            <div class="absolute -bottom-24 -right-24 w-72 h-72 rounded-full bg-cyan-500/10 dark:bg-cyan-500/15 blur-3xl pointer-events-none"></div>

            <div class="relative z-10 space-y-4 max-w-3xl mx-auto">
                <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-cyan-500/10 dark:bg-cyan-500/15 border border-cyan-500/20 text-xs font-black uppercase tracking-wider text-cyan-700 dark:text-cyan-300 shadow-sm font-mono">
                    <i class="fa-solid fa-meteor text-cyan-600 dark:text-cyan-400"></i>
                    <span>Your Destiny Awaits</span>
                </div>
                <h2 class="text-3xl sm:text-5xl lg:text-6xl font-black text-slate-900 dark:text-white tracking-tight leading-tight font-display">
                    Your future doesn't have a path. <span class="grad-text">You build it.</span>
                </h2>
                <p class="text-slate-600 dark:text-slate-400 text-sm sm:text-base leading-relaxed">
                    Step into the global career intelligence passport. Explore role competencies, unlock verified toolkits, and build a world-class trajectory.
                </p>
                <div class="pt-4">
                    <a href="{{ route('register') }}" class="btn-sweep group inline-flex items-center gap-3 px-10 py-4 rounded-full text-base font-black text-slate-950 bg-gradient-to-r from-[#00f2fe] via-sky-400 to-blue-600 hover:from-cyan-300 hover:to-blue-500 shadow-[0_0_25px_rgba(0,242,254,0.35)] transition-all duration-300 hover:scale-105">
                        <i class="fa-solid fa-compass text-lg text-slate-950"></i>
                        <span class="text-slate-950 font-black">Build My Career Path &rarr;</span>
                    </a>
                </div>
            </div>
        </div>
    </section>
    @endif

    <!-- Structured Slate Footer Component with Newsletter -->
    @include('components.footer')

    <!-- ══════════════════ GLOBAL FLOATING ACTIONS (SCROLL TO TOP & AI GUIDE CHATBOT) ══════════════════ -->
    <div x-data="initChatbot()">
        
        <!-- Floating AI Chat Window Modal (Morphs from bottom-6 right-6) -->
        <div x-show="openAI"
             x-transition:enter="transition ease-out duration-300 transform"
             x-transition:enter-start="opacity-0 scale-75"
             x-transition:enter-end="opacity-100 scale-100"
             x-transition:leave="transition ease-in duration-300 transform"
             x-transition:leave-start="opacity-100 scale-100"
             x-transition:leave-end="opacity-0 scale-75"
             @click.outside="openAI = false"
             style="display: none; transform-origin: bottom right;"
             class="fixed bottom-6 right-6 z-[99999] w-[90vw] max-w-[380px] h-[32rem] max-h-[calc(100vh-5rem)] bg-white/95 dark:bg-slate-900/95 backdrop-blur-2xl border border-slate-200/80 dark:border-white/10 rounded-3xl shadow-[0_20px_60px_rgba(0,0,0,0.35)] flex flex-col overflow-hidden origin-bottom-right transition-all duration-300 ease-in-out">
            
            {{-- Top Header --}}
            <div class="px-5 py-4 bg-white/90 dark:bg-slate-950/80 border-b border-slate-200/80 dark:border-white/10 flex items-center justify-between shrink-0">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-xl bg-gradient-to-tr from-[#00f2fe] via-sky-500 to-blue-600 flex items-center justify-center text-slate-950 shadow-md shrink-0">
                        <i class="fa-solid fa-wand-magic-sparkles text-xs text-slate-950"></i>
                    </div>
                    <div>
                        <h4 class="text-xs sm:text-sm font-black text-slate-900 dark:text-white font-display flex items-center gap-1.5">
                            <span>PathSeeker AI Guide</span>
                            <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                        </h4>
                        <p class="text-[10px] text-slate-500 dark:text-slate-400 font-medium">Real-time Career Intelligence</p>
                    </div>
                </div>
                <button @click="openAI = false" class="w-8 h-8 rounded-full bg-slate-100 dark:bg-white/5 hover:bg-slate-200 dark:hover:bg-white/10 text-slate-500 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white flex items-center justify-center transition-colors cursor-pointer" title="Close AI Guide">
                    <i class="fa-solid fa-xmark text-xs"></i>
                </button>
            </div>

            {{-- Chat History Area --}}
            <div id="chatMessagesContainer" class="flex-1 p-4 overflow-y-auto space-y-3.5 scrollbar-thin">
                <template x-for="(msg, index) in messages" :key="index">
                    <div class="flex flex-col" :class="msg.sender === 'user' ? 'items-end' : 'items-start'">
                        <div class="max-w-[88%] rounded-2xl p-3.5 text-xs sm:text-[13px] leading-relaxed shadow-sm font-medium"
                             :class="msg.sender === 'user' 
                                 ? 'bg-gradient-to-r from-[#00f2fe] via-sky-500 to-blue-600 text-slate-950 font-bold rounded-br-none shadow-[0_0_15px_rgba(0,242,254,0.3)]' 
                                 : 'bg-slate-100/90 dark:bg-slate-800/90 text-slate-800 dark:text-slate-200 border border-slate-200/80 dark:border-white/5 rounded-bl-none'">
                            <div x-html="formatText(msg.text)"></div>
                        </div>
                        <span class="text-[9px] text-slate-400 dark:text-slate-500 mt-1 px-1 font-mono" x-text="msg.time"></span>
                    </div>
                </template>

                {{-- Typing / Thinking Indicator --}}
                <div x-show="loading" class="flex flex-col items-start">
                    <div class="bg-slate-100/90 dark:bg-slate-800/90 border border-slate-200/80 dark:border-white/10 rounded-2xl rounded-bl-none px-4 py-3 text-xs flex items-center gap-1.5 shadow-sm">
                        <span class="w-2 h-2 rounded-full bg-cyan-400 animate-bounce" style="animation-delay: 0ms"></span>
                        <span class="w-2 h-2 rounded-full bg-sky-400 animate-bounce" style="animation-delay: 150ms"></span>
                        <span class="w-2 h-2 rounded-full bg-blue-500 animate-bounce" style="animation-delay: 300ms"></span>
                        <span class="text-[11px] font-mono text-slate-500 dark:text-slate-400 ml-1.5 font-medium">PathSeeker AI is thinking...</span>
                    </div>
                </div>

                {{-- Quick Prompt Suggestions --}}
                <div x-show="messages.length <= 2 && !loading" class="pt-2 space-y-1.5">
                    <p class="text-[10px] uppercase font-bold text-slate-400 dark:text-slate-500 tracking-wider font-mono px-1">Suggested Inquiries</p>
                    <div class="flex flex-wrap gap-1.5">
                        <template x-for="(q, qIndex) in quickQuestions" :key="qIndex">
                            <button @click="sendMessage(q)" class="text-[11px] text-left px-2.5 py-1.5 rounded-xl bg-cyan-50 dark:bg-cyan-950/40 text-cyan-700 dark:text-cyan-300 border border-cyan-200/70 dark:border-cyan-500/20 hover:border-cyan-400 transition-colors cursor-pointer font-medium">
                                <span x-text="q"></span> &rarr;
                            </button>
                        </template>
                    </div>
                </div>
            </div>

            {{-- Bottom Input Form --}}
            <form @submit.prevent="sendMessage()" class="p-3 bg-white/90 dark:bg-slate-950/80 border-t border-slate-200/80 dark:border-white/10 flex items-center gap-2 shrink-0">
                <div class="relative flex-1">
                    <input type="text"
                           x-model="userInput"
                           :disabled="loading"
                           placeholder="Ask about careers, skills, roadmaps..."
                           class="w-full bg-slate-100 dark:bg-slate-900 border border-slate-300 dark:border-white/10 rounded-full px-4 py-2.5 text-xs sm:text-sm text-slate-900 dark:text-white placeholder-slate-400 focus:outline-none focus:border-cyan-500/80 dark:focus:border-cyan-400 disabled:opacity-50">
                </div>
                <button type="submit"
                        :disabled="loading"
                        class="w-9 h-9 rounded-full bg-gradient-to-r from-[#00f2fe] via-sky-400 to-blue-600 hover:from-cyan-300 hover:to-blue-500 text-slate-950 flex items-center justify-center shadow-md hover:scale-105 transition-transform shrink-0 cursor-pointer disabled:opacity-50"
                        title="Send Message">
                    <i class="fa-solid fa-paper-plane text-xs"></i>
                </button>
            </form>
        </div>

        <!-- Floating AI Guide Button with Morphing Animation & Shared bottom-6 right-6 Positioning -->
        <button @click="openAI = !openAI"
                x-show="!openAI"
                x-transition:enter="transition ease-out duration-300 transform"
                x-transition:enter-start="opacity-0 scale-75"
                x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-300 transform"
                x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-75"
                id="floatingAiGuideBtn"
                title="Toggle AI Career Guide"
                style="transform-origin: bottom right;"
                class="fixed bottom-6 right-6 z-[99999] h-12 sm:h-14 px-4 sm:px-5 rounded-full bg-gradient-to-r from-[#00f2fe] via-sky-400 to-blue-600 flex items-center justify-center gap-2.5 shadow-[0_0_25px_rgba(0,242,254,0.55)] hover:shadow-[0_0_35px_rgba(0,242,254,0.75)] hover:scale-105 active:scale-95 transition-all duration-300 ease-in-out cursor-pointer origin-bottom-right border border-white/30 overflow-hidden text-slate-950 group">
            
            <i class="fa-solid fa-wand-magic-sparkles text-sm sm:text-base text-slate-950 group-hover:rotate-12 transition-transform"></i>
            <span class="text-xs sm:text-sm font-black font-display tracking-tight text-slate-950 hidden sm:inline">✦ Ask PathSeeker</span>
        </button>

        <!-- Scroll to Top Button -->
        <button id="scrollToTopBtn"
                onclick="window.scrollTo({top: 0, behavior: 'smooth'})"
                title="Scroll to Top"
                aria-label="Scroll to top"
                class="fixed bottom-24 right-7 z-[9999] w-11 h-11 rounded-full bg-white dark:bg-[#080B12] border border-slate-200 dark:border-white/10 text-slate-700 dark:text-white shadow-xl flex items-center justify-center hover:bg-slate-100 dark:hover:bg-slate-800 transition-all cursor-pointer opacity-0 translate-y-4 duration-300">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-slate-700 dark:text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 15l7-7 7 7" />
            </svg>
        </button>
    </div>

    <!-- Custom Desktop Cursor Indicator -->
    <div id="customCursor" class="hidden md:block pointer-events-none" aria-hidden="true"></div>

    {{-- ══════════════════ GLOBAL COMMAND PALETTE (CTRL+K / CMD+K) ══════════════════ --}}
    <div id="commandPaletteModal"
         class="fixed inset-0 z-50 flex items-start justify-center pt-16 sm:pt-24 px-4 bg-black/80  opacity-0 pointer-events-none transition-opacity duration-200"
         onclick="handleCommandPaletteBackdrop(event)">
        
        <div id="commandPaletteCard"
             class="relative w-full max-w-2xl rounded-3xl bg-[#090b16]/95 border border-purple-500/30 shadow-[0_20px_60px_rgba(0,0,0,0.8)] overflow-hidden scale-95 transition-transform duration-200">
            
            {{-- Top Accent Line --}}
            <div class="h-1 w-full bg-gradient-to-r from-cyan-400 via-sky-500 to-blue-600"></div>

            {{-- Search Bar Header --}}
            <div class="p-4 sm:p-5 border-b border-white/[0.08] flex items-center gap-3.5 bg-white/[0.02]">
                <i class="fa-solid fa-magnifying-glass text-purple-400 text-sm pl-2"></i>
                <input type="text"
                       id="cmdPaletteInput"
                       placeholder="Type a command or destination (e.g. Careers, Quiz, AI, Toolkits)..."
                       autocomplete="off"
                       class="w-full bg-transparent text-sm sm:text-base text-white placeholder-slate-500 focus:outline-none font-medium">
                <kbd class="px-2 py-0.5 rounded-lg text-[10px] font-mono font-semibold bg-white/10 text-slate-400 border border-white/10 shrink-0">ESC</kbd>
            </div>

            {{-- Dynamic Filterable Command List --}}
            <div class="p-3 max-h-80 overflow-y-auto space-y-4 scrollbar-thin" id="cmdResultsList">
                
                {{-- Group: Navigation --}}
                <div class="cmd-group space-y-1">
                    <div class="px-3 text-[10px] font-bold uppercase tracking-wider text-slate-500">Primary Navigation</div>
                    
                    <a href="{{ route('home') }}" class="cmd-item flex items-center justify-between p-3 rounded-2xl hover:bg-purple-500/15 border border-transparent hover:border-purple-500/30 transition-colors group cursor-pointer" data-keywords="home portal landing start">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-xl bg-indigo-500/15 text-indigo-400 flex items-center justify-center text-xs shrink-0 group-hover:scale-110 transition-transform">
                                <i class="fa-solid fa-house"></i>
                            </div>
                            <div>
                                <h4 class="text-xs sm:text-sm font-bold text-white group-hover:text-purple-300">Home Portal</h4>
                                <p class="text-[11px] text-slate-400">Main overview &amp; AI Career Match preview</p>
                            </div>
                        </div>
                        <i class="fa-solid fa-arrow-right text-[10px] text-slate-500 group-hover:text-purple-300 group-hover:translate-x-1 transition-all"></i>
                    </a>

                    <a href="{{ route('careers.index') }}" class="cmd-item flex items-center justify-between p-3 rounded-2xl hover:bg-purple-500/15 border border-transparent hover:border-purple-500/30 transition-colors group cursor-pointer" data-keywords="careers career bank tracks explore jobs salary demand roadmap">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-xl bg-purple-500/15 text-purple-400 flex items-center justify-center text-xs shrink-0 group-hover:scale-110 transition-transform">
                                <i class="fa-solid fa-compass"></i>
                            </div>
                            <div>
                                <h4 class="text-xs sm:text-sm font-bold text-white group-hover:text-purple-300">Career Bank</h4>
                                <p class="text-[11px] text-slate-400">Explore 15+ tech tracks, comparison matrix &amp; roadmaps</p>
                            </div>
                        </div>
                        <i class="fa-solid fa-arrow-right text-[10px] text-slate-500 group-hover:text-purple-300 group-hover:translate-x-1 transition-all"></i>
                    </a>

                    <a href="{{ route('quiz.index') }}" class="cmd-item flex items-center justify-between p-3 rounded-2xl hover:bg-purple-500/15 border border-transparent hover:border-purple-500/30 transition-colors group cursor-pointer" data-keywords="quiz interest assessment test match alignment">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-xl bg-pink-500/15 text-pink-400 flex items-center justify-center text-xs shrink-0 group-hover:scale-110 transition-transform">
                                <i class="fa-solid fa-brain"></i>
                            </div>
                            <div>
                                <h4 class="text-xs sm:text-sm font-bold text-white group-hover:text-purple-300">Career Interest Quiz</h4>
                                <p class="text-[11px] text-slate-400">Discover your cognitive alignment &amp; top job matches</p>
                            </div>
                        </div>
                        <i class="fa-solid fa-arrow-right text-[10px] text-slate-500 group-hover:text-purple-300 group-hover:translate-x-1 transition-all"></i>
                    </a>

                    <a href="{{ route('multimedia.index') }}" class="cmd-item flex items-center justify-between p-3 rounded-2xl hover:bg-purple-500/15 border border-transparent hover:border-purple-500/30 transition-colors group cursor-pointer" data-keywords="multimedia videos video stream masterclass podcast learn">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-xl bg-rose-500/15 text-rose-400 flex items-center justify-center text-xs shrink-0 group-hover:scale-110 transition-transform">
                                <i class="fa-solid fa-play"></i>
                            </div>
                            <div>
                                <h4 class="text-xs sm:text-sm font-bold text-white group-hover:text-purple-300">Multimedia Center</h4>
                                <p class="text-[11px] text-slate-400">Stream 4K masterclasses &amp; technical walkthroughs</p>
                            </div>
                        </div>
                        <i class="fa-solid fa-arrow-right text-[10px] text-slate-500 group-hover:text-purple-300 group-hover:translate-x-1 transition-all"></i>
                    </a>

                    <a href="{{ route('resources.index') }}" class="cmd-item flex items-center justify-between p-3 rounded-2xl hover:bg-purple-500/15 border border-transparent hover:border-purple-500/30 transition-colors group cursor-pointer" data-keywords="resources toolkits blueprints download pdf cheat sheet templates">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-xl bg-sky-500/15 text-sky-400 flex items-center justify-center text-xs shrink-0 group-hover:scale-110 transition-transform">
                                <i class="fa-solid fa-book-bookmark"></i>
                            </div>
                            <div>
                                <h4 class="text-xs sm:text-sm font-bold text-white group-hover:text-purple-300">Resource Library</h4>
                                <p class="text-[11px] text-slate-400">Download verified system design cheat sheets &amp; blueprints</p>
                            </div>
                        </div>
                        <i class="fa-solid fa-arrow-right text-[10px] text-slate-500 group-hover:text-purple-300 group-hover:translate-x-1 transition-all"></i>
                    </a>

                    <a href="{{ route('dashboard') }}" class="cmd-item flex items-center justify-between p-3 rounded-2xl hover:bg-purple-500/15 border border-transparent hover:border-purple-500/30 transition-colors group cursor-pointer" data-keywords="dashboard passport readiness profile stats progress">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-xl bg-emerald-500/15 text-emerald-400 flex items-center justify-center text-xs shrink-0 group-hover:scale-110 transition-transform">
                                <i class="fa-solid fa-id-card"></i>
                            </div>
                            <div>
                                <h4 class="text-xs sm:text-sm font-bold text-white group-hover:text-purple-300">Career Operating System</h4>
                                <p class="text-[11px] text-slate-400">Personalized dashboard, Readiness Index &amp; saved tracks</p>
                            </div>
                        </div>
                        <i class="fa-solid fa-arrow-right text-[10px] text-slate-500 group-hover:text-purple-300 group-hover:translate-x-1 transition-all"></i>
                    </a>
                </div>

                {{-- Group: Quick Actions --}}
                <div class="cmd-group space-y-1 pt-2 border-t border-white/[0.05]">
                    <div class="px-3 text-[10px] font-bold uppercase tracking-wider text-slate-500">Quick Filters &amp; Actions</div>

                    <a href="{{ route('careers.index', ['search' => 'Full-Stack']) }}" class="cmd-item flex items-center justify-between p-3 rounded-2xl hover:bg-purple-500/15 border border-transparent hover:border-purple-500/30 transition-colors group cursor-pointer" data-keywords="fullstack web developer laravel react vue backend frontend">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-xl bg-indigo-500/15 text-indigo-400 flex items-center justify-center text-xs shrink-0">
                                <i class="fa-solid fa-code"></i>
                            </div>
                            <div>
                                <h4 class="text-xs sm:text-sm font-bold text-white group-hover:text-purple-300">Full-Stack Web Architect Roles</h4>
                                <p class="text-[11px] text-slate-400">Filter software engineering careers</p>
                            </div>
                        </div>
                        <span class="text-[10px] font-mono text-indigo-400">Filter</span>
                    </a>

                    <a href="{{ route('careers.index', ['domain' => 'Cloud & Infrastructure']) }}" class="cmd-item flex items-center justify-between p-3 rounded-2xl hover:bg-purple-500/15 border border-transparent hover:border-purple-500/30 transition-colors group cursor-pointer" data-keywords="cloud devops aws gcp kubernetes terraform infrastructure">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-xl bg-sky-500/15 text-sky-400 flex items-center justify-center text-xs shrink-0">
                                <i class="fa-solid fa-cloud"></i>
                            </div>
                            <div>
                                <h4 class="text-xs sm:text-sm font-bold text-white group-hover:text-purple-300">Cloud &amp; DevOps Engineering</h4>
                                <p class="text-[11px] text-slate-400">Filter cloud infrastructure pathways</p>
                            </div>
                        </div>
                        <span class="text-[10px] font-mono text-sky-400">Filter</span>
                    </a>

                    <a href="{{ route('careers.index', ['search' => 'AI']) }}" class="cmd-item flex items-center justify-between p-3 rounded-2xl hover:bg-purple-500/15 border border-transparent hover:border-purple-500/30 transition-colors group cursor-pointer" data-keywords="ai machine learning python pytorch data artificial intelligence">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-xl bg-purple-500/15 text-purple-400 flex items-center justify-center text-xs shrink-0">
                                <i class="fa-solid fa-microchip"></i>
                            </div>
                            <div>
                                <h4 class="text-xs sm:text-sm font-bold text-white group-hover:text-purple-300">AI &amp; Machine Learning Engineering</h4>
                                <p class="text-[11px] text-slate-400">Filter AI and data science pathways</p>
                            </div>
                        </div>
                        <span class="text-[10px] font-mono text-purple-400">Filter</span>
                    </a>

                    <button type="button" onclick="toggleTheme(); closeCommandPalette();" class="cmd-item w-full flex items-center justify-between p-3 rounded-2xl hover:bg-purple-500/15 border border-transparent hover:border-purple-500/30 transition-colors group text-left cursor-pointer" data-keywords="theme dark light mode toggle switch color">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-xl bg-amber-500/15 text-amber-400 flex items-center justify-center text-xs shrink-0">
                                <i class="fa-solid fa-circle-half-stroke"></i>
                            </div>
                            <div>
                                <h4 class="text-xs sm:text-sm font-bold text-white group-hover:text-purple-300">Toggle Dark / Light Theme</h4>
                                <p class="text-[11px] text-slate-400">Switch application color scheme</p>
                            </div>
                        </div>
                        <span class="text-[10px] font-mono text-amber-400">Action</span>
                    </button>
                </div>

                {{-- No Results State --}}
                <div id="cmdNoResults" class="hidden py-8 text-center space-y-2">
                    <i class="fa-solid fa-magnifying-glass text-slate-600 text-xl"></i>
                    <p class="text-xs text-slate-400 font-medium">No matching destinations or commands found.</p>
                </div>

            </div>

            {{-- Footer Shortcuts Bar --}}
            <div class="px-5 py-3 border-t border-white/[0.08] bg-white/[0.02] flex items-center justify-between text-[11px] text-slate-500">
                <div class="flex items-center gap-3">
                    <span class="flex items-center gap-1"><kbd class="px-1 py-0.5 rounded bg-white/5 border border-white/10 font-mono text-[9px]">↑↓</kbd> Navigate</span>
                    <span class="flex items-center gap-1"><kbd class="px-1 py-0.5 rounded bg-white/5 border border-white/10 font-mono text-[9px]">↵</kbd> Select</span>
                    <span class="flex items-center gap-1"><kbd class="px-1 py-0.5 rounded bg-white/5 border border-white/10 font-mono text-[9px]">ESC</kbd> Close</span>
                </div>
                <span class="font-mono text-purple-400 text-[10px]">PathSeeker Command OS</span>
            </div>

        </div>
    </div>

    <!-- ══════════════════ SCRIPTS: THEME, SCROLL OBSERVER, CURSOR & COMMAND PALETTE ══════════════════ -->
    <script>
        // 0. Real-Time AI Career Guide Chatbot Controller
        function initChatbot() {
            return {
                openAI: false,
                loading: false,
                messages: [
                    { sender: 'ai', text: 'Hello! I am your PathSeeker AI Career Navigator. Ask me about tech domains, roadmaps, salaries, or skills!', time: 'Just now' }
                ],
                userInput: '',
                quickQuestions: [
                    'Top in-demand tech roles for 2026',
                    'How should I prepare for Full-Stack?',
                    'Which track matches my skills?'
                ],
                formatText(text) {
                    if (!text) return '';
                    let escaped = text
                        .replace(/&/g, '&amp;')
                        .replace(/</g, '&lt;')
                        .replace(/>/g, '&gt;');
                    // Markdown bold: **text**
                    escaped = escaped.replace(/\*\*(.*?)\*\*/g, '<strong class="font-bold text-slate-950 dark:text-white">$1</strong>');
                    // Markdown links: [title](url)
                    escaped = escaped.replace(/\[(.*?)\]\((https?:\/\/[^\s]+|\/[^\s]+)\)/g, '<a href="$2" class="text-indigo-600 dark:text-indigo-400 font-bold underline hover:text-purple-600 dark:hover:text-purple-300">$1</a>');
                    // Line breaks
                    escaped = escaped.replace(/\n/g, '<br>');
                    return escaped;
                },
                async sendMessage(text) {
                    const msg = (text || this.userInput).trim();
                    if (!msg || this.loading) return;
                    
                    const now = new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
                    this.messages.push({ sender: 'user', text: msg, time: now });
                    this.userInput = '';
                    this.loading = true;
                    
                    this.$nextTick(() => {
                        const box = document.getElementById('chatMessagesContainer');
                        if (box) box.scrollTop = box.scrollHeight;
                    });
                    
                    try {
                        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';
                        const response = await fetch('{{ url('/chat/message') }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'Accept': 'application/json',
                                'X-CSRF-TOKEN': csrfToken
                            },
                            body: JSON.stringify({ message: msg })
                        });
                        
                        const data = await response.json();
                        const reply = data.reply || 'I am ready to help you navigate your career options. Explore our Career Bank and Interest Quiz for structured roadmaps!';
                        this.messages.push({ sender: 'ai', text: reply, time: new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' }) });
                    } catch (error) {
                        this.messages.push({ 
                            sender: 'ai', 
                            text: 'I recommend taking our **[Interest Quiz]({{ url('/quiz') }})** or exploring the **[Career Bank]({{ url('/careers') }})** to discover matched pathways!', 
                            time: new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' }) 
                        });
                    } finally {
                        this.loading = false;
                        this.$nextTick(() => {
                            const box = document.getElementById('chatMessagesContainer');
                            if (box) box.scrollTop = box.scrollHeight;
                        });
                    }
                }
            };
        }

        // 1. Theme Management
        const html = document.documentElement;

        function syncThemeIcon(theme) {
            const icon = document.getElementById('themeIcon');
            if (!icon) return;
            if (theme === 'light') {
                icon.classList.remove('fa-moon');
                icon.classList.add('fa-sun');
            } else {
                icon.classList.remove('fa-sun');
                icon.classList.add('fa-moon');
            }
        }

        function applyTheme(theme) {
            if (theme === 'light') {
                html.classList.remove('dark');
                html.setAttribute('data-theme', 'light');
            } else {
                html.classList.add('dark');
                html.setAttribute('data-theme', 'dark');
            }
            syncThemeIcon(theme);
        }

        // Synchronize icon state on load
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', function() {
                syncThemeIcon(html.classList.contains('dark') ? 'dark' : 'light');
            });
        } else {
            syncThemeIcon(html.classList.contains('dark') ? 'dark' : 'light');
        }

        function toggleTheme() {
            const isDark = html.classList.contains('dark');
            const next = isDark ? 'light' : 'dark';
            localStorage.setItem('theme', next);
            applyTheme(next);
        }

        // Global Font Size Adjustment (WCAG A11y Scaling)
        function adjustFontSize(delta) {
            const scales = ['90%', '100%', '115%', '125%'];
            let currentIdx = parseInt(localStorage.getItem('fontSizeScaleIndex') || '1');
            currentIdx = Math.max(0, Math.min(scales.length - 1, currentIdx + delta));
            localStorage.setItem('fontSizeScaleIndex', currentIdx.toString());
            html.style.fontSize = scales[currentIdx];
            
            // Dispatch notification toast
            window.dispatchEvent(new CustomEvent('fontsizechange', { detail: { scale: scales[currentIdx] } }));
        }

        // 2. Global Command Palette Controller
        let activeCmdIndex = -1;

        function openCommandPalette() {
            const modal = document.getElementById('commandPaletteModal');
            const card = document.getElementById('commandPaletteCard');
            const input = document.getElementById('cmdPaletteInput');

            if (!modal || !card) return;

            modal.classList.remove('opacity-0', 'pointer-events-none');
            modal.classList.add('opacity-100');
            card.classList.remove('scale-95');
            card.classList.add('scale-100');
            
            if (input) {
                input.value = '';
                filterCommandList('');
                setTimeout(() => input.focus(), 50);
            }
            document.body.style.overflow = 'hidden';
        }

        function closeCommandPalette() {
            const modal = document.getElementById('commandPaletteModal');
            const card = document.getElementById('commandPaletteCard');

            if (!modal || !card) return;

            modal.classList.remove('opacity-100');
            modal.classList.add('opacity-0', 'pointer-events-none');
            card.classList.remove('scale-100');
            card.classList.add('scale-95');
            document.body.style.overflow = '';
            activeCmdIndex = -1;
        }

        function handleCommandPaletteBackdrop(e) {
            if (e.target.id === 'commandPaletteModal') {
                closeCommandPalette();
            }
        }

        function filterCommandList(query) {
            const q = query.trim().toLowerCase();
            const items = document.querySelectorAll('.cmd-item');
            const noResults = document.getElementById('cmdNoResults');
            let visibleCount = 0;

            items.forEach(item => {
                const text = item.textContent.toLowerCase();
                const keywords = (item.getAttribute('data-keywords') || '').toLowerCase();
                if (!q || text.includes(q) || keywords.includes(q)) {
                    item.style.display = 'flex';
                    visibleCount++;
                } else {
                    item.style.display = 'none';
                }
            });

            if (noResults) {
                noResults.classList.toggle('hidden', visibleCount > 0);
            }
            activeCmdIndex = -1;
            highlightActiveCmdItem();
        }

        function getVisibleCmdItems() {
            return Array.from(document.querySelectorAll('.cmd-item')).filter(el => el.style.display !== 'none');
        }

        function highlightActiveCmdItem() {
            const visible = getVisibleCmdItems();
            visible.forEach((el, i) => {
                if (i === activeCmdIndex) {
                    el.classList.add('bg-purple-500/25', 'border-purple-500/50');
                    el.scrollIntoView({ block: 'nearest', behavior: 'smooth' });
                } else {
                    el.classList.remove('bg-purple-500/25', 'border-purple-500/50');
                }
            });
        }

        // 3. Exact Cinematic Staggered Scroll-Triggered Reveal Engine (60fps IntersectionObserver)
        (function initScrollRevealEngine() {
            const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
            
            function setupObserver() {
                if (prefersReducedMotion) {
                    document.querySelectorAll('.reveal-element, .reveal-on-scroll, [data-reveal], main section, .career-card, .app-card, .glass-panel, .card-tilt-3d, .grid > div').forEach(el => {
                        el.classList.add('revealed');
                    });
                    return;
                }

                const observerOptions = {
                    root: null,
                    rootMargin: '0px 0px -40px 0px',
                    threshold: 0.08
                };

                const revealObserver = new IntersectionObserver((entries, observer) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            entry.target.classList.add('revealed');
                            // ONE-TIME TRIGGER: Locks in place, does not reverse on scroll up
                            observer.unobserve(entry.target);
                        }
                    });
                }, observerOptions);

                // Auto-collect all targeted sections, headings, cards, and containers
                const selectors = [
                    '.reveal-element',
                    '.reveal-on-scroll',
                    '[data-reveal]',
                    'main > section',
                    'main > div > section',
                    '.app-card',
                    '.career-card',
                    '.glass-panel',
                    '.card-tilt-3d',
                    '#aiAdvisorOutput',
                    '.perspective-stage',
                    '.dashboard-widget',
                    '.control-room-card'
                ];

                const elements = document.querySelectorAll(selectors.join(', '));
                elements.forEach(el => {
                    if (!el.dataset.revealObserved) {
                        el.dataset.revealObserved = 'true';
                        
                        // Check if in initial viewport to avoid flashing
                        const rect = el.getBoundingClientRect();
                        if (rect.top < window.innerHeight && rect.bottom > 0) {
                            el.classList.add('revealed');
                        } else {
                            if (!el.classList.contains('reveal-element') && !el.classList.contains('reveal-on-scroll') && !el.hasAttribute('data-reveal')) {
                                el.classList.add('reveal-on-scroll');
                            }
                            revealObserver.observe(el);
                        }
                    }
                });

                // Auto-stagger card grids (.grid > div) with 50-100ms sequential intervals (75ms)
                document.querySelectorAll('.grid, [data-stagger-grid]').forEach(grid => {
                    const children = Array.from(grid.children);
                    if (children.length > 1 && !grid.dataset.staggerInit) {
                        grid.dataset.staggerInit = 'true';
                        children.forEach((child, index) => {
                            if (!child.style.transitionDelay && !child.classList.contains('stagger-1')) {
                                const delay = Math.min((index % 6) * 75, 450);
                                child.style.transitionDelay = `${delay}ms`;
                            }
                            if (!child.classList.contains('reveal-element') && !child.classList.contains('reveal-on-scroll') && !child.hasAttribute('data-reveal')) {
                                child.classList.add('reveal-on-scroll');
                                const r = child.getBoundingClientRect();
                                if (r.top < window.innerHeight && r.bottom > 0) {
                                    child.classList.add('revealed');
                                } else {
                                    revealObserver.observe(child);
                                }
                            }
                        });
                    }
                });
            }

            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', setupObserver);
            } else {
                setupObserver();
            }

            window.initScrollReveals = setupObserver;
        })();

        // 4. Universal 3D Tilt & Mouse-Tracking Light Reflection Engine Across All Cards
        (function initUniversalTiltEngine() {
            const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
            if (prefersReducedMotion || !window.matchMedia('(pointer: fine)').matches) return;

            function setupCardTilt() {
                const cardSelectors = [
                    '.card-tilt-3d',
                    '.career-card',
                    '.app-card',
                    '.glass-panel',
                    '[data-tilt]',
                    '.grid > .rounded-3xl',
                    '.grid > div[class*="border"]',
                    '.dashboard-widget',
                    '#aiAdvisorOutput'
                ];

                const cards = document.querySelectorAll(cardSelectors.join(', '));
                cards.forEach(card => {
                    if (card.dataset.tiltInitialized) return;
                    card.dataset.tiltInitialized = 'true';

                    card.style.transformStyle = 'preserve-3d';
                    card.style.transition = 'transform 0.18s cubic-bezier(0.25, 1, 0.5, 1), box-shadow 0.25s ease, border-color 0.25s ease';

                    // Inject glare reflection overlay if not already present
                    if (!card.querySelector('.tilt-glare-overlay')) {
                        const glare = document.createElement('div');
                        glare.className = 'tilt-glare-overlay';
                        card.appendChild(glare);
                    }

                    let rafId = null;

                    card.addEventListener('mousemove', (e) => {
                        const rect = card.getBoundingClientRect();
                        const x = e.clientX - rect.left;
                        const y = e.clientY - rect.top;
                        const centerX = rect.width / 2;
                        const centerY = rect.height / 2;

                        card.style.setProperty('--mouse-x', `${x.toFixed(1)}px`);
                        card.style.setProperty('--mouse-y', `${y.toFixed(1)}px`);

                        if (rafId) cancelAnimationFrame(rafId);
                        rafId = requestAnimationFrame(() => {
                            const rotateX = ((y - centerY) / centerY) * -5.5;
                            const rotateY = ((x - centerX) / centerX) * 6.5;
                            card.style.transform = `perspective(1000px) rotateX(${rotateX.toFixed(2)}deg) rotateY(${rotateY.toFixed(2)}deg) translateY(-3px) scale3d(1.01, 1.01, 1.01)`;
                        });
                    });

                    card.addEventListener('mouseleave', () => {
                        if (rafId) cancelAnimationFrame(rafId);
                        card.style.transform = 'perspective(1000px) rotateX(0deg) rotateY(0deg) translateY(0px) scale3d(1, 1, 1)';
                    });
                });
            }

            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', setupCardTilt);
            } else {
                setupCardTilt();
            }

            window.initUniversalTilt = setupCardTilt;
        })();

        document.addEventListener('DOMContentLoaded', () => {

            // Custom Desktop Cursor Physics
            const cursor = document.getElementById('customCursor');
            if (cursor && !prefersReducedMotion && window.matchMedia('(pointer: fine)').matches) {
                document.addEventListener('mousemove', (e) => {
                    cursor.classList.add('active');
                    cursor.style.transform = `translate(${e.clientX}px, ${e.clientY}px) translate(-50%, -50%)`;
                });
                document.addEventListener('mouseleave', () => {
                    cursor.classList.remove('active');
                });

                document.querySelectorAll('a, button, input, select, .card-tilt').forEach(el => {
                    el.addEventListener('mouseenter', () => cursor.classList.add('hovered'));
                    el.addEventListener('mouseleave', () => cursor.classList.remove('hovered'));
                });
            }

            // Command Palette Input Listener
            const cmdInput = document.getElementById('cmdPaletteInput');
            if (cmdInput) {
                cmdInput.addEventListener('input', (e) => {
                    filterCommandList(e.target.value);
                });

                cmdInput.addEventListener('keydown', (e) => {
                    const visible = getVisibleCmdItems();
                    if (e.key === 'ArrowDown') {
                        e.preventDefault();
                        if (visible.length > 0) {
                            activeCmdIndex = (activeCmdIndex + 1) % visible.length;
                            highlightActiveCmdItem();
                        }
                    } else if (e.key === 'ArrowUp') {
                        e.preventDefault();
                        if (visible.length > 0) {
                            activeCmdIndex = (activeCmdIndex - 1 + visible.length) % visible.length;
                            highlightActiveCmdItem();
                        }
                    } else if (e.key === 'Enter') {
                        e.preventDefault();
                        if (visible.length > 0 && activeCmdIndex >= 0 && activeCmdIndex < visible.length) {
                            visible[activeCmdIndex].click();
                        } else if (visible.length > 0) {
                            visible[0].click();
                        }
                    }
                });
            }

            // Scroll to Top Button Visibility
            const scrollBtn = document.getElementById('scrollToTopBtn');
            if (scrollBtn) {
                window.addEventListener('scroll', () => {
                    if (window.scrollY > 280) {
                        scrollBtn.classList.remove('opacity-0', 'translate-y-4', 'pointer-events-none');
                        scrollBtn.classList.add('opacity-100', 'translate-y-0', 'pointer-events-auto');
                    } else {
                        scrollBtn.classList.add('opacity-0', 'translate-y-4', 'pointer-events-none');
                        scrollBtn.classList.remove('opacity-100', 'translate-y-0', 'pointer-events-auto');
                    }
                });
            }

            // Global Keyboard Shortcut: Cmd/Ctrl + K or Escape
            document.addEventListener('keydown', (e) => {
                if ((e.metaKey || e.ctrlKey) && e.key.toLowerCase() === 'k') {
                    e.preventDefault();
                    const modal = document.getElementById('commandPaletteModal');
                    if (modal && modal.classList.contains('opacity-100')) {
                        closeCommandPalette();
                    } else {
                        openCommandPalette();
                    }
                } else if (e.key === 'Escape') {
                    closeCommandPalette();
                }
            });
        });
    </script>
</body>
</html>