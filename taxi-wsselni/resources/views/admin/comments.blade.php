@php
if(Auth::user()->role!='Admin'){
    abort(code: 403);
}
@endphp

@extends('layouts.app')


@section('dashboard')
    <div class="w-[calc(100%-16rem)] grid grid-cols-2 gap-5 p-10 h-[85vh] overflow-y-auto">
            @foreach ($reactions as $reaction)
                <div>
                    <!-- Carte de commentaire -->
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden transform transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
                        <!-- En-tête avec image et informations du passager -->
                        <div class="p-6 pb-2">
                            <div class="flex items-center space-x-4">
                            <div class="relative">
                                @if (str_contains($reaction->Passenger->photo,'http'))
                                    <img src="{{ $reaction->passenger->photo }}" alt="Photo du passager" class="h-16 w-16 rounded-full object-cover border-2 border-indigo-100 shadow">
                                @else
                                    <img src="{{ asset('storage/'. $reaction->passenger->photo) }}" alt="Photo du passager" class="h-16 w-16 rounded-full object-cover border-2 border-indigo-100 shadow">
                                @endif
                                <span class="absolute bottom-0 right-0 h-4 w-4 bg-green-400 rounded-full border-2 border-white"></span>
                            </div>
                            
                            <div class="flex-1">
                                <h3 class="font-bold text-lg text-gray-800">{{ $reaction->passenger->f_name. ' ' .$reaction->passenger->l_name}}</h3>
                                <div class="flex items-center mt-1">
                                <!-- Étoiles du rating -->
                                <div class="flex mr-2">
                                    @for ($i = 0; $i < $reaction->rating; $i++)
                                        <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118l-2.799-2.034c-.784-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                        </svg>
                                    @endfor
                                    @for ($i = 0; $i < 5-$reaction->rating; $i++)
                                        <svg class="w-5 h-5 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118l-2.799-2.034c-.784-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                        </svg>
                                    @endfor
                                </div>
                                <span class="text-xs text-gray-500 font-medium">{{ \Carbon\Carbon::parse($reaction->created_at)->translatedFormat('d F Y') }}</span>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Contenu du commentaire -->
                        <div class="px-6 py-4">
                            <p class="text-gray-700 leading-relaxed">{{ $reaction->comment }}</p>
                        </div>
                        
                        
                        <div class="absolute top-5 right-3 flex gap-5">
                            @if($reaction->status == 'pending')
                                <a href="/reaction/{{ $reaction->id }}/accept"><i class="fa-solid fa-square-check text-green-500 text-xl"></i></a>
                                <a href="/reaction/{{ $reaction->id }}/refuse"><i class="fa-solid fa-ban text-red-600 text-xl"></i></a>
                            @elseif($reaction->status == 'accepted')
                                <a href="/reaction/{{ $reaction->id }}/refuse"><i class="fa-solid fa-ban text-red-600 text-xl"></i></a>
                            @else
                                <a href="/reaction/{{ $reaction->id }}/accept"><i class="fa-solid fa-square-check text-green-500 text-xl"></i></a>
                            @endif
                        </div>
                        
                        <!-- Pied de carte -->
                        <div class="px-6 py-3 bg-gray-50 flex justify-between items-center">
                            <div class="flex space-x-2">
                                <button class="flex items-center text-gray-500 hover:text-blue-600 text-sm">
                                    Chauffeur : {{ $reaction->driver->f_name.' '.$reaction->driver->l_name }}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>    
        @endforeach
    </div>
@endsection