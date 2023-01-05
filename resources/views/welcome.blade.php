@extends('layouts.guest')

@section('content')
    <div class="bg-gray-50">
        <div class="relative overflow-hidden">
            <div class="absolute inset-y-0 w-full h-full" aria-hidden="true">
                <div class="relative h-full">
                    <svg class="absolute transform right-full translate-y-1/3 translate-x-1/4 sm:translate-x-1/2 md:translate-y-1/2 lg:translate-x-full"
                        width="404" height="784" fill="none" viewBox="0 0 404 784">
                        <defs>
                            <pattern id="e229dbec-10e9-49ee-8ec3-0286ca089edf" x="0" y="0" width="20"
                                height="20" patternUnits="userSpaceOnUse">
                                <rect x="0" y="0" width="4" height="4" class="text-gray-200"
                                    fill="currentColor" />
                            </pattern>
                        </defs>
                        <rect width="404" height="784" fill="url(#e229dbec-10e9-49ee-8ec3-0286ca089edf)" />
                    </svg>
                    <svg class="absolute transform left-full -translate-y-3/4 -translate-x-1/4 sm:-translate-x-1/2 md:-translate-y-1/2 lg:-translate-x-3/4"
                        width="404" height="784" fill="none" viewBox="0 0 404 784">
                        <defs>
                            <pattern id="d2a68204-c383-44b1-b99f-42ccff4e5365" x="0" y="0" width="20"
                                height="20" patternUnits="userSpaceOnUse">
                                <rect x="0" y="0" width="4" height="4" class="text-gray-200"
                                    fill="currentColor" />
                            </pattern>
                        </defs>
                        <rect width="404" height="784" fill="url(#d2a68204-c383-44b1-b99f-42ccff4e5365)" />
                    </svg>
                </div>
            </div>

            <div class="relative pt-6 pb-16 sm:pb-24">
                <div>
                    <div class="px-4 mx-auto max-w-7xl sm:px-6">
                        <nav class="relative flex items-center justify-between sm:h-10 md:justify-center"
                            aria-label="Global">
                            <div class="flex items-center flex-1 md:absolute md:inset-y-0 md:left-0">
                                <div class="flex items-center justify-between w-full md:w-auto">
                                    <a href="#">
                                        <span class="sr-only">Your Company</span>
                                        <img class="w-auto h-8 sm:h-10" src="{{ global_asset('img/logo.png') }}"
                                            alt="">
                                    </a>
                                    <div class="flex items-center -mr-2 md:hidden">
                                        <button type="button"
                                            class="inline-flex items-center justify-center p-2 text-gray-400 rounded-md bg-gray-50 hover:bg-gray-100 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500"
                                            aria-expanded="false">
                                            <span class="sr-only">Open main menu</span>
                                            <!-- Heroicon name: outline/bars-3 -->
                                            <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="hidden md:flex md:space-x-10">
                                <a href="#" class="font-medium text-gray-500 hover:text-gray-900">About</a>

                                <a href="#" class="font-medium text-gray-500 hover:text-gray-900">Features</a>

                                <a href="#" class="font-medium text-gray-500 hover:text-gray-900">FAQ</a>
                            </div>
                            <div class="hidden md:absolute md:inset-y-0 md:right-0 md:flex md:items-center md:justify-end">
                                <span class="inline-flex rounded-md shadow">
                                    <a href="{{ url('login') }}"
                                        class="inline-flex items-center px-4 py-2 text-base font-medium text-indigo-600 bg-white border border-transparent rounded-md hover:text-indigo-500">Log in
                                    </a>
                                </span>
                            </div>
                        </nav>
                    </div>

                    <!--
                                                                                Mobile menu, show/hide based on menu open state.
                                                                      
                                                                                Entering: "duration-150 ease-out"
                                                                                  From: "opacity-0 scale-95"
                                                                                  To: "opacity-100 scale-100"
                                                                                Leaving: "duration-100 ease-in"
                                                                                  From: "opacity-100 scale-100"
                                                                                  To: "opacity-0 scale-95"
                                                                              -->
                    <div class="absolute inset-x-0 top-0 z-10 p-2 transition origin-top-right transform md:hidden">
                        <div class="overflow-hidden bg-white rounded-lg shadow-md ring-1 ring-black ring-opacity-5">
                            <div class="flex items-center justify-between px-5 pt-4">
                                <div>
                                    <img class="w-auto h-8"
                                        src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600"
                                        alt="">
                                </div>
                                <div class="-mr-2">
                                    <button type="button"
                                        class="inline-flex items-center justify-center p-2 text-gray-400 bg-white rounded-md hover:bg-gray-100 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500">
                                        <span class="sr-only">Close main menu</span>
                                        <!-- Heroicon name: outline/x-mark -->
                                        <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <div class="px-2 pt-2 pb-3 space-y-1">
                                <a href="#"
                                    class="block px-3 py-2 text-base font-medium text-gray-700 rounded-md hover:bg-gray-50 hover:text-gray-900">Product</a>

                                <a href="#"
                                    class="block px-3 py-2 text-base font-medium text-gray-700 rounded-md hover:bg-gray-50 hover:text-gray-900">Features</a>

                                <a href="#"
                                    class="block px-3 py-2 text-base font-medium text-gray-700 rounded-md hover:bg-gray-50 hover:text-gray-900">Marketplace</a>

                                <a href="#"
                                    class="block px-3 py-2 text-base font-medium text-gray-700 rounded-md hover:bg-gray-50 hover:text-gray-900">Company</a>
                            </div>
                            <a href="#"
                                class="block w-full px-5 py-3 font-medium text-center text-indigo-600 bg-gray-50 hover:bg-gray-100 hover:text-indigo-700">Log
                                in</a>
                        </div>
                    </div>
                </div>

                <div class="px-4 mx-auto mt-16 max-w-7xl sm:mt-24 sm:px-6">
                    <div class="text-center">
                        <h1 class="text-4xl font-bold tracking-tight text-gray-900 sm:text-5xl md:text-6xl">
                            <span class="block">Data to enrich your</span>
                            <span class="block text-indigo-600">medical records</span>
                        </h1>
                        <p
                            class="max-w-md mx-auto mt-3 text-base text-gray-500 sm:text-lg md:mt-5 md:max-w-3xl md:text-xl">
                            Our app provides a convenient and secure way for patients to manage their medical information
                            digitally. With our app, you can easily store and access your medical records, including
                            allergies, medications, and past medical procedures.
                        </p>
                    </div>
                </div>
            </div>

            <div class="relative">
                <div class="absolute inset-0 flex flex-col" aria-hidden="true">
                    <div class="flex-1"></div>
                    <div class="flex-1 w-full bg-gray-800"></div>
                </div>
                <div class="px-4 mx-auto max-w-7xl sm:px-6">
                    <img class="relative rounded-lg shadow-lg" src="{{ global_asset('img/app.png') }}"
                        alt="App screenshot">
                </div>
            </div>
        </div>
        <div class="bg-gray-800">
            <div class="px-4 py-16 mx-auto max-w-7xl sm:py-24 sm:px-6 lg:px-8">
                <h2 class="text-base font-semibold text-center text-gray-400">Trusted by over 53 forward-thinking clinics
                </h2>
                <div class="grid grid-cols-2 gap-8 mt-8 md:grid-cols-6 lg:grid-cols-5">
                    <div class="flex justify-center col-span-1 md:col-span-2 lg:col-span-1">
                        <img class="h-12" src="https://tailwindui.com/img/logos/tuple-logo-gray-400.svg"
                            alt="Tuple">
                    </div>
                    <div class="flex justify-center col-span-1 md:col-span-2 lg:col-span-1">
                        <img class="h-12" src="https://tailwindui.com/img/logos/mirage-logo-gray-400.svg"
                            alt="Mirage">
                    </div>
                    <div class="flex justify-center col-span-1 md:col-span-2 lg:col-span-1">
                        <img class="h-12" src="https://tailwindui.com/img/logos/statickit-logo-gray-400.svg"
                            alt="StaticKit">
                    </div>
                    <div class="flex justify-center col-span-1 md:col-span-3 lg:col-span-1">
                        <img class="h-12" src="https://tailwindui.com/img/logos/transistor-logo-gray-400.svg"
                            alt="Transistor">
                    </div>
                    <div class="flex justify-center col-span-2 md:col-span-3 lg:col-span-1">
                        <img class="h-12" src="https://tailwindui.com/img/logos/workcation-logo-gray-400.svg"
                            alt="Workcation">
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white">
            <div class="px-4 py-16 mx-auto max-w-7xl sm:py-24 sm:px-6 lg:px-8">
                <div class="pb-16 xl:flex xl:items-center xl:justify-between">
                    <div>
                        <h1 class="text-4xl font-bold tracking-tight sm:text-5xl">
                            <span class="text-gray-900">Everything you need for</span>
                            <span class="text-indigo-600">$300 a month</span>
                        </h1>
                        <p class="mt-5 text-xl text-gray-500">Includes every feature we offer plus unlimited clinics and
                            unlimited users.</p>
                    </div>
                    <a href="{{ url('register') }}"
                        class="inline-flex items-center justify-center w-full px-5 py-3 mt-8 text-base font-medium text-white bg-indigo-600 border border-transparent rounded-md hover:bg-indigo-700 sm:mt-10 sm:w-auto xl:mt-0">Get
                        started today</a>
                </div>
                <div class="pt-16 border-t border-gray-200 xl:grid xl:grid-cols-3 xl:gap-x-8">
                    <div>
                        <h2 class="text-lg font-semibold text-indigo-600">Everything you need</h2>
                        <p class="mt-2 text-3xl font-bold tracking-tight text-gray-900">All-in-one platform</p>
                        <p class="mt-4 text-lg text-gray-500">
                            Walkthrough your patient from check-in station up until to their medication requests from
                            pharmacy inventory.
                        </p>
                    </div>
                    <div class="mt-4 sm:mt-8 md:mt-10 md:grid md:grid-cols-2 md:gap-x-8 xl:col-span-2 xl:mt-0">
                        <ul role="list" class="divide-y divide-gray-200">
                            <li class="flex py-4 md:py-0 md:pb-4">
                                <!-- Heroicon name: outline/check -->
                                <svg class="flex-shrink-0 w-6 h-6 text-green-500" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                    aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                                </svg>
                                <span class="ml-3 text-base text-gray-500">Dashboard Patients</span>
                            </li>

                            <li class="flex py-4">
                                <!-- Heroicon name: outline/check -->
                                <svg class="flex-shrink-0 w-6 h-6 text-green-500" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                    aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                                </svg>
                                <span class="ml-3 text-base text-gray-500">Clinic Dashboard</span>
                            </li>

                            <li class="flex py-4">
                                <!-- Heroicon name: outline/check -->
                                <svg class="flex-shrink-0 w-6 h-6 text-green-500" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                    aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                                </svg>
                                <span class="ml-3 text-base text-gray-500">Manage Users</span>
                            </li>

                            <li class="flex py-4">
                                <!-- Heroicon name: outline/check -->
                                <svg class="flex-shrink-0 w-6 h-6 text-green-500" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                    aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                                </svg>
                                <span class="ml-3 text-base text-gray-500">Pharmacy Products and Laboratories</span>
                            </li>

                            <li class="flex py-4">
                                <!-- Heroicon name: outline/check -->
                                <svg class="flex-shrink-0 w-6 h-6 text-green-500" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                    aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                                </svg>
                                <span class="ml-3 text-base text-gray-500">Downloadable Files</span>
                            </li>
                        </ul>
                        <ul role="list" class="border-t border-gray-200 divide-y divide-gray-200 md:border-t-0">
                            <li class="flex py-4 md:border-t-0 md:py-0 md:pb-4">
                                <!-- Heroicon name: outline/check -->
                                <svg class="flex-shrink-0 w-6 h-6 text-green-500" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                    aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                                </svg>
                                <span class="ml-3 text-base text-gray-500">Check-in Patient</span>
                            </li>

                            <li class="flex py-4">
                                <!-- Heroicon name: outline/check -->
                                <svg class="flex-shrink-0 w-6 h-6 text-green-500" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                    aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                                </svg>
                                <span class="ml-3 text-base text-gray-500">Input Vital Signs</span>
                            </li>

                            <li class="flex py-4">
                                <!-- Heroicon name: outline/check -->
                                <svg class="flex-shrink-0 w-6 h-6 text-green-500" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                    aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                                </svg>
                                <span class="ml-3 text-base text-gray-500">Public Health Research Forms</span>
                            </li>

                            <li class="flex py-4">
                                <!-- Heroicon name: outline/check -->
                                <svg class="flex-shrink-0 w-6 h-6 text-green-500" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                    aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                                </svg>
                                <span class="ml-3 text-base text-gray-500">Clinical Encounters</span>
                            </li>

                            <li class="flex py-4">
                                <!-- Heroicon name: outline/check -->
                                <svg class="flex-shrink-0 w-6 h-6 text-green-500" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                    aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                                </svg>
                                <span class="ml-3 text-base text-gray-500">Pharmacy Order Requests</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-gray-100">
            <div class="px-4 py-16 mx-auto max-w-7xl sm:py-24 sm:px-6 lg:px-8">
                <div class="relative bg-white shadow-xl">
                    <h2 class="sr-only">Contact us</h2>

                    <div class="grid grid-cols-1 lg:grid-cols-3">
                        <!-- Contact information -->
                        <div class="relative px-6 py-10 overflow-hidden bg-indigo-700 sm:px-10 xl:p-12">
                            <div class="absolute inset-0 pointer-events-none sm:hidden" aria-hidden="true">
                                <svg class="absolute inset-0 w-full h-full" width="343" height="388"
                                    viewBox="0 0 343 388" fill="none" preserveAspectRatio="xMidYMid slice"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M-99 461.107L608.107-246l707.103 707.107-707.103 707.103L-99 461.107z"
                                        fill="url(#linear1)" fill-opacity=".1" />
                                    <defs>
                                        <linearGradient id="linear1" x1="254.553" y1="107.554" x2="961.66"
                                            y2="814.66" gradientUnits="userSpaceOnUse">
                                            <stop stop-color="#fff"></stop>
                                            <stop offset="1" stop-color="#fff" stop-opacity="0"></stop>
                                        </linearGradient>
                                    </defs>
                                </svg>
                            </div>
                            <div class="absolute top-0 bottom-0 right-0 hidden w-1/2 pointer-events-none sm:block lg:hidden"
                                aria-hidden="true">
                                <svg class="absolute inset-0 w-full h-full" width="359" height="339"
                                    viewBox="0 0 359 339" fill="none" preserveAspectRatio="xMidYMid slice"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M-161 382.107L546.107-325l707.103 707.107-707.103 707.103L-161 382.107z"
                                        fill="url(#linear2)" fill-opacity=".1" />
                                    <defs>
                                        <linearGradient id="linear2" x1="192.553" y1="28.553" x2="899.66"
                                            y2="735.66" gradientUnits="userSpaceOnUse">
                                            <stop stop-color="#fff"></stop>
                                            <stop offset="1" stop-color="#fff" stop-opacity="0"></stop>
                                        </linearGradient>
                                    </defs>
                                </svg>
                            </div>
                            <div class="absolute top-0 bottom-0 right-0 hidden w-1/2 pointer-events-none lg:block"
                                aria-hidden="true">
                                <svg class="absolute inset-0 w-full h-full" width="160" height="678"
                                    viewBox="0 0 160 678" fill="none" preserveAspectRatio="xMidYMid slice"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M-161 679.107L546.107-28l707.103 707.107-707.103 707.103L-161 679.107z"
                                        fill="url(#linear3)" fill-opacity=".1" />
                                    <defs>
                                        <linearGradient id="linear3" x1="192.553" y1="325.553" x2="899.66"
                                            y2="1032.66" gradientUnits="userSpaceOnUse">
                                            <stop stop-color="#fff"></stop>
                                            <stop offset="1" stop-color="#fff" stop-opacity="0"></stop>
                                        </linearGradient>
                                    </defs>
                                </svg>
                            </div>
                            <h3 class="text-lg font-medium text-white">Contact information</h3>
                            <p class="max-w-3xl mt-6 text-base text-indigo-50">Nullam risus blandit ac aliquam justo ipsum.
                                Quam mauris volutpat massa dictumst amet. Sapien tortor lacus arcu.</p>
                            <dl class="mt-8 space-y-6">
                                <dt><span class="sr-only">Phone number</span></dt>
                                <dd class="flex text-base text-indigo-50">
                                    <!-- Heroicon name: outline/phone -->
                                    <svg class="flex-shrink-0 w-6 h-6 text-indigo-200" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                        aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z" />
                                    </svg>
                                    <span class="ml-3">+1 (555) 123-4567</span>
                                </dd>
                                <dt><span class="sr-only">Email</span></dt>
                                <dd class="flex text-base text-indigo-50">
                                    <!-- Heroicon name: outline/envelope -->
                                    <svg class="flex-shrink-0 w-6 h-6 text-indigo-200" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                        aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                                    </svg>
                                    <span class="ml-3">support@uthriva.com</span>
                                </dd>
                            </dl>
                            <ul role="list" class="flex mt-8 space-x-12">
                                <li>
                                    <a class="text-indigo-200 hover:text-indigo-100" href="#">
                                        <span class="sr-only">Facebook</span>
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" aria-hidden="true">
                                            <path
                                                d="M22.258 1H2.242C1.556 1 1 1.556 1 2.242v20.016c0 .686.556 1.242 1.242 1.242h10.776v-8.713h-2.932V11.39h2.932V8.887c0-2.906 1.775-4.489 4.367-4.489 1.242 0 2.31.093 2.62.134v3.037l-1.797.001c-1.41 0-1.683.67-1.683 1.653v2.168h3.362l-.438 3.396h-2.924V23.5h5.733c.686 0 1.242-.556 1.242-1.242V2.242C23.5 1.556 22.944 1 22.258 1"
                                                fill="currentColor" />
                                        </svg>
                                    </a>
                                </li>
                                <li>
                                    <a class="text-indigo-200 hover:text-indigo-100" href="#">
                                        <span class="sr-only">Twitter</span>
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" aria-hidden="true">
                                            <path
                                                d="M7.548 22.501c9.056 0 14.01-7.503 14.01-14.01 0-.213 0-.425-.015-.636A10.02 10.02 0 0024 5.305a9.828 9.828 0 01-2.828.776 4.94 4.94 0 002.165-2.724 9.867 9.867 0 01-3.127 1.195 4.929 4.929 0 00-8.391 4.491A13.98 13.98 0 011.67 3.9a4.928 4.928 0 001.525 6.573A4.887 4.887 0 01.96 9.855v.063a4.926 4.926 0 003.95 4.827 4.917 4.917 0 01-2.223.084 4.93 4.93 0 004.6 3.42A9.88 9.88 0 010 20.289a13.941 13.941 0 007.548 2.209"
                                                fill="currentColor" />
                                        </svg>
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <!-- Contact form -->
                        <div class="px-6 py-10 sm:px-10 lg:col-span-2 xl:p-12">
                            <h3 class="text-lg font-medium text-gray-900">Send us a message</h3>
                            <form action="#" method="POST"
                                class="grid grid-cols-1 mt-6 gap-y-6 sm:grid-cols-2 sm:gap-x-8">
                                <div>
                                    <label for="first-name" class="block text-sm font-medium text-gray-900">Name</label>
                                    <div class="mt-1">
                                        <input type="text" name="first-name" id="first-name"
                                            autocomplete="given-name"
                                            class="block w-full px-4 py-3 text-gray-900 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    </div>
                                </div>
                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-900">Email</label>
                                    <div class="mt-1">
                                        <input id="email" name="email" type="email" autocomplete="email"
                                            class="block w-full px-4 py-3 text-gray-900 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    </div>
                                </div>
                                <div class="sm:col-span-2">
                                    <label for="subject" class="block text-sm font-medium text-gray-900">Subject</label>
                                    <div class="mt-1">
                                        <input type="text" name="subject" id="subject"
                                            class="block w-full px-4 py-3 text-gray-900 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    </div>
                                </div>
                                <div class="sm:col-span-2">
                                    <div class="flex justify-between">
                                        <label for="message"
                                            class="block text-sm font-medium text-gray-900">Message</label>
                                        <span id="message-max" class="text-sm text-gray-500">Max. 500 characters</span>
                                    </div>
                                    <div class="mt-1">
                                        <textarea id="message" name="message" rows="4"
                                            class="block w-full px-4 py-3 text-gray-900 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                            aria-describedby="message-max"></textarea>
                                    </div>
                                </div>
                                <div class="sm:col-span-2 sm:flex sm:justify-end">
                                    <button type="submit"
                                        class="inline-flex items-center justify-center w-full px-6 py-3 mt-2 text-base font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
@endsection
