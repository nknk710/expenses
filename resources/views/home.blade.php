@extends('layouts.app')

@section('title', '家計簿アプリ')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div>
                <h1>家計簿アプリ</h1>
            </div>
            
            <div>
                <h3>支出を記録する</h3>
                <form method="POST" action="{{ action('HistoriesController@add') }}">
                    @csrf
                    @if (count($errors) > 0)
                        <ul>
                            @foreach ($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    @endif
                    <div>
                        <p>日時</p>
                        <input type="date" name="date"/>
                    </div>
                    <div>
                        <p>カテゴリー</p>
                        <label for="category">
                            <select for="category" name="category" id="" size="1" >
                                @foreach ($categories as $category)
                                    <option value="{{ $category }}">{{ $category }}</option>
                                @endforeach
                            </select>
                        </label>
                    </div>
                    <div>
                        <p>メモ（支出の内容）</p>
                        <input type="text" name="content"/>
                    </div>
                    <div>
                        <p>金額</p>
                        <span>¥</span><input type="text" name="cost" placeholder="半角数字で入力してください"/>
                    </div>
                    <button class="">家計簿をつける</button>
                </form>
                
            </div>
            
            <div>
                <h3>家計簿の検索</h3>
                <div class="search-content">
                    <form action="{{ action('HistoriesController@index') }}" method="get">
                    @csrf
                        <label for="year">
                            <select class="" for="year" name="year" id="" size="1" >
                            @for ($i = 2020; $i < 2050; $i++)
                                <option value="{{ $i }}">{{ $i }}年</option>
                            @endfor
                            </select>
                        </label>
                        <label for="month">
                            <select class="" for="month" name="month" id="" size="1" >
                            @for ($i = 1; $i <= 12; $i++)
                                <option value="{{ $i }}">{{ $i }}月</option>
                            @endfor
                            </select>
                        </label>
                        <button class="search-btn" style="width:70px;height:30px;border-radius:2px;">絞り込む</button>
                    </form>
                </div>  
            </div>
        </div>
    </div>
</div>
@endsection