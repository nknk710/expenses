@extends('layouts.app')

@section('title', '支出の編集')

@section('page_css')
<link rel="stylesheet" href="{{ secure_asset('css/edit.css') }}" type="text/css" />

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="content">
                <h3 class="title">支出を編集する</h3>
                <form method="POST" action="{{ action('HistoriesController@update') }}">
                    @csrf
                    <input name="id" type="hidden" value="{{ $record->id }}">
                    @if (count($errors) > 0)
                        <ul>
                            @foreach ($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    @endif
                    <div>
                        <p class="data-title">日時</p>
                        <input type="date" name="date" value="{{ $record->date }}"/>
                    </div>
                    <div>
                        <p class="data-title">カテゴリー</p>
                        <label for="category">
                            <select for="category" name="category" id="" size="1" >
                                @foreach ($categories as $category)
                                    <option value="{{ $category }}">{{ $category }}</option>
                                @endforeach
                            </select>
                        </label>
                    </div>
                    <div>
                        <p class="data-title">メモ（支出の内容）</p>
                        <input type="text" name="content" value="{{ $record->content }}"/>
                    </div>
                    <div>
                        <p class="data-title">金額</p>
                        <span>¥ </span><input type="text" name="cost" value="{{ $record->cost }}" placeholder="半角数字で入力してください"/>
                    </div>
                    <button class="update-btn">収支を更新する</button>
                </form>
                
            </div>
        </div>
    </div>
</div>
@endsection