@props(['disabled' => false])

<div>
<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'w-4 h-4 text-teal-500 bg-gray-100 border-gray-300 focus:ring-teal-500 dark:focus:ring-teal-500 dark:ring-offset-gray-700']) !!}>
</div>
