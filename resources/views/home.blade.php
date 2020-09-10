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
                            @foreach($errors->all() as $e)
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
                                <option value="食費">食費</option>
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
                <h3>今月の支出</h3>
                
            </div>
        </div>
    </div>
</div>
@endsection