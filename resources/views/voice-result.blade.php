@extends('layouts.app')

@section('title', '音声認識結果')

@section('content')
    <h1 class="title has-text-centered">🎧 音声認識の結果</h1>

    <div class="box">
        <p><strong>入力された内容：</strong></p>
        <blockquote class="has-background-light p-3 mt-2">{{ $text }}</blockquote>
    </div>

    <div class="buttons is-right">
        <a href="/voice-input" class="button is-link is-light">戻る</a>
    </div>
@endsection
