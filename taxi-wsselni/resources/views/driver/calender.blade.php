<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Taxi Wsselni</title>
    <link rel="icon" type="image/png" href="{{ asset('taxi.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/locales/fr.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    <style>
        *{
            font-family: 'Poppins', sans-serif;
        }

        .dropdown-menu {
            display: none;
            cursor: pointer;
        }

        .dropdown:hover .dropdown-menu {
            display: block;
            cursor: pointer;
        }

        *::-webkit-scrollbar {
            width: 2px;
            background-color: hsla(0, 2%, 81%, 0);
        }
        
        *::-webkit-scrollbar-thumb{
            background-color: hsla(221, 83%, 53%, 0);
        }
    </style>
</head>
<body class="bg-gray-50">
    <section class="flex justify-center items-center p-10">
        <a href="{{ route('driver.disponibility') }}">
            <img src="{{ asset('logo.png') }}" alt="Logo de Taxi Wsselni" class="h-16">
        </a>
    </section>

    <section class="p-10">
        <div id="calendar"></div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                // Paramètres de base
                locale: 'fr',
                initialView: 'timeGridWeek',
                height: 'auto',
                themeSystem: 'bootstrap5',
                
                // En-tête et barre d'outils
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
                },
                
                // Configuration de l'affichage
                dayMaxEvents: true, // Permet d'afficher "more" pour les jours avec beaucoup d'événements
                navLinks: true, // Rend les jours et les semaines cliquables
                businessHours: {
                    daysOfWeek: [1, 2, 3, 4, 5], // Lundi - Vendredi
                    startTime: '08:00',
                    endTime: '18:00',
                },
                nowIndicator: true, // Affiche une ligne rouge pour l'heure actuelle
                
                // Personnalisation des vues
                views: {
                    timeGridWeek: {
                        slotDuration: '00:30:00',
                        slotLabelFormat: {
                            hour: '2-digit',
                            minute: '2-digit',
                            hour12: false
                        }
                    },
                    dayGridMonth: {
                        dayHeaderFormat: { weekday: 'short' }
                    }
                },
                
                // Personnalisation des événements
                eventTimeFormat: {
                    hour: '2-digit',
                    minute: '2-digit',
                    hour12: false
                },
                eventDisplay: 'block',
                eventClassNames: 'fc-event-custom',
                
                // Récupération des événements
                events: function(fetchInfo, successCallback, failureCallback) {
                    fetch('/disponibilites')
                        .then(response => response.json())
                        .then(data => {
                            console.log('Disponibilités reçues:', data);
                            successCallback(data);
                        })
                        .catch(error => {
                            console.error('Erreur chargement événements:', error);
                            failureCallback(error);
                        });
                }
            });

            calendar.render();
            
            const style = document.createElement('style');
            style.textContent = `
                :root {
                    --fc-border-color: #e5e7eb;
                    --fc-today-bg-color: rgba(74, 144, 226, 0.1);
                    --fc-event-bg-color: #4a90e2;
                    --fc-event-border-color: #4a90e2;
                }
                
                #calendar {
                    font-family: 'Helvetica Neue', Arial, sans-serif;
                    max-width: 1200px;
                    margin: 0 auto;
                    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                    border-radius: 8px;
                    padding: 16px;
                }
                
                .fc-header-toolbar {
                    margin-bottom: 1.5em !important;
                }
                
                .fc-toolbar-title {
                    font-weight: 600 !important;
                }
                
                .fc-button-primary {
                    background-color: #4a90e2 !important;
                    border-color: #4a90e2 !important;
                    text-transform: uppercase;
                    font-size: 0.8em;
                    padding: 6px 12px;
                }
                
                .fc-button-primary:hover {
                    background-color: #3a80d2 !important;
                    border-color: #3a80d2 !important;
                }
                
                .fc-event-custom {
                    border-radius: 4px;
                    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
                    font-size: 0.85em;
                }
                
                .fc-day-today {
                    font-weight: bold;
                }
                
                .fc-timegrid-slot, .fc-timegrid-axis {
                    height: 40px !important;
                }
                
                .fc-list-day-cushion {
                    background-color: #f8f9fa !important;
                }
            `;
            document.head.appendChild(style);
        });
    </script>
</body>
</html>