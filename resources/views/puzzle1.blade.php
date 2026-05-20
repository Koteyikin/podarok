@extends('layouts.app')
@section('content')
    <div class="bg-gray-800 rounded-2xl p-8 shadow-2xl text-center">
        <h2 class="text-xl mb-4">Головоломка 1: Шифр</h2>
        <p class="mb-2 text-gray-300">Расшифруй послание. Каждая буква сдвинута на 3 назад.</p>
        <p class="text-3xl font-mono mb-6 tracking-widest">Фотография присланная 14 февраля</p>
        <p class="text-sm text-gray-400 mb-6">но куда?</p>
        <form action="/puzzle/1/check" method="POST">
            @csrf
            <input name="answer" class="w-full max-w-xs text-center p-3 rounded-lg bg-gray-700 border border-gray-600 text-white mb-4" placeholder="Твой ответ">
            @error('puzzle')<p class="text-red-400 mb-2">{{ $message }}</p>@enderror
            <button class="bg-purple-600 hover:bg-purple-700 text-white font-bold py-3 px-8 rounded-xl">Ответить</button>
        </form>
    </div>
@endsection
