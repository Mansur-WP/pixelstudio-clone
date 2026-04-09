<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gallery | {{ $client->name }}</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.4.1/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <style>
        body { font-family: 'Outfit', sans-serif; background-color: #0c0c0e; color: #f8fafc; }
        .glass { background: rgba(255, 255, 255, 0.03); backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.05); }
        .gradient-text { background: linear-gradient(135deg, #fff 0%, #a5b4fc 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="min-h-screen selection:bg-indigo-500/30">

    <!-- Header -->
    <header class="py-12 px-6 flex flex-col items-center text-center">
        <h1 class="text-4xl md:text-5xl font-bold mb-4 gradient-text">Private Collection</h1>
        <p class="text-gray-400 max-w-md">Exclusively prepared for <span class="text-indigo-300 font-semibold">{{ $client->name }}</span></p>
        <div class="mt-8 flex gap-4">
            <span class="px-3 py-1 glass rounded-full text-xs font-semibold text-gray-300 tracking-wider uppercase">{{ $client->photo_format }} Format</span>
            <span class="px-3 py-1 glass rounded-full text-xs font-semibold text-gray-300 tracking-wider uppercase">{{ $photos->count() }} Images</span>
        </div>
    </header>

    <!-- Gallery Grid -->
    <main class="max-w-7xl mx-auto px-6 pb-24" x-data="{ selectedPhoto: null }">
        @if($photos->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach($photos as $photo)
                    <div 
                        class="group relative aspect-[4/5] overflow-hidden rounded-2xl bg-zinc-900 cursor-zoom-in transition-all duration-500 hover:shadow-2xl hover:shadow-indigo-500/10"
                        @click="selectedPhoto = '{{ asset('storage/' . $photo->path) }}'"
                    >
                        <img 
                            src="{{ asset('storage/' . $photo->path) }}" 
                            alt="Photo" 
                            class="w-full h-full object-cover transition duration-700 group-hover:scale-110"
                            loading="lazy"
                        >
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-6">
                            <span class="text-xs font-medium text-white/70 tracking-widest uppercase">View Fullscreen</span>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="py-32 flex flex-col items-center text-center">
                <div class="w-20 h-20 bg-zinc-900 rounded-full flex items-center justify-center mb-6 border border-zinc-800">
                    <svg class="w-8 h-8 text-zinc-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                </div>
                <h2 class="text-xl font-semibold opacity-50">Nothing to see yet</h2>
                <p class="text-sm text-zinc-600 mt-2">Your photos will appear here once they are uploaded by the studio.</p>
            </div>
        @endif

        <!-- Lightbox -->
        <template x-if="selectedPhoto">
            <div 
                x-cloak
                class="fixed inset-0 z-50 flex items-center justify-center bg-black/95 p-4 md:p-8"
                @keydown.escape.window="selectedPhoto = null"
            >
                <button 
                    @click="selectedPhoto = null" 
                    class="absolute top-6 right-6 p-2 text-white/50 hover:text-white transition-colors"
                >
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
                <img 
                    :src="selectedPhoto" 
                    class="max-w-full max-h-full object-contain rounded-lg shadow-2xl"
                    data-aos="zoom-in"
                >
            </div>
        </template>
    </main>

    <!-- Footer -->
    <footer class="py-12 border-t border-white/5 text-center">
        <div class="text-zinc-500 text-xs tracking-widest uppercase">Powered by PixelStudio Digital</div>
    </footer>

</body>
</html>
