@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'bg-white border-gray-300 text-gray-900 focus:border-[#006C43] focus:ring-[#006C43] rounded-md shadow-sm']) }}>
