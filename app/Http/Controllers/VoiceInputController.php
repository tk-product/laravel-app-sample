<?php

/**
 * 音声入力を処理するコントローラークラス。
 *
 * このクラスは、音声入力に関連するリクエストを処理するために使用されます。
 * Laravelの基本的なコントローラークラスを拡張しています。
 *
 * @package App\Http\Controllers
 */

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
