import React from 'react';

/**
 * DarkGlowBeamBackground - Ambient Glow Beam & Aura Background Component (Dark Mode)
 * Features:
 *  1. Deep dark space base (#030508)
 *  2. Soft vertical glowing light beams (Electric Cyan #12CFF3 and Soft Purple #7657FF)
 *  3. GPU-accelerated breathing / pulsing aura animations
 *  4. Strict background fixed layer (z-0) with zero UI interference
 */
export const DarkGlowBeamBackground = () => {
    return (
        <div
            id="darkGlowBeamBackground"
            className="fixed inset-0 z-0 pointer-events-none overflow-hidden bg-[#030508] transition-colors duration-500"
            aria-hidden="true"
        >
            {/* 1. Deep Celestial Base Radial Falloff */}
            <div className="absolute inset-0 bg-radial-at-c from-transparent via-[#030508]/60 to-[#030508] pointer-events-none z-[1]" />

            {/* 2. Ambient Horizon Base Glow (Bottom Section Mist) */}
            <div className="absolute -bottom-[20%] left-[5%] right-[5%] h-[55vh] rounded-[100%] bg-gradient-to-t from-[#12CFF3]/[0.18] via-[#7657FF]/[0.15] to-transparent blur-[140px] pointer-events-none animate-aura-horizon-pulse" />

            {/* 3. Vertical Ambient Glow Beam 1: Electric Cyan Aura */}
            <div className="absolute -bottom-[10%] left-[12%] sm:left-[18%] w-[26vw] min-w-[280px] max-w-[500px] h-[115vh] rounded-full bg-gradient-to-t from-[#12CFF3]/[0.32] via-[#00f2fe]/[0.22] to-transparent blur-[110px] sm:blur-[135px] pointer-events-none transform -rotate-[12deg] origin-bottom animate-beam-pulse-1">
                <div className="absolute inset-x-[25%] bottom-0 top-[15%] rounded-full bg-gradient-to-t from-[#12CFF3]/[0.45] via-[#38bdf8]/[0.20] to-transparent blur-[70px]" />
            </div>

            {/* 4. Vertical Ambient Glow Beam 2: Vibrant Purple Aura */}
            <div className="absolute -bottom-[12%] right-[14%] sm:right-[20%] w-[28vw] min-w-[300px] max-w-[540px] h-[120vh] rounded-full bg-gradient-to-t from-[#7657FF]/[0.30] via-[#8b5cf6]/[0.20] to-transparent blur-[115px] sm:blur-[140px] pointer-events-none transform rotate-[10deg] origin-bottom animate-beam-pulse-2">
                <div className="absolute inset-x-[25%] bottom-0 top-[12%] rounded-full bg-gradient-to-t from-[#7657FF]/[0.42] via-[#a855f7]/[0.18] to-transparent blur-[75px]" />
            </div>

            {/* 5. Vertical Ambient Glow Beam 3: Central Convergence Beam */}
            <div className="absolute -bottom-[15%] left-[42%] sm:left-[45%] w-[20vw] min-w-[220px] max-w-[420px] h-[105vh] rounded-full bg-gradient-to-t from-[#3b82f6]/[0.25] via-[#7657FF]/[0.18] to-transparent blur-[120px] pointer-events-none transform -rotate-[2deg] origin-bottom animate-beam-pulse-3">
                <div className="absolute inset-x-[20%] bottom-0 top-[20%] rounded-full bg-gradient-to-t from-[#00f2fe]/[0.28] via-[#7657FF]/[0.15] to-transparent blur-[80px]" />
            </div>

            {/* 6. Top Subtle Starlight Ambient Pool */}
            <div className="absolute -top-[15%] left-[20%] right-[20%] h-[40vh] rounded-full bg-gradient-to-b from-[#7657FF]/[0.10] via-[#12CFF3]/[0.05] to-transparent blur-[150px] pointer-events-none" />
        </div>
    );
};

export default DarkGlowBeamBackground;
