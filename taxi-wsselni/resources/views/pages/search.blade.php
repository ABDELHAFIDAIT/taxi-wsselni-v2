@extends('layouts.app')

@section('style')
    <style>
        #popup{
            background-color: rgba(0, 0, 0, 0.8);
        }
    </style>
@endsection

@section('content')
    <!-- Hero Section -->
    <div class="relative bg-blue-600 overflow-hidden">
        <div class="max-w-7xl mx-auto">
            <div class="relative z-10 pb-8 bg-blue-600 sm:pb-16 md:pb-20 lg:max-w-2xl lg:w-full lg:pb-28 xl:pb-32">
                <main class="mt-10 mx-auto max-w-7xl px-4 sm:mt-12 sm:px-6 md:mt-16 lg:mt-20 lg:px-8 xl:mt-28">
                    <div class="sm:text-center lg:text-left">
                        <h1 class="text-4xl tracking-tight font-extrabold text-white sm:text-5xl md:text-6xl">
                            <span class="block">Trouvez votre</span>
                            <span class="block text-yellow-400">chauffeur idéal</span>
                        </h1>
                        <p class="mt-3 text-base text-blue-100 sm:mt-5 sm:text-lg sm:max-w-xl sm:mx-auto md:mt-5 md:text-xl lg:mx-0">
                            Des chauffeurs professionnels et expérimentés pour vos trajets interurbains en toute sécurité.
                        </p>
                    </div>
                </main>
            </div>
        </div>
        <div class="lg:absolute lg:inset-y-0 lg:right-0 lg:w-1/2">
            <img class="h-56 w-full object-cover sm:h-72 md:h-96 lg:w-full lg:h-full" src="https://images.unsplash.com/photo-1449965408869-eaa3f722e40d?w=800&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8dGF4aSUyMGRyaXZlcnxlbnwwfDB8MHx8fDI%3D" alt="Chauffeur de taxi">
        </div>
    </div>

    <!-- Search Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Search Section -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Combined Search Form -->
            <div class="bg-white rounded-lg p-6 mb-12">
                <form class="space-y-6" method="GET" action="{{ route('drivers.search') }}">
                    @csrf
                    <!-- Search by Name -->
                    <div class="max-w-full">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Rechercher un chauffeur</label>
                        <div class="relative">
                            <input type="text" name="query" placeholder="Nom ou prénom du chauffeur..." 
                                   class="w-full px-4 py-3 pl-12 pr-8 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-search text-gray-400"></i>
                            </div>
                        </div>
                    </div>
                
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- City Selection -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Ville</label>
                            <select name="city" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="">Toutes les villes</option>
                                @foreach ($cities as $city)
                                    <option value="{{ $city->id }}">{{ $city->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <!-- Date & Hour Selection -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Date et Heure</label>
                            <input type="datetime-local" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                    </div>
                
                    <!-- Submit Button -->
                    <div class="flex justify-center">
                        <button type="submit" class="px-8 py-3 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition-colors duration-200 flex items-center">
                            <i class="fas fa-search mr-2"></i>
                            Rechercher
                        </button>
                    </div>
                </form>                
            </div>
        </div>

        <!-- Drivers Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Driver Card -->
            @if(count($drivers) > 0)
                @foreach ($drivers as $driver)
                    @if($driver->user->role == 'Driver')
                        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                            <div class="p-6">
                                <div class="flex items-center">
                                    <img src="{{ asset('storage/' . $driver->user->photo) }}" alt="Driver" class="w-20 h-20 rounded-full border-4 border-blue-100">
                                    <div class="ml-4">
                                        <h3 class="text-xl font-semibold text-gray-900">{{ $driver->user->f_name . ' ' . $driver->user->l_name }}</h3>
                                        <p class="text-sm text-gray-500">Membre depuis {{ \Carbon\Carbon::parse($driver->user->created_at)->translatedFormat('F Y') }}</p>
                                    </div>
                                </div>
                                <div class="mt-4 space-y-2">
                                    <div class="flex items-center text-gray-600">
                                        <i class="fas fa-phone mr-2 text-blue-600"></i>
                                        <span>{{ $driver->user->phone}}</span>
                                    </div>
                                    <div class="flex items-center text-gray-600">
                                        <i class="fa-solid fa-taxi text-yellow-400 pr-3"></i>
                                        <span>{{ $driver->vehicule }}</span>
                                    </div>
                                    <div class="flex items-center text-gray-600">
                                        <i class="fa-solid fa-city textt-gray-800 pr-3"></i>
                                        <span>{{ $driver->city->name }}</span>
                                    </div>
                                </div>
                                @auth
                                    @if(Auth::user()->role == 'Passenger')
                                        <button data-id="{{ $driver->id_driver }}" data-city="{{ $driver->id_city }}"  id="openPopup" type="button" class="mt-4 px-8 py-2 bg-blue-600 text-white font-medium rounded-sm hover:bg-blue-700 transition-colors duration-200 flex justify-center items-center w-full cursor-pointer">
                                            Réserver
                                        </button>
                                    @endif
                                @endauth
                            </div>
                        </div>
                    @endif
                @endforeach
            @else
                <h1 class="text-red-600 text-center col-span-3 font-semibold text-2xl">Aucun chauffeur trouvé</h1>
            @endif
        </div>

        @error('city_arrivee')
            <div class="mt-8 border border-red-400 bg-red-200 text-red-800 rounded-md">
                <h1 class="py-2 px-5">{{ $message }}</h1>
            </div>
        @enderror

        @error('date_reservation')
            <div class="mt-8 border border-red-400 bg-red-200 text-red-800 rounded-md">
                <h1 class="py-2 px-5">{{ $message }}</h1>
            </div>
        @enderror

        <!-- Popup -->
        <div id="popup" class="fixed inset-0 z-50 flex items-center justify-center hidden">
            <div class="bg-white rounded-md w-1/3">
                <div class="flex items-center justify-between p-5">
                    <h1 class="text-2xl font-semibold">Réserver ce Taxi</h1>
                    <i id="closePopup" class="fa-solid fa-xmark cursor-pointer text-xl"></i>
                </div>
                <div class="h-[0.2px] bg-gray-200"></div>
                <form method="POST" action="{{ route('reservation.create') }}" id="reservationForm" class="space-y-4 p-5">
                    @csrf
                    <input type="hidden" name="id_driver" id="id_driver">
                    <input type="hidden" id="id_city" name="city_depart">
                    {{-- <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Ville de départ</label>
                        <input type="text" name="" disabled class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div> --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Ville d'arrivée</label>
                        <select name="city_arrivee" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            @foreach ($cities as $city)
                                <option value="{{ $city->id }}">{{ $city->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Date et heure de départ</label>
                        <input type="datetime-local" name="date_reservation" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div class="mt-6">
                        <button type="submit" class="w-full px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 cursor-pointer">
                            Confirmer
                        </button>
                    </div>
                </form>
            </div> 
        </div>
    </div>
@endsection

@section('script')
    <script>
        const closePopup = document.getElementById('closePopup');
        const openPopups = document.querySelectorAll('#openPopup');

        openPopups.forEach(openPopup => {
            openPopup.addEventListener('click', () => {
                document.getElementById('popup').classList.remove('hidden');
                document.getElementById('id_driver').value = openPopup.dataset.id;
                document.getElementById('id_city').value = openPopup.dataset.city;
            });
        });

        closePopup.addEventListener('click', () => {
            document.getElementById('popup').classList.add('hidden');
        });
    </script>
@endsection