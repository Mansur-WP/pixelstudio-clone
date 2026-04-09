@extends('layouts.platform')
@section('title', 'Platform Settings')
@section('content')
<div class="max-w-5xl mx-auto pb-20">
    <div class="mb-12">
        <h1 class="text-3xl font-outfit font-black text-slate-800 tracking-tight">System Settings</h1>
        <p class="text-slate-400 font-medium mt-1">Manage your account preferences and security settings</p>
    </div>

    @if(session('success'))
        <div class="mb-10 px-6 py-4 bg-emerald-50 border border-emerald-100 rounded-2xl flex items-center gap-4 animate-in fade-in slide-in-from-top-4 duration-300">
            <div class="h-10 w-10 bg-emerald-100 rounded-xl flex items-center justify-center text-emerald-600">
                <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
            </div>
            <span class="font-bold text-emerald-800 uppercase tracking-wide text-sm">{{ session('success') }}</span>
        </div>
    @endif

    <form action="{{ route('platform.settings.update') }}" method="POST" class="space-y-10">
        @csrf
        
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
            <!-- Sidebar Labels -->
            <div class="lg:col-span-1">
                <h3 class="text-lg font-outfit font-black text-slate-800">Account Profile</h3>
                <p class="text-xs text-slate-400 font-bold uppercase tracking-widest mt-2">Personal Information</p>
                <div class="mt-8 p-6 bg-slate-900 rounded-3xl text-white shadow-2xl">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="h-12 w-12 rounded-2xl bg-indigo-500 flex items-center justify-center font-black text-xl shadow-lg">
                            {{ substr($user->name, 0, 1) }}
                        </div>
                        <div>
                            <div class="text-sm font-black tracking-tight">{{ $user->name }}</div>
                            <div class="text-[10px] font-bold text-indigo-300 uppercase tracking-widest">Administrator</div>
                        </div>
                    </div>
                    <div class="space-y-3">
                        <div class="flex justify-between text-[10px] font-bold uppercase tracking-widest text-white/40">
                            <span>Status</span>
                            <span class="text-emerald-400">Active</span>
                        </div>
                        <div class="flex justify-between text-[10px] font-bold uppercase tracking-widest text-white/40">
                            <span>Access Level</span>
                            <span>Standard</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Profile Form Column -->
            <div class="lg:col-span-2 space-y-8">
                <div class="bg-white p-10 rounded-[2.5rem] border border-slate-100 shadow-2xl shadow-indigo-100/50">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div>
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-3 ml-1">Full Name</label>
                            <input type="text" name="name" value="{{ old('name', $user->name) }}" 
                                class="w-full bg-slate-50 border border-slate-100 rounded-2xl px-6 py-4 focus:outline-none focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all font-bold text-slate-700">
                        </div>
                        <div>
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-3 ml-1">Email Address</label>
                            <input type="email" name="email" value="{{ old('email', $user->email) }}" 
                                class="w-full bg-slate-50 border border-slate-100 rounded-2xl px-6 py-4 focus:outline-none focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all font-bold text-slate-700">
                        </div>
                    </div>
                </div>

                <!-- Password Node -->
                <div class="bg-white p-10 rounded-[2.5rem] border border-slate-100 shadow-2xl shadow-purple-100/50 relative overflow-hidden group">
                    <div class="absolute -top-10 -right-10 h-32 w-32 bg-purple-50 rounded-full blur-3xl group-hover:bg-purple-100 transition-colors"></div>
                    <h3 class="text-[10px] font-black text-purple-400 uppercase tracking-[0.2em] mb-10 relative">Security Settings</h3>
                    
                    <div class="space-y-8 relative">
                        <div>
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-3 ml-1">Current Password</label>
                            <input type="password" name="current_password" 
                                class="w-full bg-slate-50 border border-slate-100 rounded-2xl px-6 py-4 focus:outline-none focus:ring-4 focus:ring-purple-500/10 focus:border-purple-500 transition-all font-bold text-slate-700"
                                placeholder="••••••••••••">
                            @error('current_password') <p class="text-rose-500 text-[10px] font-bold mt-2 ml-1 uppercase tracking-tight">{{ $message }}</p> @enderror
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div>
                                <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-3 ml-1">New Password</label>
                                <input type="password" name="new_password" 
                                    class="w-full bg-slate-50 border border-slate-100 rounded-2xl px-6 py-4 focus:outline-none focus:ring-4 focus:ring-purple-500/10 focus:border-purple-500 transition-all font-bold text-slate-700"
                                    placeholder="••••••••••••">
                            </div>
                            <div>
                                <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-3 ml-1">Confirm New Password</label>
                                <input type="password" name="new_password_confirmation" 
                                    class="w-full bg-slate-50 border border-slate-100 rounded-2xl px-6 py-4 focus:outline-none focus:ring-4 focus:ring-purple-500/10 focus:border-purple-500 transition-all font-bold text-slate-700"
                                    placeholder="••••••••••••">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex justify-end pt-4">
                    <button type="submit" class="group relative px-12 py-5 bg-indigo-950 text-white font-black rounded-2xl shadow-2xl shadow-indigo-950/20 active:scale-95 transition-all overflow-hidden">
                        <span class="relative z-10 uppercase tracking-widest text-xs">Sync Administrative Parameters</span>
                        <div class="absolute inset-0 bg-gradient-to-r from-indigo-500 to-purple-600 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    </button>
                </div>
            </div>
        </div>

        <!-- Global Telemetry -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
            <div class="bg-indigo-50/50 border border-indigo-100 p-8 rounded-[2rem] flex items-center justify-between group hover:bg-white transition-all duration-300 shadow-sm hover:shadow-xl">
                <div>
                    <p class="text-[10px] font-black text-indigo-400 uppercase tracking-widest mb-1">Total System Entities</p>
                    <p class="text-3xl font-outfit font-black text-slate-800">{{ $total_studios }} Studios</p>
                </div>
                <div class="h-14 w-14 bg-white rounded-2xl flex items-center justify-center text-2xl shadow-indigo-100 shadow-lg group-hover:scale-110 transition-transform">🏢</div>
            </div>
            <div class="bg-purple-50/50 border border-purple-100 p-8 rounded-[2rem] flex items-center justify-between group hover:bg-white transition-all duration-300 shadow-sm hover:shadow-xl">
                <div>
                    <p class="text-[10px] font-black text-purple-400 uppercase tracking-widest mb-1">Global Operator Count</p>
                    <p class="text-3xl font-outfit font-black text-slate-800">{{ $total_users }} Users</p>
                </div>
                <div class="h-14 w-14 bg-white rounded-2xl flex items-center justify-center text-2xl shadow-purple-100 shadow-lg group-hover:scale-110 transition-transform">👥</div>
            </div>
        </div>
    </form>
</div>
@endsection
