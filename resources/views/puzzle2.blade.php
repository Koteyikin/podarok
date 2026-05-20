@extends('layouts.app')
@section('head')
    <style>
        .card { width: 80px; height: 80px; cursor: pointer; background: #4B5563; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 2rem; }
        .matched { background: #10B981; pointer-events: none; }
        .hidden-card { color: transparent; }
    </style>
@endsection
@section('content')
    <div class="bg-gray-800 rounded-2xl p-8 shadow-2xl text-center">
        <h2 class="text-xl mb-4">Головоломка 2: Найди пары</h2>
        <div class="grid grid-cols-4 gap-2 justify-center mx-auto w-fit mb-6" id="gameBoard"></div>
        <form action="/puzzle/2/check" method="POST" id="puzzle2form">
            @csrf
            <input type="hidden" name="answer" value="">
            @error('puzzle')<p class="text-red-400 mb-2">{{ $message }}</p>@enderror
            <button type="submit" class="bg-purple-600 hover:bg-purple-700 text-white font-bold py-3 px-8 rounded-xl hidden" id="finishBtn">Продолжить</button>
        </form>
    </div>
    <script>
        const emojis = ['🎁', '🎉', '🎂', '🎈', '🎁', '🎉', '🎂', '🎈'];
        let shuffled = emojis.sort(() => Math.random() - 0.5);
        let board = document.getElementById('gameBoard');
        let first = null, lock = false, pairsFound = 0;
        shuffled.forEach((emoji, i) => {
            let card = document.createElement('div');
            card.className = 'card hidden-card';
            card.dataset.emoji = emoji;
            card.dataset.index = i;
            card.onclick = () => flip(card);
            board.appendChild(card);
        });
        function flip(card) {
            if (lock || card.classList.contains('matched') || !card.classList.contains('hidden-card')) return;
            card.textContent = card.dataset.emoji;
            card.classList.remove('hidden-card');
            if (!first) { first = card; return; }
            if (first.dataset.emoji === card.dataset.emoji) {
                first.classList.add('matched');
                card.classList.add('matched');
                pairsFound++;
                first = null;
                if (pairsFound === 4) {
                    document.getElementById('finishBtn').classList.remove('hidden');
                    document.querySelector('input[name="answer"]').value = 'ПОДАРОК'; // скрытый ответ
                }
            } else {
                lock = true;
                setTimeout(() => {
                    first.textContent = '';
                    card.textContent = '';
                    first.classList.add('hidden-card');
                    card.classList.add('hidden-card');
                    first = null;
                    lock = false;
                }, 700);
            }
        }
    </script>
@endsection
