@php
if(Auth::user()->role!='Admin'){
    abort(code: 403);
}
@endphp

@extends('layouts.app')


@section('dashboard')
    <div class="w-[calc(100%-16rem)] grid grid-cols-2 gap-5 p-10 h-[85vh] overflow-y-auto">
        @if(is_object($drivers) || is_array($drivers))
            @foreach ($drivers as $driver)
                <div class="bg-white rounded-lg shadow-lg overflow-hidden relative">
                    <div class="p-6">
                        <div class="flex items-center">
                            @if (str_contains($driver->photo,'http'))
                                <img src="{{ $driver->photo }}" alt="Driver" class="w-20 h-20 rounded-full border-4 border-blue-100">
                            @else
                                <img src="{{ asset('storage/' . $driver->photo) }}" alt="Driver" class="w-20 h-20 rounded-full border-4 border-blue-100">
                            @endif
                            <div class="ml-4">
                                <h3 class="text-xl font-semibold text-gray-900">{{ $driver->f_name . ' ' . $driver->l_name }}</h3>
                                <p class="text-sm text-gray-500">Membre depuis {{ \Carbon\Carbon::parse($driver->created_at)->translatedFormat('F Y') }}</p>
                                <p class="absolute top-5 right-2">
                                    @if ($driver->status == 'Active')
                                        <span class="px-3 py-1 inline-flex text-xs font-medium rounded-full bg-green-100 text-green-800">
                                            Active
                                        </span>
                                    @else
                                        <span class="px-3 py-1 inline-flex text-xs font-medium rounded-full bg-red-100 text-red-800">
                                            Suspendu
                                        </span>
                                    @endif
                                </p>
                            </div>
                        </div>
                        <div class="mt-4 space-y-2">
                            <div class="flex items-center text-gray-600">
                                <i class="fa-solid fa-envelope mr-2 text-purple-600"></i>
                                <span>{{ $driver->email}}</span>
                            </div>
                            <div class="flex items-center text-gray-600">
                                <i class="fas fa-phone mr-2 text-blue-600"></i>
                                <span>{{ $driver->phone}}</span>
                            </div>
                            <div class="flex items-center text-gray-600">
                                <i class="fa-solid fa-taxi text-yellow-400 pr-3"></i>
                                <span>{{ $driver->driver->vehicule }}</span>
                            </div>
                            <div class="flex items-center text-gray-600">
                                <i class="fa-solid fa-city text-red-600 pr-3"></i>
                                <span>{{ $driver->driver->city->name }}</span>
                            </div>
                            <div class="flex items-center text-gray-600">
                                <i class="fa-solid fa-bookmark text-green-600 pr-3"></i>
                                <span>{{ $driver->reservations_driver_count }} Réservations</span>
                            </div>
                        </div>
                        <div class="mt-5 flex justify-end">
                            @if ($driver->status == 'Active')
                                <a href="/passenger/{{ $driver->id }}/suspend"><button class="px-3 py-1 bg-red-600 text-white rounded-md hover:bg-red-700 transition-colors duration-200">
                                    <i class="fas fa-times mr-1"></i>
                                    Suspendre
                                </button></a>
                            @else
                                <a href="/passenger/{{ $driver->id }}/activate"><button class="px-3 py-1 bg-green-600 text-white rounded-md hover:bg-green-700 transition-colors duration-200">
                                    <i class="fas fa-check mr-1"></i>
                                    Activer
                                </button></a>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <h1 class="text-red-600 text-center col-span-3 font-semibold text-2xl">Aucun chauffeur trouvé</h1>
        @endif
    </div>
@endsection