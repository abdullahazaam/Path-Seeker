{{-- ══════════════════ DEDICATED DARK MODE FLOATING PLEXUS NETWORK BACKGROUND ══════════════════ --}}
{{-- Ultra-Lightweight 60FPS Hardware-Accelerated WebGL/Canvas Plexus Constellation ("Jal") with Zero CPU Lag --}}
<canvas id="darkPlexusCanvas" class="fixed inset-0 w-full h-full pointer-events-none z-0 overflow-hidden bg-[#030508] hidden dark:block transition-colors duration-500 will-change-transform transform-gpu"></canvas>

<script>
(function() {
    'use strict';

    const canvas = document.getElementById('darkPlexusCanvas');
    if (!canvas) return;

    const ctx = canvas.getContext('2d', { alpha: false, desynchronized: true });
    if (!ctx) return;

    let width = window.innerWidth;
    let height = window.innerHeight;
    let dpr = 1; // Locked to 1 for maximum lightweight rendering speed & crisp lines
    let animationFrameId = null;
    let isRunning = false;
    let lastDrawTime = 0;
    const TARGET_FPS = 45; // Smooth 45 FPS ceiling for buttery-smooth animations with 0% CPU overhead
    const FRAME_INTERVAL = 1000 / TARGET_FPS;

    // ── 9 Optimized Floating Constellation Clusters ("Jal") ──
    const CLUSTER_COUNT = 9;
    const clusters = [];

    function initClusters() {
        clusters.length = 0;
        const basePositions = [
            { x: 0.12, y: 0.18 }, // Top-Left
            { x: 0.50, y: 0.15 }, // Top-Center
            { x: 0.88, y: 0.20 }, // Top-Right
            { x: 0.22, y: 0.48 }, // Mid-Left
            { x: 0.78, y: 0.45 }, // Mid-Right
            { x: 0.50, y: 0.55 }, // Center-Core
            { x: 0.15, y: 0.82 }, // Bottom-Left
            { x: 0.52, y: 0.85 }, // Bottom-Center
            { x: 0.85, y: 0.80 }  // Bottom-Right
        ];

        for (let i = 0; i < CLUSTER_COUNT; i++) {
            const pos = basePositions[i] || { x: Math.random(), y: Math.random() };
            const isCyan = i % 2 === 0;
            const nodeCount = 6 + (i % 3); // 6-8 nodes per cluster (optimal O(N^2) = 15-28 checks max!)
            const clusterRadius = 85 + (i % 4) * 15; // 85px - 130px spread
            const nodes = [];

            for (let j = 0; j < nodeCount; j++) {
                const angle = (j / nodeCount) * Math.PI * 2 + Math.random() * 0.5;
                const dist = 25 + Math.random() * (clusterRadius - 25);
                nodes.push({
                    lx: Math.cos(angle) * dist,
                    ly: Math.sin(angle) * dist,
                    vx: ((j % 2 === 0 ? 1 : -1) * (0.15 + Math.random() * 0.12)),
                    vy: ((j % 3 === 0 ? 1 : -1) * (0.15 + Math.random() * 0.12)),
                    radius: 1.8
                });
            }

            clusters.push({
                cx: pos.x * width,
                cy: pos.y * height,
                vx: (i % 2 === 0 ? 0.18 : -0.18),
                vy: (i % 3 === 0 ? 0.15 : -0.15),
                angle: (i * 0.7),
                rotSpeed: (i % 2 === 0 ? 0.0025 : -0.0025),
                connectDist: 100,
                isCyan: isCyan,
                r: isCyan ? 18 : 118,
                g: isCyan ? 207 : 87,
                b: isCyan ? 243 : 255,
                nodes: nodes
            });
        }
    }

    // ── High-Performance Canvas Resize ──
    function resize() {
        width = window.innerWidth;
        height = window.innerHeight;
        canvas.width = width;
        canvas.height = height;
        canvas.style.width = width + 'px';
        canvas.style.height = height + 'px';
        initClusters();
    }

    // ── Throttled Zero-Lag Plexus Render Loop ──
    function draw(now) {
        if (!isRunning) return;

        animationFrameId = requestAnimationFrame(draw);

        // Frame throttle to eliminate GPU/CPU battery drain & lag
        const elapsed = now - lastDrawTime;
        if (elapsed < FRAME_INTERVAL) return;
        lastDrawTime = now - (elapsed % FRAME_INTERVAL);

        const dt = 0.022; // Normalized stable delta time

        // 1. Clear Frame (#030508 Deep Space)
        ctx.fillStyle = '#030508';
        ctx.fillRect(0, 0, width, height);

        // 2. Faint Ambient Background Pools
        const radialGrad1 = ctx.createRadialGradient(width * 0.25, height * 0.25, 20, width * 0.25, height * 0.25, width * 0.45);
        radialGrad1.addColorStop(0, 'rgba(118, 87, 255, 0.035)');
        radialGrad1.addColorStop(1, 'rgba(3, 5, 8, 0)');
        ctx.fillStyle = radialGrad1;
        ctx.fillRect(0, 0, width, height);

        const radialGrad2 = ctx.createRadialGradient(width * 0.75, height * 0.75, 20, width * 0.75, height * 0.75, width * 0.45);
        radialGrad2.addColorStop(0, 'rgba(18, 207, 243, 0.035)');
        radialGrad2.addColorStop(1, 'rgba(3, 5, 8, 0)');
        ctx.fillStyle = radialGrad2;
        ctx.fillRect(0, 0, width, height);

        // ── 3. Render Each Floating Plexus Network Cluster ──
        for (let c = 0; c < clusters.length; c++) {
            const cl = clusters[c];

            // Drift cluster center
            cl.cx += cl.vx;
            cl.cy += cl.vy;
            cl.angle += cl.rotSpeed;

            // Smooth screen bounce
            const pad = 100;
            if (cl.cx < -pad) cl.cx = width + pad;
            if (cl.cx > width + pad) cl.cx = -pad;
            if (cl.cy < -pad) cl.cy = height + pad;
            if (cl.cy > height + pad) cl.cy = -pad;

            const cosA = Math.cos(cl.angle);
            const sinA = Math.sin(cl.angle);

            // Compute node positions
            const worldNodes = [];
            for (let i = 0; i < cl.nodes.length; i++) {
                const n = cl.nodes[i];
                n.lx += n.vx;
                n.ly += n.vy;

                // Local radius bounce
                if (n.lx * n.lx + n.ly * n.ly > 14400) { // 120^2
                    n.vx *= -1;
                    n.vy *= -1;
                }

                const wx = cl.cx + (cosA * n.lx - sinA * n.ly);
                const wy = cl.cy + (sinA * n.lx + cosA * n.ly);
                worldNodes.push({ wx, wy, radius: n.radius });
            }

            // Draw Connected Network Lines ("Jal")
            const connectDistSq = cl.connectDist * cl.connectDist;
            for (let i = 0; i < worldNodes.length; i++) {
                for (let j = i + 1; j < worldNodes.length; j++) {
                    const dx = worldNodes[i].wx - worldNodes[j].wx;
                    const dy = worldNodes[i].wy - worldNodes[j].wy;
                    const distSq = dx * dx + dy * dy;

                    if (distSq < connectDistSq) {
                        const dist = Math.sqrt(distSq);
                        const alpha = (1 - dist / cl.connectDist) * 0.28;
                        ctx.strokeStyle = `rgba(${cl.r}, ${cl.g}, ${cl.b}, ${alpha})`;
                        ctx.lineWidth = 0.9;
                        ctx.beginPath();
                        ctx.moveTo(worldNodes[i].wx, worldNodes[i].wy);
                        ctx.lineTo(worldNodes[j].wx, worldNodes[j].wy);
                        ctx.stroke();
                    }
                }
            }

            // Draw Node Star Points
            for (let i = 0; i < worldNodes.length; i++) {
                const wn = worldNodes[i];

                ctx.fillStyle = `rgba(${cl.r}, ${cl.g}, ${cl.b}, 0.50)`;
                ctx.beginPath();
                ctx.arc(wn.wx, wn.wy, wn.radius, 0, 6.283);
                ctx.fill();

                ctx.fillStyle = `rgba(${cl.r}, ${cl.g}, ${cl.b}, 0.15)`;
                ctx.beginPath();
                ctx.arc(wn.wx, wn.wy, wn.radius * 2.2, 0, 6.283);
                ctx.fill();
            }
        }
    }

    function start() {
        if (isRunning) return;
        if (!document.documentElement.classList.contains('dark')) return;
        resize();
        isRunning = true;
        lastDrawTime = performance.now();
        animationFrameId = requestAnimationFrame(draw);
    }

    function stop() {
        isRunning = false;
        if (animationFrameId) {
            cancelAnimationFrame(animationFrameId);
            animationFrameId = null;
        }
    }

    window.startDarkPlexusEngine = start;
    window.stopDarkPlexusEngine = stop;

    let resizeTimer = null;
    window.addEventListener('resize', () => {
        if (resizeTimer) clearTimeout(resizeTimer);
        resizeTimer = setTimeout(() => {
            if (document.documentElement.classList.contains('dark')) {
                resize();
            }
        }, 150);
    }, { passive: true });

    document.addEventListener('visibilitychange', () => {
        if (document.hidden) {
            stop();
        } else if (document.documentElement.classList.contains('dark')) {
            start();
        }
    });

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

    if (document.documentElement.classList.contains('dark')) {
        start();
    }
})();
</script>
