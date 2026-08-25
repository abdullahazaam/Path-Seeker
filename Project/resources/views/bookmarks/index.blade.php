@extends('layouts.app')
@section('title', 'My Saved Bookmarks & Notes — PathSeeker')
@section('content')

<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8 space-y-8">
    
    {{-- Header Banner --}}
    <div class="p-8 sm:p-10 rounded-3xl bg-white/90 dark:bg-slate-900/60 backdrop-blur-2xl border border-slate-200/80 dark:border-white/10 shadow-2xl space-y-2">
        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-indigo-500/10 text-indigo-700 dark:text-indigo-300 border border-indigo-500/20 text-xs font-mono font-bold">
            <i class="fa-solid fa-bookmark text-indigo-500"></i>
            <span>User Productivity &bull; Personal Study Space</span>
        </div>
        <h1 class="text-2xl sm:text-3xl font-black text-slate-900 dark:text-white font-display">My Bookmarks &amp; Private Notes</h1>
        <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-400">
            Organize career tracks, masterclasses, and toolkits with private revision notes.
        </p>
    </div>

    {{-- Bookmarks Grid --}}
    @if($bookmarks->isEmpty())
        <div class="p-12 text-center rounded-3xl bg-slate-100/60 dark:bg-slate-950/40 border border-slate-200/80 dark:border-white/5 space-y-3">
            <div class="w-12 h-12 rounded-2xl bg-slate-200 dark:bg-white/10 text-slate-500 flex items-center justify-center text-xl mx-auto">
                <i class="fa-regular fa-bookmark"></i>
            </div>
            <h3 class="text-sm font-black text-slate-900 dark:text-white font-display">No Saved Bookmarks Yet</h3>
            <p class="text-xs text-slate-500 max-w-sm mx-auto">Browse careers, videos, or toolkits and click the bookmark icon to save items with private notes.</p>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach($bookmarks as $bm)
                @php $item = $bm->item; @endphp
                <div class="p-6 rounded-3xl bg-white/90 dark:bg-slate-900/60 border border-slate-200/80 dark:border-white/10 shadow-xl space-y-4 flex flex-col justify-between">
                    <div class="space-y-3">
                        <div class="flex items-center justify-between">
                            <span class="px-2.5 py-0.5 rounded-full text-[10px] font-black uppercase font-mono bg-purple-500/15 text-purple-700 dark:text-purple-300 border border-purple-500/25">
                                {{ ucfirst($bm->item_type) }}
                            </span>
                            <form action="{{ route('bookmarks.destroy', $bm->id) }}" method="POST" onsubmit="return confirm('Remove this bookmark?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-slate-400 hover:text-rose-500 text-xs transition-colors p-1" title="Delete Bookmark">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>
                            </form>
                        </div>

                        <h3 class="text-base font-black text-slate-900 dark:text-white font-display">
                            {{ $item->title ?? 'Saved Resource' }}
                        </h3>

                        {{-- Editable Private Notes --}}
                        <form action="{{ route('bookmarks.update', $bm->id) }}" method="POST" class="space-y-2">
                            @csrf
                            @method('PUT')
                            <label class="block text-[10px] font-black uppercase tracking-wider text-slate-400 font-mono">Private Study Note</label>
                            <textarea name="notes" rows="2" placeholder="Add your private revision note or key takeaway..." class="w-full px-3 py-2 text-xs rounded-xl bg-slate-100 dark:bg-slate-950 border border-slate-300 dark:border-white/10 text-slate-900 dark:text-white focus:ring-2 focus:ring-purple-500">{{ $bm->notes }}</textarea>
                            <div class="flex justify-end">
                                <button type="submit" class="px-3 py-1 rounded-lg text-[10px] font-bold text-white bg-purple-600 hover:bg-purple-500">Save Note</button>
                            </div>
                        </form>
                    </div>

                    @if($item)
                        <div class="pt-3 border-t border-slate-200/60 dark:border-white/5 flex justify-end">
                            @if($bm->item_type === 'career')
                                <a href="{{ route('careers.show', $item->id) }}" class="text-xs font-bold text-indigo-600 dark:text-indigo-400 hover:underline">View Career Track &rarr;</a>
                            @elseif($bm->item_type === 'multimedia')
                                <a href="{{ route('multimedia.show', $item->id) }}" class="text-xs font-bold text-indigo-600 dark:text-indigo-400 hover:underline">Watch Masterclass &rarr;</a>
                            @elseif($bm->item_type === 'resource')
                                <a href="{{ route('resources.show', $item->id) }}" class="text-xs font-bold text-indigo-600 dark:text-indigo-400 hover:underline">Open Toolkit &rarr;</a>
                            @endif
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    @endif

</div>

@endsection
