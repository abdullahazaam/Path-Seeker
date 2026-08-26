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

    <!-- GSAP & ScrollTrigger Animation Engine -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>

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
            --color-primary: #7657FF;
            --color-primary-hover: #6544ea;
            --color-primary-light: rgba(118, 87, 255, 0.08);
            --color-secondary: #12CFF3;
            --color-secondary-hover: #00b4d8;
            --color-bg: #F8FAFC;
            --color-surface: #FFFFFF;
            --color-surface-secondary: #F5F6FA;
            --color-surface-hover: #F0F2F8;
            --color-text: #111827;
            --color-text-muted: #667085;
            --color-text-dim: #98A2B3;
            --color-border: rgba(15, 23, 42, 0.07);
            --color-border-hover: rgba(118, 87, 255, 0.30);
            --color-success: #10b981;
            --color-warning: #f59e0b;
            --color-danger: #ef4444;
            --radius-sm: 8px;
            --radius-md: 12px;
            --radius-lg: 16px;
            --radius-xl: 24px;
            --radius-full: 9999px;
            --shadow-glass: 0 4px 20px -2px rgba(15, 23, 42, 0.04), 0 2px 6px -1px rgba(15, 23, 42, 0.02);
            --shadow-neon-primary: 0 4px 20px rgba(118, 87, 255, 0.20);
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
            background: #FFFFFF;
            border: 1px solid rgba(15, 23, 42, 0.07);
            box-shadow: 0 4px 20px -2px rgba(15, 23, 42, 0.04), 0 2px 6px -1px rgba(15, 23, 42, 0.02);
        }
        .app-card:hover, .career-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px -4px rgba(0, 0, 0, 0.45);
            border-color: rgba(255, 255, 255, 0.18);
        }
        html:not(.dark) .app-card:hover, html:not(.dark) .career-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px -4px rgba(15, 23, 42, 0.08), 0 4px 12px -2px rgba(15, 23, 42, 0.03);
            border-color: rgba(118, 87, 255, 0.25);
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
            background: #FFFFFF;
            border: 1px solid rgba(15, 23, 42, 0.08);
            color: #111827;
            box-shadow: 0 2px 8px -1px rgba(15, 23, 42, 0.04);
        }
        .btn-secondary:hover {
            border-color: rgba(0, 242, 254, 0.40);
            color: #00f2fe;
            transform: translateY(-1px);
        }
        html:not(.dark) .btn-secondary:hover {
            border-color: rgba(118, 87, 255, 0.4);
            color: #7657FF;
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
        html:not(.dark) .btn-outline {
            border-color: rgba(118, 87, 255, 0.35);
            color: #7657FF;
        }
        html:not(.dark) .btn-outline:hover {
            background: rgba(118, 87, 255, 0.08);
            border-color: #7657FF;
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

        /* 2026 Premium Signature Glassmorphic Container & Card Architecture */
        .glass-panel, .signature-container {
            background: rgba(15, 23, 42, 0.65);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.10);
            box-shadow: 0 16px 36px -10px rgba(0, 0, 0, 0.45), inset 0 1px 0 0 rgba(255, 255, 255, 0.08);
            position: relative;
        }
        html:not(.dark) .glass-panel, html:not(.dark) .signature-container {
            background: #FFFFFF;
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(15, 23, 42, 0.07);
            box-shadow: 0 16px 35px -10px rgba(15, 23, 42, 0.05), inset 0 1px 0 0 rgba(255, 255, 255, 0.95);
            position: relative;
        }
        .signature-card {
            background: #080b12;
            border: 1px solid rgba(255, 255, 255, 0.10);
            transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
        }
        html:not(.dark) .signature-card {
            background: #FFFFFF;
            border: 1px solid rgba(15, 23, 42, 0.07);
            box-shadow: 0 4px 20px -2px rgba(15, 23, 42, 0.04);
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
            background: rgba(255, 255, 255, 0.88);
            border: 1px solid rgba(15, 23, 42, 0.08);
            box-shadow: 0 12px 30px -8px rgba(15, 23, 42, 0.05), inset 0 1px 0 0 rgba(255, 255, 255, 1);
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
            background: linear-gradient(135deg, #7657FF 0%, #12CFF3 60%, #3b82f6 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        html:not(.dark) .grad-text-cyan {
            background: linear-gradient(135deg, #12CFF3 0%, #7657FF 60%, #3b82f6 100%);
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
            backface-visibility: hidden;
            -webkit-backface-visibility: hidden;
            will-change: transform;
            transform: translate3d(0, 0, 0);
            transition: transform 0.16s cubic-bezier(0.25, 1, 0.5, 1), box-shadow 0.3s ease;
        }
        .passport-card-3d:hover {
            box-shadow: 0 16px 40px -8px rgba(0, 0, 0, 0.45), inset 0 1px 0 0 rgba(255, 255, 255, 0.15);
        }

        /* ══════════════════ 90FPS UNIVERSAL GPU ACCELERATION & RENDER CONTAINMENT ══════════════════ */
        .card-tilt, 
        .card-tilt-3d, 
        .career-card, 
        [data-tilt], 
        .app-card, 
        .glass-panel,
        .signature-card,
        .signature-container,
        .dashboard-widget,
        .control-room-card {
            position: relative;
            transform-style: preserve-3d;
            backface-visibility: hidden;
            -webkit-backface-visibility: hidden;
            will-change: transform;
            transform: translate3d(0, 0, 0);
            -webkit-transform: translate3d(0, 0, 0);
            transition: transform 0.25s cubic-bezier(0.16, 1, 0.3, 1), box-shadow 0.25s cubic-bezier(0.16, 1, 0.3, 1), border-color 0.25s ease;
        }

        /* Long Scroll List & Card Grid Virtual Rendering Optimization (90FPS Core Web Vitals) */
        #careerCardsContainer > div,
        #multimediaGrid > div,
        #resourcesGrid > div,
        #storiesGrid > div,
        .stories-grid > div,
        .virtual-render-contain {
            content-visibility: auto;
            contain-intrinsic-size: 1px 400px;
        }
        
        .dark .card-tilt, 
        .dark .card-tilt-3d, 
        .dark .career-card, 
        .dark [data-tilt],
        .dark .app-card,
        .dark .glass-panel,
        .dark .dashboard-widget,
        .dark .control-room-card,
        .dark .grid > .rounded-3xl,
        .dark .grid > div[class*="rounded-3xl"] {
            box-shadow: 0 10px 30px -5px rgba(0, 0, 0, 0.5), 0 0 0 1px rgba(255, 255, 255, 0.06), inset 0 1px 0 0 rgba(255, 255, 255, 0.08);
        }

        .dark .card-tilt:hover, 
        .dark .card-tilt-3d:hover, 
        .dark .career-card:hover, 
        .dark [data-tilt]:hover,
        .dark .app-card:hover,
        .dark .glass-panel:hover,
        .dark .dashboard-widget:hover,
        .dark .control-room-card:hover,
        .dark .grid > .rounded-3xl:hover,
        .dark .grid > div[class*="rounded-3xl"]:hover {
            transform: translate3d(0, -3px, 0);
            border-color: rgba(0, 242, 254, 0.35);
            box-shadow: 0 16px 40px -8px rgba(0, 0, 0, 0.7), 0 0 25px rgba(0, 242, 254, 0.14), inset 0 1px 0 0 rgba(255, 255, 255, 0.12);
        }

        /* Glowing Sweep Button Effect */
        .btn-sweep {
            position: relative;
            overflow: hidden;
            transform: translate3d(0, 0, 0);
            will-change: transform;
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

        /* ══════════════════ EXACT STAGGERED SCROLL-TRIGGERED REVEAL SYSTEM (GPU COMPOSITED) ══════════════════ */
        .reveal-element,
        .reveal-on-scroll,
        [data-reveal] {
            opacity: 1;
            transform: translate3d(0, 0, 0);
            -webkit-transform: translate3d(0, 0, 0);
            backface-visibility: hidden;
            -webkit-backface-visibility: hidden;
            transition: opacity 0.5s cubic-bezier(0.16, 1, 0.3, 1), transform 0.5s cubic-bezier(0.16, 1, 0.3, 1);
            will-change: opacity, transform;
        }

        .reveal-element.reveal-hidden,
        .reveal-on-scroll.reveal-hidden,
        [data-reveal].reveal-hidden {
            opacity: 0 !important;
            transform: translate3d(0, 30px, 0) scale3d(0.98, 0.98, 1) !important;
            -webkit-transform: translate3d(0, 30px, 0) scale3d(0.98, 0.98, 1) !important;
        }

        /* Revealed State (locks in place, strictly composited) */
        .reveal-element.revealed,
        .reveal-on-scroll.revealed,
        [data-reveal].revealed {
            opacity: 1 !important;
            transform: translate3d(0, 0, 0) scale3d(1, 1, 1) !important;
            -webkit-transform: translate3d(0, 0, 0) scale3d(1, 1, 1) !important;
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

        /* Category Accent Badges & Borders */
        .badge-software { border-color: rgba(118, 87, 255, 0.25); color: #7657FF; background: rgba(118, 87, 255, 0.08); }
        .badge-cloud { border-color: rgba(18, 207, 243, 0.25); color: #0284c7; background: rgba(18, 207, 243, 0.08); }
        .badge-ai { border-color: rgba(118, 87, 255, 0.25); color: #7657FF; background: rgba(118, 87, 255, 0.08); }
        .badge-cyber { border-color: rgba(52, 211, 153, 0.25); color: #059669; background: rgba(52, 211, 153, 0.08); }
        .badge-mobile { border-color: rgba(96, 165, 250, 0.25); color: #2563eb; background: rgba(96, 165, 250, 0.08); }
        .badge-design { border-color: rgba(192, 132, 252, 0.25); color: #7657FF; background: rgba(118, 87, 255, 0.08); }
        .badge-game { border-color: rgba(251, 191, 36, 0.25); color: #d97706; background: rgba(251, 191, 36, 0.08); }
        .badge-blockchain { border-color: rgba(45, 212, 191, 0.25); color: #0d9488; background: rgba(45, 212, 191, 0.08); }

        .dark .badge-software { border-color: rgba(168, 85, 247, 0.25); color: #c084fc; background: rgba(168, 85, 247, 0.08); }
        .dark .badge-cloud { border-color: rgba(56, 189, 248, 0.25); color: #38bdf8; background: rgba(56, 189, 248, 0.08); }
        .dark .badge-ai { border-color: rgba(0, 242, 254, 0.25); color: #00f2fe; background: rgba(0, 242, 254, 0.08); }
        .dark .badge-cyber { border-color: rgba(52, 211, 153, 0.25); color: #34d399; background: rgba(52, 211, 153, 0.08); }
        .dark .badge-mobile { border-color: rgba(96, 165, 250, 0.25); color: #60a5fa; background: rgba(96, 165, 250, 0.08); }
        .dark .badge-design { border-color: rgba(192, 132, 252, 0.25); color: #e879f9; background: rgba(232, 121, 249, 0.08); }
        .dark .badge-game { border-color: rgba(251, 191, 36, 0.25); color: #fbbf24; background: rgba(251, 191, 36, 0.08); }
        .dark .badge-blockchain { border-color: rgba(45, 212, 191, 0.25); color: #2dd4bf; background: rgba(45, 212, 191, 0.08); }

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
                background: radial-gradient(circle, rgba(118, 87, 255, 0.35) 0%, rgba(18, 207, 243, 0.10) 70%, transparent 100%);
                border: 1px solid rgba(15, 23, 42, 0.15);
                transform: translate(-50%, -50%);
                transition: width 0.25s ease, height 0.25s ease, background 0.25s ease, border-color 0.25s ease, opacity 0.25s ease;
                z-index: 99999;
                opacity: 0;
            }
            .dark #customCursor {
                background: radial-gradient(circle, rgba(168, 85, 247, 0.4) 0%, rgba(0, 242, 254, 0.10) 70%, transparent 100%);
                border: 1px solid rgba(255, 255, 255, 0.2);
            }
            #customCursor.active {
                opacity: 1;
            }
            #customCursor.hovered {
                width: 38px;
                height: 38px;
                background: radial-gradient(circle, rgba(118, 87, 255, 0.20) 0%, rgba(18, 207, 243, 0.10) 80%, transparent 100%);
                border-color: rgba(118, 87, 255, 0.4);
            }
            .dark #customCursor.hovered {
                background: radial-gradient(circle, rgba(168, 85, 247, 0.25) 0%, rgba(0, 242, 254, 0.10) 80%, transparent 100%);
                border-color: rgba(0, 242, 254, 0.4);
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

        /* ══════════════════ 3D GLASS BUBBLE STYLING & MOTION (90FPS GPU) ══════════════════ */
        .glass-bubble-3d {
            position: absolute;
            border-radius: 9999px;
            pointer-events: none;
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1.5px solid rgba(255, 255, 255, 0.85);
            box-shadow: inset -15px -15px 35px rgba(118, 87, 255, 0.20),
                        inset 15px 15px 35px rgba(255, 255, 255, 0.95),
                        0 25px 50px -10px rgba(30, 40, 70, 0.15);
            will-change: transform;
        }
        .glass-bubble-cyan {
            background: radial-gradient(circle at 35% 30%, rgba(255, 255, 255, 0.92) 0%, rgba(18, 207, 243, 0.32) 40%, rgba(118, 87, 255, 0.22) 75%, rgba(59, 130, 246, 0.35) 100%);
        }
        .glass-bubble-purple {
            background: radial-gradient(circle at 35% 30%, rgba(255, 255, 255, 0.92) 0%, rgba(118, 87, 255, 0.32) 40%, rgba(18, 207, 243, 0.20) 75%, rgba(139, 92, 246, 0.35) 100%);
        }
        .glass-bubble-blue {
            background: radial-gradient(circle at 35% 30%, rgba(255, 255, 255, 0.92) 0%, rgba(59, 130, 246, 0.30) 40%, rgba(18, 207, 243, 0.22) 75%, rgba(118, 87, 255, 0.32) 100%);
        }
        .glass-bubble-specular {
            position: absolute;
            top: 14%;
            left: 18%;
            width: 38%;
            height: 28%;
            border-radius: 9999px;
            background: radial-gradient(ellipse at center, rgba(255, 255, 255, 0.98) 0%, rgba(255, 255, 255, 0) 80%);
            transform: rotate(-35deg);
            filter: blur(1px);
        }

        @keyframes bubbleFloat1 {
            0%, 100% { transform: translate3d(0, 0, 0) scale(1); }
            50% { transform: translate3d(35px, -30px, 0) scale(1.05); }
        }
        @keyframes bubbleFloat2 {
            0%, 100% { transform: translate3d(0, 0, 0) scale(1); }
            50% { transform: translate3d(-40px, 35px, 0) scale(0.95); }
        }
        @keyframes bubbleFloat3 {
            0%, 100% { transform: translate3d(0, 0, 0) scale(1); }
            50% { transform: translate3d(30px, 40px, 0) scale(1.04); }
        }
        @keyframes bubbleFloat4 {
            0%, 100% { transform: translate3d(0, 0, 0) scale(1); }
            50% { transform: translate3d(-35px, -35px, 0) scale(0.96); }
        }
        .anim-bubble-1 { animation: bubbleFloat1 18s ease-in-out infinite; will-change: transform; }
        .anim-bubble-2 { animation: bubbleFloat2 22s ease-in-out infinite; will-change: transform; }
        .anim-bubble-3 { animation: bubbleFloat3 26s ease-in-out infinite; will-change: transform; }
        .anim-bubble-4 { animation: bubbleFloat4 20s ease-in-out infinite; will-change: transform; }

        /* ══════════════════ TRUE FROSTED GLASSMORHPISM HIERARCHY (LIGHT MODE ONLY) ══════════════════ */
        html:not(.dark) {
            background-color: #F8FAFC;
            color: #111827;
        }

        /* Base Body & Container Foundations */
        html:not(.dark) body {
            background-color: #F8FAFC !important;
            color: #111827 !important;
        }

        /* True Frosted Glassmorphism Across All Major Cards & Modules (Reference Standard) */
        html:not(.dark) .card-tilt,
        html:not(.dark) .card-tilt-3d,
        /* ══════════════════ 80-90% HIGH-TRANSLUCENCY GLASSMORPHISM HIERARCHY ══════════════════ */
        html:not(.dark) {
            background-color: #F8FAFC;
            color: #111827;
        }

        /* Base Body & Container Foundations */
        html:not(.dark) body {
            background-color: #F8FAFC !important;
            color: #111827 !important;
        }

        /* Light Mode High-Translucency (80-90%) Frosted Glass Cards */
        html:not(.dark) .card-tilt,
        html:not(.dark) .card-tilt-3d,
        html:not(.dark) .career-card,
        html:not(.dark) [data-tilt],
        html:not(.dark) .app-card,
        html:not(.dark) .glass-panel,
        html:not(.dark) .signature-card,
        html:not(.dark) .signature-container,
        html:not(.dark) .dashboard-widget,
        html:not(.dark) .control-room-card,
        html:not(.dark) .passport-card-3d,
        html:not(.dark) .bg-white,
        html:not(.dark) .bg-white\/90,
        html:not(.dark) .bg-white\/95 {
            background: rgba(255, 255, 255, 0.22) !important;
            backdrop-filter: blur(24px) saturate(190%) !important;
            -webkit-backdrop-filter: blur(24px) saturate(190%) !important;
            border: 1px solid rgba(255, 255, 255, 0.45) !important;
            box-shadow: 0 20px 50px -10px rgba(30, 40, 70, 0.07), inset 0 1px 0 rgba(255, 255, 255, 0.60) !important;
        }

        /* Light Mode Glass Card Hover State */
        html:not(.dark) .card-tilt:hover,
        html:not(.dark) .card-tilt-3d:hover,
        html:not(.dark) .career-card:hover,
        html:not(.dark) [data-tilt]:hover,
        html:not(.dark) .app-card:hover,
        html:not(.dark) .glass-panel:hover,
        html:not(.dark) .signature-card:hover,
        html:not(.dark) .dashboard-widget:hover,
        html:not(.dark) .control-room-card:hover,
        html:not(.dark) .grid > .rounded-3xl:hover,
        html:not(.dark) .grid > div[class*="rounded-3xl"]:hover {
            background: rgba(255, 255, 255, 0.35) !important;
            backdrop-filter: blur(24px) saturate(200%) !important;
            -webkit-backdrop-filter: blur(24px) saturate(200%) !important;
            border: 1px solid rgba(255, 255, 255, 0.70) !important;
            transform: translate3d(0, -3px, 0);
            box-shadow: 0 24px 60px -10px rgba(30, 40, 70, 0.12), inset 0 1px 0 rgba(255, 255, 255, 0.80), 0 0 0 1px rgba(118, 87, 255, 0.25) !important;
        }

        /* Light Mode Inner Panels & Secondary Containers */
        html:not(.dark) .bg-slate-50,
        html:not(.dark) .bg-slate-50\/50,
        html:not(.dark) .bg-slate-50\/60,
        html:not(.dark) .bg-slate-50\/80,
        html:not(.dark) .bg-slate-100,
        html:not(.dark) .bg-slate-100\/80,
        html:not(.dark) .bg-slate-100\/90,
        html:not(.dark) .inner-panel,
        html:not(.dark) .secondary-container {
            background-color: rgba(255, 255, 255, 0.15) !important;
            backdrop-filter: blur(16px) !important;
            -webkit-backdrop-filter: blur(16px) !important;
            border: 1px solid rgba(255, 255, 255, 0.35) !important;
        }

        /* Clean Boundaries across All Dividers */
        html:not(.dark) .border-slate-200,
        html:not(.dark) .border-slate-200\/80,
        html:not(.dark) .border-slate-200\/60,
        html:not(.dark) .border-slate-300,
        html:not(.dark) .divide-slate-100 > * + * {
            border-color: rgba(15, 23, 42, 0.08) !important;
        }

        /* Strict Light Mode Text Hierarchy */
        html:not(.dark) .text-slate-900 { color: #0f172a !important; }
        html:not(.dark) .text-slate-800 { color: #1e293b !important; }
        html:not(.dark) .text-slate-700 { color: #334155 !important; }
        html:not(.dark) .text-slate-600 { color: #475569 !important; }
        html:not(.dark) .text-slate-500 { color: #64748b !important; }
        html:not(.dark) .text-slate-400 { color: #94a3b8 !important; }
        html:not(.dark) .text-slate-300 { color: #cbd5e1 !important; }

        /* Preserve Intentional White Text on Buttons, Dark Containers, Modals & Footer in Light Mode */
        html:not(.dark) a.text-white,
        html:not(.dark) button.text-white,
        html:not(.dark) span.text-white,
        html:not(.dark) .btn-primary,
        html:not(.dark) .btn-danger,
        html:not(.dark) .btn-sweep,
        html:not(.dark) .btn-white-text,
        html:not(.dark) .bg-slate-900 .text-white,
        html:not(.dark) .bg-slate-950 .text-white,
        html:not(.dark) .bg-[#080B12] .text-white,
        html:not(.dark) footer .text-white,
        html:not(.dark) footer p,
        html:not(.dark) footer a {
            color: inherit;
        }
        html:not(.dark) .btn-primary,
        html:not(.dark) .btn-sweep,
        html:not(.dark) .btn-primary *,
        html:not(.dark) .btn-sweep * {
            color: #040812 !important;
        }
        html:not(.dark) .btn-danger,
        html:not(.dark) .btn-danger * {
            color: #FFFFFF !important;
        }
        html:not(.dark) footer .text-slate-400 { color: #94a3b8 !important; }
        html:not(.dark) footer .text-slate-500 { color: #64748b !important; }

        /* Light Mode Input Elements */
        html:not(.dark) .app-input,
        html:not(.dark) input:not([type="checkbox"]):not([type="radio"]):not([type="hidden"]):not([type="submit"]):not([type="button"]),
        html:not(.dark) select,
        html:not(.dark) textarea {
            background-color: rgba(255, 255, 255, 0.70) !important;
            backdrop-filter: blur(12px) !important;
            border-color: rgba(15, 23, 42, 0.16) !important;
            color: #0f172a !important;
        }
        html:not(.dark) input::placeholder,
        html:not(.dark) textarea::placeholder {
            color: #64748b !important;
        }
        html:not(.dark) input:focus,
        html:not(.dark) select:focus,
        html:not(.dark) textarea:focus {
            border-color: #7657FF !important;
            box-shadow: 0 0 0 3px rgba(118, 87, 255, 0.15) !important;
            color: #0f172a !important;
            background-color: rgba(255, 255, 255, 0.90) !important;
        }
        html:not(.dark) select.app-input option {
            background: #ffffff;
            color: #111827;
        }

        /* ══════════════════ UNIVERSAL DARK MODE 80-90% TRANSLUCENCY GLASSMORPHISM ══════════════════ */
        html.dark, .dark {
            background-color: #04060b;
            color: #F8FAFC;
        }

        /* Force 80-90% Translucency on ALL Dark Mode Section Containers, Wrapper Boxes & Feature Panels */
        html.dark section > div,
        html.dark main section > div,
        html.dark .card-tilt, .dark .card-tilt,
        html.dark .card-tilt-3d, .dark .card-tilt-3d,
        html.dark .career-card, .dark .career-card,
        html.dark [data-tilt], .dark [data-tilt],
        html.dark .app-card, .dark .app-card,
        html.dark .glass-panel, .dark .glass-panel,
        html.dark .signature-card, .dark .signature-card,
        html.dark .signature-container, .dark .signature-container,
        html.dark .dashboard-widget, .dark .dashboard-widget,
        html.dark .control-room-card, .dark .control-room-card,
        html.dark .passport-card-3d, .dark .passport-card-3d,
        html.dark .bg-slate-900, .dark .bg-slate-900,
        html.dark .bg-slate-900\/90, .dark .bg-slate-900\/90,
        html.dark .bg-slate-950, .dark .bg-slate-950,
        html.dark .bg-\[\#080B12\], .dark .bg-\[\#080B12\],
        html.dark .dark\:bg-\[\#080B12\], .dark .dark\:bg-\[\#080B12\],
        html.dark .dark\:bg-\[\#070b14\], .dark .dark\:bg-\[\#070b14\],
        html.dark .dark\:bg-\[\#0b0f19\], .dark .dark\:bg-\[\#0b0f19\],
        html.dark .dark\:bg-\[\#090d18\], .dark .dark\:bg-\[\#090d18\],
        html.dark .dark\:bg-\[\#070a13\], .dark .dark\:bg-\[\#070a13\],
        html.dark .dark\:bg-\[\#0c111e\], .dark .dark\:bg-\[\#0c111e\],
        html.dark .dark\:bg-\[\#0a0f1d\], .dark .dark\:bg-\[\#0a0f1d\],
        html.dark .dark\:bg-slate-900, .dark .dark\:bg-slate-900,
        html.dark .dark\:bg-slate-950, .dark .dark\:bg-slate-950,
        html.dark .dark\:bg-black\/40, .dark .dark\:bg-black\/40,
        html.dark .dark\:bg-black\/50, .dark .dark\:bg-black\/50,
        html.dark [class*="dark:bg-[#"], .dark [class*="dark:bg-[#"],
        html.dark [class*="dark:bg-slate-9"], .dark [class*="dark:bg-slate-9"] {
            background: rgba(8, 11, 18, 0.25) !important;
            background-color: rgba(8, 11, 18, 0.25) !important;
            backdrop-filter: blur(24px) saturate(180%) !important;
            -webkit-backdrop-filter: blur(24px) saturate(180%) !important;
            border: 1px solid rgba(255, 255, 255, 0.10) !important;
            box-shadow: 0 20px 50px -10px rgba(0, 0, 0, 0.45), inset 0 1px 0 rgba(255, 255, 255, 0.08) !important;
        }

        /* Dark Mode Glass Card Hover State */
        html.dark .card-tilt:hover, .dark .card-tilt:hover,
        html.dark .card-tilt-3d:hover, .dark .card-tilt-3d:hover,
        html.dark .career-card:hover, .dark .career-card:hover,
        html.dark [data-tilt]:hover, .dark [data-tilt]:hover,
        html.dark .app-card:hover, .dark .app-card:hover,
        html.dark .glass-panel:hover, .dark .glass-panel:hover,
        html.dark .signature-card:hover, .dark .signature-card:hover,
        html.dark .dashboard-widget:hover, .dark .dashboard-widget:hover,
        html.dark .control-room-card:hover, .dark .control-room-card:hover,
        html.dark .grid > .rounded-3xl:hover, .dark .grid > .rounded-3xl:hover,
        html.dark .grid > div[class*="rounded-3xl"]:hover, .dark .grid > div[class*="rounded-3xl"]:hover {
            background: rgba(15, 23, 42, 0.35) !important;
            background-color: rgba(15, 23, 42, 0.35) !important;
            backdrop-filter: blur(24px) saturate(190%) !important;
            -webkit-backdrop-filter: blur(24px) saturate(190%) !important;
            border: 1px solid rgba(139, 92, 246, 0.30) !important;
            transform: translate3d(0, -3px, 0);
            box-shadow: 0 24px 60px -10px rgba(0, 0, 0, 0.60), inset 0 1px 0 rgba(255, 255, 255, 0.15) !important;
        }

        /* Dark Mode Inner Nested Panels & Secondary Containers */
        html.dark .dark\:bg-slate-800, .dark .dark\:bg-slate-800,
        html.dark .dark\:bg-slate-800\/50, .dark .dark\:bg-slate-800\/50,
        html.dark .dark\:bg-slate-850, .dark .dark\:bg-slate-850,
        html.dark .dark\:bg-white\/5, .dark .dark\:bg-white\/5,
        html.dark .dark\:bg-white\/10, .dark .dark\:bg-white\/10,
        html.dark .inner-panel, .dark .inner-panel,
        html.dark .secondary-container, .dark .secondary-container,
        html.dark section div[class*="rounded-2xl"],
        html.dark [class*="dark:bg-slate-8"] {
            background: rgba(6, 8, 15, 0.20) !important;
            background-color: rgba(6, 8, 15, 0.20) !important;
            backdrop-filter: blur(16px) !important;
            -webkit-backdrop-filter: blur(16px) !important;
            border: 1px solid rgba(255, 255, 255, 0.08) !important;
        }

        /* Pristine Dark Mode Typography */
        html.dark h1, .dark h1,
        html.dark h2, .dark h2,
        html.dark h3, .dark h3,
        html.dark h4, .dark h4,
        html.dark h5, .dark h5,
        html.dark h6, .dark h6 {
            color: #FFFFFF;
        }
        html.dark p, .dark p {
            color: #CBD5E1;
        }
        html.dark .text-slate-900, .dark .text-slate-900,
        html.dark .text-slate-800, .dark .text-slate-800 {
            color: #F8FAFC !important;
        }
        html.dark .text-slate-700, .dark .text-slate-700,
        html.dark .text-slate-600, .dark .text-slate-600 {
            color: #CBD5E1 !important;
        }
        html.dark .text-slate-500, .dark .text-slate-500,
        html.dark .text-slate-400, .dark .text-slate-400 {
            color: #94A3B8 !important;
        }
        html.dark .text-white, .dark .text-white {
            color: #FFFFFF !important;
        }
        html.dark .btn-primary,
        html.dark .btn-sweep,
        html.dark .btn-primary *,
        html.dark .btn-sweep * {
            color: #040812 !important;
        }

        /* Dark Mode Form Inputs, Search Bars & Dropdowns */
        html.dark .app-input, .dark .app-input,
        html.dark input:not([type="checkbox"]):not([type="radio"]):not([type="hidden"]):not([type="submit"]):not([type="button"]),
        .dark input:not([type="checkbox"]):not([type="radio"]):not([type="hidden"]):not([type="submit"]):not([type="button"]),
        html.dark select, .dark select,
        html.dark textarea, .dark textarea {
            background-color: rgba(8, 11, 18, 0.60) !important;
            backdrop-filter: blur(12px) !important;
            border-color: rgba(255, 255, 255, 0.15) !important;
            color: #F8FAFC !important;
        }
        html.dark input::placeholder, .dark input::placeholder,
        html.dark textarea::placeholder, .dark textarea::placeholder {
            color: #94A3B8 !important;
        }
        html.dark input:focus, .dark input:focus,
        html.dark select:focus, .dark select:focus,
        html.dark textarea:focus, .dark textarea:focus {
            border-color: #00f2fe !important;
            box-shadow: 0 0 0 3px rgba(0, 242, 254, 0.15) !important;
            color: #FFFFFF !important;
            background-color: rgba(8, 11, 18, 0.85) !important;
        }
        html.dark select option, .dark select option,
        html.dark select.app-input option, .dark select.app-input option {
            background: #080B12 !important;
            color: #F8FAFC !important;
        }
        /* ══════════════════ DARK MODE 3D ROTATIONAL GLOWING ARCS & LINES (90FPS GPU) ══════════════════ */
        .dark-arc-container {
            perspective: 1200px;
            transform-style: preserve-3d;
        }

        .dark-arc-3d {
            position: absolute;
            border-radius: 50%;
            pointer-events: none;
            will-change: transform;
            transform-origin: center center;
        }

        .dark-arc-1 {
            width: 75vw;
            height: 75vw;
            max-width: 950px;
            max-height: 950px;
            top: -15%;
            left: 10%;
            border: 1.5px solid transparent;
            border-top-color: #8b5cf6;
            border-right-color: #3b82f6;
            box-shadow: 0 0 30px rgba(139, 92, 246, 0.35), inset 0 0 25px rgba(59, 130, 246, 0.25);
            opacity: 0.32;
            animation: darkArcRotate1 34s linear infinite;
        }

        .dark-arc-2 {
            width: 65vw;
            height: 65vw;
            max-width: 820px;
            max-height: 820px;
            bottom: -15%;
            right: 5%;
            border: 1.5px solid transparent;
            border-bottom-color: #3b82f6;
            border-left-color: #00f2fe;
            box-shadow: 0 0 30px rgba(0, 242, 254, 0.30), inset 0 0 25px rgba(59, 130, 246, 0.20);
            opacity: 0.28;
            animation: darkArcRotate2 40s linear infinite reverse;
        }

        .dark-arc-3 {
            width: 55vw;
            height: 55vw;
            max-width: 700px;
            max-height: 700px;
            top: 25%;
            left: -5%;
            border: 1.2px solid transparent;
            border-top-color: #a855f7;
            border-left-color: #6366f1;
            box-shadow: 0 0 25px rgba(168, 85, 247, 0.28);
            opacity: 0.25;
            animation: darkArcRotate3 38s ease-in-out infinite;
        }

        .dark-arc-4 {
            width: 50vw;
            height: 50vw;
            max-width: 650px;
            max-height: 650px;
            top: 35%;
            right: -5%;
            border: 1.2px solid transparent;
            border-right-color: #00f2fe;
            border-bottom-color: #3b82f6;
            box-shadow: 0 0 25px rgba(0, 242, 254, 0.25);
            opacity: 0.22;
            animation: darkArcRotate4 44s ease-in-out infinite alternate;
        }

        @keyframes darkArcRotate1 {
            0% { transform: rotateX(65deg) rotateY(15deg) rotateZ(0deg); }
            100% { transform: rotateX(65deg) rotateY(15deg) rotateZ(360deg); }
        }

        @keyframes darkArcRotate2 {
            0% { transform: rotateX(60deg) rotateY(-20deg) rotateZ(0deg); }
            100% { transform: rotateX(60deg) rotateY(-20deg) rotateZ(360deg); }
        }

        @keyframes darkArcRotate3 {
            0%, 100% { transform: rotateX(55deg) rotateY(30deg) rotateZ(0deg) scale(1); }
            50% { transform: rotateX(65deg) rotateY(15deg) rotateZ(180deg) scale(1.06); }
        }

        @keyframes darkArcRotate4 {
            0%, 100% { transform: rotateX(50deg) rotateY(-35deg) rotateZ(0deg) scale(1); }
            50% { transform: rotateX(62deg) rotateY(-15deg) rotateZ(-180deg) scale(1.05); }
        }
    </style>
</head>
<body class="min-h-screen flex flex-col antialiased transition-colors duration-500 relative overflow-x-hidden bg-[#F8FAFC] dark:bg-[#06080f] text-[#111827] dark:text-[#f8fafc]">

    <!-- ══════════════════ ISOLATED FIXED AMBIENT BACKGROUND LAYER (LIGHT MODE ONLY) ══════════════════ -->
    <div id="ambientBackgroundLayer" class="fixed inset-0 z-0 pointer-events-none overflow-hidden bg-[#F8FAFC] dark:bg-[#06080f] transition-colors duration-500" aria-hidden="true">
        
        <!-- ─── 3D AMBIENT GLASS-BUBBLE & PASTEL GRADIENT LAYER (STRICTLY LIGHT THEME ONLY) ─── -->
        <div class="absolute inset-0 block dark:hidden pointer-events-none">
            <!-- 1. Soft Pastel Radial Gradient Light Pools -->
            <div class="absolute -top-[12%] -left-[6%] w-[62vw] h-[62vw] max-w-[920px] max-h-[920px] rounded-full bg-gradient-to-br from-[#12CFF3]/[0.15] via-[#7657FF]/[0.09] to-transparent blur-[130px] animate-aurora-drift-1"></div>
            <div class="absolute top-[32%] -right-[8%] w-[58vw] h-[58vw] max-w-[880px] max-h-[880px] rounded-full bg-gradient-to-bl from-[#7657FF]/[0.14] via-[#3b82f6]/[0.08] to-transparent blur-[130px] animate-aurora-drift-2"></div>
            <div class="absolute -bottom-[12%] left-[8%] w-[60vw] h-[60vw] max-w-[900px] max-h-[900px] rounded-full bg-gradient-to-tr from-[#3b82f6]/[0.12] via-[#12CFF3]/[0.09] to-transparent blur-[140px] animate-aurora-drift-3"></div>

            <!-- 2. Smooth 3D Frosted Glass Spheres / Bubbles with Specular Highlights & Depth -->
            <div class="w-72 h-72 top-[5%] left-[2%] glass-bubble-3d glass-bubble-cyan anim-bubble-1">
                <div class="glass-bubble-specular"></div>
            </div>
            <div class="w-64 h-64 top-[8%] right-[5%] glass-bubble-3d glass-bubble-purple anim-bubble-2">
                <div class="glass-bubble-specular"></div>
            </div>
            <div class="w-52 h-52 top-[38%] left-[4%] glass-bubble-3d glass-bubble-blue anim-bubble-3">
                <div class="glass-bubble-specular"></div>
            </div>
            <div class="w-80 h-80 top-[45%] right-[2%] glass-bubble-3d glass-bubble-cyan anim-bubble-4">
                <div class="glass-bubble-specular"></div>
            </div>
            <div class="w-60 h-60 bottom-[8%] left-[12%] glass-bubble-3d glass-bubble-purple anim-bubble-1">
                <div class="glass-bubble-specular"></div>
            </div>
            <div class="w-56 h-56 bottom-[12%] right-[10%] glass-bubble-3d glass-bubble-blue anim-bubble-2">
                <div class="glass-bubble-specular"></div>
            </div>
            <!-- Floating Micro Glass Pearls -->
            <div class="w-20 h-20 top-[26%] left-[46%] glass-bubble-3d glass-bubble-cyan anim-bubble-3">
                <div class="glass-bubble-specular"></div>
            </div>
            <div class="w-24 h-24 bottom-[28%] right-[25%] glass-bubble-3d glass-bubble-blue anim-bubble-4">
                <div class="glass-bubble-specular"></div>
            </div>
            <div class="w-16 h-16 top-[68%] left-[32%] glass-bubble-3d glass-bubble-purple anim-bubble-1">
                <div class="glass-bubble-specular"></div>
            </div>
        </div>

        <!-- ─── DARK MODE SUBTLE 3D ROTATING GLOWING ARCS LAYER (STRICTLY DARK THEME ONLY) ─── -->
        <div class="absolute inset-0 hidden dark:block pointer-events-none overflow-hidden bg-[#04060b]">
            <!-- 1. Smooth Deep Space Ambient Lighting Pools -->
            <div class="absolute -top-[20%] -left-[15%] w-[70vw] h-[70vw] max-w-[1000px] max-h-[1000px] rounded-full bg-gradient-to-br from-purple-900/20 via-indigo-900/15 to-transparent blur-[160px]"></div>
            <div class="absolute -bottom-[20%] -right-[15%] w-[70vw] h-[70vw] max-w-[1000px] max-h-[1000px] rounded-full bg-gradient-to-tl from-blue-900/20 via-violet-900/15 to-transparent blur-[160px]"></div>
            <div class="absolute top-[30%] left-[25%] w-[50vw] h-[50vw] max-w-[750px] max-h-[750px] rounded-full bg-gradient-to-tr from-cyan-950/15 via-purple-950/10 to-transparent blur-[150px]"></div>

            <!-- 2. Subtle, Thin 3D Rotational Glowing Curved Arcs -->
            <div class="absolute inset-0 dark-arc-container">
                <!-- 3D Arc 1 (Top-Left to Center — Soft Purple/Blue Glowing Arc) -->
                <div class="dark-arc-3d dark-arc-1"></div>

                <!-- 3D Arc 2 (Bottom-Right to Center — Electric Blue/Cyan Glowing Arc) -->
                <div class="dark-arc-3d dark-arc-2"></div>

                <!-- 3D Arc 3 (Mid-Left Floating Diagonal Arc — Violet/Indigo) -->
                <div class="dark-arc-3d dark-arc-3"></div>

                <!-- 3D Arc 4 (Mid-Right Floating Orbital Arc — Cyan/Blue) -->
                <div class="dark-arc-3d dark-arc-4"></div>
            </div>

            <!-- 3. Minimal Ambient Star Dust Accent -->
            <div class="absolute inset-0 bg-[radial-gradient(#8b5cf6_1px,transparent_1px)] [background-size:36px_36px] opacity-[0.035]"></div>
        </div>

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

        <!-- Floating AI Guide Button (Compact Circular Icon Button) -->
        <button @click="openAI = !openAI"
                x-show="!openAI"
                x-transition:enter="transition ease-out duration-300 transform"
                x-transition:enter-start="opacity-0 scale-75"
                x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-300 transform"
                x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-75"
                id="floatingAiGuideBtn"
                title="Ask PathSeeker AI"
                aria-label="Ask PathSeeker AI"
                style="transform-origin: bottom right;"
                class="fixed bottom-6 right-6 z-[99999] w-12 h-12 sm:w-14 sm:h-14 rounded-full bg-gradient-to-r from-[#00f2fe] via-sky-400 to-blue-600 flex items-center justify-center shadow-[0_0_25px_rgba(0,242,254,0.55)] hover:shadow-[0_0_35px_rgba(0,242,254,0.8)] hover:scale-110 active:scale-95 transition-all duration-300 ease-in-out cursor-pointer origin-bottom-right border border-white/30 text-slate-950 group">
            
            <i class="fa-solid fa-wand-magic-sparkles text-base sm:text-lg text-slate-950 group-hover:rotate-12 transition-transform"></i>
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
             class="relative w-full max-w-2xl rounded-3xl bg-white dark:bg-[#090b16]/95 border border-slate-200 dark:border-purple-500/30 shadow-2xl dark:shadow-[0_20px_60px_rgba(0,0,0,0.8)] overflow-hidden scale-95 transition-transform duration-200">
            
            {{-- Top Accent Line --}}
            <div class="h-1 w-full bg-gradient-to-r from-cyan-400 via-sky-500 to-blue-600"></div>

            {{-- Search Bar Header --}}
            <div class="p-4 sm:p-5 border-b border-slate-200/80 dark:border-white/[0.08] flex items-center gap-3.5 bg-slate-50/80 dark:bg-white/[0.02]">
                <i class="fa-solid fa-magnifying-glass text-purple-600 dark:text-purple-400 text-sm pl-2"></i>
                <input type="text"
                       id="cmdPaletteInput"
                       placeholder="Type a command or destination (e.g. Careers, Quiz, AI, Toolkits)..."
                       autocomplete="off"
                       class="w-full bg-transparent text-sm sm:text-base text-slate-900 dark:text-white placeholder-slate-400 dark:placeholder-slate-500 focus:outline-none font-medium">
                <kbd class="px-2 py-0.5 rounded-lg text-[10px] font-mono font-semibold bg-slate-200/70 dark:bg-white/10 text-slate-600 dark:text-slate-400 border border-slate-300/60 dark:border-white/10 shrink-0">ESC</kbd>
            </div>

            {{-- Dynamic Filterable Command List --}}
            <div class="p-3 max-h-80 overflow-y-auto space-y-4 scrollbar-thin" id="cmdResultsList">
                
                {{-- Group: Navigation --}}
                <div class="cmd-group space-y-1">
                    <div class="px-3 text-[10px] font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500 font-mono">Primary Navigation</div>
                    
                    <a href="{{ route('home') }}" class="cmd-item flex items-center justify-between p-3 rounded-2xl hover:bg-[#F5F6FA] dark:hover:bg-purple-500/15 border border-transparent hover:border-purple-500/20 dark:hover:border-purple-500/30 transition-colors group cursor-pointer" data-keywords="home portal landing start">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-xl bg-indigo-500/15 text-indigo-600 dark:text-indigo-400 flex items-center justify-center text-xs shrink-0 group-hover:scale-110 transition-transform">
                                <i class="fa-solid fa-house"></i>
                            </div>
                            <div>
                                <h4 class="text-xs sm:text-sm font-bold text-slate-900 dark:text-white group-hover:text-purple-600 dark:group-hover:text-purple-300">Home Portal</h4>
                                <p class="text-[11px] text-slate-500 dark:text-slate-400">Main overview &amp; AI Career Match preview</p>
                            </div>
                        </div>
                        <i class="fa-solid fa-arrow-right text-[10px] text-slate-400 dark:text-slate-500 group-hover:text-purple-600 dark:group-hover:text-purple-300 group-hover:translate-x-1 transition-all"></i>
                    </a>

                    <a href="{{ route('careers.index') }}" class="cmd-item flex items-center justify-between p-3 rounded-2xl hover:bg-[#F5F6FA] dark:hover:bg-purple-500/15 border border-transparent hover:border-purple-500/20 dark:hover:border-purple-500/30 transition-colors group cursor-pointer" data-keywords="careers career bank tracks explore jobs salary demand roadmap">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-xl bg-purple-500/15 text-purple-600 dark:text-purple-400 flex items-center justify-center text-xs shrink-0 group-hover:scale-110 transition-transform">
                                <i class="fa-solid fa-compass"></i>
                            </div>
                            <div>
                                <h4 class="text-xs sm:text-sm font-bold text-slate-900 dark:text-white group-hover:text-purple-600 dark:group-hover:text-purple-300">Career Bank</h4>
                                <p class="text-[11px] text-slate-500 dark:text-slate-400">Explore 15+ tech tracks, comparison matrix &amp; roadmaps</p>
                            </div>
                        </div>
                        <i class="fa-solid fa-arrow-right text-[10px] text-slate-400 dark:text-slate-500 group-hover:text-purple-600 dark:group-hover:text-purple-300 group-hover:translate-x-1 transition-all"></i>
                    </a>

                    <a href="{{ route('quiz.index') }}" class="cmd-item flex items-center justify-between p-3 rounded-2xl hover:bg-[#F5F6FA] dark:hover:bg-purple-500/15 border border-transparent hover:border-purple-500/20 dark:hover:border-purple-500/30 transition-colors group cursor-pointer" data-keywords="quiz interest assessment test match alignment">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-xl bg-pink-500/15 text-pink-600 dark:text-pink-400 flex items-center justify-center text-xs shrink-0 group-hover:scale-110 transition-transform">
                                <i class="fa-solid fa-brain"></i>
                            </div>
                            <div>
                                <h4 class="text-xs sm:text-sm font-bold text-slate-900 dark:text-white group-hover:text-purple-600 dark:group-hover:text-purple-300">Career Interest Quiz</h4>
                                <p class="text-[11px] text-slate-500 dark:text-slate-400">Discover your cognitive alignment &amp; top job matches</p>
                            </div>
                        </div>
                        <i class="fa-solid fa-arrow-right text-[10px] text-slate-400 dark:text-slate-500 group-hover:text-purple-600 dark:group-hover:text-purple-300 group-hover:translate-x-1 transition-all"></i>
                    </a>

                    <a href="{{ route('multimedia.index') }}" class="cmd-item flex items-center justify-between p-3 rounded-2xl hover:bg-[#F5F6FA] dark:hover:bg-purple-500/15 border border-transparent hover:border-purple-500/20 dark:hover:border-purple-500/30 transition-colors group cursor-pointer" data-keywords="multimedia videos video stream masterclass podcast learn">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-xl bg-rose-500/15 text-rose-600 dark:text-rose-400 flex items-center justify-center text-xs shrink-0 group-hover:scale-110 transition-transform">
                                <i class="fa-solid fa-play"></i>
                            </div>
                            <div>
                                <h4 class="text-xs sm:text-sm font-bold text-slate-900 dark:text-white group-hover:text-purple-600 dark:group-hover:text-purple-300">Multimedia Center</h4>
                                <p class="text-[11px] text-slate-500 dark:text-slate-400">Stream 4K masterclasses &amp; technical walkthroughs</p>
                            </div>
                        </div>
                        <i class="fa-solid fa-arrow-right text-[10px] text-slate-400 dark:text-slate-500 group-hover:text-purple-600 dark:group-hover:text-purple-300 group-hover:translate-x-1 transition-all"></i>
                    </a>

                    <a href="{{ route('resources.index') }}" class="cmd-item flex items-center justify-between p-3 rounded-2xl hover:bg-[#F5F6FA] dark:hover:bg-purple-500/15 border border-transparent hover:border-purple-500/20 dark:hover:border-purple-500/30 transition-colors group cursor-pointer" data-keywords="resources toolkits blueprints download pdf cheat sheet templates">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-xl bg-sky-500/15 text-sky-600 dark:text-sky-400 flex items-center justify-center text-xs shrink-0 group-hover:scale-110 transition-transform">
                                <i class="fa-solid fa-book-bookmark"></i>
                            </div>
                            <div>
                                <h4 class="text-xs sm:text-sm font-bold text-slate-900 dark:text-white group-hover:text-purple-600 dark:group-hover:text-purple-300">Resource Library</h4>
                                <p class="text-[11px] text-slate-500 dark:text-slate-400">Download verified system design cheat sheets &amp; blueprints</p>
                            </div>
                        </div>
                        <i class="fa-solid fa-arrow-right text-[10px] text-slate-400 dark:text-slate-500 group-hover:text-purple-600 dark:group-hover:text-purple-300 group-hover:translate-x-1 transition-all"></i>
                    </a>

                    <a href="{{ route('dashboard') }}" class="cmd-item flex items-center justify-between p-3 rounded-2xl hover:bg-[#F5F6FA] dark:hover:bg-purple-500/15 border border-transparent hover:border-purple-500/20 dark:hover:border-purple-500/30 transition-colors group cursor-pointer" data-keywords="dashboard passport readiness profile stats progress">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-xl bg-emerald-500/15 text-emerald-600 dark:text-emerald-400 flex items-center justify-center text-xs shrink-0 group-hover:scale-110 transition-transform">
                                <i class="fa-solid fa-id-card"></i>
                            </div>
                            <div>
                                <h4 class="text-xs sm:text-sm font-bold text-slate-900 dark:text-white group-hover:text-purple-600 dark:group-hover:text-purple-300">Career Operating System</h4>
                                <p class="text-[11px] text-slate-500 dark:text-slate-400">Personalized dashboard, Readiness Index &amp; saved tracks</p>
                            </div>
                        </div>
                        <i class="fa-solid fa-arrow-right text-[10px] text-slate-400 dark:text-slate-500 group-hover:text-purple-600 dark:group-hover:text-purple-300 group-hover:translate-x-1 transition-all"></i>
                    </a>
                </div>

                {{-- Group: Quick Actions --}}
                <div class="cmd-group space-y-1 pt-2 border-t border-slate-200/80 dark:border-white/[0.05]">
                    <div class="px-3 text-[10px] font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500 font-mono">Quick Filters &amp; Actions</div>

                    <a href="{{ route('careers.index', ['search' => 'Full-Stack']) }}" class="cmd-item flex items-center justify-between p-3 rounded-2xl hover:bg-[#F5F6FA] dark:hover:bg-purple-500/15 border border-transparent hover:border-purple-500/20 dark:hover:border-purple-500/30 transition-colors group cursor-pointer" data-keywords="fullstack web developer laravel react vue backend frontend">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-xl bg-indigo-500/15 text-indigo-600 dark:text-indigo-400 flex items-center justify-center text-xs shrink-0">
                                <i class="fa-solid fa-code"></i>
                            </div>
                            <div>
                                <h4 class="text-xs sm:text-sm font-bold text-slate-900 dark:text-white group-hover:text-purple-600 dark:group-hover:text-purple-300">Full-Stack Web Architect Roles</h4>
                                <p class="text-[11px] text-slate-500 dark:text-slate-400">Filter software engineering careers</p>
                            </div>
                        </div>
                        <span class="text-[10px] font-mono text-indigo-600 dark:text-indigo-400">Filter</span>
                    </a>

                    <a href="{{ route('careers.index', ['domain' => 'Cloud & Infrastructure']) }}" class="cmd-item flex items-center justify-between p-3 rounded-2xl hover:bg-[#F5F6FA] dark:hover:bg-purple-500/15 border border-transparent hover:border-purple-500/20 dark:hover:border-purple-500/30 transition-colors group cursor-pointer" data-keywords="cloud devops aws gcp kubernetes terraform infrastructure">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-xl bg-sky-500/15 text-sky-600 dark:text-sky-400 flex items-center justify-center text-xs shrink-0">
                                <i class="fa-solid fa-cloud"></i>
                            </div>
                            <div>
                                <h4 class="text-xs sm:text-sm font-bold text-slate-900 dark:text-white group-hover:text-purple-600 dark:group-hover:text-purple-300">Cloud &amp; DevOps Engineering</h4>
                                <p class="text-[11px] text-slate-500 dark:text-slate-400">Filter cloud infrastructure pathways</p>
                            </div>
                        </div>
                        <span class="text-[10px] font-mono text-sky-600 dark:text-sky-400">Filter</span>
                    </a>

                    <a href="{{ route('careers.index', ['search' => 'AI']) }}" class="cmd-item flex items-center justify-between p-3 rounded-2xl hover:bg-[#F5F6FA] dark:hover:bg-purple-500/15 border border-transparent hover:border-purple-500/20 dark:hover:border-purple-500/30 transition-colors group cursor-pointer" data-keywords="ai machine learning python pytorch data artificial intelligence">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-xl bg-purple-500/15 text-purple-600 dark:text-purple-400 flex items-center justify-center text-xs shrink-0">
                                <i class="fa-solid fa-microchip"></i>
                            </div>
                            <div>
                                <h4 class="text-xs sm:text-sm font-bold text-slate-900 dark:text-white group-hover:text-purple-600 dark:group-hover:text-purple-300">AI &amp; Machine Learning Engineering</h4>
                                <p class="text-[11px] text-slate-500 dark:text-slate-400">Filter AI and data science pathways</p>
                            </div>
                        </div>
                        <span class="text-[10px] font-mono text-purple-600 dark:text-purple-400">Filter</span>
                    </a>

                    <button type="button" onclick="toggleTheme(); closeCommandPalette();" class="cmd-item w-full flex items-center justify-between p-3 rounded-2xl hover:bg-[#F5F6FA] dark:hover:bg-purple-500/15 border border-transparent hover:border-purple-500/20 dark:hover:border-purple-500/30 transition-colors group text-left cursor-pointer" data-keywords="theme dark light mode toggle switch color">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-xl bg-amber-500/15 text-amber-600 dark:text-amber-400 flex items-center justify-center text-xs shrink-0">
                                <i class="fa-solid fa-circle-half-stroke"></i>
                            </div>
                            <div>
                                <h4 class="text-xs sm:text-sm font-bold text-slate-900 dark:text-white group-hover:text-purple-600 dark:group-hover:text-purple-300">Toggle Dark / Light Theme</h4>
                                <p class="text-[11px] text-slate-500 dark:text-slate-400">Switch application color scheme</p>
                            </div>
                        </div>
                        <span class="text-[10px] font-mono text-amber-600 dark:text-amber-400">Action</span>
                    </button>
                </div>

                {{-- No Results State --}}
                <div id="cmdNoResults" class="hidden py-8 text-center space-y-2">
                    <i class="fa-solid fa-magnifying-glass text-slate-400 text-xl"></i>
                    <p class="text-xs text-slate-500 dark:text-slate-400 font-medium">No matching destinations or commands found.</p>
                </div>

            </div>

            {{-- Footer Shortcuts Bar --}}
            <div class="px-5 py-3 border-t border-slate-200/80 dark:border-white/[0.08] bg-slate-50/80 dark:bg-white/[0.02] flex items-center justify-between text-[11px] text-slate-500">
                <div class="flex items-center gap-3">
                    <span class="flex items-center gap-1"><kbd class="px-1 py-0.5 rounded bg-white dark:bg-white/5 border border-slate-200 dark:border-white/10 font-mono text-[9px] text-slate-600 dark:text-slate-400">↑↓</kbd> Navigate</span>
                    <span class="flex items-center gap-1"><kbd class="px-1 py-0.5 rounded bg-white dark:bg-white/5 border border-slate-200 dark:border-white/10 font-mono text-[9px] text-slate-600 dark:text-slate-400">↵</kbd> Select</span>
                    <span class="flex items-center gap-1"><kbd class="px-1 py-0.5 rounded bg-white dark:bg-white/5 border border-slate-200 dark:border-white/10 font-mono text-[9px] text-slate-600 dark:text-slate-400">ESC</kbd> Close</span>
                </div>
                <span class="font-mono text-purple-600 dark:text-purple-400 text-[10px] font-bold">PathSeeker Command OS</span>
            </div>

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

        // ══════════════════ 3. 90FPS GSAP SCROLLTRIGGER HARDWARE ACCELERATION & PARALLAX ENGINE ══════════════════
        (function initGsapScrollEngine() {
            const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
            
            function setupScrollTriggerAnimations() {
                // Ensure all headers, navigation, above-the-fold content, and closing CTA banners are 100% visible
                document.querySelectorAll('.reveal-element, .reveal-on-scroll, [data-reveal]').forEach(el => {
                    const rect = el.getBoundingClientRect();
                    if (prefersReducedMotion || (rect.top < window.innerHeight * 1.05 && rect.bottom > -50)) {
                        el.classList.add('revealed');
                        el.style.opacity = '1';
                        el.style.transform = 'none';
                    }
                });

                if (prefersReducedMotion) return;

                // Check if GSAP & ScrollTrigger are available
                const hasGsap = typeof gsap !== 'undefined' && typeof ScrollTrigger !== 'undefined';

                if (hasGsap) {
                    // Global GPU Hardware Offloading (force3D: true on all tweens)
                    gsap.config({ force3D: true, nullTargetWarn: false });
                    gsap.defaults({ force3D: true, ease: 'power3.out' });
                    gsap.registerPlugin(ScrollTrigger);

                    // 1. Subtle Ambient Background Layer Parallax (Light Mode Only)
                    const bgLayer = document.getElementById('ambientBackgroundLayer');
                    if (bgLayer && !document.documentElement.classList.contains('dark')) {
                        gsap.to(bgLayer, {
                            yPercent: 8,
                            ease: 'none',
                            scrollTrigger: {
                                trigger: document.body,
                                start: 'top top',
                                end: 'bottom bottom',
                                scrub: 1.2
                            }
                        });
                    }

                    // 2. Controlled Below-the-fold Section & Card Reveals
                    const revealTargets = document.querySelectorAll('.reveal-element, .reveal-on-scroll, [data-reveal]');
                    revealTargets.forEach((target) => {
                        if (target.dataset.gsapActive) return;
                        target.dataset.gsapActive = 'true';

                        const rect = target.getBoundingClientRect();
                        if (rect.top >= window.innerHeight * 0.95) {
                            gsap.fromTo(target,
                                { opacity: 0, y: 30, scale: 0.98, force3D: true },
                                {
                                    opacity: 1,
                                    y: 0,
                                    scale: 1,
                                    force3D: true,
                                    duration: 0.7,
                                    ease: 'power3.out',
                                    scrollTrigger: {
                                        trigger: target,
                                        start: 'top 90%',
                                        once: true,
                                        onEnter: () => target.classList.add('revealed')
                                    }
                                }
                            );
                        } else {
                            target.classList.add('revealed');
                            target.style.opacity = '1';
                            target.style.transform = 'none';
                        }
                    });

                    // 3. Strict Sequential Staggered Cascades for All Card Grids (0.07s Interval)
                    const grids = document.querySelectorAll('.grid, [data-stagger-grid], #careerCardsContainer, #multimediaGrid, #resourcesGrid, #storiesGrid');
                    grids.forEach((grid) => {
                        if (grid.dataset.gsapGridActive) return;
                        grid.dataset.gsapGridActive = 'true';

                        const cards = Array.from(grid.children).filter(child => {
                            return !child.classList.contains('hidden') && child.tagName !== 'TEMPLATE';
                        });

                        if (cards.length === 0) return;

                        const gridRect = grid.getBoundingClientRect();
                        if (gridRect.top < window.innerHeight * 0.9) {
                            gsap.fromTo(cards,
                                { opacity: 0, y: 25, scale: 0.98, force3D: true },
                                {
                                    opacity: 1,
                                    y: 0,
                                    scale: 1,
                                    force3D: true,
                                    duration: 0.6,
                                    stagger: 0.07,
                                    ease: 'power3.out',
                                    overwrite: 'auto'
                                }
                            );
                        } else {
                            gsap.fromTo(cards,
                                { opacity: 0, y: 30, scale: 0.98, force3D: true },
                                {
                                    opacity: 1,
                                    y: 0,
                                    scale: 1,
                                    force3D: true,
                                    duration: 0.7,
                                    stagger: 0.07,
                                    ease: 'power3.out',
                                    scrollTrigger: {
                                        trigger: grid,
                                        start: 'top 88%',
                                        once: true
                                    }
                                }
                            );
                        }
                    });

                    // 4. Interactive Feature Blocks & Intelligence Monitors
                    const widgets = document.querySelectorAll('.dashboard-widget, .control-room-card, #aiAdvisorOutput, .perspective-stage');
                    widgets.forEach((widget) => {
                        if (widget.dataset.gsapWidgetActive) return;
                        widget.dataset.gsapWidgetActive = 'true';

                        const wRect = widget.getBoundingClientRect();
                        if (wRect.top >= window.innerHeight * 0.95) {
                            gsap.fromTo(widget,
                                { opacity: 0, y: 30, scale: 0.98, force3D: true },
                                {
                                    opacity: 1,
                                    y: 0,
                                    scale: 1,
                                    force3D: true,
                                    duration: 0.7,
                                    ease: 'power3.out',
                                    scrollTrigger: {
                                        trigger: widget,
                                        start: 'top 90%',
                                        once: true
                                    }
                                }
                            );
                        } else {
                            widget.classList.add('revealed');
                            widget.style.opacity = '1';
                            widget.style.transform = 'none';
                        }
                    });

                } else {
                    // High-performance IntersectionObserver Fallback
                    const observerOptions = {
                        root: null,
                        rootMargin: '0px 0px -20px 0px',
                        threshold: 0.05
                    };

                    const revealObserver = new IntersectionObserver((entries, observer) => {
                        entries.forEach(entry => {
                            if (entry.isIntersecting) {
                                entry.target.classList.add('revealed');
                                entry.target.style.opacity = '1';
                                entry.target.style.transform = 'none';
                                observer.unobserve(entry.target);
                            }
                        });
                    }, observerOptions);

                    document.querySelectorAll('.reveal-element, .reveal-on-scroll, [data-reveal], .grid > div').forEach(el => {
                        revealObserver.observe(el);
                    });
                }
            }

            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', setupScrollTriggerAnimations);
            } else {
                setupScrollTriggerAnimations();
            }

            window.initScrollReveals = setupScrollTriggerAnimations;
            window.addEventListener('load', setupScrollTriggerAnimations);
        })();

        // ══════════════════ 4. 90FPS SMART 3D TILT & MOUSE-TRACKING ENGINE (rAF THROTTLED & TOUCH DISABLED) ══════════════════
        (function initUniversalTiltEngine() {
            const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
            const isTouchDevice = window.matchMedia('(hover: none), (pointer: coarse)').matches;
            
            // Instantly disable 3D tilt calculations on touch/mobile devices to free CPU and memory on budget phones
            if (prefersReducedMotion || isTouchDevice) return;

            function setupCardTilt() {
                const cardSelectors = [
                    '.card-tilt-3d',
                    '.career-card',
                    '.app-card',
                    '.glass-panel',
                    '[data-tilt]',
                    '.grid > .rounded-3xl',
                    '.grid > div[class*="rounded-3xl"]',
                    '.grid > div[class*="border"]',
                    '.dashboard-widget',
                    '.control-room-card',
                    '.perspective-stage',
                    '#aiAdvisorOutput'
                ];

                const cards = document.querySelectorAll(cardSelectors.join(', '));
                cards.forEach(card => {
                    if (card.dataset.tiltInitialized) return;
                    card.dataset.tiltInitialized = 'true';

                    card.style.transformStyle = 'preserve-3d';
                    card.style.backfaceVisibility = 'hidden';
                    card.style.willChange = 'transform';
                    card.style.transition = 'transform 0.16s cubic-bezier(0.25, 1, 0.5, 1), box-shadow 0.25s ease, border-color 0.25s ease';

                    // Inject glare reflection overlay if not already present
                    if (!card.querySelector('.tilt-glare-overlay')) {
                        const glare = document.createElement('div');
                        glare.className = 'tilt-glare-overlay';
                        card.appendChild(glare);
                    }

                    let rafId = null;
                    let targetX = 0;
                    let targetY = 0;
                    let centerX = 0;
                    let centerY = 0;
                    let isTicking = false;

                    card.addEventListener('mouseenter', () => {
                        const rect = card.getBoundingClientRect();
                        centerX = rect.width / 2;
                        centerY = rect.height / 2;
                    }, { passive: true });

                    card.addEventListener('mousemove', (e) => {
                        const rect = card.getBoundingClientRect();
                        targetX = e.clientX - rect.left;
                        targetY = e.clientY - rect.top;
                        centerX = rect.width / 2;
                        centerY = rect.height / 2;

                        if (!isTicking) {
                            isTicking = true;
                            rafId = requestAnimationFrame(() => {
                                card.style.setProperty('--mouse-x', `${targetX.toFixed(1)}px`);
                                card.style.setProperty('--mouse-y', `${targetY.toFixed(1)}px`);

                                const rotateX = ((targetY - centerY) / centerY) * -5.5;
                                const rotateY = ((targetX - centerX) / centerX) * 6.5;
                                card.style.transform = `perspective(1000px) translate3d(0, -3px, 0) rotateX(${rotateX.toFixed(2)}deg) rotateY(${rotateY.toFixed(2)}deg) scale3d(1.01, 1.01, 1.01)`;
                                isTicking = false;
                            });
                        }
                    }, { passive: true });

                    card.addEventListener('mouseleave', () => {
                        if (rafId) cancelAnimationFrame(rafId);
                        isTicking = false;
                        card.style.transform = 'perspective(1000px) translate3d(0, 0, 0) rotateX(0deg) rotateY(0deg) scale3d(1, 1, 1)';
                    }, { passive: true });
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