<a {{ $attributes->merge(['class' => 'bg-white p-4 rounded-lg shadow-md flex justify-between items-center']) }}>
    <div>
        <h2 class="text-lg font-semibold mb-2">{{ $title }}</h2>
        <p class="text-2xl font-bold">{{ $total }}</p>
    </div>
    {{ $slot }}
</a>