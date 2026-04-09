@extends('layouts.platform')
@section('title', 'Create New Studio')
@section('content')
<div class="space-y-10 pb-20" x-data="{
    studioName: '{{ old('studio_name') }}',
    slug: '{{ old('studio_slug') }}',
    generateSlug() {
        this.slug = this.studioName
            .toLowerCase()
            .replace(/[^a-z0-9\s-]/g, '')
            .replace(/\s+/g, '-')
            .replace(/-+/g, '-')
            .trim('-');
    }
}">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-outfit font-black text-slate-800 tracking-tight">Create New Studio</h1>
            <p class="text-slate-400 font-medium mt-1">Setup a new photography workspace and administrator</p>
        </div>
        <a href="{{ route('platform.studios') }}" class="text-xs font-black text-slate-400 hover:text-indigo-600 uppercase tracking-widest transition-colors flex items-center gap-2">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Back to Studios
        </a>
    </div>

    @if($errors->any())
        <div class="bg-rose-50 border border-rose-100 rounded-3xl p-6 animate-in fade-in slide-in-from-top-4 duration-300">
            <div class="flex items-center gap-3 text-rose-600 font-black text-xs uppercase tracking-widest mb-4">
                <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                Execution Errors Detected
            </div>
            <ul class="space-y-1">
                @foreach($errors->all() as $error)
                    <li class="text-rose-500 text-sm font-bold flex items-center gap-2">
                        <span class="h-1 w-1 bg-rose-400 rounded-full"></span>
                        {{ $error }}
                    </li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('platform.studios.store') }}" method="POST" class="grid grid-cols-1 lg:grid-cols-2 gap-10">
        @csrf
        
        <!-- Left Section: Studio Details -->
        <div class="bg-white rounded-[3rem] p-10 border border-slate-50 shadow-2xl shadow-indigo-100/50 space-y-8 relative overflow-hidden">
            <div class="absolute right-0 top-0 h-32 w-32 bg-indigo-50 rounded-full blur-[60px] -mr-16 -mt-16 opacity-50"></div>
            
            <div class="relative z-10">
                <h3 class="text-xs font-black text-slate-400 uppercase tracking-widest mb-8 flex items-center gap-3">
                    <span class="h-8 w-8 rounded-xl bg-indigo-600 text-white flex items-center justify-center text-[10px]">01</span>
                    Studio Details
                </h3>

                <div class="space-y-6">
                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 ml-1">Studio Name</label>
                        <input type="text" name="studio_name" x-model="studioName" @input="generateSlug()" placeholder="e.g. GBSM Photography" required
                            class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 text-sm font-bold text-slate-700 focus:ring-2 focus:ring-indigo-500/20 transition-all placeholder:text-slate-300">
                    </div>

                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 ml-1">Studio Slug (URL Path)</label>
                        <div class="relative">
                            <input type="text" name="studio_slug" x-model="slug" placeholder="e.g. gbsm-photography" required
                                class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 text-sm font-bold text-slate-700 focus:ring-2 focus:ring-indigo-500/20 transition-all placeholder:text-slate-300">
                            <div class="mt-2 ml-1 text-[10px] font-medium text-slate-400 flex items-center gap-1">
                                <span class="opacity-50">Public URL:</span>
                                <span class="text-indigo-500 font-bold font-mono">{{ url('/s/') }}/</span><span class="text-indigo-500 font-bold font-mono" x-text="slug"></span>
                            </div>
                        </div>
                    </div>

                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 ml-1">Assigned Plan</label>
                        <div class="grid grid-cols-2 gap-4">
                            <label class="relative cursor-pointer group">
                                <input type="radio" name="plan" value="free" checked class="peer sr-only">
                                <div class="bg-slate-50 peer-checked:bg-white peer-checked:ring-2 peer-checked:ring-indigo-500 border border-transparent peer-checked:border-indigo-100 rounded-2xl p-4 transition-all group-hover:bg-slate-100 peer-checked:group-hover:bg-white">
                                    <span class="block text-xs font-black text-slate-400 peer-checked:text-indigo-600 uppercase tracking-widest leading-none">Free Tier</span>
                                    <span class="block text-[9px] text-slate-300 mt-1 font-medium">Standard access</span>
                                </div>
                            </label>
                            <label class="relative cursor-pointer group">
                                <input type="radio" name="plan" value="pro" class="peer sr-only">
                                <div class="bg-slate-50 peer-checked:bg-white peer-checked:ring-2 peer-checked:ring-purple-500 border border-transparent peer-checked:border-purple-100 rounded-2xl p-4 transition-all group-hover:bg-slate-100 peer-checked:group-hover:bg-white">
                                    <span class="block text-xs font-black text-slate-400 peer-checked:text-purple-600 uppercase tracking-widest leading-none">Pro Tier</span>
                                    <span class="block text-[9px] text-slate-300 mt-1 font-medium">Full capabilities</span>
                                </div>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Section: Admin Account -->
        <div class="bg-indigo-950 rounded-[3rem] p-10 text-white shadow-2xl shadow-indigo-900/40 space-y-8 relative overflow-hidden flex flex-col justify-between">
            <div class="absolute -right-20 -bottom-20 h-64 w-64 bg-indigo-500 rounded-full blur-[100px] opacity-20"></div>
            
            <div class="relative z-10">
                <h3 class="text-xs font-black text-indigo-300/40 uppercase tracking-widest mb-8 flex items-center gap-3">
                    <span class="h-8 w-8 rounded-xl bg-white/10 text-white flex items-center justify-center text-[10px]">02</span>
                    Administrator Identity
                </h3>

                <div class="space-y-6">
                    <div>
                        <label class="block text-[10px] font-black text-indigo-300/40 uppercase tracking-widest mb-2 ml-1">Full Admin Name</label>
                        <input type="text" name="admin_name" placeholder="Staff Full Name" required value="{{ old('admin_name') }}"
                            class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 text-sm font-bold text-white focus:outline-none focus:ring-2 focus:ring-indigo-500/50 transition-all placeholder:text-indigo-300/20">
                    </div>

                    <div>
                        <label class="block text-[10px] font-black text-indigo-300/40 uppercase tracking-widest mb-2 ml-1">Admin Email Address</label>
                        <input type="email" name="admin_email" placeholder="admin@studio.com" required value="{{ old('admin_email') }}"
                            class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 text-sm font-bold text-white focus:outline-none focus:ring-2 focus:ring-indigo-500/50 transition-all placeholder:text-indigo-300/20">
                    </div>

                    <div>
                        <label class="block text-[10px] font-black text-indigo-300/40 uppercase tracking-widest mb-2 ml-1">Access Password</label>
                        <input type="password" name="admin_password" placeholder="••••••••" required
                            class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 text-sm font-bold text-white focus:outline-none focus:ring-2 focus:ring-indigo-500/50 transition-all placeholder:text-indigo-300/20">
                        <p class="mt-2 ml-1 text-[9px] font-medium text-indigo-300/30">Min 6 characters. This account will be used by the studio owner to log in.</p>
                    </div>
                </div>
            </div>

            <div class="relative z-10 pt-10 flex items-center justify-between gap-6">
                <a href="{{ route('platform.studios') }}" class="text-xs font-black text-indigo-300/40 hover:text-white uppercase tracking-widest transition-colors">Abort Process</a>
                <button type="submit" class="bg-white hover:bg-indigo-400 hover:text-white text-indigo-950 px-10 py-5 rounded-2xl font-black text-xs uppercase tracking-widest transition-all shadow-xl shadow-indigo-900/40 transform hover:-translate-y-1 active:scale-95 leading-none">
                    Initialize Studio
                </button>
            </div>
        </div>
    </form>
</div>
@endsection
