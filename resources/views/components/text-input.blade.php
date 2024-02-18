@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-gray-500 dark:border-gray-300 dark:border-gray-100 dark:ring-black focus:ring-black dark:focus:ring-black focus:ring-black dark:focus:ring-black rounded-md shadow-sm']) !!}>
