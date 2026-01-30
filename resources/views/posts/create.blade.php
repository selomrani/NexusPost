<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Write New Post - Nexus Admin</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

    <!-- FORCE TAILWIND CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'media',
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Instrument Sans', 'sans-serif'],
                    },
                    colors: {
                        brand: {
                            50: '#f0f9ff',
                            100: '#e0f2fe',
                            500: '#0ea5e9',
                            600: '#0284c7',
                            900: '#0c4a6e',
                        }
                    }
                }
            }
        }
    </script>
    
    <!-- Alpine.js for Dropdowns -->
    <script src="//unpkg.com/alpinejs" defer></script>

    <style>
        body { font-family: 'Instrument Sans', sans-serif; }
        /* Simple resize handle for textarea */
        textarea { resize: none; }
    </style>
</head>
<body class="bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-gray-100 antialiased">

    <div class="min-h-screen flex flex-col">
        
        <!-- Admin Navigation (Consistent with Dashboard) -->
        <nav class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700" x-data="{ open: false }">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <!-- Logo -->
                        <div class="shrink-0 flex items-center gap-2">
                            <div class="w-8 h-8 bg-brand-600 rounded-lg flex items-center justify-center text-white font-bold">N</div>
                            <span class="font-bold text-xl tracking-tight hidden sm:block">Nexus Admin</span>
                        </div>
                        <!-- Navigation Links -->
                        <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                            <a href="{{ route('dashboard') }}" class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:border-gray-300 dark:hover:border-gray-700 focus:outline-none transition duration-150 ease-in-out">
                                Dashboard
                            </a>
                            <!-- Active State for Create Page -->
                            <span class="inline-flex items-center px-1 pt-1 border-b-2 border-brand-500 text-sm font-medium leading-5 text-gray-900 dark:text-gray-100">
                                Write Post
                            </span>
                        </div>
                    </div>
                    
                    <!-- User Dropdown -->
                    <div class="hidden sm:flex sm:items-center sm:ml-6">
                        <div class="relative" x-data="{ dropdownOpen: false }">
                            <button @click="dropdownOpen = !dropdownOpen" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                                <div class="flex flex-col items-end mr-2">
                                    <span class="font-bold">{{ Auth::user()->name ?? 'Administrator' }}</span>
                                </div>
                                <div class="w-8 h-8 rounded-full bg-gray-200 dark:bg-gray-700 flex items-center justify-center text-xs font-bold">
                                    {{ substr(Auth::user()->name ?? 'A', 0, 1) }}
                                </div>
                            </button>

                            <div x-show="dropdownOpen" @click.away="dropdownOpen = false" class="absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white dark:bg-gray-700 ring-1 ring-black ring-opacity-5 z-50" style="display: none;">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-600">
                                        Log Out
                                    </a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Main Editor Content -->
        <main class="flex-grow py-8 px-4 sm:px-6 lg:px-8">
            <div class="max-w-5xl mx-auto">
                
                <!-- Breadcrumb / Back Link -->
                <div class="mb-6">
                    <a href="{{ route('dashboard') }}" class="inline-flex items-center text-sm text-gray-500 hover:text-brand-600 dark:text-gray-400 dark:hover:text-brand-400 transition-colors">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                        Back to Dashboard
                    </a>
                </div>

                <form action="#" method="POST" class="space-y-8"> <!-- Replace # with route('posts.store') -->
                    @csrf
                    
                    <!-- Top Action Bar -->
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                        <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-100">New Entry</h1>
                        <div class="flex items-center gap-3 w-full sm:w-auto">
                            <button type="submit" class="flex-1 sm:flex-none px-6 py-2 text-sm font-medium text-white bg-brand-600 rounded-lg hover:bg-brand-500 shadow-sm transition-colors flex items-center justify-center gap-2">
                                <span>Publish</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                            </button>
                        </div>
                    </div>

                    <!-- Editor Card -->
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
                        <div class="p-6 sm:p-8 space-y-6">
                            
                            <!-- Title Input -->
                            <div>
                                <label for="title" class="sr-only">Post Title</label>
                                <input 
                                    type="text" 
                                    name="title" 
                                    id="title" 
                                    placeholder="Enter post title..." 
                                    class="block w-full text-3xl sm:text-4xl font-bold text-gray-900 dark:text-gray-100 placeholder-gray-300 dark:placeholder-gray-600 border-none focus:ring-0 p-0 bg-transparent transition-colors"
                                    autofocus
                                >
                            </div>

                            <!-- Meta Data Row (Category, etc.) -->
                            <div class="flex flex-wrap gap-4 items-center text-sm text-gray-500 border-b border-gray-100 dark:border-gray-700 pb-6">
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                                    </span>
                                    <input type="text" placeholder="Add tags..." class="pl-9 pr-4 py-1.5 rounded-full bg-gray-50 dark:bg-gray-900 border border-transparent focus:bg-white dark:focus:bg-black focus:ring-1 focus:ring-brand-500 focus:border-brand-500 transition-colors w-40">
                                </div>
                            </div>

                            <!-- Main Content Textarea -->
                            <div class="min-h-[400px]">
                                <label for="content" class="sr-only">Content</label>
                                <textarea 
                                    name="content" 
                                    id="content" 
                                    placeholder="Tell your story..." 
                                    class="block w-full h-[500px] text-lg leading-relaxed text-gray-700 dark:text-gray-300 placeholder-gray-400 border-none focus:ring-0 resize-none bg-transparent p-0"
                                ></textarea>
                            </div>

                        </div>
                    </div>

                </form>
            </div>
        </main>
    </div>
</body>
</html>