@extends('layouts.app')

@section('head')
    <style>
        /* Градиентный фон всей страницы */
        body {
            background: linear-gradient(135deg, #0f0c29, #302b63, #24243e);
        }
        /* Анимация появления */
        .fade-in {
            animation: fadeIn 0.8s ease forwards;
        }
        @keyframes fadeIn {
            0% { opacity: 0; transform: translateY(20px); }
            100% { opacity: 1; transform: translateY(0); }
        }
        /* Поле ввода кода */
        #code-input {
            font-family: 'Courier New', monospace;
            letter-spacing: 4px;
            font-size: 1.8rem;
            text-align: center;
            background: rgba(255,255,255,0.1);
            border: 2px solid rgba(255,255,255,0.2);
            color: white;
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 15px 20px;
            width: 100%;
            max-width: 450px;
            transition: all 0.3s;
            outline: none;
        }
        #code-input:focus {
            border-color: #a78bfa;
            box-shadow: 0 0 25px rgba(167,139,250,0.6);
        }
        /* Блоки-индикаторы мессенджеров */
        .messenger-dot {
            width: 20px;
            height: 20px;
            border-radius: 50%;
            display: inline-block;
            margin: 0 8px;
            position: relative;
            cursor: default;
            transition: transform 0.2s;
        }
        .messenger-dot:hover {
            transform: scale(1.3);
        }
        .messenger-dot::after {
            content: attr(data-name);
            position: absolute;
            bottom: -25px;
            left: 50%;
            transform: translateX(-50%);
            font-size: 0.7rem;
            color: rgba(255,255,255,0.7);
            white-space: nowrap;
        }
        /* Стили для подсказок */
        .hint {
            color: rgba(255,255,255,0.6);
            font-size: 0.9rem;
            margin-top: 15px;
        }
    </style>
@endsection

@section('content')
    <div class="w-full max-w-lg mx-auto text-center fade-in">
        <!-- Заголовок -->
        <div class="mb-8">
            <h1 class="text-4xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-purple-400 to-pink-400">
                🔐 Секретный код
            </h1>
            <p class="text-gray-300 mt-2">Я спрятал буквы в пяти разных местах. Собери их по порядку.</p>
        </div>

        <!-- Карточка с полем ввода -->
        <div class="bg-white/10 backdrop-blur-xl rounded-3xl p-8 shadow-2xl border border-white/10">
            <form action="/check-code" method="POST" id="codeForm">
                @csrf
                <!-- Одно поле для всего кода -->
                <input type="text" id="code-input" name="code"
                       placeholder="XXXXX-XXXXX-XXXXX-XXXXX-XXXXX"
                       maxlength="29" autocomplete="off" autofocus>

                <!-- Цветные маркеры мессенджеров -->
                <div class="flex justify-center items-center mt-6 mb-6">
                    <span class="messenger-dot" style="background: #0088CC;" data-name="Telegram"></span>
                    <span class="messenger-dot" style="background: #1B2838;" data-name="Steam"></span>
                    <span class="messenger-dot" style="background: #FF0050;" data-name="TikTok"></span>
                    <span class="messenger-dot" style="background: #5865F2;" data-name="Discord"></span>
                    <span class="messenger-dot" style="background: #FF9F0A;" data-name="Сайт"></span>
                </div>
                <p class="hint">Каждый цвет — подсказка из нужного мессенджера 🌈</p>

                <!-- Ошибка -->
                @error('code')
                <div class="mt-3 text-red-400 bg-red-400/10 py-2 px-4 rounded-xl inline-block">
                    {{ $message }}
                </div>
                @enderror

                <!-- Кнопка -->
                <button type="submit"
                        class="mt-6 w-full py-4 bg-gradient-to-r from-purple-600 to-indigo-600 text-white font-bold text-lg rounded-2xl shadow-lg hover:shadow-purple-500/30 transition-all transform hover:scale-[1.02] active:scale-95">
                    Проверить код ✨
                </button>
            </form>
        </div>

        <!-- Подсказка про дефисы -->
        <p class="text-gray-400 text-sm mt-4">Код вводится с дефисами или без — мы сами расставим их правильно.</p>
    </div>

    <script>
        const input = document.getElementById('code-input');

        input.addEventListener('input', function(e) {
            let val = e.target.value.replace(/[^a-zA-Z0-9]/g, ''); // оставляем только буквы/цифры
            let parts = [];
            for (let i = 0; i < val.length; i += 5) {
                parts.push(val.substring(i, i + 5));
            }
            e.target.value = parts.join('-').toUpperCase().substring(0, 29); // 5*5=25 символов + 4 дефиса = 29
        });

        // При вставке из буфера обмена тоже форматируем
        input.addEventListener('paste', function(e) {
            e.preventDefault();
            let pasted = (e.clipboardData || window.clipboardData).getData('text');
            pasted = pasted.replace(/[^a-zA-Z0-9]/g, '');
            let parts = [];
            for (let i = 0; i < pasted.length; i += 5) {
                parts.push(pasted.substring(i, i + 5));
            }
            input.value = parts.join('-').toUpperCase().substring(0, 29);
        });

        // Отправляем одним скрытым полем? Или можно так и оставить name="code"
        // В контроллере поменяем логику: ожидаем строку и сравниваем с секретом, убрав дефисы.
    </script>
@endsection
