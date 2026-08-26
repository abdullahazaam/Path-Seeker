{{-- ══════════════════ DEDICATED DARK MODE FLOATING PLEXUS NETWORK BACKGROUND ══════════════════ --}}
{{-- 60FPS WebGL/Canvas Scaled Plexus Constellation Clusters ("Jal") with Smooth Floating Drift & Subtle Rotation --}}
<canvas id="darkPlexusCanvas" class="fixed inset-0 w-full h-full pointer-events-none z-0 overflow-hidden bg-[#030508] hidden dark:block transition-colors duration-500"></canvas>

<script>
(function() {
    'use strict';

    const canvas = document.getElementById('darkPlexusCanvas');
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

    // ── 14 Scaled Floating Constellation Clusters ("Jal") ──
    const CLUSTER_COUNT = 14;
    const clusters = [];

    function initClusters() {
        clusters.length = 0;
        const basePositions = [
            { x: 0.10, y: 0.15 }, // Top-Left Outer
            { x: 0.35, y: 0.12 }, // Top-Center-Left
            { x: 0.65, y: 0.14 }, // Top-Center-Right
            { x: 0.90, y: 0.16 }, // Top-Right Outer
            { x: 0.22, y: 0.38 }, // Upper-Mid-Left
            { x: 0.50, y: 0.32 }, // Upper-Center
            { x: 0.78, y: 0.40 }, // Upper-Mid-Right
            { x: 0.12, y: 0.62 }, // Lower-Mid-Left
            { x: 0.42, y: 0.60 }, // Center-Lower
            { x: 0.88, y: 0.64 }, // Lower-Mid-Right
            { x: 0.25, y: 0.84 }, // Bottom-Left
            { x: 0.55, y: 0.82 }, // Bottom-Center
            { x: 0.75, y: 0.88 }, // Bottom-Right-Mid
            { x: 0.92, y: 0.85 }  // Bottom-Right Outer
        ];

        for (let i = 0; i < CLUSTER_COUNT; i++) {
            const pos = basePositions[i] || { x: Math.random(), y: Math.random() };
            const isCyan = i % 2 === 0;
            const nodeCount = 8 + Math.floor(Math.random() * 6); // 8-13 nodes per cluster
            const clusterRadius = 90 + Math.random() * 55; // 90px - 145px spread (Scaled Up)
            const nodes = [];

            for (let j = 0; j < nodeCount; j++) {
                const angle = Math.random() * Math.PI * 2;
                const dist = Math.random() * clusterRadius;
                nodes.push({
                    lx: Math.cos(angle) * dist,
                    ly: Math.sin(angle) * dist,
                    vx: (Math.random() - 0.5) * 0.28,
                    vy: (Math.random() - 0.5) * 0.28,
                    radius: 1.6 + Math.random() * 1.6
                });
            }

            clusters.push({
                cx: pos.x * width,
                cy: pos.y * height,
                vx: (Math.random() - 0.5) * 0.38,
                vy: (Math.random() - 0.5) * 0.38,
                angle: Math.random() * Math.PI * 2,
                rotSpeed: (Math.random() - 0.5) * 0.0035,
                connectDist: 105, // Increased connect distance for distinct web links
                isCyan: isCyan,
                r: isCyan ? 18 : 118,
                g: isCyan ? 207 : 87,
                b: isCyan ? 243 : 255,
                nodes: nodes
            });
        }
    }

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

        initClusters();
    }

    // ── 60FPS Plexus Render Loop ──
    function draw(now) {
        if (!isRunning) return;

        if (!lastTime) lastTime = now;
        const dt = Math.min((now - lastTime) / 1000, 0.1);
        lastTime = now;
        time += dt;

        // 1. Deep Space Background Base Fill (#030508)
        ctx.fillStyle = '#030508';
        ctx.fillRect(0, 0, width, height);

        // 2. Faint Ambient Deep Lighting Pools
        const radialGrad1 = ctx.createRadialGradient(width * 0.2, height * 0.3, 10, width * 0.2, height * 0.3, width * 0.5);
        radialGrad1.addColorStop(0, 'rgba(118, 87, 255, 0.045)');
        radialGrad1.addColorStop(1, 'rgba(3, 5, 8, 0)');
        ctx.fillStyle = radialGrad1;
        ctx.fillRect(0, 0, width, height);

        const radialGrad2 = ctx.createRadialGradient(width * 0.8, height * 0.7, 10, width * 0.8, height * 0.7, width * 0.55);
        radialGrad2.addColorStop(0, 'rgba(18, 207, 243, 0.040)');
        radialGrad2.addColorStop(1, 'rgba(3, 5, 8, 0)');
        ctx.fillStyle = radialGrad2;
        ctx.fillRect(0, 0, width, height);

        // ── 3. Render Each Floating Plexus Network Cluster ──
        for (let c = 0; c < clusters.length; c++) {
            const cl = clusters[c];

            // Drift cluster center
            cl.cx += cl.vx * (dt * 60);
            cl.cy += cl.vy * (dt * 60);
            cl.angle += cl.rotSpeed * (dt * 60);

            // Screen edge bounce / wrap
            const padding = 120;
            if (cl.cx < -padding) cl.cx = width + padding;
            if (cl.cx > width + padding) cl.cx = -padding;
            if (cl.cy < -padding) cl.cy = height + padding;
            if (cl.cy > height + padding) cl.cy = -padding;

            const cosA = Math.cos(cl.angle);
            const sinA = Math.sin(cl.angle);

            // Compute world positions for nodes in this cluster
            const worldNodes = [];
            for (let i = 0; i < cl.nodes.length; i++) {
                const n = cl.nodes[i];
                n.lx += n.vx * (dt * 60);
                n.ly += n.vy * (dt * 60);

                // Keep nodes within local radius
                const d = Math.hypot(n.lx, n.ly);
                if (d > 135) {
                    n.vx *= -1;
                    n.vy *= -1;
                }

                // Apply rotation
                const wx = cl.cx + (cosA * n.lx - sinA * n.ly);
                const wy = cl.cy + (sinA * n.lx + cosA * n.ly);
                worldNodes.push({ wx, wy, radius: n.radius });
            }

            // Draw Connected Network Lines ("Jal")
            for (let i = 0; i < worldNodes.length; i++) {
                for (let j = i + 1; j < worldNodes.length; j++) {
                    const dx = worldNodes[i].wx - worldNodes[j].wx;
                    const dy = worldNodes[i].wy - worldNodes[j].wy;
                    const dist = Math.hypot(dx, dy);

                    if (dist < cl.connectDist) {
                        const alpha = (1 - dist / cl.connectDist) * 0.32; // Crisp 20-32% opacity
                        ctx.strokeStyle = `rgba(${cl.r}, ${cl.g}, ${cl.b}, ${alpha})`;
                        ctx.lineWidth = 1.0;
                        ctx.beginPath();
                        ctx.moveTo(worldNodes[i].wx, worldNodes[i].wy);
                        ctx.lineTo(worldNodes[j].wx, worldNodes[j].wy);
                        ctx.stroke();
                    }
                }
            }

            // Draw Plexus Nodes / Star Points
            for (let i = 0; i < worldNodes.length; i++) {
                const wn = worldNodes[i];

                // Node Point Core
                ctx.fillStyle = `rgba(${cl.r}, ${cl.g}, ${cl.b}, 0.55)`;
                ctx.beginPath();
                ctx.arc(wn.wx, wn.wy, wn.radius, 0, Math.PI * 2);
                ctx.fill();

                // Subtle Outer Halo
                ctx.fillStyle = `rgba(${cl.r}, ${cl.g}, ${cl.b}, 0.18)`;
                ctx.beginPath();
                ctx.arc(wn.wx, wn.wy, wn.radius * 2.4, 0, Math.PI * 2);
                ctx.fill();
            }
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

    window.startDarkPlexusEngine = start;
    window.stopDarkPlexusEngine = stop;

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

    // Real-Time Theme Class Observer
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
