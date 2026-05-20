@extends('layouts.app')
@section('head')
    <style>
        .tile { width: 80px; height: 80px; background: #7C3AED; color: white; font-weight: bold; font-size: 1.2rem; display: flex; align-items: center; justify-content: center; border-radius: 10px; cursor: pointer; }
        .empty { background: transparent; }
    </style>
@endsection
@section('content')
    <div class="bg-gray-800 rounded-2xl p-8 shadow-2xl text-center">
        <h2 class="text-xl mb-4">Головоломка 3: Пятнашки</h2>
        <p class="text-gray-300 mb-4">Собери надпись «ТЫ КРУТ!»</p>
        <div class="grid grid-cols-3 gap-2 w-fit mx-auto mb-6" id="puzzle3board"></div>
        <form action="/puzzle/3/check" method="POST" id="puzzle3form">
            @csrf
            <input type="hidden" name="answer" value="">
            @error('puzzle')<p class="text-red-400 mb-2">{{ $message }}</p>@enderror
            <button type="submit" class="bg-purple-600 hover:bg-purple-700 text-white font-bold py-3 px-8 rounded-xl hidden" id="winBtn">Получить подарок!</button>
        </form>
    </div>
    <script>
        const tiles = ['Т', 'Ы', ' ', 'К', 'Р', 'У', 'Т', '!', ''];
        let boardState = [...tiles];
        function render() {
            let html = '';
            boardState.forEach((t, i) => {
                html += `<div class="tile${t===''?' empty':''}" onclick="move(${i})">${t}</div>`;
            });
            document.getElementById('puzzle3board').innerHTML = html;
            if (boardState.slice(0,8).join('') === 'ТЫ КРУТ!' && boardState[8]==='') {
                document.getElementById('winBtn').classList.remove('hidden');
                document.querySelector('input[name="answer"]').value = 'ГОТОВ';
            }
        }
        function move(index) {
            let emptyIndex = boardState.indexOf('');
            let possible = [index-1, index+1, index-3, index+3];
            if (possible.includes(emptyIndex) && Math.abs(index%3 - emptyIndex%3)+Math.abs(Math.floor(index/3)-Math.floor(emptyIndex/3))===1) {
                [boardState[index], boardState[emptyIndex]] = [boardState[emptyIndex], boardState[index]];
                render();
            }
        }
        // Перемешиваем стартовое состояние (гарантированно решаемое)
        do {
            boardState = tiles.slice();
            for (let i=0; i<20; i++) {
                let ei = boardState.indexOf('');
                let candidates = [ei-1, ei+1, ei-3, ei+3].filter(c => c>=0 && c<9 && Math.abs(c%3 - ei%3)+Math.abs(Math.floor(c/3)-Math.floor(ei/3))===1);
                let r = candidates[Math.floor(Math.random()*candidates.length)];
                [boardState[ei], boardState[r]] = [boardState[r], boardState[ei]];
            }
        } while(boardState.slice(0,8).join('') === 'ТЫ КРУТ!')
        render();
    </script>
@endsection
