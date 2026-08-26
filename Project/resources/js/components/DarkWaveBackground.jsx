import React, { useEffect, useRef } from 'react';

/**
 * DarkWaveBackground - High-Performance 3D Fluid / Silk Wave Component (Dark Mode)
 * Features:
 *  1. Smooth, undulating dark liquid / flowing silk waves across the mid and lower viewport
 *  2. Rich dark bodies (#070b16, #0c1024, #0f1530) with soft rim highlights in Cyan (#12CFF3) and Purple (#7657FF)
 *  3. GPU-accelerated 60FPS canvas loop with harmonic multi-sine drift
 *  4. Strict background layering (position: fixed; inset: 0; z-index: 0; pointer-events: none;)
 */
export const DarkWaveBackground = () => {
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

        const waves = [
            {
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

        const draw = (now) => {
            if (!lastTime) lastTime = now;
            const dt = Math.min((now - lastTime) / 1000, 0.1);
            lastTime = now;
            time += dt;

            ctx.fillStyle = '#04060b';
            ctx.fillRect(0, 0, width, height);

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

            const step = Math.max(8, Math.floor(width / 120));

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
            id="darkWaveCanvas"
            className="fixed inset-0 w-full h-full pointer-events-none z-0 bg-[#04060b]"
        />
    );
};

export default DarkWaveBackground;
