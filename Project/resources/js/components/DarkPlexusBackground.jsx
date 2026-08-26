import React, { useEffect, useRef } from 'react';

/**
 * DarkPlexusBackground - Lazy-Loaded Ultra-Optimized Canvas Background Component (Dark Mode)
 */
export const DarkPlexusBackground = () => {
    const canvasRef = useRef(null);

    useEffect(() => {
        const canvas = canvasRef.current;
        if (!canvas) return;

        let animationFrameId = null;
        let lastDrawTime = 0;
        let isMounted = true;
        const TARGET_FPS = 45;
        const FRAME_INTERVAL = 1000 / TARGET_FPS;

        let width = window.innerWidth;
        let height = window.innerHeight;
        const CLUSTER_COUNT = 9;
        const clusters = [];

        const ctx = canvas.getContext('2d', { alpha: false, desynchronized: true });
        if (!ctx) return;

        const initClusters = () => {
            clusters.length = 0;
            const basePositions = [
                { x: 0.12, y: 0.18 },
                { x: 0.50, y: 0.15 },
                { x: 0.88, y: 0.20 },
                { x: 0.22, y: 0.48 },
                { x: 0.78, y: 0.45 },
                { x: 0.50, y: 0.55 },
                { x: 0.15, y: 0.82 },
                { x: 0.52, y: 0.85 },
                { x: 0.85, y: 0.80 }
            ];

            for (let i = 0; i < CLUSTER_COUNT; i++) {
                const pos = basePositions[i] || { x: 0.5, y: 0.5 };
                const isCyan = i % 2 === 0;
                const nodeCount = 6 + (i % 3);
                const clusterRadius = 85 + (i % 4) * 15;
                const nodes = [];

                for (let j = 0; j < nodeCount; j++) {
                    const angle = (j / nodeCount) * 6.283 + (j * 0.1);
                    const dist = 25 + (j * 8) % (clusterRadius - 25);
                    nodes.push({
                        lx: Math.cos(angle) * dist,
                        ly: Math.sin(angle) * dist,
                        vx: (j % 2 === 0 ? 0.18 : -0.18),
                        vy: (j % 3 === 0 ? 0.16 : -0.16),
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
        };

        const handleResize = () => {
            if (!isMounted) return;
            width = window.innerWidth;
            height = window.innerHeight;
            canvas.width = width;
            canvas.height = height;
            canvas.style.width = width + 'px';
            canvas.style.height = height + 'px';
            initClusters();
        };

        let resizeTimer = null;
        const onResize = () => {
            if (resizeTimer) clearTimeout(resizeTimer);
            resizeTimer = setTimeout(handleResize, 200);
        };
        window.addEventListener('resize', onResize, { passive: true });

        const draw = (now) => {
            if (!isMounted) return;
            animationFrameId = requestAnimationFrame(draw);

            const elapsed = now - lastDrawTime;
            if (elapsed < FRAME_INTERVAL) return;
            lastDrawTime = now - (elapsed % FRAME_INTERVAL);

            ctx.fillStyle = '#030508';
            ctx.fillRect(0, 0, width, height);

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

            for (let c = 0; c < clusters.length; c++) {
                const cl = clusters[c];

                cl.cx += cl.vx;
                cl.cy += cl.vy;
                cl.angle += cl.rotSpeed;

                const pad = 100;
                if (cl.cx < -pad) cl.cx = width + pad;
                if (cl.cx > width + pad) cl.cx = -pad;
                if (cl.cy < -pad) cl.cy = height + pad;
                if (cl.cy > height + pad) cl.cy = -pad;

                const cosA = Math.cos(cl.angle);
                const sinA = Math.sin(cl.angle);

                const worldNodes = [];
                for (let i = 0; i < cl.nodes.length; i++) {
                    const n = cl.nodes[i];
                    n.lx += n.vx;
                    n.ly += n.vy;

                    if (n.lx * n.lx + n.ly * n.ly > 14400) {
                        n.vx *= -1;
                        n.vy *= -1;
                    }

                    const wx = cl.cx + (cosA * n.lx - sinA * n.ly);
                    const wy = cl.cy + (sinA * n.lx + cosA * n.ly);
                    worldNodes.push({ wx, wy, radius: n.radius });
                }

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
        };

        // Defer rendering start using requestIdleCallback to keep initial UI load instantaneous
        let idleId = null;
        const startEngine = () => {
            handleResize();
            lastDrawTime = performance.now();
            animationFrameId = requestAnimationFrame(draw);
        };

        if (typeof window.requestIdleCallback === 'function') {
            idleId = window.requestIdleCallback(startEngine, { timeout: 800 });
        } else {
            const timeoutId = setTimeout(startEngine, 100);
            idleId = { cancel: () => clearTimeout(timeoutId) };
        }

        return () => {
            isMounted = false;
            if (animationFrameId) cancelAnimationFrame(animationFrameId);
            if (idleId) {
                if (typeof window.cancelIdleCallback === 'function' && typeof idleId === 'number') {
                    window.cancelIdleCallback(idleId);
                } else if (idleId.cancel) {
                    idleId.cancel();
                }
            }
            window.removeEventListener('resize', onResize);
            if (resizeTimer) clearTimeout(resizeTimer);
        };
    }, []);

    return (
        <canvas
            ref={canvasRef}
            id="darkPlexusCanvas"
            className="fixed inset-0 w-full h-full pointer-events-none z-0 bg-[#030508] will-change-transform transform-gpu"
        />
    );
};

export default DarkPlexusBackground;
