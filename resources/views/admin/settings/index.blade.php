@extends('layouts.app')
@section('title', 'Manage Settings')
@section('content')
<div class="max-w-4xl mx-auto py-10 px-6">
    <div class="mb-10">
        <h1 class="text-3xl font-outfit font-black text-slate-800 tracking-tight">System Settings</h1>
        <p class="text-slate-400 font-medium mt-1 text-lg">Manage your studio brand and profile security</p>
    </div>

    @if(session('success'))
        <div class="mb-8 p-4 bg-green-50 border-l-4 border-green-500 text-green-800 rounded-r-lg shadow-sm flex items-center">
            <svg class="h-5 w-5 mr-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
            <span class="font-medium">{{ session('success') }}</span>
        </div>
    @endif

    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <!-- Section 1: Studio Settings -->
        <div class="bg-white rounded-[2.5rem] shadow-2xl shadow-indigo-100/50 border border-slate-100 overflow-hidden mb-12">
            <div class="px-10 py-8 bg-slate-50 border-b border-slate-100">
                <h2 class="text-xl font-outfit font-black text-slate-800 tracking-tight">Studio Profile</h2>
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-1">Update your brand identity</p>
            </div>
            <div class="p-8 space-y-8">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2 uppercase tracking-wider">Studio Name</label>
                    <input type="text" name="studio_name" value="{{ old('studio_name', $studio->name) }}" 
                        class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:bg-white transition-all">
                    @error('studio_name') <p class="text-red-500 text-xs mt-2 font-medium">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-4 uppercase tracking-wider">Studio Logo</label>
                    <div class="flex items-center gap-8">
                        @if($studio->logo_path)
                            <div class="relative group">
                                <img src="{{ asset('storage/' . $studio->logo_path) }}" 
                                    class="h-24 w-24 object-contain rounded-xl border border-gray-100 p-2 bg-white shadow-sm transition-transform group-hover:scale-105">
                                <span class="absolute -top-2 -right-2 bg-indigo-600 text-white text-[10px] px-2 py-1 rounded-full font-bold uppercase tracking-tighter">Current</span>
                            </div>
                        @else
                            <div class="h-24 w-24 bg-gray-100 rounded-xl flex items-center justify-center border-2 border-dashed border-gray-200">
                                <svg class="h-8 w-8 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            </div>
                        @endif
                        <div class="flex-1">
                            <input type="file" name="logo" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 transition-all cursor-pointer">
                            <p class="text-xs text-gray-400 mt-2">Recommended: transparent PNG, max 2MB.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Section 2: My Profile -->
        <div class="bg-white rounded-[2.5rem] shadow-2xl shadow-purple-100/50 border border-slate-100 overflow-hidden mb-12">
            <div class="px-10 py-8 bg-slate-50 border-b border-slate-100">
                <h2 class="text-xl font-outfit font-black text-slate-800 tracking-tight">Personal Profile</h2>
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-1">Manage your account credentials</p>
            </div>
            <div class="p-8 grid grid-cols-1 md:grid-cols-2 gap-8">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2 uppercase tracking-wider">Full Name</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}" 
                        class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:bg-white transition-all">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2 uppercase tracking-wider">Email Address</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}" 
                        class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:bg-white transition-all">
                </div>

                <div class="md:col-span-2 pt-6 border-t border-gray-50">
                    <h3 class="text-sm font-bold text-indigo-600 uppercase tracking-widest mb-6">Change Password</h3>
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-gray-700 mb-2 uppercase tracking-wider">Current Password</label>
                    <input type="password" name="current_password" 
                        class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:bg-white transition-all"
                        placeholder="••••••••">
                    @error('current_password') <p class="text-red-500 text-xs mt-2 font-medium">{{ $message }}</p> @enderror
                    <p class="text-xs text-gray-400 mt-2 italic">Required only if updating password.</p>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2 uppercase tracking-wider">New Password</label>
                    <input type="password" name="new_password" 
                        class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:bg-white transition-all"
                        placeholder="••••••••">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2 uppercase tracking-wider">Confirm New Password</label>
                    <input type="password" name="new_password_confirmation" 
                        class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:bg-white transition-all"
                        placeholder="••••••••">
                </div>
            </div>
        </div>

        <div class="flex justify-end pb-20">
            <button type="submit" class="w-full md:w-auto px-12 py-5 bg-indigo-600 hover:bg-slate-900 text-white font-black text-xs uppercase tracking-[0.2em] rounded-2xl shadow-xl shadow-indigo-200 transition-all transform hover:-translate-y-1 active:scale-95">
                Save All Settings
            </button>
        </div>
    </form>
</div>
@endsection
