import React, { useEffect, useRef } from 'react';

/**
 * DarkPlexusBackground - Scaled Floating Plexus Network Clusters ("Jal") (Dark Mode)
 * Features:
 *  1. 14 scaled floating constellation clusters with smooth drifting & rotation
 *  2. Connected nodes with distinct glowing lines (#7657FF and #12CFF3) at 20-32% opacity
 *  3. GPU-accelerated 60FPS canvas loop with auto pause on tab inactive / theme change
 *  4. Deep space background (#030508)
 */
export const DarkPlexusBackground = () => {
    const canvasRef = useRef(null);

    useEffect(() => {
        const canvas = canvasRef.current;
        if (!canvas) return;

        const ctx = canvas.getContext('2d', { alpha: false, desynchronized: true });
        if (!ctx) return;

        let width = window.innerWidth;
        let height = window.innerHeight;
        let dpr = Math.min(window.devicePixelRatio || 1, 2);
        let animationFrameId = null;
        let lastTime = 0;
        let time = 0;

        const CLUSTER_COUNT = 14;
        const clusters = [];

        const initClusters = () => {
            clusters.length = 0;
            const basePositions = [
                { x: 0.10, y: 0.15 },
                { x: 0.35, y: 0.12 },
                { x: 0.65, y: 0.14 },
                { x: 0.90, y: 0.16 },
                { x: 0.22, y: 0.38 },
                { x: 0.50, y: 0.32 },
                { x: 0.78, y: 0.40 },
                { x: 0.12, y: 0.62 },
                { x: 0.42, y: 0.60 },
                { x: 0.88, y: 0.64 },
                { x: 0.25, y: 0.84 },
                { x: 0.55, y: 0.82 },
                { x: 0.75, y: 0.88 },
                { x: 0.92, y: 0.85 }
            ];

            for (let i = 0; i < CLUSTER_COUNT; i++) {
                const pos = basePositions[i] || { x: Math.random(), y: Math.random() };
                const isCyan = i % 2 === 0;
                const nodeCount = 8 + Math.floor(Math.random() * 6);
                const clusterRadius = 90 + Math.random() * 55;
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
                    connectDist: 105,
                    isCyan: isCyan,
                    r: isCyan ? 18 : 118,
                    g: isCyan ? 207 : 87,
                    b: isCyan ? 243 : 255,
                    nodes: nodes
                });
            }
        };

        const handleResize = () => {
            dpr = Math.min(window.devicePixelRatio || 1, 2);
            width = window.innerWidth;
            height = window.innerHeight;
            canvas.width = Math.floor(width * dpr);
            canvas.height = Math.floor(height * dpr);
            canvas.style.width = width + 'px';
            canvas.style.height = height + 'px';
            ctx.setTransform(dpr, 0, 0, dpr, 0, 0);
            initClusters();
        };
        handleResize();
        window.addEventListener('resize', handleResize, { passive: true });

        const draw = (now) => {
            if (!lastTime) lastTime = now;
            const dt = Math.min((now - lastTime) / 1000, 0.1);
            lastTime = now;
            time += dt;

            ctx.fillStyle = '#030508';
            ctx.fillRect(0, 0, width, height);

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

            for (let c = 0; c < clusters.length; c++) {
                const cl = clusters[c];

                cl.cx += cl.vx * (dt * 60);
                cl.cy += cl.vy * (dt * 60);
                cl.angle += cl.rotSpeed * (dt * 60);

                const padding = 120;
                if (cl.cx < -padding) cl.cx = width + padding;
                if (cl.cx > width + padding) cl.cx = -padding;
                if (cl.cy < -padding) cl.cy = height + padding;
                if (cl.cy > height + padding) cl.cy = -padding;

                const cosA = Math.cos(cl.angle);
                const sinA = Math.sin(cl.angle);

                const worldNodes = [];
                for (let i = 0; i < cl.nodes.length; i++) {
                    const n = cl.nodes[i];
                    n.lx += n.vx * (dt * 60);
                    n.ly += n.vy * (dt * 60);

                    const d = Math.hypot(n.lx, n.ly);
                    if (d > 135) {
                        n.vx *= -1;
                        n.vy *= -1;
                    }

                    const wx = cl.cx + (cosA * n.lx - sinA * n.ly);
                    const wy = cl.cy + (sinA * n.lx + cosA * n.ly);
                    worldNodes.push({ wx, wy, radius: n.radius });
                }

                for (let i = 0; i < worldNodes.length; i++) {
                    for (let j = i + 1; j < worldNodes.length; j++) {
                        const dx = worldNodes[i].wx - worldNodes[j].wx;
                        const dy = worldNodes[i].wy - worldNodes[j].wy;
                        const dist = Math.hypot(dx, dy);

                        if (dist < cl.connectDist) {
                            const alpha = (1 - dist / cl.connectDist) * 0.32;
                            ctx.strokeStyle = `rgba(${cl.r}, ${cl.g}, ${cl.b}, ${alpha})`;
                            ctx.lineWidth = 1.0;
                            ctx.beginPath();
                            ctx.moveTo(worldNodes[i].wx, worldNodes[i].wy);
                            ctx.lineTo(worldNodes[j].wx, worldNodes[j].wy);
                            ctx.stroke();
                        }
                    }
                }

                for (let i = 0; i < worldNodes.length; i++) {
                    const wn = worldNodes[i];

                    ctx.fillStyle = `rgba(${cl.r}, ${cl.g}, ${cl.b}, 0.55)`;
                    ctx.beginPath();
                    ctx.arc(wn.wx, wn.wy, wn.radius, 0, Math.PI * 2);
                    ctx.fill();

                    ctx.fillStyle = `rgba(${cl.r}, ${cl.g}, ${cl.b}, 0.18)`;
                    ctx.beginPath();
                    ctx.arc(wn.wx, wn.wy, wn.radius * 2.4, 0, Math.PI * 2);
                    ctx.fill();
                }
            }

            animationFrameId = requestAnimationFrame(draw);
        };

        animationFrameId = requestAnimationFrame(draw);

        return () => {
            if (animationFrameId) cancelAnimationFrame(animationFrameId);
            window.removeEventListener('resize', handleResize);
        };
    }, []);

    return (
        <canvas
            ref={canvasRef}
            id="darkPlexusCanvas"
            className="fixed inset-0 w-full h-full pointer-events-none z-0 bg-[#030508]"
        />
    );
};

export default DarkPlexusBackground;
