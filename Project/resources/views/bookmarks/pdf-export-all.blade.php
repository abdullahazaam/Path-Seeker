<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PathSeeker Master Bookmarks &amp; Study Notes — {{ $user->name }}</title>
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
            <i class="fa-solid fa-book-bookmark text-indigo-600 text-base"></i>
            <span>Complete Candidate Bookmarks Dossier ({{ count($bookmarks) }} Items) Ready for Export</span>
        </div>
        <div class="flex items-center gap-2">
            <button onclick="downloadAllAsPdf()" class="px-4 py-2 rounded-xl text-xs font-bold text-white bg-indigo-600 hover:bg-indigo-500 shadow transition-all cursor-pointer flex items-center gap-1.5">
                <i class="fa-solid fa-download text-xs"></i>
                <span>Download Master PDF</span>
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
                    PATHSEEKER &bull; OFFICIAL CAREER STUDY DOSSIER &amp; STICKY NOTES
                </div>
                <h1 class="text-2xl sm:text-3xl font-black text-slate-900 font-serif">
                    {{ $user->name }} &bull; Saved Library
                </h1>
                <p class="text-xs text-slate-600 font-medium">
                    Email: {{ $user->email }} &bull; Role: {{ ucfirst($user->role) }} &bull; Total Items: {{ count($bookmarks) }}
                </p>
            </div>
            <div class="text-right text-[11px] text-slate-500 font-mono space-y-1 shrink-0">
                <div>Exported: {{ now()->format('M d, Y · h:i A') }}</div>
                <div>Format: Verified PDF Export</div>
            </div>
        </div>

        {{-- Bookmarks Listing --}}
        <div class="space-y-6">
            @forelse($bookmarks as $index => $bm)
                @php $item = $bm->item; @endphp
                <div class="p-6 rounded-2xl border border-slate-200 bg-slate-50/70 space-y-4">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <span class="w-6 h-6 rounded-lg bg-indigo-600 text-white font-mono font-bold text-xs flex items-center justify-center">
                                {{ $index + 1 }}
                            </span>
                            <span class="px-2.5 py-0.5 rounded-full text-[10px] font-mono font-black uppercase bg-purple-500/15 text-purple-800 border border-purple-300">
                                {{ $bm->item_type }}
                            </span>
                        </div>
                        <span class="text-xs font-mono text-emerald-700 font-bold">
                            {{ $item->expected_salary ?? ($item->category ?? 'Resource Blueprint') }}
                        </span>
                    </div>

                    <div>
                        <h3 class="text-base font-bold text-slate-900 font-display">
                            {{ $item->title ?? 'Saved Resource' }}
                        </h3>
                        @if($item && $item->description)
                            <p class="text-xs text-slate-600 mt-1 leading-relaxed">{{ $item->description }}</p>
                        @endif
                    </div>

                    {{-- Sticky Note Block --}}
                    <div class="p-4 rounded-xl bg-amber-50 border border-amber-300 space-y-1.5">
                        <div class="flex items-center gap-1.5 text-[10px] font-mono font-bold uppercase text-amber-900">
                            <i class="fa-solid fa-note-sticky text-amber-600"></i>
                            <span>Attached Sticky Note</span>
                        </div>
                        <p class="text-xs text-amber-950 whitespace-pre-line leading-relaxed">
                            {{ $bm->notes ?: 'No specific notes recorded for this item.' }}
                        </p>
                    </div>
                </div>
            @empty
                <div class="py-10 text-center text-xs text-slate-500">No bookmarks found in candidate profile.</div>
            @endforelse
        </div>

        {{-- Official Security Footer --}}
        <div class="pt-8 border-t border-slate-200 text-center space-y-1 text-[11px] text-slate-500">
            <p class="font-semibold text-slate-700">PathSeeker Career Intelligence Engine &bull; Personal Study Dossier</p>
            <p class="font-mono text-[9px] text-slate-400">Security Hash: {{ hash('sha256', $user->id . '-' . count($bookmarks) . '-' . now()->toDateString()) }}</p>
        </div>

    </div>

    <script>
        function downloadAllAsPdf() {
            const element = document.getElementById('pdfContent');
            const opt = {
                margin:       10,
                filename:     'PathSeeker-{{ \Illuminate\Support\Str::slug($user->name) }}-Bookmarks-Dossier.pdf',
                image:        { type: 'jpeg', quality: 0.98 },
                html2canvas:  { scale: 2, useCORS: true },
                jsPDF:        { unit: 'mm', format: 'a4', orientation: 'portrait' }
            };
            html2pdf().set(opt).from(element).save();
        }
    </script>
</body>
</html>
