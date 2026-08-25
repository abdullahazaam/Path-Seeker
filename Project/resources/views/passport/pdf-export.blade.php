<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PathSeeker Official Career Passport — {{ $exportData['candidate_name'] }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @media print {
            body { -webkit-print-color-adjust: exact; print-color-adjust: exact; background: #fff !important; color: #000 !important; }
            .no-print { display: none !important; }
            .page-break { page-break-after: always; }
        }
    </style>
</head>
<body class="bg-slate-50 text-slate-800 antialiased p-8 max-w-4xl mx-auto">
    
    {{-- Print Action Bar --}}
    <div class="no-print mb-8 p-4 rounded-2xl bg-indigo-50 border border-indigo-200 flex items-center justify-between">
        <div class="text-xs text-indigo-900 font-semibold">
            <span>Official Verified PDF Document Ready for Print / Save as PDF.</span>
        </div>
        <button onclick="window.print()" class="px-5 py-2 rounded-xl text-xs font-bold text-white bg-indigo-600 hover:bg-indigo-500 shadow cursor-pointer">
            Print / Save as PDF
        </button>
    </div>

    {{-- Passport Header --}}
    <div class="border-b-2 border-slate-900 pb-6 mb-8 flex justify-between items-start">
        <div class="space-y-1">
            <div class="text-xs font-black uppercase tracking-widest text-indigo-600 font-mono">PATHSEEKER &bull; VERIFIED CAREER PASSPORT</div>
            <h1 class="text-3xl font-black text-slate-900 font-serif">{{ $exportData['candidate_name'] }}</h1>
            <p class="text-sm text-slate-600">{{ $exportData['role'] }} &bull; {{ $exportData['education_level'] }}</p>
        </div>
        <div class="text-right text-xs text-slate-500 font-mono space-y-1">
            <div>Generated: {{ $exportData['generated_at'] }}</div>
            <div>Doc ID: {{ substr($exportData['verification_hash'], 0, 16) }}</div>
        </div>
    </div>

    {{-- Assessment Summary --}}
    <div class="space-y-6">
        <div class="grid grid-cols-3 gap-4">
            <div class="p-4 rounded-xl border border-slate-300 bg-white space-y-1">
                <div class="text-[10px] uppercase font-bold text-slate-500 font-mono">Top Technology Domain</div>
                <div class="text-lg font-black text-slate-900">{{ $exportData['top_domain'] }}</div>
            </div>
            <div class="p-4 rounded-xl border border-slate-300 bg-white space-y-1">
                <div class="text-[10px] uppercase font-bold text-slate-500 font-mono">Assessment Alignment Score</div>
                <div class="text-lg font-black text-indigo-600">{{ $exportData['assessment_score'] }} Pts</div>
            </div>
            <div class="p-4 rounded-xl border border-slate-300 bg-white space-y-1">
                <div class="text-[10px] uppercase font-bold text-slate-500 font-mono">Audit Benchmark Version</div>
                <div class="text-lg font-black text-slate-900">{{ $exportData['quiz_version'] }}</div>
            </div>
        </div>

        {{-- Domain Affinity Breakdown --}}
        <div class="p-6 rounded-xl border border-slate-300 bg-white space-y-3">
            <h3 class="text-xs font-black uppercase tracking-wider font-mono text-slate-700">Domain Competency Distribution</h3>
            <div class="grid grid-cols-2 gap-3 text-xs">
                @foreach($exportData['domain_scores'] as $domain => $score)
                    <div class="p-2 border border-slate-200 rounded-lg flex justify-between items-center">
                        <span class="font-semibold text-slate-700">{{ $domain }}</span>
                        <span class="font-mono font-bold text-indigo-600">{{ $score }}%</span>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Recommended Career Tracks --}}
        @if(!empty($exportData['recommended_careers']))
            <div class="space-y-3">
                <h3 class="text-xs font-black uppercase tracking-wider font-mono text-slate-700">Recommended Career Tracks</h3>
                <div class="space-y-2">
                    @foreach($exportData['recommended_careers'] as $rec)
                        <div class="p-4 rounded-xl border border-slate-300 bg-white flex justify-between items-center">
                            <div>
                                <h4 class="text-sm font-bold text-slate-900">{{ $rec['title'] ?? 'Career Track' }}</h4>
                                <p class="text-xs text-slate-500 font-mono">{{ $rec['domain'] ?? $exportData['top_domain'] }} &bull; {{ $rec['expected_salary'] ?? 'Competitive Tech Benchmark' }}</p>
                            </div>
                            <span class="text-xs font-mono font-bold text-emerald-700 bg-emerald-50 border border-emerald-200 px-2.5 py-1 rounded-lg">
                                {{ $rec['match_percentage'] ?? 92 }}% Match
                            </span>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        {{-- Official Security Footer --}}
        <div class="pt-8 border-t border-slate-300 text-center space-y-1 text-[11px] text-slate-500">
            <p class="font-semibold text-slate-700">Verified PathSeeker Full-Stack Career Intelligence Engine &bull; 2026 Edition</p>
            <p class="font-mono text-[9px] text-slate-400">Security Verification Hash: {{ $exportData['verification_hash'] }}</p>
        </div>
    </div>

</body>
</html>
