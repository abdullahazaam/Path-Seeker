<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PathSeeker Career Blueprint &amp; Study Notes — {{ $item->title ?? 'Saved Resource' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        @media print {
            body { -webkit-print-color-adjust: exact; print-color-adjust: exact; background: #fff !important; color: #000 !important; }
            .no-print { display: none !important; }
            .page-break { page-break-after: always; }
        }
    </style>
</head>
<body class="bg-slate-50 text-slate-800 antialiased p-6 sm:p-10 max-w-4xl mx-auto">
    
    {{-- Print & Download Action Bar --}}
    <div class="no-print mb-8 p-4 rounded-2xl bg-gradient-to-r from-purple-50 via-indigo-50 to-pink-50 border border-purple-200 flex flex-wrap items-center justify-between gap-4 shadow-sm">
        <div class="flex items-center gap-2 text-xs text-purple-900 font-semibold">
            <i class="fa-solid fa-file-pdf text-rose-500 text-base"></i>
            <span>Verified Study Blueprint &amp; Sticky Note Document Ready for Export</span>
        </div>
        <div class="flex items-center gap-2">
            <button onclick="downloadAsPdf()" class="px-4 py-2 rounded-xl text-xs font-bold text-white bg-indigo-600 hover:bg-indigo-500 shadow transition-all cursor-pointer flex items-center gap-1.5">
                <i class="fa-solid fa-download text-xs"></i>
                <span>Download PDF</span>
            </button>
            <button onclick="window.print()" class="px-4 py-2 rounded-xl text-xs font-bold text-slate-700 bg-white hover:bg-slate-100 border border-slate-300 shadow-sm transition-all cursor-pointer flex items-center gap-1.5">
                <i class="fa-solid fa-print text-xs"></i>
                <span>Print</span>
            </button>
        </div>
    </div>

    <div id="pdfContent" class="space-y-8 bg-white p-8 sm:p-12 rounded-3xl border border-slate-200 shadow-sm">
        
        {{-- Document Header --}}
        <div class="border-b-2 border-slate-900 pb-6 flex justify-between items-start gap-4">
            <div class="space-y-1">
                <div class="text-[11px] font-black uppercase tracking-wider text-purple-600 font-mono">
                    PATHSEEKER &bull; CAREER BLUEPRINT &amp; PRIVATE STUDY DOSSIER
                </div>
                <h1 class="text-2xl sm:text-3xl font-black text-slate-900 font-serif">
                    {{ $item->title ?? 'Saved Resource' }}
                </h1>
                <p class="text-xs text-slate-600 font-medium">
                    Scholar: <strong class="text-slate-900">{{ $user->name }}</strong> ({{ $user->email }}) &bull; Role: {{ ucfirst($user->role) }}
                </p>
            </div>
            <div class="text-right text-[11px] text-slate-500 font-mono space-y-1 shrink-0">
                <div>Exported: {{ now()->format('M d, Y · h:i A') }}</div>
                <div>Category: <span class="uppercase font-bold text-purple-700">{{ $bookmark->item_type }}</span></div>
            </div>
        </div>

        {{-- Core Details Overview --}}
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <div class="p-4 rounded-xl border border-slate-200 bg-slate-50 space-y-1">
                <div class="text-[10px] uppercase font-bold text-slate-500 font-mono">Domain / Category</div>
                <div class="text-sm font-black text-slate-900">{{ $item->domain ?? ($item->category ?? 'Technology Track') }}</div>
            </div>
            <div class="p-4 rounded-xl border border-slate-200 bg-slate-50 space-y-1">
                <div class="text-[10px] uppercase font-bold text-slate-500 font-mono">Benchmark / Telemetry</div>
                <div class="text-sm font-black text-emerald-600">{{ $item->expected_salary ?? ($item->duration ? $item->duration . ' Masterclass' : 'Curated Toolkit') }}</div>
            </div>
            <div class="p-4 rounded-xl border border-slate-200 bg-slate-50 space-y-1">
                <div class="text-[10px] uppercase font-bold text-slate-500 font-mono">Status &amp; Verification</div>
                <div class="text-sm font-black text-indigo-600">Saved in Passport</div>
            </div>
        </div>

        {{-- Item Description / Skills --}}
        @if($item && ($item->description || $item->required_skills))
            <div class="p-6 rounded-2xl border border-slate-200 bg-slate-50/70 space-y-3">
                <h3 class="text-xs font-black uppercase tracking-wider font-mono text-slate-700">Blueprint Overview &amp; Requirements</h3>
                @if($item->description)
                    <p class="text-xs sm:text-sm text-slate-700 leading-relaxed">{{ $item->description }}</p>
                @endif
                @if($item->required_skills)
                    <div class="pt-2 border-t border-slate-200">
                        <span class="text-[10px] font-mono font-bold text-slate-500 uppercase">Core Skills:</span>
                        <p class="text-xs text-indigo-700 font-mono font-semibold mt-0.5">{{ $item->required_skills }}</p>
                    </div>
                @endif
            </div>
        @endif

        {{-- USER ATTACHED STICKY NOTES SECTION --}}
        <div class="p-6 rounded-2xl bg-amber-50 border-2 border-dashed border-amber-300 space-y-3">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-2 text-xs font-black uppercase tracking-wider font-mono text-amber-900">
                    <i class="fa-solid fa-note-sticky text-amber-600 text-sm"></i>
                    <span>Candidate Sticky Notes &amp; Action Plan</span>
                </div>
                <span class="text-[10px] font-mono text-amber-700 font-semibold">Attached to Bookmark #{{ $bookmark->id }}</span>
            </div>

            <div class="p-4 rounded-xl bg-white/90 border border-amber-200 text-xs sm:text-sm text-amber-950 font-sans leading-relaxed whitespace-pre-line shadow-xs">
                @if(!empty($bookmark->notes))
                    {{ $bookmark->notes }}
                @else
                    <span class="italic text-amber-600">No private notes attached yet. User can add customized study takeaways, interview prep goals, and milestone checklists from the dashboard.</span>
                @endif
            </div>
        </div>

        {{-- Official Security Footer --}}
        <div class="pt-8 border-t border-slate-200 text-center space-y-1 text-[11px] text-slate-500">
            <p class="font-semibold text-slate-700">PathSeeker Career Intelligence Engine &bull; Personal Study Export</p>
            <p class="font-mono text-[9px] text-slate-400">Verification Token: {{ hash('sha256', $user->id . '-' . $bookmark->id . '-' . now()->toDateString()) }}</p>
        </div>

    </div>

    <script>
        function downloadAsPdf() {
            const element = document.getElementById('pdfContent');
            const opt = {
                margin:       10,
                filename:     'PathSeeker-{{ \Illuminate\Support\Str::slug($item->title ?? 'Bookmark') }}-Notes.pdf',
                image:        { type: 'jpeg', quality: 0.98 },
                html2canvas:  { scale: 2, useCORS: true },
                jsPDF:        { unit: 'mm', format: 'a4', orientation: 'portrait' }
            };
            html2pdf().set(opt).from(element).save();
        }
    </script>
</body>
</html>
