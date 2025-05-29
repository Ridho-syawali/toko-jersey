@extends('layouts.app')

@section('title', 'Home')

@section('content')
<div class="min-h-screen">
    <!-- Hero Section - Modified Split Layout -->
<section class="relative min-h-screen flex items-center">
   
    <div class="container mx-auto px-4 flex flex-col md:flex-row items-center relative z-10">
        <!-- Image on Left (50% width) -->
        <div class="w-full md:w-1/2 mb-10 md:mb-0 md:pr-10 flex justify-center">
            <img 
                src="/images/ronaldo.png" 
                alt="Jersey Player" 
                class="max-h-[500px] object-contain drop-shadow-2xl"
            >
        </div>
        
        <!-- Content on Right (50% width) -->
        <div class="w-full md:w-1/2 text-center md:text-left">
            <h1 class="text-4xl md:text-6xl font-bold mb-4 text-gray-800">JerseyVerse</h1>
            <h2 class="text-2xl md:text-3xl mb-8 text-gray-600">Pilih Jersey Anda di JerseyVerse</h2>
            <p class="text-xl mb-8 text-gray-500">Jersey berkualitas tinggi di kota ini</p>
            
            <div class="flex flex-col md:flex-row gap-4 justify-center md:justify-start">
                <a href="./products" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded-lg transition duration-300 ease-in-out">
                    Jelajahi
                </a>
            </div>
        </div>
    </div>
</section>

</div>
@endsection