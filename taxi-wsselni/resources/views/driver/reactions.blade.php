@extends('layouts.app')

@section('dashboard')
    <div class="w-[calc(100%-16rem)] grid grid-cols-2 gap-5 p-10 h-[85vh] overflow-y-auto">
            @foreach ($reactions as $reaction)
            <div class="">
                
                <!-- Carte de commentaire -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden transform transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
                    <!-- En-tête avec image et informations du passager -->
                    <div class="p-6 pb-2">
                        <div class="flex items-center space-x-4">
                        <div class="relative">
                            @if (str_contains($reaction->Passenger->photo,'http'))
                                <img src="{{ $reaction->Passenger->photo }}" alt="Photo du passager" class="h-16 w-16 rounded-full object-cover border-2 border-indigo-100 shadow">
                            @else
                                <img src="{{ asset('storage/'. $reaction->Passenger->photo) }}" alt="Photo du passager" class="h-16 w-16 rounded-full object-cover border-2 border-indigo-100 shadow">
                            @endif
                            <span class="absolute bottom-0 right-0 h-4 w-4 bg-green-400 rounded-full border-2 border-white"></span>
                        </div>
                        
                        <div class="flex-1">
                            <h3 class="font-bold text-lg text-gray-800">{{ $reaction->Passenger->f_name. ' ' .$reaction->Passenger->l_name}}</h3>
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
                    
                    <!-- Pied de carte -->
                    <div class="px-6 py-3 bg-gray-50 flex justify-between items-center">
                        <div class="flex space-x-2">
                        <button class="flex items-center text-gray-500 hover:text-blue-600 text-sm">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5"></path>
                            </svg>
                            Utile
                        </button>
                        <button class="flex items-center text-gray-500 hover:text-blue-600 text-sm">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path>
                            </svg>
                            Répondre
                        </button>
                        </div>
                        <div class="text-xs text-gray-500 italic">Trajet #A2756</div>
                    </div>
                    </div>
                </div>
            </div>    
        @endforeach
    </div>
@endsection