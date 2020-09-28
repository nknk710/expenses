@extends('layouts.app')

@section('title', '家計簿アプリ')

@section('page_css')
<link rel="stylesheet" href="{{ secure_asset('css/home.css') }}" type="text/css" />

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="title">
                <h1>家計簿アプリ</h1>
            </div>
            
            <div class="content">
                <h3>支出を記録する</h3>
                <form method="POST" action="{{ route('add') }}">
                    @csrf
                    @if (count($errors) > 0)
                        <ul>
                            @foreach ($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    @endif
                    <div class="data">
                        <p class="data-title">・日時</p>
                        <input type="date" name="date"/>
                    </div>
                    <div class="data">
                        <p class="data-title">・カテゴリー</p>
                        <label for="category">
                            <select for="category" name="category" id="" size="1" >
                                @foreach ($categories as $category)
                                    <option value="{{ $category }}">{{ $category }}</option>
                                @endforeach
                            </select>
                        </label>
                    </div>
                    <div class="data">
                        <p class="data-title">・メモ（支出の内容）</p>
                        <input type="text" name="content"/>
                    </div>
                    <div class="data">
                        <p class="data-title">・金額</p>
                        <span>¥ </span><input type="text" name="cost" class="yen" placeholder="半角数字で入力してください"/>
                    </div>
                    @guest
                        <button class="login-btn">家計簿を記録するには<br>ログインが必要です</button>
                    @else
                        <button class="add-btn">家計簿をつける</button>
                    @endguest
                </form>
                
            </div>
            
            @auth
            <div class="content month-search">
                <h3>家計簿の検索（月ごと）</h3>
                <div class="search-content">
                    <form action="{{ route('month_index') }}" method="get">
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
                        <button class="search-btn">検 索</button>
                    </form>
                </div>  
            </div>
            
            <div class="content year-search">
                <h3>家計簿の検索（年ごと）</h3>
                <div class="search-content">
                    <form action="{{ route('year_index') }}" method="get">
                    @csrf
                        <label for="year">
                            <select class="" for="year" name="year" id="" size="1" >
                            @for ($i = 2020; $i < 2050; $i++)
                                <option value="{{ $i }}">{{ $i }}年</option>
                            @endfor
                            </select>
                        </label>
                        <button class="search-btn">検 索</button>
                    </form>
                </div>  
            </div>
            @endauth
        </div>
    </div>
</div>
                <div class="search-content">
                    <form action="{{ route('category_add') }}" method="post">
                    @csrf
                        <label for="year">
                            <input type="text" name="category"/>
                        </label>
                        <button class="btn">追加</button>
                    </form>
                </div>  
@endsection