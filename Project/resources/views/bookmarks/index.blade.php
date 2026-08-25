@extends('layouts.app')
@section('title', 'My Saved Bookmarks & Sticky Notes — PathSeeker')
@section('content')

{{-- Include html2pdf.js for instant client-side PDF downloads --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>

<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8 space-y-8" x-data="{
    copiedId: null,
    copyShareUrl(url, id) {
        navigator.clipboard.writeText(url).then(() => {
            this.copiedId = id;
            setTimeout(() => { this.copiedId = null; }, 2500);
        });
    },
    exportSinglePdf(elementId, title) {
        const element = document.getElementById(elementId);
        if (!element) return;
        const opt = {
            margin: 10,
            filename: 'PathSeeker-' + title.toLowerCase().replace(/[^a-z0-9]/g, '-') + '-Notes.pdf',
            image: { type: 'jpeg', quality: 0.98 },
            html2canvas: { scale: 2, useCORS: true },
            jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' }
        };
        html2pdf().set(opt).from(element).save();
    }
}">
    
    {{-- Header Banner --}}
    <div class="relative p-8 sm:p-10 rounded-3xl bg-white dark:bg-[#080B12] border border-slate-200 dark:border-white/10 shadow-2xl overflow-hidden">
        <div class="absolute -top-24 -right-24 w-72 h-72 rounded-full bg-amber-500/10 dark:bg-amber-500/15 blur-3xl pointer-events-none"></div>
        <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div class="space-y-2">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-amber-500/15 text-amber-700 dark:text-amber-300 border border-amber-500/25 text-xs font-mono font-bold">
                    <i class="fa-solid fa-note-sticky text-amber-500"></i>
                    <span>Candidate Productivity &bull; Sticky Notes &amp; PDF Export</span>
                </div>
                <h1 class="text-2xl sm:text-3xl font-black text-slate-900 dark:text-white font-display">
                    Saved Bookmarks &amp; <span class="grad-text">Sticky Notes</span>
                </h1>
                <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-400 max-w-xl">
                    Attach private revision takeaways, interview strategy notes, and export professional PDF study dossiers.
                </p>
            </div>

            <div class="flex items-center gap-3 shrink-0 flex-wrap">
                @if($bookmarks->isNotEmpty())
                    <a href="{{ route('bookmarks.export-all-pdf') }}" target="_blank" class="px-5 py-2.5 rounded-xl bg-gradient-to-r from-amber-600 to-indigo-600 hover:from-amber-500 hover:to-indigo-500 text-white font-bold text-xs shadow-md transition-all flex items-center gap-2">
                        <i class="fa-solid fa-file-pdf text-xs"></i>
                        <span>Export All Dossier (PDF)</span>
                    </a>
                @endif
                <a href="{{ route('careers.index') }}" class="px-4 py-2.5 rounded-xl bg-slate-100 dark:bg-white/5 hover:bg-slate-200 dark:hover:bg-white/10 border border-slate-200 dark:border-white/10 text-xs font-bold text-slate-700 dark:text-slate-300 transition-all flex items-center gap-1.5">
                    <i class="fa-solid fa-compass text-xs"></i>
                    <span>Explore Tracks</span>
                </a>
            </div>
        </div>
    </div>

    {{-- Bookmarks Grid --}}
    @if($bookmarks->isEmpty())
        <div class="p-12 text-center rounded-3xl bg-white dark:bg-[#080B12] border border-slate-200 dark:border-white/10 space-y-4 shadow-xl">
            <div class="w-16 h-16 rounded-3xl bg-amber-500/15 text-amber-600 dark:text-amber-400 flex items-center justify-center text-2xl mx-auto shadow-sm">
                <i class="fa-solid fa-note-sticky"></i>
            </div>
            <div class="space-y-1 max-w-md mx-auto">
                <h3 class="text-base font-black text-slate-900 dark:text-white font-display">No Saved Bookmarks Yet</h3>
                <p class="text-xs text-slate-600 dark:text-slate-400">
                    Browse verified careers, video masterclasses, or toolkits, click the bookmark icon to save them, and attach custom sticky notes for quick revision.
                </p>
            </div>
            <a href="{{ route('careers.index') }}" class="inline-flex items-center gap-2 px-6 py-3 rounded-full text-xs font-black text-white bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 hover:scale-105 transition-all shadow-md">
                <i class="fa-solid fa-compass text-[10px]"></i>
                <span>Explore Career Bank</span>
            </a>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach($bookmarks as $bm)
                @php 
                    $item = $bm->item;
                    $itemTitle = $item->title ?? 'Saved Resource';
                    $shareUrl = match($bm->item_type) {
                        'career' => $item ? route('careers.show', $item->id) : url('/careers'),
                        'multimedia' => $item ? route('multimedia.show', $item->id) : url('/multimedia'),
                        'resource' => $item ? route('resources.show', $item->id) : url('/resources'),
                        default => url('/'),
                    };
                @endphp
                <div id="bookmark-card-{{ $bm->id }}" x-data="{ 
                    editingNote: false, 
                    showShare: false,
                    noteContent: '{{ addslashes($bm->notes ?? '') }}',
                    saving: false,
                    saveNote() {
                        this.saving = true;
                        fetch('{{ route('bookmarks.update', $bm->id) }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'X-HTTP-Method-Override': 'PUT',
                                'Accept': 'application/json'
                            },
                            body: JSON.stringify({ notes: this.noteContent })
                        })
                        .then(r => r.json())
                        .then(data => {
                            this.saving = false;
                            this.editingNote = false;
                        })
                        .catch(() => {
                            this.saving = false;
                        });
                    }
                }" class="p-6 sm:p-7 rounded-3xl bg-white dark:bg-[#080B12] border border-slate-200 dark:border-white/10 shadow-xl space-y-5 flex flex-col justify-between hover:border-amber-500/30 transition-all group">
                    
                    <div class="space-y-4">
                        {{-- Top Header / Type & Removal --}}
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <span class="px-2.5 py-0.5 rounded-full text-[10px] font-black uppercase font-mono bg-purple-500/15 text-purple-700 dark:text-purple-300 border border-purple-500/25">
                                    {{ ucfirst($bm->item_type) }}
                                </span>
                                @if($item && isset($item->expected_salary))
                                    <span class="text-[10px] font-mono text-emerald-600 dark:text-emerald-400 font-bold">
                                        {{ $item->expected_salary }}
                                    </span>
                                @endif
                            </div>

                            <div class="flex items-center gap-1.5">
                                {{-- Direct PDF Export --}}
                                <a href="{{ route('bookmarks.export-pdf', $bm->id) }}" target="_blank" class="p-2 rounded-xl text-slate-400 hover:text-indigo-600 dark:hover:text-indigo-400 hover:bg-slate-100 dark:hover:bg-white/5 transition-all text-xs" title="Open Printable PDF Export">
                                    <i class="fa-solid fa-file-pdf"></i>
                                </a>

                                {{-- Share Button with Dropdown --}}
                                <div class="relative">
                                    <button @click="showShare = !showShare" class="p-2 rounded-xl text-slate-400 hover:text-amber-500 hover:bg-slate-100 dark:hover:bg-white/5 transition-all text-xs" title="Share Career Track">
                                        <i class="fa-solid fa-share-nodes"></i>
                                    </button>

                                    {{-- Share Popover --}}
                                    <div x-show="showShare" @click.outside="showShare = false" x-cloak style="display: none;" class="absolute right-0 top-8 z-30 w-48 rounded-2xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-white/10 shadow-2xl p-2 space-y-1 text-xs">
                                        <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode($shareUrl) }}" target="_blank" class="flex items-center gap-2.5 px-3 py-2 rounded-xl hover:bg-slate-100 dark:hover:bg-white/5 text-slate-700 dark:text-slate-300 transition-colors">
                                            <i class="fa-brands fa-linkedin text-[#0A66C2]"></i>
                                            <span>Share on LinkedIn</span>
                                        </a>
                                        <a href="https://twitter.com/intent/tweet?text={{ urlencode('Exploring ' . $itemTitle . ' on PathSeeker!') }}&url={{ urlencode($shareUrl) }}" target="_blank" class="flex items-center gap-2.5 px-3 py-2 rounded-xl hover:bg-slate-100 dark:hover:bg-white/5 text-slate-700 dark:text-slate-300 transition-colors">
                                            <i class="fa-brands fa-x-twitter text-slate-900 dark:text-white"></i>
                                            <span>Share on X</span>
                                        </a>
                                        <a href="https://api.whatsapp.com/send?text={{ urlencode('Check out this career track on PathSeeker: ' . $itemTitle . ' - ' . $shareUrl) }}" target="_blank" class="flex items-center gap-2.5 px-3 py-2 rounded-xl hover:bg-slate-100 dark:hover:bg-white/5 text-slate-700 dark:text-slate-300 transition-colors">
                                            <i class="fa-brands fa-whatsapp text-[#25D366]"></i>
                                            <span>Share to WhatsApp</span>
                                        </a>
                                        <a href="mailto:?subject={{ urlencode('PathSeeker Career: ' . $itemTitle) }}&body={{ urlencode('Explore this resource: ' . $shareUrl) }}" class="flex items-center gap-2.5 px-3 py-2 rounded-xl hover:bg-slate-100 dark:hover:bg-white/5 text-slate-700 dark:text-slate-300 transition-colors">
                                            <i class="fa-regular fa-envelope text-indigo-500"></i>
                                            <span>Share via Email</span>
                                        </a>
                                        <button @click="copyShareUrl('{{ $shareUrl }}', {{ $bm->id }})" class="w-full flex items-center gap-2.5 px-3 py-2 rounded-xl hover:bg-slate-100 dark:hover:bg-white/5 text-slate-700 dark:text-slate-300 transition-colors text-left">
                                            <i class="fa-solid fa-link text-amber-500"></i>
                                            <span x-text="copiedId === {{ $bm->id }} ? 'Link Copied!' : 'Copy Share Link'"></span>
                                        </button>
                                    </div>
                                </div>

                                {{-- Delete Form --}}
                                <form action="{{ route('bookmarks.destroy', $bm->id) }}" method="POST" onsubmit="return confirm('Remove this bookmark?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 rounded-xl text-slate-400 hover:text-rose-500 hover:bg-rose-500/10 transition-all text-xs" title="Remove Bookmark">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                </form>
                            </div>
                        </div>

                        {{-- Item Title & Details --}}
                        <div>
                            <h3 class="text-lg font-black text-slate-900 dark:text-white font-display leading-snug">
                                {{ $itemTitle }}
                            </h3>
                            @if($item && isset($item->domain))
                                <p class="text-xs text-slate-500 dark:text-slate-400 font-mono mt-0.5">Domain: {{ $item->domain }}</p>
                            @endif
                        </div>

                        {{-- ═══════════════ STICKY NOTE WIDGET ═══════════════ --}}
                        <div class="relative p-4 rounded-2xl bg-amber-50/90 dark:bg-amber-950/30 border border-amber-200 dark:border-amber-500/25 space-y-2 shadow-sm transition-all">
                            {{-- Sticky Note Tape / Pin Effect --}}
                            <div class="flex items-center justify-between pb-1 border-b border-amber-200/80 dark:border-amber-500/20">
                                <div class="flex items-center gap-1.5 text-[10px] font-mono font-black uppercase tracking-wider text-amber-900 dark:text-amber-300">
                                    <i class="fa-solid fa-note-sticky text-amber-600 dark:text-amber-400 text-xs"></i>
                                    <span>Sticky Study Note</span>
                                </div>
                                <button type="button" @click="editingNote = !editingNote" class="text-[10px] font-bold text-amber-700 dark:text-amber-300 hover:underline flex items-center gap-1">
                                    <i class="fa-solid fa-pencil text-[9px]"></i>
                                    <span x-text="editingNote ? 'Cancel' : (noteContent ? 'Edit Note' : 'Add Note')"></span>
                                </button>
                            </div>

                            {{-- Display View --}}
                            <div x-show="!editingNote" class="text-xs text-amber-950 dark:text-amber-100 font-sans leading-relaxed whitespace-pre-line min-h-[36px]">
                                <span x-show="noteContent" x-text="noteContent"></span>
                                <span x-show="!noteContent" class="italic text-amber-600/70 dark:text-amber-400/60">
                                    No notes yet. Click "Add Note" to write personal study goals, key equations, or interview reminders.
                                </span>
                            </div>

                            {{-- Inline Edit View --}}
                            <div x-show="editingNote" x-cloak style="display: none;" class="space-y-2 pt-1">
                                <textarea x-model="noteContent" rows="3" placeholder="Type key interview strategies, revision checkpoints, or syllabus notes..." class="w-full px-3 py-2 text-xs rounded-xl bg-white dark:bg-slate-900 border border-amber-300 dark:border-amber-500/40 text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-amber-500"></textarea>
                                <div class="flex justify-end gap-2">
                                    <button type="button" @click="editingNote = false" class="px-3 py-1 rounded-lg text-[10px] font-bold text-slate-500 hover:text-slate-800 dark:hover:text-white">Cancel</button>
                                    <button type="button" @click="saveNote()" :disabled="saving" class="px-3.5 py-1 rounded-lg text-[10px] font-bold text-white bg-amber-600 hover:bg-amber-500 shadow-sm flex items-center gap-1">
                                        <i x-show="saving" class="fa-solid fa-spinner fa-spin text-[9px]"></i>
                                        <span x-text="saving ? 'Saving...' : 'Save Sticky Note'"></span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Card Footer & Actions --}}
                    <div class="pt-4 border-t border-slate-200/80 dark:border-white/5 flex items-center justify-between gap-3">
                        <div class="flex items-center gap-2">
                            {{-- Client-side HTML2PDF Download Button --}}
                            <button type="button" @click="exportSinglePdf('bookmark-card-{{ $bm->id }}', '{{ addslashes($itemTitle) }}')" class="px-3 py-1.5 rounded-xl bg-slate-100 dark:bg-white/5 hover:bg-indigo-500/15 hover:text-indigo-600 dark:hover:text-indigo-400 border border-slate-200 dark:border-white/10 text-[11px] font-bold text-slate-700 dark:text-slate-300 transition-all flex items-center gap-1.5 shadow-xs" title="Download formatted PDF">
                                <i class="fa-solid fa-file-arrow-down text-indigo-500 text-xs"></i>
                                <span>Export PDF</span>
                            </button>
                        </div>

                        @if($item)
                            @if($bm->item_type === 'career')
                                <a href="{{ route('careers.show', $item->id) }}" class="text-xs font-bold text-indigo-600 dark:text-indigo-400 hover:underline flex items-center gap-1">
                                    <span>View Career</span> <i class="fa-solid fa-arrow-right text-[9px]"></i>
                                </a>
                            @elseif($bm->item_type === 'multimedia')
                                <a href="{{ route('multimedia.show', $item->id) }}" class="text-xs font-bold text-pink-600 dark:text-pink-400 hover:underline flex items-center gap-1">
                                    <span>Watch Video</span> <i class="fa-solid fa-arrow-right text-[9px]"></i>
                                </a>
                            @elseif($bm->item_type === 'resource')
                                <a href="{{ route('resources.show', $item->id) }}" class="text-xs font-bold text-emerald-600 dark:text-emerald-400 hover:underline flex items-center gap-1">
                                    <span>Open Toolkit</span> <i class="fa-solid fa-arrow-right text-[9px]"></i>
                                </a>
                            @endif
                        @endif
                    </div>

                </div>
            @endforeach
        </div>
    @endif

</div>

@endsection
