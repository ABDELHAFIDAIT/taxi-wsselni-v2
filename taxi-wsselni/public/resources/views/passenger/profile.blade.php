@php
if(Auth::user()->role!='Passenger'){
    abort(code: 403);
}
@endphp

@extends('layouts.app')


@section('style')
<style>
    .glass-effect {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }
    .profile-card {
        transition: transform 0.3s ease;
    }
    .profile-card:hover {
        transform: translateY(-5px);
    }
    .nav-link {
        transition: all 0.3s ease;
    }
    .nav-link:hover {
        transform: translateX(5px);
    }
    .gradient-button {
        background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
        transition: all 0.3s ease;
    }
    .gradient-button:hover {
        background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
        transform: translateY(-2px);
    }
</style>
@endsection


@section('content')
    <!-- Profile Section -->
    <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
        <div class="md:grid md:grid-cols-3 md:gap-8">
            <!-- Profile Sidebar -->
            <div class="md:col-span-1">
                <div class="profile-card bg-white rounded-2xl shadow-lg p-6">
                    <div class="text-center">
                        <div class="relative inline-block">
                            @if (str_contains(Auth::user()->photo, 'http'))
                                <img src="{{ Auth::user()->photo }}" alt="Profile" class="mx-auto w-32 h-32 rounded-full border-4 border-blue-500 shadow-lg">
                            @else
                                <img src="{{ asset('storage/' . Auth::user()->photo) }}" alt="Profile" class="mx-auto w-32 h-32 rounded-full border-4 border-blue-500 shadow-lg">
                            @endif
                            <button class="absolute bottom-0 right-0 bg-blue-500 text-white p-2 rounded-full shadow-lg hover:bg-blue-600 transition-colors duration-200">
                                <i class="fas fa-camera"></i>
                            </button>
                        </div>
                        <h2 class="mt-4 text-2xl font-bold text-gray-900">{{ Auth::user()->f_name . ' ' . Auth::user()->l_name }}</h2>
                        <p class="text-blue-600 font-medium">Passager</p>
                    </div>
                    <div class="mt-8">
                        <nav class="space-y-3">
                            <a href="#" class="nav-link flex items-center px-4 py-3 text-blue-600 bg-blue-50 rounded-xl">
                                <i class="fas fa-user-circle text-xl mr-3"></i>
                                <span class="font-medium">Profile</span>
                            </a>
                            <a href="{{ route('passenger.reservations') }}" class="nav-link flex items-center px-4 py-3 text-gray-700 hover:bg-gray-50 rounded-xl transition-colors duration-200">
                                <i class="fas fa-history text-xl mr-3"></i>
                                <span class="font-medium">Mes Réservations</span>
                            </a>
                            <form method="POST" action="{{ route('logout') }}" class="cursor-pointer nav-link flex items-center px-4 py-3 text-red-600 hover:bg-red-50 rounded-xl transition-colors duration-200">
                                @csrf
                                <button>
                                    <i class="fas fa-sign-out-alt text-xl mr-3"></i>
                                    <span class="font-medium">Déconnexion</span>
                                </button>
                            </form>
                        </nav>
                    </div>
                </div>
            </div>

            <!-- Profile Content -->
            <div class="mt-8 md:mt-0 md:col-span-2 flex flex-col gap-10">
                <div class="rounded-2xl bg-white shadow-lg glass-effect">
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-6">Informations personnelles</h3>
                        <form method="POST" action="{{ route('passenger.edit') }}">
                            @csrf
                            <div class="grid grid-cols-1 gap-6">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Prénom</label>
                                        <input name="f_name" id="f_name" type="text" value="{{ Auth::user()->f_name }}" class="w-full px-4 py-2 rounded-xl border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Nom</label>
                                        <input name="l_name" id="l_name" type="text" value="{{ Auth::user()->l_name }}" class="w-full px-4 py-2 rounded-xl border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                                    <input name="email" id="email" type="email" value="{{ Auth::user()->email }}" class="w-full px-4 py-2 rounded-xl border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Téléphone</label>
                                    <input name="phone" id="phone" type="tel" value="{{ Auth::user()->phone }}" class="w-full px-4 py-2 rounded-xl border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
                                </div>
                            </div>
                            <div class="mt-8">
                                <button type="submit" class="gradient-button w-full md:w-auto px-6 py-3 text-white font-medium rounded-xl shadow-lg focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    <i class="fas fa-save mr-2"></i>
                                    Sauvegarder les modifications
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="rounded-2xl bg-white shadow-lg glass-effect">
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-6">Réinitialisation du Mot de Passe</h3>
                        @error('success')
                            <div class="text-green-600 font-medium my-4">
                                {{ $message }}
                            </div>
                        @enderror
                        <form method="POST" action="{{ route('passenger.password') }}">
                            @csrf
                            <div class="grid grid-cols-1 gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Mot de Passe Actuel</label>
                                    <input name="old_password" id="old_password" type="password"  class="w-full px-4 py-2 rounded-xl border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
                                    @error('old_password')
                                        <div class="text-red-600 font-light text-xs mt-4">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Nouveau Mot de Passe</label>
                                    <input name="password" id="password" type="password" class="w-full px-4 py-2 rounded-xl border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Confirmer le Mot de Passee</label>
                                    <input name="password_confirmation" id="password_confirmation" type="password" class="w-full px-4 py-2 rounded-xl border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
                                </div>
                            </div>
                            <div class="mt-8">
                                <button type="submit" class="gradient-button w-full md:w-auto px-6 py-3 text-white font-medium rounded-xl shadow-lg focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    <i class="fas fa-save mr-2"></i>
                                    Sauvegarder les modifications
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection