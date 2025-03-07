@php
if(Auth::user()->role!='Driver'){
    abort(code: 403);
}
@endphp

@extends('layouts.app')

@section('dashboard')
    <!-- Trajets Table -->
    @if(count($trajets) > 0)
        <div class="px-5 py-10 w-[calc(100%-16rem)]">
            <div class="p-6">
                @error('date_reservation')
                    <div class="my-8 border border-red-300 bg-red-200 text-red-800 text-sm rounded-sm">
                        <h1 class="py-2 px-5">{{ $message }}</h1>
                    </div>
                @enderror
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Mes Trajets Réalisés</h2>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 border border-gray-300">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Départ
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Arrivée
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Date de Réservation
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($trajets as $trajet)
                                <!-- Example row -->
                                <tr class="hover:bg-gray-50 transition-colors duration-200">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">
                                            <i class="fas fa-map-marker-alt text-red-500 mr-2"></i>
                                            {{ $trajet->cityDepart->name }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">
                                            <i class="fas fa-map-marker-alt text-green-500 mr-2"></i>
                                            {{ $trajet->cityArrivee->name }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">
                                            <i class="far fa-calendar-alt text-blue-500 mr-2"></i>
                                            {{ $trajet->date_reservation }}
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @else
        <div class="p-10">
            <h1 class="text-red-600 text-2xl font-semibold">Aucun Trajet Réalisé pour le Moment !</h1>
        </div>
    @endif
@endsection