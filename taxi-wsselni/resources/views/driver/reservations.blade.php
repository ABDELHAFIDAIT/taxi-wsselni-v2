@extends('layouts.app')

@section('dashboard')
    <!-- Reservations Table -->
    @if(count($reservations) > 0)
        <div class="px-5 py-5 w-[calc(100%-16rem)]">
            <div class="p-6">
                @error('date_reservation')
                    <div class="my-8 border border-red-300 bg-red-200 text-red-800 text-sm rounded-sm">
                        <h1 class="py-2 px-5">{{ $message }}</h1>
                    </div>
                @enderror
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Mes Réservations</h2>
                <div class="overflow-x-auto h-[65vh] overflow-y-auto">
                    <table class="min-w-full divide-y divide-gray-200 border border-gray-300">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Prénom
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Nom
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Départ
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Arrivée
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Date de Réservation
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Prix
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Statut
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Payé
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($reservations as $reservation)
                                <!-- Example row -->
                                <tr class="hover:bg-gray-50 transition-colors duration-200">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">{{ $reservation->passenger->f_name }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">{{ $reservation->passenger->f_name }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">
                                            <i class="fas fa-map-marker-alt text-red-500 mr-2"></i>
                                            {{ $reservation->cityDepart->name }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">
                                            <i class="fas fa-map-marker-alt text-green-500 mr-2"></i>
                                            {{ $reservation->cityArrivee->name }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">
                                            <i class="far fa-calendar-alt text-blue-500 mr-2"></i>
                                            {{ $reservation->date_reservation }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">
                                            <i class="fa-solid fa-coins text-orange-500 mr-2"></i>
                                            {{ $reservation->price }} MAD
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if ($reservation->status == 'accepted')
                                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                Acceptée
                                            </span>
                                        @elseif ($reservation->status == 'refused')
                                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                Refusée
                                            </span>
                                        @else
                                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                En Attente
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex items-center text-sm text-gray-900">
                                            @if ($reservation->isPayed)
                                                <i class="fas fa-check-circle text-green-500 mr-2"></i>
                                                Oui
                                            @else
                                                <i class="fas fa-times-circle text-red-500 mr-2"></i>
                                                Non
                                            @endif
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                        @if ($reservation->status == 'accepted')
                                            <a href="/reservation/{{ $reservation->id }}/cancel"><button class="px-3 py-1 bg-red-600 text-white rounded-md hover:bg-red-700 transition-colors duration-200">
                                                <i class="fas fa-times mr-1"></i>
                                                Annuler
                                            </button></a>
                                        @elseif($reservation->status == 'refused')
                                            <a href="/reservation/{{ $reservation->id }}/accept"><button class="px-3 py-1 bg-green-600 text-white rounded-md hover:bg-green-700 transition-colors duration-200">
                                                <i class="fas fa-check mr-1"></i>
                                                Accepter
                                            </button></a>
                                        @else
                                            <a href="/reservation/{{ $reservation->id }}/accept"><button class="px-3 py-1 bg-green-600 text-white rounded-md hover:bg-green-700 transition-colors duration-200">
                                                <i class="fas fa-check mr-1"></i>
                                                Accepter
                                            </button></a>
                                            <a href="/reservation/{{ $reservation->id }}/cancel"><button class="px-3 py-1 bg-red-600 text-white rounded-md hover:bg-red-700 transition-colors duration-200">
                                                <i class="fas fa-times mr-1"></i>
                                                Refuser
                                            </button></a>
                                        @endif
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
            <h1 class="text-red-600 text-2xl font-semibold">Aucune Réservation pour le Moment !</h1>
        </div>
    @endif
@endsection