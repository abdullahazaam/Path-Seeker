import React, { useEffect, useRef } from 'react';

/**
 * DarkModeCanvas - Subtle, Atmospheric HTML5 Canvas Ambient Background
 * Features:
 *  1. Faint Digital Rain (#7657FF & #12CFF3) with reduced opacity (10-20%) and thickness (0.8-1.2px)
 *  2. Delicate, Tiny Floating Bubbles (3.5-10px radius) widely dispersed across the entire viewport (max 10-14% opacity)
 *  3. Removed bottom wave grid for maximum UI clarity and focus
 *  4. Atmospheric deep base trailing with ctx.fillStyle = 'rgba(6, 8, 15, 0.28)'
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

        // ── 1. Subtle Digital Rain System ──
        const RAIN_COUNT = 45;
        const rainDrops = [];
        for (let i = 0; i < RAIN_COUNT; i++) {
            const isCyan = Math.random() > 0.45;
            rainDrops.push({
                x: Math.random() * width,
                y: Math.random() * height * 1.5 - height * 0.5,
                speed: 3.2 + Math.random() * 4.5,
                length: 35 + Math.random() * 65,
                width: 0.8 + Math.random() * 0.4,
                r: isCyan ? 18 : 118,
                g: isCyan ? 207 : 87,
                b: isCyan ? 243 : 255,
                alpha: 0.10 + Math.random() * 0.12
            });
        }

        // ── 2. Delicate Micro Floating Bubbles System ──
        const BUBBLE_COUNT = 24;
        const bubbles = [];
        for (let i = 0; i < BUBBLE_COUNT; i++) {
            const isCyan = Math.random() > 0.45;
            bubbles.push({
                baseX: Math.random() * width,
                x: 0,
                y: Math.random() * height,
                radius: 3.5 + Math.random() * 6.5,
                vy: -(0.25 + Math.random() * 0.55),
                driftFreq: 0.001 + Math.random() * 0.0018,
                driftAmp: 12 + Math.random() * 22,
                driftPhase: Math.random() * Math.PI * 2,
                r: isCyan ? 18 : 118,
                g: isCyan ? 207 : 87,
                b: isCyan ? 243 : 255,
                alpha: 0.08 + Math.random() * 0.06
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

        // ── 60FPS Ambient Draw Loop ──
        const draw = (now) => {
            if (!lastTime) lastTime = now;
            const dt = Math.min((now - lastTime) / 1000, 0.1);
            lastTime = now;
            time += dt;

            // 1. Semi-transparent Deep Base (#06080f)
            ctx.fillStyle = 'rgba(6, 8, 15, 0.28)';
            ctx.fillRect(0, 0, width, height);

            // 2. Faint Ambient Deep Space Light Pools
            const radialGrad1 = ctx.createRadialGradient(width * 0.2, height * 0.25, 10, width * 0.2, height * 0.25, width * 0.5);
            radialGrad1.addColorStop(0, 'rgba(118, 87, 255, 0.035)');
            radialGrad1.addColorStop(1, 'rgba(6, 8, 15, 0)');
            ctx.fillStyle = radialGrad1;
            ctx.fillRect(0, 0, width, height);

            const radialGrad2 = ctx.createRadialGradient(width * 0.8, height * 0.7, 10, width * 0.8, height * 0.7, width * 0.55);
            radialGrad2.addColorStop(0, 'rgba(18, 207, 243, 0.028)');
            radialGrad2.addColorStop(1, 'rgba(6, 8, 15, 0)');
            ctx.fillStyle = radialGrad2;
            ctx.fillRect(0, 0, width, height);

            // ── 3. Render Subtle Digital Rain ──
            for (let i = 0; i < rainDrops.length; i++) {
                const drop = rainDrops[i];
                drop.y += drop.speed * (dt * 60);

                if (drop.y - drop.length > height) {
                    drop.y = -drop.length - Math.random() * 50;
                    drop.x = Math.random() * width;
                    drop.speed = 3.2 + Math.random() * 4.5;
                    drop.length = 35 + Math.random() * 65;
                }

                const startY = Math.max(0, drop.y - drop.length);
                const endY = drop.y;

                if (endY > 0 && startY < height) {
                    const grad = ctx.createLinearGradient(drop.x, startY, drop.x, endY);
                    grad.addColorStop(0, `rgba(${drop.r}, ${drop.g}, ${drop.b}, 0)`);
                    grad.addColorStop(0.8, `rgba(${drop.r}, ${drop.g}, ${drop.b}, ${drop.alpha * 0.45})`);
                    grad.addColorStop(1, `rgba(${drop.r}, ${drop.g}, ${drop.b}, ${drop.alpha})`);

                    ctx.strokeStyle = grad;
                    ctx.lineWidth = drop.width;
                    ctx.beginPath();
                    ctx.moveTo(drop.x, startY);
                    ctx.lineTo(drop.x, endY);
                    ctx.stroke();

                    // Faint head tip
                    ctx.fillStyle = `rgba(${drop.r}, ${drop.g}, ${drop.b}, ${drop.alpha * 1.3})`;
                    ctx.beginPath();
                    ctx.arc(drop.x, endY, drop.width * 0.9, 0, Math.PI * 2);
                    ctx.fill();
                }
            }

            // ── 4. Render Widely Dispersed Tiny Floating Bubbles ──
            for (let i = 0; i < bubbles.length; i++) {
                const b = bubbles[i];
                b.y += b.vy * (dt * 60);
                b.x = b.baseX + Math.sin(time * 1000 * b.driftFreq + b.driftPhase) * b.driftAmp;

                if (b.y < -b.radius * 2) {
                    b.y = height + b.radius * 2;
                    b.baseX = Math.random() * width;
                    b.radius = 3.5 + Math.random() * 6.5;
                }

                const r = b.radius;
                const bx = b.x;
                const by = b.y;

                // Subtle Glass Radial Sheen (Max 10-14% opacity)
                const bubbleGrad = ctx.createRadialGradient(
                    bx - r * 0.25, by - r * 0.25, r * 0.1,
                    bx, by, r
                );
                bubbleGrad.addColorStop(0, `rgba(255, 255, 255, ${b.alpha * 0.5})`);
                bubbleGrad.addColorStop(0.6, `rgba(${b.r}, ${b.g}, ${b.b}, ${b.alpha * 0.2})`);
                bubbleGrad.addColorStop(1, `rgba(${b.r}, ${b.g}, ${b.b}, ${b.alpha})`);

                ctx.fillStyle = bubbleGrad;
                ctx.beginPath();
                ctx.arc(bx, by, r, 0, Math.PI * 2);
                ctx.fill();

                // Delicate Crisp Stroke (Max 12% opacity)
                ctx.strokeStyle = `rgba(${b.r}, ${b.g}, ${b.b}, ${b.alpha * 1.1})`;
                ctx.lineWidth = 0.8;
                ctx.stroke();

                // Micro Specular Glint
                const glintGrad = ctx.createRadialGradient(
                    bx - r * 0.3, by - r * 0.3, 0.5,
                    bx - r * 0.3, by - r * 0.3, r * 0.4
                );
                glintGrad.addColorStop(0, `rgba(255, 255, 255, ${b.alpha * 1.2})`);
                glintGrad.addColorStop(1, 'rgba(255, 255, 255, 0)');

                ctx.fillStyle = glintGrad;
                ctx.beginPath();
                ctx.arc(bx - r * 0.25, by - r * 0.25, r * 0.3, 0, Math.PI * 2);
                ctx.fill();
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
