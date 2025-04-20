<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class VoiceInputController extends Controller
{
    // フォーム表示
    public function showForm()
    {
        Log::channel('custom')->info('✅ これは custom.log に出力されるテストです。');
        return view('voice-input');
    }

    // 音声認識テキストの受信と表示
    public function handleForm(Request $request)
    {
        $text = $request->input('voiceInput');
        return view('voice-result', ['text' => $text]);
    }
}
