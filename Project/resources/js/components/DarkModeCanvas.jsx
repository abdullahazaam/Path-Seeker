import React, { useEffect, useRef } from 'react';

/**
 * DarkModeCanvas - High-performance HTML5 Canvas 3D Animated Background
 * Features:
 *  1. Luminous Digital Rain (#7657FF & #12CFF3)
 *  2. 3D Undulating Particle Wave (#12CFF3 & #7657FF with perspective projection)
 *  3. Floating Glass Bubbles with Specular Highlights
 *  4. Motion blur trailing effect using ctx.fillStyle = 'rgba(6, 8, 15, 0.22)'
 */
export const DarkModeCanvas = () => {
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

        // ── 1. Digital Rain System ──
        const RAIN_COUNT = 55;
        const rainDrops = [];
        for (let i = 0; i < RAIN_COUNT; i++) {
            const isCyan = Math.random() > 0.45;
            rainDrops.push({
                x: Math.random() * width,
                y: Math.random() * height * 1.5 - height * 0.5,
                speed: 4.5 + Math.random() * 6.5,
                length: 45 + Math.random() * 120,
                width: 1.2 + Math.random() * 1.2,
                color: isCyan ? '#12CFF3' : '#7657FF',
                r: isCyan ? 18 : 118,
                g: isCyan ? 207 : 87,
                b: isCyan ? 243 : 255,
                alpha: 0.4 + Math.random() * 0.55
            });
        }

        // ── 2. 3D Particle Wave System (Bottom Sea) ──
        const GRID_X = 52;
        const GRID_Z = 30;
        const grid = [];
        for (let i = 0; i < GRID_X; i++) {
            grid[i] = [];
            for (let j = 0; j < GRID_Z; j++) {
                grid[i][j] = { sx: 0, sy: 0, scale: 0, alpha: 0, isCrest: false };
            }
        }

        // ── 3. Floating Glass Bubbles System ──
        const BUBBLE_COUNT = 16;
        const bubbles = [];
        for (let i = 0; i < BUBBLE_COUNT; i++) {
            const isCyan = Math.random() > 0.45;
            bubbles.push({
                baseX: Math.random() * width,
                x: 0,
                y: Math.random() * height,
                radius: 16 + Math.random() * 48,
                vy: -(0.35 + Math.random() * 0.75),
                driftFreq: 0.0012 + Math.random() * 0.002,
                driftAmp: 20 + Math.random() * 35,
                driftPhase: Math.random() * Math.PI * 2,
                isCyan: isCyan,
                color: isCyan ? 'rgba(18, 207, 243, 0.6)' : 'rgba(118, 87, 255, 0.6)',
                r: isCyan ? 18 : 118,
                g: isCyan ? 207 : 87,
                b: isCyan ? 243 : 255,
                alpha: 0.25 + Math.random() * 0.3
            });
        }

        // ── Resize Handler ──
        const handleResize = () => {
            dpr = Math.min(window.devicePixelRatio || 1, 2);
            width = window.innerWidth;
            height = window.innerHeight;
            canvas.width = Math.floor(width * dpr);
            canvas.height = Math.floor(height * dpr);
            canvas.style.width = width + 'px';
            canvas.style.height = height + 'px';
            ctx.setTransform(dpr, 0, 0, dpr, 0, 0);
        };
        handleResize();
        window.addEventListener('resize', handleResize, { passive: true });

        // ── Main 60FPS Draw Loop ──
        const draw = (now) => {
            if (!lastTime) lastTime = now;
            const dt = Math.min((now - lastTime) / 1000, 0.1);
            lastTime = now;
            time += dt;

            // 1. Semi-transparent Black Base for Motion Blur Trailing
            ctx.fillStyle = 'rgba(6, 8, 15, 0.22)';
            ctx.fillRect(0, 0, width, height);

            // 2. Ambient Deep Space Light Pools
            const radialGrad1 = ctx.createRadialGradient(width * 0.2, height * 0.25, 10, width * 0.2, height * 0.25, width * 0.5);
            radialGrad1.addColorStop(0, 'rgba(118, 87, 255, 0.06)');
            radialGrad1.addColorStop(1, 'rgba(6, 8, 15, 0)');
            ctx.fillStyle = radialGrad1;
            ctx.fillRect(0, 0, width, height);

            const radialGrad2 = ctx.createRadialGradient(width * 0.8, height * 0.7, 10, width * 0.8, height * 0.7, width * 0.55);
            radialGrad2.addColorStop(0, 'rgba(18, 207, 243, 0.05)');
            radialGrad2.addColorStop(1, 'rgba(6, 8, 15, 0)');
            ctx.fillStyle = radialGrad2;
            ctx.fillRect(0, 0, width, height);

            // ── 3. Render Digital Rain ──
            for (let i = 0; i < rainDrops.length; i++) {
                const drop = rainDrops[i];
                drop.y += drop.speed * (dt * 60);

                if (drop.y - drop.length > height) {
                    drop.y = -drop.length - Math.random() * 60;
                    drop.x = Math.random() * width;
                    drop.speed = 4.5 + Math.random() * 6.5;
                    drop.length = 45 + Math.random() * 120;
                }

                const startY = Math.max(0, drop.y - drop.length);
                const endY = drop.y;

                if (endY > 0 && startY < height) {
                    const grad = ctx.createLinearGradient(drop.x, startY, drop.x, endY);
                    grad.addColorStop(0, `rgba(${drop.r}, ${drop.g}, ${drop.b}, 0)`);
                    grad.addColorStop(0.7, `rgba(${drop.r}, ${drop.g}, ${drop.b}, ${drop.alpha * 0.4})`);
                    grad.addColorStop(0.95, `rgba(${drop.r}, ${drop.g}, ${drop.b}, ${drop.alpha})`);
                    grad.addColorStop(1, '#ffffff');

                    ctx.strokeStyle = grad;
                    ctx.lineWidth = drop.width;
                    ctx.beginPath();
                    ctx.moveTo(drop.x, startY);
                    ctx.lineTo(drop.x, endY);
                    ctx.stroke();

                    // Luminous head tip
                    ctx.fillStyle = drop.color;
                    ctx.beginPath();
                    ctx.arc(drop.x, endY, drop.width * 1.1, 0, Math.PI * 2);
                    ctx.fill();
                }
            }

            // ── 4. Render Floating Glass Bubbles ──
            for (let i = 0; i < bubbles.length; i++) {
                const b = bubbles[i];
                b.y += b.vy * (dt * 60);
                b.x = b.baseX + Math.sin(time * 1000 * b.driftFreq + b.driftPhase) * b.driftAmp;

                if (b.y < -b.radius * 2) {
                    b.y = height + b.radius * 2;
                    b.baseX = Math.random() * width;
                    b.radius = 16 + Math.random() * 48;
                }

                const r = b.radius;
                const bx = b.x;
                const by = b.y;

                // Glass Body Radial Sheen
                const bubbleGrad = ctx.createRadialGradient(
                    bx - r * 0.3, by - r * 0.3, r * 0.1,
                    bx, by, r
                );
                bubbleGrad.addColorStop(0, `rgba(255, 255, 255, ${b.alpha * 0.25})`);
                bubbleGrad.addColorStop(0.5, `rgba(${b.r}, ${b.g}, ${b.b}, ${b.alpha * 0.12})`);
                bubbleGrad.addColorStop(0.85, `rgba(${b.r}, ${b.g}, ${b.b}, ${b.alpha * 0.4})`);
                bubbleGrad.addColorStop(1, `rgba(${b.r}, ${b.g}, ${b.b}, ${b.alpha * 0.65})`);

                ctx.fillStyle = bubbleGrad;
                ctx.beginPath();
                ctx.arc(bx, by, r, 0, Math.PI * 2);
                ctx.fill();

                // Crisp Glass Stroke
                ctx.strokeStyle = b.color;
                ctx.lineWidth = 1.2;
                ctx.stroke();

                // Specular Glint Crescent
                const glintGrad = ctx.createRadialGradient(
                    bx - r * 0.35, by - r * 0.35, 1,
                    bx - r * 0.35, by - r * 0.35, r * 0.42
                );
                glintGrad.addColorStop(0, `rgba(255, 255, 255, ${b.alpha * 0.9})`);
                glintGrad.addColorStop(0.5, `rgba(255, 255, 255, ${b.alpha * 0.35})`);
                glintGrad.addColorStop(1, 'rgba(255, 255, 255, 0)');

                ctx.fillStyle = glintGrad;
                ctx.beginPath();
                ctx.arc(bx - r * 0.3, by - r * 0.3, r * 0.35, 0, Math.PI * 2);
                ctx.fill();
            }

            // ── 5. Render 3D Undulating Particle Wave (Bottom 30-40%) ──
            const fov = 380;
            const horizonY = height * 0.60;
            const cameraY = 170;

            for (let i = 0; i < GRID_X; i++) {
                const u = (i / (GRID_X - 1)) - 0.5;
                const wx = u * (width * 1.8);

                for (let j = 0; j < GRID_Z; j++) {
                    const v = j / (GRID_Z - 1);
                    const wz = 100 + v * 1250;

                    const wy = Math.sin(wx * 0.0032 + time * 1.4) * Math.cos(wz * 0.0038 + time * 1.1) * 56 +
                               Math.sin((wx - wz) * 0.0024 + time * 1.65) * 30 +
                               Math.cos(wx * 0.005 - time * 0.8) * 15;

                    const scale = fov / (fov + wz);
                    const sx = (width * 0.5) + wx * scale;
                    const sy = horizonY + (wy + cameraY) * scale;
                    const alpha = Math.min(Math.max((scale * 1.3) * (0.35 + 0.65 * ((wy + 60) / 120)), 0.06), 0.95);
                    const isCrest = wy > 4;

                    grid[i][j].sx = sx;
                    grid[i][j].sy = sy;
                    grid[i][j].scale = scale;
                    grid[i][j].alpha = alpha;
                    grid[i][j].isCrest = isCrest;
                }
            }

            // Connecting Grid Wireframe Lines
            ctx.lineWidth = 1;
            for (let i = 0; i < GRID_X; i++) {
                for (let j = 0; j < GRID_Z; j++) {
                    const p = grid[i][j];

                    if (i < GRID_X - 1) {
                        const nextX = grid[i + 1][j];
                        const lineAlpha = (p.alpha + nextX.alpha) * 0.13;
                        ctx.strokeStyle = p.isCrest
                            ? `rgba(18, 207, 243, ${lineAlpha})`
                            : `rgba(118, 87, 255, ${lineAlpha})`;
                        ctx.beginPath();
                        ctx.moveTo(p.sx, p.sy);
                        ctx.lineTo(nextX.sx, nextX.sy);
                        ctx.stroke();
                    }

                    if (j < GRID_Z - 1) {
                        const nextZ = grid[i][j + 1];
                        const lineAlpha = (p.alpha + nextZ.alpha) * 0.11;
                        ctx.strokeStyle = p.isCrest
                            ? `rgba(18, 207, 243, ${lineAlpha})`
                            : `rgba(118, 87, 255, ${lineAlpha})`;
                        ctx.beginPath();
                        ctx.moveTo(p.sx, p.sy);
                        ctx.lineTo(nextZ.sx, nextZ.sy);
                        ctx.stroke();
                    }
                }
            }

            // Glowing 3D Particle Dots
            for (let i = 0; i < GRID_X; i++) {
                for (let j = 0; j < GRID_Z; j++) {
                    const p = grid[i][j];
                    const radius = Math.max(0.8, (0.8 + p.scale * 3.0));

                    ctx.fillStyle = p.isCrest
                        ? `rgba(18, 207, 243, ${p.alpha})`
                        : `rgba(118, 87, 255, ${p.alpha})`;

                    ctx.beginPath();
                    ctx.arc(p.sx, p.sy, radius, 0, Math.PI * 2);
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
            id="darkCanvasBg"
            className="fixed inset-0 w-full h-full pointer-events-none z-0 bg-[#06080f]"
        />
    );
};

export default DarkModeCanvas;
