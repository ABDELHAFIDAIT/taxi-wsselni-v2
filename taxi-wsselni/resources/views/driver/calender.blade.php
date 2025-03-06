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
                locale: 'fr',
                initialView: 'timeGridWeek',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
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
        });
    </script>
</body>
</html>