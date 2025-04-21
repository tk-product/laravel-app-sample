@extends('layouts.app')

@section('title', '音声認識フォーム')

@section('content')
    <h1 class="title has-text-centered">🎤 音声入力フォーム</h1>

    <form action="/search" method="POST">
        @csrf

        <div class="field">
            <label class="label">音声入力</label>
            <div class="control has-icons-left">
                <input id="voiceInput" type="text" name="voiceInput" class="input" placeholder="ここに音声が入力されます">
                <span class="icon is-left">
                    <i class="fas fa-microphone"></i>
                </span>
            </div>
        </div>

        <div class="buttons is-right">
            <button type="button" onclick="startRecognition()" class="button is-info is-light">
                マイクで話す
            </button>
            <button type="submit" class="button is-primary">送信</button>
        </div>
    </form>

    <script>
        function startRecognition() {
            const recognition = new (window.SpeechRecognition || window.webkitSpeechRecognition)();
            recognition.lang = 'ja-JP';
            recognition.interimResults = false;
            recognition.maxAlternatives = 1;

            recognition.start();

            recognition.onresult = function(event) {
                const text = event.results[0][0].transcript;
                document.getElementById('voiceInput').value = text;
            };

            recognition.onerror = function(event) {
                alert('音声認識エラー: ' + event.error);
            };
        }
    </script>
@endsection
