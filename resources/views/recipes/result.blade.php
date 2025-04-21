@extends('layouts.app')

@section('content')
<div class="container">
    <h3>検索結果</h3>
    @forelse($results as $row)
        <div class="box">
            <strong>レシピ名:</strong> {{ $row->recipe_name }}<br>
            <strong>材料:</strong> {{ $row->ingredient_name }}（{{ $row->quantity }}）
        </div>
    @empty
        <p>該当するレシピが見つかりませんでした。</p>
    @endforelse
</div>
@endsection
