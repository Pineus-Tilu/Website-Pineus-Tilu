<a {{ $attributes->merge([
    'class' => '
        flex items-center gap-2
        w-full px-4 py-2 text-sm font-medium text-gray-800 dark:text-gray-200
        hover:bg-blue-50 dark:hover:bg-gray-800
        hover:text-blue-600 dark:hover:text-blue-400
        transition duration-150 ease-in-out
        rounded-md
    ']) }}>
    {{ $slot }}
</a>
