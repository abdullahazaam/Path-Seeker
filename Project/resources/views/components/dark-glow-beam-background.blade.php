{{-- ══════════════════ EXACT VERTICAL GLOWING AMBIENT AURA BEAMS (DARK MODE ONLY) ══════════════════ --}}
<div id="darkGlowBeamBackground" class="fixed inset-0 z-0 pointer-events-none overflow-hidden bg-[#030508] hidden dark:block transition-colors duration-500" aria-hidden="true">

    <!-- 1. Deep Space Radial Vignette Overlay -->
    <div class="absolute inset-0 bg-radial-at-c from-transparent via-[#030508]/50 to-[#030508] pointer-events-none z-[1]"></div>

    <!-- 2. Beam 1 (Left): Width 350px, Height 100%, Electric Cyan Gradient with blur-3xl -->
    <div class="absolute top-0 bottom-0 left-[8%] sm:left-[14%] w-[350px] h-full pointer-events-none blur-3xl animate-beam-drift">
        <div class="w-full h-full bg-gradient-to-t from-[#12CFF3]/[0.28] via-[#12CFF3]/[0.16] to-transparent rounded-full"></div>
    </div>

    <!-- 3. Beam 2 (Right/Center): Width 400px, Height 100%, Soft Purple Gradient with blur-3xl -->
    <div class="absolute top-0 bottom-0 right-[8%] sm:right-[14%] w-[400px] h-full pointer-events-none blur-3xl animate-beam-drift-delayed">
        <div class="w-full h-full bg-gradient-to-t from-[#7657FF]/[0.25] via-[#7657FF]/[0.14] to-transparent rounded-full"></div>
    </div>

    <!-- 4. Beam 3 (Center subtle highlight): Narrow Bright Cyan/Purple Vertical Beam behind Hero -->
    <div class="absolute top-0 bottom-0 left-1/2 -translate-x-1/2 w-[180px] sm:w-[220px] h-full pointer-events-none blur-3xl animate-beam-drift-center">
        <div class="w-full h-full bg-gradient-to-t from-[#12CFF3]/[0.35] via-[#7657FF]/[0.20] to-transparent rounded-full"></div>
    </div>

    <!-- 5. Soft Bottom Horizon Floor Ambient Glow -->
    <div class="absolute -bottom-[15%] left-0 right-0 h-[40vh] bg-gradient-to-t from-[#12CFF3]/[0.12] via-[#7657FF]/[0.08] to-transparent blur-3xl pointer-events-none"></div>

</div>

<style>
/* ══════════════════ PRECISE 6-SECOND VERTICAL AURA BEAM BREATHING ANIMATIONS ══════════════════ */
@keyframes beamDrift {
    0%, 100% {
        opacity: 0.20;
        transform: translateY(0) scaleY(1);
    }
    50% {
        opacity: 0.40;
        transform: translateY(-20px) scaleY(1.05);
    }
}

@keyframes beamDriftDelayed {
    0%, 100% {
        opacity: 0.22;
        transform: translateY(0) scaleY(1);
    }
    50% {
        opacity: 0.38;
        transform: translateY(-25px) scaleY(1.06);
    }
}

@keyframes beamDriftCenter {
    0%, 100% {
        opacity: 0.25;
        transform: translateX(-50%) translateY(0) scaleY(1);
    }
    50% {
        opacity: 0.42;
        transform: translateX(-50%) translateY(-15px) scaleY(1.04);
    }
}

.animate-beam-drift {
    animation: beamDrift 6s ease-in-out infinite;
    will-change: opacity, transform;
}

.animate-beam-drift-delayed {
    animation: beamDriftDelayed 6s ease-in-out 1.5s infinite;
    will-change: opacity, transform;
}

.animate-beam-drift-center {
    animation: beamDriftCenter 6s ease-in-out 0.75s infinite;
    will-change: opacity, transform;
}
</style>
