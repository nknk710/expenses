@extends('layouts.app')

@section('title', '支出の更新完了')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h3>更新が完了しました</h3>
            <a href="{{ url('/') }}">ホーム画面へ戻る</a>
        </div>
    </div>
</div>
@endsection