@extends('layouts.app')

@section('content')
    <!-- Hero Section -->
    <section class="relative bg-white overflow-hidden">
        <div class="max-w-7xl mx-auto">
            <div class="relative z-10 pb-8 bg-white sm:pb-16 md:pb-20 lg:max-w-2xl lg:w-full lg:pb-28 xl:pb-32">
                <main class="mt-10 mx-auto max-w-7xl px-4 sm:mt-12 sm:px-6 md:mt-16 lg:mt-20 lg:px-8 xl:mt-28">
                    <div class="sm:text-center lg:text-left">
                        <h1 class="text-4xl tracking-tight font-extrabold text-gray-900 sm:text-5xl md:text-6xl">
                            <span class="block">Voyagez en</span>
                            <span class="block text-blue-600">toute confiance</span>
                        </h1>
                        <p class="mt-3 text-base text-gray-500 sm:mt-5 sm:text-lg sm:max-w-xl sm:mx-auto md:mt-5 md:text-xl lg:mx-0">
                            Réservez votre grand taxi pour vos trajets interurbains en quelques clics. Simple, rapide et fiable.
                        </p>
                        <div class="mt-5 sm:mt-8 sm:flex sm:justify-center lg:justify-start">
                            <div class="rounded-md shadow">
                                <a href="{{ route('register') }}" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 md:py-4 md:text-lg md:px-10">
                                    Commencer
                                </a>
                            </div>
                            <div class="mt-3 sm:mt-0 sm:ml-3">
                                <a href="{{ route('services') }}" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-blue-600 bg-blue-100 hover:bg-blue-200 md:py-4 md:text-lg md:px-10">
                                    En savoir plus
                                </a>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
        <div class="lg:absolute lg:inset-y-0 lg:right-0 lg:w-1/2">
            <img class="h-56 w-full object-cover sm:h-72 md:h-96 lg:w-full lg:h-full" src="https://images.unsplash.com/photo-1482029255085-35a4a48b7084?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8N3x8VGF4aXxlbnwwfDB8MHx8fDI%3D" alt="Taxi">
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h2 class="text-3xl font-extrabold text-gray-900">
                    Pourquoi choisir Taxi Wsselni ?
                </h2>
            </div>
            <div class="mt-10">
                <div class="grid grid-cols-1 gap-10 sm:grid-cols-2 lg:grid-cols-3">
                    <div class="flex flex-col items-center">
                        <div class="flex items-center justify-center h-12 w-12 rounded-md bg-blue-600 text-white">
                            <i class="fas fa-clock"></i>
                        </div>
                        <h3 class="mt-6 text-lg font-medium text-gray-900">Réservation rapide</h3>
                        <p class="mt-2 text-base text-gray-500 text-center">
                            Réservez votre trajet en quelques clics, 24/7
                        </p>
                    </div>
                    <div class="flex flex-col items-center">
                        <div class="flex items-center justify-center h-12 w-12 rounded-md bg-blue-600 text-white">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <h3 class="mt-6 text-lg font-medium text-gray-900">Sécurité garantie</h3>
                        <p class="mt-2 text-base text-gray-500 text-center">
                            Chauffeurs vérifiés et trajets sécurisés
                        </p>
                    </div>
                    <div class="flex flex-col items-center">
                        <div class="flex items-center justify-center h-12 w-12 rounded-md bg-blue-600 text-white">
                            <i class="fas fa-money-bill-wave"></i>
                        </div>
                        <h3 class="mt-6 text-lg font-medium text-gray-900">Prix transparents</h3>
                        <p class="mt-2 text-base text-gray-500 text-center">
                            Tarifs clairs et sans surprises
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection