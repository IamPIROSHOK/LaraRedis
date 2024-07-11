<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
<div class="min-h-screen bg-gray-100 dark:bg-gray-900">
    @include('layouts.navigation')

    <!-- Page Heading -->
    @if (isset($header))
        <header class="bg-white dark:bg-gray-800 shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
    @endif

    <!-- Page Content -->
    <main>
        {{ $slot }}
    </main>
    <!-- Chat Icon and Modal -->
    <div x-data="{ openChat: false, newMessage: '', messages: [] }">
        <!-- Иконка чата -->
        <div class="fixed bottom-4 right-4">
            <button @click="openChat = true"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full shadow-lg">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                     class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M8 10h.01M12 10h.01M16 10h.01M21 16a8.001 8.001 0 01-7.07 7.93A8 8 0 014 16H3a1 1 0 01-.8-1.6 10.002 10.002 0 0017.6 0A1 1 0 0121 16h0zM8 20h8M12 17v3"/>
                </svg>
            </button>
        </div>

        <!-- Модальное окно чата -->
        <div x-show="openChat" class="fixed inset-0 flex items-center justify-center z-50 bg-gray-900 bg-opacity-50"
             x-cloak>
            <div class="bg-white rounded-lg shadow-lg overflow-hidden w-full max-w-md">
                <div class="p-4 border-b">
                    <h2 class="text-lg font-semibold">Chat with Admin</h2>
                    <button @click="openChat = false" class="text-gray-600 hover:text-gray-800 float-right">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                             class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
                <div class="p-4">
                    <!-- Список сообщений -->
                    <div class="messages space-y-4">
                        <!-- Пример сообщения от пользователя -->
                        <div class="message self-end">
                            <div class="bg-blue-500 text-white p-2 rounded-lg">
                                Hello, I need help!
                            </div>
                        </div>
                        <!-- Пример сообщения от администратора -->
                        <div class="message self-start">
                            <div class="bg-gray-200 p-2 rounded-lg">
                                Hi, how can I assist you?
                            </div>
                        </div>
                    </div>
                </div>
                <div class="p-4 border-t">
                    <!-- Форма отправки сообщения -->
                    <form @submit.prevent="messages.push({ text: newMessage, self: true }); newMessage = ''">
                        <div class="flex">
                            <input type="text" x-model="newMessage" placeholder="Enter your message..."
                                   class="flex-grow border rounded-lg p-2 mr-2">
                            <button type="submit"
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg">
                                Send
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/3.2.2/cdn.min.js"
        integrity="sha384-/Y5tF/JFz9ySp0hx/6yptQfJh+lbRAN/zSgxTA8nZ9oaSp14J8qebqe57X0IR5cF"
        crossorigin="anonymous"></script>
</body>
</html>
