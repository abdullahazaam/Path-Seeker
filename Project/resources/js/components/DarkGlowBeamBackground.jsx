import React from 'react';

/**
 * DarkGlowBeamBackground - Forceful Full-Screen Aura Beams Container (Dark Mode)
 */
export const DarkGlowBeamBackground = () => {
    return (
        <div
            id="darkGlowBeamBackground"
            className="fixed inset-0 w-full h-full pointer-events-none z-0 overflow-hidden bg-[#030508] transition-colors duration-500"
            aria-hidden="true"
        >
            {/* Left Cyan Pillar */}
            <div className="absolute -left-20 top-1/4 w-[450px] h-[650px] bg-gradient-to-tr from-[#12CFF3]/35 to-transparent rounded-full blur-[120px] pointer-events-none" />

            {/* Right Purple Pillar */}
            <div className="absolute -right-20 top-1/3 w-[500px] h-[700px] bg-gradient-to-bl from-[#7657FF]/35 to-transparent rounded-full blur-[140px] pointer-events-none" />

            {/* Center Subtle Glow */}
            <div className="absolute left-1/2 -translate-x-1/2 top-1/6 w-[600px] h-[400px] bg-[#12CFF3]/15 rounded-full blur-[150px] pointer-events-none" />
        </div>
    );
};

export default DarkGlowBeamBackground;
