<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Smoke House</title>

    @vite('resources/css/app.css')
</head>
<header class="bg-gray-900 text-white p-5 flex justify-between items-center">
    <a href="{{ route('home')}}"><img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-25 h-auto"></a>
    <button id="burger-btn" class=" flex flex-col space-y-1 z-50 relative md:hidden">
        <span class="burger-line block w-6 h-0.5 bg-white"></span>
        <span class="burger-line block w-6 h-0.5 bg-white"></span>
        <span class="burger-line block w-6 h-0.5 bg-white"></span>
    </button>
    <nav class="hidden md:flex space-x-4">
        <div class="text-center">
            <a href="{{ route('catalog') }}" target="_blank" class="relative text-2xl font-bold text-white pb-1 before:absolute before:w-full before:h-[3px] before:bg-white before:left-0 before:bottom-0 before:scale-x-0 before:origin-left before:transition-transform before:duration-300 hover:before:scale-x-100">ТОВАРЫ</a>
        </div>
        @auth()
            <div class="text-center">
            <a href="{{ route('admin.index') }}">
              <svg fill="#ffffff" height="25" width="25" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 402.161 402.161" xml:space="preserve" stroke="#ffffff"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <g> <g> <path d="M201.08,49.778c-38.794,0-70.355,31.561-70.355,70.355c0,18.828,7.425,40.193,19.862,57.151 c14.067,19.181,32,29.745,50.493,29.745c18.494,0,36.426-10.563,50.494-29.745c12.437-16.958,19.862-38.323,19.862-57.151 C271.436,81.339,239.874,49.778,201.08,49.778z M201.08,192.029c-13.396,0-27.391-8.607-38.397-23.616 c-10.46-14.262-16.958-32.762-16.958-48.28c0-30.523,24.832-55.355,55.355-55.355s55.355,24.832,55.355,55.355 C256.436,151.824,230.372,192.029,201.08,192.029z"></path> <path d="M201.08,0C109.387,0,34.788,74.598,34.788,166.292c0,91.693,74.598,166.292,166.292,166.292 s166.292-74.598,166.292-166.292C367.372,74.598,292.773,0,201.08,0z M201.08,317.584c-30.099-0.001-58.171-8.839-81.763-24.052 c0.82-22.969,11.218-44.503,28.824-59.454c6.996-5.941,17.212-6.59,25.422-1.615c8.868,5.374,18.127,8.099,27.52,8.099 c9.391,0,18.647-2.724,27.511-8.095c8.201-4.97,18.39-4.345,25.353,1.555c17.619,14.93,28.076,36.526,28.895,59.512 C259.25,308.746,231.178,317.584,201.08,317.584z M296.981,283.218c-3.239-23.483-15.011-45.111-33.337-60.64 c-11.89-10.074-29.1-11.256-42.824-2.939c-12.974,7.861-26.506,7.86-39.483-0.004c-13.74-8.327-30.981-7.116-42.906,3.01 c-18.31,15.549-30.035,37.115-33.265,60.563c-33.789-27.77-55.378-69.868-55.378-116.915C49.788,82.869,117.658,15,201.08,15 c83.423,0,151.292,67.869,151.292,151.292C352.372,213.345,330.778,255.448,296.981,283.218z"></path> <path d="M302.806,352.372H99.354c-4.142,0-7.5,3.358-7.5,7.5c0,4.142,3.358,7.5,7.5,7.5h203.452c4.142,0,7.5-3.358,7.5-7.5 C310.307,355.73,306.948,352.372,302.806,352.372z"></path> <path d="M302.806,387.161H99.354c-4.142,0-7.5,3.358-7.5,7.5c0,4.142,3.358,7.5,7.5,7.5h203.452c4.142,0,7.5-3.358,7.5-7.5 C310.307,390.519,306.948,387.161,302.806,387.161z"></path> </g> </g> </g> </g></svg>
            </a>
        </div>
        @endauth
        <div class="text-center">
            <a href="https://t.me/smoke_house55" target="_blank" class="tg-logo">
            <img class="w-[25px] h-auto" src="{{ asset('images/Telegram_logo.svg') }}" alt="">
        </a>
        </div>
    </nav>
</header>
<div id="mobile-menu" class="fixed top-0 left-0 w-full h-full bg-gray-900 text-white flex flex-col items-center justify-center transform -translate-y-full transition-transform duration-500 z-40">
    <!-- Кнопка закрытия -->
    <ul class="space-y-6 flex flex-col items-center text-center text-2xl">
        <li>
            <div class="text-center">
                <a href="#" class="mobile-link" target="_blank">О НАС</a>
            </div>
        </li>
        <li>
            <div class="text-center">
                <a href="#" target="_blank" class="mobile-link">ТОВАРЫ</a>
            </div>
        </li>
        @auth()
        <li>
            <div class="text-center">
                <a href="{{ route('admin.index') }}" class="mobile-link">
                    Админ-панель
                </a>
            </div>
        </li>
        @endauth
        <li>
            <div class="text-center">
                <a href="https://t.me/smoke_house55" target="_blank" class="mobile-link">
                    <img class="w-10 h-auto" src="{{ asset('images/Telegram_logo.svg') }}" alt="">
                </a>
            </div>
        </li>
    </ul>
</div>
<body>
    @yield('content')
    @vite('resources/js/app.js')
</body>
<footer class="mt-8 text-center text-gray-600">
    <p>&copy; 2025 SMOKEHOUSE</p>
</footer>
</html>
