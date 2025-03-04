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
    <style>
        *{
            font-family: 'Poppins', sans-serif;
        }

        .dropdown-menu {
            display: none;
        }

        .dropdown:hover .dropdown-menu {
            display: block;
        }
    </style>
    @yield('style')
</head>
<body class="bg-gray-50">
    @guest
        <!-- Navigation Guest -->
        <nav class="bg-white shadow-lg">
            <div class="max-w-7xl mx-auto px-4">
                <div class="flex justify-between items-center h-16">
                    <!-- Logo -->
                    <div class="flex items-center">
                        <a href="{{ route('homepage') }}" class="flex items-center">
                            <img src="{{ asset('logo.png') }}" alt="Logo" class="h-16">
                        </a>
                    </div>

                    <!-- Navigation Links - Desktop -->
                    <div class="hidden md:flex items-center space-x-8">
                        <a href="{{ route('homepage') }}" class="text-gray-700 hover:text-blue-600 font-medium">Accueil</a>
                        <a href="{{ route('services') }}" class="text-gray-700 hover:text-blue-600 font-medium">Services</a>
                        <a href="{{ route('chauffeurs') }}" class="text-gray-700 hover:text-blue-600 font-medium">Chauffeurs</a>
                        <div class="flex items-center space-x-4">
                            <a href="{{ route('show.login') }}" class="px-4 py-2 rounded-md text-white bg-blue-600 hover:bg-blue-700 transition duration-300">Se Connecter</a>
                            <a href="{{ route('show.register') }}" class="px-4 py-2 rounded-md text-blue-600 border border-blue-600 hover:bg-blue-50 transition duration-300">S'inscrire</a>
                        </div>
                    </div>

                    <!-- Mobile menu button -->
                    <div class="md:hidden">
                        <button type="button" class="text-gray-700 hover:text-blue-600" aria-label="Toggle menu">
                            <i class="fas fa-bars text-2xl"></i>
                        </button>
                    </div>
                </div>

                <!-- Mobile Navigation Menu -->
                <div class="md:hidden hidden">
                    <div class="px-2 pt-2 pb-3 space-y-1">
                        <a href="{{ route('homepage') }}" class="block px-3 py-2 text-gray-700 hover:text-blue-600 hover:bg-blue-50 rounded-md">Accueil</a>
                        <a href="{{ route('services') }}" class="block px-3 py-2 text-gray-700 hover:text-blue-600 hover:bg-blue-50 rounded-md">Services</a>
                        <a href="{{ route('chauffeurs') }}" class="block px-3 py-2 text-gray-700 hover:text-blue-600 hover:bg-blue-50 rounded-md">Chauffeurs</a>
                        <div class="space-y-2 pt-2">
                            <a href="{{ route('show.login') }}" class="block px-3 py-2 text-center text-white bg-blue-600 hover:bg-blue-700 rounded-md">Se Connecter</a>
                            <a href="{{ route('show.register') }}" class="block px-3 py-2 text-center text-blue-600 border border-blue-600 hover:bg-blue-50 rounded-md">S'inscrire</a>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    @endguest

    @auth
        @if(Auth::user()->role === 'Passenger')
            <!-- Navigation -->
            <nav class="bg-white shadow-lg">
                <div class="max-w-7xl mx-auto px-4">
                    <div class="flex justify-between items-center h-16">
                        <!-- Logo -->
                        <div class="flex items-center">
                            <a href="{{ route('homepage') }}" class="flex items-center">
                                <img src="{{ asset('logo.png') }}" alt="Logo" class="h-16">
                            </a>
                        </div>

                        <!-- Navigation Links - Desktop -->
                        <div class="hidden md:flex items-center space-x-8">
                            <a href="{{ route('homepage') }}" class="text-gray-700 hover:text-blue-600 font-medium">Accueil</a>
                            <a href="{{ route('services') }}" class="text-gray-700 hover:text-blue-600 font-medium">Services</a>
                            <a href="{{ route('chauffeurs') }}" class="text-gray-700 hover:text-blue-600 font-medium">Chauffeurs</a>
                            
                            <!-- Profile Dropdown -->
                            <div class="dropdown relative">
                                <button class="flex items-center space-x-3 focus:outline-none">
                                    <div class="flex items-center space-x-3">
                                        <img src="{{ asset('storage/' . Auth::user()->photo) }}" alt="Photo de profil" class="w-10 h-10 rounded-full border-2 border-blue-600">
                                        <i class="fas fa-chevron-down text-gray-500 text-sm"></i>
                                    </div>
                                </button>
                                <!-- Dropdown menu -->
                                <div class="dropdown-menu absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50">
                                    <a href="{{ route('passenger.profile') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600">
                                        <i class="fas fa-user mr-2"></i>
                                        Profile
                                    </a>
                                    <div class="border-t border-gray-100"></div>
                                    <form action="{{ route('logout') }}" method="POST" class="block px-4 py-2 text-sm text-red-600 hover:bg-red-50 cursor-pointer">
                                        @csrf
                                        <button><i class="fas fa-sign-out-alt mr-2"></i>
                                        Déconnexion</button>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Mobile menu button -->
                        <div class="md:hidden">
                            <button type="button" class="text-gray-700 hover:text-blue-600" aria-label="Toggle menu">
                                <i class="fas fa-bars text-2xl"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Mobile Navigation Menu -->
                    <div class="md:hidden hidden">
                        <div class="px-2 pt-2 pb-3 space-y-1">
                            <a href="{{ route('homepage') }}" class="block px-3 py-2 text-gray-700 hover:text-blue-600 hover:bg-blue-50 rounded-md">Accueil</a>
                            <a href="{{ route('services') }}" class="block px-3 py-2 text-gray-700 hover:text-blue-600 hover:bg-blue-50 rounded-md">Services</a>
                            <a href="{{ route('chauffeurs') }}" class="block px-3 py-2 text-gray-700 hover:text-blue-600 hover:bg-blue-50 rounded-md">Chauffeurs</a>
                            
                            <!-- Mobile Profile Links -->
                            <div class="border-t border-gray-200 pt-4 pb-3">
                                <div class="flex items-center px-3">
                                    <div class="flex-shrink-0">
                                        <img src="{{ asset('storage/' . Auth::user()->photo) }}" alt="Photo de profil" class="w-10 h-10 rounded-full">
                                    </div>
                                </div>
                                <div class="mt-3 space-y-1">
                                    <a href="{{ route('passenger.profile') }}" class="block px-3 py-2 text-gray-700 hover:text-blue-600 hover:bg-blue-50 rounded-md">
                                        <i class="fas fa-user mr-2"></i>
                                        Profile
                                    </a>
                                    <a href="/" class="block px-3 py-2 text-gray-700 hover:text-blue-600 hover:bg-blue-50 rounded-md">
                                        <i class="fas fa-ticket-alt mr-2"></i>
                                        Réservations
                                    </a>
                                    <a href="{{ route('logout') }}" class="block px-3 py-2 text-red-600 hover:bg-red-50 rounded-md">
                                        <i class="fas fa-sign-out-alt mr-2"></i>
                                        Déconnexion
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
        @endif

        @if(Auth::user()->role === 'Driver')
            <!-- Navigation -->
            <nav class="bg-white shadow-lg">
                <div class="max-w-7xl mx-auto px-4">
                    <div class="flex justify-between items-center h-16">
                        <div class="flex items-center">
                            <a href="{{ route('driver.dashboard') }}" class="flex items-center">
                                <img src="{{ asset('logo.png') }}" alt="Logo" class="h-16">
                            </a>
                        </div>
                        <!-- Profile Dropdown -->
                        <div class="dropdown relative">
                            <button class="flex items-center space-x-3 focus:outline-none">
                                <div class="flex items-center space-x-3">
                                    <img src="{{ asset('storage/' . Auth::user()->photo) }}" alt="Photo de profil" class="w-10 h-10 rounded-full border-2 border-blue-600">
                                    <i class="fas fa-chevron-down text-gray-500 text-sm"></i>
                                </div>
                            </button>
                            <!-- Dropdown menu -->
                            <div class="dropdown-menu absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50">
                                <form action="{{ route('logout') }}" method="POST" class="block px-4 py-2 text-sm text-red-600 hover:bg-red-50 cursor-pointer">
                                    @csrf
                                    <button><i class="fas fa-sign-out-alt mr-2"></i>
                                    Déconnexion</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
        @endif
    @endauth


    <main>
        @auth
            @if(Auth::user()->role === 'Driver')
                <section class="flex">
                    <!-- Sidebar -->
                    <div class="hidden md:flex md:flex-shrink-0">
                        <div class="flex flex-col w-64">
                            <div class="flex flex-col h-0 flex-1 bg-white shadow">
                                <div class="flex-1 flex flex-col pt-5 pb-4 overflow-y-auto">
                                    <nav class="flex-1 px-2 space-y-2">
                                        <a href="{{ route('driver.dashboard') }}" class="group flex items-center px-2 py-2 text-sm font-medium text-gray-600 hover:bg-gray-50 hover:text-gray-900 rounded-md">
                                            <i class="fas fa-tachometer-alt mr-3"></i>
                                            Tableau de bord
                                        </a>
                                        <a href="{{ route('driver.reservations') }}" class="group flex items-center px-2 py-2 text-sm font-medium text-gray-600 hover:bg-gray-50 hover:text-gray-900 rounded-md">
                                            <i class="fa-regular fa-bookmark mr-3"></i>
                                            Réservations
                                        </a>
                                        <a href="{{ route('driver.trajets') }}" class="group flex items-center px-2 py-2 text-sm font-medium text-gray-600 hover:bg-gray-50 hover:text-gray-900 rounded-md">
                                            <i class="fas fa-route mr-3"></i>
                                            Historique des Trajets
                                        </a>
                                        <a href="{{ route('driver.disponibility') }}" class="group flex items-center px-2 py-2 text-sm font-medium text-gray-600 hover:bg-gray-50 hover:text-gray-900 rounded-md">
                                            <i class="fa-regular fa-calendar mr-3"></i>
                                            Disponibilité
                                        </a>
                                        <a href="{{ route('driver.profile') }}" class="group flex items-center px-2 py-2 text-sm font-medium text-gray-600 hover:bg-gray-50 hover:text-gray-900 rounded-md">
                                            <i class="fa-solid fa-user mr-3"></i>
                                            Profile
                                        </a>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Main Content -->
                    @yield('dashboard')
                </section>
            @endif
        @endauth


        @yield('content')
    </main>


    <!-- Footer -->
    @auth
        @if(Auth::user()->role != 'Driver')
            <footer class="bg-gray-800">
                <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                        <div>
                            <h3 class="text-white text-lg font-semibold mb-4">À propos</h3>
                            <ul class="space-y-2">
                                <li><a href="#" class="text-gray-300 hover:text-white">Qui sommes-nous</a></li>
                                <li><a href="#" class="text-gray-300 hover:text-white">Notre mission</a></li>
                                <li><a href="#" class="text-gray-300 hover:text-white">Carrières</a></li>
                            </ul>
                        </div>
                        <div>
                            <h3 class="text-white text-lg font-semibold mb-4">Services</h3>
                            <ul class="space-y-2">
                                <li><a href="#" class="text-gray-300 hover:text-white">Réservation</a></li>
                                <li><a href="#" class="text-gray-300 hover:text-white">Tarifs</a></li>
                                <li><a href="#" class="text-gray-300 hover:text-white">Zones desservies</a></li>
                            </ul>
                        </div>
                        <div>
                            <h3 class="text-white text-lg font-semibold mb-4">Chauffeurs</h3>
                            <ul class="space-y-2">
                                <li><a href="#" class="text-gray-300 hover:text-white">Devenir chauffeur</a></li>
                                <li><a href="#" class="text-gray-300 hover:text-white">Avantages</a></li>
                                <li><a href="#" class="text-gray-300 hover:text-white">Formation</a></li>
                            </ul>
                        </div>
                        <div>
                            <h3 class="text-white text-lg font-semibold mb-4">Contact</h3>
                            <ul class="space-y-2">
                                <li><a href="#" class="text-gray-300 hover:text-white">Support</a></li>
                                <li><a href="#" class="text-gray-300 hover:text-white">FAQ</a></li>
                                <li><a href="#" class="text-gray-300 hover:text-white">Urgence</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="mt-8 border-t border-gray-700 pt-8 flex flex-col md:flex-row justify-between items-center">
                        <div class="flex space-x-6 mb-4 md:mb-0">
                            <a href="#" class="text-gray-400 hover:text-white">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="#" class="text-gray-400 hover:text-white">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="#" class="text-gray-400 hover:text-white">
                                <i class="fab fa-instagram"></i>
                            </a>
                        </div>
                        <p class="text-gray-400 text-sm">
                            © 2025 Taxi Wsselni. Tous droits réservés.
                        </p>
                    </div>
                </div>
            </footer>
        @endif
    @endauth

    @guest
        <footer class="bg-gray-800">
            <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                    <div>
                        <h3 class="text-white text-lg font-semibold mb-4">À propos</h3>
                        <ul class="space-y-2">
                            <li><a href="#" class="text-gray-300 hover:text-white">Qui sommes-nous</a></li>
                            <li><a href="#" class="text-gray-300 hover:text-white">Notre mission</a></li>
                            <li><a href="#" class="text-gray-300 hover:text-white">Carrières</a></li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="text-white text-lg font-semibold mb-4">Services</h3>
                        <ul class="space-y-2">
                            <li><a href="#" class="text-gray-300 hover:text-white">Réservation</a></li>
                            <li><a href="#" class="text-gray-300 hover:text-white">Tarifs</a></li>
                            <li><a href="#" class="text-gray-300 hover:text-white">Zones desservies</a></li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="text-white text-lg font-semibold mb-4">Chauffeurs</h3>
                        <ul class="space-y-2">
                            <li><a href="#" class="text-gray-300 hover:text-white">Devenir chauffeur</a></li>
                            <li><a href="#" class="text-gray-300 hover:text-white">Avantages</a></li>
                            <li><a href="#" class="text-gray-300 hover:text-white">Formation</a></li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="text-white text-lg font-semibold mb-4">Contact</h3>
                        <ul class="space-y-2">
                            <li><a href="#" class="text-gray-300 hover:text-white">Support</a></li>
                            <li><a href="#" class="text-gray-300 hover:text-white">FAQ</a></li>
                            <li><a href="#" class="text-gray-300 hover:text-white">Urgence</a></li>
                        </ul>
                    </div>
                </div>
                <div class="mt-8 border-t border-gray-700 pt-8 flex flex-col md:flex-row justify-between items-center">
                    <div class="flex space-x-6 mb-4 md:mb-0">
                        <a href="#" class="text-gray-400 hover:text-white">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white">
                            <i class="fab fa-instagram"></i>
                        </a>
                    </div>
                    <p class="text-gray-400 text-sm">
                        © 2025 Taxi Wsselni. Tous droits réservés.
                    </p>
                </div>
            </div>
        </footer>
    @endguest

    <script>
        // Toggle mobile menu
        const mobileMenuButton = document.querySelector('button[aria-label="Toggle menu"]');
        const mobileMenu = document.querySelector('.md\\:hidden.hidden');

        mobileMenuButton.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });
    </script>

    @yield('script')
</body>
</html>