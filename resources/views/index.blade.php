@extends('layouts.app')

@section('title', '一覧')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="search-content">
                <form action="{{ action('HistoriesController@index') }}" method="get">
                @csrf
                    <label for="year">
                        <select class="" for="year" name="year" id="" size="1" >
                        @for ($i = 2020; $i < 2050; $i++)
                            <option value="{{ $i }}" {{ $year == "$i" ? "selected" : "" }}>{{ $i }}年</option>
                        @endfor
                        </select>
                    </label>
                    <label for="month">
                        <select class="" for="month" name="month" id="" size="1" >
                        @for ($i = 1; $i <= 12; $i++)
                            <option value="{{ $i }}" {{ $month == "$i" ? "selected" : "" }}>{{ $i }}月</option>
                        @endfor
                        </select>
                    </label>
                    <button class="search-btn" style="width:70px;height:30px;border-radius:2px;">絞り込む</button>
                </form>
            </div>  
            <div>
                <h3>{{ $year }}年{{ $month }}月のカテゴリー別支出一覧</h3>
                @forelse ($categories as $category)
                    <p>{{ $category }}</p>
                    <p>¥{{ $category_total[$loop->index] }}</p>
                @empty
                @endforelse
                
                <h3>{{ $year }}年{{ $month }}月の支出詳細一覧</h3>
                <form action="{{ action('HistoriesController@index') }}" method="get">
                @csrf
                    <input type="hidden" name="year" value="{{ $year }}">
                    <input type="hidden" name="month" value="{{ $month }}">
                    <select for="sort" name="sort" size="1" >
                        <option value="asc" {{ $sort == "asc" ? "selected" : "" }}>昇順</option>
                        <option value="desc"{{ $sort == "desc" ? "selected" : "" }}>降順</option>
                    </select>
                    <button class="sort-btn">並び替え</button>
                </form>
                
                    <table class="table">
                        <thead>
                            <tr>
                                <th width="20%">日時</th>
                                <th width="20%">カテゴリー</th>
                                <th width="30%">メモ</th>
                                <th width="20%">金額</th>
                                <th width="10%"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($records as $record)
                                <tr>
                                    <th>{{ $record->date }}</th>
                                    <td>{{ $record->category }}</td>
                                    <td>{{ str_limit($record->content, 100) }}</td>
                                    <td>¥{{ $record->cost }}</td>
                                    <td>
                                        <div>
                                            <a href="{{ action('HistoriesController@edit', ['id' => $record->id]) }}">編集</a>
                                        </div>
                                        <div>
                                            <a href="{{ action('HistoriesController@delete', ['id' => $record->id]) }}">削除</a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                                
                        </tbody>
                    </table>
                    @if (count($records) <= 0)
                        <p>記録がありません</p>
                    @endif
                
            </div>
            
        </div>
    </div>
</div>
@endsection