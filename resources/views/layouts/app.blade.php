<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Task Manager') }}</title>

    <!-- TailwindCSS (Production: Should use build step, but using CDN for portability as requested) -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- SortableJS -->
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>

    <style>
        .sortable-ghost {
            opacity: 0.5;
            background: #f3f4f6;
            border: 2px dashed #d1d5db;
        }

        .sortable-drag {
            cursor: grabbing;
        }
    </style>
</head>

<body class="bg-gray-100 font-sans antialiased text-gray-900">
    <div class="min-h-screen flex flex-col items-center pt-6 sm:pt-10">
        <div class="w-full sm:max-w-5xl mt-6 px-6 py-8 bg-white shadow-lg overflow-hidden sm:rounded-xl">
            <!-- Header -->
            <div class="mb-6 border-b pb-4 flex justify-between items-center">
                <h1 class="text-3xl font-extrabold text-gray-800 tracking-tight">
                    <a href="{{ route('tasks.index') }}">Task Manager</a>
                </h1>
                <div class="text-sm text-gray-500">
                    Laravel 11 • Tailwind • SortableJS
                </div>
            </div>

            <!-- Flash Messages -->
            @if(session('success'))
                <div class="mb-6 bg-green-50 border-l-4 border-green-500 p-4 rounded-r shadow-sm">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-green-700 font-medium">{{ session('success') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            @if($errors->any())
                <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4 rounded-r shadow-sm">
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-red-800">There were problems with your input:</h3>
                        <ul class="mt-2 list-disc list-inside text-sm text-red-700">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            <!-- Content -->
            @yield('content')
        </div>

        <div class="mt-8 text-center text-gray-400 text-sm">
            <p>&copy; {{ date('Y') }} Task Manager Project. Built with Laravel.</p>
        </div>
    </div>

    @stack('scripts')
</body>

</html>