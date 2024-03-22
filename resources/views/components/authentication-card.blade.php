<div class="min-h-screen flex flex-col sm:justify-center   dark:bg-gray-800 dark:text-white text-gray-900 items-center pt-6 sm:pt-0 bg-gray-100">
    <div>
        {{ $logo }}
    </div>

    <div class="w-full sm:max-w-md mt-6 px-6 py-4 border border-gray-950  dark:bg-gray-900 dark:text-white text-gray-900 bg-white shadow-md overflow-hidden sm:rounded-lg">
        {{ $slot }}
    </div>
</div>
