@extends('layouts.app')


@section('style')
<style>
    .glass-effect {
        background: #fffffff2;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }
    .glass-effects {
        background: #fffffff2;
        backdrop-filter: blur(10px);
        /* border: 1px solid rgba(255, 255, 255, 0.2); */
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
                            <a href="{{ route('passenger.profile') }}" class="nav-link flex items-center px-4 py-3 text-gray-700 hover:bg-gray-50 rounded-xl transition-colors duration-200">
                                <i class="fas fa-user-circle text-xl mr-3"></i>
                                <span class="font-medium">Profile</span>
                            </a>
                            <a href="#" class="nav-link flex items-center px-4 py-3 text-blue-600 bg-blue-50 rounded-xl ">
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

            <!-- Trajets Content -->
            <div class="mt-8 md:mt-0 md:col-span-2 flex flex-col gap-10">
                <div class="col-span-2 flex flex-col gap-5">
                    <h1 class="font-semibold text-xl ">Mes Réservations</h1>
                    <form class="flex">
                        <input type="text" class="py-2 w-full px-5 bg-white border border-gray-200 shadow-sm rounded-l-md outline-none" placeholder="Rechercher ici">
                        <button type="button" class="bg-blue-600 text-white py-2 px-5 rounded-r-md">Rechercher</button>
                    </form>
                    <div>
                        @error('success')
                            <p class="text-sm font-light py-1 px-5 bg-green-100 text-green-700 border border-green-600 rounded-sm">{{$message}}</p>
                        @enderror
                        @error('error')
                            <p class="text-sm font-light py-1 px-5 bg-red-100 text-red-700 border border-red-600 rounded-sm">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-5">
                    @foreach ($reservations as $reservation)
                        @if ($reservation->status == 'accepted')
                            <div class="glass-effects p-6 rounded-lg bg-white shadow-lg border-y border-y-gray-200 border-r border-r-gray-200 border-l-8 border-green-500">
                        @elseif ($reservation->status == 'refused')
                            <div class="glass-effects p-6 rounded-lg bg-white shadow-lg border-y border-y-gray-200 border-r border-r-gray-200 border-l-8 border-red-500">
                        @else
                            <div class="glass-effects p-6 rounded-lg bg-white shadow-lg border-y border-y-gray-200 border-r border-r-gray-200 border-l-8 border-yellow-500">
                        @endif
                            <div class="flex justify-between items-center">
                                <h1 class="font-medium">{{ $reservation->cityDepart->name }} → {{ $reservation->cityArrivee->name }}</h1>
                                <div class="flex flex-col gap-2 text-center">
                                    @if ($reservation->status == 'accepted')
                                        <span class="text-xs px-2 bg-green-200 text-green-700 rounded-full py-1">Acceptée</span>
                                    @elseif ($reservation->status == 'refused')
                                        <span class="text-xs px-2 bg-red-200 text-red-700 rounded-full py-1">Refusée</span>
                                    @else
                                        <span class="text-xs px-2 bg-yellow-200 text-yellow-700 rounded-full py-1">En Attente</span>
                                    @endif
                                    @if ($reservation->isPayed)
                                        <span class="text-xs px-2 bg-green-200 text-green-700 rounded-full py-1">Payée</span>
                                    @else
                                        <span class="text-xs px-2 bg-red-200 text-red-700 rounded-full py-1">Non Payée</span>
                                    @endif
                                </div>
                            </div>
                            <div class="flex flex-col gap-1 mt-5 text-sm">
                                <div class="flex gap-3 items-center">
                                    <i class="fa-solid fa-circle-user text-blue-500"></i>
                                    <p>{{ $reservation->driver->f_name.' '.$reservation->driver->l_name }}</p>
                                </div>
                                <div class="flex gap-3 items-center">
                                    <i class="fa-solid fa-calendar-days text-green-600"></i>
                                    <p>{{ explode(' ',$reservation->date_reservation)[0] }}</p>
                                </div>
                                <div class="flex gap-3 items-center">
                                    <i class="fa-solid fa-clock text-purple-400"></i>
                                    <p>{{ explode(' ',$reservation->date_reservation)[1] }}</p>
                                </div>
                                <div class="flex gap-3 items-center">
                                    <i class="fa-solid fa-taxi text-yellow-500"></i>
                                    <p>{{ $reservation->driver->driver->vehicule }}</p>
                                </div>
                            </div>
                            <h1 class="text-lg font-bold text-gray-800 mt-5">{{ $reservation->price }} MAD</h1>
                            @if(!$reservation->isPayed)
                            <div class="flex justify-end items-center gap-5 mt-5">
                                @if ($reservation->status == 'accepted')
                                    <a href="/payment/{{ $reservation->id }}"><button class="cursor-pointer bg-blue-600 text-xs text-white py-1 px-3 rounded-sm">Payer<i class="fa-solid fa-credit-card ml-2"></i></button></a>
                                @endif
                                
                                <form method="POST" action="/reservation/{{ $reservation->id }}/delete">
                                    @csrf
                                    <button class="cursor-pointer bg-red-500 text-xs text-white py-1 px-3 rounded-sm">Supprimer<i class="fa-solid fa-trash ml-2"></i></button>
                                </form>
                                
                            </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection