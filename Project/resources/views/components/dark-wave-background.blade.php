{{-- ══════════════════ DEDICATED DARK MODE 3D FLUID / SILK WAVE BACKGROUND ══════════════════ --}}
{{-- High-Performance 60FPS Ambient Wave Engine: Smooth Undulating Dark Silk Ribbons & Glowing Rim Lighting --}}
<canvas id="darkWaveCanvas" class="fixed inset-0 w-full h-full pointer-events-none z-0 hidden dark:block bg-[#04060b]"></canvas>

<script>
(function() {
    'use strict';

    const canvas = document.getElementById('darkWaveCanvas');
    if (!canvas) return;

    const ctx = canvas.getContext('2d', { alpha: false, desynchronized: true });
    if (!ctx) return;

    let width = window.innerWidth;
    let height = window.innerHeight;
    let dpr = Math.min(window.devicePixelRatio || 1, 2);
    let animationFrameId = null;
    let isRunning = false;
    let lastTime = 0;
    let time = 0;

    // ── Wave Configuration Profiles ──
    const waves = [
        {
            // 1. Upper Distant Ambient Silk Ribbon
            baseYRatio: 0.52,
            amp1: 35, freq1: 0.0018, speed1: 0.35,
            amp2: 25, freq2: 0.0032, speed2: -0.25,
            amp3: 15, freq3: 0.0009, speed3: 0.15,
            fillGrad: (w, h) => {
                const g = ctx.createLinearGradient(0, h * 0.4, 0, h);
                g.addColorStop(0, 'rgba(14, 18, 36, 0.65)');
                g.addColorStop(1, 'rgba(4, 6, 11, 0.95)');
                return g;
            },
            rimColor: 'rgba(18, 207, 243, 0.09)',
            rimWidth: 1.5,
            glow: true
        },
        {
            // 2. Mid Deep Silk Wave (Purple Ambient Glow)
            baseYRatio: 0.68,
            amp1: 45, freq1: 0.0015, speed1: -0.40,
            amp2: 30, freq2: 0.0028, speed2: 0.30,
            amp3: 20, freq3: 0.0011, speed3: -0.20,
            fillGrad: (w, h) => {
                const g = ctx.createLinearGradient(0, h * 0.55, 0, h);
                g.addColorStop(0, 'rgba(16, 12, 34, 0.85)');
                g.addColorStop(0.5, 'rgba(10, 8, 24, 0.92)');
                g.addColorStop(1, 'rgba(4, 6, 11, 0.98)');
                return g;
            },
            rimColor: 'rgba(118, 87, 255, 0.10)',
            rimWidth: 1.8,
            glow: true
        },
        {
            // 3. Foreground Flowing Dark Fluid Wave (Cyan Ambient Rim)
            baseYRatio: 0.80,
            amp1: 50, freq1: 0.0012, speed1: 0.45,
            amp2: 35, freq2: 0.0022, speed2: -0.35,
            amp3: 18, freq3: 0.0008, speed3: 0.25,
            fillGrad: (w, h) => {
                const g = ctx.createLinearGradient(0, h * 0.70, 0, h);
                g.addColorStop(0, 'rgba(10, 16, 32, 0.95)');
                g.addColorStop(0.6, 'rgba(7, 11, 22, 0.98)');
                g.addColorStop(1, 'rgba(4, 6, 11, 1.0)');
                return g;
            },
            rimColor: 'rgba(18, 207, 243, 0.12)',
            rimWidth: 2.0,
            glow: true
        },
        {
            // 4. Low Base Obsidian Silk Ribbon
            baseYRatio: 0.89,
            amp1: 30, freq1: 0.0016, speed1: -0.50,
            amp2: 20, freq2: 0.0030, speed2: 0.40,
            amp3: 12, freq3: 0.0010, speed3: -0.15,
            fillGrad: (w, h) => {
                const g = ctx.createLinearGradient(0, h * 0.82, 0, h);
                g.addColorStop(0, 'rgba(15, 20, 38, 0.96)');
                g.addColorStop(1, 'rgba(4, 6, 11, 1.0)');
                return g;
            },
            rimColor: 'rgba(118, 87, 255, 0.09)',
            rimWidth: 1.5,
            glow: false
        }
    ];

    // ── High-DPI Canvas Resize ──
    function resize() {
        dpr = Math.min(window.devicePixelRatio || 1, 2);
        width = window.innerWidth;
        height = window.innerHeight;
        canvas.width = Math.floor(width * dpr);
        canvas.height = Math.floor(height * dpr);
        canvas.style.width = width + 'px';
        canvas.style.height = height + 'px';
        ctx.setTransform(dpr, 0, 0, dpr, 0, 0);
    }

    // ── 60FPS Fluid Wave Animation Loop ──
    function draw(now) {
        if (!isRunning) return;

        if (!lastTime) lastTime = now;
        const dt = Math.min((now - lastTime) / 1000, 0.1);
        lastTime = now;
        time += dt;

        // 1. Deep Obsidian Base Fill (#04060b)
        ctx.fillStyle = '#04060b';
        ctx.fillRect(0, 0, width, height);

        // 2. Soft Ambient Deep Celestial Lighting Pools
        const radialGrad1 = ctx.createRadialGradient(width * 0.25, height * 0.35, 10, width * 0.25, height * 0.35, width * 0.6);
        radialGrad1.addColorStop(0, 'rgba(118, 87, 255, 0.045)');
        radialGrad1.addColorStop(1, 'rgba(4, 6, 11, 0)');
        ctx.fillStyle = radialGrad1;
        ctx.fillRect(0, 0, width, height);

        const radialGrad2 = ctx.createRadialGradient(width * 0.75, height * 0.65, 10, width * 0.75, height * 0.65, width * 0.65);
        radialGrad2.addColorStop(0, 'rgba(18, 207, 243, 0.040)');
        radialGrad2.addColorStop(1, 'rgba(4, 6, 11, 0)');
        ctx.fillStyle = radialGrad2;
        ctx.fillRect(0, 0, width, height);

        // ── 3. Render Smooth 3D Fluid Silk Waves ──
        const step = Math.max(8, Math.floor(width / 120)); // High-density smooth curve sampling

        for (let i = 0; i < waves.length; i++) {
            const w = waves[i];
            const baseY = height * w.baseYRatio;
            const points = [];

            for (let x = 0; x <= width + step; x += step) {
                const y = baseY +
                    Math.sin(x * w.freq1 + time * w.speed1) * w.amp1 +
                    Math.sin(x * w.freq2 + time * w.speed2 + 1.2) * w.amp2 +
                    Math.cos(x * w.freq3 + time * w.speed3 + 2.4) * w.amp3;
                points.push({ x, y });
            }

            if (points.length < 2) continue;

            // Draw Filled Wave Body
            ctx.save();
            ctx.beginPath();
            ctx.moveTo(0, height);
            ctx.lineTo(points[0].x, points[0].y);

            for (let j = 0; j < points.length - 1; j++) {
                const xc = (points[j].x + points[j + 1].x) / 2;
                const yc = (points[j].y + points[j + 1].y) / 2;
                ctx.quadraticCurveTo(points[j].x, points[j].y, xc, yc);
            }

            const lastP = points[points.length - 1];
            ctx.lineTo(lastP.x, lastP.y);
            ctx.lineTo(width, height);
            ctx.closePath();

            ctx.fillStyle = w.fillGrad(width, height);
            ctx.fill();
            ctx.restore();

            // Draw Subtle Glowing Silk Rim Highlight
            ctx.save();
            ctx.beginPath();
            ctx.moveTo(points[0].x, points[0].y);

            for (let j = 0; j < points.length - 1; j++) {
                const xc = (points[j].x + points[j + 1].x) / 2;
                const yc = (points[j].y + points[j + 1].y) / 2;
                ctx.quadraticCurveTo(points[j].x, points[j].y, xc, yc);
            }
            ctx.lineTo(lastP.x, lastP.y);

            ctx.strokeStyle = w.rimColor;
            ctx.lineWidth = w.rimWidth;
            if (w.glow) {
                ctx.shadowColor = w.rimColor;
                ctx.shadowBlur = 8;
            }
            ctx.stroke();
            ctx.restore();
        }

        animationFrameId = requestAnimationFrame(draw);
    }

    function start() {
        if (isRunning) return;
        if (!document.documentElement.classList.contains('dark')) return;
        resize();
        isRunning = true;
        lastTime = 0;
        animationFrameId = requestAnimationFrame(draw);
    }

    function stop() {
        isRunning = false;
        if (animationFrameId) {
            cancelAnimationFrame(animationFrameId);
            animationFrameId = null;
        }
    }

    window.startDarkWaveEngine = start;
    window.stopDarkWaveEngine = stop;

    window.addEventListener('resize', () => {
        if (document.documentElement.classList.contains('dark')) {
            resize();
        }
    }, { passive: true });

    document.addEventListener('visibilitychange', () => {
        if (document.hidden) {
            stop();
        } else if (document.documentElement.classList.contains('dark')) {
            start();
        }
    });

    // Real-time Theme Class Observer
    const observer = new MutationObserver((mutations) => {
        for (const mutation of mutations) {
            if (mutation.attributeName === 'class') {
                if (document.documentElement.classList.contains('dark')) {
                    start();
                } else {
                    stop();
                }
            }
        }
    });
    observer.observe(document.documentElement, { attributes: true });

    // Initial Execution
    if (document.documentElement.classList.contains('dark')) {
        start();
    }
})();
</script>
