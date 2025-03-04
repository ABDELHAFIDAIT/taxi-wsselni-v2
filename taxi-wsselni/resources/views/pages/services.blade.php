@extends('layouts.app')

@section('content')
    <!-- Services Header -->
    <div class="bg-blue-600 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-4xl font-bold text-white mb-4">Nos Services</h1>
                <p class="text-xl text-blue-100">Des solutions de transport adaptées à vos besoins</p>
            </div>
        </div>
    </div>

    <!-- Main Services -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Service 1 -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="p-6">
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mb-4">
                        <i class="fas fa-route text-2xl text-blue-600"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Trajets Interurbains</h3>
                    <p class="text-gray-600">Voyagez entre les villes en tout confort avec nos grands taxis. Réservation à l'avance pour une meilleure planification.</p>
                    <ul class="mt-4 space-y-2">
                        <li class="flex items-center text-gray-600">
                            <i class="fas fa-check text-green-500 mr-2"></i>
                            Réservation garantie
                        </li>
                        <li class="flex items-center text-gray-600">
                            <i class="fas fa-check text-green-500 mr-2"></i>
                            Prix fixe
                        </li>
                        <li class="flex items-center text-gray-600">
                            <i class="fas fa-check text-green-500 mr-2"></i>
                            Choix des horaires
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Service 2 -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="p-6">
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mb-4">
                        <i class="fas fa-users text-2xl text-blue-600"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Transport de Groupe</h3>
                    <p class="text-gray-600">Idéal pour les groupes jusqu'à 6 personnes. Parfait pour les familles ou les petits groupes.</p>
                    <ul class="mt-4 space-y-2">
                        <li class="flex items-center text-gray-600">
                            <i class="fas fa-check text-green-500 mr-2"></i>
                            Véhicules spacieux
                        </li>
                        <li class="flex items-center text-gray-600">
                            <i class="fas fa-check text-green-500 mr-2"></i>
                            Tarifs de groupe
                        </li>
                        <li class="flex items-center text-gray-600">
                            <i class="fas fa-check text-green-500 mr-2"></i>
                            Confort optimal
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Service 3 -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="p-6">
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mb-4">
                        <i class="fas fa-calendar-alt text-2xl text-blue-600"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Réservation Régulière</h3>
                    <p class="text-gray-600">Programme de fidélité pour les voyageurs réguliers avec des avantages exclusifs.</p>
                    <ul class="mt-4 space-y-2">
                        <li class="flex items-center text-gray-600">
                            <i class="fas fa-check text-green-500 mr-2"></i>
                            Points de fidélité
                        </li>
                        <li class="flex items-center text-gray-600">
                            <i class="fas fa-check text-green-500 mr-2"></i>
                            Réductions spéciales
                        </li>
                        <li class="flex items-center text-gray-600">
                            <i class="fas fa-check text-green-500 mr-2"></i>
                            Priorité de réservation
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Pricing Section -->
    <div class="bg-gray-100 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900">Tarifs Transparents</h2>
                <p class="mt-4 text-xl text-gray-600">Des prix clairs et sans surprises</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Prix par km -->
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <div class="text-center">
                        <i class="fas fa-road text-4xl text-blue-600 mb-4"></i>
                        <h3 class="text-xl font-semibold mb-2">Prix par kilomètre</h3>
                        <p class="text-gray-600">À partir de</p>
                        <p class="text-3xl font-bold text-blue-600 my-4">2.5 DH/km</p>
                    </div>
                </div>

                <!-- Forfait ville à ville -->
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <div class="text-center">
                        <i class="fas fa-city text-4xl text-blue-600 mb-4"></i>
                        <h3 class="text-xl font-semibold mb-2">Forfait ville à ville</h3>
                        <p class="text-gray-600">Prix fixe</p>
                        <p class="text-3xl font-bold text-blue-600 my-4">Sur devis</p>
                    </div>
                </div>

                <!-- Tarif groupe -->
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <div class="text-center">
                        <i class="fas fa-users text-4xl text-blue-600 mb-4"></i>
                        <h3 class="text-xl font-semibold mb-2">Tarif groupe</h3>
                        <p class="text-gray-600">Par personne</p>
                        <p class="text-3xl font-bold text-blue-600 my-4">-20%</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection