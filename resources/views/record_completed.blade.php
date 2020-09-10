@extends('layouts.app')

@section('title', '記録完了')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h3>家計簿への記録が完了しました</h3>
            <a href="{{ url('/') }}">ホーム画面へ戻る</a>
        </div>
    </div>
</div>
@endsection
