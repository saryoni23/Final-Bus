@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'dark:bg-gray-600 dark:text-white border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 dark:text-gray-600 rounded-md shadow-sm']) !!}>
