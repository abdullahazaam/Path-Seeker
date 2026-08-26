import React from 'react';

/**
 * DarkGlowBeamBackground - Exact Vertical Ambient Aura Beams Component (Dark Mode)
 * Features:
 *  1. Deep rich black background base (#030508)
 *  2. Beam 1 (Left): 350px width, 100% height, Electric Cyan (rgba(18, 207, 243, 0.28)) with blur-3xl
 *  3. Beam 2 (Right/Center): 400px width, 100% height, Soft Purple (rgba(118, 87, 255, 0.25)) with blur-3xl
 *  4. Beam 3 (Center): Narrow bright cyan/purple vertical beam behind Hero
 *  5. 6-second smooth breathing animation pulsing opacity between 0.2 and 0.4
 */
export const DarkGlowBeamBackground = () => {
    return (
        <div
            id="darkGlowBeamBackground"
            className="fixed inset-0 z-0 pointer-events-none overflow-hidden bg-[#030508] transition-colors duration-500"
            aria-hidden="true"
        >
            {/* 1. Deep Space Radial Vignette Overlay */}
            <div className="absolute inset-0 bg-radial-at-c from-transparent via-[#030508]/50 to-[#030508] pointer-events-none z-[1]" />

            {/* 2. Beam 1 (Left): Width 350px, Height 100%, Electric Cyan Gradient with blur-3xl */}
            <div className="absolute top-0 bottom-0 left-[8%] sm:left-[14%] w-[350px] h-full pointer-events-none blur-3xl animate-beam-drift">
                <div className="w-full h-full bg-gradient-to-t from-[#12CFF3]/[0.28] via-[#12CFF3]/[0.16] to-transparent rounded-full" />
            </div>

            {/* 3. Beam 2 (Right/Center): Width 400px, Height 100%, Soft Purple Gradient with blur-3xl */}
            <div className="absolute top-0 bottom-0 right-[8%] sm:right-[14%] w-[400px] h-full pointer-events-none blur-3xl animate-beam-drift-delayed">
                <div className="w-full h-full bg-gradient-to-t from-[#7657FF]/[0.25] via-[#7657FF]/[0.14] to-transparent rounded-full" />
            </div>

            {/* 4. Beam 3 (Center subtle highlight): Narrow Bright Cyan/Purple Vertical Beam behind Hero */}
            <div className="absolute top-0 bottom-0 left-1/2 -translate-x-1/2 w-[180px] sm:w-[220px] h-full pointer-events-none blur-3xl animate-beam-drift-center">
                <div className="w-full h-full bg-gradient-to-t from-[#12CFF3]/[0.35] via-[#7657FF]/[0.20] to-transparent rounded-full" />
            </div>

            {/* 5. Soft Bottom Horizon Floor Ambient Glow */}
            <div className="absolute -bottom-[15%] left-0 right-0 h-[40vh] bg-gradient-to-t from-[#12CFF3]/[0.12] via-[#7657FF]/[0.08] to-transparent blur-3xl pointer-events-none" />
        </div>
    );
};

export default DarkGlowBeamBackground;
