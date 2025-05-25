<div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition duration-300">
    <div class="relative">
        <img src="{{ $image }}" alt="{{ $title }}" class="w-full h-48 object-cover">
        @isset($badge)
            <span class="absolute top-2 right-2 {{ $badgeColor ?? 'bg-blue-500' }} text-white text-xs font-bold px-2 py-1 rounded-full">
                {{ $badge }}
            </span>
        @endisset
    </div>
    <div class="p-4">
        <h3 class="text-md font-semibold mb-1">{{ $title }}</h3>
        <span class="text-blue-600 font-bold">{{ $price }}</span>
        <button class="w-full mt-3 bg-blue-600 hover:bg-blue-700 text-white py-2 rounded-lg text-sm transition">
            Lihat Detail
        </button>
    </div>
</div>