@props(['disabled' => false])

<div>
<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'text-teal-500 border-gray-300 focus:border-teal-500 focus:ring-teal-500 rounded-md shadow-sm']) !!}>
</div>
