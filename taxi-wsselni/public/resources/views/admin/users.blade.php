@php
if(Auth::user()->role!='Admin'){
    abort(code: 403);
}
@endphp

@extends('layouts.app')


@section('dashboard')
    <!-- Passengers Table -->
    {{-- @if(count($passengers) > 0) --}}
        <div class="px-5 py-5 w-[calc(100%-16rem)]">
            <div class="p-6">
                {{-- @error('date_reservation')
                    <div class="my-8 border border-red-300 bg-red-200 text-red-800 text-sm rounded-sm">
                        <h1 class="py-2 px-5">{{ $message }}</h1>
                    </div>
                @enderror --}}
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Les Passagers Inscris</h2>
                <div class="overflow-x-auto h-[65vh] overflow-y-auto">
                    <table class="min-w-full divide-y divide-gray-200 border border-gray-300">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Photo
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Prénom
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Nom
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Email
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Téléphone
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Statut
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Réservations
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Date d'Inscription
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($passengers as $passenger)
                                <!-- Example row -->
                                <tr class="hover:bg-gray-50 transition-colors duration-200">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{-- <div class="text-sm font-medium text-gray-900">{{ $passengers->passenger->f_name }}</div> --}}
                                        @if(str_contains($passenger->photo, 'https'))
                                            <img src="{{ $passenger->photo }}" alt="Photo de profil" class="w-6 h-6 rounded-full">
                                        @else
                                            <img src="{{ asset('storage/' . $passenger->photo) }}" alt="Photo de profil" class="w-6 h-6 rounded-full">
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">{{ $passenger->f_name }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">{{ $passenger->l_name }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">
                                            <i class="fa-solid fa-envelope text-red-500 mr-2"></i>
                                            {{ $passenger->email }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">
                                            <i class="fa-solid fa-phone text-green-500 mr-2"></i>
                                            {{ $passenger->phone }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if ($passenger->status == 'Active')
                                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                Active
                                            </span>
                                        @else
                                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                Suspendu
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex items-center text-sm text-gray-900">
                                            <i class="fa-solid fa-bookmark text-purple-500 mr-2"></i>
                                            {{ $passenger->reservations_passenger_count }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">
                                            <i class="far fa-calendar-alt text-blue-500 mr-2"></i>
                                            {{ $passenger->created_at }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                        @if ($passenger->status == 'Active')
                                            <a href="/passenger/{{ $passenger->id }}/activate"><button class="px-3 py-1 bg-red-600 text-white rounded-md hover:bg-red-700 transition-colors duration-200">
                                                <i class="fas fa-times mr-1"></i>
                                                Suspendre
                                            </button></a>
                                        @else
                                            <a href="/passenger/{{ $passenger->id }}/suspend"><button class="px-3 py-1 bg-green-600 text-white rounded-md hover:bg-green-700 transition-colors duration-200">
                                                <i class="fas fa-check mr-1"></i>
                                                Activer
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
    {{-- @else
        <div class="p-10">
            <h1 class="text-red-600 text-2xl font-semibold">Aucune Réservation pour le Moment !</h1>
        </div>
    @endif --}}
@endsection