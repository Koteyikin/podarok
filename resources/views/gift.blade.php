@extends('layouts.app')
@section('content')
    <div class="flex flex-col lg:flex-row gap-6 h-[80vh] w-full">
        <div class="flex-1 bg-gradient-to-br from-cyan-800 to-blue-900 rounded-2xl flex flex-col items-center justify-center p-6 shadow-2xl transform hover:scale-[1.02] transition">
{{--            <img src="/public/images/subnautica.jpg" alt="Subnautica 2" class="rounded-xl mb-4 shadow-lg">--}}
            <h2 class="text-3xl font-bold text-cyan-300 mb-2">Subnautica 2</h2>
            <p class="text-gray-200 text-center">Погрузись в глубины неизведанных океанов.</p>
        </div>
        <div class="flex-1 bg-gradient-to-br from-yellow-700 to-red-900 rounded-2xl flex flex-col items-center justify-center p-6 shadow-2xl transform hover:scale-[1.02] transition">
{{--            <img src="https://www.expectingmrbond.com/gallery/007-first-light-animated-wallpaper-previews/" class="rounded-xl mb-4 shadow-lg">--}}
            <h2 class="text-3xl font-bold text-yellow-300 mb-2">007: First Light</h2>
            <p class="text-gray-200 text-center">Стань легендарным агентом.</p>
        </div>
    </div>
    <p class="text-center mt-6 text-gray-400">С днём рождения, друг! Ты прошёл все испытания 🎉</p>
@endsection
