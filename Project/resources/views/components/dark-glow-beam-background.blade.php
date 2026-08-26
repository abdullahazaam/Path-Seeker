{{-- ══════════════════ DEDICATED DARK MODE AMBIENT GLOW BEAM & AURA BACKGROUND ══════════════════ --}}
{{-- Ultra-High-End Atmospheric Light Beams with GPU-Accelerated Breathing Pulsations --}}
<div id="darkGlowBeamBackground" class="fixed inset-0 z-0 pointer-events-none overflow-hidden bg-[#030508] hidden dark:block transition-colors duration-500" aria-hidden="true">

    <!-- 1. Deep Celestial Base Radial Falloff -->
    <div class="absolute inset-0 bg-radial-at-c from-transparent via-[#030508]/60 to-[#030508] pointer-events-none z-[1]"></div>

    <!-- 2. Ambient Horizon Base Glow (Bottom Section Ambient Mist) -->
    <div class="absolute -bottom-[20%] left-[5%] right-[5%] h-[55vh] rounded-[100%] bg-gradient-to-t from-[#12CFF3]/[0.18] via-[#7657FF]/[0.15] to-transparent blur-[140px] pointer-events-none animate-aura-horizon-pulse"></div>

    <!-- 3. Vertical Ambient Glow Beam 1: Electric Cyan Aura (Left-Mid, Rising Vertically) -->
    <div class="absolute -bottom-[10%] left-[12%] sm:left-[18%] w-[26vw] min-w-[280px] max-w-[500px] h-[115vh] rounded-full bg-gradient-to-t from-[#12CFF3]/[0.32] via-[#00f2fe]/[0.22] to-transparent blur-[110px] sm:blur-[135px] pointer-events-none transform -rotate-[12deg] origin-bottom animate-beam-pulse-1">
        <!-- Inner Intense Core Light Shaft -->
        <div class="absolute inset-x-[25%] bottom-0 top-[15%] rounded-full bg-gradient-to-t from-[#12CFF3]/[0.45] via-[#38bdf8]/[0.20] to-transparent blur-[70px]"></div>
    </div>

    <!-- 4. Vertical Ambient Glow Beam 2: Vibrant Purple Aura (Right-Mid, Rising Vertically) -->
    <div class="absolute -bottom-[12%] right-[14%] sm:right-[20%] w-[28vw] min-w-[300px] max-w-[540px] h-[120vh] rounded-full bg-gradient-to-t from-[#7657FF]/[0.30] via-[#8b5cf6]/[0.20] to-transparent blur-[115px] sm:blur-[140px] pointer-events-none transform rotate-[10deg] origin-bottom animate-beam-pulse-2">
        <!-- Inner Intense Core Light Shaft -->
        <div class="absolute inset-x-[25%] bottom-0 top-[12%] rounded-full bg-gradient-to-t from-[#7657FF]/[0.42] via-[#a855f7]/[0.18] to-transparent blur-[75px]"></div>
    </div>

    <!-- 5. Vertical Ambient Glow Beam 3: Central Deep Cyan-Purple Convergence Beam -->
    <div class="absolute -bottom-[15%] left-[42%] sm:left-[45%] w-[20vw] min-w-[220px] max-w-[420px] h-[105vh] rounded-full bg-gradient-to-t from-[#3b82f6]/[0.25] via-[#7657FF]/[0.18] to-transparent blur-[120px] pointer-events-none transform -rotate-[2deg] origin-bottom animate-beam-pulse-3">
        <!-- Soft Top Crest Diffuse -->
        <div class="absolute inset-x-[20%] bottom-0 top-[20%] rounded-full bg-gradient-to-t from-[#00f2fe]/[0.28] via-[#7657FF]/[0.15] to-transparent blur-[80px]"></div>
    </div>

    <!-- 6. Top Subtle Starlight Ambient Pool -->
    <div class="absolute -top-[15%] left-[20%] right-[20%] h-[40vh] rounded-full bg-gradient-to-b from-[#7657FF]/[0.10] via-[#12CFF3]/[0.05] to-transparent blur-[150px] pointer-events-none"></div>

</div>

<style>
/* ══════════════════ AMBIENT GLOW BEAM & AURA PULSATION ANIMATIONS (60FPS GPU) ══════════════════ */
@keyframes beamPulse1 {
    0%, 100% {
        transform: rotate(-12deg) scaleY(1) scaleX(1) translateY(0);
        opacity: 0.85;
    }
    50% {
        transform: rotate(-10deg) scaleY(1.08) scaleX(1.12) translateY(-25px);
        opacity: 1.0;
    }
}

@keyframes beamPulse2 {
    0%, 100% {
        transform: rotate(10deg) scaleY(1) scaleX(1) translateY(0);
        opacity: 0.80;
    }
    50% {
        transform: rotate(8deg) scaleY(1.10) scaleX(1.15) translateY(-30px);
        opacity: 1.0;
    }
}

@keyframes beamPulse3 {
    0%, 100% {
        transform: rotate(-2deg) scaleY(1) scaleX(1) translateY(0);
        opacity: 0.75;
    }
    50% {
        transform: rotate(1deg) scaleY(1.06) scaleX(1.08) translateY(-20px);
        opacity: 0.95;
    }
}

@keyframes auraHorizonPulse {
    0%, 100% {
        transform: scaleY(1) translateY(0);
        opacity: 0.80;
    }
    50% {
        transform: scaleY(1.15) translateY(-15px);
        opacity: 1.0;
    }
}

.animate-beam-pulse-1 {
    animation: beamPulse1 12s cubic-bezier(0.4, 0, 0.2, 1) infinite;
    will-change: transform, opacity;
}

.animate-beam-pulse-2 {
    animation: beamPulse2 15s cubic-bezier(0.4, 0, 0.2, 1) infinite;
    will-change: transform, opacity;
}

.animate-beam-pulse-3 {
    animation: beamPulse3 18s cubic-bezier(0.4, 0, 0.2, 1) infinite;
    will-change: transform, opacity;
}

.animate-aura-horizon-pulse {
    animation: auraHorizonPulse 14s cubic-bezier(0.4, 0, 0.2, 1) infinite;
    will-change: transform, opacity;
}
</style>
