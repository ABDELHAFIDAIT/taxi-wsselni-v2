@php
if(Auth::user()->role!='Driver'){
    abort(code: 403);
}
@endphp

@extends('layouts.app')

@section('style')
    {{-- <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/locales/fr.js"></script> --}}
    <style>
        #calendar {
            max-width: 1100px;
            margin: 40px auto;
        }
    </style>
@endsection

@section('dashboard')
    <section class="flex-1 p-10">
        <div class="flex justify-between items-center mb-6">
            <button type="button" onclick="openModal()" id="popup" class="cursor-pointer bg-yellow-600 rounded-sm text-white py-1 px-5">Ajouter une disponibilité</button>
            <a href="/calender"><button type="button" class="cursor-pointer bg-blue-600 rounded-sm text-white py-1 px-5">Afficher le Calendrier</button></a>
        </div>
        
        
        {{-- <div id="calendar">
            hh
        </div> --}}

        <!-- Tableau des Disponibilités -->
        <div class="pt-6">
            <h2 class="text-lg font-semibold text-gray-900 mb-4">Mes Disponibilités</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 border border-gray-300">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Date de Début
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Date de Fin
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($disponibilities as $disponibility)
                            <!-- Example row -->
                            <tr class="hover:bg-gray-50 transition-colors duration-200">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">
                                        <i class="fas fa-calendar-check text-green-500 mr-2"></i>
                                        {{ $disponibility->debut_disponibility }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">
                                        <i class="fas fa-calendar-xmark text-red-500 mr-2"></i>
                                        {{ $disponibility->fin_disponibility }}
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        
        
        <!-- Modal for Adding Availability -->
        <div id="addModal" class="modal opacity-0 pointer-events-none fixed w-full h-full top-0 left-0 flex items-center justify-center">
            <div class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50"></div>
            <div class="modal-container bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg z-50 overflow-y-auto">
                <div class="modal-content py-4 text-left px-6">
                    <div class="flex justify-between items-center pb-3">
                        <p class="text-xl font-bold">Ajouter une disponibilité</p>
                        <button onclick="closeModal()" class="modal-close text-gray-500 hover:text-gray-700">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                    <form id="availabilityForm" method="POST" action="{{ route('disponibility.create') }}" class="mb-6">
                        @csrf

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="startDate">
                                Date et heure de début
                            </label>
                            <input type="datetime-local" id="startDate" name="debut_disponibility" required
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="endDate">
                                Date et heure de fin
                            </label>
                            <input type="datetime-local" id="endDate" name="fin_disponibility" required
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        </div>
                        <div class="flex justify-end pt-2">
                            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded mr-2 hover:bg-blue-700">
                                Ajouter
                            </button>
                            <button type="button" onclick="closeModal()" class="bg-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-400">
                                Annuler
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('script')
<script>
    function openModal() {
        const modal = document.getElementById('addModal');
        modal.classList.remove('opacity-0', 'pointer-events-none');
    }

    function closeModal() {
        const modal = document.getElementById('addModal');
        modal.classList.add('opacity-0', 'pointer-events-none');
    }

</script>
@endsection