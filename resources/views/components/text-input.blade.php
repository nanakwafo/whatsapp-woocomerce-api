@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-gray-200 bg-gray-50 focus:bg-white focus:border-primary focus:ring-primary rounded-xl shadow-sm transition']) }}>
