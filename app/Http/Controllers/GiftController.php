<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GiftController extends Controller
{
    // Здесь будут твои буквы – просто заглушка
    private string $secretCode = 'ABCDE-FGHIJ-KLMNO-PQRST-UVWXY';

    public function code()
    {
        return view('code');
    }

    public function checkCode(Request $request)
    {
        $code = strtoupper(str_replace('-', '', $request->input('code', '')));
        $secret = str_replace('-', '', $this->secretCode); // 'ABCDEFGHIJKLMNOPQRSTUVWXY'
        if ($code === $secret) {
            session(['gift_code_ok' => true, 'gift_puzzle' => 0]);
            return redirect('/puzzle/1');
        }
        return back()->withErrors(['code' => 'Код неверный, попробуй ещё раз!']);
    }

    public function puzzle1() { return view('puzzle1'); }
    public function checkPuzzle1(Request $request)
    {
        if ($request->input('answer') === 'Power Off') { // пример
            session(['gift_puzzle' => 1]);
            return redirect('/puzzle/2');

        }
        return back()->withErrors(['puzzle' => 'Неверно!']);
    }

    public function puzzle2() { return view('puzzle2'); }
    public function checkPuzzle2(Request $request)
    {
        if ($request->input('answer') === 'ПОДАРОК') {
            session(['gift_puzzle' => 2]);
            return redirect('/puzzle/3');
        }
        return back()->withErrors(['puzzle' => 'Неверно!']);
    }

    public function puzzle3() { return view('puzzle3'); }
    public function checkPuzzle3(Request $request)
    {
        if ($request->input('answer') === 'ГОТОВ') {
            session(['gift_puzzle' => 3]);
            return redirect('/gift');
        }
        return back()->withErrors(['puzzle' => 'Неверно!']);
    }

    public function gift()
    {
        return view('gift');
    }
}
